@extends('phimhay.master')
@section('title', 'Phục hồi tài khoản - PhimHay')
@section('description', 'Phục hồi tài khoản')
@section('content')
<div class="div-center">
	<div class="container-fluid">
		<div class="text-center">
			<h3>Phục hồi tài khoản</h3>
			@include('admin.messages.messages')
			<form class="form-horizontal" action="{!!route('auth.getRecover')!!}" method="post" accept-charset="utf-8">
				<input type="hidden" name="_token" value="{!!csrf_token()!!}">
				<div class="form-group">
					<label class="col-sm-3 control-label">Tài khoản: </label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" name="txtUsername" value="{{old('txtUsername')}}"placeholder="Tên tài khoản">
				    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Email: </label>
				    <div class="col-sm-9">
				      <input type="email" class="form-control" name="txtEmail" placeholder="Email" value="{{old('txtEmail')}}">
				    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Mã bảo vệ: </label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" name="txtCaptcha" placeholder="Mã bảo vệ" value="" autocomplete="off">
				    </div>
				    <div class="col-sm-3 fix-left-col">
				    	<img src="{!! route('captcha.getCaptchaRecoverUser', 'captcha') !!}" class="captcha-recover" alt="">
				    </div>
				    <div class="col-sm-2 fix-left-col fix-right-col">
				    	<span class="glyphicon glyphicon-repeat icon-reload-captcha icon-reload-recover-captcha" title="Mã bảo vệ khác"></span>
				    </div>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" name="recover_submit" value="Khôi Phục Tài Khoản">
				</div>
			</form>
		</div>
		
	</div>
</div>
<script>
    $(document).ready(function(){
        //onlick reload capcha
        $('.icon-reload-recover-captcha').click(function(){
            //change address cua captcha-login
            $('.captcha-recover').attr('src', '{!! route('captcha.getCaptchaRecoverUser','')!!}'+'/'+Math.random());
        });
    });
</script>
@stop