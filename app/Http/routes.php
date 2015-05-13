<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'IndexController@index');
/*
	|- Dashboard
 */
Route::get('dashboard', 'DashboardController@index');
Route::get('dashboard/login', 'DashboardController@login');
Route::get('dashboard/register', 'DashboardController@register');
Route::get('dashboard/logout', 'DashboardController@logout');

Route::post('dashboard/login', 'DashboardController@loginSubmit');
Route::post('dashboard/register', 'DashboardController@registerSubmit');

/*
	|- Administration
 */
Route::get('administration', 'AdministrationController@index');
Route::get('administration/users', 'AdministrationController@users');

Route::get('gallery', 'GalleryController@index');
Route::get('gallery/create', 'GalleryController@create');
Route::get('gallery/json', 'GalleryController@json');

Route::post('gallery/create', 'GalleryController@createSubmit');

Route::get('artists', 'ArtistController@index');

Route::get('news/create', 'NewsController@create');
Route::get('news/json', 'NewsController@json');
Route::get('news/{id}/edit', 'NewsController@edit');
Route::get('news/{id}/archive', 'NewsController@archive');
Route::get('news/{id}/destroy', 'NewsController@destroy');
Route::get('news/{id}/publish', 'NewsController@publish');
Route::get('news/{id}', 'NewsController@show');

Route::post('news/create', 'NewsController@createSubmit');
Route::post('news/{id}/edit', 'NewsController@editSubmit');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
