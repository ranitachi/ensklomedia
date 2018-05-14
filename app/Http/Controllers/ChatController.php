<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Saung;
use App\Model\Chat;
use App\Model\Video;
use App\Model\Users;

use Auth;
class ChatController extends Controller
{
    public function data($idsaung)
    {
        $saung=Saung::find($idsaung);
        $chat=Chat::where('saung_id','=',$idsaung)->with('saung')->with('user')->get();
        return view('pages-admin.saung.chat')
            ->with('chat',$chat)
            ->with('saung',$saung);
    }
    public function store(Request $request,$idsaung)
    {
        $iduser=Auth::user()->id;
        $user=Users::where('id','=',$iduser)->with('profile')->get()->first();
        $saung=Saung::find($idsaung);
        if($saung->created_user_id==$iduser)
        {
            $nama_user='Moderator';
        }
        else
        {
            $nama_user=$user->profile->name;
        }

        if($saung->reviewer_id==$iduser)
        {
            $nama_user='Reviewer';
        }

        $tagsToStrip = array('@<script[^>]*?>.*?</script>@si'); // you can add more
        $message = preg_replace($tagsToStrip, '-', $request->usermsg);
        $usermsg = $message;

        $data['chat']='<div class="msgl">['.date('H:i').'] <b>'.$nama_user.'</b>: '.$usermsg.'<br></div>';
        $data['user_id']=$iduser;
        $data['saung_id']=$idsaung;
        $data['flag']=1;

        $data2=array();
        foreach($data as $k => $v)
        {
            $tagsToStrip2 = array('@<script[^>]*?>.*?</script>@si'); // you can add more
            $message2 = preg_replace($tagsToStrip2, '-', $v);
            $data2[$k]=$message2;
        }

        $create=Chat::create($data2);
        return response()->json([$create]); 
    }
}
