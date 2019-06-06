<div class="container-fluid actionCard">
      <div class="card card-comment">
        <div class="description header">
          <a href="{{ url('/profile/'.$item->owner->id_user) }}"><img class="userAction roundRadius roundRadius" src="../img/user.jpg"
              alt="Card image cap"></a>
          <div class="headerText">
            <span class="card-title"><a href="{{ url('/profile/'.$item->owner->id_user) }}"><span class="link-username">{{$item->owner->name}}</span></a></a>
              commented on <a href="{{ url('/event/'.$item->post->id_post) }}"><span class="link-event">{{$item->post->event->title}}</span></a></span>
            <span class="card-date">{{$item->date}}</span>
          </div>
          <i class="far fa-flag"></i>

        </div>
        <img id="headerPic" class="card-img-top" src="../img/event5.jpg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">"{{$item->text}}"</p>
        </div>
        <div class="footer">
          <hr>
          <div class="footerText">
            <button><i class="far fa-comments"></i></button>
          </div>
        </div>
      </div>
    </div>