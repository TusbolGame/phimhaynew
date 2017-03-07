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
        <form action="{!! route('admin.film.episode.postAdd', $film_id) !!}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <div class="form-group">           
            <label>Episode</label><br>
            <label>Link Number: </label>
            <input type="number" name="film_link_number" class="form-control" value="1" placeholder="Nhập link number">
          </div>
          <div class="form-group">
            <label>Ngôn Ngữ Episode:</label>
            <select name="film_episode_language" class="form-control">
              <option value="vs" @if(old('film_episode_language') == 'vs') selected @endif>VietSub</option>
              <option value="tm" @if(old('film_episode_language') == 'tm') selected @endif>Thuyết Minh</option>
              <option value="lt" @if(old('film_episode_language') == 'lt') selected @endif>Lồng Tiếng</option>
              <option value="es" @if(old('film_episode_language') == 'es') selected @endif>EnlishSub</option>
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
            <label>Film Episode: lẻ - 0, bộ - tập mấy  </label>
            <div class="form-group">
              <input type="number" name="film_episode" class="form-control" value="0" placeholder="Nhập: bộ là tập mấy, lẻ là 0">
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
              </select>
            </div>
          </div>
          <div class="select-source-local show">
            <div class="form-group">
              <label>Source 360p</label>
              <input type="file" class="file-select-video-upload">
              <input type="hidden"  class="file_src_upload" name="film_src_360p">
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
              <input type="file" class="file-select-video-upload">
              <input type="hidden"  class="file_src_upload" name="film_src_480p">
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
              <input type="file" class="file-select-video-upload">
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
              <input type="file" class="file-select-video-upload">
              <input type="hidden"  class="file_src_upload" name="film_src_1080p">
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
              <input type="file" class="file-select-video-upload">
              <input type="hidden"  class="file_src_upload" name="film_src_2160p">
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
          
          <div class="form-group">
            <label>Source phim remote (không bắt buộc)</label>
            <textarea name="film_src_remote" class="form-control" placeholder="Nhập URL Remote">{!! old('film_src_remote') !!}</textarea>
          </div>
          <div class="text-right">
            <button type="reset" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-primary">Thêm Episode</button>
          </div> 
        </form>
    </div>
</div>
<script>
  $('.select-film-src-name').click(function(){
    //
    $local = $('.select-source-local');
      if($(this).val() == 'local'){
        $local.removeClass('hidden');
      }else{
        $local.addClass('hidden');
      }
      
  })
  $('.file-upload-info').hide();
  //load
  //
  var token = $('form').find('input[name="_token"]').val();
  //
  $('.file-select-video-upload').change(function() {
    if($(this)[0].files[0]){
      //show
      showFileUploadProgress($(this));
      $file_name = $(this).val().split('\\').pop();
      console.log($(this).val().split('\\').pop());
      $(this).parent().find('.file-upload-name').html($file_name);
      showFileUploadProgress($(this));
      $(this).parent().find('.file-upload-size').html(parseInt(parseInt($(this)[0].files[0].size)/(1024*1024))+'MB');
      $upload_result = $(this).parent().find('.file-upload-result');
      if(!checkExistsFileUpload($file_name)){
        uploadFile($(this)[0].files[0], $(this));
      }else{
        $upload_result.children('.file-upload-result-error').html('Lỗi File đã tồn tại.');
      }
    }
  });
  //click
  function uploadFile($file_upload, $this){
    var xhr = new window.XMLHttpRequest();
      var file = $file_upload;
      var form_data = new FormData();
      form_data.append('_token', token);
      form_data.append('file', file);
      var progress = $this.parent().find('.progress-bar');
      // 
      $upload_result.children('.file-upload-result-success').html('Loading..........');
      // console.log(progress.html());
      // return false;
      $.ajax({
        xhr: function() {
          xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
              var percentComplete = evt.loaded / evt.total;
              percentComplete = parseInt(percentComplete * 100);
              // console.log(percentComplete);
              progress.attr({
                'aria-valuenow': percentComplete
              });
              progress.width(percentComplete+'%');
              progress.html(percentComplete+'%');
              if (percentComplete === 100) {
                console.log('success');
              }

            }
          }, false);

          return xhr;
        },
        type: 'POST',
        url: '{!! route('admin.film.episodeAjax.postUpload') !!}',
        data: form_data,
        async: true, //show console
        processData: false,
        contentType: false,
        success: function(result) {
          if(result['status'] == 1){
            $upload_result.children('.file-upload-result-success').html('Hoàn thành');
            //add even delete
            //set add src
            setFileSourceUpload($this, $file_name)
            deleleUpload($this);
          }else{
            $upload_result.children('.file-upload-result-success').html('');
            $upload_result.children('.file-upload-result-error').html(result['content']);
          }
        }
      });
      //cancel
      $this.parent().find('.btn-upload-file-cancel').on('click', function(e){ 
        // console.log('aa')     ;
        xhr.abort();
      });
  }
  function showFileUploadProgress($this){
    //
    $this.parent().children('.file-upload-info').show();
  }
  function hideFileUploadProgress($this){
    $this.parent().children('.file-upload-info').hide();
  }
  function checkExistsFileUpload($file_name){
    var data = {
      _token: token,
      file_name: $file_name
    }
    $.ajax({
      type: 'POST',
      dataType : 'json',
      url: '{!! route('admin.film.episodeAjax.postCheckExists') !!}',
      data: data,
      async: true, //show console
      success: function(result) {
        if(result['status'] == 1){
          return true;
        }else{
          return false;
        }
      }
    });
    return false;
  }
  function deleleUpload($this){
    $this.parent().find('.btn-upload-file-delete').on('click', function(e){
      var data = {
        _token: token,
        file_name: $file_name
      }
      $.ajax({
        type: 'POST',
        dataType : 'json',
        url: '{!! route('admin.film.episodeAjax.postDelete') !!}',
        data: data,
        async: true, //show console
        success: function(result) {
          if(result['status'] == 1){
            reserFileUpload($this);
            setFileSourceUpload($this)
          }
        }
      });
    });
  }
  function reserFileUpload($this){
    $parent = $this.parent();
    //hide
    hideFileUploadProgress($this);
    //
    $this.val('');
    $parent.find('.file-upload-name').html('');
    $parent.find('.file-upload-size').html('');
    $parent.find('.progress-bar').html('0%');
    $parent.find('.progress-bar').attr('aria-valuenow', 0);
    $parent.find('.progress-bar').width('0%');
    $parent.find('.file-upload-result').children('.file-upload-result-success').html('');
    $parent.find('.file-upload-result').children('.file-upload-result-error').html('');
  }
  function setFileSourceUpload($this, $name = ''){
    $this.parent().find('.file_src_upload').val($name);
  }
  
</script>
@endsection
