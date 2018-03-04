<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Profile;
use App\Model\Video;
class MappingReviewerController extends Controller
{
    public function index(Request $request)
    {
        $urll = $request->fullUrl();
        $ur=explode('?',$urll);
        $hal=0;
        if(isset($ur[1]))
        {
            $pg=explode('=',$ur[1]);
            
            if($pg[0]=='page')
            {
                if(isset($pg[1]))
                    $hal=($pg[1]*10)-10;
                else
                    $hal=(0*10);
            }
        }

        if(isset($request->search))
        {
            $user = Users::join('profile','profile.user_id','=','users.id')
                ->where('profile.name','LIKE','%'.$request->search.'%')
                ->where('users.authorization_level','=','3')
                ->orWhere('users.email','LIKE','%'.$request->search.'%')
                ->orderBy('profile.name')->paginate(10);
        }
        else
        {
            $user = Users::join('profile','profile.user_id','=','users.id')
                ->where('users.authorization_level','=','3')
                ->orderBy('profile.name')->paginate(10);
        }
        
        if ($request->ajax()) {
             return view('pages-admin.setting.mapping-reviewer.data')
                ->with('user',$user)
                ->with('hal',$hal)
                ->render();
        }

        //return view('articles.index', compact('articles'));

        return view('pages-admin.setting.mapping-reviewer.index')
                ->with('hal',$hal)
                ->with('user',$user);
    }

    public function show($id=-1)
    {
        $det=array();
        $user=Users::join('profile','profile.user_id','=','users.id')
                ->where('users.authorization_level','!=',1)
                ->where('users.authorization_level','!=',2)
                ->where('users.authorization_level','!=',0)->get();
        if($id!=-1)
        {
            $det = Users::join('profile','profile.user_id','=','users.id')
                ->where('users.id','=',$id)->get()->first();
        }
        return view('pages-admin.setting.mapping-reviewer.form')
            ->with('det',$det)
            ->with('user',$user)
            ->with('id',$id);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $id=array();
        foreach($request->input('nama_reviewer') as $idx => $item)
        {
            list($iduser,$name)=explode('__',$item);
            $id[$iduser]=$iduser;
        }
        Users::whereIn('id', $id)->update(array('authorization_level' => 3));
        return redirect('mapping-reviewer')->with('status', 'Tambah Data Reviewer Baru Berhasil');
    }

    public function mappingvideo(Request $request)
    {
        $urll = $request->fullUrl();
        $ur=explode('?',$urll);
        $hal=0;
        if(isset($ur[1]))
        {
            $pg=explode('=',$ur[1]);
            
            if($pg[0]=='page')
            {
                if(isset($pg[1]))
                    $hal=($pg[1]*10)-10;
                else
                    $hal=(0*10);
            }
        }
        $us = Users::join('profile','profile.user_id','=','users.id')
                ->where('users.authorization_level','=','3')
                ->orderBy('profile.name')->get();
        $user=array();
        foreach($us as $u => $s)
        {
            $user[$s->user_id]=$s;
        }


        $video=Video::where('active_by','=',1)
                ->whereRaw('approved_by is null or apprived_by=0')
                ->orderBy('created_at')->paginate(10);
        
        if(isset($request->search))
        {
            $video = Video::where('active_by','=',1)
                        ->where('title','LIKE','%'.$request->search.'%')
                        ->whereRaw('approved_by is null or apprived_by=0')
                        ->orderBy('created_at')->paginate(10);
        }
        

        if ($request->ajax()) {
             return view('pages-admin.setting.mapping-reviewer.video')
                ->with('user',$user)
                ->with('hal',$hal)
                ->with('video',$video)
                ->render();
        }
        return view('pages-admin.setting.mapping-reviewer.mapping')
                ->with('video',$video)
                ->with('user',$user)
                ->with('hal',$hal);
    }
   
}
