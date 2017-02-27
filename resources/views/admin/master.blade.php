<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin PhimHay">
    <meta name="author" content="NPT">
    <title>Admin - PhimHay</title>
    <link rel="icon" type="image/png" href="{!! asset('public/favicon.ico') !!}">
    <!-- Bootstrap Core CSS -->
    <link href="{{ url('public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ url('public/admin/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('public/admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('public/admin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="{{ url('public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ url('public/admin/bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
    <!-- style custom admin interface -->
    <link href="{{ url('public/admin/css/admin_style.css') }}" rel="stylesheet">
    <!-- style chung -->
    <link rel="stylesheet" type="text/css" href="{!! asset('public/phimhay/css/style-chung.css') !!}">
    <!-- jQuery -->
    <script src='{!! asset('public/jquery/jquery-1.12.4.min.js') !!}'></script>
    <!-- <script src='//cdn.tinymce.com/4/tinymce.min.js'></script> -->
    <script src='{!! asset('public/tinymce/tinymce.min.js') !!}'></script>
    <script>
        
        tinymce.init({
            selector: '.enter-data-tinymce',
            theme: 'modern',
            width: '100%',
            height: 300,
            plugins: [
              'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
              'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
              'save table contextmenu directionality emoticons template paste textcolor',
               'autoresize'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
          });
    </script>
    @include('admin.include.google-analytics')
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{!! route('home') !!}">Phim Hay</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" title="{{ Auth::user()->username }}"><i class="fa fa-user fa-fw"></i>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{!! route('auth.getLogout') !!}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{!! url('admin') !!}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Films<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! route('admin.film.getList') !!}">List Film</a>
                                </li>
                                <!-- <li>
                                    <a href="{!! route('admin.film.getEdit', 0) !!}">Edit Film</a>
                                </li> -->
                                <li>
                                    <a href="{!! route('admin.film.getAdd') !!}">Add Film</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.film.getSearch') !!}">Search Film</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-star"></i> Film Person<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! route('admin.person.getList') !!}">List Person</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.person.getAdd') !!}">Add Person</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.person.getSearch') !!}">Search Person</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-tree-deciduous"></i> Film Job<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! route('admin.job.getList') !!}">List Job</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.job.getAdd') !!}">Add Job</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-globe"></i> Film Country<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! route('admin.country.index') !!}">List Country</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.country.create') !!}">Add Country</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-leaf"></i> Film Type<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! route('admin.type.index') !!}">List Type</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.type.create') !!}">Add Type</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-bell"></i> Film Report Error<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! route('admin.report-error.index') !!}">List Report Error</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! route('admin.user.getList') !!}">List User</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.user.getAdd') !!}">Add User</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.user.getSearch') !!}">Search User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-picture-o fa-fw"></i> Slider<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! route('admin.slider.getList') !!}">List Slider</a>
                                </li>
                                <li>
                                    <a href="{!! route('admin.slider.getAdd') !!}">Add Slider</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid admin-overflow-auto">
                <div class="row">
                    <!-- header -->
                    @yield('header')
                    <!-- end header -->
                    @if(Session::has('flash_message'))
                        <div class="col-lg-12">
                            <div class="alert alert-success result-message">
                                {!! Session::get('flash_message') !!}
                            </div>
                        </div>
                    @endif
                    @if(Session::has('flash_message_error'))
                        <div class="col-lg-12">
                            <div class="alert alert-danger result-message">
                                {!! Session::get('flash_message_error') !!}
                            </div>
                        </div>
                    @endif
                    <!-- content -->
                    @yield('content')
                    <!-- end content -->
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{ url('public/admin/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ url('public/admin/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ url('public/admin/dist/js/sb-admin-2.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{ url('public/admin/bower_components/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <!-- my script -->
     <script src="{{ url('public/admin/js/myscript.js') }}"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
</body>

</html>
