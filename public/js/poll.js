let votePollBttn = document.querySelectorAll('#poll-option1');
if (votePollBttn != null) {
  for(var j= 0; j < votePollBttn.length; j++){
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

        let oldperc = JSON.parse(this.response)['oldperc'];

      }

  }