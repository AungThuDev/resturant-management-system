@extends('layouts.master')
@section('dinning-active', 'active')
@section('content')
    <h1 class="text-center">Seating Plans</h1>
    <div class="row">
        @foreach ($tables as $table)
            <div class="col-4">
                <a href="{{ route('order.here', $table->id) }}">
                    <div class="card p-3 text-center shadow-lg">
                        <i class="fa-solid fa-utensils" style="font-size: 120px;color: #204c2d"></i><br>
                        <h3 class=""><span style="color: #204c2d">{{ $table->name }}</span></h3>
                        <div>
                            @if ($table->status == 'available')
                                <span class="badge badge-primary">{{ $table->status }}</span>
                            @else
                                <span class="badge badge-danger">{{ $table->status }}</span>
                            @endif
                        </div>
                    </div>

                </a>
            </div>
        @endforeach
    </div>
@endsection
