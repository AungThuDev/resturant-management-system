@extends('layouts.master')

@section('content')
    <livewire:show-recipes :categories="$categories" />
@endsection
