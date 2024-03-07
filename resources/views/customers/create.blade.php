@extends('layouts.master')
@section('header','Create Customer Form')
@section('cus-active','active')
@section('content')
    <form action="{{route('customers.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Customer Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="name">Discount %</label>
            <input type="number" name="percent" class="form-control">
        </div>
        <input type="submit" value="Create Customer" class="btn btn-success" style="background-color: #204c2d!important;">
        <a href="{{route('customers.index')}}" class="btn btn-dark">Back</a>
    </form>
@endsection