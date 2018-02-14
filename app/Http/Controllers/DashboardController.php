<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.index');
    }
    public function watch()
    {
        return view('pages.watch.index');
    }
}
