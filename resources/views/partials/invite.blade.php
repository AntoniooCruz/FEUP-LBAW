<div class="col-auto p-0 sm-12 col-md-6 col-lg-4">
        <div class="container-fluid actionCard">
          <div class="card card-invited-event col">
            <div class="description header">
              <a href="userprofile.html"><img class="userAction roundRadius" src="../img/jane.jpg"
                  alt="Card image cap"></a>
              <div class="headerText">
                <span class="card-title"><a href="userprofile.html"
                    class="link-username">{{$invites[$i]->inviter->username}}</a> invited you to
                  this event</span>
                <!-- <span class="card-date">13 Mar 2019 • 16h33</span> -->
                <div><span class="event-card-hour">{{$invites[$i]->event()->first()->date}}</span> • 
                <span class="card-date extendedDate">{{$invites[$i]->event()->first()->date}}</span>
              </div>
              </div>
              <i class="far fa-flag"></i>
            </div>
          </div>
          @include ('partials.card', ['event'=>$invites[$i]->event()->first()])
        </div>
      </div>