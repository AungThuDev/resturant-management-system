@extends('layouts.master')
@section('header','Category Form')
@section('cat-active','active')
@section('content')
<form action="{{route('categories.update',$c->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" name="name" class="form-control" value="{{$c->name}}">
        @error('name')
            <span class="badge badge-danger">{{$message}}</span>
        @enderror
    </div>
    <input type="submit" class="btn btn-success" value="Update Category" style="background-color: #204c2d!important;">
    <a href="{{route('categories.index')}}" class="btn btn-dark">Back</a>
</form>
@endsection