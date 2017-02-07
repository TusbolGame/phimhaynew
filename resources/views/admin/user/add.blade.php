@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">User
        <small>Add</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
    <form action="{{ route('admin.user.getAdd') }}" method="POST">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Username<span class="text-danger">*</span></label>
            <input class="form-control" name="txtUsername" value="{{ old('txtUsername') }}" placeholder="Please Enter Username" required="true" />
        </div>
        <div class="form-group">
            <label>Password<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="txtPass" value="{{ old('txtPass') }}" placeholder="Please Enter Password" required="true" />
        </div>
        <div class="form-group">
            <label>RePassword<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="txtRePass" value="{{ old('txtRePass') }}" placeholder="Please Enter RePassword" required="true" />
        </div>
        <div class="form-group">
            <label>First Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txtFirstName" value="{{ old('txtFirstName') }}" placeholder="Please Enter First Name" required="true" />
        </div>
        <div class="form-group">
            <label>Last Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txtLastName" value="{{ old('txtLastName') }}" placeholder="Please Enter Last Name" required="true" />
        </div>
        <div class="form-group">
            <label>Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="txtEmail" value="{{ old('txtEmail') }}" placeholder="Please Enter Email" required="true" />
        </div>
        <div class="form-group">
            <label>User Level</label>
            <label class="radio-inline">
                <input name="rdoLevel" value="1" @if(old('rdoLevel')=='1') checked @endif type="radio">Admin
            </label>
            <label class="radio-inline">
                <input name="rdoLevel" value="2" type="radio" @if(old('rdoLevel')=='2') checked @endif @if(!old('rdoLevel')) checked @endif>Member
            </label>
        </div>
        <div class="form-group">
            <label>Actived</label>
            <label class="radio-inline">
                <input name="rdoActived" value="1" type="radio" @if(old('rdoActived')=='1') checked @endif @if(!old('rdoActived')) checked @endif>True
            </label>
            <label class="radio-inline">
                <input name="rdoActived" value="0" @if(old('rdoActived')=='0') checked @endif type="radio">False
            </label>
        </div>
        <div class="form-group">
            <label>Blocked</label>
            <label class="radio-inline">
                <input name="rdoBlocked" value="1" @if(old('rdoBlocked')=='1') checked @endif type="radio">True
            </label>
            <label class="radio-inline">
                <input name="rdoBlocked" value="0" type="radio" @if(old('rdoBlocked')=='0') checked @endif @if(!old('rdoBlocked')) checked @endif>False
            </label>
        </div>
        <button type="submit" class="btn btn-default">User Add</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>
@endsection
