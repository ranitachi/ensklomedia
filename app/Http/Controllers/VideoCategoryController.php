<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Video;

class VideoCategoryController extends Controller
{
    public function index($id)
    {
        $get = Video::byCategory($id)->limit(9)->with('user')->get();

        return view('pages.videobycategory.index')->with('videos', $get);
    }
}
