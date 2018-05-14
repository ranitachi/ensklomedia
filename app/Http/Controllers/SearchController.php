<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Video;
use App\Model\Endcards;
use App\Model\Like;
use App\Model\Comments;
use File;
use Auth;
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
        $relatedvideo = Video::where('category_id', $video[0]->category_id)->orderByRaw("RAND()")->limit(10)->get();
        $endcards=Endcards::where('video_id','=',$idvideo)->whereNotNull('link')->get();
        if(strtolower($data)==strtolower($video[0]->title))
        {
            $vidd=$video[0];
            $id=$vidd->id;

            $update_hit=Video::find($id);
            $update_hit->hit = $update_hit->hit+1;
            $update_hit->save();
            $comments = Comments::where('video_id', $id)->with('video')->get();
            $myfile=public_path('uploadfiles/video').'/'.$vidd->video_path;
            $vid="http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/video/".$vidd->video_path;
            $cover="http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/image/".$vidd->image_path;
            if(File::exists($myfile))
            {
                $status='v2';
                $vv = 'uploadfiles/video/'.$vidd->video_path;
                $cv = 'uploadfiles/image/'.$vidd->image_path;
                $vid=url($vv);
                $cover=url($cv);
            }
            $slug=$vidd->slug;
            $like=array();
            if(Auth::check())
                $like=Like::where('video_id','=',$id)->where('user_id','=',Auth::user()->id)->first();
            
            return view('pages.video.search')
                    ->with('video',$vidd)
                    ->with('id',$id)
                    ->with('status',$status)
                    ->with('like',$like)
                    ->with('relatedvideo',$relatedvideo)
                    ->with('endcards',$endcards)
                    ->with('comments',$comments)
                    ->with('slug',$slug)
                    ->with(compact('vid', 'mime','cover'));
        }
        else
        {
            $vidd = Video::where("title","LIKE","%{$data}%")->get();
            $id=-1;
            return view('pages.video.search')
                    ->with('id',$id)
                    ->with('status',$status)
                    ->with('like',$like)
                    ->with('relatedvideo',$relatedvideo)
                    ->with('endcards',$endcards)
                    ->with('comments',$comments)
                    ->with('slug',$slug)
                    ->with('video',$vidd);
        }
        
        
    }

    public function autocomplete(Request $request)
    {
        $data = Video::select("id as id","title as name")
                    ->where('duration','!=','-1')
                    ->whereNotNull('active_by')
                    ->where("title","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    }

}
