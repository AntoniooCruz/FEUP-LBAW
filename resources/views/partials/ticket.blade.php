<div class="col-auto  mb-3 sm-12">
    <div class="card ticket text-white">
      <div class="opacity_div"></div>
      <img class="card-img" src="../img/event.jpg" alt="Card image">
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