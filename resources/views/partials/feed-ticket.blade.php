<div class="container-fluid actionCard">
      <div class="card card-going-event">
      <div class="description header">
              @if (file_exists(public_path('img/users/originals/' . $item->owner->id_user . '.png')) )
              <a href="{{ url('/profile/'.$item->owner->id_user) }}"><img class="userAction roundRadius" src="{{ asset("img/users/originals/" . $item->owner->id_user . ".png") }}" alt="Card image cap"></a>
                @else
                <a href="{{ url('/profile/'.$item->owner->id_user) }}"><img class="userAction roundRadius" src= " {{asset("img/user.jpg")}} " alt="Card image cap"></a>
            @endif
            
            <div class="headerText">
              <span class="card-title"><a href="{{ url('/profile/'.$item->owner->id_user) }}"><span class="link-username">{{$item->owner->username}}</span></a>
            is going to <a href="{{ url('/event/'.$item->event->id_event) }}"><span class="link-event">{{$item->event->title}}</span></a></span>

              <span class="card-date">{{$item->date_acquired}}</span>
            </div>
            <i class="fab fa-font-awesome-flag"></i>
          </div>
      </div>
      <div class="invite card">


      @if (file_exists(public_path('img/events/originals/' . strval($item->event->id_event) . '.png')) )
        <a href="{{ url('/event/'.$item->event->id_event) }}"><img src= {{asset("img/events/originals/" . strval($item->event->id_event) . '.png')}} class="card-img-top"></a>
        @else
        <a href="{{ url('/event/'.$item->event->id_event) }}"><img  src= " {{asset("img/invite-card-event.png") }} " class="card-img-top"></a>
        @endif
        
        <span class="badge badge-pill badge-secondary card-category">{{$item->event->category->name}}</span>
        <div class="card-body" id="event-card-body">
          <div class="row header align-items-start">
            <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
              <div id="eventPageMonth" class="eventPageMonth">
                <span id="eventMonth" class="eventMonth">{{$item->event->date}}</span>
              </div>
              <span id="eventPageDay" class="eventPageDay">{{$item->event->date}}</span>
            </div>
            <div class="col-10 cardTitle text-left">
              <span id="event-card-title">{{$item->event->title}}</span>
              <div class="event-card-footer">
                <span id="event-card-hour">{{$item->event->date}}</span>
                <p class="dot-separator"> • </p>
                <span id="card-adress"> {{$item->event->location}}</span>
              </div>
            </div>
          </div>
          <div id="event-card-people-attending" class="row text-left">
          <div class="col ">
          @if(sizeof($usersGoing) > 2)
          @if (file_exists(public_path('img/users/originals/' . $usersGoing[0] . '.png')) )
          <a href="{{ url('/profile/'.$usersGoing[0]) }}"><img href src="{{ asset("img/users/originals/" . $usersGoing[0] . ".png") }}" class="event-card-user-photo" width="25" height="25" alt="User photo"></a>
          @else
          <a href="{{ url('/profile/'.$usersGoing[0]) }}"><img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25" alt="User photo"></a>
          @endif
          @if (file_exists(public_path('img/users/originals/' . $usersGoing[0] . '.png')) )
          <a href="{{ url('/profile/'.$usersGoing[1]) }}"><img href src="{{ asset("img/users/originals/" . $usersGoing[1] . ".png") }}" class="event-card-user-photo" width="25" height="25" alt="User photo"></a>
          @else
          <a href="{{ url('/profile/'.$usersGoing[1]) }}"><img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25" alt="User photo"></a>
          @endif
          @if (file_exists(public_path('img/users/originals/' . $usersGoing[2] . '.png')) )
          <a href="{{ url('/profile/'.$usersGoing[2]) }}"><img href src="{{ asset("img/users/originals/" . $usersGoing[0] . ".png") }}" class="event-card-user-photo" width="25" height="25" alt="User photo"></a>
          @else
          <a href="{{ url('/profile/'.$usersGoing[2]) }}"><img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25" alt="User photo"></a>
          @endif
          @else
          @foreach($usersGoing as $user)
          @if (file_exists(public_path('img/users/originals/' . $usersGoing[0] . '.png')) )
          <a href="{{ url('/profile/'.$user) }}"><img href src="{{ asset("img/users/originals/" . $user . ".png") }}" class="event-card-user-photo" width="25" height="25" alt="User photo"></a>
          @else
          <a href="{{ url('/profile/'.$user) }}"><img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25" alt="User photo"></a>
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