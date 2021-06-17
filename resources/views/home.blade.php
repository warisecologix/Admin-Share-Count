@extends('layouts.admin')
@section('css')
@show
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Stock Logs</h1>
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
                                <h3 class="card-title">Stock Logs Details</h3>
                            </div>
                            <div class="card-body">
                                <table id="user_logs_table" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
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
                                    <tbody id="divid">
                                    @foreach($logs as $log)
                                        <tr>
                                            <td>{{$log->user->first_name . " " . $log->user->last_name  ?? "-"}}</td>
                                            <td>{{$log->company->company_name ?? "-"}}</td>
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
                                    <tfoot>
                                    <tr>
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
