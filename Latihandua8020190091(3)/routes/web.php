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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('buku/index','bukuController@index');
    Route::get('buku/tambah','bukuController@tambah');
    Route::post('buku/simpan','bukuController@simpan');
    Route::get('buku/edit/{id}','bukuController@edit');
    Route::put('buku/update/{id}','bukuController@update');
    Route::get('buku/hapus/{id}','bukuController@hapus');

});


