@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr role="row" class="heading">
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Total Shares</th>
                <th>Verify Shares</th>
                <th>Un-Verify Shares</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="divid">
            @foreach($users as $user)
                <tr>
                    <td>
                        <a href="{{route('stocks_filter',['type' => 'all', 'value' => $user->id])}}">
                            {{$user->id ?? "-"}}
                        </a>
                    </td>
                    <td>
                        {{$user->first_name . " " . $user->last_name  ?? "-"}}
                    </td>
                    <td>
                        {{$user->email ?? "-"}}
                    </td>
                    <td>
                        {{$user->phone_no ?? "-"}}
                    </td>
                    <td>
                        <a href="{{route('stocks_filter',['type' => 'all', 'value' => $user->id])}}">
                            {{$user->total_shares ?? "-"}}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('stocks_filter',['type' => 'verify', 'value' => $user->id])}}">
                            {{$user->verify_shares ?? "-"}}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('stocks_filter',['type' => 'unverify', 'value' => $user->id])}}">
                            {{$user->un_verify_shares ?? "-"}}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('stocks_logs',$user->id)}}" class="btn btn-success">View Stock Logs</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
