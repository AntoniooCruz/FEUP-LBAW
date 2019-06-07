@extends('layouts.app')

@section('custom-scripts')
<link href="{{ asset('css/search-result.css') }}" rel="stylesheet">
<script src={{ asset('js/date.js') }} defer></script>
<script src={{ asset('js/search.js') }} defer></script>
@endsection

@section('content')
<section class="search container">
    <form action="{{URL::to('/search')}}" method="GET" role="search" class=" row searchBar-nb justify-content-center mt-5">
    {{csrf_field()}}  
    <input id="fieldText" class="form-control" type="search" placeholder="Search..." value= "{{$search}}" name="search">
      <button id="fieldSubmit" class="btn form-control" type="submit"><i class="fas fa-search"></i></button>
    </form>

    <div class="row filters justify-content-center align-items-center">
      <nav class="navbar navbar-expand-lg navbar-light col-auto pr-0 justify-content-center">

        <div class="" id="filters">
          <ul class="navbar-nav mr-auto">
            
            <li class="dropdown col-auto align-self-center">
              <button class="dropdown-toggle filter" type="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" id="price">
                <i class="fas fa-euro-sign mr-2"></i> Price
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
            
            <li>
                <div class="col-auto">
                    <select id="sortDate" class="roundRadius form-control form-control-sm filter">
                      <option value="" selected disabled>Sort by</option>
                      <option value="date-up">Recent</option>
                      <option value="date-down">Older</option>
                      <option value="price-down">Price Down</option>
                      <option value="price-up">Price Up</option>
                    </select>
                  </div>
            </li>

            <li class="dropdown col-auto align-self-center">
                <button class="dropdown-toggle filter" type="button" id="dropdownCategories" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false ">
                  <i class="fas fa-tag mr-2"></i> Categories
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

      
    </div>
    <div id="results_container" class="text-center container mt-5">
        <div class="row">
          
            @for ($i = 0; $i < sizeof($events); $i++)
            <div class="col-auto p-0 sm-12 col-md-6 col-lg-4 mb-2">

                  @include('partials.search-card', ['event'=>$events[$i], 'categories'=>$categories,'usersGoing'=>$usersGoing[$i]])
                </div>

            @endfor
          </div>
      <div class="row justify-content-center">
      
      </div>
    </div>
    @if(Auth::check())
  @include('layouts.create-event', ['categories'=>$categories])
@endif
@endsection