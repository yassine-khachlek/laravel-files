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

Route::group(['prefix' => 'files', 'as' => 'files.'], function () {

	Route::get('/', 'FilesController@index')->name('index');

	Route::get('/create', 'FilesController@create')->name('create');

	Route::post('/', 'FilesController@store')->name('store');

	Route::get('/{id}/{slug?}', 'FilesController@show')->name('show');

	Route::get('/{id}/download/{slug?}', 'FilesController@download')->name('download');

	Route::delete('/{id}', 'FilesController@destroy')->name('destroy');

});
