<?php

namespace App\Http\Controllers\TypeHead;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class EmailTypeHeadController extends Controller
{
    public function auto_complete_search(Request $request)
    {
        $query = $request->get('query');
        $filterResult = User::where('email', 'LIKE', '%'. $query. '%')->pluck('email');
        return response()->json($filterResult);
    }
}
