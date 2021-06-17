@extends('layouts.admin')
@section('css')
@show
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Stock List</h1>
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
                                <h3 class="card-title">Stock Details</h3>
                            </div>
                            <div class="card-body">
                                <table id="user_logs_table" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Company Name</th>
                                        <th>No of Shares</th>
                                        <th>Brokage Name</th>
                                        <th>Purchase Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="divid">
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
                                    <tfoot>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Company Name</th>
                                        <th>No of Shares</th>
                                        <th>Brokage Name</th>
                                        <th>Purchase Date</th>
                                        <th>Status</th>
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
