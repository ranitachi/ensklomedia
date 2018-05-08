<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Video;
use App\Model\Users;

class MappingVideoToReviewerController extends Controller
{
    public function index(Request $request) 
    {
        // $getvideo = Video::whereRaw('flag_active is not NULL or flag_active != "0000-00-00 00:00:00"')->with('category')->with('user')->get();
        $urll = $request->fullUrl();
        $ur=explode('?',$urll);
        $hal=10;
        $page=0;
        if(isset($ur[1]))
        {
            $pg=explode('=',$ur[1]);
            
            if($pg[0]=='page')
            {
                if(isset($pg[1]))
                    $page=($pg[1]*$hal)-$hal;
                else
                    $page=(0*$hal);
            }
        }
        $getvideo = Video::where('duration','!=','-1')->whereRaw('active_by is not NULL or active_by != 0')->with('category')->with('user')->paginate($hal);
        $getreviewer = Users::where('authorization_level', 3)->get();

        if(isset($request->search))
        {
           $getvideo = Video::where('title','LIKE','%'.$request->search.'%')
                        ->where('duration','!=','-1')
                        ->whereRaw('(active_by is not NULL or active_by != 0)')
                        ->with('category')->with('user')->paginate($hal);
        }
       
        if ($request->ajax()) {
             return view('pages-admin.mapping-video.data')
               ->with('reviewers', $getreviewer)
               ->with('hal',$page)
                ->with('videos', $getvideo);
        }

        return view('pages-admin.mapping-video.index')
            ->with('reviewers', $getreviewer)
            ->with('hal',$page)
            ->with('videos', $getvideo);
    }
    public function searchvideoreviewer()
    {
        
    }
    public function store(Request $request)
    {
        $set = Video::find($request->video_id);
        $set->reviewer_id = $request->id_reviewer;
        $set->save();

        return redirect()->route('mapping-to-reviewer.index')
            ->with('message', 'Berhasil melakukan mapping video ke Reviewer.');
    }
}
