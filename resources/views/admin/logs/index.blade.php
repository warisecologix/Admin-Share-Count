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
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Filters</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <select class="form-control select2bs4" name="company" id="company">
                                                <option value="0">Select Company</option>
                                                <option value="3">All</option>
                                                <option value="1">GME</option>
                                                <option value="2">AMC</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <select class="form-control select2bs4" id="country_code"
                                                    name="country_code" style="width: 100%;">
                                                <option value="NOT">Select</option>
                                                @foreach($logs as $log)
                                                    <option value="{{$log->country_code}}">{{$log->country}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                              </span>
                                            </div>
                                            <input type="text" class="form-control float-right" name="daterange"
                                                   id="reservation">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="button" class="btn btn-success" onclick="reDrawDataTable()">
                                            Search
                                        </button>
                                        <button type="button" class="btn btn-info" onclick="resetFilter()"> Clear
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Stock Logs Details</h3>
                            </div>
                            <div class="card-body">
                                <table id="logs_table" class="table table-bordered table-striped">
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
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script type="text/javascript">
        function resetFilter() {
            $("#reservation").val('');
            $("#company").val('');
            $("#country_code").val('3');
            reDrawDataTable();
        }

        function reDrawDataTable() {
            $('#logs_table').DataTable().clear().destroy();
            logs_filter_data_table()
        }

        $(function () {
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            $('#reservation').daterangepicker();
            $("#reservation").val('');
        });

        function logs_filter_data_table() {
            var formData = {
                daterange: $("#reservation").val(),
                company: $("#company").val(),
                country_code: $("#country_code").val(),
                "_token": "{{ csrf_token() }}",
            };
            $('#logs_table').DataTable({
                "pageLength": 25,
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
        }

        logs_filter_data_table()
    </script>
@stop
