<div class="col">
  <div class="invite card">
    <a href="{{ url('/event/'.$event->id_event) }}"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
            <span class="badge badge-pill badge-secondary card-category">{{$categories[$event->id_category - 1]->name}}</span>
    <div class="card-body" id="event-card-body">
      <div class="row eventRow header align-items-start">
        <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
          <div id="eventPageMonth" class="eventPageMonth">
            <span class="eventMonth">{{$event->date}}</span>
          </div>
          <span class="eventPageDay">{{$event->date}}</span>
        </div>
        <div class="col-10 cardTitle text-left">
          <span id="event-card-title">{{$event->title}}</span>
          <div class="event-card-footer">
            <span class="event-card-hour">{{$event->date}}</span>
            <p class="dot-separator"> • </p>
            <span id="card-adress">{{$event->location}}</span>
          </div>
        </div>
      </div>
      <div id="event-card-people-attending" class="row text-left">
      <div class="col ">
          @if(sizeof($usersGoing) > 2)
          @if (file_exists(public_path('img/users/originals/' . $usersGoing[0] . '.png')) )
          <a href="{{ url('/profile/'.$usersGoing[0]) }}"><img href src="{{ asset("img/users/originals/" . $usersGoing[0] . ".png") }}" class="event-card-user-photo" width="25" height="25"></a>
          @else
          <a href="{{ url('/profile/'.$usersGoing[0]) }}"><img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25"></a>
          @endif
          @if (file_exists(public_path('img/users/originals/' . $usersGoing[0] . '.png')) )
          <a href="{{ url('/profile/'.$usersGoing[1]) }}"><img href src="{{ asset("img/users/originals/" . $usersGoing[1] . ".png") }}" class="event-card-user-photo" width="25" height="25"></a>
          @else
          <a href="{{ url('/profile/'.$usersGoing[1]) }}"><img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25"></a>
          @endif
          @if (file_exists(public_path('img/users/originals/' . $usersGoing[2] . '.png')) )
          <a href="{{ url('/profile/'.$usersGoing[2]) }}"><img href src="{{ asset("img/users/originals/" . $usersGoing[0] . ".png") }}" class="event-card-user-photo" width="25" height="25"></a>
          @else
          <a href="{{ url('/profile/'.$usersGoing[2]) }}"><img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25"></a>
          @endif
          @else
          @foreach($usersGoing as $user)
          @if (file_exists(public_path('img/users/originals/' . $usersGoing[0] . '.png')) )
          <a href="{{ url('/profile/'.$user) }}"><img href src="{{ asset("img/users/originals/" . $user . ".png") }}" class="event-card-user-photo" width="25" height="25"></a>
          @else
          <a href="{{ url('/profile/'.$user) }}"><img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25"></a>
          @endif
          @endforeach
          @endif
          @if(sizeof($usersGoing) > 0)
          <span id="event-card-invite"><i class="fas fa-plus-circle"></i></span>
          <span id="peopleGoing">+{{sizeof($usersGoing)}} going</i></span>
          @else 
          <span id="peopleGoing">Be the first one to get a ticket!</i></span>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>