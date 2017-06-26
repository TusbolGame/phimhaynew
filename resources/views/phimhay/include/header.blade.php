
<!-- head -->
<div class="head">
	<div class="container">
		<div class="logo">
			<a href="{{ url('') }}" title="Phim Hay"><img src="{!! url('resources/images/bg_icon_phimhay.png') !!}" alt="Erro logo"></a>
		</div>
		<!-- search -->
		<div class="search">
			<form action="{!! route('film.getSearch') !!}" class="form-search-film" method="GET" accept-charset="utf-8">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="input-group">
				    <input type="text" id="search-key-value" class="form-control" name="name"placeholder="Tìm tên phim" value="@if(isset($name)){!! $name !!}@endif">
				    	<span class="input-group-btn">
				        <button class="btn btn-default film-btn-search" type="submit">Tìm Kiếm</button>
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
				    @if(Auth::user()->hasPermission('accessAdmin'))
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
					        <ul class="dropdown-menu">
					        	@foreach($film_type as $data)
					          	<li><a href="{!! url('film?type='.$data->type_alias) !!}">Phim {!! $data->type_name !!}</a></li>
					          	@endforeach
					         </ul>
		      			</li>
			      		<li class="dropdown">
				        	<a class="dropdown-toggle" data-toggle="dropdown" href="{!! url('film?category=le') !!}">PHIM LẺ
				        	<span class="caret"></span></a>
					        <ul class="dropdown-menu">
					        	@foreach($film_country as $data)
					          	<li><a href="{!! url('film?category=le&country='.$data->country_alias) !!}">Phim {!! $data->country_name !!}</a></li>
					          	@endforeach
					         </ul>
		      			</li>
		      			<li class="dropdown">
				        	<a class="dropdown-toggle" data-toggle="dropdown" href="#">PHIM BỘ
				        	<span class="caret"></span></a>
					        <ul class="dropdown-menu">
					        	@foreach($film_country as $data)
					          	<li><a href="{!! url('film?category=bo&country='.$data->country_alias) !!}">Phim {!! $data->country_name !!}</a></li>
					          	@endforeach
					         </ul>
		      			</li>
		      			<li class="dropdown">
				        	<a class="dropdown-toggle" data-toggle="dropdown" href="{!! url('film?kind=hoat-hinh') !!}">PHIM HOẠT HÌNH
				        	<span class="caret"></span></a>
					        <ul class="dropdown-menu">
					        	@foreach($film_type as $data)
					          	<li><a href="{!! route('film.getSearch') !!}?kind=hoat-hinh&type={!! $data->type_alias !!}">Phim {!! $data->type_name !!}</a></li>
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
	//fixed menu
	//$(document).ready(function() {
		// $('ul.nav li.dropdown').hover(function() {
		//   $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
		// 	}, function() {
		//   $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
		// });
	//});
	// $(window).onscroll(function(){
	// 	menuFixScroll();
	// });
	// window.onscroll = function() {menuFixScroll()};
	// function menuFixScroll() {
	// 	    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
	// 	    	//var menu = document.getElementById("Menu");
	// 	        //menu.style.position = 'fixed';
	// 	        //menu.style.top = '0px';
	// 	        $('.menu').addClass('menu-fix');
	// 	        $('.content').attr('margin-top', 80);
	// 	    } else {
	// 	        //document.getElementById("Menu").style.position = 'relative';
	// 	        $('.menu').removeClass('menu-fix');
	// 	        $('.content').attr('margin-top', 0);
	// 	    }
	// 	}
</script>
<script>
// $('.film-btn-search').click(function() {
// 	$key = $('input#search-key-value').val();
// 	$film_url = '{!! route('film.getSearch') !!}';
// 	window.location.href = $film_url+'?name='+$key;
// });
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
$('input#search-key-value').keyup(function() {
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
</script>