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

Route::get('/', 'IndexController@index')->name('index');
//Route::get('/categories', 'CategoryController@getRelationshipAll');
//Route::get('/products/cat/{id}', 'ProductController@getProductsByCat');
Route::get('/product/edit/{id}', 'IndexController@index');
Route::get('/category/edit/{id}', 'IndexController@index');
