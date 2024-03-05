@extends('layouts.master')
@section('header','Role Table')
@section('role-active','active')
@section('content')
    <form action="{{route('roles.update',$role->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Role's Name</label>
            <input type="text" class="form-control" name="name" value="{{$role->name}}">
            @error('name')
                <span class="badge badge-danger">{{$message}}</span>
            @enderror
        </div>
        <input type="submit" value="Update Role" class="btn btn-success">
        <a href="{{route('roles.index')}}" class="btn btn-dark">Back</a>
    </form>
@endsection