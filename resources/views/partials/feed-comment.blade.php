<div class="container-fluid actionCard">
      <div class="card card-comment">
      <div class="description header">
              @if (file_exists(public_path('img/users/originals/' . $item->owner->id_user . '.png')) )
              <a href="{{ url('/profile/'.$item->owner->id_user) }}"><img class="userAction roundRadius" src="{{ asset("img/users/originals/" . $item->owner->id_user . ".png") }}" alt="User photo"></a>
                @else
                <a href="{{ url('/profile/'.$item->owner->id_user) }}"><img class="userAction roundRadius" src= " {{asset("img/user.jpg")}} " alt="User photo"></a>
            @endif
            
            <div class="headerText">
              <span class="card-title"><a href="{{ url('/profile/'.$item->owner->id_user) }}"><span class="link-username">{{$item->owner->username}}</span></a>
            commented on <a href="{{ url('/event/'.$item->post->event->id_event) }}"><span class="link-event">{{$item->post->event->title}}</span></a></span>

              <span class="card-date">{{$item->date}}</span>
            </div>
            <i class="fab fa-font-awesome-flag"></i>
          </div>
          <div class="card-body">
          <p class="card-text">"{{$item->text}}"</p>
        </div>
        @include('partials.post', ['post'=>$item->post])
        
      </div>
    </div>