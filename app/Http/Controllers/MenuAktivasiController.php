<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Menu;
use App\Model\Pivot;
use App\Model\MenuPivot;
use App\Model\SaungPivot;
use App\Model\Users;
use App\Model\Profile;
use App\Model\KegiatanFasilitasi;
use App\Model\MappingFasilitasi;
use App\Model\PesertaFasilitasi;
use App\Model\Notifikasi;
use App\Model\Saung;
use App\Model\Nilaitespeserta;
use Auth;
class MenuAktivasiController extends Controller
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

        $ins=Menu::all();
        $mapping=MappingFasilitasi::where('user_id','=',Auth::user()->id)->where('flag','=',1)->get();
        $kegiatan=KegiatanFasilitasi::with('provinsi')->get();
        $peserta=Users::whereIn('authorization_level',[2,3,4])->get();
        $profile=Profile::all();

        $prf=array();
        foreach($profile as $i => $v)
        {
            $prf[$v->user_id]=$v;
        }

        $menupiv=MenuPivot::all();
        $menupivot=array();
        foreach($menupiv as $i => $v)
        {
            $menupivot[$v->menu_id][$v->fasilitasi_id]=$v;
        }
        $map=array();
        foreach($mapping as $i => $v)
        {
            $map[$v->user_id][$v->wilayah_id][$v->fasilitasi_id]=$v;
        }
        
        $pes=PesertaFasilitasi::select('*','peserta_fasilitasis.id as idpf')->join('profile','profile.user_id','=','peserta_fasilitasis.user_id')
            ->with('user')
            ->orderBy('peserta_fasilitasis.flag','desc')
            ->orderBy('profile.name','asc')
            ->get();
            
        $psrt=array();
        foreach($pes as $i => $v)
        {
            $psrt[$v->fasilitasi_id][]=$v;
        }

        $nilai=Nilaitespeserta::all();
        $n_ilai=array();
        foreach($nilai as $k => $v)
        {
            $n_ilai[$v->user_id][$v->jenis]=$v->nilai;
        }

        if ($request->ajax()) {
             return view('pages-admin.menu-aktivasi.data')
               ->with('page',$page)
               ->with('menu',$ins)
               ->with('nilai',$n_ilai)
               ->with('prf',$prf)
               ->with('map',$map)
               ->with('psrt',$psrt)
               ->with('menupivot',$menupivot)
               ->with('mapping',$mapping)
               ->with('kegiatan',$kegiatan)
               ->with('peserta',$peserta)
               ->with('hal',$page);
        }

        return view('pages-admin.menu-aktivasi.index')
                ->with('page',$page)
                ->with('prf',$prf)
                 ->with('nilai',$n_ilai)
                ->with('mapping',$mapping)  
                ->with('psrt',$psrt)              
                ->with('map',$map)              
                ->with('kegiatan',$kegiatan)
               ->with('menupivot',$menupivot)                
               ->with('peserta',$peserta)                
                ->with('menu',$ins);
    }

    public function status($idfasil,$idmenu,$st)
    {
        $up['flag']=$st; 
        // $update = Instrumen::find($id)->update($up);
        $cek=MenuPivot::where('fasilitasi_id','=',$idfasil)->where('menu_id','=',$idmenu)->get()->first();
        if(count($cek)!=0)
        {
            $update=MenuPivot::find($cek->id)->update($up);
            return response()->json([$update]);
        }
        else
        {
            $data['menu_id']=$idmenu;
            $data['fasilitasi_id']=$idfasil;
            $data['flag']=1;
            $data['created_at']=date('Y-m-d H:i:s');
            $data['updated_at']=date('Y-m-d H:i:s');
            $create=MenuPivot::create($data);
            return response()->json([$create]);
        }
            // return response()->json(['fail']);
    }

    public function simpanpeserta(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        foreach($request->id_peserta as $k => $v)
        {
            $pes=new PesertaFasilitasi;
            $pes->fasilitasi_id=$request->id_fasilitasi;
            $pes->user_id=$v;
            $pes->flag=1;
            $pes->created_at=date('Y-m-d H:i:s');
            $pes->updated_at=date('Y-m-d H:i:s');
            $pes->save();
        }
        return redirect('menu-aktivasi')->with('status','Data Peserta Fasilitasi Berhasil Di Tambah');
    }
    
    public function simpanpesertasaung(Request $request,$idsaung)
    {
        $saung=Saung::find($idsaung);
        foreach($request->id_peserta as $k => $v)
        {
            $pes=new SaungPivot;
            $pes->saung_id=$idsaung;
            $pes->user_id=$v;
            $pes->flag=0;
            $pes->created_at=date('Y-m-d H:i:s');
            $pes->updated_at=date('Y-m-d H:i:s');
            $pes->save();

            $notif=new Notifikasi;
            $notif->video_id=$saung->video_id;
            $notif->saung_id=$idsaung;
            $notif->title="Anda Diundang untuk Mengikuti <b>".$saung->saung_name.'</b>';
            $notif->url=url('gabung-saung/'.$idsaung.'/'.$saung->video_id);
            $notif->from=Auth::user()->id;
            $notif->to=$v;
            $notif->created_at=date('Y-m-d H:i:s');
            $notif->updated_at=date('Y-m-d H:i:s');
            $notif->save();
        }
        return redirect('buka-saung/'.$saung->video->slug)->with('status','Data Peserta Saung Berhasil Di Tambah');
    }

    public function hapuspeserta($id)
    {
        PesertaFasilitasi::find($id)->delete();
        return response()->json(['done']);
    }
    public function lihat_biodata($idpf,$id)
    {
        $pes_fas=PesertaFasilitasi::find($idpf);
        $user=Users::find($pes_fas->user_id);
        $profile=Profile::find($pes_fas->user_id);
        return view('pages-admin.menu-aktivasi.lihat-biodata')
                ->with('pes_fas',$pes_fas)
                ->with('user',$user)
                ->with('profile',$profile)
                ->with('idpf',$idpf)
                ->with('id',$id);
    }
    public function hasil_pretest($idpf,$id)
    {
        return view('pages-admin.menu-aktivasi.hasil-pretest')
                ->with('idpf',$idpf)
                ->with('id',$id);
    }
    public function hasil_posttest($idpf,$id)
    {
        return view('pages-admin.menu-aktivasi.hasil-posttest')
                ->with('idpf',$idpf)
                ->with('id',$id);
    }
}
