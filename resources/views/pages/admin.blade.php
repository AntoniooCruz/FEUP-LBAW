@extends('layouts.app')

@section('custom-scripts')
  <link href="{{ asset('css/eventpage.css') }}" rel="stylesheet">
  <script type="text/javascript" src={{ asset('js/admin.js') }} defer></script>
  <script type="text/javascript" src={{ asset('js/profile.js') }} defer></script>
@endsection

@section('content')
<div class="container">
    <nav>
      <div class="nav nav-tabs" id="nav-admin" role="tablist">
        <a class="nav-item nav-link active" id="nav-users-tab" data-toggle="tab" href="#nav-users" role="tab"
          aria-controls="nav-users" aria-selected="true"><i class="fas fa-user"></i> Users</a>
        <a class="nav-item nav-link" id="nav-comments-tab" data-toggle="tab" href="#nav-comments" role="tab"
          aria-controls="nav-comments" aria-selected="false"><i class="fas fa-comment"></i> Comments</a>
        <a class="nav-item nav-link" id="nav-events-tab" data-toggle="tab" href="#nav-events" role="tab"
          aria-controls="nav-events" aria-selected="false"><i class="fas fa-calendar"></i> Events</a>
        <a class="nav-item nav-link" id="nav-verify-tab" data-toggle="tab" href="#nav-verify" role="tab"
          aria-controls="nav-verify" aria-selected="false"><i class="fas fa-check-circle"></i> Verify</a>
      </div>
    </nav>
    <div class="tab-content" id="nav-admintab">
      <div class="tab-pane fade show active" id="nav-users" role="tabpanel" aria-labelledby="nav-users-tab">
        @foreach ($userReports as $rep)
          @include ('partials.user-report',['report'=>$rep])
        @endforeach
      </div>  
      <div class="tab-pane fade" id="nav-comments" role="tabpanel" aria-labelledby="nav-comments-tab">
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
                    <p>"This comment is not related to the event"</p>
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
                      <p class="card-text">Dumbledore dies in book six</p>
                    </div>
                    <div class="footer px-2">
                      <hr>
                      <div id="comments1" class="comments collapse mb-2 mt-3">
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
                      <div class="footerText" data-toggle="collapse" href="#comments1" role="button" aria-expanded="false"
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
        <div class="container-fluid actionCard">
          <div class="report report-invite">
            <div class="row">
              <div class="col  mb-5 sm-12">
                <div class="description header">
                  <a href="userprofile.html"><img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap"></a>
                  <div class="headerText">
                    <span class="card-title"><a href="userprofile.html"><span class="link-username">username123</span></a>
                      reported
                      <a href="userprofile.html"><span class="link-username">username321's</span></a> event
                      <a href="eventpage.html"><span class="link-event">Tea
                          Party</span></a></span>
                    <p>"This is spam"</p>
                    <span class="card-date">13 Mar 2019 • 16h33</span>
                  </div>
                </div>
                <div class="footer">
                  <hr>
                  <div class="footerText">
                    <button><i class="fas fa-check"></i></button><button><i class="fas fa-trash-alt"></i></button>
                  </div>
                </div>
              </div>
              <div class="col  mb-7 sm-12">
                <div class="invite card">
                  <a href="eventpage.html"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
                  <span class="badge badge-pill badge-secondary card-category">Food</span>
                  <div class="card-body" id="event-card-body">
                    <div class="row eventRow header align-items-start">
                      <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
                        <div id="eventPageMonth" class="eventPageMonth">
                          <span id="eventMonth" class="eventMonth">Mar</span>
                        </div>
                        <span id="eventPageDay" class="eventPageDay">03</span>
                      </div>
                      <div class="col-md-7 col-sm-10 col-10 cardTitle">
                        <span id="event-card-title">Tea Party</span>
                        <div class="event-card-footer">
                          <span class="event-card-hour">12:00</span>
                          <p class="dot-separator"> • </p>
                          <span id="card-adress">adress 123, cidade</span>

                        </div>
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
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="nav-verify" role="tabpanel" aria-labelledby="nav-verify-tab">
        <div class="container-fluid actionCard">
          <div class="report report-company">
            <div class="card card-company">
              <div class="card card-company">
                <div class="description header">
                  <a href="companyprofile.html"><img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap"></a>
                  <div class="headerText">
                    <span class="card-title"><a href="companyprofile.html"><span class="link-username">Company123</span></a>
                      is pending verification
                      <span class="card-date">13 Mar 2019 • 16h33</span>
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
        <div class="container-fluid actionCard">
          <div class="report report-company">
            <div class="card card-company">
              <div class="card card-company">
                <div class="description header">
                  <a href="companyprofile.html"><img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap"></a>
                  <div class="headerText">
                    <span class="card-title"><a href="companyprofile.html"></a><span class="link-username">Company123</span></a>
                      is pending verification
                      <span class="card-date">13 Mar 2019 • 16h33</span>
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
        <div class="container-fluid actionCard">
          <div class="report report-company">
            <div class="card card-company">
              <div class="card card-company">
                <div class="description header">
                  <a href="companyprofile.html"><img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap"></a>
                  <div class="headerText">
                    <span class="card-title"><a href="companyprofile.html"></a><span class="link-username">Company123</span></a>
                      is pending verification
                      <span class="card-date">13 Mar 2019 • 16h33</span>
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
        <div class="container-fluid actionCard">
          <div class="report report-company">
            <div class="card card-company">
              <div class="card card-company">
                <div class="description header">
                  <a href="companyprofile.html"><img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap"></a>
                  <div class="headerText">
                    <span class="card-title"><a href="companyprofile.html"></a><span class="link-username">Company123</span></a>
                      is pending verification
                      <span class="card-date">13 Mar 2019 • 16h33</span>
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
    </div>
  </div>

  @endsection