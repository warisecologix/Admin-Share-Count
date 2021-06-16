<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserStockLogs;
use Illuminate\Http\Request;

class StockLogsController extends Controller
{
    public function index(){
        $logs = UserStockLogs::all();
        return view('admin.logs.index',compact('logs'));
    }
}
