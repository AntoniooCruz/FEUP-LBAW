Popper.Defaults.modifiers.computeStyle.gpuAcceleration = false;

//circular graph
$(document).ready(function () {
    let percentVar;
    if(parseInt(document.getElementById('eventTaken') != null)){
    if (parseInt(document.getElementById('eventTaken').innerHTML) == 0)
        percentVar = 0;
    else percentVar = Math.round(parseInt(document.getElementById('eventTaken').innerHTML) * 100 / parseInt(document.getElementById('eventCapacity').innerHTML));

    $("#test-circle").circliful({
        animationStep: 5,
        foregroundBorderWidth: 5,
        backgroundBorderWidth: 5,
        percent: percentVar,
        foregroundColor: '#A1B6C8',
        fontColor: '#A1B6C8'
    });
    }
});


//get ticket
let ticketBtn = document.getElementById('confirmTicket');
if (ticketBtn != null)
    ticketBtn.onclick = purchaseTicketRequest;

function purchaseTicketRequest() {
    let id_event = document.getElementById('id_event').innerHTML;
    sendAjaxRequest('post', '/api/event/' + id_event + '/ticket', null, purchaseTicketHandler);
}

function purchaseTicketHandler() {
    if (this.status == 200) {
        document.getElementById('getTicketBtn').innerHTML = "Going";
        document.getElementById('getTicketBtn').removeAttribute("data-target");
        let template = document.createElement('div');
        template.innerHTML = '<div id="ticketAlert" class="alert alert-success" role="alert"> Ticket purchased!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        document.getElementById('content').prepend(template);
        $('#getTicketModal').modal('hide');
    }
}

let reportBtn = document.querySelector('#report-event');
if (reportBtn != null)
reportBtn.addEventListener('click',sendReport);

function sendReport(){
    let radioBtns = document.querySelectorAll('.form-check-input');
    let reason;

    radioBtns.forEach(radio => {
        if(radio.checked){
            reason = radio.value;
            if(radio.value == 'other'){
                reason = document.querySelector('.input-group .form-control').value;
            }
        }
     });
     sendAjaxRequest("post",'/event/'+ document.getElementById('id_event').innerHTML+'/report',{'reason':reason},reportEventHandler);
}

function reportEventHandler(){
    console.log(JSON.parse(this.response));
    if(this.response == '200'){
        console.log('in')
        let template = document.createElement('div');
        template.innerHTML = '<div class="alert alert-danger" role="alert">This event has been reported!</div>';
        document.querySelector('#content').prepend(template);
        document.querySelector('#cancel-report-event').click();
    } else if (this.response == '405'){
        let template = document.createElement('div');
        template.innerHTML = '<div class="alert alert-danger" role="alert">You already reported this event!</div>';
        document.querySelector('#content').prepend(template);
        document.querySelector('#cancel-report-event').click();
    }

   
}
