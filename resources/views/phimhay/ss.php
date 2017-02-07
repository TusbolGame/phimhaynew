@extends('phimhay.master')
@section('title', 'Phimhay | Website xem phim online')
@section('description', 'PhimHay xem phim online')
@section('css')
	
@stop
@section('js')
	
@stop
@section('film-dir')
	<div class="film-dir">
		<ol class="breadcrumb">
		  	<li><a href="{!! route('home') !!}">Phim Hay</a></li>
		  	<li><a href="{!! url('film/') !!}">Phim</a></li>
		  	<li class="active">Data</li>
		</ol>
	</div>
@stop
@section('content')
	<!-- film introduce -->
	<div class="film-introduce film-background-border">
		<div class="film-info">
			<div class="col-sm-6">
				<div class="film-thumbnail">
					<img src="https://www.localhost/phimhaynew/resources/phim/poster/poster-lost-1.jpg" alt="">
					<ul>
						<li><a class="btn btn-warning" href="dowload.php" title="Download">Dowload</a></li>
						<li><a class="btn btn-success" href="xem-phim.php" title="Xem phim">Xem phim</a></li>
					</ul>
					<div class="film-tick">
						<span class="icon-tick icon-no-tick glyphicon glyphicon-plus"></span>
						<span class="tick-content">Đánh dấu</span>
					</div>
<script>
//click tick
	$('.film-tick').click(function() {
		$tick = $(this).children('.icon-tick');
		$tick_content = $(this).children('.tick-content');
		//is tick
		if($tick.hasClass('icon-is-tick')){
			//ajax trc

			$tick.removeClass('icon-is-tick');
			$tick.removeClass('glyphicon-minus');
			$tick.addClass('icon-no-tick');
			$tick.addClass('glyphicon-plus');
			//change Bỏ đánh dấu to Đánh dấu
			$tick_content.text('Đánh dấu');
			

		}
		//chua tick
		else if($tick.hasClass('icon-no-tick')){
			//ajax trc
			
			$tick.removeClass('icon-no-tick');
			$tick.removeClass('glyphicon-plus');
			$tick.addClass('icon-is-tick');
			$tick.addClass('glyphicon-minus');
			//change Đánh dấu to Bỏ đánh dấu
			$tick_content.text('Bỏ đánh dấu');
		}
	});
	//end hover tick
	//click tick
	// $('div.movie-tick').click(function(){
	// 	$tick2 = $(this).children('span.icon-tick');
	// 	$nd = $(this).children('span.tick-content');
	// 	//kt chua tick ...
	// 	if($tick2.hasClass('icon-hover-no-tick')){
	// 		$nd.text('Bỏ đánh dấu');
	// 		$tick2.removeClass('icon-hover-no-tick');
	// 		$tick2.addClass('icon-hover-is-tick');
	// 		//event, click tick
	// 		// Lấy dự liệu
 //            var data = {
 //                tick_film_id : $('#comment_film_id').val(),
 //                add_tick_film : 'add-tick-film'
 //            };
	// 		$.ajax({
 //                type : 'POST',
 //                dataType : 'json',
 //                url : '../../phim/film-processing/add_tick_film.php',
 //                data : data,
 //                success : function (result){
 //                	console.log(result['ticked']);
 //                },
 //                error : function (){
 //                   	console.log('Lỗi xử lý đường truyền');
 //                }
 //            });
	// 	}
	// 	//da tick
	// 	else if($tick2.hasClass('icon-hover-is-tick')){
	// 		$nd.text('Đánh dấu');
	// 		$tick2.removeClass('icon-hover-is-tick');
	// 		$tick2.addClass('icon-hover-no-tick');
	// 		////lam event remove tick
	// 		// Lấy dự liệu
 //            var data = {
 //                tick_film_id : $('#comment_film_id').val(),
 //                remove_tick_film : 'remove-tick-film'
 //            };
	// 		$.ajax({
 //                type : 'POST',
 //                dataType : 'json',
 //                url : '../../phim/film-processing/remove_tick_film.php',
 //                data : data,
 //                success : function (result){
 //                	console.log(result['ticked']);
 //                },
 //                error : function (){
 //                   	console.log('Lỗi xử lý đường truyền');
 //                }
 //            });

	// 	}
	// })
