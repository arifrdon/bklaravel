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

// Route::get('daftar_kejadian', 'DaftarKejadianController@index');
// Route::get('daftar_kejadian/create', 'DaftarKejadianController@create');
// Route::post('daftar_kejadian', 'DaftarKejadianController@store');
// Route::get('daftar_kejadian/{daftar_kejadian}', 'DaftarKejadianController@show');
// Route::get('daftar_kejadian/{daftar_kejadian}/edit', 'DaftarKejadianController@edit');
// Route::patch('daftar_kejadian/{daftar_kejadian}', 'DaftarKejadianController@update');
// Route::delete('daftar_kejadian/{daftar_kejadian}', 'DaftarKejadianController@destroy');
Route::resource('kejadian','KejadianController');

// Route::get('kejadian_siswa', 'KejadianSiswaController@index');
// Route::get('kejadian_siswa/create', 'KejadianSiswaController@create');
// Route::post('kejadian_siswa', 'KejadianSiswaController@store');
// Route::get('kejadian_siswa/{kejadian_siswa}', 'KejadianSiswaController@show');
// Route::get('kejadian_siswa/{kejadian_siswa}/edit', 'KejadianSiswaController@edit');
// Route::patch('kejadian_siswa/{kejadian_siswa}', 'KejadianSiswaController@update');
// Route::delete('kejadian_siswa/{kejadian_siswa}', 'KejadianSiswaController@destroy');
Route::resource('kejadian_siswa','KejadianSiswaController');

Route::get('skor_siswa', 'SkorSiswaController@index');
Route::get('skor_siswa/{skor_siswa}/detail', 'SkorSiswaController@show');
Route::get('skor_siswa/{skor_siswa}/pdf', 'SkorSiswaController@pdf');
Route::get('bismillahtest', 'SkorSiswaController@bismillahtest');

Route::get('laporan_kejadian', 'SkorSiswaController@laporan_kejadian');
Route::post('laporan_kejadian', 'SkorSiswaController@laporan_kejadian_result');
Route::get('laporan_kejadian_excel', 'SkorSiswaController@laporan_kejadian_result_excel');

Route::get('pengaturan_bk', 'PengaturanBkController@edit_pengaturan');
Route::post('update_pengaturan', 'PengaturanBkController@update_pengaturan');