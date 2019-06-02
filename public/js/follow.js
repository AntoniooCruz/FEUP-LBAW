let followUser = document.querySelector('#follow_button'); 

follow = followUser.innerHTML == 'Follow'? true : false;
followUser.addEventListener('click',followUserRequest);


function followUserRequest(){
    let id_user = document.querySelector('#id_user').innerHTML; 
    let method;
    if (follow) {
      method = 'put';
    } else {
      method = 'delete';
    } 
    sendAjaxRequest(method, '/api/profile/' + id_user + '/follow', null, followUserHandler);

  }

  function followUserHandler(){
    console.log(this.responseText);
    if (this.status === 200) {
      let followButton = document.querySelector('#follow_button');
      
      if(followButton.innerHTML == "Follow")
        followButton.innerHTML = "Unfollow";
      else followButton.innerHTML = "Follow";

      follow = !follow;
    }
    
  }