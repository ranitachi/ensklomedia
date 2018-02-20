<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Category;
use App\Model\Video;
use File;
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
        return view('pages.dashboard.index')
            ->with('video',$video)
            ->with('cat',$cat);
    }
    public function watch($slug=-1)
    {
        $video=array();
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
        }
        // echo $vid;
        return view('pages.watch.index')
                ->with('id',$id)
                ->with('status',$status)
                ->with('video',$video)
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
