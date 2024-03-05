@extends('layouts.master')
@section('header','Role Table')
@section('role-active','active')
@section('content')
    <div>
        <a href="{{route('roles.create')}}" class="btn btn-dark mb-3" style="float: right;margin-right:25px;">Create Role</a>
    </div>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Role Name</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
@endsection
@section('script')
    <script>
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url : "/roles/",
                error : function(xhr, textStatus, errorThrown) {
                }
            },
            "columns" : [
                {
                    "data" : "id",
                },
                {
                    "data" : "name",
                },
                {
                    "data" : "action",
                }
            ]
        });
        $(document).on('click','.delete',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
          title: 'Are you sure, you want to delete?',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url : '/roles/' + id,
              type : 'DELETE',
              success : function(){
                table.ajax.reload();
              }
            });
          }
        }
      )
      });
    </script>
@endsection