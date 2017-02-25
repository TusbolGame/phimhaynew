@extends('phimhay.master')
@section('title', 'Download Phim | PhimHay')
@section('description', 'Download Phim | PhimHay xem phim online')
@section('css')

@stop
@section('js')
	
@stop
@section('content')
	<div class="film-background-border">
		<h3 class="film-new-title">Download</h3>
		<h4 class="bg-success" style="padding: 7px;">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}</h4>
		<div>
			<table class="table bg-info">
				@if($film_list->film_category == 'le' || $film_list->film_category == 'hhle')
					<thead>
						<tr>
							<th>Source</th>
						</tr>
					</thead>
					<tbody>
						@foreach($film_episode as $episode)
						<tr>
							@if($episode->film_src_name != 'youtube')
							<td>
								<div class="dropdown">
	  								<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{!! $film_process->xulyGetFilmLanguage($episode->film_episode_language) !!}<span class="caret"></span>
	  								</button>
							  		<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							  			@if(!empty($episode->film_src_360p))
									    <li><a href="{!! $episode->film_src_360p !!}" download="true" target="_blank">360p</a></li>
									    @endif
									    @if(!empty($episode->film_src_480p))
									    <li><a href="{!! $episode->film_src_480p !!}" download="true" target="_blank">480p</a></li>
									    @endif
									    @if(!empty($episode->film_src_720p))
									    <li><a href="{!! $episode->film_src_720p !!}" download="true" target="_blank">720p</a></li>
									    @endif
									    @if(!empty($episode->film_src_1080p))
									    <li><a href="{!! $episode->film_src_1080p !!}" download="true" target="_blank">1080p</a></li>
									    @endif
									    @if(!empty($episode->film_src_2160p))
									    <li><a href="{!! $episode->film_src_2160p !!}" download="true" target="_blank">2160p</a></li>
									    @endif
							  		</ul>
								</div>
							</td>
							@endif
						</tr>
						@endforeach
					</tbody>
				@else
					<thead>
					<tr>
						<th>Tập</th>
						<th>Loại</th>
					</tr>
				</thead>
				<tbody>
					@foreach($film_episode as $episode)
					<tr>
						@if($episode->film_src_name != 'youtube')
						<td>{!! $episode->film_episode !!}</td>
						<td>
							<div class="dropdown">
  								<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{!! $episode->film_episode_language !!}<span class="caret"></span>
  								</button>
						  		<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						  			@if(!empty($episode->film_src_360p))
								    <li><a href="{!! $episode->film_src_360p !!}" download="true" target="_blank">360p</a></li>
								    @endif
								    @if(!empty($episode->film_src_480p))
								    <li><a href="{!! $episode->film_src_480p !!}" download="true" target="_blank">480p</a></li>
								    @endif
								    @if(!empty($episode->film_src_720p))
								    <li><a href="{!! $episode->film_src_720p !!}" download="true" target="_blank">720p</a></li>
								    @endif
								    @if(!empty($episode->film_src_1080p))
								    <li><a href="{!! $episode->film_src_1080p !!}" download="true" target="_blank">1080p</a></li>
								    @endif
								    @if(!empty($episode->film_src_2160p))
								    <li><a href="{!! $episode->film_src_2160p !!}" download="true" target="_blank">2160p</a></li>
								    @endif
						  		</ul>
							</div>
						</td>
						@endif	
					</tr>
					@endforeach
				</tbody>
				@endif
			</table>
			{!! $film_episode->render() !!}
		</div>
	</div>
@stop