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

Auth::routes([
    'register' => false,
    'reset'=> false,
]);

Route::get('/','WelcomeController@heading');

Route::get('/name','NameController@heading');

Route::get('/major','MajorController@heading');

Route::get('/city','CityController@heading');

Route::get('/book','BookController@index')->name('book');

Route::get('/book/create','BookController@create')->name('book.create');

Route::post('/book','BookController@store')->name('book.store');

Route::post('/book/delete/{id}','BookController@destroy')->name('book.destroy');

Route::get('/book/edit/{id}','BookController@update')->name('book.edit');

Route::post('/book/{id}','BookController@edit')->name('book.update');

Route::get('/book/search','BookController@search')->name('book.search');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user','UsersController@index');
