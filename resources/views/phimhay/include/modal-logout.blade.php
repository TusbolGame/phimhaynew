<div class="modal fade modal-logout" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Đăng Xuất Tài Khoản</h4>
      </div>
      <div class="modal-body">
        <h5>Bạn có thực sự muốn đăng xuất tài khoản</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <!-- <button type="button" class="btn btn-primary"></button> -->
        <a href="{!! route('auth.getLogout') !!}" class="btn btn-primary" title="">Đăng Xuất</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->