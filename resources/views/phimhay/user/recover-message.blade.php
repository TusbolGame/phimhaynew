@extends('phimhay.master')
@section('title', 'Phục hồi tài khoản tiếp tục - PhimHay')
@section('description', 'Phục hồi tài khoản')
@section('content')
<div class="div-center">
	<div class="container-fluid">
		<div class="text-center">
			@if(Session::has('recover-result'))
				<h3>Khôi phục mật khẩu thành công</h3>
				<p>Bạn vui lòng <a href="{!! route('auth.getLogin') !!}">Đăng nhập</a> để sử dụng và thay đổi mật khẩu mới</p>
				<p>Cám ơn bạn đã dùng dịch vụ của PhimHay</p>
			@else
				<h3>Không có yêu cầu</h3>
			@endif
			
		</div>
		
	</div>
	
</div>
@stop