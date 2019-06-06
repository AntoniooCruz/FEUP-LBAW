@extends('layouts.app')
@section('custom-scripts')
<link href="{{ asset('css/activityfeed.css') }}" rel="stylesheet">
@endsection
@section('content')
  <div id="carousel-container" class="container">
    <hr>
    <section class="c">
      <div class="card--content">
        <a href="./eventpage.html"><img class="d-block w-100" src="../img/event4.jpg" alt="First slide">
          <div class="card-img-overlay">
            <h5 class="card-title">Disco night</h5>
          </div>
        </a>
      </div>
      <div class="card--content">
        <a href="./eventpage.html"><img class="d-block w-100" src="../img/event5.jpg" alt="First slide">
          <div class="card-img-overlay">
            <h5 class="card-title">Brunch</h5>
          </div>
        </a>
      </div>
      <div class="card--content">
        <a href="./eventpage.html"><img class="d-block w-100" src="../img/event6.jpg" alt="First slide">
          <div class="card-img-overlay">
            <h5 class="card-title">Mary's BDay Party</h5>
          </div>
        </a>
      </div>
      <div class="card--content">
        <a href="./eventpage.html"><img class="d-block w-100" src="../img/event4.jpg" alt="First slide">
          <div class="card-img-overlay">
            <h5 class="card-title">Girls night out</h5>
          </div>
        </a>
      </div>
      <div class="card--content">
        <a href="./eventpage.html"><img class="d-block w-100" src="../img/event5.jpg" alt="First slide">
          <div class="card-img-overlay">
            <h5 class="card-title">Lunch with friends</h5>
          </div>
        </a>
      </div>
      <div class="card--content">
        <a href="./eventpage.html"><img class="d-block w-100" src="../img/event6.jpg" alt="First slide">
          <div class="card-img-overlay">
            <h5 class="card-title">John's 22nd</h5>
          </div>
        </a>
      </div>
    </section>
    <div id="highlights">
      <h4>#Trending</h4>
      <hr>
    </div>
  </div>
  <div id="feed">


    <div class="container-fluid actionCard">
      <div class="card card-comment">
        <div class="description header">
          <a href="userprofile.html"><img class="userAction roundRadius roundRadius" src="../img/user.jpg"
              alt="Card image cap"></a>
          <div class="headerText">
            <span class="card-title"><a href="userprofile.html"><span class="link-username">janedoe</span></a></a>
              posted on <a href="eventpage.html"><span class="link-event">Tea Party</span></a></span>
            <span class="card-date">13 Mar 2019 • 16h33</span>
          </div>
          <i class="far fa-flag"></i>

        </div>
        <img id="headerPic" class="card-img-top" src="../img/event5.jpg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">"What time should we be there?"</p>
        </div>
        <div class="footer">
          <hr>
          <div class="footerText">
            <button><i class="far fa-comments"></i></button>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid actionCard">
      <div class="card card-going-event">
        <div class="description header">
          <a href="userprofile.html"><img class="userAction roundRadius roundRadius" src="../img/user.jpg"
              alt="Card image cap"></a>
          <div class="headerText">
            <span class="card-title"><a href="userprofile.html"><span class="link-username">janedoe</span></a>
              created an event</span>
            <span class="card-date">13 Mar 2019 • 16h33</span>
          </div>
          <i class="far fa-flag"></i>
        </div>
      </div>
      <div class="invite card">
        <a href="./eventpage.html"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
        <span class="badge badge-pill badge-secondary card-category">night life</span>
        <div class="card-body" id="event-card-body">
          <div class="row header align-items-start">
            <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
              <div id="eventPageMonth" class="eventPageMonth">
                <span id="eventMonth" class="eventMonth">Jun</span>
              </div>
              <span id="eventPageDay" class="eventPageDay">09</span>
            </div>
            <div class="col-10 cardTitle text-left">
              <span id="event-card-title">Late night dancing</span>
              <div class="event-card-footer">
                <span id="event-card-hour">24:00</span>
                <p class="dot-separator"> • </p>
                <span id="card-adress"> Wallaby Way 42, Sydney</span>
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


    <div class="container-fluid actionCard">
      <div class="card card-poll">
        <div class="description header">
          <img class="userAction roundRadius " src="../img/user.jpg" alt="Card image cap">
          <div class="headerText">
            <span class="card-title"><a href="userprofile.html"><span class="link-username">janedoe</span></a>
              posted on <a href="eventpage.html"><span class="link-event">Tea
                  Party</span></a></span>
            <span class="card-date">13 Mar 2019 • 16h33</span>
          </div>
          <i class="far fa-flag"></i>

        </div>
        <img id="headerPic" class="card-img-top" src="../img/event4.jpg" alt="Card image cap">
        <div class="card-body">
          <div class="span6">
            <p>How are you going to travel there?</p>
            <div class="poll">
              <div>
                <div class="progress roundRadius">
                  <div class="form-check">
                    <input class="roundRadius form-check-input position-static form-radio" type="radio"
                      name="poll-option" id="poll-option1" value="option1" aria-label="Bus">
                  </div>
                  <div class="progress-bar bg-info" role="progressbar" style="width: 100%;" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div><span class="pollPerc">100 votes</span>
                  <span class="pollOption">Bus</span>
                </div>
              </div>
              <div class="progress roundRadius">
                <div class="form-check">
                  <input class="roundRadius form-check-input position-static form-radio" type="radio" name="poll-option"
                    id="poll-option2" value="option2" aria-label="...">
                </div>
                <div class="progress-bar bg-info" role="progressbar" style="width: 40%;" aria-valuenow="25"
                  aria-valuemin="0" aria-valuemax="100"></div><span class="pollPerc">40 votes</span>
                <span class="pollOption">Car</span>
              </div>
              <div class="progress roundRadius">
                <div class=" form-check">
                  <input class="roundRadius form-check-input position-static form-radio" type="radio" name="poll-option"
                    id="poll-option3" value="option3" aria-label="...">
                </div>
                <div class="progress-bar bg-info" role="progressbar" style="width: 10%;" aria-valuenow="25"
                  aria-valuemin="0" aria-valuemax="100"></div><span class="pollPerc">10 votes</span>
                <span class="pollOption">Subway</span>
              </div>
            </div>
          </div>
        </div>

        <div class="footer">
          <hr>
          <div class="footerText">
            <button><i class="far fa-comments"></i></button>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid actionCard">
      <div class="card card-upload">
        <div class="description header">
          <a href="userprofile.html"> <img class="userAction roundRadius" src="../img/user.jpg"
              alt="Card image cap"></a>
          <div class="headerText">
            <span class="card-title"><a href="userprofile.html"><span class="link-username">janedoe</span></a>
              uploaded a file on
              <a href="eventpage.html"><span class="link-event">Tea Party</span></a></span>
            <span class="card-date">13 Mar 2019 • 16h33</span>
          </div>
          <i class="far fa-flag"></i>
        </div>
        <img id="headerPic" class="card-img-top" src="../img/event5.jpg" alt="Card image cap">
        <div class="card-body">
          <p>Here you can find the food menu that will be available at the Tea Party!!! </a>
          </p>
          <div class="card-text card-file-uploaded"><a href="../files/Document.txt" target="_blank"><i
                class="far fa-file"></i>Document.txt</a>
          </div>
        </div>
        <div class="footer">
          <hr>
          <div class="footerText">
            <button><i class="far fa-comments"></i></button>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid actionCard">
      <div class="card card-upload-pic">
        <div class="description header">
          <a href="userprofile.html"> <img class="userAction roundRadius" src="../img/user.jpg"
              alt="Card image cap"></a>
          <div class="headerText">
            <span class="card-title"><a href="userprofile.html"><span class="link-username">janedoe</span></a>
              uploaded a file on
              <a href="eventpage.html"><span class="link-event">Tea Party</span></a></span>
            <span class="card-date">13 Mar 2019 • 16h33</span>
          </div>
          <i class="far fa-flag"></i>
        </div>
        <div class="card-body">
          <div class="card-text card-pic-uploaded"><a href="../img/preview.jpg"><img src="../img/preview.jpg"></a>
            <p>A photo of the food you can expect!! </a>
            </p>
          </div>
        </div>
        <div class="footer">
          <hr>
          <div class="footerText">
            <button><i class="far fa-comments"></i></button>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid actionCard">
      <div class="card card-going-event">
        <div class="description header">
          <a href="userprofile.html"><img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap"></a>
          <div class="headerText">
            <span class="card-title"><a href="userprofile.html"><span class="link-username">janedoe</span></a> is
              going to an event</span>
            <span class="card-date">13 Mar 2019 • 16h33</span>
          </div>
          <i class="far fa-flag"></i>
        </div>
      </div>
      <div class="invite card">
        <a href="./eventpage.html"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
        <span class="badge badge-pill badge-secondary card-category">night life</span>
        <div class="card-body" id="event-card-body">
          <div class="row header align-items-start">
            <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
              <div id="eventPageMonth" class="eventPageMonth">
                <span id="eventMonth" class="eventMonth">Jun</span>
              </div>
              <span id="eventPageDay" class="eventPageDay">09</span>
            </div>
            <div class="col-10 cardTitle text-left">
              <span id="event-card-title">Late night dancing</span>
              <div class="event-card-footer">
                <span id="event-card-hour">24:00</span>
                <p class="dot-separator"> • </p>
                <span id="card-adress"> Wallaby Way 42, Sydney</span>
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
                          <input type="text" class="form-control" id="validationTooltip03" placeholder="Street"
                            required>
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
                          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                            role="tab" aria-controls="pills-home" aria-selected="true">Free</a>
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
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                          aria-labelledby="pills-profile-tab">
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
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Discard</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
@endsection