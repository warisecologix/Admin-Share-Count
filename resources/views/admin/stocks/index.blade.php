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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Filters</h3>
                            </div>
                            <div class="card-body">
                                <form action="javascript:void(0);">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" id="email"
                                                       placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <select class="form-control select2bs4" name="status" id="status">
                                                    <option value="3" selected>Select Status</option>
                                                    <option value="2">All</option>
                                                    <option value="1">Verify</option>
                                                    <option value="0">Un-Verify</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control daterange" name="daterange"
                                                       id="reservation"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="button" class="btn btn-success" onclick="reDrawDataTable()">
                                                Search
                                            </button>
                                            <button type="button" onclick="resetFilter()" class="btn btn-info"> Clear
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Stock Details</h3>
                            </div>
                            <div class="card-body">
                                <table id="stocks_table" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
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
    <script>
        let stock_table;

        function reDrawDataTable() {
            $('#stocks_table').DataTable().clear().destroy();
            stocks_filter_data_table()
        }

        $(function () {
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            $('#reservation').daterangepicker();
            $("#reservation").val('');

        });

        function updateStatus(id) {
            var formData = {
                stock_id: id,
                "_token": "{{ csrf_token() }}",
            };
            var type = "POST";
            $.ajax({
                type: type,
                url: "{{route('update_stock_status')}}",
                data: formData,
                dataType: 'json',
                success: function (data) {
                    $('#stocks_table').DataTable().ajax.reload();
                },
            });
        }
    </script>
    <script type="text/javascript">
        function resetFilter() {
            $("#reservation").val('');
            $("#email").val('');
            $("#status").val('3');
            reDrawDataTable();
        }

        function stocks_filter_data_table() {
            var formData = {
                daterange: $("#reservation").val(),
                email: $("#email").val(),
                status: $("#status").val(),
                "_token": "{{ csrf_token() }}",
            };
            stock_table = $('#stocks_table').DataTable({
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
                    url: "{{route('stocks_filter_data_table')}}",
                    type: "POST",
                    data: formData,
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'user_name', name: 'user_name'},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'no_shares_own', name: 'no_shares_own'},
                    {data: 'brokage_name', name: 'brokage_name'},
                    {data: 'date_purchase', name: 'date_purchase'},
                    {data: 'admin_verify', name: 'admin_verify'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });
        }

        stocks_filter_data_table();
    </script>
@stop
