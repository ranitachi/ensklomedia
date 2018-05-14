<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Evaluasinarasumber;
use App\Model\Evaluasipenyelenggara;
use App\Model\Evaluasipeserta;
use App\Model\KegiatanFasilitasi;
use App\Model\Narsumfasilitasi;
use Auth;
class Evaluasicontroller extends Controller
{
    public function evaluasi_from($jenis,$iduser,$idfasil,$jam_ke)
    {
        $fasil=KegiatanFasilitasi::find($idfasil);
        $d_narsum=$eval=$evl=array();
        $narsum=Narsumfasilitasi::where('fasilitasi_id',$idfasil)->first();
        if($jenis=='narasumber')
        {
            $d_eval=Evaluasipeserta::where('fasilitasi_id',$idfasil)
                        ->where('jenis','narasumber')
                        ->with('narasumber')->with('fasilitasi')
                        ->get();
        }
        if($narsum->narsum_1_id!=0)
        {
            $d_narsum[$narsum->narsum_1_id]=$narsum->narsum1->profile->name;
        }
        if($narsum->narsum_2_id!=0)
        {
            $d_narsum[$narsum->narsum_2_id]=$narsum->narsum2->profile->name;
        }

        if($jenis=='narasumber')
        {
            $item=Evaluasinarasumber::where('flag',1)->get();

            $d_eval=Evaluasipeserta::where('fasilitasi_id',$idfasil)
                        ->where('user_id',$iduser)
                        ->where('jam_ke','like',$jam_ke)
                        ->where('jenis','like','narasumber')
                        ->get();
            // dd($d_eval);
            foreach($d_eval as $kk => $vv)
            {
                $eval[$vv->nama_narasumber]=$vv->nama_narasumber;
                $evl[$vv->narasumber_id]=$vv;
            }
        }
        else
        {
            $i=Evaluasipenyelenggara::where('flag',1)->get();
            $item=array();
            foreach($i as $k=>$v)
            {
                $item[$v->id_parent][$v->id]=$v;
            }
        }

        $view='pages-admin.evaluasi.evaluasi-'.$jenis;
        return view($view)
            ->with('jenis',$jenis)
            ->with('d_narsum',$d_narsum)
            ->with('eval',$eval)
            ->with('evl',$evl)
            ->with('item',$item)
            ->with('idfasil',$idfasil);
    }
    public function form($jenis,$idfasil)
    {
        $d_narsum=$eval=array();
        $evl=array();
        $fasil=KegiatanFasilitasi::find($idfasil);
        $narsum=Narsumfasilitasi::where('fasilitasi_id',$idfasil)->first();
        if($narsum->narsum_1_id!=0)
        {
            $d_narsum[$narsum->narsum_1_id]=$narsum->narsum1->profile->name;
        }
        if($narsum->narsum_2_id!=0)
        {
            $d_narsum[$narsum->narsum_2_id]=$narsum->narsum2->profile->name;
        }
        if($jenis=='narasumber')
        {
            $item=Evaluasinarasumber::where('flag',1)->get();

            $d_eval=Evaluasipeserta::where('fasilitasi_id',$idfasil)->where('user_id',Auth::user()->id)->where('jenis','narasumber')->get();
            foreach($d_eval as $kk => $vv)
            {
                $eval[$vv->nama_narasumber]=$vv->nama_narasumber;
            }
        }
        else
        {
            $i=Evaluasipenyelenggara::where('flag',1)->get();
            $item=array();
            foreach($i as $k=>$v)
            {
                $item[$v->id_parent][$v->id]=$v;
            }
            $d_eval=Evaluasipeserta::where('fasilitasi_id',$idfasil)->where('user_id',Auth::user()->id)->where('jenis','penyelenggara')->get();
            foreach($d_eval as $kk => $vv)
            {
                $eval[$vv->penyelenggara_id]=$vv;
            }
        }
        
        $view='pages-admin.evaluasi.evaluasi-'.$jenis;
        return view($view)
            ->with('jenis',$jenis)
            ->with('d_narsum',$d_narsum)
            ->with('eval',$eval)
            ->with('evl',$evl)
            ->with('item',$item)
            ->with('idfasil',$idfasil);
    }

    public function simpan(Request $request,$jenis,$idfasil)
    {
        $fasil=KegiatanFasilitasi::find($idfasil);
        if($jenis=='narasumber')
        {

            list($idnarsum,$narsum)=explode('__',$request->nama_narasumber);
            foreach($request->butir as $k=>$v)
            {
                $sv=new Evaluasipeserta; 
                $sv->user_id=Auth::user()->id;
                $sv->narasumber_id=$k;
                $sv->nama_narasumber=$idnarsum;
                $sv->materi_fasilitasi=$request->materi_fasilitasi;
                $sv->jam_ke=$request->jam_ke;
                $sv->jenis=$jenis;
                $sv->pilihan=$v;
                $sv->fasilitasi_id=$idfasil;
                $sv->save();
            }
            $pesan='Anda Sudah Mengisi Evaluasi untuk : <br><b>Narasumber : '.$narsum.'<br>Materi : '.$request->materi_fasilitasi.'<br><div class="text-center">Silahkan Isi Kembali Untuk Narasumber dan Materi Lain</div>';
        }
        else
        {
            echo '<pre>';
            print_r($request->all());
            echo '</pre>';
            $saran=$request->saran;
            foreach($request->pilihan as $k=>$v)
            {
                $sarann=(isset($saran[$k]) ? $saran[$k] : '');

                $sv=new Evaluasipeserta; 
                $sv->user_id=Auth::user()->id;
                $sv->penyelenggara_id=$k;
                $sv->jenis=$jenis;
                $sv->pilihan=$v;
                $sv->saran=$sarann;
                $sv->fasilitasi_id=$idfasil;
                $sv->save();
            }
            $pesan='Terima Kasih Anda Sudah Mengisi Evaluasi Penyelenggaraan Fasilitasi';
        }
        return redirect('penilaian-narasumber-dan-penyelenggaraan/'.Auth::user()->id.'/'.$idfasil)->with('hasil',$pesan);
    }
}
