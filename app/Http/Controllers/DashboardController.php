<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $cat=Category::orderBy('name')->get();
        return view('pages.dashboard.index')
            ->with('cat',$cat);
    }
    public function watch()
    {
        return view('pages.watch.index');
    }
}
