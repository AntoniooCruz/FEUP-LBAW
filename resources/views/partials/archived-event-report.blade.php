<div id="{{$rep->id_report}}" class="container-fluid actionCard">
  <div class="report report-user">
    <div class="card card-user">
        <div class="description card-header">
          <span class="id_report" style="display:none;">{{$rep->id_report}}</span>
          <a href="{{ url('/profile/'.$rep->reporter->id_user) }}"><img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap"></a>
          <div class="headerText">
            <span class="card-title"><a href="{{ url('/profile/'.$rep->reporter->id_user) }}"><span
                  class="link-username">{{$rep->reporter->username}}</span></a>
              reported
              <a href="{{ url('/event/'.$rep->event->id_event) }}"><span class="link-username">{{$rep->event->title}}</span></a></span>
          </div>
        </div>
        <div class="card-body">

          <p><b>Reason:</b> "{{$rep->report->reason}}"</p>
        </div>
      <div class="footer">
        <hr>
        <div id="footer{{$rep->id_report}}" class="footerText">
         @if($rep->report->veridict=='Pending') 
          @elseif($rep->report->veridict=='Approved') Approved by {{$rep->report->admin->name}}
          @elseif($rep->report->veridict=='Ignored')Ignored by {{$rep->report->admin->name}}
          @endif
        </div>
      </div>
  </div>
</div>
</div>