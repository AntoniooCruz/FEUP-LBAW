@extends('layouts.app')
@section('custom-scripts')
<link href="{{ asset('css/activityfeed.css') }}" rel="stylesheet">
<script type="text/javascript" src={{ asset('js/date.js') }} defer></script>
@endsection
@section('content')

  <div id="carousel-container" class="container">
    <hr>
    
    <section class="c">
    @foreach ($trending as $event)
      <div class="card--content">
        <a href="{{ url('/event/'.$event->id_event) }}"><img class="d-block w-100" src="../img/event3.jpg" alt="First slide">
          <div class="card-img-overlay">
            <h5 class="card-title">{{$event->title}}</h5>
          </div>
        </a>
      </div>
      @endforeach

    </section>
    <div id="highlights">
      <h4>#Trending</h4>
      <hr>
    </div>
  </div>
  <div id="feed" class="px-3">
  @foreach ($items as $item)
  @if(is_a($item,'App\Ticket'))
      @include('partials.feed-ticket', [$item,'usersGoing'=>$usersGoing[$item->id_event]])
      @endif
      @if(is_a($item,'App\Event'))
      @include('partials.feed-card', [$item,'usersGoing'=>$usersGoing[$item->id_event]])
      @endif
      @if(is_a($item,'App\Comment'))
      @include('partials.feed-comment', $item)
      @endif
      @if(is_a($item,'App\Post'))
      @include('partials.post', ['post'=>$item])
      @endif
    @endforeach
</div>
@endsection