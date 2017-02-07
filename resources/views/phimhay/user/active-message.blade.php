@extends('phimhay.master')
@section('title', 'Đăng ký thành viên - PhimHay')
@section('description', 'Đăng ký thành viên')
@section('content')
<div class="div-center">
	<div class="container-fluid">
		@if(Session::has('message_active'))
			@if(Session::get('message_active') == 'send_active_success')
				<!-- send mail success -->
				<h3>Kích hoạt tài khoản:</h3>
				<p>Vui lòng truy cập vào email của bạn <b>{{Session::get('email')}}</b> để <b>kích hoạt tài khoản.</b></p>
				<i>Nếu chưa nhận được email, vui lòng nhấn ở dưới:</i>
				<hr>
				<div class="text-center">
					<form action="{!!route('auth.getActiveSend')!!}" class="form" method="post" accept-charset="utf-8">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input type="submit" name="send_active_submit" class="btn btn-primary" value="Gửi lại Email kích hoạt">
					</form>
				</div>
			@elseif(Session::get('message_active') == 'send_active_success_again')
				<!-- send mail success -->
				<h3>Kích hoạt tài khoản:</h3>
				<p>Vui lòng truy cập vào email của bạn <b>{{Session::get('email')}}</b> để <b>kích hoạt tài khoản.</b></p>
			@elseif(Session::get('message_active') == 'active_success')
				<div class="text-center">
					<h5 class="text-success">Kích hoạt tài khoản thành công!</h5>
					<p>Vui lòng <a href="{!!route('auth.getLogin')!!}" class="btn btn-link" title="Đăng nhập">đăng nhập</a> để sử dụng.</p>
					<p>Thank you!</p>
				</div>
				@elseif(Session::get('message_active') == 'is_active_success')
				<div class="text-center">
					<h5 class="text-success">Đăng ký tài khoản thành công!</h5>
					<p>Vui lòng <a href="{!!route('auth.getLogin')!!}" class="btn btn-link" title="Đăng nhập">đăng nhập</a> để sử dụng.</p>
					<p>Thank you!</p>
				</div>
			@elseif(Session::get('message_active') == 'active_not_success')
				<div>
					<h5>Kích hoạt tài khoản <span class="text-danger">không</span> thành công!</h5>
					<p>Vui lòng kiểm tra lại</p>
					<p>Thank you!</p>
				</div>
			@endif
		@elseif(!Session::has('message_active'))
			<!-- don't session active -->
			<div class="text-center">
				<h5 class="text-danger">Không có yêu cầu</h5>
			</div>
		@endif
	</div>
	
</div>
@stop