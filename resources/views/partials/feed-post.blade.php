
@if($item->post_type == "File" || $item->post_type == "")
<div class="container-fluid actionCard">
      <div class="card card-upload-pic">
        <div class="description header">
          <a href="{{ url('/profile/'.$item->author->id_user) }}"> <img class="userAction roundRadius" src="../img/user.jpg"
              alt="Card image cap"></a>
          <div class="headerText">
            <span class="card-title"><a href="{{ url('/profile/'.$item->author->id_user) }}"><span class="link-username">{{$item->author->name}}</span></a>
            @if($item->post_type == "")
            posted on
            @endif  
            @if($item->post_type == "File")
            uploaded a file on
            @endif
              <a href="{{ url('/event/'.$item->event->id_event) }}"><span class="link-event">{{$item->event->title}}</span></a></span>
            <span class="card-date">{{$item->date}}</span>
          </div>
          <i class="far fa-flag"></i>
        </div>
        <div class="card-body">
        @if($item->post_type == "File")
            
          <div class="card-text card-pic-uploaded"><a href="../img/preview.jpg"><img src="../img/preview.jpg"></a>
            @endif  
          <p>{{$item->text}}</a>
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
@endif
@if($item->post_type == "Poll")
     <div class="container-fluid actionCard">
      <div class="card card-poll">
        <div class="description header">
          <img class="userAction roundRadius " src="../img/user.jpg" alt="Card image cap">
          <div class="headerText">
            <span class="card-title"><a href="{{ url('/profile/'.$item->author->id_user) }}"><span class="link-username">{{$item->author->name}}</span></a>
              posted on <a href="{{ url('/event/'.$item->id_event) }}"><span class="link-event">{{$item->event->title}}</span></a></span>
            <span class="card-date">{{$item->date}}</span>
          </div>
          <i class="far fa-flag"></i>

        </div>
        <img id="headerPic" class="card-img-top" src="../img/event4.jpg" alt="Card image cap">
        <div class="card-body">
          <div class="span6">
            <p>{{$item->text}}</p>
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
    @endif