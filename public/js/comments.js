let showCommentBttn = document.querySelector('#comment_button');
if(showCommentBttn!=null)
  showCommentBttn.addEventListener('click', showCommentsRequest);

let addCommentBttn = document.querySelector('#add_comment_button');
if(addCommentBttn!=null)
  addCommentBttn.addEventListener('click', addCommentRequest);

function showCommentsRequest(){

    let id_post = document.querySelector('#id_post').innerHTML; 

    console.log('Show Comments from post ' + id_post);

    let method = 'get';

    //sendAjaxRequest(method, '/api/event/' + id_event + id_post + '/comments', null, showCommentsRequestHandler);
  }

function showCommentsRequestHandler() {
    console.log(this.responseText);
}

function addCommentRequest(){

    let id_post = document.querySelector('#id_post').innerHTML; 
    let id_event = document.querySelector('#id_event').innerHTML;

    let comment = $('#comment_data').val();

    console.log('Add ' + comment + ' Comment to post ' + id_post + ' from event ' + id_event);

    let method = 'post';

    sendAjaxRequest(method, '/api/event/' + id_event + '/post/' + id_post + '/addcomment', {data: comment}, showCommentsRequestHandler);
  }

function showCommentsRequestHandler() {

  let id_post = document.querySelector('#id_post').innerHTML;
  let id_event = document.querySelector('#id_event').innerHTML;
    
}

