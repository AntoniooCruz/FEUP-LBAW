@extends('layouts.app')

@section('content')

@yield('navbar')

<link href="{{ asset('css/faqs.css') }}" rel="stylesheet">
<section id="faqs">
    <div class="container">
      <nav class="navbar sortNav">
        <span class="navbar-text">
          <h4>FREQUENTLY ASKED QUESTIONS</h4>
        </span>
        <hr>

      </nav>
      <div id="accordion">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <span class="collapsed text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">
                <i class="fas fa-sort-down"></i> Are business accounts paid?
            </span>
            </h5>
          </div>

          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <p>
              No, all our services are completely free, and do not require any type of card information.

              The only time money is involved is when purchasing tickets and that is done through your PayPal account.
              </p>
              
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <span class="collapsed text-left" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                aria-controls="collapseTwo">
                <i class="fas fa-sort-down"></i> What are the differences between a personal and a business account?
            </span>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
              Our business accouts aim to represent companies and this has several implications. A business account cannnot create a private events, can be verified, and can have an URL for their official website.
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <span class="collapsed text-left" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                aria-controls="collapseThree">
                <i class="fas fa-sort-down"></i> What happens when I report something?
            </span>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              If you report a user, an event, or a comment, and administrator will look at the information and decide if that content should be left or removed.
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
