@extends('layouts.app')

@section('custom-scripts')
  <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')

<section id="profile">

  <span id="id_user" style="display:none;">{{$user->id_user}}</span>
    <div class="parContainer row justify-content-center">
        <div id="profile_container" class="col-lg-3 col-12 container text-center">
          <img src="../img/jane.jpg">
          <div id="profile_content">
            <div id="header"></div>
            <div id="name" class="row justify-content-left">
              <div class="col text-left">
              <div class="row"><span>{{$user->name}}</span> <i class="far fa-check-circle"></i></div>
              <div class="row"><span id="username">@<span>{{$user->username}}</span></div>
              @if($user->user_type=='Business')
                <div class="row"><span id="website"><a href="{{$user->business->website}}">{{$user->business->website}}</a></div>
              @endif
            </div>
            <div class="col-3 col text-right">
              <button id="edit_button" type="button" class="profile-pri-button btn btn-primary"><a href="{{ url('/profile/edit') }}">Edit</a></button>
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
        <div class="row"><a href="mytickets.html" id="tickets-button" class=" btn btn-secondary">My tickets</a></div>
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
            @each('partials.card', $eventsOwned, 'event')
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

@endsection