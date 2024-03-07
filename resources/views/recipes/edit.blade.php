@extends('layouts.master')
@section('header', 'Recipe Update Form')
@section('role-active', 'active')
@section('style')
    <style>
        .select2-container--default .select2-selection--single {
            height: 50px !important;
        }
    </style>
@endsection
@section('content')
    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $recipe->name }}">
            @error('name')
                <span class="badge badge-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="{{ $recipe->price }}">
            @error('price')
                <span class="badge badge-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="categories">Choose Category</label>
            <select name="category" id="categories">
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}" {{ $c->id == $recipe->category_id ? 'selected' : '' }}>
                        {{ $c->name }}</option>
                @endforeach
            </select>
            @error('category')
                <span class="badge badge-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="kitchens">Choose Kitchen</label>
            <select name="kitchen" id="kitchens">
                @foreach ($kitchens as $k)
                    <option value="{{ $k->id }}" {{ $k->id == $recipe->kitchen_id ? 'selected' : '' }}>
                        {{ $k->name }}</option>
                @endforeach
            </select>
            @error('kitchen')
                <span class="badge badge-danger">{{ $message }}</span>
            @enderror
        </div>
        <input type="file" name="image"><br><br>
        @error('image')
            <span class="badge badge-danger">{{ $message }}</span><br><br>
        @enderror
        <img src="{{ asset('/images/' . $recipe->image) }}" alt="recipe-phot" width="150" height="150"><br><br>
        <input type="submit" value="Update Recipe" class="btn btn-success">
        <a href="{{ route('recipes.index') }}" class="btn btn-dark">Back</a>
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
