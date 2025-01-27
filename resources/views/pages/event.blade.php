@extends('layouts.app')

@section('custom-scripts')
<script src={{ asset('js/post.js') }} defer></script>
<script src={{ asset('js/comments.js') }} defer></script>
<script src={{ asset('js/poll.js') }} defer></script>
  <link href="{{ asset('css/eventpage.css') }}" rel="stylesheet">
  <script src={{ asset('js/date.js') }} defer></script>
  <script src={{ asset('js/event.js') }} defer></script>
  <script src={{ asset('js/circliful/jquery.circliful.min.js') }} defer></script>

@endsection

@section('content')
<section id="event" class="event container">
  <span id="id_event" style="display:none;">{{$event->id_event}}</span>
  <div class="eventPhoto justify-content-md-center">
    <div id="floatingLabels">
      @if($event->is_private)<span id="privateIndicator" class="label"> <i class="fas fa-lock"></i></span>@endif
      <span id="categoryIndicator" class="label"> {{$event->category->name}}</span>
    </div>
    @if (file_exists(public_path('img/events/originals/' . strval($event->id_event) . '.png')) )
    <img src= {{'../img/events/originals/' . strval($event->id_event) . '.png'}} width="400" height="300" alt="Event photo">
    @else
    <img src= "../img/eventbanner.jpg" width="400" height="300" alt="Event photo">
    @endif
  </div>

  <div class="eventRow row">
    @if(Auth::check()  && $event->owner!=Auth::user())
    <div class="col-lg-9 col-md-8 col-sm-12">
    @else <div class="col-lg-11 col-md-8 col-sm-12">
    @endif
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
                  href="{{ url('/profile/'.$event->owner->id_user) }}">{{$event->owner->name}}</a></span></span>
          </div>
        </div>
      </div>
    </div>
    @if(Auth::check() && $event->owner!=Auth::user())
    <div class="col-lg-2  col-md-3 col-sm-12 getTicket text-right pr-1">
        @if($hasTicket)
        <button id="getTicketBtn" class="btn btn-primary" type="button" aria-expanded="false">
          Going
        </button>
        @else
        <button id="getTicketBtn" class="btn btn-primary" type="button" aria-expanded="false" data-toggle="modal" data-target="#getTicketModal">
          <i class="fas fa-ticket-alt"></i> 
          @if($event->price>0)
            {{$event->price}}€
          @endif
        @endif
      </button>
    </div>
    @endif
    @if(Auth::check())
    <div class="col-lg-1 col-md-1 col-sm-12 getTicket text-right">
        <div class="btn-group">
          <button type="button" class="btn-more btn btn-outline-primary" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-ellipsis-h"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-right p-0 ">
            @if($event->owner==Auth::user())
            <button class="dropdown-item px-3 pt-2 pb-2" type="button" data-toggle="modal" data-target="#editEventModal">Edit
              event</button>
            @if($event->is_private)  
            <button class="dropdown-item px-3 pt-2 pb-2" type="button" data-toggle="modal" data-target="#checkInModal">Invite</button>
            @endif
            <button class="dropdown-item px-3 pt-2 pb-2" type="button" data-toggle="modal" data-target="#checkInModal">Check
              in attendees</button>
            <button id="deleteEvent" class="dropdown-item px-3 pt-2 pb-2 " type="button" data-toggle="modal"
              data-target="#deleteEventModal">Delete event</button>
           @else 
           <button class="dropdown-item px-3 pt-2 pb-2" type="button" data-toggle="modal" data-target="#inviteModal">Invite</button>
          <button class="dropdown-item px-3 pt-2 pb-2" type="button" aria-expanded="false" data-toggle="modal"
          data-target="#reportEventModal">Report Event</button>
          @endif
          </div>
        </div>
      </div>
    @endif
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
          <span class="event-card-hour">{{$event->date}}</span>
          <span class="extendedDate">{{$event->date}}</span>
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
              <div class="lotation container">
                <div id="circle" class="row">
                     <div id="test-circle"></div>
                </div>
                <div id="after-circle" class="row justify-content-center">
                <span >Capacity(<span id="eventCapacity">{{$event->capacity}}</span>)</span>
                  <span> · Taken(<span id="eventTaken">{{$event->tickets()->count()}}</span>) </span>
                  <span> · Left(<span id="eventLeft">{{$event->capacity - ($event->tickets()->count())}}</span>)</span>
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
                        @if (file_exists(public_path('img/users/originals/' . strval($soldTicketUser) . '.png')) )
                        <a href="{{ url('/profile/'.strval($soldTicketUser)) }}"><img src={{"../img/users/originals/" . strval($soldTicketUser) . ".png"}} class="userPic" alt="User photo"></a>
                      @else
                        <img  src="../img/user.jpg" class="userPic" alt="User photo">
                      @endif
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
                        
                      @foreach ($friendsGoing->take(7) as $soldTicketFriend)
                      @if (file_exists(public_path('img/users/originals/' . strval($soldTicketFriend->id_user) . '.png')) )
                      <a href="{{ url('/profile/'.strval($soldTicketFriend->id_user)) }}"><img src={{"../img/users/originals/" . strval($soldTicketFriend->id_user) . ".png"}} class="userPic" alt="User photo"></a>
                      @else
                      <a href="{{ url('/profile/'.strval($soldTicketFriend->id_user)) }}"><img  src="../img/user.jpg" class="userPic" alt="User photo"></a>
                      @endif
                      @endforeach
                      
                      @if(count($friendsGoing) > 7)
                        <a a href="#">
                          <img class="userPic-more" src="../img/user.jpg" alt="User photo">
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
      <div class="commentArea" type="None">
        <h6></h6>
        @if (Auth::check())
        @if (file_exists(public_path('img/users/originals/' . strval(Auth::user()->id_user) . '.png')) )
                        <img id="commentPic" src={{"../img/users/originals/" . strval(Auth::user()->id_user) . ".png"}} class="roundRadius" alt="User photo" alt="User photo">
                      @else
                        <img id="commentPic" src="../img/user.jpg" class="roundRadius" alt="User photo" alt="User photo">
        @endif
        @endif
        <div class="comment row">
          <div class="col-12 form-group">
            <textarea class="form-control" name="newPost" id="exampleFormControlTextarea1" rows="3"
              placeholder="Say something..."></textarea>
            <hr>
          </div>
          <div class="options mb-1 pl-3">
            <button class="" type="button" aria-expanded="false">
              <i class="fas fa-poll-h"></i>
            </button>
            <button type="button" class="btn" data-toggle="modal" data-target="#fileModal">
                <i class="fas fa-cloud-upload-alt"></i>
              </button>
          </div>
        </div>
        <button id ="new_post_button" class="commentButton  btn-primary roundRadius" type="button" aria-expanded="false">
          <i class="fas fa-caret-right"></i>
        </button>
      </div>
      <hr>
      <div id="posts">
        @each ('partials.post', $event->posts()->get(), 'post')
      </div>
    </div>
  </section>
