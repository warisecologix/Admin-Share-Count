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
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Total Shares</th>
                                        <th>Verify Shares</th>
                                        <th>Un-Verify Shares</th>
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
    <script type="text/javascript">
        $(function () {
            $('#user_logs_table').DataTable({
                processing: true,
                serverSide: true,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                    'pdf',
                    'print'
                ],
                ajax: "{{ route('users_data_table') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'intro'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_no', name: 'phone_no'},
                    {data: 'total_shares', name: 'total_shares'},
                    {data: 'verify_shares', name: 'verify_shares'},
                    {data: 'un_verify_shares', name: 'un_verify_shares'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    {data: "first_name", name: "first_name", visible: false},
                    {data: "last_name", name: "last_name", visible: false}
                ],
            });

        });
    </script>
@stop
