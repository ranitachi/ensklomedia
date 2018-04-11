<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Narsumfasilitasi;
use App\Model\KegiatanFasilitasi;
class NarsumfasilitasiController extends Controller
{
    public function store(Request $request)
    {
       
        $data=$request->all();
        $data_fas=KegiatanFasilitasi::with('provinsi')->where('id','=',$request->narsumidfasilitasi)->get()->first();
        if(count($request->id_narsum)==2)
        {
            $narsum1=$data['id_narsum'][0];
            $narsum2=$data['id_narsum'][1];
        }
        else if(count($request->id_narsum)==1)
        {
            $narsum1=$data['id_narsum'][0];
            $narsum2='';
        }
        else
            $narsum1=$narsum2='';

        if($narsum1!='')
        {
            $cek=Narsumfasilitasi::where('fasilitasi_id','=',$request->narsumidfasilitasi)->get()->first();
            if(count($cek)!=0)
            {
                $cek->narsum_1_id=$narsum1;
                $cek->narsum_2_id=$narsum2;
                $cek->save();
            }
            else
            {
                $fas=new Narsumfasilitasi;
                $fas->narsum_1_id=$narsum1;
                $fas->narsum_2_id=$narsum2;
                $fas->fasilitasi_id=$request->narsumidfasilitasi;
                $fas->wilayah_id=$data_fas->wilayah_id;
                $fas->start_date=$data_fas->start_date;
                $fas->end_date=$data_fas->end_date;
                $fas->created_at=date('Y-m-d H:i:s');
                $fas->updated_at=date('Y-m-d H:i:s');
                $fas->save();
            }
            return redirect('fasilitasi')
                ->with('message', 'Berhasil Narasumber/Reviewer Pada Fasilitasi di '.$data_fas->provinsi->name.'.');
            // echo $data_fas->provinsi->name;
            // echo '<pre>';
            // print_r($request->all());
            // echo '</pre>';
        }
        else
        {
            return redirect('fasilitasi')
                ->with('error', 'Anda Belum Memilih Narasumber/Reviewer Untuk Fasilitasi di '.$data_fas->provinsi->name.'.');
        }
        // foreach($request->id_narsum as $k => $v)
        // {

        // }
        
    }

    public function hapus($idnarsum,$index)
    {
        $nar=Narsumfasilitasi::find($idnarsum);

        if($index==1)
        {
            $data['narsum_1_id']=null;
        }
        else if($index==2)
        {
            $data['narsum_2_id']=null;
        }

        $update=$nar->update($data);
        return response()->json([$update]);
    }
}
