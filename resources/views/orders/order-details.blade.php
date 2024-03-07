@extends('layouts.master')

@section('content')
    @livewire('order-details', ['details' => $details, 'discount_name' => $discount_name, 'total' => $total, 'order' => $order])
@endsection
