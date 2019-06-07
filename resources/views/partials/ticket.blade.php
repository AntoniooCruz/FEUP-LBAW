<div class="col-auto  mb-3 sm-12">
    <div class="card ticket text-white">
      <div class="opacity_div"></div>


      @if (file_exists(public_path('img/events/originals/' . strval($event->id_event) . '.png')) )
        <a href="{{ url('/event/'.$event->id_event) }}"><img src= {{asset("img/events/originals/" . strval($event->id_event) . '.png')}} class="card-img-top"></a>
        @else
        <a href="{{ url('/event/'.$event->id_event) }}"><img  src= " {{asset("img/invite-card-event.png") }} " class="card-img-top"></a>
        @endif

      <div class="card-img-overlay">
        <div class="header">
          <h5 class="price">{{$event->price}}€</h5>
          <h5 class="token">#{{$ticket->token}}</h5>
        </div>
        <div class="eventDesc">
            <a href="eventpage.html"><h5 class="card-title">{{$event->title}}</h5></a>
            <hr class="ticketHr">
          <p class="card-text">{{$event->city}}</p>
        <p class="card-text">{{$user->username}}</p>
        </div>
      </div>
    </div>
  </div>