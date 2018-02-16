<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
class UploadController extends Controller
{
    public function index()
    {
        $cat=Category::orderBy('category')->get();
        return view('pages.video.upload')
            ->with('cat',$cat);
    }
}
