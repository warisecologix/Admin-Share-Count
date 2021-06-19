<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Stock;
use App\UserStockLogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use function GuzzleHttp\Promise\all;

class StockLogsController extends Controller
{
    public function index()
    {
        $logs = UserStockLogs::all();
        return view('admin.logs.index', compact('logs'));
    }


    public function user_logs_filter($id)
    {
        return view('admin.logs.user_logs_filter', compact('id'));
    }


    public function logs_filter_data_table(Request $request)
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
        $data =  $logs->latest()->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function (UserStockLogs $logs) {
                    return $logs->user->first_name . ' ' . $logs->user->last_name;
                })
                ->addColumn('company_name', function (UserStockLogs $logs) {
                    return $logs->company->company_name;
                })
                ->addColumn('stock_id', '{{$stock_id}}')
                ->addColumn('user_ip', '{{$user_ip}}')
                ->addColumn('location', '{{$location}}')
                ->addColumn('machine_name', '{{$machine_name}}')
                ->addColumn('browser', '{{$browser}}')
                ->addColumn('os', '{{$os}}')
                ->addColumn('longitude', '{{$longitude}}')
                ->addColumn('latitude', '{{$latitude}}')
                ->addColumn('country', '{{$country}}')
                ->addColumn('country_code', '{{$country_code}}')
                ->rawColumns(['user_name', 'company_name'])
                ->make(true);
        }
    }

    public function user_logs_filter_data_table(Request $request)
    {

        $id = $request->id;
        $data = [];
        $data =  UserStockLogs::where('user_id', $id)->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function (UserStockLogs $logs) {
                    return $logs->user->first_name . ' ' . $logs->user->last_name;
                })
                ->addColumn('company_name', function (UserStockLogs $logs) {
                    return $logs->company->company_name;
                })
                ->addColumn('stock_id', '{{$stock_id}}')
                ->addColumn('user_ip', '{{$user_ip}}')
                ->addColumn('location', '{{$location}}')
                ->addColumn('machine_name', '{{$machine_name}}')
                ->addColumn('browser', '{{$browser}}')
                ->addColumn('os', '{{$os}}')
                ->addColumn('longitude', '{{$longitude}}')
                ->addColumn('latitude', '{{$latitude}}')
                ->addColumn('country', '{{$country}}')
                ->addColumn('country_code', '{{$country_code}}')
                ->rawColumns(['user_name', 'company_name'])
                ->make(true);
        }
    }

}
