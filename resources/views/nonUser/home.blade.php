<link href="{{url(asset('css/font-awesome.min.css'))}}" rel="stylesheet">
<link href="{{url(asset('css/style.css'))}}" rel="stylesheet">
<link href="{{url(asset('css/bootstrap.css'))}}" rel="stylesheet">

<body>
<div class="row">
    @if(Session::has('error'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <strong>{{session('error')}}</strong>
                </div>
            </div>
        </div>
    @endif
    @if(Session::has('message'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <strong>{{session('message')}}</strong>
                </div>
            </div>
        </div>
    @endif
</div>
<div class="row">
    <div class="col-md-8"><h1 style="color: darkcyan;">Online Voting System</h1></div>
    <div class="col-md-4">
        <ul id="login-dp" class="">

            <li>
                <div class="row">
                    <div class="col-md-12">
                       <h1>Login</h1>
                        <form class="form" role="form" method="get" action="login" accept-charset="UTF-8" id="login-nav">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                <input name="email" type="email" class="form-control" placeholder="Email address" required>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                <input name="password" type="password" class="form-control"  placeholder="Password" required>
                                {{--<div class="help-block text-right"><a href="">Forget the password ?</a></div>--}}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                            </div>
                        </form>
                    </div>
                    <div class="bottom text-center">
                        Don't have account ? <a href="{{route('user.registrationform')}}"><b>Register Now</b></a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<script src="{{url(asset('js/jquery.min.js'))}}"></script>
<script src="{{url(asset('js/bootstrap.min.js'))}}"></script>
</body>