<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Video;
use App\Model\Category;
use App\Model\Users;
use App\Model\Comments;
use App\Model\PetaMateri;
use App\Model\Endcards;
use App\Model\Instrumen;
use App\Model\Penilaian;
use App\Model\Notifikasi;
use Auth;
use File;
class ReviewVideoController extends Controller
{
    public function index(Request $request)
    {
        $hal=12;
        $getvideo = Video::where('reviewer_id','=',Auth::user()->id)->with('category')->with('user')->paginate($hal);
        if(isset($request->search))
        {
           $getvideo = Video::where('title','LIKE','%'.$request->search.'%')
                        ->where('reviewer_id','=',Auth::user()->id)
                        ->with('category')->with('user')->paginate($hal);
        }
       
        if ($request->ajax()) {
             return view('pages-admin.setting.review-video.data')
               ->with('hal',$hal)
                ->with('videos', $getvideo);
        }


        
        // return view('pages-admin.mapping-video.index')
        return view('pages-admin.setting.review-video.index')
            ->with('hal',$hal)
            ->with('videos', $getvideo);
    }

    public function show($id)
    {
        $video = Video::where('reviewer_id','=',Auth::user()->id)->where('id','=',$id)->with('category')->with('user')->get()->first();
        $id=$video->id;
        $ct=Category::orderBy('name')->get();
        $cat=array();
        foreach($ct as $k => $v)
        {
            $cat[$v->id]=$v;
        }
        
        $pm=PetaMateri::orderBy('title')->get();
        $mapel=array();
        foreach($pm as $k => $v)
        {
            $mapel[$v->category_id][$v->id]=$v;
        }

        $comments = Comments::where('video_id', $id)->with('video')->get();
            
        $myfile=public_path('uploadfiles/video').'/'.$video->video_path;
        $vid="http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/video/".$video->video_path;
        $cover="http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/image/".$video->image_path;
        $status='';
        if(File::exists($myfile))
        {
            $status='v2';
            $vv = 'uploadfiles/video/'.$video->video_path;
            $cv = 'uploadfiles/image/'.$video->image_path;
            $vid=url($vv);
            $cover=url($cv);
        }
        $mime = "video/mp4";

        $relatedvideo = Video::where('reviewer_id','=',Auth::user()->id)
                        ->where('id','!=',$id)->with('category')->with('user')->orderByRaw("RAND()")->limit(10)->get();
        $e_c=Endcards::where('video_id','=',$id)->whereNotNull('link')->get();
        $endcards=array();
        $ix=0;
        foreach($e_c as $k => $vv)
        {
            if($vv->link!='')
            {
                $endcards['link'][$ix]=$vv->link;
                $endcards['title'][$ix]=$vv->title;
                $ix++;
            }
        }
        
        $instrumen=Instrumen::where('flag','=',1)->get();
        $penilaian=Penilaian::where('video_id','=',$id)->get();
        $pn=array();
        foreach($penilaian as $i => $v)
        {
            $pn[$v->instrumen_id]=$v->nilai;
        }

        $upd['seen']=date('Y-m-d H:i:s');
        $upd['flag_active']=0;
        Notifikasi::where('video_id',$id)->where('to',Auth::user()->id)->update($upd);

        return view('pages-admin.setting.review-video.detail')
                ->with('id',$id)
                ->with('status',$status)
                ->with('instrumen',$instrumen)
                ->with('endcards',$endcards)
                ->with('pn',$pn)
                ->with('video',$video)
                ->with('cat',$cat)
                ->with('mapel',$mapel)
                ->with('relatedvideo',$relatedvideo)
                ->with('comments',$comments)
                ->with(compact('vid', 'mime','cover'));
    }
    public function uploadreview(Request $request, $id)
    {
        if($request->input('pesan')=='')
        {
            $vid=Video::find($id);
            $vid->approved_by=Auth::user()->id;
            $vid->approved_at=date('Y-m-d H:i:s');
            $vid->save();
            return redirect('review/'.$id)
                ->with('message', 'Video Sudah Dikaji, dan siap Tayang');
        }
        else
        {

        }
    }
    public function editvideo(Request $request,$id)
    {
        // dd($request->all());
        $edit=Video::find($id);
        $edit->title = $request->input('title');
        $edit->category_id = $request->input('category_id');
        $edit->id_mapel = $request->input('id_mapel');
        $edit->tags = $request->input('tag');
        $edit->desc = $request->input('description');
        $edit->save();
        return redirect('review/'.$id)
            ->with('message', 'Berhasil melakukan Perubahan Data Video');
        // redirect('review/'.$id)->with('message',"Data Video Berhasil Di Edit");
    }
    public function endcards(Request $request, $id)
    {
        // dd($request->all());
        $x=0;
        $ins=array();
        Endcards::where('video_id','=',$id)->forceDelete();

        foreach($request->input('title') as $idx => $val)
        {
            if($val!='')
            {
                $link=$request->input('link')[$idx];
                $ins[$x]['video_id']=$id;
                $ins[$x]['title']=$val;
                $ins[$x]['link']=$link;
                $ins[$x]['created_at']=date('Y-m-d H:i:s');
                $ins[$x]['updated_at']=date('Y-m-d H:i:s');
                // Endcards::create($ins);
                // $endcards=new Endcards;
                // $endcards->title=$val;
                // $endcards->link=$link;
                // $endcards->created_at=date('Y-m-d H:i:s');
                // $endcards->updated_at=date('Y-m-d H:i:s');
                // $endcards->save();
                $x++;
            }

        }
        Endcards::insert($ins);
        return redirect('review/'.$id)
            ->with('message', 'Berhasil Menyimpan Data End Cards');
    }
}
