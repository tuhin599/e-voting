<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="{{url(asset('css/style.css'))}}" rel="stylesheet">
<link href="{{url(asset('css/bootstrap.css'))}}" rel="stylesheet">
<link href="{{asset('css/daterangepicker.css')}}" rel="stylesheet">
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
<body>
<div class="row">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        @if(Session::has('error'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <strong>{{session('error')}}</strong>
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
                        <h1>Registration</h1>
                        <form class="form" role="form" method="post" action="{{route('user.registration')}}" accept-charset="UTF-8" id="login-nav">
                            <div class="form-group">
                                <label class="sr-only">Name:</label>
                                <input name="name" type="text" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Email address</label>
                                <input name="email" type="email" class="form-control" placeholder="Email address" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="gender" class="btn-group" data-toggle="buttons">
                                        <p>
                                            Male:
                                            <input type="radio" class="flat" name="gender" id="genderM" value="male" checked="" required />
                                            Female:
                                            <input type="radio" class="flat" name="gender" id="genderF" value="female" />
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="national_id">National ID</label>
                                <input name="national_id" type="number" class="form-control"  placeholder="National Id Number" required>
                            </div>
                            <div class="form-group">
                                    <select name="region" class="select2_single form-control" tabindex="-1">
                                        <option></option>
                                        @foreach($regions as $region)
                                            <option value="{{$region->region}}">{{$region->region}}</option>
                                        @endforeach
                                    </select>

                            </div>
                            Date of Birth:
                            <div class="form-group">
                                <label class="sr-only" for="birthday">Date of Birth</label>
                                <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" name="date_of_birth" type="text">
                            </div>
                            </br>
                            </br>
                            <div class="form-group">
                                <label class="sr-only">Password</label>
                                <input name="password" type="password" class="form-control"  placeholder="Password" required>
                            </div>


                            <div class="form-group">
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-primary btn-block">Registration</button>
                            </div>
                        </form>
                    </div>
                    <div class="bottom text-center">
                        Already have account ? <a href="{{route('index')}}"><b>Sign in</b></a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<script src="{{url(asset('js/jquery.min.js'))}}"></script>
<script src="{{url(asset('js/bootstrap.min.js'))}}"></script>
<script src="{{url(asset('js/icheck.min.js'))}}"></script>
<script src="{{url(asset("js/moment.js"))}}"></script>
<script src="{{url(asset('js/daterangepicker.js'))}}"></script>
<script src="{{url(asset('js/select2.full.min.js'))}}"></script>
<script>
    $(document).ready(function() {
        $(".select2_single").select2({
            placeholder: "Select a region",
            allowClear: true
        });
        $('#birthday').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            locale: {
                format: 'YYYY/MM/DD'
            }
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    });
</script>
</body>