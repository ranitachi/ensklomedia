<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Profile;
use App\Model\Province;
use App\Model\KegiatanFasilitasi;
use App\Model\MappingFasilitasi;
use App\Model\Menu;
use App\Model\MenuPivot;
use App\Model\Saung;
use App\Model\SaungPivot;
use Auth;
class UserController extends Controller
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
                ->orWhere('users.email','LIKE','%'.$request->search.'%')
                ->orderBy('profile.name')->paginate(10);
        }
        else
        {
            $user = Users::join('profile','profile.user_id','=','users.id')
                ->orderBy('profile.name')->paginate(10);
        }
        
        if ($request->ajax()) {
             return view('pages-admin.user.data')
                ->with('user',$user)
                ->with('hal',$hal)
                ->render();
        }

        //return view('articles.index', compact('articles'));

        return view('pages-admin.user.index')
                ->with('hal',$hal)
                ->with('user',$user);
    }
    
    public function show($id=-1)
    {
        $det=array();
        $level=level();
        if($id!=-1)
        {
            $det = Users::join('profile','profile.user_id','=','users.id')
                ->where('users.id','=',$id)->get()->first();
        }
        return view('pages-admin.user.form')
            ->with('det',$det)
            ->with('level',$level)
            ->with('id',$id);
    }

    public function store(Request $request)
    {
        
        $post=$request->all();
        $users=$profile=array();
        // unset($post['_token']);
        foreach($post as $k => $v)
        {
            // $tbl=strtok($k,'_');
            $dt=explode('__',$k);
            $tbl=$dt[0];
            if($tbl!='')
            {
                if($tbl=='users')
                {
                    $users[$dt[1]]=$v;
                    if($v=='')
                        $users[$dt[1]]='n/a';

                    if($dt[1]=='password')
                    {
                        if($v!='')
                        {
                            $users['password']=bcrypt($v);
                        }
                        else
                            $users['password']=bcrypt($post['users__email']);
                            // unset($users['password']);
                    }
                    $users['registration_ip']='n/a';
                    $users['authentication_key']=bcrypt($post['users__email']);
                }
                else if($tbl=='profile')
                {
                    $profile[$dt[1]]=$v;
                    
                    if($dt[1]=='date_of_birth')
                        $profile['date_of_birth']=date('Y-m-d',strtotime($v));

                    if($v=='')
                        $profile[$dt[1]]='n/a';
                }
            }
        }
        $create_users = Users::create($users);
        $profile['user_id']=$create_users->id;

        $create_profile = Profile::create($profile);
        return redirect('user')->with('status', 'Data Pengguna Baru Berhasil Di Simpan');
        // echo '<pre>';
        // print_r($users);
        // print_r($profile);
        // echo '</pre>';
    }
    public function update(Request $request,$id)
    {
        $post=$request->all();
        $users=$profile=array();
        // unset($post['_token']);
        foreach($post as $k => $v)
        {
            // $tbl=strtok($k,'_');
            $dt=explode('__',$k);
            $tbl=$dt[0];
            if($tbl!='')
            {
                if($tbl=='users')
                {
                    $users[$dt[1]]=$v;
                    if($v=='')
                        $users[$dt[1]]='n/a';

                    if($dt[1]=='password')
                    {
                        if($v!='')
                        {
                            $users['password']=bcrypt($v);
                        }
                        else
                            unset($users['password']);
                    }
                    $users['registration_ip']='n/a';
                    $users['authentication_key']=bcrypt($post['users__email']);
                }
                else if($tbl=='profile')
                {
                    $profile[$dt[1]]=$v;
                    
                    if($dt[1]=='date_of_birth')
                        $profile['date_of_birth']=date('Y-m-d',strtotime($v));

                    if($v=='')
                        $profile[$dt[1]]='n/a';
                }
            }
        }
        // dd($users);
        $create_users = Users::find($id)->update($users);
        $create_profile = Profile::where('user_id',$id)->update($profile);
        return redirect('user')->with('status', 'Data Pengguna Baru Berhasil Di Edit');
    }

    public function destroy($id)
    {
        Profile::where('user_id','=',$id)->delete();
        Users::find($id)->delete();
        return response()->json(['done']);
    }

    public function profile()
    {
        $id=Auth::user()->id;
        $user=Users::where('id','=',$id)->get()->first();
        $profile = Profile::where('user_id',$id)->get()->first();
        $province = Province::all();

        return view('pages-admin.user.profile')
                ->with('id',$id)
                ->with('profile',$profile)
                ->with('province',$province)
                ->with('user',$user); 
    }
    public function profilesave(Request $request,$id)
    {
        $post=$request->all();
        $users=$profile=array();
        $province='';
        $st_biodata=0;
        $url_biodata='';
        // unset($post['_token']);
        foreach($post as $k => $v)
        {
            // $tbl=strtok($k,'_');
            $dt=explode('__',$k);
            $tbl=$dt[0];
            if($tbl!='')
            {
                if($tbl=='users')
                {
                    $users[$dt[1]]=$v;
                    if($v=='')
                        $users[$dt[1]]='n/a';

                    if($dt[1]=='password')
                    {
                        if($v!='')
                        {
                            $users['password']=bcrypt($v);
                        }
                        else
                            unset($users['password']);
                    }
                    $users['registration_ip']='n/a';
                    $users['authentication_key']=bcrypt($post['users__email']);
                }
                else if($tbl=='profile')
                {
                    $profile[$dt[1]]=$v;
                    
                    if($dt[1]=='date_of_birth')
                        $profile['date_of_birth']=date('Y-m-d',strtotime($v));
                    
                        if($dt[1]=='province')
                    {
                        $prov = Province::where('name','=',$v)->get()->first();
                        $province=$prov->id;

                        $cekfasilitasi=KegiatanFasilitasi::where('wilayah_id','=',$province)
                                        ->where('flag','=',1)->get()->first();
                        if(count($cekfasilitasi)!=0)
                        {
                            $m=Menu::where('title','like','%biodata%')->get()->first();
                            if(count($m)!=0)
                            {

                                $menu=MenuPivot::where('fasilitasi_id','=',$cekfasilitasi->id)
                                ->where('menu_id','=',$m->id)->get()->first();
                                
                                if(count($menu)!=0)
                                {
                                    if($menu->flag==1)
                                    {
                                        $st_biodata=1;
                                        $url_biodata=trim($m->route).'/'.$id.'/'.$cekfasilitasi->id;
                                    }
                                    else
                                    {
                                        $st_biodata=0;
                                        $url_biodata='';
                                    }
                                }
                                else
                                {
                                    $st_biodata=0;
                                    $url_biodata='';
                                }
                            }
                            else
                            {
                                $st_biodata=0;
                                $url_biodata='';   
                            }
                        }
                        else
                        {
                            $st_biodata=0;
                            $url_biodata='';
                        }
                    }

                    if($v=='')
                        $profile[$dt[1]]='n/a';
                }
            }
        }
        $create_users = Users::find($id)->update($users);
        unset($profile['province']);
        $create_profile = Profile::where('user_id',$id)->update($profile);

        $saung_pivot=SaungPivot::where('user_id','=',Auth::user()->id)->where('flag','=',0)->orderByRaw('RAND()')->limit(1)->get()->first();

        if(count($saung_pivot)!=0)
        {
            $saung_pivot->flag=1;
            $saung_pivot->save();
            
            $saung=Saung::find($saung_pivot->saung_id);
            return redirect('buka-saung/'.$saung->video->slug)->with('status', 'Selamat, Anda Berhasil Bergabung Pada Saung : <b>'.$saung->video->title.'</b>');
        }
        else
        {
            return redirect('edit-profile')->with('status', 'Data Profile Berhasil Di Edit');
        }
        // $get_maping=MappingFasilitasi::where('user_id','=',Auth::user()->id)->where('wilayah_id','=',$province)->get();
        // if(count($get_maping)!=0)
        //     $st_biodata=0;
            
        // if($st_biodata==1)
        // {
        //     // echo $url_biodata;
        //     return redirect($url_biodata)->with('status', 'Data Profile Berhasil Di Edit, Silahkan Isi Form Biodata Berikut');
        // }
        // else
        // {
        //     return redirect('edit-profile')->with('status', 'Data Profile Berhasil Di Edit');
        // }
        // echo $st_biodata;
        // echo '<pre>';
        // print_r($users);
        // print_r($profile);
        // echo '</pre>';

        // dd($users);
        // $create_users = Users::find($id)->update($users);
        // $create_profile = Profile::where('user_id',$id)->update($profile);
        // return redirect('user')->with('status', 'Data Pengguna Baru Berhasil Di Edit');
    }
}
