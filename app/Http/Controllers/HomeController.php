<?php

namespace App\Http\Controllers;

use App\Stock;
use App\User;
use App\UserStockLogs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function stock()
    {
        $stocks = Stock::all();
        return view('stocks', compact('stocks'));
    }
}
