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
//     // $vid=App\Model\Video::all();
//     // foreach($vid as $k => $v)
//     // {
//     //     $d=strtok($v->video_path,'-');
//     //     $thn=substr($d,0,4);
//     //     $bln=substr($d,4,2);
//     //     $tgl=substr($d,6,4);
//     //     $tgl=$thn.'-'.$bln.'-'.$tgl.' '.date('H:i:s');
//     //     $up=App\Model\Video::find($v->id);
//     //     $up->created_at=$tgl;
//     //     $up->updated_at=$tgl;
//     //     $up->save();
//     // }
//     echo public_path();
// });


Auth::routes();

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/cekdurasi', 'DashboardController@durasi')->name('durasi');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/watch/{slug}', 'DashboardController@watch')->name('watch');
Route::get('/home', 'DashboardController@index')->name('home');
Route::get('/trending', 'DashboardController@trending')->name('trending');
Route::get('/like-video/{slug}', 'DashboardController@likevideo')->name('like');
Route::get('/download/{name}', 'DashboardController@download')->name('like');


Route::resource('category','CategoryController')->middleware('auth');;
Route::get('/category-data/{id}','CategoryController@data')->name('category.data');
Route::get('/category-form/{id}','CategoryController@show')->name('category.form');

Route::resource('menu-aktivasi','MenuAktivasiController')->middleware('auth');
Route::get('/menu-aktivasi-data/{id}','MenuAktivasiController@data')->name('menu-aktivasi.data')->middleware('auth');
Route::get('/menu-aktivasi-form/{id}','MenuAktivasiController@show')->name('menu-aktivasi.form')->middleware('auth');
Route::get('/menu-aktivasi-change-status/{idfasil}/{idmenu}/{st}','MenuAktivasiController@status')->name('menu-aktivasi.status')->middleware('auth');
Route::post('add-peserta-to-fasilitasi/simpan','MenuAktivasiController@simpanpeserta')->middleware('auth');
Route::get('hapus-peserta-fasilitasi/{id}','MenuAktivasiController@hapuspeserta')->middleware('auth');

Route::post('add-peserta-to-saung/simpan/{id}','MenuAktivasiController@simpanpesertasaung')->middleware('auth');

Route::resource('instrumen','InstrumenController')->middleware('auth');;
Route::get('/instrumen-data/{id}','InstrumenController@data')->name('instrumen.data');
Route::get('/instrumen-form/{id}','InstrumenController@show')->name('instrumen.form');
Route::get('/instrumen-change-status/{id}/{st}','InstrumenController@status')->name('instrumen.status');

Route::resource('fasilitasi','FasilitasiController')->middleware('auth');;
Route::get('/fasilitasi-data/{id}','FasilitasiController@data')->name('fasilitasi.data')->middleware('auth');
Route::get('/fasilitasi-form/{id}','FasilitasiController@show')->name('fasilitasi.form')->middleware('auth');
Route::get('/fasilitasi-change-status/{id}/{st}','FasilitasiController@status')->name('fasilitasi.status')->middleware('auth');
Route::post('/fasilitasi-simpan','FasilitasiController@simpan')->name('mapping-to-fasilitasi.simpan')->middleware('auth');
Route::get('/hapus-pic-fasilitasi/{id}','FasilitasiController@hapuspic')->name('hapus-pic-fasilitasi')->middleware('auth');
Route::get('/kegiatan-fasilitasi/{id}','FasilitasiController@fasilitasiuser')->name('fasilitasi.user')->middleware('auth');
Route::get('/aktivasi-peserta-change-status/{id}/{st}','FasilitasiController@aktivasipeserta')->name('fasilitasi.aktivasipeserta')->middleware('auth');
Route::get('cetak-sertifikat/{idfasilitas}','FasilitasiController@cetaksertifikat')->name('fasilitasi.cetaksertifikat')->middleware('auth');
Route::get('cetak/{userid}/{idfasilitas}','FasilitasiController@cetak')->name('fasilitasi.cetaksertifikat')->middleware('auth');


