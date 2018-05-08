<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//https://ensiklomedia.tve.kemdikbud.go.id/uploadfiles/video/20171012-751Toturial%20CorelDraw%20X7.mp4
		$from=public_path('uploadfiles/video/20171012-751Toturial%20CorelDraw%20X7.mp4');
		$to=date('Y').'/'.date('n').'/'.date('d').'/20171012-751Toturial%20CorelDraw%20X7.mp4';
		//echo $file;
        // Flysystem::connection('ftp')->copy($from, $to);
        // Storage::disk('ftp')->put($dir.'/'.$name, $filepath);
//        return view('home');
    }
    public function simpan(Request $request)
    {
        if($request->hasFile('profile_image')) 
        {
            $filenamewithextension = $request->file('profile_image')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;
            $dir=date('Y').'/'.date('n').'/'.date('d');
            Storage::disk('ftp')->put($dir.'/'.$filenametostore, fopen($request->file('profile_image'), 'r+'));
        }

        return redirect('home-ftp')->with('status', "Image uploaded successfully.");
    }
}
