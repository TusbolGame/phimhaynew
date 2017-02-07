
<div class="film-relate film-background-border">
	<h4 class="film-title-box"><span class="glyphicon glyphicon-thumbs-up"></span>PHIM LIÊN QUAN</h4>
	<div class="film-relate-list">
		<div class="slider filtering slick-slider">
		@if (count($film_relates) > 0)
			@foreach ($film_relates as $relate)
	  		<div>
	  			<div class="film-relate-item">
	  				<a href="{!! route('film.getFilm', [$relate->filmList->film_dir_name, $relate->id]) !!}" title="">
		  				<div class="film-relate-item-img">
		  					<img src="{!! $relate->filmList->film_thumbnail_small !!}" alt="">
		  				</div>
		  				<div class="film-relate-item-title">
		  					<span class="film-title-vn">{!! $film_process->getFilmNameVn($relate->filmList->film_name_vn, $relate->filmList->film_name_en) !!}</span>
		  					<span class="film-title-en">{!! $film_process->getFilmNameEn($relate->filmList->film_name_vn, $relate->filmList->film_name_en) !!}</span>
		  					<span class="film-title-year">{!! $relate->filmList->film_years !!}</span>
		  				</div>
		  			</a>
	  			</div>
	  		</div>
	  		@endforeach
	  	@endif
	  	@if (count($film_relate_adds) > 0)
			@foreach ($film_relate_adds as $relate)
	  		<div>
	  			<div class="film-relate-item">
	  				<a href="{!! route('film.getFilm', [$relate->filmList->film_dir_name, $relate->id]) !!}" title="">
		  				<div class="film-relate-item-img">
		  					<img src="{!! $relate->filmList->film_thumbnail_small !!}" alt="">
		  				</div>
		  				<div class="film-relate-item-title">
		  					<span class="film-title-vn">{!! $film_process->getFilmNameVn($relate->filmList->film_name_vn, $relate->filmList->film_name_en) !!}</span>
		  					<span class="film-title-en">{!! $film_process->getFilmNameEn($relate->filmList->film_name_vn, $relate->filmList->film_name_en) !!}</span>
		  					<span class="film-title-year">{!! $relate->filmList->film_years !!}</span>
		  				</div>
		  			</a>
	  			</div>
	  		</div>
	  		@endforeach
	  	@endif
		</div>
	</div>
	
</div>
<script src="{!! asset('public/jquery/jquery-migrate-1.2.1.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('public/slick-1.6.0/slick.min.js') !!}" type="text/javascript"></script>
<script>
$(document).ready(function(){


	$('.filtering').slick({
  slidesToShow: 4,
  slidesToScroll: 4,
  variableWidth: false
});

var filtered = false;

$('.js-filter').on('click', function(){
  if (filtered === false) {
    $('.filtering').slick('slickFilter',':even');
    //$(this).text('Unfilter Slides');
    filtered = true;
  } else {
    $('.filtering').slick('slickUnfilter');
    //$(this).text('Filter Slides');
    filtered = false;
  }
});
});
</script>