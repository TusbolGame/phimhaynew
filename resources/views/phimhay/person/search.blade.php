@extends('phimhay.master')
@section('title', 'Tìm Kiếm Nhân Vật | PhimHay')
@section('description', 'Tìm Kiếm Nhân Vật | PhimHay')
@section('css')

@stop
@section('js')
	
@stop
@section('content')
	<div class="film-filter">
		<form class="form-inline" action="{!! route('person.getList') !!}" method="GET" accept-charset="utf-8">
			{{-- <input type="hidden" name="_token" value="{!! csrf_token() !!}"> --}}
			<div class="form-group">
				<label>Sắp xếp</label>
				<input type="text" class="form-control" name="person_name" value="{!! $person_name !!}" placeholder="Tên nhân vật">
			</div>
			<div class="form-group">
				<select name="person_job" class="form-control select-option-capitalize">
					<option value="">Nghề nghiệp</option>
					@foreach ($film_job as $job)
					<option value="{!! $job->id !!}" @if ($person_job == $job->id) selected @endif>{!! $job->job_name !!}</option>
					@endforeach
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Tìm Kiếm</button>
		</form>
	</div>
	<div class="film-new">
		<div class="list-film-new">
			<div class="film-new-title">
				<p><span class="glyphicon glyphicon-user"></span> DANH SÁCH DIỄN VIÊN - ĐẠO DIỄN ({!! $film_person->total() !!})</p>
			</div>
			<div class="film-actor-list person-list">
				<ol>
					@foreach($film_person as $person)
					<li>
						<a href="{!! route('person.getProfile', [$person->person_dir_name, $person->id]) !!}" title="{!! $person->person_name !!}">
							<div class="film-actor-img">
								<img src="{!! $person->getPersonImage() !!}" alt="Error">
							</div>
							<div class="film-actor-name">
								<span class="film-actor-name-1">{!! $person->person_name !!}</span>
							</div>
						</a>
					</li>
					@endforeach
				</ol>
				{!! $film_person->appends(['person_name' => $person_name, 'person_job' => $person_job])->render() !!}
			</div>

		</div>
		
	</div>
@stop