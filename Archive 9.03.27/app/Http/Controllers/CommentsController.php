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

        $tagsToStrip = array('@<script[^>]*?>.*?</script>@si'); // you can add more
        $message = preg_replace($tagsToStrip, '-', $request->comment);
        
        $set->comment = $message;
        $set->save();

        return redirect()->route('watch', $request->slug)->with('message', 'Berhasil mengirimkan komentar.');
    }
}
