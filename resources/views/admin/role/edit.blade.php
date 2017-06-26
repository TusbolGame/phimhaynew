@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Role
        <small class="text-danger">Edit</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
    <form action="{!! route('admin.role.update', [$role->id]) !!}" method="POST" class="form-add-film">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{!! $role->id !!}">
        <div class="col-lg-8">
            <div class="form-group">
              <label>Role name</label>
              <input type="text" class="form-control" name="role_name" placeholder="Nhập tên Role" required="true" value="{!! old('role_name', $role->role_name) !!}" autocomplete="off">
            </div>
            <div class="form-group">
              <label>Role description</label>
              <input type="text" class="form-control" name="role_description" placeholder="Nhập Role description" value="{!! old('role_description', $role->role_description) !!}" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Permission</label>             
                @foreach($permission as $key)
                    <div class="checkbox">
                        <label><input type="checkbox" name="permission_id[]" value="{!! $key->id !!}" @if(isset($check_permission[$key->id])) checked @endif >{!! $key->permission_name !!}</label>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Update Role">
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
        
    <form>
</div>
@endsection
