@extends('layouts.app')

@section('custom-scripts')
  <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')

<section id="profile">
    <div class="parContainer row justify-content-center">
        <div id="profile_container" class="col-lg-3 col-12 container text-center">
            <div>
                <img src="../img/user.jpg">
            </div>
            <form method="POST" action="{{ url('/profile/edit') }}" class="form-signin" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div id="profile_content">
                    <i class="fab fa-font-awesome-flag"></i>
                    <div class="col-3 col text-right">
                        <div id="update_button" class="profile-pri-button file btn btn-lg btn-secondary">
                                Upload
                                <input type="file" name="file"/>
                            </div>
                    </div>
                    <div id="header"></div>
                    <div id="name" class="row justify-content-left">
                        <div class="col text-left">

                            <div class="form-label-group">
                                <input type="text"  name="name" id="inputName" class=" ... {{$errors->has('name')? 'is-invalid' : '' }} form-control" value="{{old('name',$user->name)}}" required
                                    autofocus style="border:none;" placeholder="Name">
                                @if ($errors->has('name'))
							    <span class="invalid-feedback">
                                    {{ $errors->first('name') }}
							    </span>
                        	@endif
                            </div>
                            <div class="form-label-group">
                                <input type="email" name="email" id="inputEmail" class="... {{$errors->has('email')? 'is-invalid' : '' }} form-control" value="{{old('email',$user->email)}}"
                                    required autofocus style="border:none;" placeholder="Email">
                                @if ($errors->has('email'))
							    <span class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </span>
                                @endif
                            </div>

                            @if($user->user_type=='Business')
                            <div class="form-label-group">
                                <input type="text" name="website" id="inputwebsite" class="... {{$errors->has('website')? 'is-invalid' : '' }} form-control" value="{{old('website',$user->business->website)}}"
                                    required autofocus style="border:none;" placeholder="Website">
                                    @if ($errors->has('website'))
								        <span class="invalid-feedback">
                                                {{ $errors->first('website') }}
                                    </span>
                                    @endif
                            </div>
                            @endif
                            <div class="form-label-group">
                                <input type="text" name="username" id="inputUsername" class="... {{$errors->has('username')? 'is-invalid' : '' }} form-control" value="{{old('username',$user->username)}}"
                                    required autofocus style="border:none;" placeholder="Username">
                                @if ($errors->has('username'))
						        <span class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="stats row justify-content-center">
                            <div id="followers" class="col text-center">
                              <div></div><strong> {{$user->followers()->count()}} </strong>
                              <small>Followers</small>
                            </div>
                            <div id="following" class="col text-center">
                              <strong> {{$user->following()->count()}} </strong>
                              <small>Following</small>
                            </div>
                            <div id="events" class="col text-center">
                              <strong> {{sizeof($eventsOwned)}}</strong>
                              <small>Events</small>
                            </div>
                  
                          </div>
                    <hr>
                    <div>
                    <textarea id="description" name="description" class="... {{$errors->has('description')? 'is-invalid' : '' }} col-10 text-left"
                        
                        rows="4" placeholder="Description"> {{old('description',$user->description)}}</textarea>
                        @if ($errors->has('description'))
								        <span class="invalid-feedback">
                                                {{ $errors->first('description') }}
                                    </span>
                                    @endif
                                </div>
                    <div class="row justify-content-center"><button type="submit"
                            value="save" class="profile-pri-button btn btn-primary">Save</button></div>
                </div>

                <div class="row"><button id="tickets-button" type="button" class=" btn btn-secondary"><a
                            href="mytickets.html">My
                            tickets</a></button></div>
            </form>
        </div>

        <div id="events_container" class="col-lg-6 col-12 container text-left">
            <ul class="nav" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-active-tab" data-toggle="pill" href="#userevents" role="tab"
                        aria-controls="pills-active" aria-selected="true">{{$user->name}}'s events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-past-tab" data-toggle="pill" href="#attendingevents" role="tab"
                        aria-controls="pills-past" aria-selected="false">Events attending</a>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div id="userevents" class="row justify-content-start tab-pane fade show active">
                    @each('partials.card', $eventsOwned, 'event')
                </div>
                <div id="attendingevents" class="row justify-content-start tab-pane fade">
                    @each('partials.card', $eventsAttending, 'event')
                </div>
            </div>
        </div>
</section>
@if(Auth::check())
  @include('layouts.create-event', ['categories'=>$categories])
@endif

@endsection