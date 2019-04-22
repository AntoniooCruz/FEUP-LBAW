@extends('layouts.app')

@section('content')

@yield('navbar')


<section class="container">
    <div class="row">
        <div class="col text-center">
            <div id="logo"><img src="../img/logo.png"></div>
        </div>
    </div>
    <hr>
    <div id="titles" class="row">
        <div class="col-md-6  px-4">
            <h4>ABOUT US</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod tempor incididunt ut labore et
                dolore magna aliqua</p>
        </div>
        <div id="contacts" class="col-md-6  px-4">
            <h4>CONTACT US</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod tempor incididunt ut labore et
                dolore magna aliqua</p>
        </div>
    </div>
</section>

    @endsection
