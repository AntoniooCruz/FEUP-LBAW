let votePollBttn = document.querySelectorAll('#poll-option1');
if (votePollBttn != null) {
  for(var j= 0; j < votePollBttn.length; j++){
    votePollBttn[j].addEventListener('click', addVoteOnPollRequest);
   }
}

function addVoteOnPollRequest(evt) {
    
    let poll_option_id = evt.path[0].dataset.id;
  
    let method = 'post';
  
    sendAjaxRequest(method, '/api/pollOption/' + poll_option_id, null, addVoteOnPollRequestHandler);
  }

  function addVoteOnPollRequestHandler() {

    if (this.status == 200) {
        let comment = JSON.parse(this.response);
        console.log(comment);

    //let inputs = document.querySelector(`#poll-option1[data-id="${comment[0].id_post}"] +span`);
    }

  }