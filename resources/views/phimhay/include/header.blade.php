
<!-- head -->
<div class="head">
	<div class="container">
		<div class="logo">
			<a href="{{ url('') }}" title="Phim Hay"><img src="{!! url('resources/images/bg_icon_phimhay.png') !!}" alt="Erro logo"></a>
		</div>
		<!-- search -->
		<div class="search">
			<form action="#" class="form-search-film" method="GET" accept-charset="utf-8">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="input-group">
				    <input type="text" id="search-key-value" class="form-control" name="txtSearch"placeholder="Tìm tên phim" value="@if(isset($name)) {!! $name !!} @endif">
				    	<span class="input-group-btn">
				        <button class="btn btn-default film-btn-search" type="button">Tìm Kiếm</button>
				     	</span>
				    </div><!-- /input-group -->
				    <div class="search-result">
						<div class="search-title">
							<span>Tìm kiếm với "</span>
							<span class="search-key-word text-danger"></span>
							<span>":</span>
							<span class="search-icon-close glyphicon glyphicon-remove" title="Đóng"></span>
						</div>
						<ul>
							<!-- <li>
								<a href="#" title="">
									<div class="search-poster-film"><img src="{!! url('resources/poster/poster-lost-1.jpg') !!}" alt="Error image poster film"></div>
									<span class="search-name-film">Tên phim</span>
									<span class="search-name-film">Tên phim</span>
									<span class="search-year-film">Nam</span>
									<div class="clearfix"></div>
								</a>
							</li> -->
						</ul>
					</div>
			</form>
		</div>
		<!-- end search -->
		<div class="user">
			@if(Auth::guest())
			<!-- chua login -->
			<ul class="list-inline">
		      	<li><a href="{{ route('auth.getLogin') }}"><span class="glyphicon glyphicon-user"></span> Đăng Nhập</a></li>
		      	<li><a href="{{ route('auth.getRegister') }}"><span class="glyphicon glyphicon-log-in"></span> Đăng Ký</a></li>
		    </ul>
		    <!-- Login -->
		    @elseif(Auth::check())
		    <ul class="list-inline">
		      	<li class="user-avata-li">
		      		<img src="@if(substr(Auth::user()->image, 0, 4) == 'icon') {{ url('resources/photos/'.Auth::user()->image) }} @else{{ Auth::user()->image }}@endif" class="user-avata dropdown-toggle img-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" alt="Username">
		      		<ul class="dropdown-menu">
				    <li><a href="{!! route('user.getProfile', Auth::user()->id) !!}">Trang Cá Nhân</a></li>
				    <li role="separator" class="divider"></li>
				    @if(Auth::user()->level == 1)
					    <!-- admin -->
					    <li><a href="{!! url('admin') !!}">Administrator Page</a></li>
					    <li role="separator" class="divider"></li>
					    <!-- end admin -->
					@endif
				    <li><a class="btn btn-link" data-toggle="modal" data-target=".modal-logout">Đăng Xuất</a></li>
				  </ul>
		      	</li>
		      	<li><a href="{!! route('user.getProfile', Auth::user()->id) !!}" class="user-username" title="User {{ Auth::user()->username }}">@if(Auth::user()->first_name == '' && Auth::user()->last_name == '') {{ Auth::user()->username }} @else{{ Auth::user()->first_name.' '.Auth::user()->last_name }}@endif</a></li>
		    </ul>
		    @endif
		</div>
	</div>
