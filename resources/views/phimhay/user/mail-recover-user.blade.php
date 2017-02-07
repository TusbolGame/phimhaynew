<html>
<head></head>
<body>
<h1>Kích hoạt đăng ký tài khoản phimhay</h1>
<p>Xin Chào <b>{{$fullname}}!</b></p>
<p>Bạn đã khôi phục mật khẩu tài khoản <b>{{$username}}</b> thành công tại phimhay.</p>
<p>Mật khẩu của tài khoản {{$username}} là: <strong>{{$pass_new}}</strong></p>
<p>Bạn vui lòng <a href="{!!route('auth.getLogin')!!}" target="_blank">Đăng nhập vào tài khoản</a> để thay đổi mật khẩu mới</p>

<address>
	PhimHay Administrator
</address>
</body>
</html>