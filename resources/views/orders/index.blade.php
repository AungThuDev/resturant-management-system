@extends('layouts.master')

@section('content')
    @livewire('show-recipes', ['categories' => $categories, 'table' => $table, 'tastes' => $tastes])
@endsection
