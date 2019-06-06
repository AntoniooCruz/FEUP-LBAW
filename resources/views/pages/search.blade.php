@extends('layouts.app')

@section('custom-scripts')
<link href="{{ asset('css/search-result.css') }}" rel="stylesheet">
<script type="text/javascript" src={{ asset('js/date.js') }} defer></script>
<script type="text/javascript" src={{ asset('js/search.js') }} defer></script>
@endsection

@section('content')
<section class="search container">
    <form action="{{URL::to('/search')}}" method="GET" role="search" class=" row searchBar-nb justify-content-center mt-5">
    {{csrf_field()}}  
    <input id="fieldText" class="form-control" type="search" placeholder="Search..." value= {{$search}} name="search">
      <button id="fieldSubmit" class="btn form-control" type="submit"><i class="fas fa-search"></i></button>
    </form>

    <div class="row filters justify-content-center align-items-center">
      <nav class="navbar navbar-expand-lg navbar-light col-auto pr-0 justify-content-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#filters"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span id="filterby">Filter by</span>
        </button>

        <div class="collapse navbar-collapse " id="filters">
          <ul class="navbar-nav mr-auto">
            <li class="dropdown col-auto align-self-center">
              <button class="dropdown-toggle" type="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" id="price">
                Price
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="Free" id="checkFree" checked>
                  <label class="form-check-label" for="checkFree">
                    Free
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="Paid" id="checkPaid" checked>
                  <label class="form-check-label" for="checkPaid">
                    Paid
                  </label>
                </div>
              </div>
            </li>
            <li class="dropdown col-auto align-self-center">
              <button class="dropdown-toggle" type="button" id="dropdownCategories" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Categories
              </button>
              
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="categories">
              @foreach ($categories as $category)
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="{{$category->name}}" id="defaultCheck1" checked >
                  <label class="form-check-label" for="defaultCheck1">
                  {{$category->name}}
                  </label>
              </div>
              @endforeach
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="col-auto pl-0">
        <select id="sortDate" class="roundRadius form-control form-control-sm">
          <option value="" selected disabled>Sort by</option>
          <option value="date-up">Recent</option>
          <option value="date-down">Older</option>
          <option value="price-down">Price Down</option>
          <option value="price-up">Price Up</option>
          <option value="attendees-up">Most Popular</option>
          <option value="attendees-down">Least Popular</option>
        </select>
      </div>
    </div>
    <div id="results_container" class="text-center mt-5">
      <div class="row justify-content-center">
      @foreach ($events as $event)
      @include('partials.search-card', ['event'=>$event, 'categories'=>$categories])
      @endforeach
      
      </div>
    </div>
@endsection