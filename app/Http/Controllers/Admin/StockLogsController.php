<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\UserStockLogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StockLogsController extends Controller
{
    public function index()
    {
        $logs = UserStockLogs::all();
        return view('admin.logs.index', compact('logs'));
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
            if ($company != 3) {
                $logs = $logs->where('company_id', $company);
            } else {
                $logs = $logs->where('company_id','<=', 2);
            }
        }
        if ($country_code != "NOT") {
            $logs = $logs->where('country_code', $country_code);
        }
        if (!empty($start) && !empty($end)) {
            $start = $this->dateFormat($start);
            $end = $this->dateFormat($end);
            $logs = $logs->whereBetween('created_at', [$start, $end]);
        }
        $logs = $logs->get();
        return view('admin.logs.index', compact('logs'));
    }
}
