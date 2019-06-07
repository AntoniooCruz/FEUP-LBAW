<div class="container-fluid actionCard">
  <span id="id_post" style="display:none;">{{$post->id_post}}</span>
        <div class="card card-comment">
          <div class="description header">
              @if (file_exists(public_path('img/users/originals/' . strval($post->id_author) . '.png')) )
              <a href="{{ url('/profile/'.$post->author->id_user) }}"><img class="userAction roundRadius" src="{{ asset("img/users/originals/" . strval($post->id_author) . ".png") }}" alt="Card image cap"></a>
                @else
                <a href="{{ url('/profile/'.$post->author->id_user) }}"><img class="userAction roundRadius" src= " {{asset("img/user.jpg")}} " alt="Card image cap"></a>
            @endif
            
            <div class="headerText">
              <span class="card-title"><a href="{{ url('/profile/'.$post->author->id_user) }}"><span class="link-username">{{$post->author->username}}</span></a>
            posted on <a href="{{ url('/event/'.$post->event->id_event) }}"><span class="link-event">{{$post->event->title}}</span></a></span>
              <span class="card-date">{{$post->date}}</span>
            </div>
            <i class="fab fa-font-awesome-flag dropdown-item" type= "button" style="text-align: right; width: 30px;padding-right: 10px" aria-expanded="false" data-toggle="modal" post="{{$post->id_post}}"
          data-target="#reportPostModal{{$post->id_post}}"></i>
          </div>
          <div class="card-body">
            <p class="card-text">{{$post->text}}</p>
            @if ($post->post_type == "Poll")
            <div class="poll">
                    @each ('partials.poll-option', $post->poll->pollOptions()->get(), 'pollOption')
                  </div>
                  @endif
                  @if ($post->post_type == "File")
                  <div class="file">
                          @each ('partials.file', $post->file()->get(), 'file')
                        </div>
                        @endif
          </div>
          <div class="footer px-2">
            <hr>
            <div id="comments1-{{$post->id_post}}" data-id={{$post->id_post}} class="comments collapse mb-2 mt-3">
            @if(Route::current()->getName() != 'home')
              <div class="commentInput row" data-id={{$post->id_post}}>
                <div class="col px-1">
                  @if (Auth::check())
                  @if (file_exists(public_path('img/users/originals/' . strval(Auth::user()->id_user) . '.png')) )
                      <img class="userAction roundRadius" src={{"../img/users/originals/" . strval(Auth::user()->id_user) . ".png"}} alt="Card image cap">
                    @else
                      <img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap">
                    @endif
                    @endif
          
                  <textarea id ="comment_data" data-id = {{$post->id_post}} class="form-control roundRadius pl-5" id="exampleFormControlTextarea1" rows="1"
                    placeholder="Say something..."></textarea></div>
                <div class="col-auto p-0">
                  <button id="add_comment_button" class="commentButton  btn-primary roundRadius" type="button" aria-expanded="false">
                    <i class="fas fa-caret-right"></i>
                  </button>
                </div>
              </div>
              @endif
              <div id="comment_section" data-id={{$post->id_post}} class="card-comment-section ">
              </div>
              <hr class="mt-4 mx-6">
            </div>
            <div class="footerText" data-toggle="collapse" href="#comments1-{{$post->id_post}}" role="button" aria-expanded="false"
              aria-controls="collapseExample">
              <button id="comment_button" data-id={{$post->id_post}} > 
                <i data-id={{$post->id_post}} class="far fa-comments"></i>
                <span>{{sizeof($post->comments()->get())}}</span>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="reportPostModal{{$post->id_post}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true" post="{{$post->id_post}}">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report Post</h5>
      </div>
      <div class="modal-body">
        <p>Help us undertand what's happening?</p>
        <fieldset class="form-group">
          <div class="form-check ml-2">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Content" checked>
            <label class="form-check-label" for="gridRadios1">
              Explicit content
            </label>
          </div>
          <div class="form-check ml-2">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Harassment">
            <label class="form-check-label" for="gridRadios2">
              Harassment
            </label>
          </div>
          <div class="form-check ml-2">
            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="Spam">
            <label class="form-check-label" for="gridRadios3">
              Spam
            </label>
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="form-check ml-2">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="other" aria-label="Radio button for following text input">
              </div>
            </div>
            <input type="text" class="form-control" aria-label="Text input with radio button" placeholder="Other">
          </div>
        </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger report-post" post="{{$post->id_post}}">Report</button>
      </div>
    </div>
  </div>
</div>