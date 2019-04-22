@extends('layouts.app')

@section('content')

    @yield('navbar')

    <div class="parContainer row justify-content-center">
        <div id="profile_container" class="col-lg-3 col-12 container text-center">
          <img src="../img/jane.jpg">
          <div id="profile_content">
            <i class="far fa-flag"></i>
            <div id="header"></div>
            <div id="name" class="row justify-content-left">
              <div class="col text-left">
                <div class="row"><span>Jane Doe</span></div>
                <div class="row"><span id="username">@janedoe</span></div>
              </div>
              <div class="col-3 col text-right">
                <button id="follow_button" type="button" class="profile-pri-button btn btn-primary">Follow</button>
              </div>
            </div>
            <hr>
            <div class="stats row justify-content-center">
              <div id="followers" class="col text-center">
                <div></div><strong> 550 </strong>
                <small>Followers</small>
              </div>
              <div id="following" class="col text-center">
                <strong>245</strong>
                <small>Following</small>
              </div>
              <div id="events" class="col text-center">
                <strong>3</strong>
                <small>Events</small>
              </div>
    
            </div>
            <hr>
            <p id="description" class="row text-left">23 yeard old just making some plans. </p>
          </div>
        </div>
    
        <div id="events_container" class="col-lg-6 col-12 container text-left">
          <ul class="nav" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-active-tab" data-toggle="pill" href="#userevents" role="tab"
                aria-controls="pills-active" aria-selected="true">Jane Doe's events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-past-tab" data-toggle="pill" href="#attendingevents" role="tab" aria-controls="pills-past"
                aria-selected="false">Events attending</a>
            </li>
          </ul>
    
          <div class="tab-content" id="pills-tabContent">
            <div id="userevents" class="row justify-content-start tab-pane fade show active">
              <div class="col mt-4">
                <div class="invite card">
                  <a href="eventpage.html"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
                  <span class="badge badge-pill badge-secondary card-category">music</span>
                  <div class="card-body" id="event-card-body">
                    <div class="row eventRow header align-items-start">
                      <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
                        <div id="eventPageMonth" class="eventPageMonth">
                          <span id="eventMonth" class="eventMonth">Apr</span>
                        </div>
                        <span id="eventPageDay" class="eventPageDay">17</span>
                      </div>
                      <div class="col-10 cardTitle text-left">
                        <span id="event-card-title">Tea Party</span>
                        <div class="event-card-footer">
                          <span id="event-card-hour">21:00</span>
                          <p class="dot-separator"> • </p>
                          <span id="card-adress">Avenida Aliados 1100, Porto</span>
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
              <div class="col mt-4">
                <div class="invite card">
                  <a href="eventpage.html"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
                  <span class="badge badge-pill badge-secondary card-category">music</span>
                  <div class="card-body" id="event-card-body">
                    <div class="row eventRow header align-items-start">
                      <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
                        <div id="eventPageMonth" class="eventPageMonth">
                          <span id="eventMonth" class="eventMonth">Apr</span>
                        </div>
                        <span id="eventPageDay" class="eventPageDay">17</span>
                      </div>
                      <div class="col-10 cardTitle text-left">
                        <span id="event-card-title">Metallica </span>
                        <div class="event-card-footer">
                          <span id="event-card-hour">21:00</span>
                          <p class="dot-separator"> • </p>
                          <span id="card-adress">Avenida Aliados 1100, Porto</span>
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
              <div class="col mt-4">
                <div class="invite card">
                  <a href="eventpage.html"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
                  <span class="badge badge-pill badge-secondary card-category">music</span>
                  <div class="card-body" id="event-card-body">
                    <div class="row eventRow header align-items-start">
                      <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
                        <div id="eventPageMonth" class="eventPageMonth">
                          <span id="eventMonth" class="eventMonth">Apr</span>
                        </div>
                        <span id="eventPageDay" class="eventPageDay">17</span>
                      </div>
                      <div class="col-10 cardTitle text-left">
                        <span id="event-card-title">Xmas Party</span>
                        <div class="event-card-footer">
                          <span id="event-card-hour">21:00</span>
                          <p class="dot-separator"> • </p>
                          <span id="card-adress">Avenida Aliados 1100, Porto</span>
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
              <div class="col mt-4">
                <div class="invite card">
                  <a href="eventpage.html"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
                  <span class="badge badge-pill badge-secondary card-category">sport</span>
                  <div class="card-body" id="event-card-body">
                    <div class="row eventRow header align-items-start">
                      <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
                        <div id="eventPageMonth" class="eventPageMonth">
                          <span id="eventMonth" class="eventMonth">Mar</span>
                        </div>
                        <span id="eventPageDay" class="eventPageDay">03</span>
                      </div>
                      <div class="col-10 cardTitle text-left">
                        <span id="event-card-title">Queima das Fitas</span>
                        <div class="event-card-footer">
                          <span id="event-card-hour">13:00</span>
                          <p class="dot-separator"> • </p>
                          <span id="card-adress">Avenida Aliados 1100, Porto</span>
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
            <div id="attendingevents"  class="row justify-content-start tab-pane fade">
              <div class="col mt-4">
                <div class="invite card">
                  <a href="eventpage.html"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
                  <span class="badge badge-pill badge-secondary card-category">music</span>
                  <div class="card-body" id="event-card-body">
                    <div class="row eventRow header align-items-start">
                      <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
                        <div id="eventPageMonth" class="eventPageMonth">
                          <span id="eventMonth" class="eventMonth">Apr</span>
                        </div>
                        <span id="eventPageDay" class="eventPageDay">17</span>
                      </div>
                      <div class="col-10 cardTitle text-left">
                        <span id="event-card-title">Tea Party</span>
                        <div class="event-card-footer">
                          <span id="event-card-hour">21:00</span>
                          <p class="dot-separator"> • </p>
                          <span id="card-adress">Avenida Aliados 1100, Porto</span>
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
              <div class="col mt-4">
                <div class="invite card">
                  <a href="eventpage.html"><img src="../img/invite-card-event.jpg" class="card-img-top"></a>
                  <span class="badge badge-pill badge-secondary card-category">sport</span>
                  <div class="card-body" id="event-card-body">
                    <div class="row eventRow header align-items-start">
                      <div id="eventPagedate" class="eventPagedate col-xs align-self-center">
                        <div id="eventPageMonth" class="eventPageMonth">
                          <span id="eventMonth" class="eventMonth">Mar</span>
                        </div>
                        <span id="eventPageDay" class="eventPageDay">03</span>
                      </div>
                      <div class="col-10 cardTitle text-left">
                        <span id="event-card-title">Concerto</span>
                        <div class="event-card-footer">
                          <span id="event-card-hour">13:00</span>
                          <p class="dot-separator"> • </p>
                          <span id="card-adress">Avenida Aliados 1100, Porto</span>
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
                        <input type="text" id="inputName" class="form-control" placeholder="Event Title" required autofocus>
                      </div>
    
                      <div class="form-row m-0 py-1">
                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Description"
                          rows="3"></textarea>
                      </div>
    
                      <div class="form-row m-0 py-1">
                        <input type="text" id="inputName" class="form-control" placeholder="Datepicker" required autofocus>
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
                          <input type="text" class="form-control" id="validationTooltip05" placeholder="Zip Code" required>
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
                              <input type="text" class="form-control pl-0" id="inlineFormInputGroup" placeholder="Capacity">
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
                                  <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Capacity">
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