let checkbox_free = document.querySelector("#checkFree");
let checkbox_paid = document.querySelector("#checkPaid");


let checkboxes = document.querySelectorAll(".form-check")
let submitBtn = document.querySelector("#fieldSubmit");

//add listener to submit button
submitBtn.addEventListener('click',function(e){
    e.preventDefault();
    checkboxHandler();
})

checkboxes.forEach(form => {
   let checkbox = form.querySelector('input[type="checkbox"]');
   checkbox.addEventListener('change',checkboxHandler);
});

//add listener everytime checkbox is checked
function checkboxHandler() {
    let searchquery = document.querySelector('#fieldText').value;
    let categories = [];
    let price = [];

    document.querySelectorAll('#categories div input').forEach(cat => {
        if(cat.checked) {
            categories.push(cat.value);
        }
     });

    let free = document.querySelector('#checkFree');
    let paid = document.querySelector('#checkPaid');
 
    if(free.checked) {
        price.push(free.value);
    }

    if(paid.checked) {
        price.push(paid.value);
    }
    
     sendAjaxRequest('get', '/api/search', {"searchquery":searchquery,"categories":categories, "price":price}, filterHandler);
}

function filterHandler () {
    let resultsContainer = document.querySelector('#results_container > div');
    let response = JSON.parse(this.response);
    let events = response[0];
    let categories = response[1];
    console.log(categories[0]);
    resultsContainer.innerHTML = '';
    if(events != null){
        events.forEach(function(event) {
            let node = document.createElement('div');
            node.setAttribute('class','col-auto  mb-3 sm-12');
    
            node.innerHTML = '<div class="invite card"> <a href=/event/' + event.id_event +
            '><img src="../img/invite-card-event.jpg"' +
            'class="card-img-top"></a> <span class="badge badge-pill badge-secondary card-category">' + categories[event.id_category - 1].name +
            '</span> <div class="card-body" id="event-card-body"> <div class="row eventRow header align-items-start"> <div id="eventPagedate" class="eventPagedate col-xs align-self-center"> <div id="eventPageMonth" class="eventPageMonth"><span class="eventMonth">' +
            event.date +'</span> </div> <span class="eventPageDay">' + event.date +'</span> </div> <div class="col-10 cardTitle text-left"> <span id="event-card-title">' + 
            event.title +'</span> <div class="event-card-footer"> <span class="event-card-hour">' + event.date + '</span> <p class="dot-separator"> • </p> <span id="card-adress">' + 
            event.location +'</span> </div> </div> </div> <div id="event-card-people-attending" class="row text-left"> <div class="col "> <img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25"> <img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25"> <img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25"> <span id="event-card-invite"><i class="fas fa-plus-circle"></i></span> <span id="peopleGoing">+300 going</i></span> </div> </div> </div> </div>';
            resultsContainer.append(node);
            console.log(event.id_event);
          });
    }
    
}