Route::post('narsum-to-fasilitasi','NarsumfasilitasiController@store')->name('narsum-to-fasilitasi.simpan')->middleware('auth');
Route::get('hapus-narsum-fasilitasi/{idnarsum}/{index}','NarsumfasilitasiController@hapus')->name('narsum-to-fasilitasi.hapus')->middleware('auth');

Route::get('form-biodata/{idvid}/{idfasil}','FasilitasiController@biodata')->middleware('auth');
Route::post('form-biodata-save/{id}/{idfasil}','FasilitasiController@biodatasave')->middleware('auth');

Route::get('pre-test/{id}/{idfasil}','FasilitasiController@pretest')->middleware('auth');
Route::get('post-test/{id}/{idfasil}','FasilitasiController@postest')->middleware('auth');
Route::get('penilaian-narasumber-dan-penyelenggaraan/{id}/{idfasil}','FasilitasiController@penilaianfeedback')->middleware('auth');
Route::get('evaluasi/{jenis}/{idfasil}','Evaluasicontroller@form')->middleware('auth');
Route::post('evaluasi-simpan/{jenis}/{idfasil}','Evaluasicontroller@simpan')->middleware('auth');

Route::get('soal-detail/{jenis}/{idfasil}/{id}/{no}','PostpretestController@soal')->middleware('auth');
Route::get('/jawab-soal/{idsoal}/{idjawaban}/{idfasil}/{jenis}', 'PostpretestController@jawabsoal')->middleware('auth');
Route::get('/end-test/{jenis}/{idfasil}','PostpretestController@simpantest')->name('penilaian.simpantest');

Route::post('/simpan-penilaian/{videoid}','PenilaianController@simpan')->name('penilaian.simpan');


Route::resource('petamateri','PetaMateriController');
Route::get('/petamateri-data/{id}','PetaMateriController@data')->name('petamateri.data');
Route::get('/petamateri-form/{idcat}/{id}','PetaMateriController@form')->name('petamateri.form');
Route::post('/petamateri-save/{idcat}/{id}','PetaMateriController@save')->name('petamateri.save');

Route::get('/topik-materi','PetaMateriController@topik')->name('topik.materi')->middleware('auth');
Route::post('/topik-materi-proses/{id}','PetaMateriController@topikproses')->name('topik.proses')->middleware('auth');
Route::get('/topik-materi-data','PetaMateriController@topikdata')->name('topik.data')->middleware('auth');
Route::get('/topik-materi-form/{idcat}/{idmapel}/{id}','PetaMateriController@topikform')->name('topik.form')->middleware('auth');
Route::get('/topik-materi-delete/{idcat}/{idmapel}/{id}','PetaMateriController@topikdelete')->name('topik.delete')->middleware('auth');

Route::resource('user','UserController')->middleware('auth');
Route::get('/user-data','UserController@data')->name('user.data')->middleware('auth');
Route::get('/search','UserController@index')->middleware('auth');
Route::get('/video-data/{jlh}','VideoCategoryController@videodata');

Route::resource('mapping-admin','MappingAdminController')->middleware('IsSuperAdmin');
Route::get('/mapping-admin-data','MappingAdminController@data')->name('admin.data')->middleware('auth');
Route::get('/search-admin','MappingAdminController@index')->middleware('auth');

Route::resource('mapping-fasilitasi','MappingFasilitasiController')->middleware('IsSuperAdmin');
Route::get('/mapping-fasilitasi-data','MappingFasilitasiController@data')->name('admin.data')->middleware('auth');
Route::get('/search-fasilitasi','MappingFasilitasiController@index')->middleware('auth');

