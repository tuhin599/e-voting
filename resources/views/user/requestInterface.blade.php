@extends('layouts.master')

@section('title')
    Add Voter
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
        <div class="">
            <div class="row">
                @if($user->alreadySendRequest() && !$user->requestRejected())
                    <div class="col-md-8 col-md-offset-3">
                    <h3 class="text-primary">Request is under review. Please wait for approval.</h3>
                        </div>
                    @else
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Review Details</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{route('voter.request',['id'=>$user->id])}}">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{$user->name}}" type="text" id="last-name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">National ID Number</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{$user->national_id}}" id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="national_id">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div id="gender" class="btn-group" data-toggle="buttons">
                                            <p>
                                                Male:
                                                <input type="radio" class="flat" name="gender" id="genderM" value="male" @if($user->gender=='male')checked=""@endif required />
                                                Female:
                                                <input type="radio" class="flat" name="gender" id="genderF"@if($user->gender=='female')checked=""@endif value="female" />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{str_replace('-','/',$user->date_of_birth)}}" id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" name="date_of_birth" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Region</label>
                                    <div class="col-md-6 col-sm-6 col-xs-10">
                                        <select name="region" class="select2_single form-control" tabindex="-1">
                                            <option></option>
                                            @foreach($regions as $region)
                                                <option value="{{$region->region}}">{{$region->region}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <img src="{{$user->profile_pic}}" alt="" style="height: 100px;width: 100px;">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{$user->id}}">
                                {{csrf_field()}}

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Send Request</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                    @endif
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
@section('extra-script')
    <!-- bootstrap-daterangepicker -->
    <script>
        $(document).ready(function() {
            $(".select2_single").select2({
                placeholder: "Select a region",
                allowClear: true
            }).val("{{$user->region(Auth::user())}}").trigger("change");

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
    <!-- /bootstrap-daterangepicker -->
@endsection