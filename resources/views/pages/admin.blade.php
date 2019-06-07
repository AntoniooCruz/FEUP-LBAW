@extends('layouts.app')

@section('custom-scripts')
  <link href="{{ asset('css/adminpage.css') }}" rel="stylesheet">
  <script src={{ asset('js/admin.js') }} defer></script>
  <script src={{ asset('js/profile.js') }} defer></script>
  <script src={{ asset('js/date.js') }} defer></script>
  
@endsection

@section('content')
<div id="wrapper">
<ul class="nav nav-tabs sidebar navbar-nav" id="nav-admin2" role="tablist">
    <li class="nav-item" role="tablist">
      <a class="nav-item nav-link active" id="nav-users-tab" data-toggle="tab" href="#nav-users" role="tab"
      aria-controls="nav-users" aria-selected="true">
      <i class="fas fa-user"></i>
        <span>Users</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-item nav-link" id="nav-comments-tab" data-toggle="tab" href="#nav-comments" role="tab"
      aria-controls="nav-comments" aria-selected="false">
      <i class="fas fa-comment"></i>
        <span>Comments</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-item nav-link" id="nav-events-tab" data-toggle="tab" href="#nav-events" role="tab"
      aria-controls="nav-events" aria-selected="false">
      <i class="fas fa-calendar"></i>
        <span>Events</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-item nav-link" id="nav-verify-tab" data-toggle="tab" href="#nav-verify" role="tab"
        aria-controls="nav-verify" aria-selected="false">
        <i class="fas fa-check-circle"></i>
                  <span>Verify</span></a>
      </li>
  </ul>
<div class="container">
    <div class="tab-content" id="nav-admintab">
      <div class="tab-pane fade show active" id="nav-users" role="tabpanel" aria-labelledby="nav-users-tab">
          <nav class="mb-2">
              <div class="nav nav-tabs mt-3" id="nav-admin" role="tablist">
                <a class="nav-item nav-link active" id="nav-users-tab" data-toggle="tab" href="#activeUsers" role="tab"
                  aria-controls="nav-users" aria-selected="true"><i class="fas fa-inbox"></i> Pending</a>
                <a class="nav-item nav-link" id="nav-comments-tab" data-toggle="tab" href="#archivedUsers" role="tab"
                  aria-controls="nav-comments" aria-selected="false"><i class="fas fa-archive"></i> Archived</a>
              </div>
            </nav>
        <div id="activeUsers" class="tab-pane fade show active">
        @foreach ($userReports as $rep)
          @include ('partials.user-report',['report'=>$rep])
        @endforeach
      </div> 
      <div id="archivedUsers" class="tab-pane fade">
          @foreach ($seenReports as $rep)
          @include ('partials.user-report',['report'=>$rep])
          @endforeach
        </div> 
      </div>  
      <div class="tab-pane fade" id="nav-comments" role="tabpanel" aria-labelledby="nav-comments-tab">
          <nav class="mb-2">
              <div class="nav nav-tabs mt-3" id="nav-admin" role="tablist">
                <a class="nav-item nav-link active" id="nav-users-tab" data-toggle="tab" href="#" role="tab"
                  aria-controls="nav-users" aria-selected="true"><i class="fas fa-inbox"></i> Pending</a>
                <a class="nav-item nav-link" id="nav-comments-tab" data-toggle="tab" href="#" role="tab"
                  aria-controls="nav-comments" aria-selected="false"><i class="fas fa-archive"></i> Archived</a>
              </div>
            </nav>
        
        <div class="container-fluid actionCard">
          <div class="report report-comment">
            <div class="card card-comment">
              <div class="card card-comment">
                <div class="description header">
                  <a href="userprofile.html"><img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap"></a>
                  <div class="headerText">
                    <span class="card-title"><a href="userprofile.html"><span class="link-username">username123</span></a>
                      reported
                      <a href="userprofile.html"><span class="link-username">username321's</span></a> comment on
                      <a href="eventpage.html"><span class="link-event">Tea
                          Party</span></a></span>
                    <p>"This comment is not true and this lie reflects
                      badly on my events."</p>
                    <span class="card-date">13 Mar 2019 • 16h33</span>
                  </div>

                </div>
                <div class="container-fluid actionCard">
                  <div class="card card-comment">
                    <div class="description header">
                      <img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap">
                      <div class="headerText">
                        <span class="card-title"><span class="link-username">username123</span> posted on <span class="link-event">Tea
                            Party</span></a></span>
                        <span class="card-date">13 Mar 2019 • 16h33</span>
                      </div>
                      <i class="far fa-flag"></i>
                    </div>
                    <div class="card-body">
                      <p class="card-text">Last time the food was really bad!!</p>
                    </div>
                    <div class="footer px-2">
                      <hr>
                      <div id="comments2" class="comments collapse mb-2 mt-3">
                        <div class="commentInput row">
                          <div class="col px-1">
                            <img class=" userAction roundRadius" src="../img/user.jpg" alt="Card image cap">
                            <textarea class="form-control roundRadius pl-5" id="exampleFormControlTextarea1" rows="1"
                              placeholder="Say something..."></textarea></div>
                          <div class="col-auto p-0">
                            <button class="commentButton  btn-primary roundRadius" type="button" aria-expanded="false">
                              <i class="fas fa-caret-right"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-comment-section ">
                            <div class="comment my-2">
                              <div class="row">
                                <img class="roundRadius" src="../img/user.jpg" alt="Card image cap">
                                <div class="col-10 align-self-center commentText roundRadius px-4 ml-1">
                                  <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                </div>
                              </div>
                            </div>
                            <div class="comment my-2">
                                <div class="row">
                                  <img class="roundRadius" src="../img/user.jpg" alt="Card image cap">
                                  <div class="col-10 align-self-center commentText roundRadius px-4 ml-1">
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                  </div>
                                </div>
                              </div>
                          </div>
                        <hr class="mt-4 mx-6">
                      </div>
                      <div class="footerText" data-toggle="collapse" href="#comments2" role="button" aria-expanded="false"
                        aria-controls="collapseExample">
                        <button>
                          <i class="far fa-comments"></i>
                          <span>67</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="footer">
                  <hr>
                  <div class="footerText">
                    <button><i class="fas fa-check"></i></button><button><i class="fas fa-trash-alt"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="nav-events" role="tabpanel" aria-labelledby="nav-events-tab">
      <nav class="mb-2">
              <div class="nav nav-tabs mt-3" id="nav-admin" role="tablist">
                <a class="nav-item nav-link active" id="nav-events-tab" data-toggle="tab" href="#activeEvents" role="tab"
                  aria-controls="nav-events" aria-selected="true"><i class="fas fa-inbox"></i> Pending</a>
                <a class="nav-item nav-link" id="nav-events-tab" data-toggle="tab" href="#archivedEvents" role="tab"
                  aria-controls="nav-events" aria-selected="false"><i class="fas fa-archive"></i> Archived</a>
              </div>
            </nav>
            <div id="activeEvents" class="tab-pane fade show active">
        @foreach ($eventReports as $rep)
          @include ('partials.event-report',['report'=>$rep])
        @endforeach
      </div> 
      <div id="archivedEvents" class="tab-pane fade">
          @foreach ($seenEventReports as $rep)
          @include ('partials.archived-event-report',['report'=>$rep])
          @endforeach
        </div> 
      </div>  

      <div class="tab-pane fade" id="nav-verify" role="tabpanel" aria-labelledby="nav-verify-tab">
        <div class="container-fluid actionCard">
          
        oi
        </div>
      </div>
    </div>
  </div>
</div>

  @endsection