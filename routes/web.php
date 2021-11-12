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

// Books CRUD

Route::get('/book','BookController@index')->name('book');

Route::get('/book/create','BookController@create')->name('book.create');

Route::post('/book','BookController@store')->name('book.store');

Route::post('/book/delete/{id}','BookController@destroy')->name('book.destroy');

Route::get('/book/edit/{id}','BookController@update')->name('book.edit');

Route::post('/book/{id}','BookController@edit')->name('book.update');

Route::get('/book/search','BookController@search')->name('book.search');

Route::get('/home', 'HomeController@index')->name('home');

// Users CRUD

Route::get('/user','UsersController@index')->name('user');

Route::get('/user/create','UsersController@create')->name('user.create');

Route::post('/user','UsersController@store')->name('user.store');

Route::post('/user/delete/{id}','UsersController@destroy')->name('user.destroy');

Route::get('/user/edit/{id}','UsersController@edit')->name('user.edit');

Route::post('/user/{id}','UsersController@update')->name('user.update');

Route::get('/user/search','UsersController@search')->name('user.search');

// Gallery CRUD

Route::get('/gallery','GalleryController@index')->name('gallery');

Route::get('/gallery/create','GalleryController@create')->name('gallery.create');

Route::post('/gallery','GalleryController@store')->name('gallery.store');

Route::post('/gallery/delete/{id}','GalleryController@destroy')->name('gallery.destroy');

Route::get('/gallery/edit/{id}','GalleryController@edit')->name('gallery.edit');

Route::post('/gallery/{id}','GalleryController@update')->name('gallery.update');
