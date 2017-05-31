@extends('phimhay.master')
@section('title', $film_process->getTitleInfo($film_list->film_name_vn, $film_list->film_name_en, $film_list->film_years, $film_list->film_quality))
@section('description', $film_process->getFilmDescriptionInfo($film_detail->film_info))
@section('css')
	<!-- slick -->
	<link rel="stylesheet" type="text/css" href="{!! asset('public/slick-1.6.0/slick.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('public/slick-1.6.0/slick-theme.css') !!}">
@stop
@section('js')
	<script src="{!! asset('public/jquery/jquery-migrate-1.2.1.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('public/slick-1.6.0/slick.min.js') !!}" type="text/javascript"></script>
@stop
@section('film-dir')
	<div class="film-dir">
		<ol class="breadcrumb">
		  	<li><a href="{!! route('home') !!} ">Phim Hay</a></li>
		  	<li><a href="{!! url('film') !!}">Phim</a></li>
		  	<li class="active"><a href="{!! route('film.getFilm', [$film_list->film_dir_name, $film_list->id]) !!}" title="">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}</a></li>
		</ol>
	</div>
@stop
@section('content')
	@include('phimhay.include.input-film-id', ['film_id' => $film_list->id])
	@include('phimhay.include.modal-alert-not-login')
	<!-- film introduce -->
	<div class="film-introduce film-background-border">
		<div class="film-info">
			<div class="col-sm-6">
				<div class="film-thumbnail">
					<img src="{!! $film_detail->film_thumbnail_big !!}" alt="Error Image Thumnail Small">
					<ul>
						<li><a class="btn btn-warning" href="{!! route('film.getFilmDownloadCaptcha', [$film_list->film_dir_name, $film_list->id]) !!}" title="Download">Dowload</a></li>
						<li><a class="btn btn-success" href="{!! route('film.getFilmWatch', [$film_list->film_dir_name, $film_list->id, $film_source_id]) !!}" title="Xem phim">Xem phim</a></li>
					</ul>
					<!-- film tick -->
					<!-- 1 - is tick, 0 - no tick -->
					@include('phimhay.include.film-tick', ['ticked' => $ticked])
					<!-- end film tick -->
				</div>
			</div>
			<div class="col-sm-6">
				<div class="film-detail">
					<div class="film-title">
						<span class="film-title-vn film-new-title">{!! $film_process->getFilmNameVn($film_list->film_name_vn, $film_list->film_name_en) !!}</span>
						<span class="film-title-en">{!! $film_process->getFilmNameEn($film_list->film_name_vn, $film_list->film_name_en) !!}</span>
						<span class="film-title-years">&nbsp;({!! $film_list->film_years !!})</span>
					</div>
					<div class="film-meta-info film-detail-border">
						<dl>
							<dt>Trạng thái:</dt>
							<dd class="film-status">{!! $film_list->film_status !!}</dd>
							<br>
							<dt>Đạo diễn:</dt>
							<dd class="film-type">
								<ul>
									@foreach ($directors as $director)
									<li><a href="{!! route('person.getProfile', [$director->filmPerson->person_dir_name, $director->filmPerson->id]) !!}" title="{!! $director->filmPerson->person_name !!}">{!! $director->filmPerson->person_name !!}</a></li>
									@endforeach
								</ul>
							</dd>
							<br>
							<dt>Quốc gia:</dt>
							<dd class="film-type">
								<ul>
									@foreach($film_detail_country as $data)
									<li>
										<a href="{!! route('film.getSearch') !!}?country={!! $data->filmCountry->country_alias !!}" title="{!! $data->filmCountry->country_name !!}">{!! $data->filmCountry->country_name !!}</a>
									</li>
									@endforeach
								</ul>
							</dd>
							<br>
							<dt>Năm:</dt>
							<dd><a href="{!! url('film?year='.$film_list->film_years) !!}" title="Phim năm 2013">{!! $film_list->film_years !!}</a></dd>
							<br>
							<dt>Thể loại:</dt>
							<dd class="film-type">
								<ul>
									<!-- kind -->
									<li>
										<a href="{!! route('film.getSearch') !!}?type={!! $film_detail->film_kind !!}" title="Phim {!! $film_process->xulyGetFilmKind($film_detail->film_kind) !!}">Phim {!! $film_process->xulyGetFilmKind($film_detail->film_kind) !!}</a>
									</li>
									<!-- category -->
									<li>
										<a href="{!! route('film.getSearch') !!}?type={!! $film_list->film_category !!}" title="Phim {!! $film_process->xulyGetFilmcategory($film_list->film_category) !!}">Phim {!! $film_process->xulyGetFilmCategory($film_list->film_category) !!}</a>
									</li>
									@foreach($film_detail_type as $type)
									<li>
										<a href="{!! route('film.getSearch') !!}?type={!! $type->filmType->type_alias !!}" title="{!! $type->filmType->type_name !!}">{!! $type->filmType->type_name !!}</a>
									</li>
									@endforeach
								</ul>
							</dd>
							<br>
							<dt>Thời lượng:</dt>
							<dd>{!! $film_process->xulyGetFilmTime($film_list->film_time, $film_list->film_category) !!}</dd>
							<br>
							<dt>Chất lượng:</dt>
							<dd class="film-quality">{!! $film_process->xulyGetFilmQuality($film_list->film_quality) !!}</dd>
							<br>
							<dt>Ngôn ngữ:</dt>
							<dd>{!! $film_process->xulyGetFilmLanguage($film_list->film_language) !!}</dd>
							<br>
							<dt>Ngày chiếu:</dt>
							<dd>{!! $film_detail->film_release_date !!}</dd>
							<br>
							<dt>Công ty sx:</dt>
							<dd>{!! $film_detail->film_production_company !!}</dd>
							<br>
							<dt>Lượt xem:</dt>
							<dd>{!! number_format($film_list->film_viewed, 0, ',', '.') !!}</dd>
						</dl>

					</div>
					<!-- film-evaludate -->
					@include('phimhay.include.film-evaluate', ['film_id' => $film_list->id, 'film_vote' => $film_list->film_vote, 'film_vote_count' => $film_list->film_vote_count])
					<!-- end film-evaludate -->
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		@if(count($actors) > 0)
		<div class="film-actor film-detail-border">
			<h4 class="film-title-box"><span class="glyphicon glyphicon-user"></span> DIỄN VIÊN</h4>
			<div class="slider filtering slick-slider filtering-film-actor">
			@if (count($actors) > 0)
				@foreach($actors as $actor)
		  		<div class="film-actor-item">
		  			<a href="{!! route('person.getProfile', [$actor->filmPerson->person_dir_name, $actor->filmPerson->id]) !!}" title="{!! $actor->filmPerson->person_name !!} ({!! $actor->actor_character !!})">
						<div class="film-actor-img">
							<img src="{!! $actor->filmPerson->person_image !!}" alt="Error">
						</div>
						<div class="film-actor-name">
							<span class="film-actor-name-1">{!! $actor->filmPerson->person_name !!}</span>
							<span class="film-actor-name-2">{!! $actor->actor_character !!}</span>
						</div>
					</a>
		  		</div>
		  		@endforeach
		  	@endif
		  	</div>
		</div>
		<script>
		$(document).ready(function(){


			$('.filtering-film-actor').slick({
		  slidesToShow: 7,
		  slidesToScroll: 7,
		  variableWidth: false
		});
		});
		</script>
		@endif
		<div class="film-trailer film-detail-border">
			<h4 class="film-title-box"><span class="glyphicon glyphicon-film"></span> TRAILER</h4>
			<div class="background-video">
				{!! $film_player->getTrailerYoutube($film_detail->src_youtube_trailer, $film_detail->film_poster_video) !!}
			</div>
		</div>
		<div class="film-content film-detail-border">
			<h4 class="film-title-box"><span class="glyphicon glyphicon-heart"></span> NỘI DUNG PHIM</h4>
			<div class="film-content-info">
				{!! $film_detail->film_info !!}
			</div>
		</div>
		<div class="film-key-word film-detail-border">
			<h4 class="film-title-box"><span class="glyphicon glyphicon-flag"></span> TỪ KHÓA</h4>
			<div class="list-key-words">
				<ul>
					{!! $film_process->xulyGetFilmKeyWords($film_detail->film_key_words) !!}
				</ul>
			</div>
		</div>
	</div>
	<!-- film introduce -->
	<!-- film comment -->
	<div class="film-comment film-background-border">
		<div class="film-comment-content film-detail-border">
			<h4 class="film-title-box"><span class="glyphicon glyphicon-comment"></span> BÌNH LUẬN</h4>
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
					@include('phimhay.include.film-comment-local', [$film_list->id, $film_comments, $film_comment_local_count, $channel_name, $film_comment_local_id_last])
				</div>
			</div>
			
		</div>
	</div>
	<!-- end film commnet -->
	@include('phimhay.include.modal-message-error')
	@include('phimhay.include.modal-message-success')
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