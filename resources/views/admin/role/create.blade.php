@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">Role
        <small class="text-danger">Create</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12" style="padding-bottom:120px">
    <form action="{{ route('admin.role.store') }}" method="POST" class="form-add-person">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="col-lg-8">
            <div class="form-group">
                <label>Role name</label>
                <input type="text" class="form-control" name="role_name" placeholder="Nhập tên Role" required="true" value="{!! old('role_name') !!}" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Role description</label>
                <input type="text" class="form-control" name="role_description" placeholder="Nhập Role description" value="{!! old('role_description') !!}" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Permission</label>             
                @foreach($permission as $key)
                    <div class="checkbox">
                        <label><input type="checkbox" name="permission_id[]" value="{!! $key->id !!}" @if(!empty(old('permission_id')) && in_array($key->id, old('permission_id'))) checked="checked" @endif>{!! $key->permission_name !!}</label>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Create Role">
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
        
    <form>
</div>
@endsection
