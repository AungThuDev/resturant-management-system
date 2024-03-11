@extends('layouts.master')

@section('dinning-active', 'nav-link active')

@section('content')
    @livewire('show-recipes', ['categories' => $categories, 'table' => $table, 'tastes' => $tastes])
@endsection
