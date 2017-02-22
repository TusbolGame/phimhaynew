<div class="film-evaluate film-detail-border">
	<p>Đánh giá <span>(&nbsp;</span><span class="movie-evaluate-vote-count">{{ $film_vote_count }}</span><span>&nbsp;lượt)</span></p>
	<?php 
	$vote = array('0'=>'', '1'=>'', '2'=>'', '3'=>'', 
		'4'=>'', '5'=>'', '6'=>'', '7'=>'', 
		'8'=>'', '9'=>'',
		'10'=>'');
	$film_vote = ceil($film_vote);
	$vote[$film_vote] = 'vote-default';
	 ?>
	<div class="vote">
		<a class="hide" href="javascript:void(0)"><span class="star no-vote {!! $vote['0'] !!}" data-val="0" title="Tệ"></span></a>
		<a href="javascript:void(0)"><span class="star no-vote {!! $vote['1'] !!}" data-val="1" title="Dở tệ"></span></a>
		<a href="javascript:void(0)"><span class="star no-vote {!! $vote['2'] !!}" data-val="2" title="Dở"></span></a>
		<a href="javascript:void(0)"><span class="star no-vote {!! $vote['3'] !!} " data-val="3" title="Không hay"></span></a>
		<a href="javascript:void(0)"><span class="star no-vote {!! $vote['4'] !!}" data-val="4" title="Không hay lắm"></span></a>
		<a href="javascript:void(0)"><span class="star no-vote {!! $vote['5'] !!}" data-val="5" title="Bình thường"></span></a>
		<a href="javascript:void(0)"><span class="star no-vote {!! $vote['6'] !!}" data-val="6" title="Xem được"></span></a>
		<a href="javascript:void(0)"><span class="star no-vote {!! $vote['7'] !!}" data-val="7" title="Có vẻ hay"></span></a>
		<a href="javascript:void(0)"><span class="star no-vote {!! $vote['8'] !!}" data-val="8" title="Hay"></span></a>
		<a href="javascript:void(0)"><span class="star no-vote {!! $vote['9'] !!} " data-val="9" title="Rất hay"></span></a>
		<a href="javascript:void(0)"><span class="star no-vote {!! $vote['10'] !!}" data-val="10" title="Tuyệt hay"></span></a>
	</div>
	<?php 
	//unset var
	unset($vote);
	unset($film_vote);
	 ?>
	<script>
		$(document).ready(function(){
			//onload vote, toi vote-default
			//default
			$('.vote a span').each(function(){
				$span = $(this);
				if(!$span.hasClass('vote-default')){
					if($span.hasClass('no-vote')){
						$span.removeClass('no-vote');
						$span.addClass('is-vote');
					}
				}
				else{
					return false;
				}
			});
			//xet vote default
			$default = $('.vote a span.vote-default');
			if($default.hasClass('no-vote')){
				$default.removeClass('no-vote');
				$default.addClass('is-vote');
			}
			//hover vote
			$('.vote a').hover(function(){ //in
				$this = $(this);
				$span = $this.children('span');
				//add class is-hover de check hover
				$span.addClass('is-hover');
				if($span.hasClass('no-vote')){
					$span.removeClass('no-vote');
					$span.addClass('is-vote');
				}
				//th1: is-hover đứng ở đầu tiên, 
				//chạy từ vị trí 2, trừ đi vị trí is-hover, đến cuối, gặp is-vote thì chuyển thành no-vote
				if($span.attr('data-val') == 1){
					$('.vote a span').each(function(){
						$span = $(this);
						if($span.hasClass('is-vote') && !$span.hasClass('is-hover')){
							$span.removeClass('is-vote');
							$span.addClass('no-vote');
						}						
					});
				}
				if($span.attr('data-val') > 1){
					$dk = true;
					$('.vote a span').each(function(){
						$span2 = $(this);
						if($span2.hasClass('no-vote') && $dk){
							$span2.removeClass('no-vote');
							$span2.addClass('is-vote');
						}
						if(!$dk){
							$span2.removeClass('is-vote');
							$span2.addClass('no-vote');
						}
						if($span2.hasClass('is-hover')){
							$dk = false;	
						}
			
					});
				}			
			},function(){ //out
				//reset ... 
				$('.vote a span').each(function(){
						$span = $(this);
						if($span.hasClass('is-vote')){
							$span.removeClass('is-vote');
							$span.addClass('no-vote');
						}						
				});
				//reset is-hover
				$('span.is-hover').removeClass('is-hover');
				//vote-default
				$('.vote a span').each(function(){
						$span = $(this);
						if(!$span.hasClass('vote-default')){
							if($span.hasClass('no-vote')){
								$span.removeClass('no-vote');
								$span.addClass('is-vote');
							}
						}
						else{
							return false;
						}
					});
				//xet vote default
				$default = $('.vote a span.vote-default');
				if($default.hasClass('no-vote')){
					$default.removeClass('no-vote');
					$default.addClass('is-vote');
				}
			}
			);
			//end hover vote
			//ajax click vote
			$('div.vote a').click(function(){
				//get data
				var data = {
					_token : $('.token-data').val(),
					film_id : $('.film-id-data').val(),
	                film_vote : $(this).children('span').attr('data-val')
	            };
	            $this = $(this);

				$.ajax({
	                type : 'POST',
	                dataType : 'json',
	                url : '{!! route('filmAjax.getFilmEvaluate') !!}',
	                data : data,
	                success : function (result){
	                	//console.log(result);
	                	if(result['login'] == 0){
	                		//chua login
	                		//show modal
	                		$('.modal-alert-not-login').modal('show');
	                	}else if(result['status'] == 1){
	                		//vote success
	                		//unset class vote-default
							$('.vote a span.vote-default').removeClass('vote-default');
							//add lai
							$this.children('span').addClass('vote-default');
							//$('.vote a span').eq(data['evaluate_film_vote']).addClass('vote-default');
							//set vote count
							$('span.movie-evaluate-vote-count').text(parseInt($('span.movie-evaluate-vote-count').text())+1);
							//
							$('.modal-alert-success-content').text('Đã đánh giá phim');
	                		$('.modal-alert-success').modal('show');
							//unset event click
							$('div.vote a').unbind();
							$('.div.vote a').addClass('cursor-default');

	                	}else if(result['status'] == 0){
	                		//error
	                		$('.modal-alert-error-content').text(result['content']);
	                		$('.modal-alert-error').modal('show');
	                	}
	                },
	                error : function (){
	                   	console.log('Lỗi xử lý đường truyền');
	                }
	            });
			})
		});
	</script>
</div>