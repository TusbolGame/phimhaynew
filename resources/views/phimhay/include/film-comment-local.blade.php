<div class="comment-local-total">
	<span class="comment-local-total-int">{!! $film_comment_local_count !!}</span>
	<span>Bình luận</span>
</div>
<div class="comment-form">
	<div class="comment-avata col-sm-1 col-xs-2">
		@if(Auth::check())
			<img src="@if(substr(Auth::user()->image, 0, 4) == 'icon') {{ url('resources/photos/'.Auth::user()->image) }} @else{{ Auth::user()->image }}@endif" alt="">
		@else
			<img src="{{ url('resources/photos/icon-user-default.jpg') }}" alt="">
		@endif
	</div>
	<div class="comment-form-content col-sm-11 col-xs-10">		
		<form action="{!! route('commentAjax.postAdd', $film_list->id) !!}" method="POST" class="form-comment-local-add" accept-charset="utf-8">
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
				<div class="comment-avata col-sm-1 col-xs-3">
					<img src="@if(substr($comment->user->image, 0, 4) == 'icon') {{ url('resources/photos/'.$comment->user->image) }} @else{{ $comment->user->image }}@endif" alt="">
				</div>
				<div class="comment-user-info col-sm-11">
					<input type="hidden" class="comment-id" value="{!! $comment->id !!}">
					<span class="comment-username">{!! $comment->user->first_name.' '.$comment->user->last_name !!}</span>
					<span class="comment-content">{!! $comment->film_comment_content !!}</span>
					<span class="comment-time" title="{!! $comment->created_at !!}">{!! $comment->created_at !!}</span>
				</div>
			</li>
		@endforeach
	</ul>
	<input type="hidden" class="comment-id-last" value="{!! $film_comment_local_id_last !!}">
	@if($film_comment_local_count > 10)
		<button type="button" id="btn-load-comment-local" data-loading-text="Loading..." class="btn btn-primary form-control">Tải thêm 10 bình luận</button>
	@endif
</div>
<script src="{!! asset('public/momentjs/moment.js') !!}" type="text/javascript" charset="utf-8" async defer></script>
<script src="{!! asset('public/momentjs/moment-timezone-with-data.js') !!}" type="text/javascript" charset="utf-8" async defer></script>

<script type="text/javascript" charset="utf-8" async defer>
	$(document).ready(function () {
		//comment time with moment
		$timezone_default = '{!! env('TIMEZONE_DEFAULT') !!}';
		$('.comment-local-list .comment-time').each(function(){		
			$comment_time = $(this).text();
			var temp = moment.tz($comment_time, $timezone_default);
			$(this).text(temp.fromNow());
		});
		//
		function showAndGetCommentCheck($content){
			$('.comment-check').text($content).show();
		}
		function addCommentLocalUserAppend($comment_id, $user_name, $image, $content, $time){
			$comment_list = $('.comment-local-list ul');
			//get username
			$username = $user_name;
			//check image
			$image_data = $image;
			if($image.substring(0, 4) == 'icon'){
				$image_data = '{!! url('resources/photos/') !!}/'+$image;
			}
			$time_comment_moment = moment.tz($time, $timezone_default).fromNow();
			$str = '<li>'+
				'<div class="comment-avata col-sm-1 col-xs-3">'+
				'<img src="'+$image_data+'" alt="error image avata">'+
				'</div>'+
				'<div class="comment-user-info col-sm-11">'+
				'<input type="hidden" class="comment-id" value="'+$comment_id+'">'+
				'<span class="comment-username">'+$username+'</span>'+
				'<span class="comment-content">'+$content+'</span>'+
				'<span class="comment-time" title="'+$time+'">'+$time_comment_moment+'</span>'+
				'</div>'+
				'</li>';
				$comment_list.append($str);
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
	            url : '{!! route('commentAjax.postAdd', $film_list->id) !!}',
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
                		showAndGetCommentCheck('Bình luận thành công!');
                		//total ++
                		// $('.comment-local-total-int').text(parseInt($('.comment-local-total-int').text()) + 1);
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
		    var btn = $(this).button('loading');
		    //
		    var data = {
				_token : $('form.form-comment-local-add').children('input[name="_token"]').val(),
	            comment_id : $('.comment-local-list ul li:last').find('input.comment-id').val()
	        };
	        // console.log(data['comment_id']);
	        if(data['comment_id'] === undefined || data['comment_id'] === null){
	        	//don't comment to load
	        }else if(data['comment_id'] == 1){
	        	//ko data
	        }
	        else{
	        	//exists comment to load
		        $.ajax({
		            type : 'POST',
		            dataType : 'json',
		            url : '{!! route('commentAjax.postLoad', $film_list->id) !!}',
		            data : data,
		            success : function (result){
		            	
		            	if(result['status'] == 1){
	                		//comment success add
	                		//add show comment
	                		$dk = result['content'].length;
	                		// console.log(result['content'][0].user.username);
	                		$comment_id_last = $('.comment-id-last').val();
	                		$i = 0;
	                		while($i < $dk){
	                			addCommentLocalUserAppend(result['content'][$i].id, result['content'][$i].user.username, result['content'][$i].user.image, result['content'][$i].film_comment_content, result['content'][$i].created_at);
	                			if(result['content'][$i].id == $comment_id_last){
	                				//disable load
	                				btn.attr('disabled', 'disabled');
	                				btn.text('Đã tải hết bình luận ...');
	                			}
	                			$i++;
	                		}
	                	}else{
	                		showAndGetCommentCheck('Lỗi xử lý!');
	                	}
	                	
		            },
		            error : function (){
		               	console.log('Lỗi xử lý đường truyền');
		            }
		        });
	        }
	        // 
		    btn.button('reset');
		})
	});
