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
Route::get('/', [
    'as' => 'login', 'uses' => 'Auth\LoginController@login',
]);
Route::get('/test', function () {
    return File::get(public_path() . 'test/index.html');
});

Auth::routes();

Route::get('/home', 'CategoryController@index')->name('home');

// Route::get('vi-category', 'CategoryController@add')->name('add-category');
Route::get('add-category/{id?}', 'CategoryController@addCategory')->name('add-category');
Route::post('add-category', 'CategoryController@saveCategory')->name('save-category');
Route::get('view-category', 'CategoryController@view')->name('view-category');

Route::get('add-product', 'ProductController@addProduct')->name('add-product');
Route::get('view-product', 'ProductController@view')->name('view-product');
Route::post('save-product', 'ProductController@saveproduct')->name('save-product');
Route::post('get-nested-category-product', 'ProductController@nestedSubProduct')->name('get-nested-category-product');