<?php

use Illuminate\Support\Facades\Route;


Route::auth([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::redirect('/','login');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/stock/logs', 'HomeController@index')->name('home');
    Route::get('/stocks/list', 'HomeController@stock_list')->name('stock_list');
});
