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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

#Toggle favorite event
Route::post('model/{event}/favorites', 'FavoriteController@store');
Route::delete('model/{event}/favorites', 'FavoriteController@destroy');

#Photo
Route::post('events/{event}/photos', 'PhotoController@store')->name('photos.store');
Route::delete('photos/{photo}', 'PhotoController@destroy');

#Events
Route::resource('events', 'EventController');

#Replies
Route::post('/events/{event}/replies','ReplyController@store')->name('reply.store');
Route::delete('/replies/{reply}','ReplyController@destroy')->name('delete_reply');
Route::patch('/replies/{reply}','ReplyController@update')->name('update_reply');
