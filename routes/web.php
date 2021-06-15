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
    Route::get('/stocks/{id}/logs/', 'HomeController@index')->name('stocks');
    Route::get('/stocks/list', 'HomeController@stock_list')->name('stock_list');
});
