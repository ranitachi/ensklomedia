<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Comments;
use App\Model\Video;

use Auth;

class CommentsController extends Controller
{
    public function index()
    {
        return Comments::all();
    }

    public function store(Request $request)
    {
        $get = Video::where('slug', $request->slug)->firstOrFail();

        $set = new Comments;
        $set->video_id = $get->id;
        $set->user_id = Auth::user()->id;
        $set->parent_id = 0;
        $set->comment = $request->comment;
        $set->save();

        return redirect()->route('watch', $request->slug)->with('message', 'Berhasil mengirimkan komentar.');
    }
}
