<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Topikturunan;
use App\Model\Video;
use App\Model\Saung;
use App\Model\SaungActivity;
use Auth;
class TopikturunanController extends Controller
{
    public function store(Request $request)
    {
        $slug=$request->slug;
        $topik=new Topikturunan;
        $topik->video_id=$request->video_id;
        $topik->user_created_id=Auth::user()->id;
        $topik->topik=$request->topik;
        $topik->penjelasan=$request->penjelasan;
        $topik->flag=$request->flag;
        $topik->created_at=date('Y-m-d H:i:s');
        $topik->updated_at=date('Y-m-d H:i:s');
        $topik->save();
        // echo $slug;
        //$saung=Saung::where('video_id','=',$request->video_id)->get()->first();
        $activity=new SaungActivity;
        $activity->saung_id=$request->saung_id;
        $activity->user_id=Auth::user()->id;
        $activity->activity='Guru Menambahkan Topik Turunan Baru : '.$request->topik;
        $activity->created_at=date('Y-m-d H:i:s');
        $activity->updated_at=date('Y-m-d H:i:s');
        $activity->save();

        return redirect('buka-saung/'.$slug)->with('status', 'Topik Turunan Berhasil Ditambahkan');
    }

    public function update(Request $request,$id)
    {
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        $slug=$request->slug;
        $topik=Topikturunan::find($id);
        $topiklama=$topik->topik;
        $topik->topik=$request->topik;
        $topik->penjelasan=$request->penjelasan;
        $topik->flag=$request->flag;
        $topik->updated_at=date('Y-m-d H:i:s');
        $topik->save();

        $activity=new SaungActivity;
        $activity->saung_id=$request->saung_id;
        $activity->user_id=Auth::user()->id;
        $activity->activity='Guru Mengedit Topik Turunan : #'.$topiklama.' Menjadi : '.$request->topik;
        $activity->created_at=date('Y-m-d H:i:s');
        $activity->updated_at=date('Y-m-d H:i:s');
        $activity->save();
        // echo $slug;
        return redirect('buka-saung/'.$slug)->with('status', 'Topik Turunan Berhasil Di Edit');
    }

    public function data($idvideo,$saung_id,$created_id)
    {
        // ->where('saung_id','=',$saung_id)
        $data=Topikturunan::where('video_id','=',$idvideo)
                ->where('user_created_id','=',$created_id)
                ->where('flag','=','1')
                ->get();
        return view('pages-admin.saung.topik-turunan')
                ->with('idvideo',$idvideo)
                ->with('data',$data)
                ->with('created_id',$created_id);
    }
    public function form($idvideo,$idtopik,$created_id,$idsaung)
    {
        // ->where('saung_id','=',$saung_id)
        $det=array();
        $video=Video::find($idvideo);
        if($idtopik!=-1)
        {
            $det=Topikturunan::find($idtopik);
        }
        return view('pages-admin.saung.form-topik')
                ->with('idvideo',$idvideo)
                ->with('idtopik',$idtopik)
                ->with('idsaung',$idsaung)
                ->with('video',$video)
                ->with('det',$det)
                ->with('created_id',$created_id);
    }

    public function penjelasan($idtopik)
    {
        $data=Topikturunan::find($idtopik);
            return view('pages-admin.saung.keterangan')
                ->with('idtopik',$idtopik)
                ->with('data',$data);
    }
       
}
