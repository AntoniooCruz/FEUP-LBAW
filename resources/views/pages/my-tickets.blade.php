@extends('layouts.app')

@section('custom-scripts')
  <link href="{{ asset('css/mytickets.css') }}" rel="stylesheet">
  <script src={{ asset('js/date.js') }} defer></script>
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
              @include ('partials.ticket', ['event'=>$activeEvents[$i], 'ticket'=> $activeEventsTickets[$i] ])
          @endfor
          

        </div>
      </div>
      <div class="tab-pane fade" id="pills-past" role="tabpanel" aria-labelledby="pills-past-tab">
        <div class="row">

            @for ($i = 0; $i < sizeof($pastEvents); $i++)
              @include ('partials.ticket', ['event'=>$pastEvents[$i], 'ticket'=> $pastEventsTickets[$i] ])
          @endfor

        </div>
      </div>
    </div>
    


@include('layouts.create-event', ['categories'=>$categories])

@endsection