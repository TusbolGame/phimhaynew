@extends('phimhay.master')
@section('title', Auth::user()->first_name.' '.Auth::user()->last_name.' | Phim Đã Xem | PhimHay')
@section('description', Auth::user()->username.' - Phim Đã Xem')
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
		  	<li><a href="{!! route('user.getProfile', Auth::user()->id) !!}" title="{!! Auth::user()->username !!}">{!! Auth::user()->first_name.' '.Auth::user()->last_name !!}</a></li>
		  	<li class="active"><a href="{!! route('user.getFilmUserWatch', Auth::user()->id) !!}" title="Phim đã xem">Phim Đã Xem</a></li>
		</ol>
	</div>
@stop
@section('content')
	<div class="film-new">
	    <div class="list-film-new">
	        <div class="film-new-title">
	            <span><span class="glyphicon glyphicon-pencil"></span> PHIM ĐÃ XEM ({!! $film_user_watch->total() !!})</span>
	        </div>
	        <ul class="list-film-new-ul list-film-person">
	            @foreach ($film_user_watch as $film)
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
	        {!! $film_user_watch->render() !!}
	    </div>
	</div>
@stop