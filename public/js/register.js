let inputPassword = document.getElementById("inputPassword");
let questionMark = document.getElementById("onlineHelp");
let letter = document.getElementById("letter");
let capital = document.getElementById("capital");
let number = document.getElementById("number");
let length = document.getElementById("length");


var checkPasswordMatch = function() {
  if (inputPassword.value == document.getElementById('password-confirm').value && inputPassword.value=='') {
    document.getElementById('password-match').innerHTML = '';
  }else if (inputPassword.value == document.getElementById('password-confirm').value) {
      document.getElementById('password-match').style.color = 'green';
      document.getElementById('password-match').innerHTML = '<i class="far fa-check-circle"></i>';
  } else {
    document.getElementById('password-match').style.color = 'red';
    document.getElementById('password-match').innerHTML = '<i class="far fa-times-circle"></i>';
  }
}

inputPassword.onkeyup = function() {

    if(inputPassword.value==''){
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
    if(inputPassword.value.match(lowerCaseLetters)) {  
      letter.classList.remove("invalid");
      letter.classList.add("valid");
    } else {
      letter.classList.remove("valid");
      letter.classList.add("invalid");
      questionMark.style.color = '#f4aa42';
    }
    
    // Validate capital letters
    let upperCaseLetters = /[A-Z]/g;
    if(inputPassword.value.match(upperCaseLetters)) {  
      capital.classList.remove("invalid");
      capital.classList.add("valid");
    } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
      questionMark.style.color = '#f4aa42';
    }
  
    // Validate numbers
    let numbers = /[0-9]/g;
    if(inputPassword.value.match(numbers)) {  
      number.classList.remove("invalid");
      number.classList.add("valid");
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
      questionMark.style.color = '#f4aa42';
    }
    
    // Validate length
    if(inputPassword.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
      questionMark.style.color = '#f4aa42';
  
    }
}