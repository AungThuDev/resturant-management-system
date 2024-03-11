@extends('layouts.master')
@section('header', 'Current Orders')
@section('order-active', 'active')
@section('content')
    <div>
        <a href="{{ route('plan') }}" class="btn btn-dark float-right mt-3 mb-3">Dinning Plans</a>

    </div>
    <table class="table table-bordered table-striped" id="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Table Name</th>
                <th>Total</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
@endsection
@section('script')
    <script>
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/order-list/",
                error: function(xhr, textStatus, errorThrown) {}
            },
            "columns": [{
                    "data": "id",
                },
                {
                    "data": "dinning_plan",
                },
                {
                    "data": "total_amount",
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
