@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}
        <small class="text-danger">Add Episode</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12 admin-detail">
  <div>
    <a href="{!! route('admin.film.episode.getList', $film_id) !!}" class="btn btn-info">Quay lại Film Episode List</a>
  </div>
    <div class="col-lg-6">
      <h2>Thêm Episode</h2>
        <form action="{!! route('admin.film.episode.postAdd', $film_id) !!}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <div class="form-group">
            <label>Film Episode: lẻ - 0, bộ - tập mấy  </label>
            <div class="form-group">
              <input type="number" name="film_episode" class="form-control" value="{!! old('film_episode') !!}" placeholder="Nhập: bộ là tập mấy, lẻ là 0" required="true">
            </div>
          </div>
          <div class="form-group">
            <label>Episode Name</label>
            <textarea name="film_episode_name" class="form-control" placeholder="Nhập Episode Name">{!! old('film_episode_name') !!}</textarea>
          </div>
          <div class="text-right">
            <button type="reset" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-primary">Thêm Episode</button>
          </div> 
        </form>
    </div>
</div>
@endsection
