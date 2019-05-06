function addEventListeners() {
    let followUser = document.querySelector('#follow_button'); 

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
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
  }

  function followUserRequest(){
      
    //sendAjaxRequest('put','api/profile{id_user}/follow', ,followUserHandler)
    alert('handler')
  }

  function followUserHandler(){
    //Handle Request
  }

  addEventListeners();
  