<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Category;
use App\Model\Video;
use App\Model\Comments;
use App\Model\PetaMateri;
use App\Model\Endcards;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use File;
use Carbon\Carbon;
use Location;
use FFMpeg;
use DB;
class DashboardController extends Controller
{
    public function index()
    {   
        $cat=Category::orderBy('name')->get();
        $vid=Video::where('duration','!=','-1')->orderByRaw("RAND()")->get();
        $video=array();
        foreach($vid as $k => $v)
        {
            $video[$v->category_id][]=$v;
        }

        $ct=array();
        foreach($cat as $k => $v)
        {
            $ct[$v->id]=$v;
        }
        return view('pages.dashboard.index')
            ->with('video',$video)
            ->with('cat',$ct);
    }
    
    public function trending()
    {
        $ct=Category::orderBy('name')->get();
        $cat=array();
        foreach($ct as $k => $v)
        {
            $cat[$v->id]=$v;
        }
        $vid=Video::where('duration','!=','-1')->limit(20)->orderBy("hit","desc")->get();
        $video=array();
        foreach($vid as $k => $v)
        {
            $video[$v->id]=$v;
        }
        return view('pages.dashboard.trending')
            ->with('video',$video)
            ->with('cat',$cat);
    }

    public function watch($slug=-1)
    {
        $video=$endcards=array();
        $id=-1;
        $status='v1';
        if($slug!=-1)
        {
            $video = Video::where('slug','like',$slug)->get()->first();
            $id=$video->id;

            $comments = Comments::where('video_id', $id)->with('video')->get();
            
            $myfile=public_path('uploadfiles/video').'/'.$video->video_path;
            $vid="http://ensiklomedia.kemdikbud.go.id/uploads/videos/".$video->video_path;
            $cover="http://ensiklomedia.kemdikbud.go.id/uploads/images/".$video->image_path;
            if(File::exists($myfile))
            {
                $status='v2';
                $vv = 'uploadfiles/video/'.$video->video_path;
                $cv = 'uploadfiles/image/'.$video->image_path;
                $vid=url($vv);
                $cover=url($cv);
            }
            $mime = "video/mp4";

            $relatedvideo = Video::where('category_id', $video->category_id)->with('category')->orderByRaw("RAND()")->limit(10)->get();
            $endcards=Endcards::where('video_id','=',$id)->whereNotNull('link')->get();
        }
        // echo $vid;
        //$e_cards=json_encode($endcards);
        return view('pages.watch.index')
                ->with('id',$id)
                ->with('status',$status)
                ->with('endcards',$endcards)
                ->with('slug',$slug)
                ->with('video',$video)
                ->with('relatedvideo',$relatedvideo)
                ->with('comments',$comments)
                ->with(compact('vid', 'mime','cover'));
    }

    public function player($id)
    {
        $video = Video::where('id','=',$id)->get()->first();
        $id=$video->id;
        $videosDir = base_path('public/uploadfiles/video');
        $myfile=public_path('uploadfiles/video').'/'.$video->video_path;
        $vid="http://ensiklomedia.kemdikbud.go.id/uploads/videos/".$video->video_path;
        $cover="http://ensiklomedia.kemdikbud.go.id/uploads/images/".$video->image_path;
        if(File::exists($myfile))
        {
                $status='v2';
                $vv = 'uploadfiles/video/'.$video->video_path;
                $cv = 'uploadfiles/image/'.$video->image_path;
                $vid=url($vv);
                $cover=url($cv);
        }
        // $vid='http://ensiklomedia.kemdikbud.go.id/uploads/videos/20170703-66BP5AE20160715_010744.mp4';
        $mime = "video/mp4";
        $title = $video->title;
        return view('pages.video.player')->with(compact('vid', 'mime', 'title'));
    }
    public function playerstd($slug)
    {
        $video = Video::where('slug','=',$slug)->get()->first();
        $id=$video->id;
        $videosDir = base_path('public/uploadfiles/video');
        $myfile=public_path('uploadfiles/video').'/'.$video->video_path;
        $vid="http://ensiklomedia.kemdikbud.go.id/uploads/videos/".$video->video_path;
        $cover="http://ensiklomedia.kemdikbud.go.id/uploads/images/".$video->image_path;
        if(File::exists($myfile))
        {
                $status='v2';
                $vv = 'uploadfiles/video/'.$video->video_path;
                $cv = 'uploadfiles/image/'.$video->image_path;
                $vid=url($vv);
                $cover=url($cv);
        }
        // $vid='http://ensiklomedia.kemdikbud.go.id/uploads/videos/20170703-66BP5AE20160715_010744.mp4';
        $mime = "video/mp4";
        $title = $video->title;
        return view('pages.video.player-std')->with(compact('vid', 'mime', 'title'));
    }

