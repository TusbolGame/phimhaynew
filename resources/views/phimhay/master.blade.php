<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta http-equiv="X-UA-Compatible" username="IE=edge">
	<title>@yield('title')</title>
	<meta name="description" content="@yield('description')">
	<meta property="fb:app_id" content="{!! $phim_hay_config->fb_app_id !!}" />
	<meta property="fb:admins" content="{!! $phim_hay_config->fb_admins !!}"/>
	<link rel="icon" type="image/png" href="{!! asset('public/favicon.ico') !!}">
	<!-- extends css -->
	@yield('css')
	<!-- end extends css -->
	 <!-- Bootstrap -->
    <link href="{!! asset('public/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- pace style themes -->
	<link rel="stylesheet" type="text/css" href="{!! asset('public/pace/style-pace-theme.css') !!}">
	
	<!-- style chung -->
	<link rel="stylesheet" type="text/css" href="{!! asset('public/phimhay/css/style-chung.css') !!}">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="{!! asset('public/jquery/jquery-1.5.2.min.js') !!}"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
    <script src="{!! asset('public/jquery/jquery-1.12.4.min.js') !!}"></script>
    <!-- extends js -->
    @yield('js')
    <!-- end extends js -->
    <!-- analytics -->
    <script>
  		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  		ga('create', '{!! env('ANALYTICS_CLIENT_ID') !!}', 'auto');
  		ga('send', 'pageview');

	</script>
</head>
<body>
	<!-- add background: snow rơi, ... -->
	<div class="background-action">
		<!-- <div class="background-snow"></div> -->
	</div>
	<!-- /.background-action -->
	<!-- fb app id -->
	@include('phimhay.include.facebook-api')
	<!-- end fb app id -->
	<div id="wapper">
		<!-- pace -->
		@include('phimhay.include.pace')
		<!-- end pace -->
		<!-- header -->
		<div class="header">
			@include('phimhay.include.header')
		</div>
		<!-- end header -->
		<!-- content -->
		<div class="content container">
			@yield('slider')
			@yield('film-dir')
			<div class="col-sm-9">
				@yield('content')
			</div> <!-- /.col-sm-9 -->
			<!-- top film -->
			<div class="col-sm-3">
				@include('phimhay.include.facebook-page')
				@include('phimhay.include.film-hot', $film_hots)
			</div> <!-- /.col-sm-3 -->
			
			
		</div>
		<!-- end content -->
		<div class="footer">
			@include('phimhay.include.footer')
		</div>
		
	</div>
	@include('phimhay.include.modal-logout')
	<!-- pace js -->
	<script src="{!! asset('public/pace/pace-v1.0.2.min.js') !!}"></script>
	
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{!! asset('public/bootstrap/js/bootstrap.min.js') !!}"></script>
    
</body>
</html>