@extends('layouts.master')

@section('content')
    <div>
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Table Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <button class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
