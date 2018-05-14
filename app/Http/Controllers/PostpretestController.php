<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Postpretest;
use App\Model\Answerpostpretest;
use App\Model\Testpesertaset;
use App\Model\Nilaitespeserta;
use Auth;
class PostpretestController extends Controller
{
    public function soal($jenis,$idfasil,$id,$no)
    {
        $jenis=strtolower($jenis);
        $soal=Answerpostpretest::where('question_id',$id)->with('test')->orderByRaw('RAND()')->get();
        if($jenis=='post')
            $view='pages-admin.pre-post-test.postest';
        else
            $view='pages-admin.pre-post-test.pretest';
        
        $jawaban=Testpesertaset::where('user_id',Auth::user()->id)->where('fasilitasi_id',$idfasil)->where('question_id',$id)->where('jenis','=',$jenis)->get();
        
        $jwb=array();
        foreach($jawaban as $k => $v)
        {
            $jwb[$v->answer_id]=$v;
        }    
       
        return view($view)
                ->with('jenis',$jenis)
                ->with('idfasil',$idfasil)
                ->with('no',$no)
                ->with('jwb',$jwb)
                ->with('soal',$soal)
                ->with('id',$id);
        
    }
    public function jawabsoal($idsoal,$idjawaban,$idfasil,$jenis)
    {
        $cek=Testpesertaset::where('user_id',Auth::user()->id)
                    ->where('question_id',$idsoal)
                    ->where('jenis',$jenis)
                    ->where('fasilitasi_id',$idfasil)
                    ->first();
        $nilai=0;  
        $ceknilai=Answerpostpretest::find($idjawaban);
        if(count($ceknilai)!=0)
            $nilai=$ceknilai->flag;

        if(count($cek)!=0)
        {
            $cek->answer_id=$idjawaban;
            $cek->jawaban=$nilai;
            $cek->save();
            $hsl=$cek;
        }
        else
        {
            $new=new Testpesertaset;
            $new->answer_id=$idjawaban;
            $new->question_id=$idsoal;
            $new->jawaban=$nilai;
            $new->jenis=$jenis;
            $new->user_id=Auth::user()->id;
            $new->fasilitasi_id=$idfasil;
            $new->save();
            $hsl=$new;
        }
        if($hsl)
            echo 1;
        else
            echo 0;
    }

    public function simpantest($jenis,$idfasil)
    {
        $jenis=strtolower($jenis);
        $cek=Testpesertaset::where('user_id',Auth::user()->id)
                    ->where('jenis',$jenis)
                    ->where('fasilitasi_id',$idfasil)
                    ->get();
        $nilai=0;
        foreach($cek as $k=>$v)
        {
            $nilai+=$v->jawaban;
        }
        $ceknilai=Nilaitespeserta::where('jenis','=',$jenis)->where('fasilitasi_id',$idfasil)->where('user_id',Auth::user()->id)->first();
        // echo count($ceknilai);
        if(count($ceknilai)==0)
        {
            $save=new Nilaitespeserta;
            $save->user_id=Auth::user()->id;
            $save->nilai=$nilai;
            $save->jenis=$jenis;
            $save->fasilitasi_id=$idfasil;
            $save->save();
        }

        return redirect($jenis.'-test/'.Auth::user()->id.'/'.$idfasil)->with('hasil','Anda Telah Menyelesaikan '.ucwords($jenis).' Test dengan <br><b style="font-size:15px;"><u>Nilai : '.$nilai.'</u></b>');
        // Nilaitespeserta
    }
}
