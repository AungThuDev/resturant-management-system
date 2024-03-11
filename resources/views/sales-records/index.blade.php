@extends('layouts.master')
@section('header', 'Sales Record')
@section('role-active', 'active')
@section('content')
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Discounted Amount</th>
                <th>Date</th>
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
                url: "/sales-records/",
                error: function(xhr, textStatus, errorThrown) {}
            },
            "columns": [{
                    "data": "order_id",
                },
                {
                    "data": "amount",
                },
                {
                    "data": "discounted_amount",
                },
                {
                    "data": "order_date",
                },
                {
                    "data": "action",
                }
            ]
        });
    </script>
@endsection
