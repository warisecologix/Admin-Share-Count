@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead >
            <tr role="row" class="heading">
                <th>User Name</th>
                <th>Company</th>
                <th>Stock ID</th>
                <th>IP Address</th>
                <th>Location</th>
                <th>Machine Name</th>
                <th>Browser</th>
                <th>Operating System</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Country</th>
                <th>Country Code</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{$log->user->first_name . " " . $log->user->last_name  ?? "-"}}</td>
                    <td>{{$log->stock->company->company_name ?? "-"}}</td>
                    <td>{{$log->stock_id ?? "-"}}</td>
                    <td>{{$log->user_ip ?? "-"}}</td>
                    <td>{{$log->location ?? "-"}}</td>
                    <td>{{$log->machine_name ?? "-"}}</td>
                    <td>{{$log->browser ?? "-"}}</td>
                    <td>{{$log->os ?? "-"}}</td>
                    <td>{{$log->longitude ?? "-"}}</td>
                    <td>{{$log->latitude ?? "-"}}</td>
                    <td>{{$log->country ?? "-"}}</td>
                    <td>{{$log->country_code ?? "-"}}</td>
                    <td>{{$log->customize_date ?? "-"}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
