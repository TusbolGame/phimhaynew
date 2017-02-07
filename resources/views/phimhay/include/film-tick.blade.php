
<div class="film-tick">
	@if($ticked == 0)
	<span class="icon-tick icon-no-tick glyphicon glyphicon-plus"></span>
	<span class="tick-content">Đánh dấu</span>
	@elseif($ticked == 1)
	<span class="icon-tick icon-is-tick glyphicon glyphicon-minus"></span>
	<span class="tick-content">Bỏ đánh dấu</span>
	@endif
</div>
<div class="modal fade modal-alert-success-add-tick" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Đánh Dấu Phim Thành Công</h4>
      </div>
      <div class="modal-body">
        <h5>Bạn có thể truy cập vào <span class="bg-danger">Profile</span> để xem danh sách đã đánh dấu!!!</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade modal-alert-not-success-tick" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Đánh Dấu Phim Thất Bại</h4>
      </div>
      <div class="modal-body">
        <h5>Hết thời gian timeout, phim đánh dấu không đúng</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" charset="utf-8" async defer>
$(document).ready(function(){
//click tick
	$('.film-tick').click(function() {
		$tick = $(this).children('.icon-tick');
		$tick_content = $(this).children('.tick-content');
		//is tick
		if($tick.hasClass('icon-is-tick')){
			//ajax trc		
			var data = {
				_token : $('.token-data').val(),
				film_id : $('.film-id-data').val(),
	            film_tick_content : 'remove_tick'
	        };

			$.ajax({
	            type : 'POST',
	            dataType : 'json',
	            url : '{!! route('filmAjax.getFilmTick') !!}',
	            data : data,
	            success : function (result){
	            	console.log(result);
	            	if(result['login'] == 0){
	            		//chua login
	            		//show modal
	            		$('.modal-alert-not-login').modal('show');
	            	}else if(result['status'] == 1 && result['timeout'] == 1){
	            		//
	            		$tick.removeClass('icon-is-tick');
						$tick.removeClass('glyphicon-minus');
						$tick.addClass('icon-no-tick');
						$tick.addClass('glyphicon-plus');
						//change Bỏ đánh dấu to Đánh dấu
						$tick_content.text('Đánh dấu');
	            	} else if(result['timeout'] == 0){
	            		//het timeout, ko dc evaluate
	            		//show modal

	            	}
	            },
	            error : function (){
	               	console.log('Lỗi xử lý đường truyền');
	            }
	        });
			

			
			

		}
		//chua tick
		else if($tick.hasClass('icon-no-tick')){
			//ajax trc
			var data = {
				_token : $('.token-data').val(),
				film_id : $('.film-id-data').val(),
	            film_tick_content : 'add_tick'
	        };

			$.ajax({
	            type : 'POST',
	            dataType : 'json',
	            url : '{!! route('filmAjax.getFilmTick') !!}',
	            data : data,
	            success : function (result){
	            	console.log(result);
	            	if(result['login'] == 0){
	            		//chua login
	            		//show modal
	            		$('.modal-alert-not-login').modal('show');
	            	}else if(result['status'] == 1 && result['timeout'] == 1){
	            		//
	            		$tick.removeClass('icon-no-tick');
						$tick.removeClass('glyphicon-plus');
						$tick.addClass('icon-is-tick');
						$tick.addClass('glyphicon-minus');
						//change Đánh dấu to Bỏ đánh dấu
						$tick_content.text('Bỏ đánh dấu');
						$('.modal-alert-success-add-tick').modal('show');
	            	} else if(result['timeout'] == 0){
	            		//het timeout, ko dc evaluate
	            		//show modal

	            	}
	            },
	            error : function (){
	               	console.log('Lỗi xử lý đường truyền');
	            }
	        });
			
		}

	});
});
</script>