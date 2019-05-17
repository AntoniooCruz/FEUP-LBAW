let follow;

function addEventListeners() {
    let followUser = document.querySelector('#follow_button'); 
    follow = followUser.innerHTML == 'Follow'? true : false;
    followUser.addEventListener('click',followUserRequest);
  
  }
  
  function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
  }
  
  function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();
  
    request.open(method, url, true);
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.setRequestHeader('Accept', 'application/json');
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
  }

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

  addEventListeners();
  