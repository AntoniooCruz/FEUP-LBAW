<div class="container-fluid actionCard">
      <div class="card card-going-event">
        <div class="description header">
              @if (file_exists(public_path('img/users/originals/' . $item->id_owner . '.png')) )
              <a href="{{ url('/profile/'.$item->owner->id_user) }}"><img class="userAction roundRadius" src="{{ asset("img/users/originals/" . $item->id_owner . ".png") }}" alt="Card image cap"></a>
                @else
                <a href="{{ url('/profile/'.$item->owner->id_user) }}"><img class="userAction roundRadius" src= " {{asset("img/user.jpg")}} " alt="Card image cap"></a>
            @endif
            
            <div class="headerText">
              <span class="card-title"><a href="{{ url('/profile/'.$item->id_owner) }}"><span class="link-username">{{$item->owner->username}}</span></a>
            created <a href="{{ url('/event/'.$item->id_event) }}"><span class="link-event">{{$item->title}}</span></a></span>
              <span class="card-date">{{$item->date}}</span>
            </div>
            <i class="fab fa-font-awesome-flag"></i>
          </div>
      </div>
      <div class="invite card">
        <a href="{{ url('/event/'.$item->id_event) }}"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
        <span class="badge badge-pill badge-secondary card-category">{{$item->category->name}}</span>
        <div class="card-body" id="event-card-body">
          <div class="row header align-items-start">
            <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
              <div id="eventPageMonth" class="eventPageMonth">
                <span id="eventMonth" class="eventMonth">{{$item->date}}</span>
              </div>
              <span id="eventPageDay" class="eventPageDay">{{$item->date}}</span>
            </div>
            <div class="col-10 cardTitle text-left">
              <span id="event-card-title">{{$item->title}}</span>
              <div class="event-card-footer">
                <span id="event-card-hour">{{$item->date}}</span>
                <p class="dot-separator"> • </p>
                <span id="card-adress"> {{$item->location}}</span>
              </div>
            </div>
          </div>
          <div id="event-card-people-attending" class="row text-left">
            <div class="col ">
              <img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25">
              <img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25">
              <img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25">
              <span id="event-card-invite"><i class="fas fa-plus-circle"></i></span>
              <span id="peopleGoing">+300 going</i></span>
            </div>
          </div>
        </div>
      </div>
    </div>