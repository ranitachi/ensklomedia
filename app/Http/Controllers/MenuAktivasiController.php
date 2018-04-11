<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Menu;
use App\Model\Pivot;
use App\Model\MenuPivot;
use App\Model\Users;
use App\Model\KegiatanFasilitasi;
use App\Model\MappingFasilitasi;
use App\Model\PesertaFasilitasi;
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
        $menupiv=MenuPivot::all();
        $menupivot=array();
        foreach($menupiv as $i => $v)
        {
            $menupivot[$v->menu_id][$v->fasilitasi_id]=$v;
        }
        $map=array();
        foreach($mapping as $i => $v)
        {
            $map[$v->user_id][$v->wilayah_id]=$v;
        }
        
        $pes=PesertaFasilitasi::select('*','peserta_fasilitasis.id as idpf')->join('profile','profile.user_id','=','peserta_fasilitasis.user_id')
            ->with('user')->get();
            
        $psrt=array();
        foreach($pes as $i => $v)
        {
            $psrt[$v->fasilitasi_id][]=$v;
        }

        if ($request->ajax()) {
             return view('pages-admin.menu-aktivasi.data')
               ->with('page',$page)
               ->with('menu',$ins)
               ->with('map',$map)
               ->with('psrt',$psrt)
               ->with('menupivot',$menupivot)
               ->with('mapping',$mapping)
               ->with('kegiatan',$kegiatan)
               ->with('hal',$page);
        }

        return view('pages-admin.menu-aktivasi.index')
                ->with('page',$page)
                ->with('mapping',$mapping)  
                ->with('psrt',$psrt)              
                ->with('map',$map)              
                ->with('kegiatan',$kegiatan)
               ->with('menupivot',$menupivot)                
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
}
