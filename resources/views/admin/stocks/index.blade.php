@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="text-center"> Total records {{count($stocks)}}</h4>
        <form method="post" action="{{route('filter')}}">
            @csrf
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Enter email">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <select class="form-control" name="status">
                            <option value="3">Select Status</option>
                            <option value="2">All</option>
                            <option value="1">Verify</option>
                            <option value="0">Un-Verify</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <input type="text" class="form-control daterange" name="daterange" id="daterange"/>
                    </div>
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-success"> Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr role="row" class="heading">
                <th>User Name</th>
                <th>Company Name</th>
                <th>No of Shares</th>
                <th>Brokage Name</th>
                <th>Purchase Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($stocks as $stock)
                <tr id="stock{{$loop->index}}">
                    <td>{{$stock->user->first_name . " " . $stock->user->last_name  ?? "-"}}</td>
                    <td>{{$stock->company->company_name  ?? "-"}}</td>
                    <td>{{$stock->no_shares_own  ?? "-"}}</td>
                    <td>{{$stock->brokage_name  ?? "-"}}</td>
                    <td>{{$stock->date_purchase  ?? "-"}}</td>
                    <td>{{$stock->admin_verify == 0 ? "Un-Verified" : "Verify" }}</td>
                    <td>
                        @if($stock->admin_verify == 0)
                            <button class="btn btn-info" onclick="updateStatus({{$stock->id}})">Verify</button>
                        @elseif($stock->admin_verify == 1)
                            <button class="btn btn-success" onclick="updateStatus({{$stock->id}})">Un-Verify</button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@include('component.stocks.js')
