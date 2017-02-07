<html>
<head></head>
<body>
<h1>Kích hoạt đăng ký tài khoản phimhay</h1>
<p>Xin Chào <b>{{$fullname}}!</b></p>
<p>Bạn đã đăng ký thành công tài khoản <b>{{$username}}</b> tại phimhay.</p>
<p>Bạn vui lòng nhấn vào link dưới đây để kích hoạt tài khoản</p>
<a href="{!!route('auth.getActive', $code)!!}" target="_blank">Kích hoạt tài khoản</a>
<address>
	PhimHay Administrator
</address>
</body>
</html>