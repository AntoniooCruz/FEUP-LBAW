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
                      @if($rep->report->veridict == 'Approved')
                      <a href="{{ url('/profile/'.$rep->report->admin->name) }}"><span class="link-username">{{$rep->report->admin->name}} </span></a>approved the report
                      @else
                      <a href="{{ url('/profile/'.$rep->report->admin->name) }}"><span class="link-username">{{$rep->report->admin->name}}  </span></a>refused the report
                      @endif
                    </div>
                  </div>
                </div>
            </div>
         </div>