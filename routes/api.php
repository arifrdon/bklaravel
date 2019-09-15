<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::post('register', 'API\UserController@register');




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// -------------------------------------------------------------------------

Route::post('login', 'API\UserController@login');



Route::middleware(['auth:api'])->group(function () {
    Route::post('update_password', 'API\UserController@updatePassword');
    Route::post('logout', 'API\UserController@logout');

    Route::get('bismillahtest2', 'API\SkorSiswaController@bismillahtest2');
    Route::get('bismillahtest2/{siswa}', 'API\SkorSiswaController@bismillahtest2');
});

Route::middleware('auth:api')->group( function () {
    Route::get('kejadian/cari', 'API\KejadianController@cari');
    Route::get('kejadian', 'API\KejadianController@index');
});

Route::middleware(['auth:api','OnlyAdminGurubk'])->group( function () {
    Route::post('kejadian', 'API\KejadianController@store');
});

Route::middleware('auth:api')->group( function () {
    Route::get('kejadian/{kejadian}', 'API\KejadianController@show');
});

Route::middleware(['auth:api','OnlyAdminGurubk'])->group( function () {
    Route::patch('kejadian/{kejadian}', 'API\KejadianController@update');
    Route::delete('kejadian/{kejadian}', 'API\KejadianController@destroy');
});


Route::middleware('auth:api')->group( function () {
    Route::get('kejadian_siswa/cari', 'API\KejadianSiswaController@cari');
    Route::get('kejadian_siswa', 'API\KejadianSiswaController@index');
    Route::get('kejadian_siswa/{kejadian_siswa}/chatview', 'API\KejadianSiswaController@chatview');
    Route::post('kejadian_siswa/{kejadian_siswa}/chatsave', 'API\KejadianSiswaController@chatsave');
    Route::delete('kejadian_siswa/{kejadian_siswa}/{forum_kejadian}/chatdelete', 'API\KejadianSiswaController@chatdelete');
});

Route::middleware(['auth:api','OnlyAdminGurubkGuru'])->group( function () {
    Route::post('kejadian_siswa', 'API\KejadianSiswaController@store');

    Route::get('kejadian_siswa/{kejadian_siswa}', 'API\KejadianSiswaController@show');
    Route::patch('kejadian_siswa/{kejadian_siswa}', 'API\KejadianSiswaController@update');
    Route::delete('kejadian_siswa/{kejadian_siswa}', 'API\KejadianSiswaController@destroy');
});


Route::middleware(['auth:api'])->group( function () {
    Route::get('skor_siswa/cari', 'API\SkorSiswaController@cari');
    Route::get('skor_siswa', 'API\SkorSiswaController@index');
    Route::get('skor_siswa/{skor_siswa}/detail', 'API\SkorSiswaController@show');
    Route::get('skor_siswa/{skor_siswa}/siswa', 'API\SkorSiswaController@search_siswa');
    
});

Route::middleware(['auth:api','OnlyKepsekAdminGurubk'])->group( function () {
    Route::get('show_pengaturan', 'API\PengaturanBkController@show_pengaturan');
    Route::post('update_pengaturan', 'API\PengaturanBkController@update_pengaturan');
});

Route::middleware(['auth:api','OnlyAdminGurubkGuru'])->group( function () {
    Route::get('siswa', 'API\SiswaController@index');
});

