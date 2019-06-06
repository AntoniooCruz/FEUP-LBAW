let banUserBtn = document.querySelector('.banUser');

if(banUserBtn!=null){
banUserBtn.onclick = function(){
    sendAjaxRequest("put",'/report/'+ document.querySelector('.id_report').innerHTML+'/accept',null,acceptBanUserHandler); 
}
}

function acceptBanUserHandler(){
    console.log(this);
}