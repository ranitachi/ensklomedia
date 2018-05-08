<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Evaluasinarasumber;
use App\Model\Evaluasipenyelenggara;
use App\Model\Evaluasipeserta;
use App\Model\KegiatanFasilitasi;
use Auth;
class Evaluasicontroller extends Controller
{
    public function form($jenis,$idfasil)
    {
        $fasil=KegiatanFasilitasi::find($idfasil);
        if($jenis=='narasumber')
            $item=Evaluasinarasumber::where('flag',1)->get();
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
            ->with('item',$item)
            ->with('idfasil',$idfasil);
    }

    public function simpan(Request $request,$jenis,$idfasil)
    {
        $fasil=KegiatanFasilitasi::find($idfasil);
        if($jenis=='narasumber')
        {

            foreach($request->butir as $k=>$v)
            {
                $sv=new Evaluasipeserta; 
                $sv->user_id=Auth::user()->id;
                $sv->narasumber_id=$k;
                $sv->nama_narasumber=$request->nama_narasumber;
                $sv->materi_fasilitasi=$request->materi_fasilitasi;
                $sv->jam_ke=$request->jam_ke;
                $sv->jenis=$jenis;
                $sv->pilihan=$v;
                $sv->fasilitasi_id=$idfasil;
                $sv->save();
            }
            $pesan='Anda Sudah Mengisi Evaluasi untuk : <br><b>Narasumber : '.$request->nama_narasumber.'<br>Materi : '.$request->materi_fasilitasi.'<br><div class="text-center">Silahkan Isi Kembali Untuk Narasumber dan Materi Lain</div>';
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
