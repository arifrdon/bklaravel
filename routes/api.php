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
    Route::get('kejadian_siswa', 'API\KejadianSiswaController@index');
});

