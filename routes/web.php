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

// Blog
Route::get('/', 'BlogController@index');
Route::get('/tambah', 'BlogController@tambah');
Route::post('/add', 'BlogController@add');

// User
Route::get('/login', 'UserController@login');
Route::get('/register', 'UserController@register');
Route::get('/log', 'UserController@log');
Route::post('/reg', 'UserController@reg');
Route::post('/log', 'UserController@log');
Route::get('/logout', 'UserController@logout');
Route::get('/profil', 'UserController@profil');
Route::get('/profil-user', 'UserController@profil');
Route::get('/profil-blog', 'UserController@profil');
Route::get('/add-user', 'UserController@addUser');
Route::post('/adduser', 'UserController@add');
Route::get('/tag-list', 'UserController@profil');
Route::get('/addtag', 'BlogController@addtag');
Route::post('/newtag', 'BlogController@newtag');

// dibedakan, agar tidak tertumpuk

// Blog
Route::get('/{id}', 'BlogController@show');
Route::get('/{id}/edit', 'BlogController@edit');
Route::get('/{id}/tags', 'BlogController@tags');
Route::post('/tag/{id}', 'BlogController@tag');
Route::get('/{id}/deltag', 'BlogController@deltag');
Route::get('/edit-tag/{id}', 'BlogController@editTag');
Route::post('/tag-edit/{id}', 'BlogController@tagEdit');
Route::get('/delete-tag/{id}', 'BlogController@deleteTag');
Route::post('/tag-delete/{id}', 'BlogController@tagDelete');
Route::post('/{id}', 'BlogController@update');
Route::get('/{id}/hapus', 'BlogController@hapus');
Route::post('/delete/{id}', 'BlogController@delete');
Route::get('/tags/{id}', 'BlogController@FilterTags');

// User
Route::get('/cprofile/{id}', 'UserController@cprofile');
Route::post('/cprof/{id}', 'UserController@cprof');
Route::get('/cpass/{id}', 'UserController@cpass');
Route::post('/password/{id}', 'UserController@password');
Route::get('/delprofile/{id}', 'UserController@delete');
Route::post('/delprof/{id}', 'UserController@del');
