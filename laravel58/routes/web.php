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

//http://127.0.0.1/month11/laravel58/public/index.php/08b
/*Route::get('/08b/',function (){
    return view('welcome');
});*/

//http://127.0.0.1/month11/laravel58/public/index.php/foo
/*Route::get('foo', function () {
    return 'Hello World';
});*/
Route::get('admin/product/add','MgoodController@add');

Route::get('admin/product/see','MgoodController@see');

Route::get('admin/product/search','MgoodController@search');

Route::get('admin/product/add','MgoodController@add');

Route::get('admin/product/doadd','MgoodController@doadd')->name('admin.product.doadd');

Route::get('admin/product/del','MgoodController@del');

Route::get('admin/product/es','MgoodController@es');

Route::get('admin/product/del','MgoodController@del');

Route::get('admin/product/update','MgoodController@update')->name('admin.product.update');

Route::get('admin/product/up','MgoodController@up');
