@extends('layouts.master')

@section('header','Update Role & Permission')
@section('role-active','actvie')

@section('content')
    <form action="{{route('roles.updatePermissions',$role->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" class="form-control" name="name" value="{{$role->name}}">
        </div>
        <div class="form-group">
                <label for="" ><b>Choose Permissions</b></label><br><br>
                @foreach($permissions as $p)
                <div class="form-check">
                    <input class="form-check-input" name="permissions[]" type="checkbox" value="{{$p->name}}" id="label{{$p->id}}"
                    @foreach($role->permissions as $per)
                    @if($per->name == $p->name )
                    checked
                    @endif
                    @endforeach
                    >
                    <label class="form-check-label" for="flexCheckDefault">
                        {{$p->name}}
                    </label>
                    
                </div>
                @endforeach
        </div>
        <input type="submit" value="Update Role & Permission" class="btn btn-success">
    </form>
@endsection