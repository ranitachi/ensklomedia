<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Video;
use App\Model\Saung;
use App\Model\Profile;
use App\Model\SaungActivity;
use App\Model\SaungPivot;
use App\Model\KegiatanFasilitasi;
use App\Model\PesertaFasilitasi;
use App\Model\PetaMateri;
use App\Model\Category;
use App\Model\Endcards;
use App\Model\Topikturunan;
use App\Model\Narsumfasilitasi;
use App\Model\Users;
use App\Model\Notifikasi;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Auth;
use File;
class SaungController extends Controller
{
    public function buatsaung($slug)
    {
        $video=$endcards=$saung=$pesertasaung=array();
        $id=-1;
        $status='v1';
        if($slug!=-1)
        {
            $video = Video::where('slug','=',$slug)->get()->first();
            $id=$video->id;

            $myfile=public_path('uploadfiles/video').'/'.$video->video_path;
            // $vid="http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/video/".$video->video_path;
            $vid="http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/video/".$video->video_path;
            $cover="http://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/image/".$video->image_path;
            if(File::exists($myfile))
            {
                $status='v2';
                $vv = 'uploadfiles/video/'.$video->video_path;
                $cv = 'uploadfiles/image/'.$video->image_path;
                $vid=url($vv);
                $cover=url($cv);
            }
            $mime = "video/mp4";

            $endcards=Endcards::where('video_id','=',$id)->whereNotNull('link')->get();
            $saung=Saung::with('user')->with('reviewer')->where('video_id','=',$video->id)->get()->first();
            $pesertasaung=SaungPivot::where('saung_id','=',$saung->id)->where('flag','=','1')->with('user')->get();
        }
        $peserta=Users::whereIn('authorization_level',[3,4])->get();
        $det=array();
        $idtopik='-1';
        $profil=Profile::all();
        $pr=array();
        foreach($profil as $k => $v)
        {
            $pr[$v->user_id]=$v;
        }
        // echo $vid;
        //$e_cards=json_encode($endcards);
        return view('pages-admin.saung.index')
                ->with('id',$id)
                ->with('idtopik',$idtopik)
                ->with('peserta',$peserta)
                ->with('status',$status)
                ->with('pesertasaung',$pesertasaung)
                ->with('saung',$saung)
                ->with('endcards',$endcards)
                ->with('slug',$slug)
                ->with('det',$det)
                ->with('profile',$pr)
                ->with('video',$video)
                ->with(compact('vid', 'mime','cover'));
    }

    public function show($id)
    {
        $det=array();
        if($id!=-1)
        {
            $det=Topikturunan::find($id);
        }
        return view('pages-admin.saung.form-topik')
                ->with('idtopik',$id)
                ->with('det',$det);
    }

    public function createsaung($idvid)
    {
        $video=Video::find($idvid);
        $saung['fasilitasi_id']=0;
        $id_notif=-1;
        $cek_pes=PesertaFasilitasi::where('user_id','=',Auth::user()->id)
                    ->where('flag','=','1')->get()->first();
        $saung['reviewer_id']=0;
        if(count($cek_pes)!=0)
        {
            $saung['fasilitasi_id']=$cek_pes->fasilitasi_id;
            $narsum=Narsumfasilitasi::where('fasilitasi_id','=',$cek_pes->fasilitasi_id)->where('flag','=',1)->get()->first();
            if(!is_null($narsum->narsum_1_id) && !is_null($narsum->narsum_2_id))
            {
                $n1=$narsum->narsum_1_id;
                $n2=$narsum->narsum_2_id;
                $reviewer_id=rand($n1,$n2);
            }
            else if(!is_null($narsum->narsum_1_id) && is_null($narsum->narsum_2_id))
            {
                $n1=$narsum->narsum_1_id;
                $reviewer_id=$n1;
            }
            else if(is_null($narsum->narsum_1_id) && !is_null($narsum->narsum_2_id))
            {
                $n2=$narsum->narsum_2_id;
                $reviewer_id=$n2;
            }
            else
                $n=$reviewer_id=0;

        }
        else
        {
            $getreviewer=Users::where('authorization_level',3)->orderByRaw('RAND()')->limit(1)->first();
            $n=$reviewer_id=$getreviewer->id;
            
            $notif=new Notifikasi;
            $notif->video_id=$idvid;
            $notif->saung_id='-1';
            $notif->title="-";
            $notif->url="-";
            $notif->from=Auth::user()->id;
            $notif->to=$reviewer_id;
            $notif->created_at=date('Y-m-d H:i:s');
            $notif->updated_at=date('Y-m-d H:i:s');
            $notif->save();

            $id_notif=$notif->id;
        }
        $saung['reviewer_id']=$reviewer_id;
        $saung['saung_name']= $namasaung= 'Saung : '.$video->title;
        $saung['video_id']=$idvid;
        $saung['created_user_id']=Auth::user()->id;
        $saung['flag']=0;
        $saung['updated_at']=date('Y-m-d H:i:s');
        $saung['created_at']=date('Y-m-d H:i:s');
        $create=Saung::create($saung);
        $idsg=$create->id;

        if($id_notif!=-1)
        {   
            
            $upd_notif=Notifikasi::find($id_notif);
            $upd_notif->title="Anda Menjadi Reviewer untuk Saung <b>:".$video->title.'</b>';
            $upd_notif->saung_id=$idsg;
            $upd_notif->url=url('buka-saung/'.str_slug($video->title));
            $upd_notif->updated_at=date('Y-m-d H:i:s');
            $upd_notif->save();
        }

        return response()->json([$create]);

        // return redirect('buka-saung/'.$video->slug)->with('status', 'Anda Berhasil Membuka Saung Diskusi Baru');
    }

    public function tutupsaung($idsaung,$slug)
    {
        $data['flag']=0;
        $data['deleted_at']=date('Y-m-d H:i:s');
        $update=Saung::find($idsaung)->update($data);
        // return redirect('buka-saung/'.$slug)->with('status', 'Anda Berhasil Menutup Saung Diskusi');
        return redirect('watch/'.$slug)->with('status', 'Anda Berhasil Menutup Saung Diskusi');
    }

    public function joinsaung($idvid)
    {
        $saung=Saung::where('video_id','=',$idvid)->orderByRaw('RAND()')->limit(1)->get()->first();

        $data['saung_id']=$saung->id;
        $data['user_id']=Auth::user()->id;
        $data['flag']=0;
        $create=SaungPivot::create($data);
        return response()->json([$create]);
    }
    
    public function gabungsaung($idsaung,$idvid)
    {
        $saung=Saung::find($idsaung);
        $pivot=SaungPivot::where('saung_id','=',$idsaung)->where('user_id','=',Auth::user()->id)->first();
        $pivot->flag=1;
        $pivot->save();

        $notif=Notifikasi::where('saung_id','=',$idsaung)->where('to','=',Auth::user()->id)->first();
        $notif->seen=date('Y-m-d H:i:s');
        $notif->flag_active=0;
        $notif->save();

        return redirect('buka-saung/'.$saung->video->slug)->with('status', 'Anda Berhasil Ikut Bergabung Dalam Saung Diskusi Ini');
        //return response()->json(['done']);
    }
    public function destroy($idsaung)
    {
        Saung::find($idsaung)->delete();
    }
}
