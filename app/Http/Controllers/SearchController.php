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
        $idvideo=$request->input('video_id');
        $video = Video::where("id",'=',"{$idvideo}")->get();
        
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

            $update_hit=Video::find($id);
            $update_hit->hit = $update_hit->hit+1;
            $update_hit->save();

            $myfile=public_path('uploadfiles/video').'/'.$vidd->video_path;
            $vid="http://ensiklomedia.kemdikbud.go.id/uploads/videos/".$vidd->video_path;
            $cover="http://ensiklomedia.kemdikbud.go.id/uploads/images/".$vidd->image_path;
            if(File::exists($myfile))
            {
                $status='v2';
                $vv = 'uploadfiles/video/'.$vidd->video_path;
                $cv = 'uploadfiles/image/'.$vidd->image_path;
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
        $data = Video::select("id as id","title as name")
                    ->where("title","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    }

}
