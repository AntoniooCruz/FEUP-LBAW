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
                <i class="fas fa-sort-down"></i> Anim pariatur cliche reprehenderit?
            </span>
            </h5>
          </div>

          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
              squid.
              3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
              laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
              coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
              anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
              occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
              heard
              of them accusamus labore sustainable VHS.
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <span class="collapsed text-left" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                aria-controls="collapseTwo">
                <i class="fas fa-sort-down"></i> Anim pariatur cliche reprehenderit?
            </span>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
              squid.
              3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
              laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
              coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
              anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
              occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
              heard
              of them accusamus labore sustainable VHS.
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <span class="collapsed text-left" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                aria-controls="collapseThree">
                <i class="fas fa-sort-down"></i> Anim pariatur cliche reprehenderit?
            </span>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
              squid.
              3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
              laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
              coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
              anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
              occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
              heard
              of them accusamus labore sustainable VHS.
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
