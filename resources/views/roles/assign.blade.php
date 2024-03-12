@extends('layouts.master')

@section('header','Assign Role & Permission')
@section('role-active','actvie')

@section('content')
    <form action="{{route('roles.assignPermissions',$role->id)}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" class="form-control" name="role" value="{{$role->name}}" disabled>
        </div>
        <div class="form-group">
                <label for="" ><b>Choose Permissions</b></label><br><br>
                @foreach($permissions as $p)
                <div class="form-check">
                    <input class="form-check-input" name="permissions[]" type="checkbox" value="{{$p->name}}" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        {{$p->name}}
                    </label>
                </div>
                @endforeach
        </div>
        <input type="submit" value="Assign Role & Permission" class="btn btn-success">
    </form>
@endsection