let banUserBtn = document.querySelectorAll('.banUser');

if(banUserBtn!=null){
banUserBtn.forEach(element => {
    element.onclick = function(){
        let id_report = element.getAttribute('repid');
        sendAjaxRequest("put",'/report/'+ id_report+'/accept',null,acceptBanUserHandler); 
    }
});
}


function acceptBanUserHandler(){
    if(this.status==200){
        let response = JSON.parse(this.response);
        let alert = document.createElement('div');
        alert.innerHTML = '<div id="ticketAlert" class="alert alert-success" role="alert"> User banned!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        document.getElementById(response['id_report']).replaceWith(alert);
    }
}