<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="/home"> <img src="{{ asset('img/icon.png') }}" width="31,83" height="24,92"> </a>
    @if(Route::current()->getName() != 'home')

  <form action="{{URL::to('/search')}}" method="GET" role="search" class="searchBar-blue">
    {{csrf_field()}} 
        <input type="search" placeholder="Search" name="search">
      </form>
      @endif
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span ><i class="fas fa-bars"></i></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto topnav">
            <li class="nav-item active">
                <a class="nav-link" href="/home">Home<span class="sr-only">(current)</span></a>
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
          @else
          <li class="nav-item ">
          <button id="newEventBtn" type="button" class="" data-toggle="modal" data-target="#createEventModal">
              <i class="nav-link fas fa-plus-square"></i>
            </button>
          </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <button type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    @if (file_exists(public_path('img/users/originals/' . strval(Auth::user()->id_user) . '.png')) )
                      <img width="30" height="30" class="roundRadius" src={{"../img/users/originals/" . strval(Auth::user()->id_user) . ".png"}} alt="Card image cap">
                    @else
                    <img width="30" height="30" class="roundRadius" src={{"../img/user.jpg"}} alt="Card image cap">
                    @endif
                    
                  </button>                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('myProfile') }}">Profile</a>
                    <a class="dropdown-item" href="{{ url('/myTickets')}}">My tickets</a>
                    <a class="dropdown-item" href="{{ url('/myInvites')}}">My invites</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"> <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </a>
                    <form  method="POST" action="{{ route('removeProfile') }}">
                        {{ csrf_field() }}
                          <button class="dropdown-item" href="#">Delete account</button>
                    </form>
                              </div>
                          </li>
            @endif
        </ul>
    </div>
      
</nav>