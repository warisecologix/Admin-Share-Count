<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\User;
use Yajra\DataTables\DataTables;

class StockController extends Controller
{
    public function users()
    {
        $data = User::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
