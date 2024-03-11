@extends('layouts.master')
@section('table-active', 'active')
@section('content')
    <div>
        <a href="{{ route('tables.create') }}" class="btn btn-dark mb-3" style="float: right;margin-right:25px;">Create
            Table</a>
    </div>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
@endsection
@section('script')
    <script>
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/tables/",
                error: function(xhr, textStatus, errorThrown) {}
            },
            "columns": [{
                    "data": "id",
                },
                {
                    "data": "name",
                },
                {
                    "data": "action",
                }
            ]
        });
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure, you want to delete?',
                showCancelButton: true,
                confirmButtonText: 'Confirm',

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/tables/' + id,
                        type: 'DELETE',
                        success: function() {
                            table.ajax.reload();
                        }
                    });
                }
            })
        });
    </script>
@endsection
