@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}
        <small class="text-danger">Add Episode - Source</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12 admin-detail">
  <div>
    <a href="{!! route('admin.film.episode.getList', $film_id) !!}" class="btn btn-info">Quay lại Film Episode List</a>
  </div>
    <div class="col-lg-6">
      <h2>Thêm Episode - Source</h2>
        <form action="{!! route('admin.film.episode.getAddWithSource', $film_id) !!}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <div class="form-group">
            <label>Ngôn Ngữ Episode:</label>
            <select name="film_episode_language" class="form-control">
              <option value="vs" @if(old('film_episode_language') == 'vs') selected @endif>VietSub</option>
              <option value="tm" @if(old('film_episode_language') == 'tm') selected @endif>Thuyết Minh</option>
              <option value="lt" @if(old('film_episode_language') == 'lt') selected @endif>Lồng Tiếng</option>
              <option value="es" @if(old('film_episode_language') == 'es') selected @endif>EnglishSub</option>
              <option value="raw" @if(old('film_episode_language') == 'raw') selected @endif>Raw</option>
            </select>
          </div>
          <div class="form-group">
            <label>Chất Lượng Episode:</label>
            <div>
                <select name="film_episode_quality" class="form-control">
                    <option value="360p" @if(old('film_episode_quality') == '360p') selected @endif>360p</option>
                    <option value="480p" @if(old('film_episode_quality') == '480p') selected @endif>480p</option>
                    <option value="720p" @if(old('film_episode_quality') == '720p') selected @endif @if(old('film_episode_quality') == '') selected @endif>720p</option>
                    <option value="1080p" @if(old('film_episode_quality') == '1080p') selected @endif>1080p</option>
                    <option value="2160p" @if(old('film_episode_quality') == '2160p') selected @endif>2160p</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <label>Nguồn Episode: </label>
            <div class="form-group">
              <select class="form-control select-film-src-name" name="film_src_name">
                <option value="youtube" @if(old('film_src_name') == 'youtube') selected @endif>Youtube</option>
                <option value="google photos" @if(old('film_src_name') == 'google photos') selected @endif>Google Photos</option>
                <option value="google drive" @if(old('film_src_name') == 'google drive') selected @endif>Google Drive</option>
                <option value="zing tv" @if(old('film_src_name') == 'zing tv') selected @endif>Zing Tv</option>
                <option value="fptplay" @if(old('film_src_name') == 'fptplay') selected @endif>Fpt Play</option>
              </select>
            </div>
          </div>
          <div class="episode-source-list">
            <div class="episode-source-item">
              <hr>
              {{-- <button type="button" class="remove-episode-source-item btn btn-danger">Xóa Epsode Item</button>   --}}
              <div class="form-group">
                <label>Film Episode: lẻ - 0, bộ - tập mấy  </label>
                <input type="number" name="film_episode[]" class="form-control" value="{!! old('film_episode_enter') !!}" placeholder="Nhập Episode" required="true">
              </div>
              <div class="form-group">
                <label>Episode Name</label>
                <textarea name="film_episode_name[]" class="form-control" placeholder="Nhập Episode Name">{!! old('film_episode_name') !!}</textarea>
              </div>
              <div class="form-group">
                <label>Source Episode</label>
                <textarea name="film_src_full[]" class="form-control" placeholder="Nhập URL episode">{!! old('film_src_full') !!}</textarea>
              </div>
            </div>
          </div>
          <div class="form-group text-right">
            <button type="button" class="btn btn-info" onclick="addInputEpisodeSource()">Thêm Input Episode-Source</button>
          </div>
          <div class="text-center">
            <button type="reset" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-primary">Thêm Episode-Source</button>
          </div> 
        </form>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
  function addInputEpisodeSource(){
    $html = '<div class="episode-source-item"><hr>'+
      '<button type="button" class="remove-episode-source-item btn btn-danger">Xóa Epsode Item</button>'+
              '<div class="form-group">'+
                '<label>Film Episode: lẻ - 0, bộ - tập mấy  </label>'+
                '<input type="number" name="film_episode[]" class="form-control" value="" placeholder="Nhập Episode" required="true">'+
              '</div>'+
              '<div class="form-group">'+
                '<label>Episode Name</label>'+
                '<textarea name="film_episode_name[]" class="form-control" placeholder="Nhập Episode Name"></textarea>'+
              '</div>'+
              '<div class="form-group">'+
                '<label>Source Episode</label>'+
                '<textarea name="film_src_full[]" class="form-control" placeholder="Nhập URL episode"></textarea>'+
              '</div>'+
            '</div>';
      $('.episode-source-list').append($html);
  }
  function removeInputEpisodeSource($this){
    $this.parent().remove();
  }
  $('body').on('click', '.remove-episode-source-item', function() {
    removeInputEpisodeSource($(this));
  });

</script>
@endsection
