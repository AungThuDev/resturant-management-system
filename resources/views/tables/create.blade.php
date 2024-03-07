@extends('layouts.master')

@section('content')
    <div class="col-7">
        <form action="{{ route('tables.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Table Name</label>
                <input type="text" name="name" class="form-control">
                @error('name')
                    <span class="badge badge-danger">{{ $message }}</span>
                @enderror
            </div>
            <button class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
