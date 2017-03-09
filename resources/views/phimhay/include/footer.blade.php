<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<div class="footer-logo text-center">
				<img src="{!! url('resources/images/bg_icon_phimhay.png') !!}" alt="">
				<a href="{!! env('WEBSITE_NAME') !!}" title="{!! env('WEBSITE_NAME') !!}">{!! env('WEBSITE_NAME') !!}</a>
			</div>
		</div>
		<div class="col-sm-3">
		<h4>Thể loại</h4>
			<ul>
				<li><a href="{!! route('film.getSearch') !!}?category=le" title="Phim lẻ">Phim lẻ</a></li>
				<li><a href="{!! route('film.getSearch') !!}?category=bo" title="Phim bộ">Phim bộ</a></li>
				<li><a href="{!! route('film.getSearch') !!}?kind=truyen" title="Phim truyện">Phim truyện</a></li>
				<li><a href="{!! route('film.getSearch') !!}?kind=hoat-hinh" title="Phim hoạt hình">Phim hoạt hình</a></li>
			</ul>
		</div>
		<div class="col-sm-3">
		<h4>User</h4>
			<ul>
				<li><a href="{!! route('auth.getLogin') !!}" title="Đăng nhập">Đăng nhập</a></li>
				<li><a href="{!! route('auth.getLogout') !!}" title="Đăng ký">Đăng ký</a></li>
				<li><a href="{!! route('auth.getRecover') !!}" title="Khôi phục mật khẩu">Khôi phục mật khẩu</a></li>
			</ul>
		</div>
		<div class="col-sm-3">
			<h4>Liên hệ quảng cáo:</h4>
			<a href="mailto:{!! env('MAIL_USERNAME') !!}">{!! env('MAIL_USERNAME') !!}</a>
		</div>
	</div>
</div>