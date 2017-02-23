@extends('phimhay.master')
@section('title', $person->person_name.' | Phim Đã Diễn Viên | PhimHay')
@section('description', 'Phim tham gia diễn  viên của '.$person->person_name)
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
		  	<li><a href="{!! route('person.getList') !!}">Nhân vật</a></li>
		  	<li><a href="{!! route('person.getProfile', [$person->person_dir_name, $person->id]) !!}" title="{!! $person->person_name !!}<">{!! $person->person_name !!}</a></li>
		  	<li class="active"><a href="{!! route('person.getPersonDirector', $person->id) !!}" title="Phim diễn viên">Phim Diễn Viên</a></li>
		</ol>
	</div>
@stop
@section('content')
	<div class="film-new">
		<div class="list-film-new">
			<div class="film-new-title">
				<p><span class="glyphicon glyphicon-pencil"></span> PHIM DIỄN VIÊN -  {!! $person->person_name !!} ({!! $film_actor->total() !!})</p>
			</div>
			<ul class="list-film-new-ul list-film-person">
				@foreach ($film_actor as $film)
				<li>
					<a href="{!! route('film.getFilm', [$film->filmList->film_dir_name, $film->filmList->id]) !!}" title="">
						<div class="film-new-thumbnail">
							<img src="{!! $film->filmList->film_thumbnail_small !!}" alt="Error Thumbnail small">
							<div class="film-ribbon-status"><span>{!! $film->filmList->film_status !!}</span></div>
							<div class="film-ribbon-language"><span>{!! $film_process->xulyGetFilmLanguage($film->filmList->film_language) !!}</span></div>
						</div>
						<div class="film-new-detail">
							<span class="film-title-vn">{!! $film_process->getFilmNameVn($film->filmList->film_name_vn, $film->filmList->film_name_en) !!}</span>
							<span class="film-title-en">{!! $film_process->getFilmNameEn($film->filmList->film_name_vn, $film->filmList->film_name_en) !!}</span>
							<span class="film-title-time">{!! $film_process->xulyGetFilmTime($film->filmList->film_time, $film->filmList->film_category) !!}</span>
							<span class="film-title-year">{!! $film->filmList->film_years !!}</span>
						</div>
					</a>
				</li>
				@endforeach
			</ul>
			{!! $film_actor->render() !!}
		</div>
	</div>
@stop