@extends('layouts.master')

@section('title')
    Add Candidate
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
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Edit Candidate</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form   data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{route('edit.profile')}}">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{$user->name}}" type="text"required="required" name="name" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{$user->email}}" type="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">National ID Number</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{$user->national_id}}"  class="form-control col-md-7 col-xs-12" type="text" name="national_id">
                                        <input type="hidden" value="{{$user->id}}" name="id">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="{{str_replace('-','/',$user->date_of_birth)}}" class="form-control col-md-7 col-xs-12" type="text" name="date_of_birth" id="birthday">

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
                                {{csrf_field()}}
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">Cancel</button>
                                        <button type="submit" class="btn btn-success" @if($user->user_type=='voter') disabled @endif>Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
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