@extends('layouts.master')
@section('header','CategoryDiscount Table')
@section('catDis-active','active')
@section('content')
    <form action="{{route('categoryDiscounts.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Discount Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="percent">Discount Percent</label>
            <input type="text" name="percent" class="form-control">
        </div>
        <div class="form-group">
        <label for="categories">Choose Categories</label>
        <select name="categories[]" id="categories" multiple>
            @foreach($categories as $p)
            <option value="{{$p->id}}">{{$p->name}}</option>
            @endforeach
        </select>
        </div>
        <input type="submit" value="Create CategoryDiscount" class="btn btn-success" style="background-color: #204c2d!important;">
        <a href="{{route('categoryDiscounts.index')}}" class="btn btn-dark">Back</a>
    </form>
@endsection
@section('script')
<script>
    $('#categories').select2();
</script>
@endsection