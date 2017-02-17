@extends('phimhay.master')
@section('title', $person->person_name.' Profile | PhimHay')
@section('description', '')
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
		  	<li class="active"><a href="{!! route('person.getProfile', [$person->person_dir_name, $person->id]) !!}" title="!! $person->person_name !!}<">{!! $person->person_name !!}</a></li>
		</ol>
	</div>
@stop
@section('content')
	<!-- film introduce -->
	<div class="film-introduce film-background-border">
		<div class="film-info film-person-info">
			<div class="col-sm-1"></div>
			<div class="col-sm-4">
				<div class="film-thumbnail film-person-image">
					<img src="{!! $person->person_image !!}" alt="Error Image Thumnail Small">
				</div>
			</div>
			<div class="col-sm-1"></div>
			<div class="col-sm-6">
				<div class="film-detail">
					<div class="film-title">
						<span class="film-title-vn film-new-title">{!! $person->person_name !!}</span>
						<span class="film-title-en">{!! $person->person_full_name !!}</span>
					</div>
					<div class="clearfix"></div>
					<div class="film-meta-info film-detail-border">
						<dl>
							<dt>Tên khai sinh:</dt>
							<dd>{!! $person->person_birth_name !!}</dd>
							<br>
							<dt>Biệt hiệu:</dt>
							<dd>{!! $person->person_nick_name !!}</dd>
							<br>
							<dt>Phái:</dt>
							<dd>{!! $person->person_sex !!}</dd>
							<br>
							<dt>Ngày sinh:</dt>
							<dd>{!! $person->person_birth_date !!}</dd>
							<br>
							<dt>Nghề nghiệp:</dt>
							<dd>
								<ul>
									@foreach ($film_person_job as $key)
									<li>{!! $key->filmJob->job_name !!}</li>
									@endforeach
								</ul>
							</dd>
							<dt>Chiều cao:</dt>
							<dd >{!! $person->person_height !!}</dd>
							<br>
							<dt>Lượt xem:</dt>
							<dd>{!! $person->person_viewed !!}</dd>
						</dl>

					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="film-content film-detail-border">
			<h4 class="film-title-box"><span class="glyphicon glyphicon-heart"></span> Thông Tin</h4>
			<div class="film-content-info">
				{!! $person->person_info !!}
			</div>
		</div>	
	</div>
	<!-- film introduce -->
	<div class="film-new">
		@if (count($film_director) > 0)
		<div class="list-film-new">
			<div class="film-new-title">
				<p><span class="glyphicon glyphicon-pencil"></span> PHIM ĐÃ ĐẠO DIỄN</p>
			</div>
			<ul class="list-film-new-ul list-film-person">
				@foreach ($film_director as $film)
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
							<span class="film-title-time">{!! $film_process->xulyGetFilmTime($film->filmList->film_time, $film->filmList->filmDetailfilm_category) !!}</span>
						</div>
					</a>
				</li>
				@endforeach
			</ul>
			{!! $film_director->render() !!}
		</div>
		@endif
		@if (count($film_actor) > 0)
		<div class="list-film-new">
			<div class="film-new-title">
				<p><span class="glyphicon glyphicon-film"></span> PHIM THAM GIA</p>
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
							<span class="film-title-time">{!! $film_process->xulyGetFilmTime($film->filmList->film_time, $film->filmList->filmDetailfilm_category) !!}</span>
						</div>
					</a>
				</li>
				@endforeach
			</ul>
			{!! $film_actor->render() !!}
		</div>
		@endif
	</div>
<script type="text/javascript">
//http://laraget.com/blog/how-to-create-an-ajax-pagination-using-laravel
$(function() {
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        $('#load a').css('color', '#dfecf6');
        $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

        var url = $(this).attr('href');  
        getArticles(url);
        window.history.pushState("", "", url);
    });

    function getArticles(url) {
        $.ajax({
            url : url  
        }).done(function (data) {
            $('.articles').html(data);  
        }).fail(function () {
            alert('Articles could not be loaded.');
        });
    }
});

</script>
@stop