@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header">User
        <small class="text-danger">Edit</small>
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
            <input class="form-control" name="txtUsername" value="{!! old('txtUsername', isset($user) ? $user->username : '') !!}" readonly  />
        </div>
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
            <input type="text" class="form-control" name="txtFirstName" value="{!! old('txtFirstName', isset($user) ? $user->first_name : '') !!}" placeholder="Nhập tên" required="true" />
        </div>
        <div class="form-group">
            <label>Họ<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="txtLastName" value="{!! old('txtLastName', isset($user) ? $user->last_name : '') !!}" placeholder="Nhập họ" required="true" />
        </div>
        <div class="form-group">
            <label>Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="txtEmail" value="{!! old('txtEmail', isset($user) ? $user->email : '') !!}" placeholder="Nhập email" />
        </div>
        {{-- role --}}
        @if(Auth::user()->id != $id)
            <div class="form-group">
                <label>Role</label>
                <select name="role_id" class="form-control">
                    @foreach($role as $data)
                        <option value="{!! $data->id !!}" @if(old('role_id', isset($user->userRole->role_id) ? $user->userRole->role_id : '') == $data->id) selected @endif>{!! $data->role_name !!}</option>
                    @endforeach
                </select>
                
            </div>
            <div class="form-group">
                <label>Kích hoạt</label>
                <label class="radio-inline">
                    <input name="rdoActived" value="1" @if(old('rdoActived', $user->actived) == 1) checked @endif type="radio">True
                </label>
                <label class="radio-inline">
                    <input name="rdoActived" value="0" type="radio" @if(old('rdoActived', $user->actived) == 0) checked @endif>False
                </label>
            </div>
            <div class="form-group">
                <label>Đã Chặn</label>
                <label class="radio-inline">
                    <input name="rdoBlocked" value="1" @if(old('rdoBlocked', $user->blocked) == 1) checked @endif type="radio">True
                </label>
                <label class="radio-inline">
                    <input name="rdoBlocked" value="0" type="radio" @if(old('rdoBlocked', $user->blocked) == 0) checked @endif>False
                </label>
            </div>
        @else
            <em><strong>Role</strong>: {!! $user->userRole->role->role_name !!}</em><br>
        @endif
        
        <button type="submit" class="btn btn-primary">Update User</button>
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>
@endsection

                