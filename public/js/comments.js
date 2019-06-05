let showCommentBttn = document.querySelectorAll('#comment_button');
console.log(showCommentBttn);
if (showCommentBttn != null) {
  for(var j= 0; j < showCommentBttn.length; j++){
    showCommentBttn[j].addEventListener('click', showCommentsRequest);
   }
}

let addCommentBttn = document.querySelectorAll('#add_comment_button');
if (addCommentBttn != null) {
 for(var i= 0; i < addCommentBttn.length; i++){
  addCommentBttn[i].addEventListener('click', addCommentRequest);
 }
}
function addCommentToSection(id_user, comment_text, comment_id_post) {

  let comment_section = document.querySelector(`#comment_section[data-id="${comment_id_post}"]`);
  console.log(comment_id_post);
  console.log(comment_section);

  let newComment = document.createElement("div");
  newComment.className = "comment my-2";

  let row = document.createElement("div");
  row.className = "row";

  let img = document.createElement("IMG");
  img.className = "roundRadius";
  img.src = "../img/user.jpg";
  img.alt = "Card image cap";

  let col = document.createElement("div");
  col.className = "col-10 align-self-center commentText roundRadius px-4 ml-1";

  let text = document.createElement('div');
  text.innerHTML = comment_text;

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

function showCommentsRequest(evt) {

  let id_post = evt.path[1].dataset.id;

  console.log('Show Comments from post ' + id_post);

  let method = 'get';

  sendAjaxRequest(method, '/api/post/' + id_post + '/getcomments', null, showCommentsRequestHandler);
}

function showCommentsRequestHandler() {

  console.log(JSON.parse(this.response));
  let comments = JSON.parse(this.response);
 
  comments[0].forEach(element => {
    addCommentToSection(element.id, element.text, element.id_post);
  });
}

function addCommentRequest() {

  let id_post = document.querySelector('#id_post').innerHTML;
  let id_event = document.querySelector('#id_event').innerHTML;

  let comment = $('#comment_data').val();

  let method = 'post';

  sendAjaxRequest(method, '/api/event/' + id_event + '/post/' + id_post + '/addcomment', { data: comment }, addCommentsRequestHandler);
}


function addCommentsRequestHandler() {

  if (this.status == 200) {

    let comment = JSON.parse(this.response);
    addCommentToSection(comment[0].id_user, comment[0].text, comment[0].id_post);
  }

}

