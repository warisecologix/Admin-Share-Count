@section('js')
    <script src="{{asset('js/jquery3.1.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript">
        $('.daterange').daterangepicker();
        $('#daterange').val('');
    </script>
    <script>
        function updateStatus(id) {
            if (!confirm("Are you sure?")) {
                return false;
            }
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
                    window.location.href = window.location.href
                },
            });
        }

    </script>
@endsection
