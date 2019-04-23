@extends('layouts.app')

@section('content')

<section id="event" class="event container">
        <div class="eventPhoto justify-content-md-center">
          <div id="floatingLabels">
            @if($event->isPrivate)<span id="privateIndicator" class="label"> <i class="fas fa-lock"></i></span>@endif
            <span id="categoryIndicator" class="label"> {{$eventCategoryName}}</span>
          </div>
          <img src="../img/eventbanner.jpg">
        </div>
    
        <div class="eventRow row">
          <div class="col-lg-9 col-md-8 col-sm-12">
            <div class="row header align-items-start">
              <div id="eventPagedate" class="col-xs align-items-start">
                <div id="eventPageMonth">
                  <span class="eventMonth">Mar</span>
                </div>
                <span id="eventPageDay">03</span>
              </div>
              <div id="titleHeader" class="col">
              <h2 id="eventTitle">{{$event->title}}</h2>
                <div>
                  <span id="#created" class="eventDate">Created by <span class="ownerUsername"><a
                        href="userprofile.html">{{$eventCreator}}</a></span></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2  col-md-3 col-sm-12 getTicket text-right pr-1">
            <button class="btn btn-primary" type="button" aria-expanded="false">
              <i class="fas fa-ticket-alt"></i> {{$event->price}}€
            </button>
          </div>
          <div class="col-lg-1  col-md-1 col-sm-12 getTicket text-right">
            <button class="reportBtn btn-outline-secondary" type="button" aria-expanded="false" data-toggle="modal"
              data-target="#reportEventModal">
              <i class="far fa-flag"></i>
            </button>
          </div>
        </div>
    
        <div class="eventRow details">
          <div class="row detailsHeader justify-content-center">
            <button class="detailsButton btn-no" type="button" data-toggle="collapse" data-target="#collapseContentDets"
              aria-expanded="true" aria-controls="collapseOne">
              Details <i class="fas fa-caret-down"></i>
            </button>
          </div>
          <div id="collapseContentDets" class="row collapse">
            <div class="col-lg-4 col-sm-12 ">
              <div id="dateNhours">
                <h6><i class="far fa-calendar-alt"></i> Date & Hours</h6>
                <span>03 de Março 2019</span>
                <span>14h30 - 16h30</span>
              </div>
    
              <div id="location">
                <h6><i class="fas fa-map-marker-alt"></i> Location</h6>
                <span>{{$event->location}}</span>
                <span>Porto</span>
              </div>
            </div>
            <div class="col">
              <h6><i class="fas fa-info-circle"></i> Description</h6>
              <p> {{$event->description}} </p>
            </div>
          </div>
        </div>
    
        <hr>
        <section class="discussion row">
          <div class="leftCol col-lg-4 col-md-12">
            <div id="attendance" class="container sticky-top">
              <div class="row justify-content-center">
                <h6>Attendance</h6>
                <button class="btn-no attendanceButton" type="button" data-toggle="collapse" data-target="#collapseContent"
                  aria-expanded="true" aria-controls="collapseOne">
                  Attendance <i class="fas fa-caret-down"></i>
                </button>
              </div>
              <section id="collapseContent" class="collapse">
                <div class="lotation row align-self-center justify-content-center">
                  <img class="graph" src="../img/graphTemplate.png">
                  <div class="col-auto align-self-center">
                  <span class="row">Capacity: {{$event->capacity}}</span>
                    <span class="row">Taken: {{$eventSoldTicketsCount}}</span>
                    <span class="row">Left: {{$event->capacity - $eventSoldTicketsCount}} </span>
                  </div>
                </div>
                <div class="userPics">
                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#friendsGoing"
                        role="tab" aria-controls="nav-profile" aria-selected="false">All(86)</a>
                      <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#allGoing" role="tab"
                        aria-controls="nav-home" aria-selected="true">Friends(36)</a>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade" id="allGoing" role="tabpanel" aria-labelledby="nav-home-tab">
                      <div class="row justify-content-center">
                        <img class="userPic" src="../img/user.jpg">
                        <img class="userPic" src="../img/user.jpg">
                        <img class="userPic" src="../img/user.jpg">
                        <img class="userPic" src="../img/user.jpg">
                        <img class="userPic" src="../img/user.jpg">
                        <img class="userPic" src="../img/user.jpg">
                        <img class="userPic" src="../img/user.jpg">
                        <a a href="#">
                          <img class="userPic-more" src="../img/user.jpg">
                          <i class="fas fa-circle"></i>
                          <i class="fas fa-ellipsis-h"></i>
                        </a>
                      </div>
                    </div>
                    <div class="tab-pane fade show active" id="friendsGoing" role="tabpanel" aria-labelledby="nav-home-tab">
                      <div class="row justify-content-center">
                        <img class="userPic" src="../img/user.jpg">
                        <img class="userPic" src="../img/user.jpg">
                        <img class="userPic" src="../img/user.jpg">
                        <img class="userPic" src="../img/user.jpg">
                        <img class="userPic" src="../img/user.jpg">
                        <img class="userPic" src="../img/user.jpg">
                        <img class="userPic" src="../img/user.jpg">
                        <a a href="#">
                          <img class="userPic-more" src="../img/user.jpg">
                          <i class="fas fa-circle"></i>
                          <i class="fas fa-ellipsis-h"></i>
                        </a>
                      </div>
                    </div>
                  </div>
              </section>
            </div>
          </div>
          </div>
          <div class="rightCol col-auto col-md-12">
            <div class="commentArea">
              <h6></h6>
              <img id="commentPic" class="roundRadius" src="../img/user.jpg">
              <div class="comment row">
                <div class="col-12 form-group">
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                    placeholder="Say something..."></textarea>
                  <hr>
                </div>
                <div class="options mb-1 pl-3">
                  <button class="" type="button" aria-expanded="false">
                    <i class="fas fa-poll-h"></i>
                  </button>
                  <button class="" type="button" aria-expanded="false">
                    <i class="fas fa-cloud-upload-alt"></i>
                  </button>
                </div>
              </div>
              <button class="commentButton  btn-primary roundRadius" type="button" aria-expanded="false">
                <i class="fas fa-caret-right"></i>
              </button>
            </div>
            <hr>
            <div id="#posts">
              <div class="container-fluid actionCard">
                <div class="card card-comment">
                  <div class="description header">
                    <img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap">
                    <div class="headerText">
                      <span class="card-title"><a href="userprofile.html"><span class="link-username">username123</span></a>
                        posted on <a href="eventpage.html"><span class="link-event">Tea
                            Party</span></a></span>
                      <span class="card-date">13 Mar 2019 • 16h33</span>
                    </div>
                    <i class="far fa-flag"></i>
                  </div>
                  <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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
                            <div class="reply row justify-content-end mr-4">
                                Reply
                              </div>
                          </div>
                          <div class="comment my-2">
                              <div class="row">
                                <img class="roundRadius" src="../img/user.jpg" alt="Card image cap">
                                <div class="col-10 align-self-center commentText roundRadius px-4 ml-1">
                                  <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                </div>
                              </div>
                              <div class="reply row justify-content-end mr-4">
                                  Reply
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
              <div class="container-fluid actionCard">
                <div class="card card-upload">
                  <div class="description header">
                    <img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap">
                    <div class="headerText">
                      <span class="card-title"><a href="userprofile.html"><span class="link-username">username123</span></a>
                        uploaded a file on
                        <a href="eventpage.html"><span class="link-event">Tea Party</span></a></span>
                      <span class="card-date">13 Mar 2019 • 16h33</span>
                    </div>
                    <i class="far fa-flag"></i>
                  </div>
                  <div class="card-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce mi sem, condimentum vel metus
                      eget, maximus dignissim orci. Cras et arcu pharetra, eleifend lacus eu, semper sapien. Donec
                      tristique metus leo, ac lacinia arcu interdum eget. </a>
                    </p>
                    <div class="card-text card-file-uploaded"><a href="../files/Document.txt" target="_blank"><i
                          class="far fa-file"></i>Document.txt</a>
                    </div>
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
                            <div class="reply row justify-content-end mr-4">
                                Reply
                              </div>
                          </div>
                          <div class="comment my-2">
                              <div class="row">
                                <img class="roundRadius" src="../img/user.jpg" alt="Card image cap">
                                <div class="col-10 align-self-center commentText roundRadius px-4 ml-1">
                                  <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                </div>
                              </div>
                              <div class="reply row justify-content-end mr-4">
                                  Reply
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
            </div>
            <div class="container-fluid actionCard">
              <div class="card card-upload-pic">
                <div class="description header">
                  <img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap">
                  <div class="headerText">
                    <span class="card-title"><a href="userprofile.html"><span class="link-username">username123</span></a>
                      uploaded a file on
                      <span class="card-date">13 Mar 2019 • 16h33</span>
                  </div>
                  <i class="far fa-flag"></i>
                </div>
                <div class="card-body">
                  <div class="card-text card-pic-uploaded"><a href="../img/preview.jpg"><img src="../img/preview.jpg"></a>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce mi sem, condimentum vel metus
                      eget, maximus dignissim orci. Cras et arcu pharetra, eleifend lacus eu, semper sapien. Donec
                      tristique metus leo, ac lacinia arcu interdum eget. </a>
                    </p>
                  </div>
                </div>
                <div class="footer px-2">
                  <hr>
                  <div id="comments3" class="comments collapse mb-2 mt-3">
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
                          <div class="reply row justify-content-end mr-4">
                              Reply
                            </div>
                        </div>
                        <div class="comment my-2">
                            <div class="row">
                              <img class="roundRadius" src="../img/user.jpg" alt="Card image cap">
                              <div class="col-10 align-self-center commentText roundRadius px-4 ml-1">
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                              </div>
                            </div>
                            <div class="reply row justify-content-end mr-4">
                                Reply
                              </div>
                          </div>
                      </div>
                    <hr class="mt-4 mx-6">
                  </div>
                  <div class="footerText" data-toggle="collapse" href="#comments3" role="button" aria-expanded="false"
                    aria-controls="collapseExample">
                    <button>
                      <i class="far fa-comments"></i>
                      <span>67</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="container-fluid actionCard">
              <div class="card card-poll">
                <div class="description header">
                  <img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap">
                  <div class="headerText">
                    <span class="card-title"><a href="userprofile.html"><span class="link-username">username123</span></a>
                      posted on <a href="eventpage.html"><span class="link-event">Tea
                          Party</span></a></span>
                    <span class="card-date">13 Mar 2019 • 16h33</span>
                  </div>
                  <i class="far fa-flag"></i>
                </div>
                <div class="card-body">
                  <div class="span6">
                    <h5>How are you going to travel there?</h5>
                    <hr>
                    <div class="poll">
                      <div>
                        <div class="progress roundRadius">
                          <div class="form-check">
                            <input class="roundRadius form-check-input position-static form-radio" type="radio"
                              name="poll-option" id="poll-option1" value="option1" aria-label="Bus">
                          </div>
                          <div class="progress-bar bg-info" role="progressbar" style="width: 100%;" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div><span class="pollPerc">100%</span>
                          <span class="pollOption">Bus</span>
                        </div>
                      </div>
                      <div class="progress roundRadius">
                        <div class="form-check">
                          <input class="roundRadius form-check-input position-static form-radio" type="radio"
                            name="poll-option" id="poll-option2" value="option2" aria-label="...">
                        </div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: 40%;" aria-valuenow="25"
                          aria-valuemin="0" aria-valuemax="100"></div><span class="pollPerc">40%</span>
                        <span class="pollOption">Car</span>
                      </div>
                      <div class="progress roundRadius">
                        <div class=" form-check">
                          <input class="roundRadius form-check-input position-static form-radio" type="radio"
                            name="poll-option" id="poll-option3" value="option3" aria-label="...">
                        </div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: 10%;" aria-valuenow="25"
                          aria-valuemin="0" aria-valuemax="100"></div><span class="pollPerc">10%</span>
                        <span class="pollOption">Subway</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="footer px-2">
                  <hr>
                  <div id="comments4" class="comments collapse mb-2 mt-3">
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
                          <div class="reply row justify-content-end mr-4">
                              Reply
                            </div>
                        </div>
                        <div class="comment my-2">
                            <div class="row">
                              <img class="roundRadius" src="../img/user.jpg" alt="Card image cap">
                              <div class="col-10 align-self-center commentText roundRadius px-4 ml-1">
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                              </div>
                            </div>
                            <div class="reply row justify-content-end mr-4">
                                Reply
                              </div>
                          </div>
                      </div>
                    <hr class="mt-4 mx-6">
                  </div>
                  <div class="footerText" data-toggle="collapse" href="#comments4" role="button" aria-expanded="false"
                    aria-controls="collapseExample">
                    <button>
                      <i class="far fa-comments"></i>
                      <span>67</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </section>
      </section>
    
      <div class="modal fade" id="reportEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Report Event</h5>
            </div>
            <div class="modal-body">
              <p>Help us undertand what's happening?</p>
              <fieldset class="form-group">
                <div class="form-check ml-2">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                  <label class="form-check-label" for="gridRadios1">
                    Explicit content
                  </label>
                </div>
                <div class="form-check ml-2">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                  <label class="form-check-label" for="gridRadios2">
                    Harassment
                  </label>
                </div>
                <div class="form-check ml-2">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
                  <label class="form-check-label" for="gridRadios3">
                    Spam
                  </label>
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text pl-2">
                      <input type="radio" aria-label="Radio button for following text input">
                    </div>
                  </div>
                  <input type="text" class="form-control" aria-label="Text input with radio button" placeholder="Other">
                </div>
              </fieldset>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger">Report</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                  <select class="custom-select">
                    <option selected>Create public event</option>
                    <option>Create private event</option>
                  </select>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate>
                  <div class="eventPhoto justify-content-md-center">
                    <img src="../img/event-placeholder.png">
                    <span class="col-sm-2 col-3 btn btn-secondary btn-file form-control-file"
                      id="exampleFormControlFile1">Upload
                      <input type="file"></span>
                  </div>
                  <div class="p-3">
                    <div id="details" class="mt-5">
                      <span class="uppercase">Details</span>
                      <hr class="mb-3 mt-1">
                      <div id="details-content" class="py-3">
                        <div class="form-row m-0 py-1">
                          <input type="text" id="inputName" class="form-control" placeholder="Event Title" required
                            autofocus>
                        </div>
    
                        <div class="form-row m-0 py-1">
                          <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Description"
                            rows="3"></textarea>
                        </div>
    
                        <div class="form-row m-0 py-1">
                          <input type="text" id="inputName" class="form-control" placeholder="Datepicker" required
                            autofocus>
                        </div>
    
                        <div class="form-row py-1">
                          <div class="col-md-6 mb-6">
                            <input type="text" class="form-control" id="validationTooltip03" placeholder="Street" required>
                          </div>
                          <div class="col-md-3 mb-3">
                            <select class="custom-select">
                              <option selected disabled>City</option>
                              <option value="1">One</option>
                              <option value="2">Two</option>
                              <option value="3">Three</option>
                            </select>
                          </div>
                          <div class="col-md-3 mb-3">
                            <input type="text" class="form-control" id="validationTooltip05" placeholder="Zip Code"
                              required>
                          </div>
                        </div>
                      </div>
                    </div>
    
                    <div id="tickets" class="mt-5">
                      <span class="uppercase">Tickets</span>
                      <hr class="mb-3 mt-1">
                      <div id="tickets-content" class="py-3">
                        <ul class="justify-content-center mx-0 row nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                              aria-controls="pills-home" aria-selected="true">Free</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                              aria-controls="pills-profile" aria-selected="false">Paid</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="form-row m-0 py-1">
                              <div class="col-6 input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text pl-0"><i class="fas fa-ticket-alt"></i></div>
                                </div>
                                <input type="text" class="form-control pl-0" id="inlineFormInputGroup"
                                  placeholder="Capacity">
                              </div>
                              <div class="col-6 input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text pl-0"><i class="fas fa-euro-sign"></i></div>
                                </div>
                                <input type="text" class="form-control pl-0" id="inlineFormInputGroup"
                                  placeholder="Price p/ ticket">
                              </div>
                            </div>
                            <div class="row px-5">
                              <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                              <label class="form-check-label" for="autoSizingCheck">Unlimited</label>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                              aria-labelledby="pills-home-tab">
                              <div class="form-row m-0 py-1">
                                <div class="col-6 form-row m-0 py-1">
                                  <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text pl-0"><i class="fas fa-ticket-alt"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                      placeholder="Capacity">
                                  </div>
                                </div>
                              </div>
                              <div class="row px-5">
                                <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                                <label class="form-check-label" for="autoSizingCheck">Unlimited</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="invitefriends" class="mt-5">
                      <span class="uppercase">Invite Friends</span>
                      <hr class="mb-3 mt-1">
                      <div id="friends-content" class="py-3">
                        <div class="friendList py-3">
                          <div class="input-group mb-1 row justify-content-center mx-0">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <img src="../img/user.jpg" class="roundRadius">
                                <span class="ml-2">@username </span>
                              </div>
                            </div>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                              </div>
                            </div>
                          </div>
                          <div class="input-group mb-1 row justify-content-center mx-0">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <img src="../img/user.jpg" class="roundRadius">
                                <span class="ml-2">@username </span>
                              </div>
                            </div>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                              </div>
                            </div>
                          </div>
                          <div class="input-group mb-1 row justify-content-center mx-0">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <img src="../img/user.jpg" class="roundRadius">
                                <span class="ml-2">@username </span>
                              </div>
                            </div>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                              </div>
                            </div>
                          </div>
                          <div class="input-group mb-1 row justify-content-center mx-0">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <img src="../img/user.jpg" class="roundRadius">
                                <span class="ml-2">@username </span>
                              </div>
                            </div>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        @endsection

