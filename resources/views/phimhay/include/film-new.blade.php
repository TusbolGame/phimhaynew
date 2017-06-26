<div class="film-new">
	<div class="list-film-new">
		<div class="film-new-title">
			<p><span class="glyphicon glyphicon-star-empty"></span> Phim Hoạt Hình Mới</p>
		</div>
		<ul class="list-film-new-ul">	
		@foreach ($film_news['hh'] as $phim_moi)
			<li>
				<a href="{!! route('film.getFilm', [$phim_moi->filmList->film_dir_name, $phim_moi->filmList->id]) !!}" title="{!! $film_process->getFilmNameVnEn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}">
					<div class="film-new-thumbnail">
						<img src="{!! $phim_moi->filmList->getFilmThumbnailSmall() !!}" alt="Error Thumbnail small">
						<!-- <div class="film-ribbon-status"><span>Tap 2/22</span></div> -->
						<div class="film-ribbon-status"><span>{!! $phim_moi->filmList->film_status !!}</span></div>
						<div class="film-ribbon-language"><span>{!! $film_process->xulyGetFilmLanguage($phim_moi->filmList->film_language) !!}</span></div>
					</div>
					<div class="film-new-detail">
						<span class="film-title-vn" title="{!! $film_process->getFilmNameVn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}">{!! $film_process->getFilmNameVn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}</span>
						<span class="film-title-en" title="{!! $film_process->getFilmNameEn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}">{!! $film_process->getFilmNameEn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}</span>
						{{-- <span class="film-title-time">{!! $film_process->xulyGetFilmTime($phim_moi->filmList->film_time, $phim_moi->filmList->film_category) !!}</span> --}}
						<span class="film-title-year">{!! $phim_moi->filmList->film_years !!}</span>
					</div>
				</a>
			</li>
		@endforeach
		</ul>
	</div>
	<div class="list-film-new">
		<div class="film-new-title">
			<p><span class="glyphicon glyphicon-star-empty"></span> Phim Lẻ Mới</p>
		</div>
		<ul class="list-film-new-ul">
		@foreach ($film_news['le'] as $phim_moi)
			<li>
				<a href="{!! route('film.getFilm', [$phim_moi->filmList->film_dir_name, $phim_moi->filmList->id]) !!}" title="{!! $film_process->getFilmNameVnEn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}">
					<div class="film-new-thumbnail">
						<img src="{!! $phim_moi->filmList->getFilmThumbnailSmall() !!}" alt="Error Thumbnail small">
						<!-- <div class="film-ribbon-status"><span>Tap 2/22</span></div> -->
						<div class="film-ribbon-status"><span>{!! $phim_moi->filmList->film_status !!}</span></div>
						<div class="film-ribbon-language"><span>{!! $film_process->xulyGetFilmLanguage($phim_moi->filmList->film_language) !!}</span></div>
					</div>
					<div class="film-new-detail">
						<span class="film-title-vn" title="{!! $film_process->getFilmNameVn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}">{!! $film_process->getFilmNameVn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}</span>
						<span class="film-title-en" title="{!! $film_process->getFilmNameEn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}">{!! $film_process->getFilmNameEn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}</span>
						{{-- <span class="film-title-time">{!! $film_process->xulyGetFilmTime($phim_moi->filmList->film_time, $phim_moi->filmList->film_category) !!}</span> --}}
						<span class="film-title-year">{!! $phim_moi->filmList->film_years !!}</span>
					</div>
				</a>
			</li>
		@endforeach
		</ul>
	</div>
	<div class="list-film-new">
		<div class="film-new-title">
			<p><span class="glyphicon glyphicon-star-empty"></span> Phim Bộ Mới</p>
		</div>
		<ul class="list-film-new-ul">
		@foreach ($film_news['bo'] as $phim_moi)
			<li>
				<a href="{!! route('film.getFilm', [$phim_moi->filmList->film_dir_name, $phim_moi->filmList->id]) !!}" title="{!! $film_process->getFilmNameVnEn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}">
					<div class="film-new-thumbnail">
						<img src="{!! $phim_moi->filmList->getFilmThumbnailSmall() !!}" alt="Error Thumbnail small">
						<!-- <div class="film-ribbon-status"><span>Tap 2/22</span></div> -->
						<div class="film-ribbon-status"><span>{!! $phim_moi->filmList->film_status !!}</span></div>
						<div class="film-ribbon-language"><span>{!! $film_process->xulyGetFilmLanguage($phim_moi->filmList->film_language) !!}</span></div>
					</div>
					<div class="film-new-detail">
						<span class="film-title-vn" title="{!! $film_process->getFilmNameVn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}">{!! $film_process->getFilmNameVn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}</span>
						<span class="film-title-en" title="{!! $film_process->getFilmNameEn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}">{!! $film_process->getFilmNameEn($phim_moi->filmList->film_name_vn, $phim_moi->filmList->film_name_en) !!}</span>
						{{-- <span class="film-title-time">{!! $film_process->xulyGetFilmTime($phim_moi->filmList->film_time, $phim_moi->filmList->film_category) !!}</span> --}}
						<span class="film-title-year">{!! $phim_moi->filmList->film_years !!}</span>
					</div>
				</a>
			</li>
		@endforeach
		</ul>
	</div>
</div>