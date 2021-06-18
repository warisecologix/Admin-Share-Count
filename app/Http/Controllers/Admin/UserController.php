<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(){

        return view('admin.users.index');
    }
    public function data_table(Request $request){
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', '{{$first_name}} {{$last_name}}')
                ->addColumn('email', '{{$email}}')
                ->addColumn('phone_no', function (User $user) {
                    return '<a href="stocks/all/'.$user->id.'/list">'.$user->phone_no.'</a>';
                })
                ->addColumn('total_shares', function (User $user) {
                    return '<a href="stocks/all/'.$user->id.'/list">'.$user->total_shares .'</a>';
                })
                ->addColumn('verify_shares', function (User $user) {
                    return '<a href="stocks/verify/'.$user->id.'/list">'.$user->verify_shares .'</a>';
                })
                ->addColumn('un_verify_shares', function (User $user) {
                    return '<a href="stocks/unverify/'.$user->id.'/list">'.$user->un_verify_shares .'</a>';
                })
                ->addColumn('action', function (User $user) {
                    return '<a href="stocks/'.$user->id.'/logs" class="btn btn-success">View Stock Logs</a>';
                })
                ->rawColumns(['action', 'phone_no', 'total_shares' , 'verify_shares', 'un_verify_shares'])

                ->make(true);
        }
    }
}
