@extends('layouts.master')
@section('header', 'Recipes Table')
@section('recipe-active', 'active')
@section('content')
    <div>
        <a href="{{ route('recipes.create') }}" class="btn btn-dark mb-3" style="float: right;margin-right:25px;">Create
            Role</a>
    </div>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Kitchen</th>
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
                url: "/recipes/",
                error: function(xhr, textStatus, errorThrown) {}
            },
            "columns": [{
                    "data": "id",
                },
                {
                    "data": "name",
                },
                {
                    "data": "price",
                },
                {
                    "data": "image",
                },
                {
                    "data": "category_id",
                },
                {
                    "data": "kitchen_id",
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
                        url: '/recipes/' + id,
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
