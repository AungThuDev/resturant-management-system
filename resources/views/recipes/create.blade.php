@extends('layouts.master')
@section('header','Recipe Create Form')
@section('role-active','active')
@section('style')
<style>
    .select2-container--default .select2-selection--single{
        height: 50px!important;
    }
</style>
@endsection
@section('content')
<form action="{{route('recipes.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{old('name')}}">
        @error('name')
            <span class="badge badge-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" name="price" class="form-control" value="{{old('price')}}">
        @error('price')
            <span class="badge badge-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="categories">Choose Category</label>
        <select name="category" id="categories">
            @foreach($categories as $c)
            <option value="{{$c->id}}">{{$c->name}}</option>
            @endforeach
        </select>
        @error('category')
            <span class="badge badge-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="kitchens">Choose Kitchen</label>
        <select name="kitchen" id="kitchens">
            @foreach($kitchens as $k)
            <option value="{{$k->id}}">{{$k->name}}</option>
            @endforeach
        </select>
        @error('kitchen')
            <span class="badge badge-danger">{{$message}}</span>
        @enderror
    </div>
    <input type="file" name="image"><br><br>
    @error('image')
            <span class="badge badge-danger">{{$message}}</span><br><br>
    @enderror
    <input type="submit" value="Create Recipe" class="btn btn-success">
    <a href="{{route('recipes.index')}}" class="btn btn-dark">Back</a>
</form>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#categories').select2();
        $('#kitchens').select2();
    });
</script>
@endsection