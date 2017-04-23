<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Online Voting System! | </title>

    <!-- Bootstrap -->
    <link href="{{asset("css/bootstrap.css")}}" rel="stylesheet">
    <link href="{{url(asset("css/green.css"))}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset("css/font-awesome.min.css")}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset("css/nprogress.css")}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{asset('css/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet">
    <link href="{{asset("css/jquery.mCustomScrollbar.min.css")}}" rel="stylesheet"/>
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
    <link href="{{url(asset('css/font-awesome.min.css'))}}" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{route('index')}}" class="site_title"><i class="fa fa-paw"></i> <span>Online Voting System!</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="{{url(asset($user->profile_pic))}}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{$user->name}}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>{{$user->user_type}}</h3>
                        <ul class="nav side-menu">
                            <li><a href="{{route('index')}}"><i class="fa fa-home"></i>Dashboard</a>

                            </li>
                            @if($user->user_type=='admin')
                            <li><a href="{{route('add.region.interface')}}"><i class="fa fa-random"></i>Add Region</a>
                            <li><a><i class="fa fa-edit"></i> Candidate <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('add.candidate')}}">Add Candidate</a></li>
                                    <li><a href="{{route('list.candidate')}}">Candidate list</a></li>
                                    <li><a href="{{route('candidate.profile.all')}}">Candidate profile</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-edit"></i> Voters <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('request.voter.list')}}">Voter Request</a></li>
                                    <li><a href="{{route('list.voter')}}">Voter list</a></li>
                                </ul>
                            </li>
                            @endif
                            <li><a><i class="fa fa-gear"></i> Settings<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('change.profile')}}">Change Profile Picture</a></li>
                                    <li><a href="{{route('edit.profile')}}">Edit Profile</a></li>
                                    <li><a href="{{route('reset.password')}}">Reset Password</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a href="{{route('user.logout')}}" data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{url(asset($user->profile_pic))}}" alt="">{{$user->name}}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="{{route('user.logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>


                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
@yield('middle-content')


        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Online Voting System by <strong>Tuhin Hossain</strong>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="{{url(asset('js/jquery.min.js'))}}"></script>
<script src="{{url(asset('js/bootstrap.min.js'))}}"></script>
<script src="{{url(asset('js/icheck.min.js'))}}"></script>
<script src="{{url(asset("js/moment.js"))}}"></script>
<script src="{{url(asset('js/daterangepicker.js'))}}"></script>
<!-- NProgress -->
<script src="{{asset("js/nprogress.js")}}"></script>
<!-- jQuery custom content scroller -->
<script src="{{asset("js/jquery.mCustomScrollbar.concat.min.js")}}"></script>

{{--datatable--}}
<script src="{{asset("js/jquery.dataTables.min.js")}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{asset("js/custom.min.js")}}"></script>
<script src="{{url(asset('js/select2.full.min.js'))}}"></script>
@yield('extra-script')
</body>
</html>