    public function durasi()
    {
        // $getID3 = new \getID3;
        // $filename =public_path('uploadfiles/video').'/20180317-VideoAndroid.mp4';
        // $file = $getID3->analyze($filename);
        // $duration_string = $file['playtime_string'];
        // echo $duration_string;
        // $file="http://ensiklomedia.kemdikbud.go.id/uploads/videos/20170906-221Tak%20berjudul%20640x360%200,94Mbps%202017-09-06%2010-41-20.mp4";
        // $lokasi_ffpmeg=public_path();
        // echo $lokasi_ffpmeg.'/bin/ffmpeg';
        // $process = new Process('bin/ffmpeg -i '.$file.' 2>&1 | grep "Duration"');
        // $process = new Process('ls -la bin/ff*');
        // $process->run();
    
        //     if (!$process->isSuccessful()) {
        //         $durasi ='-1';
        //     }
        //     else{
        //         // $durasi=substr($process->getOutput(),12,8);
        //         $durasi=$process->getOutput();
        //     }
        //     echo $durasi;
        
        $video='http://ensiklomedia.kemdikbud.go.id/uploads/videos/20171218-1312Sejarah%20G30SPKI.mp4';
        // $cekfile=cekfile($video);
        // echo $cekfile;
        // $process = new Process('/usr/local/bin/ffprobe -i '.$video.' -sexagesimal -show_entries format=duration -v quiet -of csv="p=0"');
        // $process = new Process('/usr/local/bin/ffmpeg -i '.$video.' 2>&1 | grep "Duration"');
        // $process->run();
        // echo $process->getOutput();

        // $vid=Video::where('duration','=','00:00:00')->limit(100)->get();
        // $vid=Video::where('duration','=','00:00:00')->get();
        $vid=Video::where('duration','=','-1')->get();
        $x=0;
        foreach($vid as $index => $val)
        {
            $file="http://ensiklomedia.kemdikbud.go.id/uploads/videos/".str_replace(' ','%20',$val->video_path);
            // $file="http://ensiklomedia.kemdikbud.go.id/uploads/videos/".$val->video_path;
            $cekfile=cekfile($file);
            if($cekfile)
            {
                $process = new Process('/usr/local/bin/ffprobe -i '.$file.' -sexagesimal -show_entries format=duration -v quiet -of csv="p=0"');
                $process->run();
                $duration='0'.strtok($process->getOutput(),'.');

                
                //echo '<span style="color:blue">'.$val->title.' :: '.$duration.'</span><br>';
                // $x++;
                DB::table('video')
                    ->where('id', $val->id)
                    ->update(['duration' => $duration]);

                $img_path=$val->image_path;
                if($val->image_path=='')
                {
                    $gbr=strtok($val->video_path,'.').'.jpg';
                    DB::table('video')
                    ->where('id', $val->id)
                    ->update(['image_path' => $gbr]);
                    $img_path=$gbr;
                }
                 
                if(strpos($img_path,'.gif')!==false)
                {
                    $img_path=str_replace('.gif','.jpg',$img_path);
                }
                $prc2=new Process('/usr/local/bin/ffmpeg -ss 00:00:03 -i "'.$file.'" -vf  scale=w=845:h=400:force_original_aspect_ratio=decrease "'.public_path().'/uploadfiles/image/'.$img_path.'"');
                $prc2->run();
                    
            }
            else
            {
                // DB::table('video')
                //     ->where('id', $val->id)
                //     ->delete();
                DB::table('video')
                    ->where('id', $val->id)
                    ->update(['duration' => '-1']);
                echo '<span style="color:red">'.$file.' :: '.$val->title.'</span><br>';
                $x++;
            }
            // echo $cekfile;
            // if(File::exists($url))
            // {
            //     echo $val->video_path.'<br>';
            // }
            // $process = new Process('/usr/local/bin/ffmpeg -i '.$file.' 2>&1 | grep "Duration"');
            // $process = new Process('/usr/local/bin/ffprobe -i '.$file.' -sexagesimal -show_entries format=duration -v quiet -of csv="p=0"');
            // $process->run();
            // echo $file.':'.$process->getOutput().'<br>';
            // $process->wait();
            // if (!$process->isSuccessful()) {
            //     $x++;
            // }
            // if (!$process->isSuccessful()) {
            //     echo '<span style="color:red">'.$file.' :: '.$val->title.'</span><br>';
            //     // DB::table('video')
            //     //     ->where('id', $val->id)
            //     //     ->update(['duration' => "-1"]);
            //     $x++;
            // }
            // else{
            //     $durasi=substr($process->getOutput(),12,8);
            //     DB::table('video')
            //         ->where('id', $val->id)
            //         ->update(['duration' => $durasi]);
            //     echo $val->video_path.' :: '.$process->getOutput().'<br>';
            // }
    
        }
        echo 'Sisa Data : '.$x;
         echo '<br><br>This page took <b>'. (microtime(true) - LARAVEL_START) .'</b> seconds to render<br>';
    }

    public function combomapel($idkat)
    {
        echo '<select name="id_mapel" class="form-control" data-placeholder="Mata Pelajaran">';
        echo '<option value=""></option>';
        $mapel=PetaMateri::where('category_id','=',$idkat)->get();
        if(count($mapel)!=0)
        {
            foreach($mapel as $id_m => $vl_m)
            {
                echo '<option value="'.$vl_m->id.'">'.$vl_m->title.'</option>';
            }
        }
        echo '</select>';
    }
}
