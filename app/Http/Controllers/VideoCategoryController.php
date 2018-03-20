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
        $get = Video::byCategory($category->id)->with('user')->get();

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

    public function videodata($jlh)
    {
        $cat=Category::orderBy('name')->get();
        $vid=Video::orderByRaw("RAND()")->get();
        $video=array();
        foreach($vid as $k => $v)
        {
            $video[$v->category_id][]=$v;
        }

        $ct=array();
        foreach($cat as $k => $v)
        {
            $ct[$v->id]=$v;
        }
        return view('pages.dashboard.data-vid')
            ->with('video',$video)
            ->with('cat',$ct)
            ->with('jlh',$jlh);

    }
}
