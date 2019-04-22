 <div class="col mt-4">
    <div class="invite card">
      <a href="eventpage.html"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
      <span class="badge badge-pill badge-secondary card-category">{{$event->getCategoryName()}}</span>
      <div class="card-body" id="event-card-body">
        <div class="row eventRow header align-items-start">
          <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
            <div id="eventPageMonth" class="eventPageMonth">
              <span id="eventMonth" class="eventMonth">Mar</span>
            </div>
            <span id="eventPageDay" class="eventPageDay">03</span>
          </div>
          <div class="col-10 cardTitle text-left">
            <span id="event-card-title">{{$event->title}}</span>
            <div class="event-card-footer">
              <span id="event-card-hour">13:00</span>
              <p class="dot-separator"> • </p>
              <span id="card-adress">{{$event->location}}</span>
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