<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\MappingFasilitasi;
use App\Model\Users;
use App\Model\Profile;
class MappingFasilitasiController extends Controller
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
                ->where('users.authorization_level','=','5')
                ->orWhere('users.email','LIKE','%'.$request->search.'%')
                ->orderBy('profile.name')->paginate(10);
        }
        else
        {
            $user = Users::join('profile','profile.user_id','=','users.id')
                ->where('users.authorization_level','=','5')
                ->orderBy('profile.name')->paginate(10);
        }
        
        if ($request->ajax()) {
             return view('pages-admin.setting.mapping-fasilitasi.data')
                ->with('user',$user)
                ->with('hal',$hal)
                ->render();
        }

        //return view('articles.index', compact('articles'));

        return view('pages-admin.setting.mapping-fasilitasi.index')
                ->with('hal',$hal)
                ->with('user',$user);
    }

    public function show($id=-1)
    {
        $det=array();
        $user=Users::join('profile','profile.user_id','=','users.id')
                ->where('users.authorization_level','=',4)->get();
        if($id!=-1)
        {
            $det = Users::join('profile','profile.user_id','=','users.id')
                ->where('users.id','=',$id)->get()->first();
        }
        return view('pages-admin.setting.mapping-fasilitasi.form')
            ->with('det',$det)
            ->with('user',$user)
            ->with('id',$id);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $id=array();
        foreach($request->input('nama_admin') as $idx => $item)
        {
            list($iduser,$name)=explode('__',$item);
            $id[$iduser]=$iduser;
        }
        Users::whereIn('id', $id)->update(array('authorization_level' => 1));
        return redirect('mapping-fasilitasi')->with('status', 'Tambah Data PIC Fasilitasi Baru Berhasil');
    }
}
