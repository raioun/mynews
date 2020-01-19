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

Route::group(['prefix' => 'admin'], function(){
    Route::get('news/create', 'Admin\NewsController@add');
    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::get('profile/edit', 'Admin\ProfileController@edit');
    
});

// Route::group(['prefix' => 'admin'], function(){

// });

http://XXXXXX.jp/admin/news/create

Route::group(['prefix' => 'XXX'], function(){
    Route::get('AAA/bbb', 'XXX\AAA@bbb');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
    Route::post('news/create', 'Admin\NewsController@create');
    
    Route::get('profile/create', 'Admin\ProfileController@add')->middleware('auth');
    Route::post('profile/create', 'Admin\ProfileController@create');
    
    Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');
    Route::post('profile/edit', 'Admin\ProfileController@update');
});