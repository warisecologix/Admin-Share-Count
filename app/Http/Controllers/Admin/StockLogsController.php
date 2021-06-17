<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\UserStockLogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StockLogsController extends Controller
{
    public function index(){
        $logs = UserStockLogs::all();
        return view('admin.logs.index',compact('logs'));
    }


    public function filter(Request $request)
    {
        $company = $request->company;
        $country_code = $request->country_code;
        $daterange = $request->daterange;
        $split = explode('-', $daterange);
        $start = $split[0] ?? "";
        $end = $split[1] ?? "";
        $logs = new UserStockLogs();
        if ($company != 0) {
            $logs = $logs->where('user_id', $user->id);
        }
        if ($status != 3) {
            if ($status != 2) {
                $logs = $logs->where('admin_verify', $status);
            } else {
                $logs = $logs->where('admin_verify', 0)->orWhere('admin_verify', 1);
            }
        }
        if (!empty($start) && !empty($end)) {
            $start = $this->dateFormat($start);
            $end = $this->dateFormat($end);
            $logs = $logs->whereBetween('date_purchase', [$start, $end]);
        }
        $logs = $logs->get();
        return view('admin.logs.index', compact('logs'));
    }
}
