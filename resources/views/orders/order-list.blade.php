@extends('layouts.master')

@section('content')
    <div>
        <a href="{{ route('plan') }}" class="btn btn-dark float-right mt-3 mb-3">Dinning Plans</a>

    </div>
    <table class="table table-hover">
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
            @foreach ($orders as $order)
                <tr>
                    <td>
                        {{ $order->id }}
                    </td>
                    <td>{{ $order->dinning_plan }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>
                        {{ $order->created_at->format('jS M h:i a') }}
                    </td>
                    <td>
                        <a href="{{ route('order.detail', $order->id) }}" class="btn btn-sm btn-primary">Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
