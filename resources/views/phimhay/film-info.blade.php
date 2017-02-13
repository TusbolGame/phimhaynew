@extends('phimhay.master')
@section('title', $film_process->getTitleInfo($film_list->film_name_vn, $film_list->film_name_en, $film_list->film_years, $film_list->film_quality))
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
						<li><a class="btn btn-warning" href="dowload.php" title="Download">Dowload</a></li>
						<li><a class="btn btn-success" href="{!! route('film.getFilmWatch', [$film_list->film_dir_name, $film_list->id, $film_episode_id]) !!}" title="Xem phim">Xem phim</a></li>
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
							<dd>
								<ul>
									@foreach ($directors as $director)
									<li><a href="{!! route('person.getProfile', [$director->filmPerson->person_dir_name, $director->filmPerson->id]) !!}" title="{!! $director->filmPerson->person_name !!}">{!! $director->filmPerson->person_name !!}</a></li>
									@endforeach
								</ul>
							</dd>
							<dt>Quốc gia:</dt>
							<dd class="film-type">{!! $film_process->xulyGetFilmCountry($film_detail->film_country) !!}</dd>
							<br>
							<dt>Năm:</dt>
							<dd><a href="{!! url('film?year='.$film_list->film_years) !!}" title="Phim năm 2013">{!! $film_list->film_years !!}</a></dd>
							<br>
							<dt>Thể loại:</dt>
							<dd class="film-type">
								{!! $film_process->xulyGetFilmType($film_detail->film_type, $film_detail->film_category) !!}
							</dd>
							<br>
							<dt>Thời lượng:</dt>
							<dd>{!! $film_process->xulyGetFilmTime($film_detail->film_time, $film_detail->film_category) !!}</dd>
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
			<div class="film-actor-list">
				<ol>
					@foreach($actors as $actor)
					<li>
						<a href="{!! route('person.getProfile', [$actor->filmPerson->person_dir_name, $actor->filmPerson->id]) !!}" title="{!! $actor->filmPerson->person_name !!} ({!! $actor->actor_character !!})">
							<div class="film-actor-img">
								<img src="{!! $actor->filmPerson->person_image !!}" alt="Error">
							</div>
							<div class="film-actor-name">
								<span class="film-actor-name-1">{!! $actor->filmPerson->person_name !!}</span>
								<span class="film-actor-name-2">{!! $actor->actor_character !!}</span>
							</div>
						</a>
					</li>
					@endforeach
				</ol>
			</div>
		</div>
		@endif
		<div class="film-trailer film-detail-border">
			<h4 class="film-title-box"><span class="glyphicon glyphicon-film"></span> TRAILER</h4>
			<div class="background-video">
				{!! $film_process->getFilmVideojs($film_trailer, $film_detail->film_poster_video) !!}
			</div>
		</div>
		<div class="film-content film-detail-border">
			<h4 class="film-title-box"><span class="glyphicon glyphicon-heart"></span> NỘI DUNG PHIM</h4>
			<div class="film-content-info">
				<!-- <p>Đại gia tộc trừ tà diệt ma Tsuchimikado đã bước vào thời kì hoàng kim bậc nhất, danh tiếng vang xa khắp bốn bể dưới triều đại của Tsuchimikado Yako. Vị pháp sư kì tài ngàn năm hiếm có này đã khiến ba cõi thần người và âm phải khiếp sợ. Thế nhưng, trong một sai lầm, khiến cho phong ấn lối vào địa ngục bị phá vỡ, hàng vạn linh hồn ma quỷ trốn thoát và gây náo động khắp Tokyo. Kể từ đó, danh tiếng của gia tộc Tsuchimikado cũng tàn theo mây khói còn Yako thì ôm hận mà chết.</p>
				<img src="https://drive.google.com/uc?export=download&id=0B18baix_ssU1UmF1cVFLQl9mWWs" alt=""> -->
				{!! $film_detail->film_info !!}
			</div>
		</div>
		<div class="film-key-word film-detail-border">
			<h4 class="film-title-box"><span class="glyphicon glyphicon-flag"></span> TỪ KHÓA</h4>
			<div class="list-key-words">
				<ul>
					<!-- <li><a href="https://www.localhost/phimhay/search/?key=tokyo+ravens" title="tokyo ravens">tokyo ravens</a></li> -->
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
					@include('phimhay.include.film-comment-local', [$film_list->id, $film_comments])
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