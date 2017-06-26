@extends('phimhay.master')
@section('title', 'Phimhay | PhimHay Website Xem Phim Trực Tuyến')
@section('description', 'PhimHay xem phim online')
@section('slider')
	<div class="home-slider">
		<div id="carousel-home-slider" class="carousel slide" data-ride="carousel">
		  	<!-- Indicators -->
		  	<ol class="carousel-indicators">
		  		<?php $i=0; ?>
		  		@while($i < count($film_sliders))		  		
			    	<li data-target="#carousel-home-slider" data-slide-to="{!! $i !!}" class="@if($i == 0) active @endif"></li>
			    	<?php $i++;  ?>
			   	@endwhile
		  	</ol>

		  	<!-- Wrapper for slides -->
		  	<div class="carousel-inner" role="listbox">
		  		<?php 
		  			$the_active = true;
		  		?>
		  		@foreach($film_sliders as $slider)
				    <div class="item @if($the_active) active @endif">
				    	<?php $the_active = false;  ?>
				    	<a href="{!! route('film.getFilm', [$slider['slider_dir'], $slider['film_id']]) !!}" title="">
				      		<img src="{!! $slider['slider_image'] !!}" class="home-slider-item-img" alt="Error image slider">
				      		<div class="carousel-caption">
				      			<h3 class="home-slider-item-name">{!! $slider['slider_name'] !!}</h3>
				      		</div>
				      	</a>
				    </div>
			    @endforeach
		  	</div>

		  	<!-- Controls -->
		  	<a class="left carousel-control" href="#carousel-home-slider" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
		  	</a>
		  	<a class="right carousel-control" href="#carousel-home-slider" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
		  	</a>
		</div>
	</div>
	<script>
		$('#carousel-home-slider').carousel({
  			interval: 4000
		})
	</script>
@stop
@section('content')
	<!-- film new -->
	@include('phimhay.include.film-new', [$film_news])
	<!-- end film new -->
@stop