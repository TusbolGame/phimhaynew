@extends('phimhay.master')
@section('title', 'Phimhay | PhimHay Website Xem Phim Trực Tuyến')
@section('description', 'PhimHay xem phim online')
@section('css')
	<!-- nivo -->
	<link rel="stylesheet" type="text/css" href="{!! asset('public/nivo-slider-v3.2/nivo-style.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('public/nivo-slider-v3.2/themes/default/default.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('public/nivo-slider-v3.2/nivo-slider.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! asset('public/nivo-slider-v3.2/style-set-nivo-slider.css') !!}">
@stop
@section('js')
	<!-- set nivo slider jquery-->
	<script src="{!! asset('public/nivo-slider-v3.2/jquery.nivo.slider.js') !!}"></script>
	
@stop
@section('slider')
	<script src="{!! asset('public/nivo-slider-v3.2/jquery-set-nivo-slider.js') !!}"></script>
	<div class="nivo childContentCenter">
		<div id="slider" class="nivoSlider">
	        <!-- <a href=""><img src="http://4.bp.blogspot.com/-WUUhPQ2TCKM/WG8jgqr47xI/AAAAAAAAA6Y/yOfsgyy1VLkyl8_AnWDOFWo7E3JiFH19gCK4B/s1600/guilty-crown-2012-content.jpg" alt="" title="Uilty Crown 2012"/></a> -->
	       	@foreach ($film_sliders as $slider)
	       		 <a href="{!! $slider->slider_dir !!}"><img src="{!! $slider->slider_image !!}" alt="" title="{!! $slider->slider_name !!}"/></a>
	       	@endforeach
	    </div>
	    <div id="caption" class="nivo-html-caption">
	        <strong>This</strong> is madness with <a href="#">a link</a>
	    </div>
	</div>
@stop
@section('content')
	<!-- film new -->
	@include('phimhay.include.film-new', [$film_news])
	<!-- end film new -->
@stop