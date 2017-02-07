@extends('phimhay.master')
@if($film_list->film_status != 'Trailer') 
	@section('title', $film_process->getTitleWatch($film_list->film_name_vn, $film_list->film_name_en, $film_list->film_years, $film_list->film_quality, $film_detail->film_category, 'Trailer'))
@else
	@section('title', $film_process->getTitleWatch($film_list->film_name_vn, $film_list->film_name_en, $film_list->film_years, $film_list->film_quality, $film_detail->film_category, 'Trailer'))
@endif
@section('description', $film_process->getFilmDescriptionInfo($film_detail->film_info))
@section('css')
	<!-- slick -->
	<link rel="stylesheet" type="text/css" href="{!! asset('public/slick-1.6.0/slick.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('public/slick-1.6.0/slick-theme.css') !!}">

@stop
@section('js')
	
@stop
@section('film-dir')
	<div class="film-dir">
		<ol class="breadcrumb">
		  	<li><a href="{!! route('home') !!}">Phim Hay</a></li>
		  	<li><a href="{!! url('film') !!}">Phim</a></li>
		  	<li class="active"><a href="{!! route('film.getFilm', [$film_list->film_dir_name, $film_list->id]) !!}" title="">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}</a></li>
		</ol>
	</div>
@stop
@section('content')
	@include('phimhay.include.input-film-id', ['film_id' => $film_list->id])
	@include('phimhay.include.modal-alert-not-login')
	<div class="film-watch film-background-border">
		@if($film_list->film_status != 'Trailer')
		<div class="film-watch-title">
			<h3><a href="{!! route('film.getFilm', [$film_list->film_dir_name, $film_list->id]) !!}" title="">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}
			@if ($film_detail->film_category == 'bo' || $film_detail->film_category == 'hhbo') 
				Tập {!! $film_episode_watch->film_episode !!} 
			@endif
			</a></h3>
		</div>
		<div class="film-watch-video background-video">
			{!! $film_process->getFilmVideojs($film_episode_watch, $film_detail->film_poster_video) !!}
		</div>
		<div class="film-watch-option">
			<ul>
				<li>
					@if ($film_detail->film_category == 'bo' || $film_detail->film_category == 'hhbo')
						<a href="" title=""><span class="glyphicon glyphicon-forward"></span>Tập kế tiếp</a>
					@else
						<a href="javascript:void(0);" title="Không có tập kế tiếp"><span class="glyphicon glyphicon-forward"></span>Không có tập kế tiếp</a></a>
					@endif
				</li>
				<li><a href="" title=""><span class="glyphicon glyphicon-refresh"></span>Tải lại</a></li>
				<!-- <li><a href="" title=""><span class="glyphicon glyphicon-plus"></span>Đánh dấu phim</a></li> -->
				<li><a href="javascript:void(0);">
					<!-- film tick -->
					<!-- 1 - is tick, 0 - no tick -->
					@include('phimhay.include.film-tick', ['ticked' => $ticked])
					<!-- end film tick -->
				</a></li>
				<li><a href="" title=""><span class="glyphicon glyphicon-save"></span>Tải phim</a></li>
				<li><a href="" title=""><span class="glyphicon glyphicon-wrench"></span>Báo lỗi phim</a></li>
			</ul>
		</div>
		@else
			<div>
				<h4 class="bg-danger" style="padding: 5px;">Trailer, phim chưa được chiếu, vui lòng quay lại sau</h4>
				<img src="{!! $film_detail->film_poster_video !!}" class="img-responsive" alt="">
			</div>
		@endif
		<!-- film evaluate -->
		@include('phimhay.include.film-evaluate', ['film_id' => $film_list->id, 'film_vote' => $film_list->film_vote, 'film_vote_count' => $film_list->film_vote_count])
		<!-- end film evaluate -->
		<div class="film-watch-source">
			<div class="film-watch-source-list">
				<!-- <h5 class="film-watch-source-list-title">Server 1</h5>
				<ul>
					<li><a href="" title="">234</a></li>
					<li><a href="" title="">234</a></li>
					<li><a href="" title="">234</a></li>
				</ul> -->
				<h5 class="film-watch-source-list-title">Server</h5>
				<ul>
				@if (count($film_episode_list) > 0)
					@if ($film_detail->film_category == 'le' || $film_detail->film_category == 'hhle')
						@foreach ($film_episode_list as $film_episode)
								
								<li><a href="{!! route('film.getFilmWatch', [$film_list->film_dir_name, $film_list->id, $film_episode->id]) !!}" @if ($film_episode_watch->id == $film_episode->id) class="film-watch-source-selected" @endif>{!! $film_process->xulyGetFilmLanguage($film_episode->film_episode_language) !!}</a></li>
						@endforeach
					@else
						@foreach ($film_episode_list as $film_episode)

								<li><a href="{!! route('film.getFilmWatch', [$film_list->film_dir_name, $film_list->id, $film_episode->id]) !!}"
								 @if ($film_episode_watch->id == $film_episode->id) class="film-watch-source-selected" @endif
								>{!! $film_episode->film_episode !!}</a></li>
							
						@endforeach
					@endif
				@endif
				</ul>
				<!-- <h5 class="film-watch-source-list-title">Server 1</h5>
				<ul>
					<li><a href="" title="">234</a></li>
					<li><a href="" title="">234</a></li>
					<li><a href="" title="">234</a></li>
				</ul> -->
			</div>
		</div>
		<div class="film-key-word">
			<h5 class="film-title-box"><span class="glyphicon glyphicon-flag"></span> TỪ KHÓA</h5>
			<div class="list-key-words">
				<ul>
					{!! $film_process->xulyGetFilmKeyWords($film_detail->film_key_words) !!}
				</ul>
			</div>
		</div>
	</div>
	<!-- film comment -->
	<div class="film-comment film-background-border">
		<div class="film-comment-content film-detail-border">
			<h5 class="film-title-box"><span class="glyphicon glyphicon-comment"></span> BÌNH LUẬN</h5>
			<ul class="nav nav-tabs">
		  		<li role="presentation" class="active select-comment-facebook"><a href="javascript:void(0);">Bình luận Facebook</a></li>
		  		<li role="presentation" class="select-comment-local"><a href="javascript:void(0);">Bình luận PhimHay</a></li>
			</ul>
			<div class="film-comment-div">
				<!-- comment fb -->
				<div class="film-comment-facebook">
					@include('phimhay.include.film-comment-fb', ['film_comment_fb_url' => route('film.getFilm', [$film_list->film_dir_name, $film_list->id])])
				</div>
				<!-- comment local -->
				<div class="film-comment-local">
					<div class="comment-local-total">
						<span>1</span>
						<span>Bình luận</span>
					</div>
					<div class="comment-form">
						<div class="comment-avata col-sm-1">
							<img src="https://www.localhost/phimhay/photos/icon-user-default.jpg" alt="">
						</div>
						<div class="comment-form-content col-sm-11">
							<form action="" method="POST" accept-charset="utf-8">
								<input type="hidden" name="_token" value="{!! csrf_token() !!}">
								<input type="hidden" name="" value="">
								<div class="form-group">
									<textarea name="" class="form-control" placeholder="Bình luận"></textarea>
								</div>
								<div class="form-group">
									<input type="button" name="" class="btn btn-primary" value="Bình luận">
								</div>
								<p class="comment-check">AAA</p>
							</form>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="comment-list">
						<ul>
							<li>
								<div class="comment-avata col-sm-1">
									<img src="https://www.localhost/phimhay/photos/icon-user-default.jpg" alt="">
								</div>
								<div class="comment-user-info col-sm-11">
									<input type="hidden" name="comment_parent" value="1">
									<span class="comment-username">Admin</span>
									<span class="comment-content">Comm</span>
									<span class="comment-time">12h</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<!-- end film commnet -->
	<script>
		$(document).ready(function () {
			//fix active onclick
			$('.select-comment-local').click(function() {
				//neu exist active of fb, remove
				$fb = $('.select-comment-facebook');
				if($fb.hasClass('active')){
					$fb.removeClass('active');
				}
				//local
				$local =$(this);
				//add active local
				if(!$local.hasClass('active')){
					$local.addClass('active');
				}
				//hide comment fb
				$('.film-comment-facebook').slideUp(300).hide();
				//view comment local
				$('.film-comment-local').slideDown(300).show();
			});
			$('.select-comment-facebook').click(function() {
				$fb = $(this);
				if(!$fb.hasClass('active')){
					$fb.addClass('active');
				}
				//local
				$local =$('.select-comment-local');
				//add active local
				if($local.hasClass('active')){
					$local.removeClass('active');
				}
				//hide comment local
				$('.film-comment-local').slideUp(300).hide();
				//view comment facebook
				$('.film-comment-facebook').slideDown(300).show();
			});
		});
	</script>
	@include('phimhay.include.film-relate', [$film_relates, $film_relate_adds, $film_process])
@stop