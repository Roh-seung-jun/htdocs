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

Route::get('/api/reviews','ReviewController@search')->name('review.key');
Route::post('/review/plus','ReviewController@plus')->name('review.plus');

Route::resource('user','UserController');
Route::resource('review','ReviewController');
Route::resource('item','ItemController');
Route::resource('event','EventController');

Route::post('/file','ReviewController@make')->name('file.make');



