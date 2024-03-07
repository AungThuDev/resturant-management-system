@extends('layouts.master')
@section('header','Create User Form')
@section('user-active','active')
@section('content')
<form action="{{route('users.store')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">User Name</label>
        <input type="text" name="name" class="form-control">
        @error('name')
            <span class="badge badge-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control">
        @error('email')
            <span class="badge badge-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
        @error('password')
            <span class="badge badge-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
    </div>
    <input type="submit" class="btn btn-success" value="Create User">
    <a href="{{route('users')}}" class="btn btn-dark">Back</a>
</form>
@endsection