</div>
<!-- end head -->
<!-- menu -->
<div class="menu">
	<div class="container">
		<nav class="navbar navbar-default">
	  		<div class="container-fluid">
	    		<div class="navbar-header">
	    			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false" aria-controls="navbar">
	              		<span class="sr-only">Toggle navigation</span>
	              		<span class="icon-bar"></span>
	              		<span class="icon-bar"></span>
	              		<span class="icon-bar"></span>
	            	</button>
	      			<a class="navbar-brand" href="{!! url('') !!}"><span class="glyphicon glyphicon-home"></span></a>
			    </div>
			    <div class="collapse navbar-collapse" id="menu">
				    <ul class="nav navbar-nav">
			      		<li class="dropdown">
				        	<a class="dropdown-toggle" data-toggle="dropdown" href="{!! url('film') !!}">THỂ LOẠI
				        	<span class="caret"></span></a>
				        	<!-- <ul class="dropdown-menu">
					          	<li><a href="{!! url('film?type=chien-tranh') !!}">Phim Chiến tranh</a></li>
								<li><a href="{!! url('film?type=co-trang') !!}">Phim Cổ trang</a></li>
								<li><a href="{!! url('film?type=gia-tuong') !!}">Phim Giả tưởng</a></li>
								<li><a href="{!! url('film?type=hai-huoc') !!}">Phim Hài hước</a></li>
						        <li><a href="{!! url('film?type=hanh-dong') !!}">Phim Hành động</a></li>
						        <li><a href="{!! url('film?type=hinh-su') !!}">Phim Hình sự</a></li>
						        <li><a href="{!! url('film?type=hoc-duong') !!}">Phim Học đường</a></li>
						        <li><a href="{!! url('film?type=kinh-di') !!}">Phim Kinh dị</a></li>
						        <li><a href="{!! url('film?type=hoi-hop-gay-can') !!}">Phim Hồi hộp Gây cấn</a></li>
						        <li><a href="{!! url('film?type=phieu-luu') !!}">Phim Phép thuật</a></li>
						        <li><a href="{!! url('film?type=phieu-luu') !!}">Phim Phiêu lưu</a></li>
						        <li><a href="{!! url('film?type=sieu-nhien') !!}">Phim Siêu nhiên</a></li>
						        <li><a href="{!! url('film?type=vo-thuat') !!}">Phim Võ thuật</a></li>
						        <li><a href="{!! url('film?type=vien-tuong') !!}">Phim Viễn tưởng</a></li>
						        <li><a href="{!! url('film?type=tai-lieu') !!}">Phim Tài liệu</a></li>
						        <li><a href="{!! url('film?type=tam-ly') !!}">Phim Tâm lý</a></li>
						        <li><a href="{!! url('film?type=tinh-cam') !!}">Phim Tình cảm</a></li>
						        <li><a href="{!! url('film?type=than-thoai') !!}">Phim Thần thoại</a></li>
						        <li><a href="{!! url('film?type=trinh-tham') !!}">Phim Trinh thám</a></li>
						        <li><a href="{!! url('film?type=zombie') !!}">Phim Zombie</a></li>
					        </ul> -->
					        <ul class="dropdown-menu">
					        	@foreach($film_type as $data)
					          	<li><a href="{!! url('film?type='.$data->type_alias) !!}">Phim {!! $data->type_name !!}</a></li>
					          	@endforeach
					         </ul>
		      			</li>
			      		<li class="dropdown">
				        	<a class="dropdown-toggle" data-toggle="dropdown" href="{!! url('film?category=le') !!}">PHIM LẺ
				        	<span class="caret"></span></a>
				        	<!-- <ul class="dropdown-menu">
					          	<li><a href="{!! url('film?category=le&country=anh') !!}">Phim Anh</a></li>
						        <li><a href="{!! url('film?category=le&country=an-do') !!}">Phim Ấn Độ</a></li>
						        <li><a href="{!! url('film?category=le&country=au-my') !!}">Phim Âu-Mỹ</a></li>
								<li><a href="{!! url('film?category=le&country=dai-loan') !!}">Phim Đài Loan</a></li>
								<li><a href="{!! url('film?category=le&country=han-quoc') !!}">Phim Hàn Quốc</a></li>
								<li><a href="{!! url('film?category=le&country=hong-kong') !!}">Phim Hồng Kông</a></li>
						        <li><a href="{!! url('film?category=le&country=my') !!}">Phim Mỹ</a></li>
						        <li><a href="{!! url('film?category=le&country=nga') !!}">Phim Nga</a></li>
						        <li><a href="{!! url('film?category=le&country=nhat-ban') !!}">Phim Nhật Bản</a></li>
						        <li><a href="{!! url('film?category=le&country=viet-nam') !!}">Phim Việt Nam</a></li>
						        <li><a href="{!! url('film?category=le&country=thai-lan') !!}">Phim Thái Lan</a></li>
						        <li><a href="{!! url('film?category=le&country=trung-quoc') !!}">Phim Trung Quốc</a></li>
						        <li><a href="{!! url('film?category=le&country=quoc-gia-khac') !!}">Phim Quốc Gia Khác</a></li>
					        </ul> -->
					        <ul class="dropdown-menu">
					        	@foreach($film_country as $data)
					          	<li><a href="{!! url('film?category=le&country='.$data->country_alias) !!}">Phim {!! $data->country_name !!}</a></li>
					          	@endforeach
					         </ul>
		      			</li>
		      			<li class="dropdown">
				        	<a class="dropdown-toggle" data-toggle="dropdown" href="#">PHIM BỘ
				        	<span class="caret"></span></a>
				        	<!-- <ul class="dropdown-menu">
					          	<li><a href="{!! url('film?category=bo&country=anh') !!}">Phim Anh</a></li>
								<li><a href="{!! url('film?category=bo&country=an-do') !!}') !!}">Phim Ấn Độ</a></li>
								<li><a href="{!! url('film?category=bo&country=au-my') !!}">Phim Âu-Mỹ</a></li>
								<li><a href="{!! url('film?category=bo&country=dai-loan') !!}') !!}">Phim Đài Loan</a></li>
								<li><a href="{!! url('film?category=bo&country=han-quoc') !!}') !!}">Phim Hàn Quốc</a></li>
								<li><a href="{!! url('film?category=bo&country=hong-kong') !!}') !!}">Phim Hồng Kông</a></li>
						        <li><a href="{!! url('film?category=bo&country=my') !!}">Phim Mỹ</a></li>
						        <li><a href="{!! url('film?category=bo&country=nga') !!}">Phim Nga</a></li>
						        <li><a href="{!! url('film?category=bo&country=nhat-ban') !!}">Phim Nhật Bản</a></li>
						        <li><a href="{!! url('film?category=bo&country=viet-nam') !!}">Phim Việt Nam</a></li>
						        <li><a href="{!! url('film?category=bo&country=thai-lan') !!}">Phim Thái Lan</a></li>
						        <li><a href="{!! url('film?category=bo&country=trung-quoc') !!}">Phim Trung Quốc</a></li>
						        <li><a href="{!! url('film?category=bo&country=quoc-gia-khac') !!}">Phim Quốc Gia Khác</a></li>
					        </ul> -->
					        <ul class="dropdown-menu">
					        	@foreach($film_country as $data)
					          	<li><a href="{!! url('film?category=bo&country='.$data->country_alias) !!}">Phim {!! $data->country_name !!}</a></li>
					          	@endforeach
					         </ul>
		      			</li>
		      			<li class="dropdown">
				        	<a class="dropdown-toggle" data-toggle="dropdown" href="{!! url('film?category=hh') !!}">PHIM HOẠT HÌNH
				        	<span class="caret"></span></a>
				        	<!-- <ul class="dropdown-menu">
					          	<li><a href="{!! url('film?category=hh&type=gia-tuong') !!}">Phim Giả tưởng</a></li>
						        <li><a href="{!! url('film?category=hh&type=hanh-dong') !!}">Phim Hành động </a></li>
						        <li><a href="{!! url('film?category=hh&type=hai-huoc') !!}">Phim Hài hước</a></li>
								<li><a href="{!! url('film?category=hh&type=hoc-duong') !!}">Phim Học đường</a></li>
								<li><a href="{!! url('film?category=hh&type=kinh-di') !!}">Phim Kinh dị</a></li>
						        <li><a href="{!! url('film?category=hh&type=vien-tuong') !!}">Phim Viễn tưởng</a></li>
						        <li><a href="{!! url('film?category=hh&type=phep-thuat') !!}">Phim Phép thuật</a></li>
						        <li><a href="{!! url('film?category=hh&type=phieu-luu') !!}">Phim Phiêu lưu</a></li>
						        <li><a href="{!! url('film?category=hh&type=sieu-nhien') !!}">Phim Siêu nhiên</a></li>
						        <li><a href="{!! url('film?category=hh&type=tinh-cam') !!}">Phim Tình cảm</a></li>
						        <li><a href="{!! url('film?category=hh&type=vo-thuat') !!}">Phim Võ thuật</a></li>
					        </ul> -->
					        <ul class="dropdown-menu">
					        	@foreach($film_type as $data)
					          	<li><a href="{!! route('film.getSearch') !!}?category=hh&type={!! $data->type_alias !!}">Phim {!! $data->type_name !!}</a></li>
					          	@endforeach
					        </ul>
		      			</li>

		    		</ul>
		    	</div>
	  		</div>
		</nav>
	</div>
