<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Category;
use App\Model\Video;
use App\Model\Endcards;
use File;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $cat=Category::orderBy('name')->get();
        $vid=Video::orderByRaw("RAND()")->get();
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
        $vid=Video::limit(20)->orderBy("hit","desc")->get();
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
            $video = Video::where('slug','like','%'.$slug.'%')->get()->first();
            $id=$video->id;
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

            $relatedvideo = Video::where('category_id', $video->category_id)->orderByRaw("RAND()")->limit(10)->get();
            $endcards=Endcards::where('video_id','=',$id)->whereNotNull('link')->get();
        }
        // echo $vid;
        //$e_cards=json_encode($endcards);
        return view('pages.watch.index')
                ->with('id',$id)
                ->with('status',$status)
                ->with('endcards',$endcards)
                ->with('video',$video)
                ->with('relatedvideo',$relatedvideo)
                ->with(compact('vid', 'mime','cover'));
    }

    public function player($filename)
    {
        $videosDir = base_path('public/uploadfiles/video');
        $video = 'video/'.$filename;
        $mime = "video/mp4";
        $title = "Os Simpsons";
        return view('pages.video.player')->with(compact('video', 'mime', 'title'));
    }
}
