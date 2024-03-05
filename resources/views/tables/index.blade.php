@extends('layouts.master')

@section('content')
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tables as $table)
                <tr>
                    <td>{{ $table->id }}</td>
                    <td>{{ $table->name }}</td>
                    <td class="d-flex">
                        <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-sm btn-warning"><i
                                class="fa fa-edit"></i></a>
                        <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
