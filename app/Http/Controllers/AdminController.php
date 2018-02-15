<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;
class AdminController extends Controller
{
    public function index()
    {
        return view('pages-admin.dashboard.index');
    }
}
