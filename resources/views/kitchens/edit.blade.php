@extends('layouts.master')
@section('header','Kitchen Form')
@section('kitchen-active','active')
@section('content')
    <form action="{{route('kitchens.update',$k->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Kitchen's Name</label>
            <input type="text" class="form-control" name="name" value="{{$k->name}}">
            @error('name')
                <span class="badge badge-danger">{{$message}}</span>
            @enderror
        </div>
        <button class="btn btn-success">Update Kitchen</button>
        <a href="{{route('kitchens.index')}}" class="btn btn-dark">Back</a>
    </form>
@endsection