@extends('layouts.admin')
@section('css')
@show
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Logs</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">User Logs Details</h3>
                            </div>
                            <div class="card-body">
                                <table id="user_logs_table" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
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
                                                {{$user->first_name . " " . $user->last_name  ?? "-"}}
                                            </td>
                                            <td>
                                                {{$user->email ?? "-"}}
                                            </td>
                                            <td>
                                                <a href="{{route('stocks_filter',['type' => 'all', 'value' => $user->id])}}">
                                                    {{$user->phone_no ?? "-"}}
                                                </a>
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
                                                <a href="{{route('stocks_logs',$user->id)}}" class="btn btn-success">View
                                                    Stock Logs</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Total Shares</th>
                                        <th>Verify Shares</th>
                                        <th>Un-Verify Shares</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            $("#user_logs_table").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel",  "print"]
            }).buttons().container().appendTo('#user_logs_table_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
