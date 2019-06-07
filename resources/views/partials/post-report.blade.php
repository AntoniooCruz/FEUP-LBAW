<div id="{{$report->id_report}}" class="container-fluid actionCard">
  <div class="report report-user">
    <div class="card card-user">
        <div class="description card-header">
          <span class="id_report" style="display:none;">{{$report->id_report}}</span>
          <a href="{{ url('/profile/'.$report->reporter->id_user) }}"><img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap"></a>
          <div class="headerText">
            <span class="card-title"><a href="{{ url('/profile/'.$report->reporter->id_user) }}"><span
                  class="link-username">{{$report->reporter->username}}</span></a>
              reported
              <a href="{{ url('/profile/'.$report->post->author->id_user) }}"><span class="link-username">{{$report->post->author->name}}`s</span></a> post</span>
          </div>
          
        </div>
        <div class="card-body">

        <div class="container-fluid actionCard">
        <div class="card card-comment">
          <div class="description header">
              @if (file_exists(public_path('img/users/originals/' . strval($report->post->id_author) . '.png')) )
              <a href="{{ url('/profile/'.$report->post->author->id_user) }}"><img class="userAction roundRadius" src="{{ asset("img/users/originals/" . strval($report->post->id_author) . ".png") }}" alt="Card image cap"></a>
                @else
                <a href="{{ url('/profile/'.$report->post->author->id_user) }}"><img class="userAction roundRadius" src= " {{asset("img/user.jpg")}} " alt="Card image cap"></a>
            @endif
            
            <div class="headerText">
              <span class="card-title"><a href="{{ url('/profile/'.$report->post->author->id_user) }}"><span class="link-username">{{$report->post->author->username}}</span></a>
            posted on <a href="{{ url('/event/'.$report->post->event->id_event) }}"><span class="link-event">{{$report->post->event->title}}</span></a></span>
              <span class="card-date">{{$report->post->date}}</span>
            </div>
          </div>
          <div class="card-body">
            <p class="card-text">{{$report->post->text}}</p>
            @if ($report->post->post_type == "Poll")
            <div class="poll">
                    @each ('partials.poll-option', $report->post->poll->pollOptions()->get(), 'pollOption')
                  </div>
                  @endif
                  @if ($report->post->post_type == "File")
                  <div class="file">
                          @each ('partials.file', $report->post->file()->get(), 'file')
                        </div>
                        @endif
          </div>
          <div class="footer px-2">
            <hr>
            <div id="comments1-{{$report->post->id_post}}" data-id={{$report->post->id_post}} class="comments collapse mb-2 mt-3">
            @if(Route::current()->getName() != 'home')
              <div class="commentInput row" data-id={{$report->post->id_post}}>
                <div class="col px-1">
                  @if (Auth::check())
                  @if (file_exists(public_path('img/users/originals/' . strval(Auth::user()->id_user) . '.png')) )
                      <img class="userAction roundRadius" src={{"../img/users/originals/" . strval(Auth::user()->id_user) . ".png"}} alt="Card image cap">
                    @else
                      <img class="userAction roundRadius" src="../img/user.jpg" alt="Card image cap">
                    @endif
                    @endif
          
              </div>
                
              </div>
              @endif
              
              
            </div>
            
          </div>
        </div>
      </div>
        </div>
        <div class="card-body">

          <p><b>Reason:</b> "{{$report->report->reason}}"</p>
        </div>
      <div class="footer">
        <hr>
        <div id="footer{{$report->id_report}}" class="footerText">
         @if($report->report->veridict=='Pending') 
          <button repid="{{$report->id_report}}" class="banUser"><i class="fas fa-check"></i></button>´
          <button archid="{{$report->id_report}}" class="archiveUser"><i class="fas fa-trash-alt"></i></button>
          @elseif($report->report->veridict=='Approved') Approved by {{$report->report->admin->name}}
          @elseif($report->report->veridict=='Ignored')Ignored by {{$report->report->admin->name}}
          @endif
        </div>
      </div>
  </div>
</div>
</div>