Route::resource('mapping-super-user','MappingSuperUserController')->middleware('auth');
Route::get('/mapping-super-user-data','MappingSuperUserController@data')->name('super-user.data')->middleware('auth');
Route::get('/search-super-user','MappingSuperUserController@index')->middleware('auth');
Route::get('/video-verifikasi','MappingSuperUserController@verifikasi')->name('verifikasi.video')->middleware('auth');
Route::get('/search-video-verifikasi','MappingSuperUserController@verifikasi')->middleware('auth');


Route::resource('mapping-reviewer','MappingReviewerController')->middleware('auth');
Route::get('/mapping-reviewer-data','MappingReviewerController@data')->name('reviewer.data')->middleware('auth');
Route::get('/mapping-reviewer-video','MappingReviewerController@mappingvideo')->name('mapping-video')->middleware('auth');
Route::get('/search-reviewer','MappingReviewerController@index')->middleware('auth');
Route::get('/search-video','MappingReviewerController@mappingvideo')->middleware('auth');
Route::get('/mapping-video','MappingReviewerController@video')->middleware('auth');
Route::get('/mapping-delete','MappingReviewerController@videodelete')->middleware('auth');
Route::get('/search-video-reviewer','MappingVideoToReviewerController@index')->name('search.video')->middleware('auth');

Route::resource('upload','UploadController')->middleware('auth');
Route::post('/videosave','UploadController@videosave')->name('upload.simpan')->middleware('auth');
Route::post('/removefile/{id}','UploadController@removefile')->name('video.remove')->middleware('auth');
Route::post('video-saya','UploadController@myvideo')->name('video.myvideo')->middleware('auth');


Route::post('cari','SearchController@search')->name('search.cari');
Route::get('autocomplete','SearchController@autocomplete')->name('search.auto');

Route::get('/video-add-hit/{id}','UploadController@addhit');
Route::get('/ubah-verifikasi/{id}/{status}','UploadController@verifikasistatus');
// Route::get('/player/{filename}', 'DashboardController@player');
Route::get('/modal-video/{id}', 'DashboardController@player');
Route::get('/player-std/{slug}', 'DashboardController@playerstd');
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

Route::get('data-video', 'VideoCategoryController@datavideo')->name('video-saya');
Route::get('video/category/{slug}', 'VideoCategoryController@index')->name('video.bycategory');
Route::get('comments', 'CommentsController@index')->name('comments.all');
Route::post('comments/store', 'CommentsController@store')->name('comments.store');

Route::get('/login/{social}','Auth\LoginController@socialLogin')
        ->where('social','twitter|facebook|linkedin|google|github');
Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')
        ->where('social','twitter|facebook|linkedin|google|github');
Route::get('logout', 'Auth\LoginController@logout');

Route::get('combo-mapel/{idkat}','DashboardController@combomapel');

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mapping-video-to-reviewer', 'MappingVideoToReviewerController@index')->name('mapping-to-reviewer.index')->middleware('auth');
Route::post('/save-reviewer', 'MappingVideoToReviewerController@store')->name('mapping-to-reviewer.store')->middleware('auth');

Route::get('/review-video', 'ReviewVideoController@index')->name('review.video')->middleware('auth');
Route::get('/search-review-video','ReviewVideoController@index')->middleware('auth');
Route::resource('review', 'ReviewVideoController')->middleware('auth');
Route::post('/edit-video-reviewer/{id}', 'ReviewVideoController@editvideo')->name('review.edit-video')->middleware('auth');
Route::post('/add-endcards-reviewer/{id}', 'ReviewVideoController@endcards')->name('review.endcards')->middleware('auth');
Route::post('/upload-review/{id}', 'ReviewVideoController@uploadreview')->name('upload.review')->middleware('auth');

Route::get('edit-profile','UserController@profile')->middleware('auth');
Route::post('edit-profile-save/{id}','UserController@profilesave')->middleware('auth');

