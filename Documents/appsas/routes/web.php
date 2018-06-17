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
/*Route::get('users/{id}/{name}', function ($id, $name) {
    return 'this is user '.$name.' with and id '.$id;
});
*/
/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'PagesController@index');
Route::get('about', 'PagesController@about');
Route::get('services', 'PagesController@services');

Route::resource('coins', 'PostsController');
Auth::routes();

Route::get('/mycoins', 'DashboardController@index');
Route::get('/myalbums', 'DashboardController@index2');
Route::resource('albums', 'AlbumsController');
Route::get('/albums/{id}/coins', 'PostsController@index');
Route::get('/albums/{id}', 'AlbumsController@show');
Route::get('/albums/create/{id}', 'PostsController@create');

Route::resource('users', 'ProfileController');
Route::get('/profile/{id}', 'ProfileController@index');
Route::get('/profile/{id}/edit', 'ProfileController@edit');
//Route::get('/profile/{id}/edit', 'ProfileController@update');
//Route::get('/profile/{id}/edit/end', 'ProfileController@update');