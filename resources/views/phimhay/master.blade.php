<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta http-equiv="X-UA-Compatible" username="IE=edge">
	<meta content="width=device-width,initial-scale=1" name="viewport">
	<title>@yield('title')</title>
	<base href="http://localhost/phimhaynew" />
	<meta name="description" content="@yield('description')">
	<meta property="fb:app_id" content="{!! env('FB_APP_ID') !!}" />
	<meta property="fb:admins" content="{!! env('FB_ADMINS') !!}"/>
	<meta property="fb:pages" content="209494239231892" />
	<link rel="icon" type="image/png" href="{!! asset('public/favicon.ico') !!}">

	<meta property="og:title" content="@yield('title')">
    <meta property="og:image" content="">
    <meta property="og:description" content="@yield('description')">
    <meta property="article:author" content="NPT">
    <meta property="og:url" content="@yield('url')">
    {{-- <meta property="og:type" content="article"> --}}
    {{-- using website for page categories --}}
    {{-- <meta property="og:type" content="website"> --}}
    <meta property="og:type" content="video.movie" />
    <meta property="og:site_name" content="PhimHay">
	<meta property="og:updated_time" content="1498357443" />
	<meta property="article:publisher" content="https://www.facebook.com/scotchdevelopment">
    <link rel="publisher" href="https://plus.google.com/b/113854128330570384219">
    <link rel="author" href="https://plus.google.com/b/113854128330570384219">
    
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
	<!-- extends css -->
	@yield('css')
	<!-- end extends css -->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
    <script src="{!! asset('public/jquery/jquery-1.12.4.min.js') !!}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{!! asset('public/bootstrap/js/bootstrap.min.js') !!}"></script>
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
			@include('phimhay.include.header', $film_country)
		</div>
		<!-- end header -->
		<!-- content -->
		<div class="content container">
			@yield('slider')
			@yield('film-dir')
			{{-- <div class="col-sm-9"> --}}
			<div class="col-xs-12 col-sm-8 col-md-9">
				@yield('content')
			</div> <!-- /.col-sm-9 -->
			<!-- top film -->
			<div class="col-xs-12 col-sm-4 col-md-3">
			{{-- <div class="col-sm-3"> --}}
				{{-- @include('phimhay.include.facebook-page') --}}
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
	
    
    
</body>
</html>