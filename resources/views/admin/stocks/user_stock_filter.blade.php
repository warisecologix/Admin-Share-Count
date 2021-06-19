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
                                <table id="user_stocks_table" class="table table-bordered table-striped">
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
    <script>
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
                    $('#user_stocks_table').DataTable().ajax.reload();
                },
            });
        }
    </script>
    <script type="text/javascript">
        $(function () {
            var formData = {
                type: "{{$type}}",
                value: "{{$value}}",
                "_token": "{{ csrf_token() }}",
            };
            $('#user_stocks_table').DataTable({
                processing: true,
                serverSide: true,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // dom: 'Bfrtip',
                // buttons: [
                //     'excel',
                //     'pdf',
                //     'print'
                // ],
                ajax: {
                    url: "{{route('user_stocks_filter_data_table')}}",
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

        });
    </script>
@stop
