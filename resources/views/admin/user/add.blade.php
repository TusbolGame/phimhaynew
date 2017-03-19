@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">User
        <small class="text-danger">Add</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-7" style="padding-bottom:120px">
    <form action="{{ route('admin.user.getAdd') }}" method="POST">
        @include('admin.messages.messages')
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Tên tài khoản<span class="text-danger">*</span></label>
            <input class="form-control" name="txtUsername" value="{{ old('txtUsername') }}" placeholder="Nhập tên tài khoản" required="true" />
        </div>
        <div class="form-group">
            <label>Mật khẩu<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="txtPass" value="{{ old('txtPass') }}" placeholder="Nhập mật khẩu" required="true" />
        </div>
        <div class="form-group">
            <label>Xác nhận mật khẩu<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="txtRePass" value="{{ old('txtRePass') }}" placeholder="Nhập xác nhận mật khẩu" required="true" />
        </div>
        <div class="form-group">
            <label>Tên<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txtFirstName" value="{{ old('txtFirstName') }}" placeholder="Nhập tên" required="true" />
        </div>
        <div class="form-group">
            <label>Họ<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txtLastName" value="{{ old('txtLastName') }}" placeholder="Nhập họ" required="true" />
        </div>
        <div class="form-group">
            <label>Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="txtEmail" value="{{ old('txtEmail') }}" placeholder="Nhập Email" required="true" />
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
            <label>Kích hoạt</label>
            <label class="radio-inline">
                <input name="rdoActived" value="1" type="radio" @if(old('rdoActived')=='1') checked @endif @if(!old('rdoActived')) checked @endif>True
            </label>
            <label class="radio-inline">
                <input name="rdoActived" value="0" @if(old('rdoActived')=='0') checked @endif type="radio">False
            </label>
        </div>
        <div class="form-group">
            <label>Đã chặn</label>
            <label class="radio-inline">
                <input name="rdoBlocked" value="1" @if(old('rdoBlocked')=='1') checked @endif type="radio">True
            </label>
            <label class="radio-inline">
                <input name="rdoBlocked" value="0" type="radio" @if(old('rdoBlocked')=='0') checked @endif @if(!old('rdoBlocked')) checked @endif>False
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Thêm thành viên</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>
@endsection
