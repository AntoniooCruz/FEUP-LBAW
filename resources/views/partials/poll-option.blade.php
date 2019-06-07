<div class="progress roundRadius" >
        <div class="form-check" >
          @if (Auth::check())
          @if (Auth::user()->userVotes()->get()->contains('id_poll_option', $pollOption->id_poll_option))
          <input class="roundRadius form-check-input position-static form-radio" type="radio"
            name="poll-option" data-id={{$pollOption->id_poll_option}} ifchecked="true" checked id="poll-option1" value="option1" aria-label="Bus">
            @else
          <input class="roundRadius form-check-input position-static form-radio" type="radio"
            name="poll-option" data-id={{$pollOption->id_poll_option}} ifchecked="false" id="poll-option1" value="option1" aria-label="Bus">
            @endif
            @endif
        </div>
        @if (sizeof($pollOption->poll->votesOnPoll()->get()) != 0)
        <div id={{$pollOption->id_poll_option}} data-name={{sizeof($pollOption->votesOnPollOption()->get())}} class="progress-bar bg-info" role="progressbar" style="{{ 'width:'.floor(sizeof($pollOption->votesOnPollOption()->get())/sizeof($pollOption->poll->votesOnPoll()->get())*100).'%;'}}"" aria-valuenow="25"
          aria-valuemin="0" aria-valuemax="100"></div><span class="pollPerc">{{floor(sizeof($pollOption->votesOnPollOption()->get())/sizeof($pollOption->poll->votesOnPoll()->get())*100)}}%</span>@endif
        <span class="pollOption">{{$pollOption->name}}</span>
      </div>
