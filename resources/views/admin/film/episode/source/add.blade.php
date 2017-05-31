@extends('admin.master')
@section('header')
<div class="col-lg-12">
    <h1 class="page-header bg-primary">{!! $film_process->getFilmNameVnEn($film_list->film_name_vn, $film_list->film_name_en) !!}
        <small class="text-danger">Add Source</small>
    </h1>
</div>
@endsection
@section('content')
<div class="col-lg-12 admin-detail">
  <div>
    <a href="{!! route('admin.film.episode.getList', $film_id) !!}" class="btn btn-info">Quay lại Danh sách Episode</a>
  </div>
    <div class="col-lg-6">
        <form action="{!! route('admin.film.episode.source.getAdd', $film_id) !!}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <label>Source</label><br>
          <div class="form-group">
            <label>Film Episode ID (Tập phim)</label>
            <div class="form-group">
            <select name="film_episode_id" class="form-control">
              @foreach($film_episodes as $data)
                <option value="{!! $data->id !!}">{!! $data->film_episode !!}</option>
              @endforeach
              </select>
            </div>
          </div>
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
            <label>Track (File Sub): </label>
            <div class="form-group">
              <label>Track Type: </label>
              <select class="form-control" name="film_track_type">
                <option value="">Chọn track type</option>
                <option value="vtt" @if(old('film_track_type') == 'vtt') selected @endif>.VTT</option>
                <option value="ass" @if(old('film_track_type') == 'ass') selected @endif>.ASS</option>
              </select>
            </div>
            <div class="form-group">
              <label>Track Source: </label>
              <input type="file" name="film_track_src">
            </div>
          </div>
          <div class="form-group">
            <label>Nguồn Episode: </label>
            <div class="form-group">
              <select class="form-control select-film-src-name" name="film_src_name">
                <option value="youtube" @if(old('film_src_name') == 'youtube') selected @endif>Youtube</option>
                <option value="google photos" @if(old('film_src_name') == 'google photos') selected @endif @if(old('film_src_name') == '') selected @endif>Google Photos</option>
                <option value="google drive" @if(old('film_src_name') == 'google drive') selected @endif>Google Drive</option>
                <option value="local" @if(old('film_src_name') == 'local') selected @endif>Local</option>
                <option value="zing tv" @if(old('film_src_name') == 'zing tv') selected @endif>Zing Tv</option>
              </select>
            </div>
          </div>
          <div class="select-source-local @if(old('film_src_name') == 'local') show @else hidden @endif">
            <div class="form-group">
              <label>Source 360p (.mp4)</label>
              <input type="file" class="file-select-video-upload" accept="video/mp4">
              <input type="hidden"  class="file_src_upload" name="film_src_360p" value="">
              <div class="file-upload-info">
                <p>Tên file: <span class="file-upload-name"></span></p>
                <p>Dung lượng: <span class="file-upload-size"></span></p>
                <div class="file-upload-progress">
                  <div class="col-sm-7">
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
                    </div>
                  </div>
                  <div class="file-upload-option col-sm-5">
                    <button type="button" class="btn btn-success btn-upload-file-cancel">Cancel</button>
                    <button type="button" class="btn btn-danger btn-upload-file-delete">Delete</button>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="file-upload-result bg-success">
                  <p class="file-upload-result-error text-danger"></p>
                  <p class="file-upload-result-success text-success"></p>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Source 480p</label>
              <input type="file" class="file-select-video-upload" accept="video/mp4">
              <input type="hidden"  class="file_src_upload" name="film_src_480p" value="">
              <div class="file-upload-info">
                <p>Tên file: <span class="file-upload-name"></span></p>
                <p>Dung lượng: <span class="file-upload-size"></span></p>
                <div class="file-upload-progress">
                  <div class="col-sm-7">
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
                    </div>
                  </div>
                  <div class="file-upload-option col-sm-5">
                    <button type="button" class="btn btn-success btn-upload-file-cancel">Cancel</button>
                    <button type="button" class="btn btn-danger btn-upload-file-delete">Delete</button>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="file-upload-result bg-success">
                  <p class="file-upload-result-error text-danger"></p>
                  <p class="file-upload-result-success text-success"></p>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Source 720p</label>
              <input type="file" class="file-select-video-upload" accept="video/mp4">
              <input type="hidden" class="file_src_upload" name="film_src_720p" value=""><br>
              <div class="file-upload-info">
                <p>Tên file: <span class="file-upload-name"></span></p>
                <p>Dung lượng: <span class="file-upload-size"></span></p>
                <div class="file-upload-progress">
                  <div class="col-sm-7">
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
                    </div>
                  </div>
                  <div class="file-upload-option col-sm-5">
                    <button type="button" class="btn btn-success btn-upload-file-cancel">Cancel</button>
                    <button type="button" class="btn btn-danger btn-upload-file-delete">Delete</button>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="file-upload-result bg-success">
                  <p class="file-upload-result-error text-danger"></p>
                  <p class="file-upload-result-success text-success"></p>
                </div>
              </div>
              
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
              <label>Source 1080p</label>
              <input type="file" class="file-select-video-upload" accept="video/mp4">
              <input type="hidden"  class="file_src_upload" name="film_src_1080p" value="">
              <div class="file-upload-info">
                <p>Tên file: <span class="file-upload-name"></span></p>
                <p>Dung lượng: <span class="file-upload-size"></span></p>
                <div class="file-upload-progress">
                  <div class="col-sm-7">
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
                    </div>
                  </div>
                  <div class="file-upload-option col-sm-5">
                    <button type="button" class="btn btn-success btn-upload-file-cancel">Cancel</button>
                    <button type="button" class="btn btn-danger btn-upload-file-delete">Delete</button>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="file-upload-result bg-success">
                  <p class="file-upload-result-error text-danger"></p>
                  <p class="file-upload-result-success text-success"></p>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Source 2160p</label>
              <input type="file" class="file-select-video-upload" accept="video/mp4">
              <input type="hidden"  class="file_src_upload" name="film_src_2160p" value="">
              <div class="file-upload-info">
                <p>Tên file: <span class="file-upload-name"></span></p>
                <p>Dung lượng: <span class="file-upload-size"></span></p>
                <div class="file-upload-progress">
                  <div class="col-sm-7">
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">0%</div>
                    </div>
                  </div>
                  <div class="file-upload-option col-sm-5">
                    <button type="button" class="btn btn-success btn-upload-file-cancel">Cancel</button>
                    <button type="button" class="btn btn-danger btn-upload-file-delete">Delete</button>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="file-upload-result bg-success">
                  <p class="file-upload-result-error text-danger"></p>
                  <p class="file-upload-result-success text-success"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Source Episode</label>
            <textarea name="film_src_full" class="form-control" placeholder="Nhập URL episode">{!! old('film_src_full') !!}</textarea>
          </div>
          <div class="text-right">
            <button type="reset" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-primary">Thêm Source</button>
          </div> 
        </form>
    </div>
</div>
@include('admin.film.episode.js-episode')
@endsection
