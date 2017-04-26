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

Route::get('/', 'HelloController@index');
Route::get('/tambah', 'HelloController@tambah');
Route::post('/add', 'HelloController@add');

// dibedakan, agar tidak tertumpuk

Route::get('/{id}', 'HelloController@show');
Route::get('/{id}/edit', 'HelloController@edit');
Route::post('/{id}', 'HelloController@update');

Route::get('/{id}/hapus', 'HelloController@hapus');
Route::post('/delete/{id}', 'HelloController@delete');
