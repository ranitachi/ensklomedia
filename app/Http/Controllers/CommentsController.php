<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Comments;

class CommentsController extends Controller
{
    public function index()
    {
        return Comments::all();
    }
}
