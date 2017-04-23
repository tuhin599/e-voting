@extends('layouts.master')

@section('title')
    User Dashboard
@endsection

@section('middle-content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissable">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::has('message'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <strong>{{session('message')}}</strong>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @if($user->user_type=='anonymous')
            <div class="row">
                <div class="col-md-12">
                    @if($user->alreadySendRequest())
                        @if($user->requestAccepted())

                        @elseif($user->requestRejected())
                            <h3 class="text-danger">Your request is being rejected ! Please check your information. Then
                                request again.</h3>
                            <div>
                                <a href="{{route('voter.request.interface')}}" class="btn btn-primary">Send again</a>
                            </div>
                        @else
                            <h3 class="text-primary">Request is under review. Please wait for approval.</h3>
                        @endif
                    @else

                        <h3 class="text-danger">Without being a voter you can not vote your candidate. So request to
                            be
                            a valid voter.</h3>
                        <div>
                            <a href="{{route('voter.request.interface')}}" class="btn btn-primary">Send Request</a>
                        </div>
                    @endif

                </div>
            </div>
        @elseif($user->user_type=='voter')
            @foreach($user->electionsOf() as $election)

                @if($election->status=='1')
                    @if($user->alreadyVoteElec($election))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <strong>Congrats! You have successfully complete your vote.</strong>
                                </div>
                            </div>
                        </div>
                    @endif
                    @foreach($election->candidates as $can)
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <a @if($user->alreadyVoteElec($election)) style="cursor: not-allowed"
                                       @endif @if(!$user->alreadyVoteElec($election)) href="{{route('vote.candidate',['id'=>$can->id,'election'=>$election->id])}}" @endif>
                                        <img class="img-responsive avatar-view"
                                             src="{{url(asset('candidate/'.$can->mark))}}"
                                             alt="Avatar"></a>
                                </div>
                            </div>
                            <h3>{{$can->first_name.' '.$can->last_name}}</h3>

                            <ul class="list-unstyled user_data">
                                <li><i class="fa fa-map-marker user-profile-icon"></i> {{$can->region}}
                                </li>
                            </ul>
                        </div>
                    @endforeach
                @elseif($election->status=='2')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Voting Result</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    Election Name:
                                    <button class="btn btn-success btn-xs">{{$election->election_name}}</button>

                                    <!-- start project list -->
                                    <table class="table table-striped projects">
                                        <thead>
                                        <tr>
                                            <th style="width: 1%">#</th>
                                            <th style="width: 20%">Candidate</th>
                                            <th>Mark</th>
                                            <th>Gain Votes</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($election->candidates as $candidate)

                                            <tr>
                                                <td>#</td>
                                                <td>
                                                    <a>{{$candidate->first_name." ".$candidate->last_name}}</a>
                                                    <br/>
                                                    <small>{{$candidate->region}}</small>
                                                </td>
                                                <td>
                                                    <ul class="list-inline">
                                                        <li>
                                                            <img src="{{url(asset('candidate/'.$candidate->mark))}}"
                                                                 class="avatar" alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td><span style="color:red">{{$candidate->gain_votes}}</span></td>
                                                <td>
                                                    @if(is_numeric($candidate->election->winner))
                                                        @if($candidate->election->winner==$candidate->id)
                                                            <button type="button" class="btn btn-success btn-xs">Winner
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-danger btn-xs">Failure
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button type="button" class="btn btn-danger btn-xs">Tie
                                                        </button>
                                                    @endif

                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                    <!-- end project list -->

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            {{--@foreach($user->candidate() as $candidate)--}}
            {{--@if($candidate->election)--}}
            {{--@if($candidate->election->status=='1')--}}
            {{--<div class="col-md-3 col-sm-3 col-xs-12 profile_left">--}}
            {{--<div class="profile_img">--}}
            {{--<div id="crop-avatar">--}}
            {{--<!-- Current avatar -->--}}
            {{--<a href="{{route('vote.candidate',['id'=>$candidate->id])}}">--}}
            {{--<img class="img-responsive avatar-view"--}}
            {{--src="{{url(asset('candidate/'.$candidate->mark))}}"--}}
            {{--alt="Avatar" title="Change the avatar"></a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<h3>{{$candidate->first_name.' '.$candidate->last_name}}</h3>--}}

            {{--<ul class="list-unstyled user_data">--}}
            {{--<li><i class="fa fa-map-marker user-profile-icon"></i> {{$candidate->region}}--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--@elseif($candidate->election->status=='2')--}}

            {{--@endif--}}
            {{--@endif--}}


            {{--@endforeach--}}
        @elseif($user->user_type=='admin')
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Election List</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Elections</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $i = 1?>
                                @foreach($elections as $election)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$election->election_name}}</td>
                                        <td>
                                            @if($election->status=='0')
                                                <a href="{{route('start.election',['id'=>$election->id])}}"
                                                   class="btn btn-info">Start</a>
                                            @elseif($election->status=='1')
                                                <a href="{{route('stop.election',['id'=>$election->id])}}"
                                                   class="btn btn-info">Stop</a>
                                            @elseif($election->status=='2')
                                                <button class="btn btn-warning" disabled>Finished</button>
                                                <b>Winner:</b> <span style="color: red;">
                                                    @if($election->winner($election))
                                                    {{$election->winner($election)->first_name." ".$election->winner($election)->last_name}}
                                                    ({{$election->winner($election)->region}})</span>
                                                <span>with {{$election->winner($election)->gain_votes}} Votes</span>
                                                @else
                                               <span> Tie</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $i++?>
                                @endforeach
                                @if($elections->isEmpty())
                                    <p>There is no election added yet.</p>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Start Election</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>
                            <form data-parsley-validate class="form-horizontal form-label-left" method="post"
                                  action="{{route('create.election')}}">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Election
                                        Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="elction-name" name="name" required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Region <span
                                                class="required">*</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id="region" name="region" class="select2_single form-control">
                                            @foreach($regions as $region)
                                                <option value="{{$region->region}}">{{$region->region}}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Candidates <span
                                                class="required">*</span></label>
                                    <div id="selctionCandidate" class="col-md-9 col-sm-9 col-xs-12">

                                    </div>
                                </div>
                                {{csrf_field()}}
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Start an new election</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>


            </div>
        @endif

    </div>
    <!-- /page content -->
@endsection
@section('extra-script')
    <!-- bootstrap-daterangepicker -->
    <script>
        $(document).ready(function () {

            $(".select2_single").select2({
                placeholder: "Select Region",
                allowClear: true
            });
        });
    </script>
    <!-- /bootstrap-daterangepicker -->
    <script>
        $(document).ready(function () {
            $('#region').change(function (e) {
                var val = $(this).val();
                $.ajax({
                    method: 'get',
                    url: '{{route('get.selected.candidate')}}',
                    data: {region: val},
                    success: function (msg) {
                        $('#selctionCandidate').html(msg);
                        $(".select2_multiple").select2({
                            maximumSelectionLength: 4,
                            placeholder: "With Max Selection limit 4",
                            allowClear: true
                        });
                    }
                });
            });
        });
    </script>
@endsection