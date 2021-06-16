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
    public function users()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function index($id)
    {
        $logs = UserStockLogs::where('user_id', $id)->get();
        return view('home', compact('logs'));
    }

    public function stock()
    {
        $stocks = Stock::all();
        return view('stocks', compact('stocks'));
    }

    public function update_stock_status(Request $request)
    {
        $stock = Stock::find($request->stock_id);
        $status = 0;
        if ($stock->admin_verify == 0) {
            $status = 1;
        }
        $stock->admin_verify = $status;
        $stock->save();
        return response()->json([
           'stock' => $stock
        ]);

    }
}
