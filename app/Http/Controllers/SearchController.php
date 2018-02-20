<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Video;
use File;
class SearchController extends Controller
{
    public function search(Request $request)
    {
        $data=$request->input('video-search');
        $video = Video::where("title",'=',"{$data}")->get();
        
        $status='v1';
        $mime = "video/mp4";
        // echo '<pre>';
        // print_r($data);
        // print_r($video);
        // echo '</pre>';
        if(strtolower($data)==strtolower($video[0]->title))
        {
            $vidd=$video[0];
            $id=$vidd->id;
            $myfile=public_path('uploadfiles/video').'/'.$vidd->videofile;
            $vid="http://ensiklomedia.kemdikbud.go.id/uploads/videos/".$vidd->videofile;
            $cover="http://ensiklomedia.kemdikbud.go.id/uploads/images/".$vidd->image;
            if(File::exists($myfile))
            {
                $status='v2';
                $vv = 'uploadfiles/video/'.$vidd->videofile;
                $cv = 'uploadfiles/image/'.$vidd->image;
                $vid=url($vv);
                $cover=url($cv);
            }

            return view('pages.video.search')
                    ->with('video',$vidd)
                    ->with('id',$id)
                    ->with('status',$status)
                    ->with(compact('vid', 'mime','cover'));
        }
        else
        {
            $vidd = Video::where("title","LIKE","%{$data}%")->get();

            // return view('pages.video.search')
            //         ->with('video',$vidd);
        }
        
        
    }

    public function autocomplete(Request $request)
    {
        $data = Video::select("title as name")
                    ->where("title","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    }

}
