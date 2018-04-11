<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Instrumen;
use App\Model\Video;
use App\Model\Users;
use App\Model\Penilaian;
class PenilaianController extends Controller
{
    public function simpan(Request $request, $videoid)
    {
        $reviewer_id=$request->reviewer_id;
        $totalnilai=0;
        if(isset($request->nilai))
        {

            foreach($request->nilai as $idx => $val)
            {
                if($val!='')
                {
                    
                    $instrumen_id=$idx;
                    $nilai=$val;
                    $totalnilai+=$nilai;
                    $penilaian=new Penilaian;
                    $penilaian->instrumen_id=$instrumen_id;
                    $penilaian->reviewer_id=$reviewer_id;
                    $penilaian->video_id=$videoid;
                    $penilaian->nilai=$nilai;
                    $penilaian->flag=1;
                    $penilaian->created_at=date('Y-m-d H:i:s');
                    $penilaian->updated_at=date('Y-m-d H:i:s');
                    $penilaian->save();
                }
            }
        }
        if($totalnilai!=0)
        {
            return redirect('review')
            ->with('message', 'Video Sudah Di Berikan Penilaian Dengan Nilai : '.$totalnilai);
        }
        else
        {
            return redirect('review')
            ->with('message', 'Anda Belum Memberikan Nilai Untuk Video Ini');
        }
    }
}
