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

// Route::group(['middleware'=>'auth'],function(){
    Route::get('/admin', function () {
        return view('admin');
    });
    Route::post('/save', 'C_barang@save');
    Route::get('/getData', 'C_barang@createData');
    Route::post('/delete', 'C_barang@delete');
    Route::post('/update', 'C_barang@simpan_update');

    Route::get('/', 'C_Menu@index');
    Route::get('/products', function () {
        return view('products');
    });
    Route::get('/single-product', function () {
        return view('single-product');
    });
// });
