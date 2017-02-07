@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">User
        <small>Edit</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
    <form action="" method="POST">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Username<span class="text-danger">*</span></label>
            <input class="form-control" name="txtUsername" value="{!! old('txtUsername', isset($user) ? $user['username'] : '') !!}" readonly  />
        </div>
        <div class="checkbox">
            <label>
            <input type="checkbox" name="chkEditPassword" class="chkEditPassword" value="1" @if(old('chkEditPassword')) checked @endif/>Show/Hide Edit Password</label>
        </div>
        <div class="form-group edit-password hide">
            <label>Password<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="txtPass" value="" placeholder="Please Enter Password" />
        </div>
        <div class="form-group edit-password hide">
            <label>RePassword<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="txtRePass" placeholder="Please Enter RePassword" />
        </div>
        <div class="form-group">
            <label>First Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txtFirstName" value="{!! old('txtFirstName', isset($user) ? $user['first_name'] : '') !!}" placeholder="Please enter First Name" required="true" />
        </div>
        <div class="form-group">
            <label>Last Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txtLastName" value="{!! old('txtLastName', isset($user) ? $user['last_name'] : '') !!}" placeholder="Please enter Last Name" required="true" />
        </div>
        <div class="form-group">
            <label>Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="txtEmail" value="{!! old('txtEmail', isset($user) ? $user['email'] : '') !!}" placeholder="Please Enter Email" />
        </div>
        @if(Auth::user()->id == 1 && $id == 1 || Auth::user()->id == $id)
        @else
        <div class="form-group">
            <label>User Level</label>
            <label class="radio-inline">
                <input name="rdoLevel" value="1" @if(old('rdoLevel', $user['level']) == 1) checked @endif type="radio">Admin
            </label>
            <label class="radio-inline">
                <input name="rdoLevel" value="2" type="radio" @if(old('rdoLevel', $user['level']) == 2) checked @endif>Member
            </label>
        </div>
        @endif
        <div class="form-group">
            <label>Actived</label>
            <label class="radio-inline">
                <input name="rdoActived" value="1" @if(old('rdoActived', $user['actived']) == 1) checked @endif type="radio">True
            </label>
            <label class="radio-inline">
                <input name="rdoActived" value="0" type="radio" @if(old('rdoActived', $user['actived']) == 0) checked @endif>False
            </label>
        </div>
        <div class="form-group">
            <label>Blocked</label>
            <label class="radio-inline">
                <input name="rdoBlocked" value="1" @if(old('rdoBlocked', $user['blocked']) == 1) checked @endif type="radio">True
            </label>
            <label class="radio-inline">
                <input name="rdoBlocked" value="0" type="radio" @if(old('rdoBlocked', $user['blocked']) == 0) checked @endif>False
            </label>
        </div>
        <button type="submit" class="btn btn-default">User Edit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>
@endsection

                