</section>

<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="fileModal"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <form>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
      </div>
      <div class="modal-body">
        <input type="file">
      </div>
      <div class="modal-footer">
      <button type="button" id="cancel" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="done" class="btn btn-danger">Done</button>
      </div>
    </div>
  </form>
  </div>
</div>


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
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Content" checked>
            <label class="form-check-label" for="gridRadios1">
              Explicit content
            </label>
          </div>
          <div class="form-check ml-2">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Harassment">
            <label class="form-check-label" for="gridRadios2">
              Harassment
            </label>
          </div>
          <div class="form-check ml-2">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="Spam">
            <label class="form-check-label" for="gridRadios3">
              Spam
            </label>
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="form-check ml-2">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="other" aria-label="Radio button for following text input">
              </div>
            </div>
            <input type="text" class="form-control" aria-label="Text input with radio button" placeholder="Other">
          </div>
        </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" id="cancel-report-event" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="report-event" class="btn btn-danger">Report</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="getTicketModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"> 
            <i class="fas fa-ticket-alt"></i>  Purchase Ticket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>You are about to purchase a ticket for <span class="ticketUnderline">{{$event->title}}</span>
             ocurring at <span class="extendedDate">{{$event->date}}</span> 
          </p>
          <ul><li>Cost: {{$event->price}}€</li></ul>
          <p>Are you sure you want to continue?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <script src="https://www.paypalobjects.com/api/checkout.js"></script>

<div id="paypal-button"></div>

<script>
  paypal.Button.render({
    env: 'sandbox', // Or 'production'
    // Set up the payment:
    // 1. Add a payment callback
    payment: function(data, actions) {
      // 2. Make a request to your server
      return actions.request.post('/api/create-payment')
        .then(function(res) {
          // 3. Return res.id from the response
          return res.id;
        });
    },
    // Execute the payment:
    // 1. Add an onAuthorize callback
    onAuthorize: function(data, actions) {
      // 2. Make a request to your server
      return actions.request.post('/api/execute-payment', {
        paymentID: data.paymentID,
        payerID:   data.payerID
      })
        .then(function(res) {
          // 3. Show the buyer a confirmation message.
          purchaseTicketRequest()
        });
    }
  }, '#paypal-button');
</script>
        </div>
        
        





      </div>
    </div>
  </div>

  @if(Auth::check())
  @include('layouts.create-event', ['categories'=>$categories])
@endif

@endsection