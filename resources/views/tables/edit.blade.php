@extends('layouts.master')

@section('content')
    <div class="col-7">
        <form action="{{ route('tables.update', $table->id) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name">Table Name</label>
                <input type="text" name="name" value="{{ $table->name }}" class="form-control">
            </div>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
