@extends('layouts.app')

@section('custom-scripts')
<script type="text/javascript" src={{ asset('js/follow.js') }} defer></script>
<script type="text/javascript" src={{ asset('js/date.js') }} defer></script>
<script type="text/javascript" src={{ asset('js/profile.js') }} defer></script>
  <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection


@section('content')
@if(!$user->active)
<div class="alert alert-danger" role="alert">This user has been banned!</div>
@endif
<section id="profile">
  <span id="id_user" style="display:none;">{{$user->id_user}}</span>

    <div class="parContainer row justify-content-center">
        <div id="profile_container" class="col-lg-3 col-12 container text-center">
          <img src="../img/jane.jpg">
          <div id="profile_content">
            @if($user->user_type != 'Admin')
              <i  d="reportUser" type="button" data-toggle="modal" data-target="#reportEventModal" class="fab fa-font-awesome-flag"></i>
            @endif
            <div id="header"></div>
            <div id="name" class="row justify-content-left">
              <div class="col text-left">
              <div class="row"><span>{{$user->name}}</span>
                @if($user->business!=null)
                @if($user->business->verification == 'Approved')
                  <i class="far fa-check-circle"></i>
                @endif
                @endif
                </div>
                <div class="row"><span id="username">@<span>{{$user->username}}</span></div>
              </div>
              <div class="col-3 col text-right">
                <button id="follow_button" type="button" class="profile-pri-button btn btn-primary">{{$isFollowing? 'Unfollow': 'Follow'}}</button>
              </div>
            </div>
            <hr>
            <div class="stats row justify-content-center">
              <div id="followers" class="col text-center">
                <div></div><strong> {{$user->followers()->count()}} </strong>
                <small>Followers</small>
              </div>
              @if($user->user_type=='Personal')
              <div id="following" class="col text-center">
                <strong> {{$user->following()->count()}} </strong>
                <small>Following</small>
              </div>
              @endif
              <div id="events" class="col text-center">
                <strong> {{sizeof($eventsOwned)}}</strong>
                <small>Events</small>
              </div>
    
            </div>
            <hr>
            <p id="description" class="row text-left">{{$user->description}} </p>
          </div>
          @if($user->user_type == 'Admin')
          <div class="row"><button id="bann-button" class=" btn btn-danger">Ban user</button></div>
          @endif
        </div>
    
        <div id="events_container" class="col-lg-6 col-12 container text-left">
          <ul class="nav" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-active-tab" data-toggle="pill" href="#userevents" role="tab"
                aria-controls="pills-active" aria-selected="true">{{$user->name}}'s events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-past-tab" data-toggle="pill" href="#attendingevents" role="tab" aria-controls="pills-past"
                aria-selected="false">Events attending</a>
            </li>
          </ul>
          
          <div class="tab-content" id="pills-tabContent">
            <div id="userevents" class="row justify-content-start tab-pane fade show active">
              @each ('partials.card', $eventsOwned, 'event')
            </div>
            <div id="attendingevents"  class="row justify-content-start tab-pane fade">
                @each('partials.card', $eventsAttending, 'event')
            </div>
          </div>
        </div>
      </div>
      </div>

    
    </section> 

@if(Auth::check())
  @include('layouts.create-event', ['categories'=>$categories])
@endif

<div class="modal fade" id="reportEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report {{$user->name}}</h5>
      </div>
      <div class="modal-body">
        <p>Help us undertand what's happening?</p>
        <textarea></textarea required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
        <button id="submitReportBtn" type="submit" class="btn btn-danger">Report</button>
      </div>
      <form>
    </div>
  </div>
</div>

@endsection