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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('kejadian/cari', 'KejadianController@cari');
    Route::get('kejadian', 'KejadianController@index');
});
Route::middleware(['auth','OnlyAdminGurubk'])->group(function () {
    Route::get('kejadian/create', 'KejadianController@create');
    Route::post('kejadian', 'KejadianController@store');
});
Route::middleware(['auth'])->group(function () {
    Route::get('kejadian/{kejadian}', 'KejadianController@show');
});
Route::middleware(['auth','OnlyAdminGurubk'])->group(function () {
    Route::get('kejadian/{kejadian}/edit', 'KejadianController@edit');
    Route::patch('kejadian/{kejadian}', 'KejadianController@update');
    Route::delete('kejadian/{kejadian}', 'KejadianController@destroy');
});
// Route::resource('kejadian','KejadianController');


Route::middleware(['auth'])->group(function () {
    Route::get('kejadian_siswa/cari', 'KejadianSiswaController@cari');


    Route::get('kejadian_siswa', 'KejadianSiswaController@index');

    Route::get('kejadian_siswa/{kejadian_siswa}/chatview', 'KejadianSiswaController@chatview');
    Route::post('kejadian_siswa/{kejadian_siswa}/chatsave', 'KejadianSiswaController@chatsave');
    Route::delete('kejadian_siswa/{kejadian_siswa}/{forum_kejadian}/chatdelete', 'KejadianSiswaController@chatdelete');
});
Route::middleware(['auth','OnlyAdminGurubkGuru'])->group(function () {
    Route::get('kejadian_siswa/create', 'KejadianSiswaController@create');
    Route::post('kejadian_siswa', 'KejadianSiswaController@store');

    Route::get('kejadian_siswa/{kejadian_siswa}', 'KejadianSiswaController@show');
    Route::get('kejadian_siswa/{kejadian_siswa}/edit', 'KejadianSiswaController@edit');
    Route::patch('kejadian_siswa/{kejadian_siswa}', 'KejadianSiswaController@update');
    Route::delete('kejadian_siswa/{kejadian_siswa}', 'KejadianSiswaController@destroy');
});
//Route::resource('kejadian_siswa','KejadianSiswaController');


Route::middleware(['auth','OnlyKepsekAdminGurubkGuru'])->group(function () {
    Route::get('skor_siswa', 'SkorSiswaController@index');
    Route::get('skor_siswa/{skor_siswa}/detail', 'SkorSiswaController@show');
    Route::get('skor_siswa/{skor_siswa}/pdf', 'SkorSiswaController@pdf');
    Route::get('skor_siswa/cari', 'SkorSiswaController@cari');
});

Route::get('bismillahtest', 'SkorSiswaController@bismillahtest');
Route::get('bismillahtest2', 'SkorSiswaController@bismillahtest2');

Route::middleware(['auth','OnlyKepsekAdminGurubk'])->group(function () {
    Route::get('laporan_kejadian', 'SkorSiswaController@laporan_kejadian');
    Route::post('laporan_kejadian', 'SkorSiswaController@laporan_kejadian_result');
    Route::get('laporan_kejadian_excel', 'SkorSiswaController@laporan_kejadian_result_excel');
});

Route::middleware(['auth','OnlyKepsekAdminGurubk'])->group(function () {
    Route::get('pengaturan_bk', 'PengaturanBkController@edit_pengaturan');
    Route::post('update_pengaturan', 'PengaturanBkController@update_pengaturan');
});

Route::middleware(['auth'])->group(function () {
    Route::get('change_password', 'HomeController@editPassword');
    Route::post('update_password', 'HomeController@updatePassword');
    Route::post('fetchnotif', 'HomeController@fetchnotif');
    Route::get('exp', 'HomeController@exp');
});