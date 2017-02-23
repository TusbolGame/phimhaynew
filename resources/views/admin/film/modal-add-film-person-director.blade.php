<div class="modal fade modal-add-film-person-director" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Thêm Diễn Viên</h4>
      </div>
      <div class="modal-body">
        <form action="" class="form-add-film-person-director" method="post" accept-charset="utf-8">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="form-group">
              <label>Tên đạo diễn</label>
              <input type="text" class="form-control director_name" name="director_name" placeholder="Nhập tên đạo diễn" value="" maxlength="100">
            </div>
            <div class="form-group">
              <label>Tên đạo diễn (đầy đủ)</label>
              <input type="text" class="form-control director_full_name" name="director_full_name" placeholder="Nhập tên đạo diễn (đầy đủ)" value="">
            </div>
            <div class="form-group">
              <label>Tên khai sinh</label>
              <input type="text" class="form-control director_birth_name" name="director_birth_name" placeholder="Nhập tên khai sinh" value="">
            </div>
            <div class="form-group">
              <label>Tên biệt hiệu</label>
              <input type="text" class="form-control director_nick_name" name="director_nick_name" placeholder="Nhập tên biệt hiệu" value="">
            </div>
            <div class="form-group">
              <label>Ngày sinh, địa điểm</label>
              <textarea class="form-control director_birth_date" name="director_birth_date" class="Nhập ngày sinh, địa điểm"></textarea>
            </div>
            <div class="form-group">
                <label>Nghề nghiệp:</label>
                @foreach ($film_job as $job)
                <div class="checkbox">
                    <label><input type="checkbox" class="director_job" name="director_job[]" value="{!! $job->id !!}">{!! $job->job_name !!}</label>
                </div>
                @endforeach
            </div>
            <div class="form-group">
              <label>Chiều cao</label>
              <input type="text" class="form-control director_height" name="director_height" placeholder="Nhập chiều cao" value="">
            </div>
            <div class="form-group">
              <label>Thông tin</label>
              <textarea class="form-control director_info" name="director_info" placeholder="Nhập thông tin"></textarea>
            </div>
            <div class="form-group">
              <label>Ảnh đại diện</label>
              <textarea class="form-control director_image" name="director_image" placeholder="Nhập đường dẫn ảnh"></textarea>
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary add-film-person-director">Thêm Đạo diễn</button>
            <p class="film-director-result bg-danger" style="margin-top: 10px;"></p>
        </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
            