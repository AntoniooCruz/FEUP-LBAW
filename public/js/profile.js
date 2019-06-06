let ban = document.getElementById('bann-button');

if(ban!=null){
    ban.addEventListener('click',function(){
        let template = document.createElement('div');
        template.innerHTML = '<div class="alert alert-danger" role="alert">This user has been banned!</div>';
        document.querySelector('#content').prepend(template);
        ban.classList.add('disabled');

        sendAjaxRequest("put",'/profile/'+ document.getElementById('id_user').innerHTML+'/ban',null,banUserHandle);
    })
}

function banUserHandle(){
    console.log(this);
}

let submitReportBtn = document.getElementById('submitReportBtn');

if(submitReportBtn!=null){
    submitReportBtn.addEventListener('click', function(e){
        e.preventDefault();
    })
}