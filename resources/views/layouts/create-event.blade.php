<div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form  method="POST" action="{{ url('/createvent') }}">
                {{ csrf_field() }}
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    <select name="is_private" class="custom-select">
                      <option value="public" selected>Create public event</option>
                      <option value="private">Create private event</option>
                    </select>
                    @if ($errors->has('is_private'))
                    <span class="error ml-2">
                        {{ $errors->first('is_private') }}
                    </span>
                    @endif
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <span id="errors" style="display:none;">{{ sizeof($errors) }}</span>
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
                            <input type="text" id="eventTitle" class="form-control" name="title" placeholder="Event Title" 
                            value="{{ old('title') }}" required autofocus>
                              @if ($errors->has('title'))
                              <span class="error ml-2">
                                  {{ $errors->first('title') }}
                              </span>
                            @endif
                          </div>
      
                          <div class="form-row m-0 py-1">
                            <textarea class="form-control" value="{{ old('description') }}" id="exampleFormControlTextarea1" name="description" placeholder="Description"
                              rows="3"></textarea>
                              @if ($errors->has('description'))
                              <span class="error ml-2">
                                  {{ $errors->first('description') }}
                              </span>
                            @endif
                          </div>
      
                          <div class="form-row m-0 py-1">
                            <input type="text" id="eventdate" class="form-control" data-language="en" placeholder="Datepicker" name="date"
                            value="{{ old('date') }}" readonly='true' required autofocus>
                            @if ($errors->has('date'))
                              <span class="error ml-2">
                                  {{ $errors->first('date') }}
                              </span>
                            @endif
                          </div>
      
                          <div class="form-row py-1">
                            <div class="col">
                              <input type="text" class="form-control" id="inputStreet" placeholder="Street" name="street" value={{ old('street') }}>
                              @if ($errors->has('street'))
                              <span class="error ml-2">
                                  {{ $errors->first('street') }}
                              </span>
                              @endif
                            </div>
                          </div>
                          <div class="form-row py-1">  
                            <div class="col-md-4 mb-6">
                              <input type="text" class="form-control" id="inputCountry" placeholder="Country" name="country" value={{ old('country') }}>
                              @if ($errors->has('country'))
                              <span class="error ml-2">
                                  {{ $errors->first('country') }}
                              </span>
                              @endif
                            </div>
                            <div class="col-md-5 mb-6">
                                <input type="text" class="form-control" id="inputCity" placeholder="City" name="city" value={{ old('city') }}>
                                @if ($errors->has('city'))
                              <span class="error ml-2">
                                  {{ $errors->first('city') }}
                              </span>
                              @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" class="form-control" id="validationTooltip05" name="zip_code" placeholder="Zip Code" value={{ old('zip_code') }}>
                                @if ($errors->has('zip_code'))
                              <span class="error ml-2">
                                  {{ $errors->first('zip_code') }}
                              </span>
                              @endif
                            </div>
                          </div>
                          <div class="form-row py-1">  
                            <select name="category" class="col-md-6 custom-select" required>
                            @foreach ($categories as $category)
                              <option value={{$category->id_category}}>{{$category->name}}</option>
                            @endforeach
                            </select>
                            @if ($errors->has('category'))
                              <span class="error ml-2">
                                  {{ $errors->first('category') }}
                              </span>
                              @endif
                          </div>
                    
                        </div>
                      </div>
      
                      <div id="tickets" class="mt-5">
                        <span class="uppercase">Tickets</span>
                        <hr class="mb-3 mt-1">
                        <div id="tickets-content" class="py-3">
                          <ul class="justify-content-center mx-0 row nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="pills-free-tab" data-toggle="pill" href="#pills-free" role="tab"
                                aria-controls="pills-free" aria-selected="false">Free</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="pills-paid-tab" data-toggle="pill" href="#pills-free" role="tab"
                                aria-controls="pills-free" aria-selected="true">Paid</a>
                            </li>
                          </ul>
                          <div class="tab-content" id="pills-tabContent">
                              <div id="capacityDiv" class="form-row m-0 py-1">
                                <div class="col-6 input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text pl-0"><i class="fas fa-ticket-alt"></i></div>
                                  </div>
                                  <input type="text" class="form-control pl-0" id="capacity"
                                    placeholder="Capacity"  name="capacity" required>
                                    @if ($errors->has('capacity'))
                              <span class="error ml-2">
                                  {{ $errors->first('capacity') }}
                              </span>
                              @endif
                                </div>
                                <div id="pricePticket" class="col-6 input-group mb-2" style="display:none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text pl-0"><i class="fas fa-euro-sign"></i></div>
                                  </div>
                                  <input type="text" class="form-control pl-0" id="price"
                                  name="price" placeholder="Price p/ ticket">
                                  @if ($errors->has('price'))
                              <span class="error ml-2">
                                  {{ $errors->first('price') }}
                              </span>
                              @endif
                                </div>
                              </div>
                              <div class="row px-5">
                                <input class="form-check-input" type="checkbox" id="unlimitedTickets"  name="unlimited">
                                <label class="form-check-label" for="unlimitedTickets">Unlimited</label>
                                @if ($errors->has('unlimited'))
                              <span class="error ml-2">
                                  {{ $errors->first('unlimited') }}
                              </span>
                              @endif
                              </div>
                          </div>
                        </div>
                      </div>
                      <div id="invitefriends" class="mt-5">
                        <span class="uppercase">Invite Friends</span>
                        <hr class="mb-3 mt-1">
                        <fieldset id="friends-content" class="py-3">
                          <div class="friendList py-3">
                            @if(Auth::user())
                            @foreach (Auth::user()->following as $friend)
                            <div class="input-group mb-1 row justify-content-center mx-0">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <img src="../img/user.jpg" class="roundRadius">
                                  <span class="ml-2">@<span>{{$friend->username}}</span></span>
                                </div>
                              </div>
                              <div class="input-group-append">
                                <div class="input-group-text">
                                  <input type="checkbox" value={{$friend->id_user}} name="invites[]">
                                  @if ($errors->has('invites[]'))
                              <span class="error ml-2">
                                  {{ $errors->first('invites[]') }}
                              </span>
                              @endif
                                </div>
                              </div>
                            </div>
                            @endforeach
                            @endif
                          </div>
                        </fieldset>
                      </div>
                    </div>
                    <div id="createEntBtn">
                        <button id="createBtn" type="submit" class="btn btn-primary">Create</button>
                        <button id="cancelBtn" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div> 
              </form> 
            </div>
          </div>
        </div>