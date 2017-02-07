<div class="film-new">
	<div class="list-film-new">
		<div class="film-new-title">
			<p><span class="glyphicon glyphicon-star-empty"></span> Phim Hoạt Hình Mới</p>
		</div>
		<ul class="list-film-new-ul">
		@foreach ($film_news['hh'] as $phim_moi)
			<li>
				<a href="{!! route('film.getFilm', [$phim_moi->film_dir_name, $phim_moi->id]) !!}" title="">
					<div class="film-new-thumbnail">
						<img src="{!! $phim_moi->film_thumbnail_small !!}" alt="Error Thumbnail small">
						<!-- <div class="film-ribbon-status"><span>Tap 2/22</span></div> -->
						<div class="film-ribbon-status"><span>{!! $phim_moi->film_status !!}</span></div>
						<div class="film-ribbon-language"><span>{!! $film_process->xulyGetFilmLanguage($phim_moi->film_language) !!}</span></div>
					</div>
					<div class="film-new-detail">
						<span class="film-title-vn">{!! $film_process->getFilmNameVn($phim_moi->film_name_vn, $phim_moi->film_name_en) !!}</span>
						<span class="film-title-en">{!! $film_process->getFilmNameEn($phim_moi->film_name_vn, $phim_moi->film_name_en) !!}</span>
						<span class="film-title-time">{!! $film_process->xulyGetFilmTime($phim_moi->film_time, $phim_moi->filmDetail->film_category) !!}</span>
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
				<a href="{!! route('film.getFilm', [$phim_moi->film_dir_name, $phim_moi->id]) !!}" title="">
					<div class="film-new-thumbnail">
						<img src="{!! $phim_moi->film_thumbnail_small !!}" alt="Error Thumbnail small">
						<!-- <div class="film-ribbon-status"><span>Tap 2/22</span></div> -->
						<div class="film-ribbon-status"><span>{!! $phim_moi->film_status !!}</span></div>
						<div class="film-ribbon-language"><span>{!! $film_process->xulyGetFilmLanguage($phim_moi->film_language) !!}</span></div>
					</div>
					<div class="film-new-detail">
						<span class="film-title-vn">{!! $film_process->getFilmNameVn($phim_moi->film_name_vn, $phim_moi->film_name_en) !!}</span>
						<span class="film-title-en">{!! $film_process->getFilmNameEn($phim_moi->film_name_vn, $phim_moi->film_name_en) !!}</span>
						<span class="film-title-time">{!! $film_process->xulyGetFilmTime($phim_moi->film_time, 'le') !!}</span>
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
				<a href="{!! route('film.getFilm', [$phim_moi->film_dir_name, $phim_moi->id]) !!}" title="">
					<div class="film-new-thumbnail">
						<img src="{!! $phim_moi->film_thumbnail_small !!}" alt="Error Thumbnail small">
						<!-- <div class="film-ribbon-status"><span>Tap 2/22</span></div> -->
						<div class="film-ribbon-status"><span>{!! $phim_moi->film_status !!}</span></div>
						<div class="film-ribbon-language"><span>{!! $film_process->xulyGetFilmLanguage($phim_moi->film_language) !!}</span></div>
					</div>
					<div class="film-new-detail">
						<span class="film-title-vn">{!! $film_process->getFilmNameVn($phim_moi->film_name_vn, $phim_moi->film_name_en) !!}</span>
						<span class="film-title-en">{!! $film_process->getFilmNameEn($phim_moi->film_name_vn, $phim_moi->film_name_en) !!}</span>
						<span class="film-title-time">{!! $film_process->xulyGetFilmTime($phim_moi->film_time, 'bo') !!}</span>
					</div>
				</a>
			</li>
		@endforeach
		</ul>
	</div>
</div>