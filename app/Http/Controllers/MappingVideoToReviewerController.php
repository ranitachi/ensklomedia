<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Video;
use App\Model\Users;

class MappingVideoToReviewerController extends Controller
{
    public function index() 
    {
        $getvideo = Video::where('flag_active', '!=', NULL)->with('category')->with('user')->get();
        $getreviewer = Users::where('authorization_level', 3)->get();

        return view('pages-admin.mapping-video.index')
            ->with('reviewers', $getreviewer)
            ->with('videos', $getvideo);
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
