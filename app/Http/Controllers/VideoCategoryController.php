<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Video;
use App\Model\Category;

class VideoCategoryController extends Controller
{
    public function index($slug)
    {
        $category = Category::bySlug($slug)->first();
        $get = Video::byCategory($category->id)->limit(9)->with('user')->get();

        return view('pages.videobycategory.index')
            ->with('videos', $get)
            ->with('category_name', $category->name);
    }
}
