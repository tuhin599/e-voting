@extends('layouts.master')

@section('middle-content')
    <div class="col-md-8 col-md-offset-3" style="min-height: 500px">
        @foreach($candidate as $candidate)
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                <div class="profile_img">
                    <div id="crop-avatar">
                        <!-- Current avatar -->
                        <img class="img-responsive avatar-view" src="{{url(asset('candidate/'.$candidate->mark))}}"
                             alt="Avatar" title="Change the avatar">
                    </div>
                </div>
                <h3>{{$candidate->first_name.' '.$candidate->last_name}}</h3>

                <ul class="list-unstyled user_data">
                    <li><i class="fa fa-map-marker user-profile-icon"></i> {{$candidate->region}}
                    </li>
                </ul>
            </div>
        @endforeach
    </div>
@endsection