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
            <label>Tên đăng nhập<span class="text-danger">*</span></label>
            <input class="form-control" name="txtUsername" value="{!! old('txtUsername', isset($user) ? $user['username'] : '') !!}" readonly  />
        </div>
        @if(Auth::user()->id == $id)
        <div class="checkbox">
            <label>
            <input type="checkbox" name="chkEditPassword" class="chkEditPassword" value="1" @if(old('chkEditPassword')) checked @endif/>Hiện/Ẩn cập nhật mật khẩu</label>
        </div>
        <div class="form-group edit-password hide">
            <label>Mật khẩu cũ<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="txtPassOld" value="" placeholder="Please Enter Password" />
        </div>
        <div class="form-group edit-password hide">
            <label>Mật khẩu mới<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="txtPass" value="" placeholder="Nhập mật khẩu mới" />
        </div>
        <div class="form-group edit-password hide">
            <label>Xác nhận mật khẩu mới<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="txtRePass" placeholder="Nhập lại mật khẩu mới" />
        </div> 
        <div class="form-group">
            <label>Tên<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txtFirstName" value="{!! old('txtFirstName', isset($user) ? $user['first_name'] : '') !!}" placeholder="Nhập tên" required="true" />
        </div>
        <div class="form-group">
            <label>Họ<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txtLastName" value="{!! old('txtLastName', isset($user) ? $user['last_name'] : '') !!}" placeholder="Nhập họ" required="true" />
        </div>
        <div class="form-group">
            <label>Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="txtEmail" value="{!! old('txtEmail', isset($user) ? $user['email'] : '') !!}" placeholder="Nhập email" />
        </div>
        @endif
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
        <div class="form-group">
            <label>Kích hoạt</label>
            <label class="radio-inline">
                <input name="rdoActived" value="1" @if(old('rdoActived', $user['actived']) == 1) checked @endif type="radio">True
            </label>
            <label class="radio-inline">
                <input name="rdoActived" value="0" type="radio" @if(old('rdoActived', $user['actived']) == 0) checked @endif>False
            </label>
        </div>
        <div class="form-group">
            <label>Đã Chặn</label>
            <label class="radio-inline">
                <input name="rdoBlocked" value="1" @if(old('rdoBlocked', $user['blocked']) == 1) checked @endif type="radio">True
            </label>
            <label class="radio-inline">
                <input name="rdoBlocked" value="0" type="radio" @if(old('rdoBlocked', $user['blocked']) == 0) checked @endif>False
            </label>
        </div>
        @endif
        <button type="submit" class="btn btn-primary">User Edit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>
@endsection

                