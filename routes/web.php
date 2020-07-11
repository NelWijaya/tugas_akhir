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
});

Route::get('/dk', function () {
    return view('pages.detail_question');
});


Route::get('/pertanyaan', 'PertanyaanController@index');            //daftar pertanyaan
Route::post('/user/create', 'UserController@store');                //sign up
Route::post('/pertanyaan', 'PertanyaanController@store');           //buat pertanyaan
Route::get('/pertanyaan/{id}', 'JawabanController@index');          //daftar jawaban di 1 pertanyaan
Route::post('/jawaban/{id}', 'JawabanController@store');            //buat jawaban (id pertanyaan)



//dibawah ini route belom work
Route::get('/pertanyaan/create', 'PertanyaanController@create');    //form pertanyaan

Route::get('/pertanyaan/{id}', 'JawabanController@index');          //daftar jawaban di 1 pertanyaan
//Route::get('/jawaban/{id}', 'JawabanController@index');             //daftar jawaban di 1 pertanyaan (nnti diganti ke /pertanyaan{id})
Route::get('/jawaban/create/{id}', 'JawabanController@create');     //form jawaban (id pertanyaan) [nanti diganti dengan /jawaban/{id}]
Route::get('/pertanyaan/{id}/edit', 'PertanyaanController@edit');   //tampil form update pertanyaan
Route::put('/pertanyaan/{id}', 'PertanyaanController@update');      //submit form pertanyaan dan kembali ke index
Route::delete('/pertanyaan/{id}', 'PertanyaanController@delete');   //hapus pertanyaan
