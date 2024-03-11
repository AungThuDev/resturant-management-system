@extends('layouts.master')
@section('header', 'Sales Record Details')
@section('role-active', 'active')
@section('content')
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Recipe</th>
                <th>Taste</th>
                <th>Quantity</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $detail)
                <tr>
                    <td>{{ $detail->order_id }}</td>
                    @foreach ($detail->recipes as $recipe)
                        <td>{{ $recipe->name }}</td>
                    @endforeach
                    <td>{{ $detail->taste }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
