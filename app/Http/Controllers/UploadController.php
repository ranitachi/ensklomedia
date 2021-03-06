<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Model\Category;
use App\Model\Video;
use App\Model\Notifikasi;
use App\Model\Pesertatantangan;
use File;
use Auth;
use FFMpeg;
class UploadController2 extends Controller
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
            $name=date('Ymd').'-'.str_slug($request->file('file')->getClientOriginalName(),'-').'.'.$request->file('file')->getClientOriginalExtension();
            // $mime = $request->file('file')->getMimeType();
            // if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv") 
            // {

                $request->file('file')->move(public_path('uploadfiles/video/'), $name);
                $id=$request->input('id');
                
                // $media = FFMpeg::open($name);
                // $durationInSeconds = $media->getDurationInSeconds();
                $filepath = public_path('uploadfiles/video').'/'.$name;

                $getID3 = new \getID3;
                $file = $getID3->analyze($filepath);
                if(isset($file['playtime_string']))
                {
                    $durationInSeconds = $file['playtime_string'];

                    $type = File::extension($filepath);
                    $sv=new Video;
                    $sv->id=$id;
                    $sv->user_id=Auth::user()->id;
                    $sv->category_id=0;
                    $sv->nilai_review=0;
                    $sv->duration=$durationInSeconds;
                    $sv->approved_by=NULL;
                    $sv->video_path=$name;
                    $sv->save();
                    return response()->json([$request->file('file')]);
                }
                else
                {
                    File::delete($filepath);
                    return response()->json(['Error']);
                }
            }
        // }
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
    public function hapusfile($name)
    {
        $filepath = public_path('uploadfiles/video').'/'.$name;
        File::delete($filepath);
        return redirect('hapusfile');
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
        
        $tagsToStrip = array('@<script[^>]*?>.*?</script>@si'); // you can add more
        $m_title = preg_replace($tagsToStrip, '-', $request->input('title'));
        $edit->title=$m_title;
        //$edit->filetype=$type;
        
        $tagsToStrip = array('@<script[^>]*?>.*?</script>@si'); // you can add more
        $m_description = preg_replace($tagsToStrip, '-', $request->input('description'));
        $edit->desc=$m_description;

        $tagsToStrip = array('@<script[^>]*?>.*?</script>@si'); // you can add more
        $m_tags = preg_replace($tagsToStrip, '-', $request->input('tags'));
        $edit->tags=$m_tags;

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
            $vid=Video::find($id);
            if($status==1)
            {
                $vid->active_by=Auth::user()->id;
                $vid->flag_active=date('Y-m-d H:i:s');
                $vid->save();
            }
            else
            {
                
                $vid->active_by=NULL;
                $vid->flag_active=NULL;
                $vid->save();
            }

            if(!is_null($vid->reviewer_id))
            {
                $pes_tan=Pesertatantangan::where('penjelasan','like','%'.$id.'::reviewer_id:'.$vid->reviewer_id.'%')->first();
                if(count($pes_tan)!=0)
                    $idsaung=$pes_tan->saung_id;
                else
                    $idsaung=-1;

                $notif=new Notifikasi;
                $notif->video_id=$id;
                $notif->saung_id=$idsaung;
                $notif->title="Anda Diundang Mendapatkan 1 Video untuk di Review";
                $notif->url=url('review/'.$id);
                $notif->from=Auth::user()->id;
                $notif->to=$vid->reviewer_id;
                $notif->created_at=date('Y-m-d H:i:s');
                $notif->updated_at=date('Y-m-d H:i:s');
                $notif->save();
            }

            return response()->json(['done']);
        }
        else
            return response()->json(['fail']);
    }   
}
