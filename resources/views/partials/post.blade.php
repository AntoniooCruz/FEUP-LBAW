<div class="container-fluid actionCard">
  <span id="id_post" style="display:none;">{{$post->id_post}}</span>
        <div class="card card-comment">
          <div class="description header">
              @if (file_exists(public_path('img/users/originals/' . strval($post->id_author) . '.png')) )
              <img class="userAction roundRadius" src="{{ asset("img/users/originals/" . strval($post->id_author) . ".png") }}" alt="Card image cap">
                @else
              <img class="userAction roundRadius" src= " {{asset("img/user.jpg")}} " alt="Card image cap">
            @endif
            
            <div class="headerText">
              <span class="card-title"><a href="{{ url('/profile/'.$post->author->id_user) }}"><span class="link-username">{{$post->author->username}}</span></a>
            posted on <a href="{{ url('/event/'.$post->event->id_event) }}"><span class="link-event">{{$post->event->title}}</span></a></span>
              <span class="card-date">{{$post->date}}</span>
            </div>
            <i class="fab fa-font-awesome-flag"></i>
          </div>
          <div class="card-body">
            <p class="card-text">{{$post->text}}</p>
            @if ($post->post_type == 'Poll')
            <div class="poll">
                    @each ('partials.poll-option', $post->poll->pollOptions()->get(), 'pollOption')
                  </div>
                  @endif
          </div>
          <div class="footer px-2">
            <hr>
            <div id="comments1-{{$post->id_post}}" data-id={{$post->id_post}} class="comments collapse mb-2 mt-3">
              <div class="commentInput row" data-id={{$post->id_post}}>
                <div class="col px-1">
                  @if (file_exists(public_path('img/users/originals/' . strval(Auth::user()->id_user) . '.png')) )
                      <img class="userAction roundRadius" src={{"../img/users/originals/" . strval(Auth::user()->id_user) . ".png"}} alt="Card image cap">
                    @else
                      <img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap">
                    @endif
          
                  <textarea id ="comment_data" data-id = {{$post->id_post}} class="form-control roundRadius pl-5" id="exampleFormControlTextarea1" rows="1"
                    placeholder="Say something..."></textarea></div>
                <div class="col-auto p-0">
                  <button id="add_comment_button" class="commentButton  btn-primary roundRadius" type="button" aria-expanded="false">
                    <i class="fas fa-caret-right"></i>
                  </button>
                </div>
              </div>
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
      