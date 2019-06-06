<div class="container-fluid actionCard">
  <div class="report report-user">
    <div class="card card-user">
        <div class="description card-header">
          <span class="id_report" style="display:none;">{{$report->id_report}}</span>
          <a href="userprofile.html"><img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap"></a>
          <div class="headerText">
            <span class="card-title"><a href="userprofile.html"><span
                  class="link-username">{{$report->reporter->username}}</span></a>
              reported
              <a href="userprofile.html"><span class="link-username">{{$report->reportee->username}}</span></a></span>
              <span class="card-date">13 Mar 2019 • 16h33</span>
          </div>
        </div>
        <div class="card-body">

          <p><b>Reason:</b> "{{$report->report->reason}}"</p>
        </div>
      <div class="footer">
        <hr>
        <div class="footerText">
          <button class="banUser"><i class="fas fa-check"></i></button>´
          <button><i class="fas fa-trash-alt"></i></button>
        </div>
      </div>
  </div>
</div>
</div>