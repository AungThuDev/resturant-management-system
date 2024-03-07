@extends('layouts.master')
@section('header','Kitchen Table')
@section('kitchen-active','active')
@section('content')
    <div>
<<<<<<< HEAD
        <a href="{{route('kitchens.create')}}" class="btn btn-dark mb-3" style="float: right;margin-right:25px;background-color: #204c2d!important;">Create Kitchen</a>
=======
        <a href="{{route('kitchens.create')}}" class="btn btn-dark mb-3" style="float: right;margin-right:25px;">Create Kitchen</a>
>>>>>>> origin/main
    </div>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th>No.</th>
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
                url : "/kitchens/",
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
              url : '/kitchens/' + id,
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