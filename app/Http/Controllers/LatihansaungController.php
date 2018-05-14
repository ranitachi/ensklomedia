<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Test;
use App\Model\AnswerTest;
use App\Model\Users;
use App\Model\Saung;
use App\Model\Latihansaung;
use Auth;
class LatihansaungController extends Controller
{
    public function index($idsaung)
    {
        $saung=array();
        if($idsaung!=-1)
        {
            $saung=Saung::find($idsaung);
        }
        return view('pages-admin.latihan.index')
                ->with('idsaung',$idsaung)
                ->with('saung',$saung);
    }

    public function data($idsaung)
    {
        $latihan=Latihansaung::where('saung_id','=',$idsaung)->with('saung')->with('test')->get();
        return view('pages-admin.latihan.data')
                ->with('idsaung',$idsaung)
                ->with('latihan',$latihan);
    }
    public function show($idsaung,$id)
    {
        $saung=Saung::find($idsaung);
        $question='';
        $det=array();
        if($id!=-1)
        {
            // $det=Latihansaung::where('id','=',$id)->first();
            $det=AnswerTest::where('question_id','=',$id)->get();  
            $question=$det[0]->test->question;
        }
        return view('pages-admin.latihan.form')
                ->with('id',$id)
                ->with('idsaung',$idsaung)
                ->with('det',$det)
                ->with('question',$question)
                ->with('saung',$saung);
    }
    public function hapus($id,$idsaung)
    {
        // $latihan=Test::find($id);
        // $answer=AnswerTest::where('question_id','=',$id)->get();
        $latihansaung=Latihansaung::where('test_id','=',$id)->where('saung_id','=',$idsaung)->first();
        $x=$latihansaung->delete();
        if($x)
            return response()->json(['done']);
        else
            return response()->json(['fail']);
    }

    public function simpan(Request $request,$idsaung,$id)
    {
        if($id!=-1)
        {
            $test = Test::find($id);
            $tagsToStrip = array('@<script[^>]*?>.*?</script>@si'); // you can add more
            $soal = preg_replace($tagsToStrip, '-', $request->pertanyaan);
            $test->question=$soal;
            $test->save();
            
            AnswerTest::where('question_id','=',$id)->forceDelete();
            $idsoal=$id;
            foreach($request->jawaban as $idx => $val)
            {
                $ans=new AnswerTest;
                $ans->question_id=$idsoal;
                $ans->answer=$val;
                $ans->flag=($idx==1 ? 1 : 0);
                $ans->created_at=date('Y-m-d H:i:s');
                $ans->updated_at=date('Y-m-d H:i:s');
                $ans->save();
            }
            return response()->json(['done']);
        }
        else
        {
            $test = new Test;
            $tagsToStrip = array('@<script[^>]*?>.*?</script>@si'); // you can add more
            $soal = preg_replace($tagsToStrip, '-', $request->pertanyaan);
            $test->question=$soal;
            $test->category='choice';
            $test->flag=1;
            $test->user_id=Auth::user()->id;
            $test->save();

            $idsoal=$test->id;
            foreach($request->jawaban as $idx => $val)
            {
                $ans=new AnswerTest;
                $ans->question_id=$idsoal;
                $ans->answer=$val;
                $ans->flag=($idx==1 ? 1 : 0);
                $ans->created_at=date('Y-m-d H:i:s');
                $ans->updated_at=date('Y-m-d H:i:s');
                $ans->save();
            }
            
            $latihan['test_id']=$idsoal;
            $latihan['saung_id']=$idsaung;
            $latihan['flag']=1;
            $create=Latihansaung::create($latihan);
            return response()->json([$create]);
        }
        // print_r($request->all());
    }

    public function question($id,$idsaung)
    {
        $test=AnswerTest::where('question_id','=',$id)->with('test')->get();
        $question=$test[0]->test->question;
        return view('pages-admin.latihan.detail')
                ->with('id',$id)
                ->with('idsaung',$idsaung)
                ->with('question',$question)
                ->with('test',$test); 
    }
}
