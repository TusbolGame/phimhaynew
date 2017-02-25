<div class="modal fade modal-edit-film-trailer" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Sửa Source Phim Trailer</h4>
      </div>
      <div class="modal-body">
        <form action="{!! route('admin.film.postEditFilmTrailer', $film_id) !!}" method="post" accept-charset="utf-8">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <div class="form-group">           
            <label>Trailer</label><br>
            <label>Nguồn Trailer: </label>
            <select class="form-control" name="film_src_name">
                <option value="youtube" @if($film_trailer->film_src_name == 'youtube') selected @endif>Youtube</option>
                <option value="google photos" @if($film_trailer->film_src_name == 'google photos') selected @endif>Google Photos</option>
                <option value="google drive" @if($film_trailer->film_src_name == 'google drive') selected @endif>Google Drive</option>
            </select>
          </div>
          <div class="form-group">
            <label>Source Trailer</label>
            <textarea name="film_src_full" class="form-control" placeholder="Nhập URL trailer">{!! $film_trailer->film_src_full !!}</textarea>
          </div>
          <div class="form-group">
            <label>Ngôn Ngữ Trailer:</label>
            <select name="film_episode_language" class="form-control">
              <option value="vs" @if($film_trailer->film_episode_language == 'vs') selected @endif>VietSub</option>
              <option value="tm" @if($film_trailer->film_episode_language == 'tm') selected @endif>Thuyết Minh</option>
              <option value="lt" @if($film_trailer->film_episode_language == 'lt') selected @endif>Lồng Tiếng</option>
              <option value="es" @if($film_trailer->film_episode_language == 'es') selected @endif>EnlishSub</option>
              <option value="raw" @if($film_trailer->film_episode_language == 'raw') selected @endif>Raw</option>
            </select>
          </div>
          <div class="text-right">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            <button type="submit" class="btn btn-primary">Sửa Trailer</button>
          </div> 
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->