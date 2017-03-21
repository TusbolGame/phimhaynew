<div class="modal fade modal-add-report-error" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Báo lỗi</h4>
      </div>
      <div class="modal-body">
        <h5>Nội dung báo lỗi</h5>
        <form class="form-report-error-add" action="#" method="post" accept-charset="utf-8">
          <div class="form-group">
            <label>Chủ đề</label>
            <div class="checkbox">
              <label><input type="checkbox" class="report_error_name_1" value="lỗi ảnh (thumbnail) phim">Lỗi ảnh (thumbnail) phim</label>
              <label><input type="checkbox" class="report_error_name_1" value="Lỗi source Trailer">Lỗi source Trailer</label>
              <label><input type="checkbox" class="report_error_name_1" value="Lỗi source phim - Fail">Lỗi source phim - Fail</label>
            </div>
          </div>
          <div class="form-group">
            <label>Chủ đề khác:</label>
            <textarea class="form-control report_error_name_2" placeholder="Nhập nội dung báo lỗi khác"></textarea>
          </div>
          <div class="form-group div-captcha">
            <label class="col-xs-4">Mã bảo vệ:</label>
            <div class="col-xs-6">
                 <img src="" class="captcha-report-error-add" alt="Image captcha error">
            </div>
            <div class="col-xs-2">
                <span class="glyphicon glyphicon-repeat icon-reload-captcha icon-reload-report-error-add-captcha" title="Mã bảo vệ khác"></span>
            </div>
            <div class="clearfix"></div>
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                <input class="form-control captcha-report-error-value" type="text" name="captcha-report-error-value" value="" placeholder="Mã bảo vệ" autocomplete="off" >
            </div>
          </div>
        </form>
      </div>
      <div class="text-center">
        <p class="modal-report-error-add-result text-danger"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-report-error-add">Thêm báo lỗi</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$(document).ready(function() {
  //report error
  $('.show-modal-report-error').click(function(){
    //
    //load captcha
    loadCaptchReportErrorAdd();
    $('.modal-add-report-error').modal('show');
  })
  //onlick reload capcha
  $('.icon-reload-report-error-add-captcha').click(function(){
      //change address cua captcha-login
      $captcha = '{!! route('captcha.getCaptchaReportErrorAdd', '') !!}/'+Math.random();
      $('.captcha-report-error-add').attr('src', $captcha);
  });
  function loadCaptchReportErrorAdd(){
    $captcha = '{!! route('captcha.getCaptchaReportErrorAdd', '') !!}/'+Math.random();
    //add src image captcha
    $('.captcha-report-error-add').attr('src', $captcha);
  }

  $('.btn-report-error-add').click(function() {
    $content1 = new Array();
    $('.form-report-error-add .report_error_name_1:checked').each(function(){
      $content1.push($(this).val());
    });
    var data = {
        _token : $('.token-data').val(),
        film_id : $('.film-id-data').val(),
        captcha : $('.captcha-report-error-value').val(),
        report_error_content_1 : $content1,
        report_error_content_2 : $('.form-report-error-add .report_error_name_2').val()
          };
    //ajax
    $.ajax({
      type : 'POST',
      dataType : 'json',
      url : '{!! route('reportErrorAjax.postAdd') !!}',
      data : data,
      success : function (result){
        //load captcha
        loadCaptchReportErrorAdd();
        if(result['status'] == 1){
          //
          $('.modal-report-error-add-result').text(result['content']);
        }else if(result['status'] == 0){
          $('.modal-report-error-add-result').text(result['content']);
        }
      },
      error : function (){
          $('.modal-report-error-add-result').text('Lỗi mạng! Lỗi xử lý đường truyền!');
          //load captcha
          loadCaptchReportErrorAdd();
          console.log('Lỗi xử lý đường truyền');
      }
    });
  });
});
</script>