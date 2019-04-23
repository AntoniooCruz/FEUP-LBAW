@extends('layouts.app')

@section('content')

<section id="profile">

    <div class="parContainer row justify-content-center">
        <div id="profile_container" class="col-lg-3 col-12 container text-center">
          <img src="../img/jane.jpg">
          <div id="profile_content">
            <i class="far fa-flag"></i>
            <div id="header"></div>
            <div id="name" class="row justify-content-left">
              <div class="col text-left">
              <div class="row"><span>{{$user->name}}</span></div>
                <div class="row"><span id="username">@<span>{{$user->username}}</span></div>
              </div>
              <div class="col-3 col text-right">
                <button id="follow_button" type="button" class="profile-pri-button btn btn-primary">Follow</button>
              </div>
            </div>
            <hr>
            <div class="stats row justify-content-center">
              <div id="followers" class="col text-center">
                <div></div><strong> {{$followers}} </strong>
                <small>Followers</small>
              </div>
              <div id="following" class="col text-center">
                <strong> {{$following}} </strong>
                <small>Following</small>
              </div>
              <div id="events" class="col text-center">
                <strong> {{sizeof($eventsOwned)}}</strong>
                <small>Events</small>
              </div>
    
            </div>
            <hr>
            <p id="description" class="row text-left">{{$user->description}} </p>
          </div>

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

              @foreach ($eventsOwned as $event)
                <div class="col mt-4">
                  <div class="invite card">
                    <a href="eventpage.html"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
                    <span class="badge badge-pill badge-secondary card-category">{{$event->getCategoryName()}}</span>
                    <div class="card-body" id="event-card-body">
                      <div class="row eventRow header align-items-start">
                        <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
                          <div id="eventPageMonth" class="eventPageMonth">
                            <span id="eventMonth" class="eventMonth">Mar</span>
                          </div>
                          <span id="eventPageDay" class="eventPageDay">03</span>
                        </div>
                        <div class="col-10 cardTitle text-left">
                          <span id="event-card-title">{{$event->title}}</span>
                          <div class="event-card-footer">
                          <span id="event-card-hour">1</span>
                            <p class="dot-separator"> • </p>
                            <span id="card-adress">{{$event->location}}</span>
                          </div>
                        </div>
                      </div>
                      <div id="event-card-people-attending" class="row text-left">
                        <div class="col ">
                          <img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25">
                          <img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25">
                          <img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25">
                          <span id="event-card-invite"><i class="fas fa-plus-circle"></i></span>
                          <span id="peopleGoing">+300 going</i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
              
            </div>
            <div id="attendingevents"  class="row justify-content-start tab-pane fade">
                @each('partials.card', $eventsAttending, 'event')
            </div>
          </div>
        </div>
      </div>
      </div>
    </section> 
@endsection