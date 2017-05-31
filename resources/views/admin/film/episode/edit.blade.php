@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}
        <small class="text-danger">Edit Episode</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12 admin-detail">
    <div>
        <a href="{!! route('admin.film.episode.getList', $film_id) !!}" class="btn btn-info">Quay lại Film Episode List</a>
    </div>
    <div class="col-lg-6">
      <h2>Cập nhật Episode</h2>
        <form action="{!! route('admin.film.episode.postEdit', [$film_list->id, $film_episode->id]) !!}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <div class="form-group">
            <label>Film Episode: lẻ - 0, bộ - tập mấy  </label>
            <div class="form-group">
              <input type="number" name="film_episode" class="form-control" value="{!! old('film_episode', $film_episode->film_episode) !!}" placeholder="Nhập: bộ là tập mấy, lẻ là 0">
            </div>
          </div>
          <div class="form-group">
            <label>Episode Name</label>
            <textarea name="film_episode_name" class="form-control" placeholder="Nhập Episode Name">{!! old('film_episode_name', $film_episode->film_episode_name) !!}</textarea>
          </div>
          <div class="text-right">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
              <button type="submit" class="btn btn-primary">Sửa Episode</button>
          </div> 
        </form>

    </div>
</div>
@endsection
