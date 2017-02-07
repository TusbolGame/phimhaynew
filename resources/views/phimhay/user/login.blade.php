@extends('phimhay.master')
@section('title', 'Đăng nhập thành viên - PhimHay')
@section('description', 'Đăng nhập thành viên')
@section('content')
<div class="div-center div-login">
    <div class="container-fluid">
        <div class="user-login">
            <h3 class="text-center">Đăng Nhập</h3>
            <hr>


            <div class="form-register">
                <form role="form-horizontal" action="{!! route('auth.getLogin') !!}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    @include('admin.messages.messages')
                    @if(Session::has('errors_login'))
                        <div class="alert alert-danger">
                            <p style="color:red">{{ Session::get('errors_login') }}</p>
                        </div>
                    @endif
                    @if(Session::has('errors_captcha_login'))
                        <div class="alert alert-danger">
                            <p style="color:red">{{ Session::get('errors_captcha_login') }}</p>
                        </div>
                    @endif
                    <fieldset>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input class="form-control" placeholder="Tên tài khoản" name="txtUsername" type="text" autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input class="form-control" placeholder="Mật khẩu" name="txtPassword" type="password" value="">
                            </div>
                        </div>
                        <div class="form-group div-captcha">

                            <div class="input-group col-xs-5 fix-left">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                <input class="form-control" type="text" name="txtCaptchaLogin" value="" placeholder="Mã bảo vệ" autocomplete="off" >
                            </div>
                            <div class="col-xs-5">
                                 <img src="{!! route('captcha.getCaptchaLoginUser') !!}" class="captcha-login" alt="Image captcha error">
                            </div>
                            <div class="col-xs-2">
                                <span class="glyphicon glyphicon-repeat icon-reload-captcha icon-reload-login-captcha" title="Mã bảo vệ khác"></span>
                            </div>
                            
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="chkRemember" value="1" checked="true">Nhớ tài khoản</label>
                        </div>
                        <div class="col-xs-10 col-xs-push-1">
                            <button type="submit" class="btn btn-success col-xs-6">Đăng nhập</button>
                            <a href="{!! route('auth.getRegister') !!}" class="btn btn-default col-xs-4 col-xs-push-1">Đăng ký</a>
                        </div>
                        <div class="clearfix">
                            <a href="{!! route('auth.getRecover') !!}" class="btn btn-link" title="">Quên mật khẩu</a>
                        </div>
                        
                    </fieldset>
                </form>
                          
            </div>
            <div class="text-center">
                <a href="{!! route('facebook.getRedirect') !!}" class="btn btn-success">Đăng nhập bằng Facebook</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        //onlick reload capcha
        $('.icon-reload-login-captcha').click(function(){
            //change address cua captcha-login
            $('.captcha-login').attr('src', '{!! route('captcha.getCaptchaLoginUser','')!!}'+'/'+Math.random());
        });
    });
</script>
@stop