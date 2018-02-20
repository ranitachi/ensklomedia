<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Model\Category;
use App\Model\Video;
use File;
class UploadController extends Controller
{
    public function index()
    {
        $id=abs(crc32(sha1(md5(rand()))));
        $cat=Category::orderBy('name')->get();
        return view('pages.video.upload')
            ->with('id',$id)
            ->with('cat',$cat);
    }
    
    public function myvideo()
    {
        $id=abs(crc32(sha1(md5(rand()))));
        $cat=Category::orderBy('name')->get();
        return view('pages.video.upload')
            ->with('id',$id)
            ->with('cat',$cat);
    }

    public function videosave(Request $request)
    {
        if( $request->hasFile('file') ) {
            $name=date('Ymd').'-'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('uploadfiles/video/'), $name);
            $id=$request->input('id');
            
            $filepath = public_path('uploadfiles/video').'/'.$name;
            $type = File::extension($filepath);
            $sv=new Video;
            $sv->id=$id;
            $sv->user_id=1;
            $sv->category_id=0;
            $sv->video_path=$name;
            $sv->save();
        }
    }
    public function removefile(Request $request,$id)
    {
        $filename=$request->input('name');
        $filepath = public_path('uploadfiles/video').'/'.$filename;
        Video::find($id)->delete();
        File::delete($filepath);
    }
    public function store(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        $d=$request->all();
        $name=$type='';
        if( $request->hasFile('cover') ) {
            $name=date('Ymd').'-'.$request->file('cover')->getClientOriginalName();
            $request->file('cover')->move(public_path('uploadfiles/image/'), $name);
            $filepath = public_path('uploadfiles/image').'/'.$name;
            $type = File::extension($filepath);
        }

        $id=$d['id'];
        $edit=Video::find($id);
        $edit->category_id=$d['category_id'];
        $edit->title=$d['title'];
        //$edit->filetype=$type;
        $edit->desc=$d['description'];
        $edit->tags=$d['tags'];
        $edit->image_path=$name;
        //$edit->statusaktif=1;
        $edit->slug=str_slug($d['title'], '-');
        //$edit->created_at=date('Y-m-d H:i:s');
        //$edit->updated_at=date('Y-m-d H:i:s');
        $edit->save();

        return redirect('upload')->with('status', 'Video Baru Berhasil Di Simpan');
    }
}
