@extends('phimhay.master')
@section('title', 'Xác Nhận Download Phim | PhimHay')
@section('description', 'Xác Nhận Download Phim | PhimHay xem phim online')
@section('css')

@stop
@section('js')
	
@stop
@section('content')
	<div class="film-background-border">
		<h3 class="film-new-title">Download</h3>
		<h4 class="bg-success" style="padding: 7px;">Tên phim</h4>
		@include('phimhay.message.errors')
		<div>
			<form class="form-inline" action="{!! route('film.getFilmDownload',[$film_list->film_dir_name, $film_list->id]) !!}" method="post">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="form-group">
					<label class="text-info">Mã bảo vệ:<input type="text" name="captcha_download_film" class="form-control" value="" placeholder="Nhập mã bảo vệ" required="true" autocomplete="off"></label>
					<div class="captcha captcha-download-film">
						<img class="image-captcha-download-film" src="{!! route('captcha.getCaptchaDownloadFilm', 1) !!}" alt="">
						<span class="glyphicon glyphicon-repeat icon-reload-captcha icon-reload-download-film-captcha" title="Mã bảo vệ khác"></span>
					</div>
				</div>
				<button type="submit" class="btn btn-success">Download</button>
			</form>
		</div>
	</div>
	<script>
		$('.icon-reload-download-film-captcha').click(function() {
			 $('.image-captcha-download-film').attr('src', '{!! route('captcha.getCaptchaDownloadFilm','')!!}'+'/'+Math.random());
		});
	</script>
@stop