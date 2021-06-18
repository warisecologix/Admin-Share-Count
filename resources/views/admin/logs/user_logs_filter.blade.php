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
                                        <th>#</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
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
    <script type="text/javascript">
        $(function () {
            var formData = {
                id: "{{$id}}",
                "_token": "{{ csrf_token() }}",
            };
            $('#user_logs_table').DataTable({
                processing: true,
                serverSide: true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                // dom: 'Bfrtip',
                // buttons: [
                //     'excel',
                //     'pdf',
                //     'print'
                // ],
                ajax: {
                    url: "{{route('logs_filter_data_table')}}",
                    type: "POST",
                    data: formData,
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'user_name', name: 'user_name'},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'stock_id', name: 'stock_id'},
                    {data: 'user_ip', name: 'user_ip'},
                    {data: 'location', name: 'location'},
                    {data: 'machine_name', name: 'machine_name'},
                    {data: 'browser', name: 'browser'},
                    {data: 'os', name: 'os'},
                    {data: 'longitude', name: 'longitude'},
                    {data: 'latitude', name: 'latitude'},
                    {data: 'country', name: 'country'},
                    {data: 'country_code', name: 'country_code'},
                ],
            });

        });
    </script>
@stop
