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


Route::any('/login','Admin\LoginController@login');
Route::any('/logindo','Admin\LoginController@logindo');
Route::any('/news','Admin\LoginController@news');
Route::any('/news/create','Admin\LoginController@create');
Route::any('/index','Admin\LoginController@index');

Route::get('/brand','Admin\BrandController@index')->name('brand');
Route::get('/brand/create','Admin\BrandController@create')->name('brand.create');
Route::post('/brand/store','Admin\BrandController@store');
Route::post('/brand/upload','Admin\BrandController@upload');
Route::get('/brand/edit/{brand_id}','Admin\BrandController@edit')->name('brand.edit');
Route::post('/brand/update/{brand_id}','Admin\BrandController@update');
Route::get('/brand/delete/{brand_id?}','Admin\BrandController@destroy');
Route::get('/brand/change','Admin\BrandController@change');