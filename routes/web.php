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

// Route::get('/', 'AuthController@index');

Route::post('login', 'AuthController@login');
Route::get('sign-up', 'AuthController@signUp');
Route::post('sign-up/store', 'AuthController@store');
Route::get('logout', 'AuthController@logout');

Route::get('/', 'PertanyaanController@index');

Route::group(['middleware' => 'AuthMiddleware'], function () {
    //tambahkan route disini
    Route::get('cek-id', 'AuthController@cekId');
    Route::get('/pertanyaan', 'PertanyaanController@index');                          //daftar pertanyaan
    Route::post('/pertanyaan', 'PertanyaanController@store');                        //buat pertanyaan
    Route::get('/pertanyaan/{id}', 'JawabanController@index');                      //daftar jawaban di 1 pertanyaan detail
    Route::put('/pertanyaan/{id}', 'PertanyaanController@update');                 //submit form pertanyaan dan kembali ke index
    Route::delete('/pertanyaan/{id}', 'PertanyaanController@delete');             //hapus pertanyaan
    Route::put('/jawaban/vote/{id}', 'JawabanController@updateVote');            //update vote jawaban
    Route::put('/pertanyaan/vote/{id}', 'PertanyaanController@updateVote');     //update vote pertanyaan
    Route::get('/jawaban/relevant/{id}', 'JawabanController@updateRelevant');  //daftar jawaban di 1 pertanyaan
});



//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
