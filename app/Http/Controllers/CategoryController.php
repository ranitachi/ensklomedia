<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
class CategoryController extends Controller
{
    public function index()
    {
        $cat=Category::all();
        return view('pages-admin.category.index')
                ->with('category',$cat);
    }

    public function data($id=-1)
    {
        $cat=Category::orderBy('code')->get();
        return view('pages-admin.category.data')
                ->with('category',$cat);
    }

    public function show($id=-1)
    {
        $det=array();
        if($id!=-1)
        {
            $det=Category::find($id);
        }
        return view('pages-admin.category.form')
            ->with('det',$det)
            ->with('id',$id);
    }

    public function store(Request $request)
    {
       $create = Category::create($request->all());
       return response()->json([$create]);
    }
    public function update(Request $request,$id)
    {
       $update = Category::find($id)->update($request->all());
       return response()->json([$update]);
    }
    public function destroy($id)
    {
        Category::find($id)->delete();
        return response()->json(['done']);
    }
}
