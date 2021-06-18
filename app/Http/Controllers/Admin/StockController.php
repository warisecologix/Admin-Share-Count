<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Generic;
use App\Stock;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class StockController extends Controller
{
    use Generic;

    public function index()
    {
        $stocks = Stock::all();
        return view('admin.stocks.index', compact('stocks'));
    }

    public function filter(Request $request)
    {
        $email = $request->email;
        $status = $request->status;
        $daterange = $request->daterange;
        $split = explode('-', $daterange);
        $start = $split[0] ?? "";
        $end = $split[1] ?? "";
        $stocks = new Stock();
        if (!empty(trim($email))) {
            $user = User::where('email', $email)->get()->first();
            if ($user) {
                $stocks = $stocks->where('user_id', $user->id);
            } else {
                $stocks = [];
                return view('admin.stocks.index', compact('stocks'));
            }
        }
        if ($status != 3) {
            if ($status != 2) {
                $stocks = $stocks->where('admin_verify', $status);
            } else {
                $stocks = $stocks->where('admin_verify', '<=', 1);
            }
        }
        if (!empty($start) && !empty($end)) {
            $start = $this->dateFormat($start);
            $end = $this->dateFormat($end);
            $stocks = $stocks->whereBetween('date_purchase', [$start, $end]);
        }
        $stocks = $stocks->get();
        return view('admin.stocks.index', compact('stocks'));
    }
}
