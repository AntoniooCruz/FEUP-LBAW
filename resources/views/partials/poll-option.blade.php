<div class="progress roundRadius">
        <div class="form-check">
          <input class="roundRadius form-check-input position-static form-radio" type="radio"
            name="poll-option" data-id={{$pollOption->id_poll_option}} id="poll-option1" value="option1" aria-label="Bus">
        </div>
        <div class="progress-bar bg-info" role="progressbar" style="{{ 'width:'.floor(sizeof($pollOption->votesOnPollOption()->get())/sizeof($pollOption->poll->votesOnPoll()->get())*100).'%;'}}"" aria-valuenow="25"
          aria-valuemin="0" aria-valuemax="100"></div><span class="pollPerc">{{floor(sizeof($pollOption->votesOnPollOption()->get())/sizeof($pollOption->poll->votesOnPoll()->get())*100)}}%</span>
        <span class="pollOption">{{$pollOption->name}}</span>
      </div>