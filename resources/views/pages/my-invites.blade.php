@extends('layouts.app')

@section('custom-scripts')
  <link href="{{ asset('css/myinvites.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid mt-4 tickets" id="invites">
  <div class="row">
    <div class="col-auto  mb-3 sm-12 ">
        @for ($i = 0; $i < sizeof($eventsInvited); $i++)

      <div class="container-fluid actionCard">
        <div class="card card-invited-event">
          <div class="description header">
            <a href="userprofile.html"><img class="userAction roundRadius" src="../img/jane.jpg"
                alt="Card image cap"></a>
            <div class="headerText">
            <span class="card-title"><a href="userprofile.html" class="link-username">{{$inviters[$i]->username}}</a> invited you to
                this event</span>
              <!-- <span class="card-date">13 Mar 2019 • 16h33</span> -->
              <span class="card-date">{{$eventsInvited[$i]->date}}</span>

            </div>
            <i class="far fa-flag"></i>
          </div>
        </div>
        <div class="invite card">
          <a href="eventpage.html"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
          <span class="badge badge-pill badge-secondary card-category">{{$eventsInvited[$i]->category->name}}</span>
          <div class="card-body" id="event-card-body">
            <div class="row eventRow header align-items-start">
              <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
                <div id="eventPageMonth" class="eventPageMonth">
                  <span id="eventMonth" class="eventMonth">Mar</span>
                </div>
                <span id="eventPageDay" class="eventPageDay">03</span>
              </div>
              <div class="col-10 cardTitle text-left">
                <span id="event-card-title">{{$eventsInvited[$i]->title}}</span>
                <div class="event-card-footer">
                  <span id="event-card-hour">12:00</span>
                  <p class="dot-separator"> • </p>
                  <span id="card-adress">{{$eventsInvited[$i]->location}}</span>
                </div>
              </div>
            </div>
            <div id="event-card-people-attending" class="row text-left">
              <div class="col ">
                <img src="../img/jane.jpg" class="event-card-user-photo" width="25" height="25">
                <img src="../img/jane.jpg" class="event-card-user-photo" width="25" height="25">
                <img src="../img/jane.jpg" class="event-card-user-photo" width="25" height="25">
                <span id="event-card-invite"><i class="fas fa-plus-circle"></i></span>
                <span id="peopleGoing">{{sizeof($usersGoing[$i])}} going</i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endfor

  </div>

</div>



@include('layouts.create-event', ['categories'=>$categories])

@endsection