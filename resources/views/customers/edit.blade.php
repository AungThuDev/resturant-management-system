@extends('layouts.master')
@section('header','Create Update Form')
@section('cus-active','active')
@section('content')
    <form action="{{route('customers.update',$cus->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Customer Name</label>
            <input type="text" name="name" class="form-control" value="{{$cus->name}}">
        </div>
        <div class="form-group">
            <label for="name">Discount %</label>
            <input type="number" name="percent" class="form-control" value="{{$cus->percent}}">
        </div>
        <input type="submit" value="Update Customer" class="btn btn-success" style="background-color: #204c2d!important;">
        <a href="{{route('customers.index')}}" class="btn btn-dark">Back</a>
    </form>
@endsection