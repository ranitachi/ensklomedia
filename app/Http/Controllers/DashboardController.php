<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Category;
use App\Model\Video;
use App\Model\Comments;
use App\Model\Endcards;

use File;
use Carbon\Carbon;
use Location;

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

            $relatedvideo = Video::where('category_id', $video->category_id)->orderByRaw("RAND()")->limit(10)->get();
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
}
