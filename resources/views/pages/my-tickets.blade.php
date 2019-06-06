@extends('layouts.app')

@section('custom-scripts')
  <link href="{{ asset('css/mytickets.css') }}" rel="stylesheet">
@endsection

@section('content')

<nav class="navbar sortNav">
  <span class="navbar-text">
    <h4>My Tickets</h4>
  </span>
  <ul class="nav" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pills-active-tab" data-toggle="pill" href="#pills-active" role="tab"
        aria-controls="pills-active" aria-selected="true">Active events</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-past-tab" data-toggle="pill" href="#pills-past" role="tab"
        aria-controls="pills-past" aria-selected="false">Past events</a>
    </li>
  </ul>
</nav>

<div class="container-fluid mt-4 tickets" id="tickets">
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-active" role="tabpanel" aria-labelledby="pills-active-tab">
        <div class="row">
          
          @for ($i = 0; $i < sizeof($activeEvents); $i++)          
          
          <div class="col-auto  mb-3 sm-12">
            <div class="card ticket text-white">
              <div class="opacity_div"></div>
              <img class="card-img" src="../img/event.jpg" alt="Card image">
              <div class="card-img-overlay">
                <div class="header">
                  <h5 class="price">{{$activeEvents[$i]->price}}€</h5>
                  <h5 class="token">#{{$activeEventsTickets[$i]->token}}</h5>
                </div>
                <div class="eventDesc">
                    <a href="eventpage.html"><h5 class="card-title">{{$activeEvents[$i]->title}}</h5></a>
                    <hr class="ticketHr">
                  <p class="card-text">{{$activeEvents[$i]->city}}</p>
                <p class="card-text">{{$user->username}}</p>
                </div>
              </div>
            </div>
          </div>

          @endfor
          
        </div>
      </div>
      <div class="tab-pane fade" id="pills-past" role="tabpanel" aria-labelledby="pills-past-tab">
        <div class="row">

            @for ($i = 0; $i < sizeof($pastEvents); $i++)

          <div class="col-auto  mb-3 sm-12">
            <div class="card ticket past-ticket text-white">
              <div class="opacity_div"></div>
              <img class="card-img" src="../img/event.jpg" alt="Card image">
              <div class="card-img-overlay">
                <div class="header">
                    <h5 class="price">{{$pastEvents[$i]->price}}€</h5>
                    <h5 class="token">#{{$pastEventsTickets[$i]->token}}</h5>
                </div>
                <div class="eventDesc">
                    <a href="eventpage.html"><h5 class="card-title">{{$activeEvents[$i]->title}}</h5></a>
                    <hr class="ticketHr">
                  <p class="card-text">{{$pastEvents[$i]->city}}</p>
                  <p class="card-text">{{$user->username}}</p>
                </div>
              </div>
            </div>
          </div>

          @endfor

        </div>
      </div>
    </div>
    


@include('layouts.create-event', ['categories'=>$categories])

@endsection