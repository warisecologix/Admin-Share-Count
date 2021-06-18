<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Generic;
use App\Stock;
use App\User;
use App\UserStockLogs;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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

    public function user_stock_filter($type, $value)
    {
        return view('admin.stocks.user_stock_filter', compact('type', 'value'));
    }

    public function stocks_filter_data_table(Request $request)
    {

        $type = $request->type;
        $value = $request->value;
        $data = [];
        if ($type == "all") {
            $data = Stock::where('user_id', $value)->get();
        } else if ($type == "verify") {
            $data = Stock::where('user_id', $value)->where('admin_verify', 1)->get();
        } else if ($type == "unverify") {
            $data = Stock::where('user_id', $value)->where('admin_verify', 0)->get();
        }
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function (Stock $stock) {
                    return $stock->user->first_name . ' ' . $stock->user->last_name;
                })
                ->addColumn('company_name', function (Stock $stock) {
                    return $stock->company->company_name;
                })
                ->addColumn('no_shares_own', '{{$no_shares_own}}')
                ->addColumn('brokage_name', '{{$brokage_name}}')
                ->addColumn('date_purchase', '{{$date_purchase}}')
                ->addColumn('admin_verify', '{{$admin_verify == 0 ? "Un-Verified" : "Verify"}}')
                ->addColumn('action', function (Stock $stock) {
                    if ($stock->admin_verify == 0) {
                        return '<button class="btn btn-info" onclick="updateStatus(' . $stock->id . ')">Verify</button>';
                    } else {
                        return '<button class="btn btn-success" onclick="updateStatus(' . $stock->id . ')">Un-Verify</button>';
                    }
                })
                ->rawColumns(['action', 'user_name', 'company_name'])
                ->make(true);
        }
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
