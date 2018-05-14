<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Topiktantangan;
use App\Model\Saung;
use App\Model\Video;
use App\Model\TopikMateri;
use App\Model\Pesertatantangan;
use App\Model\Category;
use App\Model\PetaMateri;
use App\Model\Notifikasi;
use Auth;
class TopiktantanganController extends Controller
{
    public function data($idsaung)
    {
        // ->where('saung_id','=',$saung_id)
        $saung=Saung::find($idsaung);
        $data=Topiktantangan::where('video_id','=',$saung->video_id)
                ->where('saung_id','=',$idsaung)
                ->where('flag','=','1')
                ->get();
        // echo $saung->video_id;
        $pesertatantangan=Pesertatantangan::where('saung_id',$idsaung)->where('penjelasan','like',$saung->video_id.'::%')->get();
        $psr=array();
        // dd($pesertatantangan);
        foreach($pesertatantangan as $k=>$v)
        {
            $psr[$v->tantangan_id]=$v;
        }

        return view('pages-admin.saung.topik-tantangan')
                ->with('idvideo',$saung->video_id)
                ->with('peserta_ttg',$psr)
                ->with('data',$data);
    }

    public function form($idsaung,$id)
    {
        $saung=Saung::find($idsaung);
        // echo $saung->video->mapel_id;
        $data=array();
        if($id!=-1)
        {
            $data=Topiktantangan::find($id);
        }
        if($saung->video->mapel_id!='')
            $tm=TopikMateri::where('mapel_id','=',$saung->video->mapel_id)->get();
        else
            $tm=TopikMateri::where('category_id','=',$saung->video->category_id)->get();
        
        if(count($tm)==0)
            $tm=TopikMateri::where('category_id','=',$saung->video->category_id)->get();

        return view('pages-admin.tantangan.form')
            ->with('data',$data)
            ->with('id',$id)
            ->with('topikmateri',$tm)
            ->with('idsaung',$idsaung);
    }
    public function simpan(Request $request,$idsaung,$id)
    {
        $saung=Saung::find($idsaung);
        
        if($id==-1)
        {
            // $tt=new Topiktantangan;
            $tt=new TopikMateri;
        }
        else
        {
            // $tt=Topiktantangan::find($id);
            $tt=TopikMateri::find($id);
        }
        $tt->category_id=$saung->video->category_id;
        $tt->mapel_id=$saung->video->mapel_id;
        $tt->title=$request->tantangan;
        $tt->desc=$request->penjelasan;
        $tt->flag=1;
        $tt->created_at=date('Y-m-d H:i:s');
        $tt->updated_at=date('Y-m-d H:i:s');
        $tt->save();

        if($id==-1)
        {
            $tt2=new Topiktantangan;
        }
        else
        {
            $tt2=Topiktantangan::find($id);
        }
        $tt2->video_id=$saung->video_id;
        $tt2->saung_id=$idsaung;
        $tt2->topik=$request->tantangan;
        $tt2->penjelasan=$request->keterangan;
        $tt2->flag=1;
        $tt2->created_at=date('Y-m-d H:i:s');
        $tt2->updated_at=date('Y-m-d H:i:s');
        $save=$tt2->save();

        if($save)
            return response()->json(['done']);
        else
            return response()->json(['fail']);
    }
    public function hapusmateri($id)
    {
        $t=Topiktantangan::find($id);
        $category_id=$t->video->category_id;
        $tm=TopikMateri::where('category_id','=',$category_id)->where('title','=',$t->topik)->first();
        $tm->delete();
        $t->delete();
        return response()->json(['done']);
    }

    public function ikuttantangan($idsaung,$idvideo,$idtantangan)
    {
        $id=abs(crc32(sha1(md5(rand()))));
        $id=substr($id,0,8);
        $cat=Category::orderBy('name')->get();
        $saung=Saung::find($idsaung);
        $tantangan=Topiktantangan::where('id',$idtantangan)->with('video')->first();
        $petamateri=PetaMateri::all();
        $pm=array();
        foreach($petamateri as $k => $v)
        {
            $pm[$v->category_id][$v->id]=$v;
        }
        return view('pages-admin.tantangan.upload')
                ->with('id',$id)
                ->with('cat',$cat)
                ->with('pm',$pm)
                ->with('saung',$saung)
                ->with('idsaung',$idsaung)
                ->with('tantangan',$tantangan)
                ->with('idvideo',$idvideo)
                ->with('idtantangan',$idtantangan);
    }

    public function videotantangan(Request $request,$idtantangan,$idsaung)
    {
        // dd($request->all());
        $saung=Saung::find($idsaung);
        $reviewer_id=$saung->reviewer_id;
        $superuser_id=$saung->fasilitasi_id;

        $name=$type='';
        if( $request->hasFile('cover') ) {
            $name=date('Ymd').'-'.$request->file('cover')->getClientOriginalName();
            $request->file('cover')->move(public_path('uploadfiles/image/'), $name);
            $filepath = public_path('uploadfiles/image').'/'.$name;
            $type = File::extension($filepath);
        }

        $id=$request->id;
        $edit=Video::find($id);
        $edit->category_id=$request->input('category_id');
        
        $tagsToStrip = array('@<script[^>]*?>.*?</script>@si'); // you can add more
        $m_title = preg_replace($tagsToStrip, '-', $request->input('title'));
        $edit->title=$m_title;
        //$edit->filetype=$type;
        
        $tagsToStrip = array('@<script[^>]*?>.*?</script>@si'); // you can add more
        $m_description = preg_replace($tagsToStrip, '-', $request->input('description'));
        $edit->desc=$m_description;

        $tagsToStrip = array('@<script[^>]*?>.*?</script>@si'); // you can add more
        $m_tags = preg_replace($tagsToStrip, '-', $request->input('tags'));
        $edit->tags=$m_tags;
        $edit->id_mapel=$request->mapel_id;
        $edit->reviewer_id = $reviewer_id;
        // $edit->active_by=$superuser_id;
        // $edit->flag_active=date('Y-m-d H:i:s');
        $edit->image_path=$name;
        $edit->slug=str_slug($request->title, '-');
        $edit->save();

        $pes_tan=new Pesertatantangan;
        $pes_tan->video_id=$id;	
        $pes_tan->user_id=Auth::user()->id;
        $pes_tan->saung_id=$idsaung;
        $pes_tan->tantangan_id=$idtantangan;
        $pes_tan->judul=$request->title;
        $pes_tan->penjelasan=$saung->video_id.'::'.$id.'::reviewer_id:'.$reviewer_id;
        $pes_tan->flag=1;
        $pes_tan->created_at=date('Y-m-d H:i:s');
        $pes_tan->updated_at=date('Y-m-d H:i:s');
        $pes_tan->save();

        $notif=new Notifikasi;
        $notif->video_id=$id;
        $notif->saung_id=$idsaung;
        $notif->title="Anda Diundang Mendapatkan 1 Video untuk di Verifikasi";
        $notif->url=url('video-verifikasi');
        $notif->from=Auth::user()->id;
        $notif->to=$superuser_id;
        $notif->created_at=date('Y-m-d H:i:s');
        $notif->updated_at=date('Y-m-d H:i:s');
        $notif->save();

        return redirect('buka-saung/'.$saung->video->slug)->with('status', 'Video Tantangan Berhasil Di Simpan, dan akan Segera Di Verifikasi dan Review');
    }
}
