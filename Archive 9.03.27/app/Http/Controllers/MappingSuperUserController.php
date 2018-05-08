<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Profile;
use App\Model\Video;
use App\Model\Notifikasi;
use Auth;
class MappingSuperUserController extends Controller
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
                ->where('users.authorization_level','=','2')
                ->orWhere('users.email','LIKE','%'.$request->search.'%')
                ->orderBy('profile.name')->paginate(10);
        }
        else
        {
            $user = Users::join('profile','profile.user_id','=','users.id')
                ->where('users.authorization_level','=','2')
                ->orderBy('profile.name')->paginate(10);
        }
        
        if ($request->ajax()) {
             return view('pages-admin.setting.mapping-super-user.data')
                ->with('user',$user)
                ->with('hal',$hal)
                ->render();
        }

        //return view('articles.index', compact('articles'));

        return view('pages-admin.setting.mapping-super-user.index')
                ->with('hal',$hal)
                ->with('user',$user);
    }

    public function show($id=-1)
    {
        $det=array();
        $user=Users::join('profile','profile.user_id','=','users.id')
                ->where('users.authorization_level','!=',1)
                ->where('users.authorization_level','!=',0)->get();
        if($id!=-1)
        {
            $det = Users::join('profile','profile.user_id','=','users.id')
                ->where('users.id','=',$id)->get()->first();
        }
        return view('pages-admin.setting.mapping-super-user.form')
            ->with('det',$det)
            ->with('user',$user)
            ->with('id',$id);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $id=array();
        foreach($request->input('nama_super_user') as $idx => $item)
        {
            list($iduser,$name)=explode('__',$item);
            $id[$iduser]=$iduser;
        }
        Users::whereIn('id', $id)->update(array('authorization_level' => 2));
        return redirect('mapping-super-user')->with('status', 'Tambah Data Super User Baru Berhasil');
    }

    public function verifikasi(Request $request)
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
                ->orderBy('profile.name')->get();
        $user=array();
        foreach($us as $u => $s)
        {
            $user[$s->user_id]=$s;
        }


        $video=Video::whereNull('active_by')
                ->orderBy('created_at')->paginate(10);
        
        if(isset($request->search))
        {
            $video = Video::where('title','LIKE','%'.$request->search.'%')
                        ->whereNull('active_by')
                        ->orderBy('created_at')->paginate(10);
        }
        
        
        if ($request->ajax()) {
             return view('pages-admin.setting.mapping-reviewer.verifikasi-video')
                ->with('user',$user)
                ->with('hal',$hal)
                ->with('video',$video)
                ->render();
        }

        $update['seen']=date('Y-m-d H:i:s');
        $update['flag_active']=0;
        Notifikasi::where('to',Auth::user()->id)->where('url','like','%video-verifikasi%')->update($update);

        return view('pages-admin.setting.mapping-reviewer.verifikasi')
                ->with('video',$video)
                ->with('user',$user)
                ->with('hal',$hal);
    }
}