/* Saung */
Route::get('buka-saung/{slug}','SaungController@buatsaung')->middleware('auth');
Route::get('create-saung/{idvideo}','SaungController@createsaung')->middleware('auth');
Route::get('topik-saung-data/{idsaung}/{idtopik}','SaungController@topiksaung')->middleware('auth');
Route::get('topik-saung-keterangan/{idsaung}/{idtopik}','SaungController@keterangan')->middleware('auth');
Route::get('topik-saung-form/{idsaung}/{idtopik}','SaungController@topikform')->middleware('auth');
Route::get('tutup-saung/{idsaung}/{slug}','SaungController@tutupsaung')->middleware('auth');

Route::get('join-saung/{idvid}','SaungController@joinsaung')->middleware('auth');
Route::get('gabung-saung/{idsaung}/{idvid}','SaungController@gabungsaung')->middleware('auth');

Route::get('tantangan-form/{idsaung}/{id}','TopiktantanganController@form')->middleware('auth');
Route::post('tantangan-simpan/{idsaung}/{id}','TopiktantanganController@simpan')->middleware('auth');
Route::get('tantangan-data/{idsaung}','TopiktantanganController@data')->middleware('auth');
Route::get('tantangan-hapus/{id}','TopiktantanganController@hapusmateri')->middleware('auth');
Route::get('ikut-tantangan/{idsaung}/{idvideo}/{idtantangan}','TopiktantanganController@ikuttantangan')->middleware('auth');
Route::post('upload-tantangan/{idtantangan}/{idsaung}','TopiktantanganController@videotantangan')->name('video-tantangan.upload')->middleware('auth');


Route::resource('topik-turunan','TopikturunanController')->middleware('auth');
Route::get('topik-turunan-hapus/{id}','TopikturunanController@hapusmateri')->middleware('auth');
Route::get('topik-turunan-data/{idvideo}/{idsaung}/{user_id}','TopikturunanController@data')->middleware('auth');
Route::get('topik-turunan-form/{idvideo}/{idtopik}/{user_id}/{idsaung}','TopikturunanController@form')->middleware('auth');
Route::get('topik-turunan-penjelasan/{idtopik}','TopikturunanController@penjelasan')->middleware('auth');

/* EndSaung */

/* CHAT */
Route::get('/chat-data/{idsaung}', 'ChatController@data')->middleware('auth');
Route::post('/chat/{idsaung}', 'ChatController@store')->middleware('auth');
/* ENDCHAT */

/* LATIHAN */
Route::get('latihan/{idsaung}', 'LatihansaungController@index')->middleware('auth');
Route::get('latihan-data/{idsaung}', 'LatihansaungController@data')->middleware('auth');
Route::get('latihan-form/{idsaung}/{id}', 'LatihansaungController@show')->middleware('auth');
Route::post('latihan-simpan/{idsaung}/{id}', 'LatihansaungController@simpan')->middleware('auth');
Route::get('latihan-hapus/{id}/{idsaung}', 'LatihansaungController@hapus')->middleware('auth');

Route::get('/question/{id}/{idsaung}', 'LatihansaungController@question')->middleware('auth');

/* END LATIHAN */

Route::get('/level-user/{idlevel}/{id}','UserController@leveluser');

Route::get('messages', 'ChatsController@fetch');
Route::post('messages', 'ChatsController@sentMessage');

Route::get('editdataprofile',function () {
    $user=App\Model\Users::all();
    $us=array();
    
    $profile=App\Model\Profile::all();
    $pr=array();
    foreach($profile as $k => $v)
    {
        $pr[$v->user_id]=$v;
    }

    foreach($user as $k => $v)
    {
        if(!isset($pr[$v->id]))
        {
            $add_pr=new App\Model\Profile;
            $add_pr->user_id=$v->id;
            $add_pr->save();
        }
    }
});

Route::get('home-ftp','HomeController@index');
Route::post('upload-ftp','HomeController@simpan');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');