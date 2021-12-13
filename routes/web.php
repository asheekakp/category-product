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

Route::get('add-sub-category/{id?}', 'SubCategoryController@addSubCategory')->name('add-sub-category');
Route::post('add-sub-category', 'SubCategoryController@saveSubCategory')->name('save-sub-category');



Route::get('add-nested-sub-category/{id?}', 'SubCategoryController@addNestedSubCategory')->name('add-nested-sub-category');
Route::post('get-nested-category', 'SubCategoryController@getNestedSubCategory')->name('get-nested-sub-category');
Route::post('add-nested-sub-category', 'SubCategoryController@addSubnestedCategory')->name('save-nested-sub-category');
Route::post('save-sub-nested-category', 'SubCategoryController@saveNestedSubCategory')->name('save-sub-nested-category');

Route::get('add-product', 'ProductController@addProduct')->name('add-product');
Route::get('view-product', 'ProductController@view')->name('view-product');
Route::post('save-product', 'ProductController@saveproduct')->name('save-product');
Route::post('get-nested-category-product', 'ProductController@nestedSubProduct')->name('get-nested-category-product');