</script>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="film-detail">
					<div class="film-title">
						<span class="film-title-vn film-new-title">3455</span>
						<span class="film-title-en">ggg</span>
						<span class="film-title-years">&nbsp;(2013)</span>
					</div>
					<div class="film-meta-info film-detail-border">
						<dl>
							<dt>Trạng thái:</dt>
							<dd class="film-status">Hoàn tất</dd>
							<br>
							<dt>Đạo diễn:</dt>
							<dd></dd>
							<br>
							<dt>Quốc gia:</dt>
							<dd><a href="../../phim/nhat-ban/" title="Nhật Bản">Nhật Bản</a></dd>
							<br>
							<dt>Năm:</dt>
							<dd><a href="../../phim/2013/" title="Phim năm 2013">2013</a></dd>
							<br>
							<dt>Thể loại:</dt>
							<dd><a href="../../phim/hoat-hinh/" title="Phim hoạt hình">Phim hoạt hình</a>,&nbsp;<a href="../../phim/hanh-dong/" title="Hành động">Hành động</a></dd>
							<br>
							<dt>Thời lượng:</dt>
							<dd>24 tập</dd>
							<br>
							<dt>Chất lượng:</dt>
							<dd class="film-quality"><span class="glyphicon glyphicon-hd-video"></span></dd>
							<br>
							<dt>Ngôn ngữ:</dt>
							<dd>VietSub</dd>
							<br>
							<dt>Ngày chiếu:</dt>
							<dd></dd>
							<br>
							<dt>Diễn viên:</dt>
							<dd></dd>
							<br>
							<dt>Công ty sx:</dt>
							<dd></dd>
							<br>
							<dt>Lượt xem:</dt>
							<dd>0</dd>
						</dl>

					</div>
					<div class="film-evaluate film-detail-border">
						<p>Đánh giá <span>(</span><span class="movie-evaluate-vote-count">8</span><span>&nbsp;lượt)</span></p>
						<div class="vote">
							<a class="hide" href="javascript:void(0)"><span class="star is-vote" data-val="0" title="Tệ"></span></a>
							<a href="javascript:void(0)"><span class="star is-vote" data-val="1" title="Dở tệ"></span></a>
							<a href="javascript:void(0)"><span class="star is-vote" data-val="2" title="Dở"></span></a>
							<a href="javascript:void(0)"><span class="star is-vote" data-val="3" title="Không hay"></span></a>
							<a href="javascript:void(0)"><span class="star is-vote" data-val="4" title="Không hay lắm"></span></a>
							<a href="javascript:void(0)"><span class="star is-vote" data-val="5" title="Bình thường"></span></a>
							<a href="javascript:void(0)"><span class="star is-vote" data-val="6" title="Xem được"></span></a>
							<a href="javascript:void(0)"><span class="star is-vote" data-val="7" title="Có vẻ hay"></span></a>
							<a href="javascript:void(0)"><span class="star vote-default is-vote" data-val="8" title="Hay"></span></a>
							<a href="javascript:void(0)"><span class="star no-vote" data-val="9" title="Rất hay"></span></a>
							<a href="javascript:void(0)"><span class="star no-vote" data-val="10" title="Tuyệt vời"></span></a>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="film-trailer film-detail-border">
			<h4 class="film-title-box"><span class="glyphicon glyphicon-film"></span> TRAILER</h4>
		</div>
		<div class="film-content film-detail-border">
			<h4 class="film-title-box"><span class="glyphicon glyphicon-heart"></span> NỘI DUNG PHIM</h4>
			<div class="film-content-info">
				<p>Đại gia tộc trừ tà diệt ma Tsuchimikado đã bước vào thời kì hoàng kim bậc nhất, danh tiếng vang xa khắp bốn bể dưới triều đại của Tsuchimikado Yako. Vị pháp sư kì tài ngàn năm hiếm có này đã khiến ba cõi thần người và âm phải khiếp sợ. Thế nhưng, trong một sai lầm, khiến cho phong ấn lối vào địa ngục bị phá vỡ, hàng vạn linh hồn ma quỷ trốn thoát và gây náo động khắp Tokyo. Kể từ đó, danh tiếng của gia tộc Tsuchimikado cũng tàn theo mây khói còn Yako thì ôm hận mà chết.</p>
				<img src="https://drive.google.com/uc?export=download&id=0B18baix_ssU1UmF1cVFLQl9mWWs" alt="">
			</div>
		</div>
		<div class="film-key-word film-detail-border">
			<h4 class="film-title-box"><span class="glyphicon glyphicon-flag"></span> TỪ KHÓA</h4>
			<div class="list-key-words">
				<ul>
					<li><a href="https://www.localhost/phimhay/search/?key=tokyo+ravens" title="tokyo ravens">tokyo ravens</a></li>
					<li><a href="https://www.localhost/phimhay/search/?key=tokyo+ravens" title="tokyo ravens">tokyo ravens</a></li>
					<li><a href="https://www.localhost/phimhay/search/?key=tokyo+ravens" title="tokyo ravens">tokyo ravens</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- film introduce -->
	<!-- film comment -->
	<div class="film-comment film-background-border">
		<div class="film-comment-content film-detail-border">
			<h4 class="film-title-box"><span class="glyphicon glyphicon-comment"></span> BÌNH LUẬN</h4>
			<ul class="nav nav-tabs">
		  		<li role="presentation" class="active select-comment-facebook"><a href="javascript:void(0);">Bình luận Facebook</a></li>
		  		<li role="presentation" class="select-comment-local"><a href="javascript:void(0);">Bình luận PhimHay</a></li>
			</ul>
			<div class="film-comment-div">
				<!-- comment fb -->
				<div class="film-comment-facebook">
					
				</div>
				<!-- comment local -->
				<div class="film-comment-local">
					<div class="comment-local-total">
						<span>1</span>
						<span>Bình luận</span>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<script>
		$(document).ready(function () {
			//fix active onclick
			$('.select-comment-local').click(function() {
				//neu exist active of fb, remove
				$fb = $('.select-comment-facebook');
				if($fb.hasClass('active')){
					$fb.removeClass('active');
				}
				//hide comment fb
				$('.film-comment-facebook').slideUp(300).hide();
				//view comment local
				$('.film-comment-local').slideDown(300).show();
			});
			$('.select-comment-facebook').click(function() {
				//hide comment local
				$('.film-comment-local').slideUp(300).hide();
				//view comment facebook
				$('.film-comment-facebook').slideDown(300).show();
			});
		});
	</script>
	<!-- end film commnet -->
@stop