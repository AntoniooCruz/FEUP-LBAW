let ban = document.getElementById('bann-button');

if(ban!=null){
    ban.addEventListener('click',function(){
        sendAjaxRequest("put",'/report/'+ document.getElementById('reportid').innerHTML+'/accept',null,banUserHandler);
    })
}

function banUserHandler(){
    if(this.status==200){
    let template = document.createElement('div');
        template.innerHTML = '<div class="alert alert-danger" role="alert">This user has been banned!</div>';
        document.querySelector('#content').prepend(template);
        ban.classList.add('disabled');
    }
}

let submitReportBtn = document.getElementById('submitReportBtn');

function validate() {
    let value = document.getElementById('textA').value;

    if(value != null && value.length <= 300)
        submitReportBtn.classList.remove('disabled');

}

if(submitReportBtn!=null){
    submitReportBtn.addEventListener('click', function(e){
        e.preventDefault();
        let reason = document.getElementById('textA').value;
        sendAjaxRequest("post",'/profile/'+ document.getElementById('id_user').innerHTML+'/report',{'reason':reason},reportUserHandler);

    })
}

function reportUserHandler(){
    if(this.status==200){
        document.querySelector('#profile .modal-body').innerHTML = '<div class="alert alert-success" role="alert">This user has been reported!</div>';
        document.querySelector('#profile .modal-footer ').remove();

    }
}