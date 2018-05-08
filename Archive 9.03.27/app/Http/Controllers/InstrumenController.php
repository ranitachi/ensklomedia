<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Instrumen;

class InstrumenController extends Controller
{
    public function index(Request $request)
    {
        $urll = $request->fullUrl();
        $ur=explode('?',$urll);
        $hal=10;
        $page=0;
        if(isset($ur[1]))
        {
            $pg=explode('=',$ur[1]);
            
            if($pg[0]=='page')
            {
                if(isset($pg[1]))
                    $page=($pg[1]*$hal)-$hal;
                else
                    $page=(0*$hal);
            }
        }

        $ins=Instrumen::where('category_id','=','-1')->paginate($hal);

        if ($request->ajax()) {
             return view('pages-admin.instrumen.data')
               ->with('page',$page)
               ->with('instrumen',$ins)
               ->with('hal',$page);
        }

        return view('pages-admin.instrumen.index')
                ->with('page',$page)
                ->with('instrumen',$ins);
    }

    public function data($id=-1)
    {
        $ins=Instrumen::orderBy('id')->get();
       
        return view('pages-admin.instrumen.data')
                ->with('instrumen',$ins);
    }

    public function show($id=-1)
    {
        $det=array();
        if($id!=-1)
        {
            $det=Instrumen::find($id);
        }
        return view('pages-admin.instrumen.form')
            ->with('det',$det)
            ->with('id',$id);
    }

    public function store(Request $request)
    {
        $data=$request->all();
        $data2=validate_js($data);
        $create = Instrumen::create($data2);
        return response()->json([$create]);
    }
    public function update(Request $request,$id)
    {
        $data=$request->all();
        $data2=validate_js($data);
       $update = Instrumen::find($id)->update($data2);
       return response()->json([$update]);
    }
    public function status($id,$st)
    {
        $up['flag']=$st; 
        $update = Instrumen::find($id)->update($up);
        return response()->json([$update]);
    }
    public function destroy($id)
    {
        Instrumen::find($id)->delete();
        return response()->json(['done']);
    }
}
