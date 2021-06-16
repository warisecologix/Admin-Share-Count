<?php

use Illuminate\Support\Facades\Route;


Route::auth([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::redirect('/','login');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/users', 'HomeController@users')->name('users');
    Route::get('/stocks/{id}/logs/', 'HomeController@index')->name('stocks_logs');
    Route::get('/stocks/list', 'HomeController@stock')->name('stocks');
});
Route::post('/update/stock/status', 'HomeController@update_stock_status')->name('update_stock_status');
