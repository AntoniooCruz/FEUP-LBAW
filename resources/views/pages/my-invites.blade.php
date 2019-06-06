@extends('layouts.app')

@section('custom-scripts')
<link href="{{ asset('css/myinvites.css') }}" rel="stylesheet">
<script type="text/javascript" src={{ asset('js/date.js') }} defer></script>

@endsection





@section('content')

<nav class="navbar sortNav">
    <span class="navbar-text">
      <h4>My Invites</h4>
    </span>
  </nav>
<div class="container mt-4 tickets" id="invites">
    <div class="row">

  @for ($i = 0; $i < sizeof($invites); $i++)
        @include ('partials.invite', ['event'=>$invites[$i]->event()->first(), 'usersGoing'=>sizeof($usersGoing[$i])])
  @endfor
</div>

</div>

@include('layouts.create-event', ['categories'=>$categories])

@endsection