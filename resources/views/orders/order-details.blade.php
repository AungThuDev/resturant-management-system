@extends('layouts.master')
@section('header', 'Order Details')
@section('order-active', 'active')
@section('content')
    @livewire('order-details', ['details' => $details, 'discount_name' => $discount_name, 'total' => $total, 'order' => $order])
@endsection
