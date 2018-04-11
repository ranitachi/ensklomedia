<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\KegiatanFasilitasi;
use App\Model\MappingFasilitasi;
use App\Model\Province;
use App\Model\Users;
use App\Model\Profile;
use App\Model\Menu;
use App\Model\Video;
use App\Model\MenuPivot;
use App\Model\Saung;
use App\Model\PesertaFasilitasi;
use App\Model\Narsumfasilitasi;
use Auth;
class FasilitasiController extends Controller
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

        $ins=KegiatanFasilitasi::with('provinsi')->orderBy('start_date')->paginate($hal);
        $mapping=MappingFasilitasi::with('provinsi')->with('user')->get();
        $narsum=Narsumfasilitasi::with('provinsi')->with('narsum1')->with('narsum2')->get();
        $mp=array();
        foreach($mapping as $k => $v)
        {
            $mp[$v->fasilitasi_id][]=$v;
        }
        $ns=array();
        foreach($narsum as $k => $v)
        {
            $ns[$v->fasilitasi_id][]=$v;
        }
        if ($request->ajax()) {
             return view('pages-admin.fasilitasi.data')
               ->with('page',$page)
               ->with('instrumen',$ins)
               ->with('mapping',$mp)
               ->with('narsum',$ns)
               ->with('hal',$page);
        }

        return view('pages-admin.fasilitasi.index')
                ->with('page',$page)
                ->with('mapping',$mp)
                ->with('narsum',$ns)
                ->with('instrumen',$ins);
    }

    public function data($id=-1)
    {
        $ins=KegiatanFasilitasi::orderBy('start_date')->get();
       
        return view('pages-admin.fasilitasi.data')
                ->with('instrumen',$ins);
    }

    public function show($id=-1)
    {
        $det=array();
        $pr=Province::all();
        $prov=array();
        foreach($pr as $k => $v)
        {
            $prov[$v->id]=$v;
        }
        if($id!=-1)
        {
            $det=KegiatanFasilitasi::find($id);
        }
        // $user = Users::where('authorization_level', 2)->get();
        $user = Users::whereIn('authorization_level', [2,3])->get();

        return view('pages-admin.fasilitasi.form')
            ->with('det',$det)
            ->with('user',$user)
            ->with('prov',$prov)
            ->with('id',$id);
    }

    public function store(Request $request)
    {
        $data=array();
        foreach($request->all() as $k => $v)
        {
            $data[$k]=$v;
            if($k=='start_date')
            {
                list($dt1,$dt2)=explode('-',$v);
                $dt1=trim($dt1);
                $dt2=trim($dt2);

                list($tgl,$bln,$thn)=explode('/',$dt1);
                $data['start_date']=$thn.'-'.$bln.'-'.$tgl;
               
                list($tgl,$bln,$thn)=explode('/',$dt2);
                $data['end_date']=$thn.'-'.$bln.'-'.$tgl;
            }
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');
        }
        $create = KegiatanFasilitasi::create($data);
        return response()->json([$create]);
    }
    public function update(Request $request,$id)
    {
        $data=array();
        foreach($request->all() as $k => $v)
        {
            $data[$k]=$v;
            if($k=='start_date')
            {
                list($dt1,$dt2)=explode('-',$v);
                $dt1=trim($dt1);
                $dt2=trim($dt2);
                
                list($tgl,$bln,$thn)=explode('/',$dt1);
                $data['start_date']=$thn.'-'.$bln.'-'.$tgl;
               
                list($tgl,$bln,$thn)=explode('/',$dt2);
                $data['end_date']=$thn.'-'.$bln.'-'.$tgl;
               
            }
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');
        }
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
       $update = KegiatanFasilitasi::find($id)->update($data);
       return response()->json([$update]);
    }
    public function status($id,$st)
    {
        $up['flag']=$st; 
        $update = KegiatanFasilitasi::find($id)->update($up);
        return response()->json([$update]);
    }

    public function simpan(Request $request)
    {
        $data=$request->all();
        $data_fas=KegiatanFasilitasi::where('id','=',$request->idfasilitasi)->get()->first();
        foreach($request->id_pic as $k => $v)
        {
            $fas=new MappingFasilitasi;
            $fas->user_id=$v;
            $fas->fasilitasi_id=$request->idfasilitasi;
            $fas->wilayah_id=$data_fas->wilayah_id;
            $fas->start_date=$data_fas->start_date;
            $fas->end_date=$data_fas->end_date;
            $fas->created_at=date('Y-m-d H:i:s');
            $fas->updated_at=date('Y-m-d H:i:s');
            $fas->save();
        }
        return redirect('fasilitasi')
            ->with('message', 'Berhasil melakukan mapping PIC Fasilitasi.');
    }
    public function destroy($id)
    {
        KegiatanFasilitasi::find($id)->delete();
        return response()->json(['done']);
    }
    
    public function hapuspic($id)
    {
        MappingFasilitasi::find($id)->delete();
        return response()->json(['done']);
    }
    public function biodatasave(Request $request,$id,$idfasil)
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
        $cekpeserta=PesertaFasilitasi::where('user_id','=',$id)->where('fasilitasi_id','=',$idfasil)->get()->first();
        if(count($cekpeserta)==0)
        {
            $peserta['user_id']=$id;
            $peserta['fasilitasi_id']=$idfasil;
            $peserta['flag']=0;
            PesertaFasilitasi::create($peserta);
        }

        $saung=Saung::where('video_id','=',$request->video__id)->where('created_user_id','=',Auth::user()->id)->get()->where('flag','=',0)->first();
        $saung->flag=1;
        $saung->save();


        $create_users = Users::find($id)->update($users);
        $create_profile = Profile::where('user_id',$id)->update($profile);
        //return redirect('form-biodata/'.$id.'/'.$idfasil)->with('status', 'Form Biodata Berhasil Di Simpan, Akun Anda Akan Segera Di Verifikasi Oleh PIC Fasilitasi');
        return redirect('buka-saung/'.$request->video__slug)->with('status', 'Selamat, Anda Sudah Berhasil Membuka Saung Diskusi Baru Untuk Video : '.$request->video__title);
    }
    public function biodata($idvid,$idfasil)
    {
            $id=Auth::user()->id;

            $cekfasil=KegiatanFasilitasi::find($idfasil);
        // if(count($cekfasil)!=0)
        // {
            $m=Menu::where('title','like','%biodata%')->get()->first();
            if(count($m)!=0)
            {
                if(count($cekfasil)!=0)
                {

                    $menu=MenuPivot::where('fasilitasi_id','=',$cekfasil->id)
                                ->where('menu_id','=',$m->id)->get()->first();
                
                    if($menu->flag==1)
                    {
                        $st_biodata=1;
                    }
                    else
                    {
                        $st_biodata=0;
                    }
                }
                else
                    $st_biodata=$idfasil;
            }
            else
            {
                $st_biodata=0;
            }

            $user=Users::where('id','=',$id)->get()->first();
            $video=Video::where('id','=',$idvid)->get()->first();
            $profile = Profile::where('user_id',$id)->get()->first();
            $province = Province::all();
            
            return view('pages-admin.fasilitasi.form-biodata')
                ->with('id',$id)
                ->with('idfasil',$idfasil)
                ->with('video',$video)
                ->with('cekfasil',$cekfasil)
                ->with('profile',$profile)
                ->with('st_biodata',$st_biodata)
                ->with('province',$province)
                ->with('user',$user);
        // }
        // else
        // {
        //     return redirect('edit-profile')->with('status', 'Maaf Kegiatan Fasilitasi Belum Tersedia');
        // }
    }

    public function fasilitasiuser($idfasil)
    {
        $iduser=Auth::user()->id;
        $menu=Menu::all();
        $fas=KegiatanFasilitasi::where('id','=',$idfasil)->with('provinsi')->get()->first();
        $pes_fas=PesertaFasilitasi::where('user_id','=',Auth::user()->id)->where('fasilitasi_id','=',$idfasil)->with('user')->get()->first();
        $menupivot=MenuPivot::where('fasilitasi_id','=',$idfasil)->get();
        
        $mpv=array();
        foreach($menupivot as $k => $v)
        {
            $mpv[$v->menu_id]=$v;
        }

        $mp=array();
        foreach($menu as $k => $v)
        {
            $mp[$v->id]=$v;
        }
        
        
        return view('pages-admin.fasilitasi.fasilitasi-user')
                ->with('menu',$mp)
                ->with('idfasil',$idfasil)
                ->with('fas',$fas)
                ->with('menu_pivot',$mpv)
                ->with('pes_fas',$pes_fas)
                ->with('iduser',$iduser);
    }

    function aktivasipeserta($id,$st)
    {
        $up['flag']=$st; 
        $update = PesertaFasilitasi::find($id)->update($up);
        return response()->json([$update]);
    }
}
