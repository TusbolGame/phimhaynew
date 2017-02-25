<div class="modal fade modal-add-film-episode" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Thêm Source Phim Episode</h4>
      </div>
      <div class="modal-body">
        <form action="{!! route('admin.film.postAddFilmEpisode', $film_id) !!}" method="post" accept-charset="utf-8">
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
            <label>Nguồn Episode: </label>
            <div class="form-group">
                <select class="form-control" name="film_src_name">
                    <option value="youtube" @if(old('film_src_name') == 'youtube') selected @endif>Youtube</option>
                    <option value="google photos" @if(old('film_src_name') == 'google photos') selected @endif @if(old('film_src_name') == '') selected @endif>Google Photos</option>
                    <option value="google drive" @if(old('film_src_name') == 'google drive') selected @endif>Google Drive</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <label>Source Episode</label>
            <textarea name="film_src_full" class="form-control" placeholder="Nhập URL trailer">{!! old('film_src_full') !!}</textarea>
          </div>
          <div class="form-group">
            <label>Source phim remote (không bắt buộc)</label>
            <textarea name="film_src_remote" class="form-control" placeholder="Nhập URL Remote">{!! old('film_src_remote') !!}</textarea>
          </div>
          <div class="text-right">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            <button type="submit" class="btn btn-primary">Thêm Episode</button>
          </div> 
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->