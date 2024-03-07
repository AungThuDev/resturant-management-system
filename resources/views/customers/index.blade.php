@extends('layouts.master')
@section('header','Customers Table')
@section('cus-active','active')
@section('content')
    <div>
        <a href="{{route('customers.create')}}" class="btn btn-dark mb-3" style="float: right;margin-right:25px;background-color: #204c2d!important;">Create Customer</a>
    </div>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Discount</th>
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
                url : "/customers/",
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
                    "data" : "percent"
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
              url : '/customers/' + id,
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