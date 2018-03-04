<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Video;
use App\Model\Category;
use Carbon\Carbon;
use Auth;
class VideoCategoryController extends Controller
{
    public function index($slug)
    {
        $category = Category::bySlug($slug)->first();
        $get = Video::byCategory($category->id)->limit(10)->with('user')->get();

        return view('pages.videobycategory.index')
            ->with('videos', $get)
            ->with('category_name', $category->name);
    }
    
    public function datavideo()
    {
        $userid=Auth::user()->id;
        $category = Category::orderBy('name')->get();
        $get = Video::byUser($userid)->get();

        return view('pages.video.myvideo')
            ->with('videos', $get)
            ->with('category', $category);
    }
}
