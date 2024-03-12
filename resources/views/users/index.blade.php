@extends('layouts.master')
@section('header', 'User Table')
@section('user-active', 'active')
@section('content')
    <div>
        <a href="{{ route('users.create') }}" class="btn btn-dark mb-3" style="float: right;margin-right:25px;">Create User</a>
    </div>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
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
                url: "/users/",
                error: function(xhr, textStatus, errorThrown) {}
            },
            "columns": [{
                    "data": "id",
                },
                {
                    "data": "name",
                },
                {
                    "data": "email",
                },
                {
                    "data":"role",
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
                        url: '/users/' + id,
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