</div>
<!-- end menu -->
<script>
	$(document).ready(function() {
		// $('ul.nav li.dropdown').hover(function() {
		//   $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
		// 	}, function() {
		//   $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
		// });
	});
	// $(window).onscroll(function(){
	// 	menuFixScroll();
	// });
	window.onscroll = function() {menuFixScroll()};
	function menuFixScroll() {
		    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
		    	//var menu = document.getElementById("Menu");
		        //menu.style.position = 'fixed';
		        //menu.style.top = '0px';
		        $('.menu').addClass('menu-fix');
		        $('.content').attr('margin-top', 80);
		    } else {
		        //document.getElementById("Menu").style.position = 'relative';
		        $('.menu').removeClass('menu-fix');
		        $('.content').attr('margin-top', 0);
		    }

		}
</script>
<script>
$('.film-btn-search').click(function() {
	$key = $('input#search-key-value').val();
	$film_url = '{!! route('film.getSearch') !!}';
	window.location.href = $film_url+'?name='+$key;
});
	//search
$('.search-icon-close').click(function() {
	$('.search-result').hide();
	//se remove all li of ul
	$('.search-result ul li').remove();
});
function showSearchResult() {
	$('.search-result').show();
}
function addSearchFilm($film_dir, $film_img, $film_name_full, $film_name_vn, $film_name_en, $film_year) {
	$film_search = '<li>'+
							'<a href="'+$film_dir+'" title="'+$film_name_vn+' '+$film_name_en+'">'+
								'<div class="search-poster-film"><img src="'+$film_img+'" alt="Error image poster film"></div>'+
								'<span class="search-name-film">'+$film_name_vn+'</span>'+
								'<span class="search-name-film">'+$film_name_en+'</span>'+
								'<span class="search-year-film">'+$film_year+'</span>'+
								'<div class="clearfix"></div>'+
							'</a>'+
						'</li>';
	$('.search-result ul').append($film_search);
}
function removeSearchFilm() {
	$('.search-result ul li').remove();
}
//khi click vao khoi tao keyup
$('input#search-key-value').click(function() {
	$(this).keyup(function() {
		//goi ajax
		var data = {
			_token : $('form.form-search-film').children('input[name="_token"]').val(),
            search_key_value : $('input#search-key-value').val()
        };
		$.ajax({
            type : 'POST',
            dataType : 'json',
            url : '{!! route('filmAjax.getSearchFilm') !!}',
            data : data,
            success : function (result){
            	//goi remove
            	removeSearchFilm();
            	$('.search-key-word').text(data['search_key_value']);
            	if(result != null){
                	var dk = result.length;
                	var i = 0;
                	while(i < dk){
                		$name_film = result[i]['film_name_vn']+'-'+result[i]['film_name_en'];
                		if(result[i]['film_name_vn'] == ''){
                			$name_film = result[i]['film_name_en'];
                		}
                		if(result[i]['film_name_en'] == ''){
                			$name_film = result[i]['film_name_vn']
                		}
                		addSearchFilm('{!! env('WEBSITE_NAME') !!}film/'+result[i]['film_dir_name']+'/'+result[i]['id'], result[i]['film_thumbnail_small'], $name_film, result[i]['film_name_vn'], result[i]['film_name_en'], result[i]['film_years']);                		
                		i++;
                	}
                	//show
                	showSearchResult();
                }

            },
            error : function (){
               	console.log('Lỗi xử lý đường truyền');
            }
        });
	});
});
</script>