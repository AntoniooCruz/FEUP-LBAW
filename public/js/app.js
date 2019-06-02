let follow;

function addEventListeners() {
    let followUser = document.querySelector('#follow_button'); 

    if(followUser!=null){
    follow = followUser.innerHTML == 'Follow'? true : false;
    followUser.addEventListener('click',followUserRequest);
    }
  
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
  
//register
  let myInput = document.getElementById("inputPassword");
  let questionMark = document.getElementById("onlineHelp");
  let letter = document.getElementById("letter");
  let capital = document.getElementById("capital");
  let number = document.getElementById("number");
  let length = document.getElementById("length");


  var checkPasswordMatch = function() {
    if (myInput.value == document.getElementById('password-confirm').value && myInput.value=='') {
      document.getElementById('password-match').innerHTML = '';
    }else if (myInput.value == document.getElementById('password-confirm').value) {
        document.getElementById('password-match').style.color = 'green';
        document.getElementById('password-match').innerHTML = '<i class="far fa-check-circle"></i>';
    } else {
      document.getElementById('password-match').style.color = 'red';
      document.getElementById('password-match').innerHTML = '<i class="far fa-times-circle"></i>';
    }
  }

let unlimited = false;
  //create event
document.querySelector('#pills-free-tab').addEventListener('click', function(){
  document.querySelector('#pricePticket').style.display = 'none';
  //document.querySelector('#pills-free > div >div').classList.remove('col-6');
  document.querySelector('#pricePticket input').required = false;
})

document.querySelector('#pills-paid-tab').addEventListener('click', function(){
  document.querySelector('#pricePticket').style.display = 'flex';
  //document.querySelector('#pills-free > div > div').classList.add('col-6');
  document.querySelector('#pricePticket input').required = true;
})

document.querySelector('#unlimitedTickets').addEventListener('click', function(){
  unlimited=!unlimited;

  if(unlimited){
    document.querySelector('#capacityDiv input').required = false;
    document.querySelector('#capacityDiv input').disabled = true;

  }else{
    document.querySelector('#capacityDiv input').required = true;
    document.querySelector('#capacityDiv input').disabled = false;

  }
  
})



// When the user starts to type something inside the password field
myInput.onkeyup = function() {

  if(myInput.value==''){
    questionMark.style.color = '#a5abb7';
    letter.classList.remove("invalid");
    letter.classList.remove("valid");
    capital.classList.remove("invalid");
    capital.classList.remove("valid");
    number.classList.remove("invalid");
    number.classList.remove("valid");
    length.classList.remove("invalid");
    length.classList.remove("valid");
    return;
  } 

    // Validate lowercase letters
  let lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
    questionMark.style.color = '#f4aa42';
  }
  
  // Validate capital letters
  let upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
    questionMark.style.color = '#f4aa42';
  }

  // Validate numbers
  let numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
    questionMark.style.color = '#f4aa42';
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
    questionMark.style.color = '#f4aa42';

  }
}


$('#my-element').datepicker([options])
// Access instance of plugin
$('#my-element').data('datepicker')