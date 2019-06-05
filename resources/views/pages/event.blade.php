@extends('layouts.app')

@section('custom-scripts')
  <script type="text/javascript" src={{ asset('js/comments.js') }} defer></script>
  <link href="{{ asset('css/eventpage.css') }}" rel="stylesheet">
@endsection

@section('content')
<section id="event" class="event container">
  <span id="id_event" style="display:none;">{{$event->id_event}}</span>
  <div class="eventPhoto justify-content-md-center">
    <div id="floatingLabels">
      @if($event->is_private)<span id="privateIndicator" class="label"> <i class="fas fa-lock"></i></span>@endif
      <span id="categoryIndicator" class="label"> {{$event->category->name}}</span>
    </div>
    <img src="../img/eventbanner.jpg">
  </div>

  <div class="eventRow row">
    <div class="col-lg-9 col-md-8 col-sm-12">
      <div class="row header align-items-start">
        <div id="eventPagedate" class="col-xs align-items-start">
          <div id="eventPageMonth">
            <span class="eventMonth">{{$event->date}}</span>
          </div>
          <span class="eventPageDay">{{$event->date}}</span>
        </div>
        <div id="titleHeader" class="col">
          <h2 id="eventTitle">{{$event->title}}</h2>
          <div>
            <span id="#created" class="eventDate">Created by <span class="ownerUsername"><a
                  href="userprofile.html">{{$event->owner->name}}</a></span></span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-2  col-md-3 col-sm-12 getTicket text-right pr-1">
      <button class="btn btn-primary" type="button" aria-expanded="false">
        <i class="fas fa-ticket-alt"></i> 
        @if($event->price>0)
        {{$event->price}}€
        @endif
      </button>
    </div>
    <div class="col-lg-1  col-md-1 col-sm-12 getTicket text-right">
      <button class="reportBtn btn-outline-secondary" type="button" aria-expanded="false" data-toggle="modal"
        data-target="#reportEventModal">
        <i class="far fa-flag"></i>
      </button>
    </div>
  </div>
  

  <div class="eventRow details">
    <div class="row detailsHeader justify-content-center">
      <button class="detailsButton btn-no" type="button" data-toggle="collapse" data-target="#collapseContentDets"
        aria-expanded="true" aria-controls="collapseOne">
        Details <i class="fas fa-caret-down"></i>
      </button>
    </div>
    <div id="collapseContentDets" class="row collapse">
      <div class="col-lg-4 col-sm-12 ">
        <div id="dateNhours">
          <h6><i class="far fa-calendar-alt"></i> Date & Hours</h6>
          <span id="extendedDate">{{$event->date}}</span>
        </div>

        <div id="location">
          <h6><i class="fas fa-map-marker-alt"></i> Location</h6>
          <span>{{$event->location}}</span>    
          <span>
              @if($event->zip_code!=null)
              {{$event->zip_code}},
              @endif
              @if($event->city!=null)
              {{$event->city}}
              @endif
          </span>
          @if($event->country!=null)
          <span>
              {{$event->country}}
          </span> 
          @endif       
        </div>
      </div>
      <div class="col">
        <h6><i class="fas fa-info-circle"></i> Description</h6>
        <p> {{$event->description}} </p>
      </div>
    </div>
  </div>

  <hr>
  <section class="discussion row">
      <div class="leftCol col-lg-4 col-md-12">
          <div id="attendance" class="container sticky-top">
            <div class="row justify-content-center">
              <h6>Attendance</h6>
              <button class="btn-no attendanceButton" type="button" data-toggle="collapse" data-target="#collapseContent"
                aria-expanded="true" aria-controls="collapseOne">
                Attendance <i class="fas fa-caret-down"></i>
              </button>
            </div>
            <section id="collapseContent" class="collapse">
              <div class="lotation row align-self-center justify-content-center container">
                <div id="circle" class="col-auto align-self-center">
                     <div id="test-circle"></div>
                </div>
                <div id="after-circle" class="col-auto align-self-center">
                <span class="row">Capacity: <span id="eventCapacity">{{$event->capacity}}</span></span>
                  <span class="row">Taken: <span id="eventTaken">{{$event->tickets()->count()}}</span></span>
                  <span class="row">Left: <span id="eventLeft">{{$event->capacity - ($event->tickets()->count())}} </span></span>
                </div>
              </div>
              <div class="userPics">
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#allGoing"
                      role="tab" aria-controls="nav-profile" aria-selected="false">All({{sizeof($usersGoing)}})</a>
                      @if(Auth::check())
                        <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#friendsGoing" role="tab"
                        aria-controls="nav-home" aria-selected="true">Friends({{sizeof($friendsGoing)}})</a>
                      @endif      
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="allGoing" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row justify-content-center">  
                        @foreach ($usersGoing->take(7) as $soldTicketUser)
                        <img class="userPic" src="../img/user.jpg">
                      @endforeach
  
                      @if(count($usersGoing) > 7)
                        <a a href="#">
                          <img class="userPic-more" src="../img/user.jpg">
                          <i class="fas fa-circle"></i>
                          <i class="fas fa-ellipsis-h"></i>
                        </a>
                      @endif
                    </div>
                  </div>
                  @if(Auth::check())
                  <div class="tab-pane fade" id="friendsGoing" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row justify-content-center">
                        
                      @foreach ($friendsGoing->take(7) as $soldTicketUser)
                        <img class="userPic" src="../img/user.jpg">
                      @endforeach
                      
                      @if(count($friendsGoing) > 7)
                        <a a href="#">
                          <img class="userPic-more" src="../img/user.jpg">
                          <i class="fas fa-circle"></i>
                          <i class="fas fa-ellipsis-h"></i>
                        </a>
                      @endif
                      
                    </div>
                  </div>
                  @endif
                </div>
            </section>
          </div>
        </div>
    </div>
    <div class="rightCol col-auto col-md-12">
      <div class="commentArea">
        <h6></h6>
        <img id="commentPic" class="roundRadius" src="../img/user.jpg">
        <div class="comment row">
          <div class="col-12 form-group">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
              placeholder="Say something..."></textarea>
            <hr>
          </div>
          <div class="options mb-1 pl-3">
            <button class="" type="button" aria-expanded="false">
              <i class="fas fa-poll-h"></i>
            </button>
            <button class="" type="button" aria-expanded="false">
              <i class="fas fa-cloud-upload-alt"></i>
            </button>
          </div>
        </div>
        <button class="commentButton  btn-primary roundRadius" type="button" aria-expanded="false">
          <i class="fas fa-caret-right"></i>
        </button>
      </div>
      <hr>
      <div id="#posts">
        @each ('partials.post', $event->posts()->get(), 'post')
      </div>
    </div>
  </section>
</section>

<div class="modal fade" id="reportEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report Event</h5>
      </div>
      <div class="modal-body">
        <p>Help us undertand what's happening?</p>
        <fieldset class="form-group">
          <div class="form-check ml-2">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
            <label class="form-check-label" for="gridRadios1">
              Explicit content
            </label>
          </div>
          <div class="form-check ml-2">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
            <label class="form-check-label" for="gridRadios2">
              Harassment
            </label>
          </div>
          <div class="form-check ml-2">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
            <label class="form-check-label" for="gridRadios3">
              Spam
            </label>
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text pl-2">
                <input type="radio" aria-label="Radio button for following text input">
              </div>
            </div>
            <input type="text" class="form-control" aria-label="Text input with radio button" placeholder="Other">
          </div>
        </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger">Report</button>
      </div>
    </div>
  </div>
</div>

@include('layouts.create-event')

@endsection