@extends('layouts.master')
@section('header','Update Role and Permission Form')
@section('user-active','active')
@section('style')
<style>
    .select2-container--default .select2-selection--single {
        height: 50px !important;
    }
</style>
@endsection
@section('content')
<form action="{{route('users.update',$user->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">User</label>
        <input type="text" name="name" class="form-control" value="{{$user->name}}">
    </div>
    <div class="form-group">
        <label for="categories">Choose Role</label>
        <select name="role" id="role">
            @foreach($roles as $r)
            
            <option value="{{$r->id}}"
            @foreach($user->roles as $role)
                @if($role->name == $r->name )
                selected
                @endif
            @endforeach
            >{{$r->name}}</option>
            
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for=""><b>Choose Permissions</b></label><br><br>
        @foreach($permissions as $p)
        <input type="checkbox" name="permissions[]" value="{{$p->id}}" id="label{{$p->id}}"
        @foreach($user->roles as $role)
            @foreach($role->permissions as $permission)
                @if($permission->name == $p->name)
                    checked
                @endif
            @endforeach
        @endforeach
        >

        <label for="label{{$p->id}}">{{$p->name}}</label><br>
        @endforeach
    </div>
    <input type="submit" class="btn btn-success" value="Update Permission" style="background-color: #204c2d!important;">
</form>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#role').select2();
    });
</script>
@endsection