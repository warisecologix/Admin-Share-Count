@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead >
            <tr role="row" class="heading">
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id ?? "-"}}</td>
                    <td>{{$user->first_name . " " . $user->last_name  ?? "-"}}</td>
                    <td>{{$user->email ?? "-"}}</td>
                    <td>{{$user->phone_no ?? "-"}}</td>
                    <td><a href="{{route('stocks',$user->id)}}" class="btn btn-success">View Stock Logs</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
