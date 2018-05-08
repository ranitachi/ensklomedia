<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Video;
use App\Model\Category;
use App\Model\PetaMateri;
use Carbon\Carbon;
use Auth;
class VideoCategoryController extends Controller
{
    public function index($slug)
    {
        $category = Category::bySlug($slug)->first();
        $get = Video::byCategory($category->id)->with('user')->get();
        $pm = PetaMateri::where('category_id','=',$category->id)->where('flag','=',1)->get();
        

        return view('pages.videobycategory.index')
            ->with('videos', $get)
            ->with('mapel', $pm)
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
        if($jlh==5)
            $vid=Video::whereNotNull('active_by')->with('category')->orderByRaw("RAND()")->limit(30)->get();
        elseif($jlh==4)
            $vid=Video::whereNotNull('active_by')->with('category')->orderByRaw("RAND()")->limit(24)->get();
        else
            $vid=Video::whereNotNull('active_by')->with('category')->orderByRaw("RAND()")->limit(18)->get();

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
            ->with('video',$vid)
            ->with('cat',$ct)
            ->with('jlh',$jlh);

    }
}
