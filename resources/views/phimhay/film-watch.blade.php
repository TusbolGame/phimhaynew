@extends('phimhay.master')
@section('title', $film_process->getTitleWatch($film_list, $film_source_watch))
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
		  	<li><a href="{!! route('home') !!}">Phim Hay</a></li>
		  	<li><a href="{!! url('film') !!}">Phim</a></li>
		  	<li class="active"><a href="{!! route('film.getFilm', [$film_list->film_dir_name, $film_list->id]) !!}" title="">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}</a></li>
		</ol>
	</div>
@stop
@section('content')
	@include('phimhay.include.input-film-id', ['film_id' => $film_list->id])
	@include('phimhay.include.modal-alert-not-login')
	@include('phimhay.include.modal-add-report-error', ['film_id' => $film_list->id])
	<div class="film-watch film-background-border">
		@if($film_list->film_status != 'Trailer' && count($film_source_watch) > 0)
		<div class="film-watch-title">
			<h3><a href="{!! route('film.getFilm', [$film_list->film_dir_name, $film_list->id]) !!}" title="">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}
			@if ($film_list->film_category == 'bo') 
				Tập {!! $film_source_watch->filmEpisode->film_episode !!} 
			@endif
			</a></h3>
		</div>
		<div class="film-watch-video background-video">
			{{-- {!! $film_player->getFilmVideojs($film_source_watch, $film_detail->film_poster_video, $film_source_track) !!} --}}
			{!! $film_player->getFilmVideojs($data_source, $film_detail->film_poster_video, $film_source_track) !!}
		</div>
		<div class="film-watch-option">
			<ul>
				<li>
					@if ($film_list->film_category == 'bo')
						<a href="" class="film-watch-option-next" title=""><span class="glyphicon glyphicon-forward"></span>Tập kế tiếp</a>
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
				<li>
					<div class="dropdown">
					  	<a class="dropdown-toggle" id="drop4" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
					  	<span class="glyphicon glyphicon-save"></span>
					    Download
					    	<span class="caret"></span>
					  	</a>
					  	<ul class="dropdown-menu">
					  		@if($film_source_watch->film_src_name == 'local')
							    @if(!empty($film_source_watch->film_src_360p))
							    <li><a href="{!! route('videoStream.getVideoStream', $film_source_watch->film_src_360p) !!}" download="true" target="_blank">360p</a></li>
							    @endif
							    @if(!empty($film_source_watch->film_src_480p))
							    <li><a href="{!! route('videoStream.getVideoStream', $film_source_watch->film_src_480p) !!}" download="true" target="_blank">480p</a></li>
							    @endif
							    @if(!empty($film_source_watch->film_src_720p))
							    <li><a href="{!! route('videoStream.getVideoStream', $film_source_watch->film_src_720p) !!}" download="true" target="_blank">720p</a></li>
							    @endif
							    @if(!empty($film_source_watch->film_src_1080p))
							    <li><a href="{!! route('videoStream.getVideoStream', $film_source_watch->film_src_1080p) !!}" download="true" target="_blank">1080p</a></li>
							    @endif
							    @if(!empty($film_source_watch->film_src_2160p))
							    <li><a href="{!! route('videoStream.getVideoStream', $film_source_watch->film_src_2160p) !!}" download="true" target="_blank">2160p</a></li>
							    @endif
						    @elseif($film_source_watch->film_src_name == 'google photos')
							    @if(!empty($film_source_watch->film_src_360p))
							    <li><a href="{!! $film_source_watch->film_src_360p !!}" download="true" target="_blank">360p</a></li>
							    @endif
							    @if(!empty($film_source_watch->film_src_480p))
							    <li><a href="{!! $film_source_watch->film_src_480p !!}" download="true" target="_blank">480p</a></li>
							    @endif
							    @if(!empty($film_source_watch->film_src_720p))
							    <li><a href="{!! $film_source_watch->film_src_720p !!}" download="true" target="_blank">720p</a></li>
							    @endif
							    @if(!empty($film_source_watch->film_src_1080p))
							    <li><a href="{!! $film_source_watch->film_src_1080p !!}" download="true" target="_blank">1080p</a></li>
							    @endif
							    @if(!empty($film_source_watch->film_src_2160p))
							    <li><a href="{!! $film_source_watch->film_src_2160p !!}" download="true" target="_blank">2160p</a></li>
							    @endif
							@elseif($film_source_watch->film_src_name == 'google drive')
							    @if(!empty($film_source_watch->film_src_360p))
							    <li><a href="{!! route('videoStream.getProxy', [$film_source_watch->id, '360p']) !!}" download="true" target="_blank">360p</a></li>
							    @endif
							    @if(!empty($film_source_watch->film_src_480p))
							    <li><a href="{!! route('videoStream.getProxy', [$film_source_watch->id, '480p']) !!}" download="true" target="_blank">480p</a></li>
							    @endif
							    @if(!empty($film_source_watch->film_src_720p))
							    <li><a href="{!! route('videoStream.getProxy', [$film_source_watch->id, '720p']) !!}" download="true" target="_blank">720p</a></li>
							    @endif
							    @if(!empty($film_source_watch->film_src_1080p))
							    <li><a href="{!! route('videoStream.getProxy', [$film_source_watch->id, '1080p']) !!}" download="true" target="_blank">1080p</a></li>
							    @endif
							    @if(!empty($film_source_watch->film_src_2160p))
							    <li><a href="{!! route('videoStream.getProxy', [$film_source_watch->id, '2160p']) !!}" download="true" target="_blank">2160p</a></li>
							    @endif
						    @elseif($film_source_watch->film_src_name == 'youtube')
						    	<p>Không có source để download</p>
						    @endif
					  	</ul>
					</div>
				</li>
				<li><a href="javascript:void(0)" class="show-modal-report-error" title=""><span class="glyphicon glyphicon-wrench"></span>Báo lỗi phim</a></li>
			</ul>
		</div>
		@else
			<div>
				<h4 class="bg-danger" style="padding: 5px;">Trailer, phim chưa được chiếu, vui lòng quay lại sau</h4>
				<img src="{!! $film_detail->film_poster_video !!}" class="img-responsive" alt="">
			</div>
		@endif
		<div class="clearfix"></div>
		<!-- film evaluate -->
		@include('phimhay.include.film-evaluate', ['film_id' => $film_list->id, 'film_vote' => $film_list->film_vote, 'film_vote_count' => $film_list->film_vote_count])
		<!-- end film evaluate -->
		<div class="film-watch-source">
			<div class="film-watch-source-list">
				<h5 class="film-watch-source-list-title">Server</h5>
				<ul>
				@if(count($film_source_list) >= 1)
					@foreach ($film_source_list as $data)

						<li><a href="{!! route('film.getFilmWatch', [$film_list->film_dir_name, $film_list->id, $data->id]) !!}"
						 @if ($film_source_watch->id == $data->id) class="film-watch-source-selected" @endif
						>{!! $data->film_src_name.'-'.$film_process->xulyGetFilmLanguage($data->film_episode_language) !!}</a></li>
						
					@endforeach
				@endif
				</ul>
			</div>
			<div class="film-watch-source-list">
				<!-- <h5 class="film-watch-source-list-title">Server 1</h5>
				<ul>
					<li><a href="" title="">234</a></li>
					<li><a href="" title="">234</a></li>
					<li><a href="" title="">234</a></li>
				</ul> -->
				<h5 class="film-watch-source-list-title">Episode</h5>
				<ul>
				@if (count($film_episode_list) > 0)
					@if ($film_list->film_category == 'le')
						@foreach ($film_episode_list as $film_episode)

								<li><a href="{!! route('film.getFilmWatch', [$film_list->film_dir_name, $film_list->id, $film_episode->filmSource->first()]) !!}"
								 @if ($film_source_watch->film_episode_id == $film_episode->id) class="film-watch-source-selected" @endif
								>Full</a></li>
							
						@endforeach
					@else
						@foreach ($film_episode_list as $film_episode)

								<li><a href="{!! route('film.getFilmWatch', [$film_list->film_dir_name, $film_list->id, $film_episode->filmSource->first()]) !!}"
								 @if ($film_source_watch->film_episode_id == $film_episode->id) class="film-watch-source-selected" @endif
								>{!! $film_episode->film_episode !!} @if($film_episode->film_episode_name != ''){!! $film_episode->film_episode_name !!}@endif</a></li>
							
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
					<!-- comment local -->
					<div class="film-comment-local">
						@include('phimhay.include.film-comment-local', [$film_list->id, $film_comments, $film_comment_local_count, $channel_name, $film_comment_local_id_last])
					</div>
				</div>
			</div>
			
		</div>
	</div>
	@include('phimhay.include.modal-message-error')
	@include('phimhay.include.modal-message-success')
	<!-- end film commnet -->
	<script>
		$(document).ready(function () {
			//option next
			function filmWatchOptionNext($category, $episode_watch_id){
				if($category == 'bo'){
					//get episode
					$episode_selected = $('.film-watch-source-selected');
					$episode_next = $episode_selected.parent().next().children('a');
					//error
					// $episode_last = $episode_selected.parent().last().children('a'); 
					//fix
					$episode_last = $('.film-watch-source-list ul li:last').children('a');					
					//check last
					if($episode_selected.text() == $episode_last.text()){
						$tag_a = $('.film-watch-option-next');
						$tag_a.attr({
							href: 'javascript:void(0);',
							title: 'Không có tập kế tiếp'
						});
					}
					else if($episode_next){
						$tag_a = $('.film-watch-option-next');
						//get href
						$temp_href = $episode_next.attr('href');
						$temp_episode = $episode_next.text();
						$tag_a.attr({
							href: $temp_href,
							title: 'Tập '+$temp_episode
						});
					}
				}
				//
			}
			filmWatchOptionNext('{!! $film_list->film_category !!}', 37);
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