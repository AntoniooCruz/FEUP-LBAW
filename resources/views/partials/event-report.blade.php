<div class="container-fluid actionCard">
            <div class="report report-invite">
              <div class="row">
                <div class="col  mb-5 sm-12">
                  <div class="description header">
                    <a href="{{ url('/profile/'.$rep->reporter->id_user) }}"><img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap"></a>
                    <div class="headerText">
                      <span class="card-title"><a href="{{ url('/profile/'.$rep->reporter->id_user) }}"><span class="link-username">{{$rep->reporter->name}}</span></a>
                        reported
                        <a href="{{ url('/profile/'.$rep->event->owner->id_user) }}"><span class="link-username">{{$rep->event->owner->name}}'s</span></a> event
                        <a href="{{ url('/event/'.$rep->event->id_event) }}"><span class="link-event">{{$rep->event->title}}</span></a></span>
                      <p>"{{$rep->report->reason}}"</p>
                    </div>
                  </div>
                  <div class="footer">
                    <hr>
                    <div class="footerText">
                      <button repid="{{$rep->id_report}}" class="delete-event"><i class="fas fa-check "></i></button><button archid="{{$rep->id_report}}" class="archive-event"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  </div>
                </div>
                <div class="col  mb-7 sm-12">
                  <div class="invite card">
                    <a href="{{ url('/event/'.$rep->event->id_event) }}"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
                    <span class="badge badge-pill badge-secondary card-category">{{$rep->event->category->name}}</span>
                    <div class="card-body" id="event-card-body">
                      <div class="row eventRow header align-items-start">
                        <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
                          <div id="eventPageMonth" class="eventPageMonth">
                            <span id="eventMonth" class="eventMonth">{{$rep->event->date}}</span>
                          </div>
                          <span id="eventPageDay" class="eventPageDay">{{$rep->event->date}}</span>
                        </div>
                        <div class="col-md-7 col-sm-10 col-10 cardTitle">
                          <span id="event-card-title">{{$rep->event->title}}</span>
                          <div class="event-card-footer">
                            <span id="event-card-hour">{{$rep->event->date}}</span>
                            <p class="dot-separator"> • </p>
                            <span id="card-adress">{{$rep->event->location}}</span>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        