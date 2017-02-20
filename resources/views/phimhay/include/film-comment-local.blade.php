<div class="comment-local-total">
	<span class="comment-local-total-int">{!! $film_comment_local_count !!}</span>
	<span>Bình luận</span>
</div>
<div class="comment-form">
	<div class="comment-avata col-sm-1">
		@if(Auth::check())
			<img src="@if(substr(Auth::user()->image, 0, 4) == 'icon') {{ url('resources/photos/'.Auth::user()->image) }} @else{{ Auth::user()->image }}@endif" alt="">
		@else
			<img src="{{ url('resources/photos/icon-user-default.jpg') }}" alt="">
		@endif
	</div>
	<div class="comment-form-content col-sm-11">
		<form action="#" method="POST" class="form-comment-local-add" accept-charset="utf-8">
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<div class="form-group">
				<textarea name="" class="form-control comment-content" placeholder="Bình luận"></textarea>
			</div>
			<div class="form-group">
				@if(Auth::check())
					<button type="button" class="btn btn-primary btn-fiml-comment-local-add" data-loading-text="Loading..." autocomplete="off">Bình luận</button>
				@else
					<input type="button" class="btn btn-primary" disabled="true" value="Chưa đăng nhập">
				@endif
				<p class="comment-check"></p>
			</div>
			
		</form>
	</div>
</div>
<div class="clearfix"></div>
<div class="comment-local-list">
	<ul>
		@foreach($film_comments as $comment)
			<li>
				<div class="comment-avata col-sm-1">
					<img src="@if(substr($comment->user->image, 0, 4) == 'icon') {{ url('resources/photos/'.$comment->user->image) }} @else{{ $comment->user->image }}@endif" alt="">
				</div>
				<div class="comment-user-info col-sm-11">
					<input type="hidden" name="comment_parent" value="1">
					<span class="comment-username">{!! $comment->user->first_name.' '.$comment->user->last_name !!}</span>
					<span class="comment-content">{!! $comment->film_comment_content !!}</span>
					<span class="comment-time">{!! $comment->created_at !!}</span>
				</div>
			</li>
		@endforeach
	</ul>
	<!-- <button type="button" id="btn-load-comment-local" data-loading-text="Loading..." class="btn btn-primary form-control" autocomplete="off">Tải thêm bình luận</button> -->
</div>
<script type="text/javascript" charset="utf-8" async defer>
	$(document).ready(function () {
		function showAndGetCommentCheck($content){
			$('.comment-check').text($content).show();
		}
		function addCommentLocal($content){
			$comment_list = $('.comment-local-list ul');
			//get user image
			$image = $('.user-avata').attr('src');
			//get username
			$username = $('.user-username').text();
			//time
			$time = new Date();
			$str = '<li>'+
				'<div class="comment-avata col-sm-1">'+
				'<img src="'+$image+'" alt="error image avata">'+
				'</div>'+
				'<div class="comment-user-info col-sm-11">'+
				'<span class="comment-username">'+$username+'</span>'+
				'<span class="comment-content">'+$content+'</span>'+
				'<span class="comment-time">'+$time.toUTCString()+'</span>'+
				'</div>'+
				'</li>';
				$comment_list.prepend($str);
		}
		$('.btn-fiml-comment-local-add').click(function() {
			$(this).button('loading');
			//goi ajax
			var data = {
				_token : $('form.form-comment-local-add').children('input[name="_token"]').val(),
	            comment_content : $('textarea.comment-content').val()
	        };
	        if(data['comment_content'] == ''){
	        	showAndGetCommentCheck('Chưa nhập bình luận');
	        	return false;
	        }
			$.ajax({
	            type : 'POST',
	            dataType : 'json',
	            url : '{!! route('filmAjax.postFilmCommentAdd', $film_list->id) !!}',
	            data : data,
	            success : function (result){
	            	
	            	//console.log(result);
	            	if(result['login'] == 0){
                		//chua login
                		//show modal
                		$('.modal-alert-not-login').modal('show');
                		showAndGetCommentCheck('Chưa login!');
                	}else if(result['status'] == 1){
                		//comment success add
                		//add show comment
                		addCommentLocal(data['comment_content']);
                		//
                		showAndGetCommentCheck('Bình luận thành công!');
                		//total ++
                		$('.comment-local-total-int').text(parseInt($('.comment-local-total-int').text()) + 1);
                		//
                		$('textarea.comment-content').val('');
                	}else{
                		showAndGetCommentCheck('Lỗi xử lý!');
                	}
                	
	            },
	            error : function (){
	               	console.log('Lỗi xử lý đường truyền');
	            }
	        });
	        $(this).button('reset');
		});
		$('#btn-load-comment-local').on('click', function () {
		    var $btn = $(this).button('loading');
		    //
		    var data = {
				_token : $('form.form-comment-local-add').children('input[name="_token"]').val(),
	            comment_id : $('.comment-local-list ul li').last().val()
	        };
	        $.ajax({
	            type : 'POST',
	            dataType : 'json',
	            url : '{!! route('filmAjax.postFilmCommentAdd', $film_list->id) !!}',
	            data : data,
	            success : function (result){
	            	
	            	//console.log(result);
	            	if(result['login'] == 0){
                		//chua login
                		//show modal
                		$('.modal-alert-not-login').modal('show');
                		showAndGetCommentCheck('Chưa login!');
                	}else if(result['status'] == 1){
                		//comment success add
                		//add show comment
                		addCommentLocal(data['comment_content']);
                		//
                		showAndGetCommentCheck('Bình luận thành công!');
                		//total ++
                		$('.comment-local-total-int').text(parseInt($('.comment-local-total-int').text()) + 1);
                		//
                		$('textarea.comment-content').val('');
                	}else{
                		showAndGetCommentCheck('Lỗi xử lý!');
                	}
                	
	            },
	            error : function (){
	               	console.log('Lỗi xử lý đường truyền');
	            }
	        });
		    //
		    $btn.button('reset');
		})
	});
</script>