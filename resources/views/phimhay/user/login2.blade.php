<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="Vu Quoc Tuan">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ url('public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ url('public/admin/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('public/admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('public/admin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- style chung -->
    <link href="{{ url('public/phimhay/css/style-chung.css') }}" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Đăng Nhập</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form-horizontal" action="{!! route('auth.getLogin') !!}" method="POST">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            @include('admin.messages.messages')
                            @if(Session::has('errors_login'))
                                <p style="color:red">{{ Session::get('errors_login') }}</p>
                            @endif
                            @if(Session::has('errors_captcha_login'))
                                <p style="color:red">{{ Session::get('errors_captcha_login') }}</p>
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

                                    <div class="input-group col-xs-5 fix-left-col">
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
                </div>
            </div>
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="{{ url('public/admin/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script>
            $(document).ready(function(){
                //onlick reload capcha
                $('.icon-reload-login-captcha').click(function(){
                    //change address cua captcha-login
                    $('.captcha-login').attr('src', '{!! route('captcha.getCaptchaLoginUser','')!!}'+'/'+Math.random());
                });
            });
        </script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ url('public/admin/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ url('public/admin/dist/js/sb-admin-2.js') }}"></script>

</body>

</html>
