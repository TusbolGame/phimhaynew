@extends('phimhay.master')
@section('title', 'Đăng ký thành viên - PhimHay')
@section('description', 'Đăng ký thành viên')
@section('content')
<div class="div-center">
	<div class="container-fluid">
		<div class="user-register">
			<h3 class="text-center">Đăng ký thành viên</h3>
			<hr>
			<div class="form-register">
				<form action="{{ route('auth.getRegister') }}" method="POST">
			        @include('admin.messages.messages')
			        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
			        @if(Session::has('errors_captcha_register'))
		                <p style="color:red">* {{ Session::get('errors_captcha_register') }}</p>
		            @endif
			        <div class="form-group">
			            <label>Tài Khoản<span class="text-danger">*</span></label>
			            <input class="form-control" name="txtUsername" value="{{ old('txtUsername') }}" placeholder="Tên Tài khoản" required="true" />
			        </div>
			        <div class="form-group">
			            <label>Mật Khẩu<span class="text-danger">*</span></label>
			            <input type="password" class="form-control" name="txtPass" value="" placeholder="Mật khẩu" required="true" />
			        </div>
			        <div class="form-group">
			            <label>Nhập Lại Mật Khẩu<span class="text-danger">*</span></label>
			            <input type="password" class="form-control" name="txtRePass" value="" placeholder="Nhập lại Mật khẩu" required="true" />
			        </div>
			        <div class="form-group">
			            <label>Tên<span class="text-danger">*</span></label>
			            <input type="text" class="form-control" name="txtFirstName" value="{{ old('txtFirstName') }}" placeholder="Tên" required="true" />
			        </div>
			        <div class="form-group">
			            <label>Họ<span class="text-danger">*</span></label>
			            <input type="text" class="form-control" name="txtLastName" value="{{ old('txtLastName') }}" placeholder="Họ" required="true" />
			        </div>
			        <div class="form-group">
			            <label>Email<span class="text-danger">*</span>: <i>Khôi phục mật khẩu</i></label>
			            <input type="email" class="form-control" name="txtEmail" value="{{ old('txtEmail') }}" placeholder="Email" required="true" />
			        </div>
			        <div class="form-group div-captcha">
						<div><label>Mã Bảo Vệ<span class="text-danger">*</span></label></div>
						<div class="row">
		                <div class="col-xs-5">
		                    <input class="form-control" type="text" name="txtCaptchaRegister" value="" placeholder="Mã bảo vệ" required="true" autocomplete="off" >
		                </div>
		                <div class="col-xs-4">
		                     <img src="{!! route('captcha.getCaptchaRegisterUser', 'captcha') !!}" class="captcha-register" alt="Image captcha error">
		                </div>
		                <div class="col-xs-2">
		                    <span class="glyphicon glyphicon-repeat icon-reload-captcha icon-reload-register-captcha" title="Mã bảo vệ khác"></span>
		                </div>
		                </div>
		            </div>
		            <div class="clearfix form-group"></div>
		            <div class="form-group text-center">
		            	<button type="submit" class="btn btn-primary align-center">Đăng Ký</button>
			        	<button type="reset" class="btn btn-default">Reset</button>
		            </div>
			    <form>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function(){
        //onlick reload capcha
        $('.icon-reload-register-captcha').click(function(){
            //change address cua captcha-login
            $('.captcha-register').attr('src', '{!! route('captcha.getCaptchaRegisterUser','')!!}'+'/'+Math.random());
        });
    });
</script>
@stop