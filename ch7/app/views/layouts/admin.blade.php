<!DOCTYPE html>
<html lang="en">
 <head>
        <meta charset="utf-8">
        <title>{{ $title }}</title>

    {{ HTML::style('css/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap/css/bootstrap-responsive.min.css') }}

    {{ HTML::style('admin/css/datepicker.css') }}
    {{ HTML::style('admin/css/timepicker.css') }}

    {{ HTML::style('admin/css/style.css') }}

    {{ HTML::script('css/bootstrap/js/jquery-1.9.1.min.js') }}
    {{ HTML::script('css/bootstrap/js/bootstrap.min.js') }}

</head>
<body class="body">

<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </a>
            <a href="#" class="brand">The Foldagram</a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active_dashboard">
                    {{ link_to_route('admin', 'Home') }} </li>
                    <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Orders <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>{{ link_to('admin/index', 'Manage Orders') }}</li>
                        <li>{{ link_to('admin/csvexport', 'Export Orders') }}</li>
                    </ul>
                    </li>
                    <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Manage Price <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>{{ link_to('admin/managecredit', 'Manage Price') }}</li>
                        <li>{{ link_to('admin/addcredit', 'Add Price') }}</li>
                    </ul>
                    </li>
                    <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">User Management <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>{{ link_to('users', 'Manage User') }}</li>
                            <li>{{ link_to('users/adduser', 'Add User') }}</li>
                            <li>{{ link_to('admin/usercredit', 'Give User Credit') }}</li>
                            <li>{{ link_to('users/creditorder', 'User purchase Credit Order') }}</li>
                        </ul>
                    </li>
                </ul>
                <!-- End Master Report -->
                <ul class="nav pull-right">
                     @if(Sentry::check()) <?php $current_user = Sentry::getUser(); ?>
                     @endif
                    <li><a href="#">Howdy, &nbsp; {{ $current_user->email }}</a></li>
                    <li class="divider-vertical"></li>
                    <li class="dropdown">
                    <li>{{ link_to('admin/logout', 'Logout') }}</li>
                </ul>
            </div>
            <!-- /.nav-collapse -->
        </div>
    </div>
    <!-- /navbar-inner -->
</div>




    <div class="clear-fix"> &nbsp; </div>

    @yield('subnavigation')



    <div class="container-fluid sr-container">
        <div class="row-fluid ">

            @if (Session::has('success') )
                <div class="span6 alert alert-success">
                {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('error') )
                <div class="span6 alert alert-error">
                {{ Session::get('error') }}
                </div>
            @endif

            @if ($errors->any())
            <div class="span6 alert alert-error">
                <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
            </div>
            @endif

            <div class="span12">
                <div class="content-container">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
    $(document).ready(function(){
        $(".active_admin").addClass('active');
    });
</script>

</body>
</html>