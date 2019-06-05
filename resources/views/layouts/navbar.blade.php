<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="/home"> <img src="{{ asset('img/icon.png') }}" width="31,83" height="24,92"> </a>

@if(Auth::check())
  <button id="newEventBtn" type="button" class="" data-toggle="modal" data-target="#createEventModal">
    <i class="nav-link fas fa-plus-square"></i>
  </button>
  <div id="dropdown" class="dropdown nav-item">
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="{{ route('myProfile') }}">Profile</a>
      <a class="dropdown-item" href="mytickets.html">My tickets</a>
      <a class="dropdown-item" href="{{ url('/myInvites') }}">My invites</a>
      <hr>
      <a class="dropdown-item" href="#"> <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
      </a>
        <form  method="POST" action="{{ url('/profile/remove') }}">
          {{ csrf_field() }}
            <button class="dropdown-item" href="#">Delete account</button>
      </form>
    </div>

    <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false">
      <img src="../img/jane.jpg" class="roundRadius" width="30" height="30">
    </button>
  </div>
@endif

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
  aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
  <i class="fas fa-bars"></i>
</button>

     
<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
  <form action="{{URL::to('/search')}}" method="GET" role="search" class="searchBar-blue form-inline mr-auto my-2 my-lg-0">
  {{csrf_field()}} 
    <input class="form-control" type="search" placeholder="Search..." name="search" >
    <button class="btn form-control" type="submit"><i class="fas fa-search"></i></button>
  </form>

  @if(Auth::check()) <ul class="logged-in navbar-nav mt-2 mt-lg-0">
  @else <ul class="navbar-nav mt-2 mt-lg-0"> 
      @endif
    <li class="nav-item active">
      <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href={{ route('about') }}>About</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href={{ route('faqs') }}>FAQ</a>
    </li>
    @if(!Auth::check())
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
      </li>
    @endif  
  </ul>
</div>
</nav>