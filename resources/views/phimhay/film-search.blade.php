@extends('phimhay.master')
@section('title', 'Tìm Kiếm Phim | PhimHay')
@section('description', 'Tìm Kiếm Phim | PhimHay xem phim online')
@section('css')

@stop
@section('js')
	
@stop
@section('content')
	<div class="film-filter">
		<form class="form-inline" action="" method="get" accept-charset="utf-8">
			<!-- <input type="hidden" name="_token" value="{!! csrf_token() !!}"> -->
			<!-- <label>Sắp xếp</label> -->
			<div class="form-group">
				<select name="kind" class="form-control">
					<option value="">Phim</option>
					<option value="truyen" @if ($kind == 'truyen') selected @endif>Phim Truyện</option>
					<option value="hoat-hinh" @if ($kind == 'hoat-hinh') selected @endif>Hoạt Hình</option>
				</select>
			</div>
			<div class="form-group">
				<select name="category" class="form-control">
					<option value="">Loại</option>
					<option value="le" @if ($category == 'le') selected @endif>Phim Lẻ</option>
					<option value="bo" @if ($category == 'bo') selected @endif>Phim Bộ</option>
				</select>
			</div>
			<div class="form-group">
				<select name="type" class="form-control select-option-capitalize">
					<option value="">Thể Loại</option>
					@foreach($film_type as $data)
						<option value="{!! $data->type_alias !!}" @if ($type == $data->type_alias) selected @endif>{!! $data->type_name !!}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<select name="country" class="form-control select-option-capitalize">
					<option value="">Quốc Gia</option>
					@foreach($film_country as $data)
					<option value="{!! $data->country_alias !!}" @if ($country == $data->country_alias) selected @endif>{!! $data->country_name !!}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<select name="year" class="form-control">
					<option value="">Năm</option>
					<option value="2017" @if ($year == '2017') selected @endif>2017</option>
					<option value="2016" @if ($year == '2016') selected @endif>2016</option>
					<option value="2015" @if ($year == '2015') selected @endif>2015</option>
					<option value="2014" @if ($year == '2014') selected @endif>2014</option>
					<option value="2013" @if ($year == '2013') selected @endif>2013</option>
					<option value="2012" @if ($year == '2012') selected @endif>2012</option>
					<option value="2011" @if ($year == '2011') selected @endif>2011</option>
					<option value="2010" @if ($year == '2010') selected @endif>2010</option>
					<option value="truoc2010" @if ($year == 'truoc2010') selected @endif>Trước 2010</option>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Tìm Kiếm</button>
		</form>
	</div>
	<div class="film-new">
		<div class="list-film-new">
			<div class="film-new-title">
				<p><span class="glyphicon glyphicon-th-large"></span> DANH SÁCH PHIM</p>
			</div>
			<ul class="list-film-new-ul">
			@if (count($films) > 0)
				@foreach ($films as $film)
				<li>
					<a href="{!! route('film.getFilm', [$film->film_dir_name, $film->id]) !!}" title="{!! $film_process->getFilmNameVnEn($film->film_name_vn, $film->film_name_en) !!}">
						<div class="film-new-thumbnail">
							<img src="{!! $film->getFilmThumbnailSmall() !!}" alt="Error Thumbnail small">
							<div class="film-ribbon-status"><span>{!! $film->film_status !!}</span></div>
							<div class="film-ribbon-language"><span>{!! $film_process->xulyGetFilmLanguage($film->film_language) !!}</span></div>
						</div>
						<div class="film-new-detail">
							<span class="film-title-vn" title="{!! $film_process->getFilmNameVn($film->film_name_vn, $film->film_name_en) !!}">{!! $film_process->getFilmNameVn($film->film_name_vn, $film->film_name_en) !!}</span>
							<span class="film-title-en" title="{!! $film_process->getFilmNameEn($film->film_name_vn, $film->film_name_en) !!}">{!! $film_process->getFilmNameEn($film->film_name_vn, $film->film_name_en) !!}</span>
							{{-- <span class="film-title-time">{!! $film_process->xulyGetFilmTime($film->film_time, $film->film_category) !!}</span> --}}
							<span class="film-title-year">{!! $film->film_years !!}</span>
						</div>
					</a>
				</li>
				@endforeach
			@endif
			</ul>
			{!! $films->appends(['category' => $category, 'type' => $type, 'country' => $country, 'year' => $year])->render() !!}
		</div>
		
	</div>
@stop