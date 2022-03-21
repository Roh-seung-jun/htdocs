<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Route::post('/event/applicants','EventController@check')->name('event.check');
Route::post('/event/{phone}/stamps','EventController@view')->name('event.view');
Route::post('/user/login','UserController@login')->name('user.login');
Route::get('/user/logout','UserController@logout')->name('user.logout');
Route::get('/item/view','ItemController@view')->name('item.view');
Route::get('/event/control','EventController@control')->name('event.control');

Route::post('/file/review/{file}','FileController@make')->name('file.review');
Route::resource('user','UserController');
Route::resource('review','ReviewController');
Route::resource('item','ItemController');
Route::resource('event','EventController');



