let showCommentBttn = document.querySelector('#comment_button');
showCommentBttn.addEventListener('click', showCommentsRequest);

let addCommentBttn = document.querySelector('#add_comment_button');
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

    let method = 'post';

    sendAjaxRequest(method, '/api/event/' + id_event + '/post/' + id_post + '/addcomment', {data: comment}, addCommentsRequestHandler);
  }

function addCommentsRequestHandler() {

  if(this.status == 200) {
    
    let comment = JSON.parse(this.response);

    let comment_section = document.querySelector('#comment_section');
    let newComment = document.createElement("div");
    newComment.className = "comment my-2";

    let row = document.createElement("div");
    row.className = "row";

    let img = document.createElement("IMG");
    img.className ="roundRadius";
    img.src = "../img/user.jpg";
    img.alt= "Card image cap";

    let col = document.createElement("div");
    col.className = "col-10 align-self-center commentText roundRadius px-4 ml-1";

    let text = document.createElement('div');
    text.innerHTML = comment[0].text;

    let reply = document.createElement("div");
    reply.className = "reply row justify-content-end mr-4";
    reply.innerHTML = "Reply";

    col.appendChild(text);

    row.appendChild(img);
    row.appendChild(col);

    newComment.appendChild(row);
    newComment.appendChild(reply);

    $("#comment_data").val('');

    comment_section.appendChild(newComment);
  }
    
}

