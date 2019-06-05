
@extends('layouts.app')

@section('content')

@yield('navbar')
  <section id="mainpage">
    
    <section class="search container">
      <div id="logo"><img class="row justify-content-md-center" src="../img/logo.png"></div>
      <form action="{{URL::to('/search')}}" method="GET" role="search" class=" row searchBar-blue justify-content-center">
      {{csrf_field()}}     
      <input class="form-control" type="search" placeholder="Search..." name="search">
        <button class="btn form-control" type="submit"><i class="fas fa-search"></i></button>
      </form>
    </section>

    <section class="carousel-container">
      <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel" data-slide-to="0" class="active"></li>
          <li data-target="#carousel" data-slide-to="1"></li>
          <li data-target="#carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="../img/event3.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="../img/event4.jpeg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="../img/event2.jpg" alt="Third slide">
          </div>
        </div>

      </div>
    </section>
    @endsection