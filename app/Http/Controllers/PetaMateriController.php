<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PetaMateri;
use App\Model\TopikMateri;
use App\Model\Category;
class PetaMateriController extends Controller
{
    public function form($idcat=-1,$id=-1)
    {
        $pm=array();
        $cat=Category::where('id','=',$idcat)->get()->first();
        if($id!=-1)
            $pm=PetaMateri::where('id','=',$id)->with('category')->get()->first();

        return view('pages-admin.category.petamateri-form')
                ->with('id',$id)
                ->with('idcat',$idcat)
                ->with('cat',$cat)
                ->with('petamateri',$pm);
    }

    public function save(Request $request,$idcat, $id)
    {
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        if($id==-1)
        {
            $create = PetaMateri::create($request->all());
            return response()->json([$create]);
        }
        else
        {
            $update = PetaMateri::find($id)->update($request->all());
            return response()->json([$update]);
        }
    }

    public function topik()
    {
        return view('pages-admin.category.topik');
    }
    public function topikdata()
    {
        $cat=Category::all();
        $pm=PetaMateri::all();
        $mapel=array();
        foreach($pm as $k => $v)
        {
            $mapel[$v->category_id][]=$v;
        }

        $tm=TopikMateri::all();
        $topik=array();
        foreach($tm as $k => $v)
        {
            $topik[$v->mapel_id][]=$v;
        }
        return view('pages-admin.category.topik-data')
                ->with('petamateri',$mapel)
                ->with('topik',$topik)
                ->with('category',$cat);
    }
    public function topikform($idcat,$idmapel,$id)
    {
        $pm=array();
        $cat=Category::where('id','=',$idcat)->get();
        $p=PetaMateri::where('id','=',$idmapel)->get();
        // $petam=array();
        // foreach($p as $item)
        // {
        //     $petam[$item->category_id][]=$item;
        // }
        if($id!=-1)
            $pm=TopikMateri::where('id','=',$id)->with('mapel')->with('category')->get()->first();

        return view('pages-admin.category.topik-form')
                ->with('id',$id)
                ->with('cat',$cat)
                ->with('petamateri',$p)
                ->with('det',$pm);
    }
    public function topikproses(Request $request,$id)
    {
        if($id==-1)
        {
            $create = TopikMateri::create($request->all());
            return response()->json([$create]);
        }
        else
        {
            $update = TopikMateri::find($id)->update($request->all());
            return response()->json([$update]);
        }
    }
    public function topikdelete($idcat,$idmapel,$id)
    {
        TopikMateri::find($id)->delete();
        return response()->json(['done']);
    }
}
