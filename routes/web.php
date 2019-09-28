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
Route::get('/', function () {
    return view('welcome');
});

Route::get( '/hello', function( ){ 
    return '<h1>Hello World</h1>';
} );

Route::get('/user/{id}/{name}', function( $id, $name ){
    return 'This is user' . $id . 'with name ' . $name ;
});

Route::get('/about', function () {
    return view('pages.about');
});
*/
Route::get('/', 'PagesController@index' );//@index es el nombre de la función que hay dentro de PagesController.php
Route::get('/about', 'PagesController@about' );
Route::get('/services', 'PagesController@services' );
Route::get('/choten', 'PagesController@choten' );

Route::resource('posts', 'PostsController');//crea todos los routes que necesitamos para las funciones que creamos

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('home');
