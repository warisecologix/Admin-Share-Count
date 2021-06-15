<?php

namespace App\Http\Controllers;

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
}
