<div class="container-fluid actionCard">
            <div class="report report-company">
              <div class="card card-company">
                <div class="card card-company">
                  <div class="description header">
                    <a href="{{ url('/profile/'.$report->id_user) }}"><img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap"></a>
                    <div class="headerText">
                      <span class="card-title"><a href="{{ url('/profile/'.$report->id_user) }}"><span class="link-username">{{$report->user->name}}</span></a>
                        is pending verification
                    </div>

                  </div>
                  <div class="footer">
                    <hr>
                    <div class="footerText">
                      <button><i class="fas fa-check business-check" post="{{$report->id_user}}"></i></button><button><i class="fas fa-trash-alt business-out" post="{{$report->id_user}}"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        