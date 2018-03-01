<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     // $cat=App\Model\Category::all();
//     // foreach($cat as $k => $v)
//     // {
//     //     $up=App\Model\Category::find($v->id);
//     //     $up->slug=str_slug($v->name);
//     //     $up->save();
//     //     // echo $v->id.'-'.str_slug($v->name).'<br>';
        
//     // }
//     $vid=App\Model\Video::all();
//     foreach($vid as $k => $v)
//     {
//         $d=strtok($v->video_path,'-');
//         $thn=substr($d,0,4);
//         $bln=substr($d,4,2);
//         $tgl=substr($d,6,4);
//         $tgl=$thn.'-'.$bln.'-'.$tgl.' '.date('H:i:s');
//         $up=App\Model\Video::find($v->id);
//         $up->created_at=$tgl;
//         $up->updated_at=$tgl;
//         $up->save();
//     }
// });

Auth::routes();

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/watch/{slug}', 'DashboardController@watch')->name('watch');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/trending', 'DashboardController@trending')->name('trending');

Route::resource('category','CategoryController');
Route::get('/category-data/{id}','CategoryController@data')->name('category.data');
Route::get('/category-form/{id}','CategoryController@show')->name('category.form');

Route::resource('upload','UploadController')->middleware('auth');
Route::post('/videosave','UploadController@videosave')->name('upload.simpan')->middleware('auth');
Route::post('/removefile/{id}','UploadController@removefile')->name('video.remove')->middleware('auth');
Route::post('video-saya','UploadController@myvideo')->name('video.myvideo')->middleware('auth');

Route::post('cari','SearchController@search')->name('search.cari');
Route::get('autocomplete','SearchController@autocomplete')->name('search.auto');

Route::get('/video-add-hit/{id}','UploadController@addhit');
Route::get('/player/{filename}', 'DashboardController@player');
Route::get('/video/{filename}', function ($filename) {
    // Pasta dos videos.
    $videosDir = base_path('public/uploadfiles/video');
    // echo $videosDir;
    if (file_exists($filePath = $videosDir."/".$filename)) {
        $stream = new App\Http\VideoStream($filePath);
        return response()->stream(function() use ($stream) {
            $stream->start();
        });
    }
    return response("File doesn't exists", 404);
});

Route::get('video/category/{slug}', 'VideoCategoryController@index')->name('video.bycategory');

Route::get('/login/{social}','Auth\LoginController@socialLogin')
        ->where('social','twitter|facebook|linkedin|google|github');
Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')
        ->where('social','twitter|facebook|linkedin|google|github');
Route::get('logout', 'Auth\LoginController@logout');