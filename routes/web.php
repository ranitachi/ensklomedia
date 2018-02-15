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
Route::get('/watch', 'DashboardController@watch')->name('watch');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('category','CategoryController');
Route::get('/category-data/{id}','CategoryController@data')->name('category.data');
Route::get('/category-form/{id}','CategoryController@show')->name('category.form');

Route::get('/upload','UploadController@index')->name('upload');
