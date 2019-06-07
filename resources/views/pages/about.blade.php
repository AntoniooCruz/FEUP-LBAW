@extends('layouts.app')

@section('content')

@yield('navbar')

<link href="{{ asset('css/about.css') }}" rel="stylesheet">

<section class="container">
    <div class="row">
        <div class="col text-center">
            <div id="logo"><img src="../img/logo.png" alt="Logo"></div>
        </div>
    </div>
    <hr>
    <div id="titles" class="row">
        <div class="col-md-6  px-4">
            <h4>ABOUT US</h4>
            <p> RainCheck’s purpose is to help both businesses and individuals create, manage and share their events.</P>
            <p>This will allow companies to increase their client reach through an event management web application.</P>
            
        </div>
        <div id="contacts" class="col-md-6  px-4">
            <h4>CONTACT US</h4>
            <p>+351 917 633 662</p>
            <p>+351 22 508 1400 </p>
            <p>R. Dr. Roberto Frias, 4200-465 Porto, Portugal</p>
        </div>
    </div>
</section>

@if(Auth::check())
  @include('layouts.create-event', ['categories'=>$categories])
@endif

@endsection
