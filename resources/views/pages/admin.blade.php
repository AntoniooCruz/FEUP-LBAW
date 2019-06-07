@extends('layouts.app')

@section('custom-scripts')
  <link href="{{ asset('css/adminpage.css') }}" rel="stylesheet">
  <script src={{ asset('js/admin.js') }} defer></script>
  <script src={{ asset('js/profile.js') }} defer></script>
  <script src={{ asset('js/date.js') }} defer></script>
  
@endsection

@section('content')
<div id="wrapper">
<ul class="nav nav-tabs sidebar navbar-nav" id="nav-admin2" role="tablist">
    <li class="nav-item" role="tablist">
      <a class="nav-item nav-link active" id="nav-users-tab" data-toggle="tab" href="#nav-users" role="tab"
      aria-controls="nav-users" aria-selected="true">
      <i class="fas fa-user"></i>
        <span>Users</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-item nav-link" id="nav-comments-tab" data-toggle="tab" href="#nav-comments" role="tab"
      aria-controls="nav-comments" aria-selected="false">
      <i class="fas fa-comment"></i>
        <span>Posts</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-item nav-link" id="nav-events-tab" data-toggle="tab" href="#nav-events" role="tab"
      aria-controls="nav-events" aria-selected="false">
      <i class="fas fa-calendar"></i>
        <span>Events</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-item nav-link" id="nav-verify-tab" data-toggle="tab" href="#nav-verify" role="tab"
        aria-controls="nav-verify" aria-selected="false">
        <i class="fas fa-check-circle"></i>
                  <span>Verify</span></a>
      </li>
  </ul>
<div class="container">
    <div class="tab-content" id="nav-admintab">
      <div class="tab-pane fade show active" id="nav-users" role="tabpanel" aria-labelledby="nav-users-tab">
          <nav class="mb-2">
              <div class="nav nav-tabs mt-3" id="nav-admin" role="tablist">
                <a class="nav-item nav-link active" id="nav-users-tab" data-toggle="tab" href="#activeUsers" role="tab"
                  aria-controls="nav-users" aria-selected="true"><i class="fas fa-inbox"></i> Pending</a>
                <a class="nav-item nav-link" id="nav-comments-tab" data-toggle="tab" href="#archivedUsers" role="tab"
                  aria-controls="nav-comments" aria-selected="false"><i class="fas fa-archive"></i> Archived</a>
              </div>
            </nav>
        <div id="activeUsers" class="tab-pane fade show active">
        @foreach ($userReports as $rep)
          @include ('partials.user-report',['report'=>$rep])
        @endforeach
      </div> 
      <div id="archivedUsers" class="tab-pane fade">
          @foreach ($seenReports as $rep)
          @include ('partials.user-report',['report'=>$rep])
          @endforeach
        </div> 
      </div>  
      <div class="tab-pane fade" id="nav-comments" role="tabpanel" aria-labelledby="nav-comments-tab">
          <nav class="mb-2">
              <div class="nav nav-tabs mt-3" id="nav-admin" role="tablist">
                <a class="nav-item nav-link active" id="nav-users-tab" data-toggle="tab" href="#activePosts" role="tab"
                  aria-controls="nav-users" aria-selected="true"><i class="fas fa-inbox"></i> Pending</a>
                <a class="nav-item nav-link" id="nav-comments-tab" data-toggle="tab" href="#archivedPosts" role="tab"
                  aria-controls="nav-comments" aria-selected="false"><i class="fas fa-archive"></i> Archived</a>
              </div>
            </nav>
            <div id="activePosts" class="tab-pane fade show active">
        @foreach ($postReports as $rep)
          @include ('partials.post-report',['report'=>$rep])
        @endforeach
      </div> 
      <div id="archivedPosts" class="tab-pane fade">
          @foreach ($seenPostReports as $rep)
          @include ('partials.post-report',['report'=>$rep])
          @endforeach
        </div> 
      </div>
        
       
      <div class="tab-pane fade" id="nav-events" role="tabpanel" aria-labelledby="nav-events-tab">
      <nav class="mb-2">
              <div class="nav nav-tabs mt-3" id="nav-admin" role="tablist">
                <a class="nav-item nav-link active" id="nav-events-tab" data-toggle="tab" href="#activeEvents" role="tab"
                  aria-controls="nav-events" aria-selected="true"><i class="fas fa-inbox"></i> Pending</a>
                <a class="nav-item nav-link" id="nav-events-tab" data-toggle="tab" href="#archivedEvents" role="tab"
                  aria-controls="nav-events" aria-selected="false"><i class="fas fa-archive"></i> Archived</a>
              </div>
            </nav>
            <div id="activeEvents" class="tab-pane fade show active">
        @foreach ($eventReports as $rep)
          @include ('partials.event-report',['report'=>$rep])
        @endforeach
      </div> 
      <div id="archivedEvents" class="tab-pane fade">
          @foreach ($seenEventReports as $rep)
          @include ('partials.archived-event-report',['report'=>$rep])
          @endforeach
        </div> 
      </div>  

      <div class="tab-pane fade" id="nav-verify" role="tabpanel" aria-labelledby="nav-verify-tab">
        <div class="container-fluid actionCard">
          
        oi
        </div>
      </div>
    </div>
  </div>
</div>

  @endsection