</script>
<script src="https://localhost/socket.io/socket.io-1.3.4.js"></script>
<script>
    // var socket = io.connect('https://localhost:8080');
   	// socket.on('message', function (data) {
   	// 	console.log(data);
    // });
//
function setCommentLocalTotal($total){
	$('.comment-local-total-int').text($total);
}
function addCommentLocalUserPrepend($comment_id, $user_name, $image, $content, $time){
			$comment_list = $('.comment-local-list ul');
			//get username
			$username = $user_name;
			//check image
			$image_data = $image;
			if($image.substring(0, 4) == 'icon'){
				$image_data = '{!! url('resources/photos/') !!}/'+$image;
			}
			//time
			$time_comment_moment = moment.tz($time, $timezone_default).fromNow();
			$str = '<li>'+
				'<div class="comment-avata col-sm-1 col-xs-3">'+
				'<img src="'+$image_data+'" alt="error image avata">'+
				'</div>'+
				'<div class="comment-user-info col-sm-11">'+
				'<input type="hidden" class="comment-id" value="'+$comment_id+'">'+
				'<span class="comment-username">'+$username+'</span>'+
				'<span class="comment-content">'+$content+'</span>'+
				'<span class="comment-time" title="'+$time+'">'+$time_comment_moment+'</span>'+
				'</div>'+
				'</li>';
				$comment_list.prepend($str);
		}
const PRIVATE_CHANNEL = '{!! $channel_name !!}';

//

// var io = require('socket.io-client')

var host = window.location.host.split(':')[0]
var socket = io.connect('//' + host + ':8000', {secure: true, rejectUnauthorized: false})

socket.on('connect', function () {
    console.log('CONNECT')
    
    socket.on('event', function (data) {
        console.log('EVENT', data)
    })
    
    socket.on('messages.new', function (data) {
        // console.log('NEW PRIVATE MESSAGE', data)
        // alert(data['comment']);
        // console.log(data['comment']['time']['date']);
        addCommentLocalUserPrepend(data['comment']['user_id'], data['comment']['username'], data['comment']['image'], data['comment']['content'], data['comment']['time']['date']);
        //set total
        setCommentLocalTotal(data['comment']['total']);
        // console.log(data['comment']['time']);
    })
    
    socket.on('disconnect', function () {
        console.log('disconnect')
    })
    
    // Kick it off
    // Can be any channel. For private channels, Laravel should pass it upon page load (or given by another user).
    socket.emit('subscribe-to-channel', {channel: PRIVATE_CHANNEL})
    console.log('SUBSCRIBED TO <' + PRIVATE_CHANNEL + '>');
})
 
</script>