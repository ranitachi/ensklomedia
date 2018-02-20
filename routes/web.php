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
//     return view('welcome');
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

Route::resource('upload','UploadController');
Route::post('/videosave','UploadController@videosave')->name('upload.simpan');
Route::post('/removefile/{id}','UploadController@removefile')->name('video.remove');
Route::post('video-saya','UploadController@myvideo')->name('video.myvideo');

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
