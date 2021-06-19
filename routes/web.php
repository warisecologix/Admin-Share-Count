<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\StockLogsController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::auth([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::redirect('/', 'login');


Route::group(['middleware' => 'auth'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::get('/stocks', [StockController::class, 'index'])->name('admin_stocks');
        Route::post('/stocks-filter',  [StockController::class, 'stocks_filter_data_table'])->name('stocks_filter_data_table');

        Route::get('/logs', [StockLogsController::class, 'index'])->name('admin_logs');
        Route::post('/logs', [StockLogsController::class, 'filter'])->name('logs_filter');
    });
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users-list', [UserController::class, 'data_table'])->name('users_data_table');

    Route::get('/stocks/{id}/logs/', [StockLogsController::class, 'user_logs_filter'])->name('stocks_logs');
    Route::post('/user-stocks-datatable',  [StockLogsController::class, 'logs_filter_data_table'])->name('logs_filter_data_table');

    Route::get('/stocks/{type}/{value}/list',  [StockController::class, 'user_stock_filter'])->name('stocks_filter');
    Route::post('/user-stocks-filter',  [StockController::class, 'user_stocks_filter_data_table'])->name('user_stocks_filter_data_table');
});

Route::post('/update/stock/status',  [StockController::class, 'update_stock_status'])->name('update_stock_status');
