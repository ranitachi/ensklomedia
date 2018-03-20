<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Model\Category;
use App\Model\Video;
use File;
use Auth;
use FFMpeg;
class UploadController extends Controller
{
    public function index()
    {
        $id=abs(crc32(sha1(md5(rand()))));
        $cat=Category::orderBy('name')->get();
        return view('pages.video.upload')
            ->with('id',$id)
            ->with('cat',$cat);
    }
    
    public function myvideo()
    {
        $id=abs(crc32(sha1(md5(rand()))));
        $cat=Category::orderBy('name')->get();
        return view('pages.video.upload')
            ->with('id',$id)
            ->with('cat',$cat);
    }

    public function videosave(Request $request)
    {
        if( $request->hasFile('file') ) {
            $name=date('Ymd').'-'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('uploadfiles/video/'), $name);
            $id=$request->input('id');
            
            // $media = FFMpeg::open($name);
            // $durationInSeconds = $media->getDurationInSeconds();
            $filepath = public_path('uploadfiles/video').'/'.$name;

            $getID3 = new \getID3;
            $file = $getID3->analyze($filepath);
            $durationInSeconds = $file['playtime_string'];

            $type = File::extension($filepath);
            $sv=new Video;
            $sv->id=$id;
            $sv->user_id=Auth::user()->id;
            $sv->category_id=0;
            $sv->duration=$durationInSeconds;
            $sv->approved_by=NULL;
            $sv->video_path=$name;
            $sv->save();
        }
    }
    public function removefile(Request $request,$id)
    {
        // $filename=$request->input('name');
        $vid=Video::where('id','=',$id)->get()->first();
        $filename=$vid->video_path;
        $filepath = public_path('uploadfiles/video').'/'.$filename;
        Video::find($id)->forceDelete();
        File::delete($filepath);
    }
    public function store(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        $d=$request->all();
        $name=$type='';
        if( $request->hasFile('cover') ) {
            $name=date('Ymd').'-'.$request->file('cover')->getClientOriginalName();
            $request->file('cover')->move(public_path('uploadfiles/image/'), $name);
            $filepath = public_path('uploadfiles/image').'/'.$name;
            $type = File::extension($filepath);
        }

        $id=$d['id'];
        $edit=Video::find($id);
        $edit->category_id=$request->input('category_id');
        $edit->title=$request->input('title');
        //$edit->filetype=$type;
        $edit->desc=$request->input('description');
        $edit->tags=$request->input('tags');
        $edit->image_path=$name;
        //$edit->statusaktif=1;
        $edit->slug=str_slug($d['title'], '-');
        //$edit->created_at=date('Y-m-d H:i:s');
        //$edit->updated_at=date('Y-m-d H:i:s');
        $edit->save();

        return redirect('upload')->with('status', 'Video Baru Berhasil Di Simpan');
    }

    public function addhit($id)
    {
        $video=Video::find($id);
        $video->hit = $video->hit + 1;
        $video->save();
    }

    public function verifikasistatus($id,$status)
    {
        if(Auth::check())
        {
            if($status==1)
            {
                $vid=Video::find($id);
                $vid->active_by=Auth::user()->id;
                $vid->flag_active=date('Y-m-d H:i:s');
                $vid->save();
            }
            else
            {
                $vid=Video::find($id);
                $vid->active_by=NULL;
                $vid->flag_active=NULL;
                $vid->save();
            }

            return response()->json(['done']);
        }
        else
            return response()->json(['fail']);
    }   
}
