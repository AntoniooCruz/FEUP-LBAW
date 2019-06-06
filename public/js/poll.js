let votePollBttn = document.querySelectorAll('#poll-option1');
if (votePollBttn != null) {
  for (var j = 0; j < votePollBttn.length; j++) {
    votePollBttn[j].addEventListener('click', addVoteOnPollRequest);
  }
}

let poll_option_id;

function addVoteOnPollRequest(evt) {

  poll_option_id = evt.path[0].dataset.id;

  let method = 'post';

  sendAjaxRequest(method, '/api/pollOption/' + poll_option_id, null, addVoteOnPollRequestHandler);
}

function addVoteOnPollRequestHandler() {
  console.log(this);

  if (this.status == 200) {
    let perc = JSON.parse(this.response)['perc'] + "%";
    let progress = document.getElementById(poll_option_id);
    progress.style.width = perc;
    progress.nextSibling.innerHTML = perc;

    let oldId = JSON.parse(this.response)['oldPollOptId'];
    let noVotes = JSON.parse(this.response)['noVotesTotal'];

    let arr = JSON.parse(this.response)['pollOptsID']

    update(arr,poll_option_id, oldId, noVotes);
  }
}

  function update(arr,incID, decID, noVotes) {
    
    for(var i=0; i < arr.length; i++){
      let pollOpt = document.getElementById(arr[i].id_poll_option);
      if(arr[i].id_poll_option == incID){
        pollOpt.setAttribute("data-name", parseInt(pollOpt.dataset.name)+ 1);

      } else if(decID != null) {
          if(arr[i].id_poll_option == decID) {
            pollOpt.setAttribute("data-name", parseInt(pollOpt.dataset.name) - 1);
          }
      }
      let percent = Math.floor(pollOpt.dataset.name/noVotes*100);
      console.log(noVotes);
      console.log(pollOpt.dataset.name);
      pollOpt.style.width = percent+ "%";
      pollOpt.nextSibling.innerText = percent.toString().concat('%')
    }
  }