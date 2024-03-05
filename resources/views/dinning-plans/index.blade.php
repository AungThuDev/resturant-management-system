@extends('layouts.master')

@section('content')
    <h1 class="text-center">Seating Plans</h1>
    <div class="row">
        @foreach ($tables as $table)
            <div class="col-4">
                <a href="{{ route('order.here', $table->id) }}">
                    <div class="card p-3 text-center shadow-lg">
                        <i class="fa-solid fa-utensils" style="font-size: 120px;"></i><br>
                        <h3 class="">{{ $table->name }}</h3>
                        <div>
                            @if ($table->status == 'available')
                                <span class="badge badge-success">{{ $table->status }}</span>
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
