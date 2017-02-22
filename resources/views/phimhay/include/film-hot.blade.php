<div class="film-hot">
	<div class="list-film-hot">
		<div class="film-hot-title film-new-title">
			<p><span class="glyphicon glyphicon-star"></span>Phim Hoạt Hình Hot</p>
		</div>
		<ul class="list-film-hot-ul">
			@foreach ($film_hots['hh'] as $hot)
			<li>
				<a href="{!! route('film.getFilm', [$hot->film_dir_name, $hot->id]) !!}" title="">
					<div class="col-sm-5 col-xs-4 film-hot-thumbnail">
						<img src="{!! $hot->film_thumbnail_small !!}" class="img" alt="">
					</div>
					<div class="col-sm-7 col-xs-8 film-hot-detail">
						<span class="film-title-vn">{!! $film_process->getFilmNameVn($hot->film_name_vn, $hot->film_name_en) !!}</span>
						<span class="film-title-en">{!! $film_process->getFilmNameEn($hot->film_name_vn, $hot->film_name_en) !!}</span>
						<span class="film-title-view">Luot xem: {!! $hot->film_viewed !!}</span>
						<span class="film-title-rate-vote rate-vote rate-vote-{!! $hot->film_vote !!}"></span>
						<span class="film-title-time">{!! $film_process->xulyGetFilmTime($hot->film_time, $hot->film_category) !!}</span>
					</div>
				</a>
			</li>
			@endforeach
		</ul>
	</div>
	<div class="list-film-hot">
		<div class="film-hot-title film-new-title">
			<p><span class="glyphicon glyphicon-star"></span>Phim Lẻ Hot</p>
		</div>
		<ul class="list-film-hot-ul">
			
			@foreach ($film_hots['le'] as $hot)
			<li>
				<a href="{!! route('film.getFilm', [$hot->film_dir_name, $hot->id]) !!}" title="">
					<div class="col-sm-5 col-xs-4 film-hot-thumbnail">
						<img src="{!! $hot->film_thumbnail_small !!}" class="img" alt="">
					</div>
					<div class="col-sm-7 col-xs-8 film-hot-detail">
						<span class="film-title-vn">{!! $film_process->getFilmNameVn($hot->film_name_vn, $hot->film_name_en) !!}</span>
						<span class="film-title-en">{!! $film_process->getFilmNameEn($hot->film_name_vn, $hot->film_name_en) !!}</span>
						<span class="film-title-view">Luot xem: {!! $hot->film_viewed !!}</span>
						<span class="film-title-rate-vote rate-vote rate-vote-{!! $hot->film_vote !!}"></span>
						<span class="film-title-time">{!! $film_process->xulyGetFilmTime($hot->film_time, $hot->film_category) !!}</span>
					</div>
				</a>
			</li>
			@endforeach
		</ul>
	</div>
	<div class="list-film-hot">
		<div class="film-hot-title film-new-title">
			<p><span class="glyphicon glyphicon-star"></span>Phim Bộ Hot</p>
		</div>
		<ul class="list-film-hot-ul">
			
			@foreach ($film_hots['bo'] as $hot)
			<li>
				<a href="{!! route('film.getFilm', [$hot->film_dir_name, $hot->id]) !!}" title="">
					<div class="col-sm-5 col-xs-4 film-hot-thumbnail">
						<img src="{!! $hot->film_thumbnail_small !!}" class="img" alt="">
					</div>
					<div class="col-sm-7 col-xs-8 film-hot-detail">
						<span class="film-title-vn">{!! $film_process->getFilmNameVn($hot->film_name_vn, $hot->film_name_en) !!}</span>
						<span class="film-title-en">{!! $film_process->getFilmNameEn($hot->film_name_vn, $hot->film_name_en) !!}</span>
						<span class="film-title-view">Luot xem: {!! $hot->film_viewed !!}</span>
						<span class="film-title-rate-vote rate-vote rate-vote-{!! $hot->film_vote !!}"></span>
						<span class="film-title-time">{!! $film_process->xulyGetFilmTime($hot->film_time, $hot->film_category) !!}</span>
					</div>
				</a>
			</li>
			@endforeach
		</ul>
	</div>
</div>