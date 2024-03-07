@extends('layouts.master')
@section('header', 'Kitchen Form')
@section('kitchen-active', 'active')
@section('content')
    <form action="{{ route('kitchens.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Kitchen's Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            @error('name')
                <span class="badge badge-danger">{{ $message }}</span>
            @enderror
        </div>
        <input type="submit" value="Create Kitchen" class="btn btn-success">
        <a href="{{ route('kitchens.index') }}" class="btn btn-dark">Back</a>
    </form>
@endsection
