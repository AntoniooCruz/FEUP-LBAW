let checkbox_free = document.querySelector("#checkFree");
let checkbox_paid = document.querySelector("#checkPaid");


let checkboxes = document.querySelectorAll(".form-check")
let submitBtn = document.querySelector("#fieldSubmit");
let sort = document.querySelector("#sortDate");

sort.addEventListener('change',checkboxHandler);

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
    events = sortEvents(events,sort.options[sort.selectedIndex].value);

    resultsContainer.innerHTML = '';
    if(events != null){
        events.forEach(function(event) {
            let node = document.createElement('div');
            node.setAttribute('class','col-auto  mb-3 sm-12');

            if(event.title.length > 22)
                event.title = event.title.substring(0,22) + "...";

            node.innerHTML = '<div class="invite card"> <a href=/event/' + event.id_event +
            '><img src="../img/invite-card-event.jpg"' +
            'class="card-img-top"></a> <span class="badge badge-pill badge-secondary card-category">' + categories[event.id_category - 1].name +
            '</span> <div class="card-body" id="event-card-body"> <div class="row eventRow header align-items-start"> <div id="eventPagedate" class="eventPagedate col-xs align-self-center"> <div id="eventPageMonth" class="eventPageMonth"><span class="eventMonth">' +
            parseDateMonth(event.date,false) +'</span> </div> <span class="eventPageDay">' + parseDateDay(event.date) +'</span> </div> <div class="col-10 cardTitle text-left"> <span id="event-card-title">' + 
            event.title +'</span> <div class="event-card-footer"> <span class="event-card-hour">' + parseDateYear(event.date) + '</span> <p class="dot-separator"> • </p> <span id="card-adress">' + 
            event.location +'</span> </div> </div> </div> <div id="event-card-people-attending" class="row text-left"> <div class="col "> <img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25"> <img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25"> <img src="../img/user.jpg" class="event-card-user-photo" width="25" height="25"> <span id="event-card-invite"><i class="fas fa-plus-circle"></i></span> <span id="peopleGoing">+300 going</i></span> </div> </div> </div> </div>';
            resultsContainer.append(node);
          });
    }
    
}

function sortEvents(events,order){
    switch(order){
        case "date-up":
        events.sort(dateUp);
        break;

        case "date-down":
        events.sort(dateDown);
        break;

        case "price-down":
        events.sort(priceDown);
        break;

        case "price-up":
        events.sort(priceUp);
        break;

        case "attendees-up":
        events.sort(dateUp);
        break;

        case "attendees-down":
        events.sort(dateUp);
        break;

    }
    return events;
}

function dateUp(a,b){
    let dA = a.date;
    let dB = b.date;
    let dateA = getDate(dA);
    let dateB = getDate(dB);

    if(dateA.getTime() < dateB.getTime()){
        return -1;
    }

    if(dateA.getTime() > dateB.getTime()){
        return 1;
    }

    return 0;
}

function dateDown(a,b){
    let dA = a.date;
    let dB = b.date;
    let dateA = getDate(dA);
    let dateB = getDate(dB);

    if(dateA.getTime() < dateB.getTime()){
        return 1;
    }

    if(dateA.getTime() > dateB.getTime()){
        return -1;
    }

    return 0;
}

function priceUp(a,b){
    let priceA = parseInt(a.price);
    let priceB = parseInt(b.price);
    
    if(priceA < priceB){
        return -1;
    }

    if(priceA > priceB){
        return 1;
    }

    return 0;
}

function priceDown(a,b){
    let priceA = parseInt(a.price);
    let priceB = parseInt(b.price);

    if(priceA < priceB){
        return 1;
    }

    if(priceA > priceB){
        return -1;
    }

    return 0;
}

function getDate(date){
    let parseDate = date.split(" ");
    let aux = parseDate[0].split("-");
    let aux2 = parseDate[1].split(":");
    let d = new Date(aux[0],aux[1],aux[2],aux2[0],aux2[1]);
    return d;
}

function translateMonth(number, full){
    switch(number){
        case "01":
        if(full) return "January";
        return "Jan";

        case "02":
        if(full) return "February";
        return "Feb";

        case "03":
        if(full) return "March";
        return "Mar";

        case "04":
        if(full) return "April";
        return "Apr";
        
        case "05":
        return "May";
        
        case "06":
        if(full) return "June";
        return "Jun";

        case "07":
        if(full) return "July";
        return "Jul";

        case "08":
        if(full) return "August";
        return "Aug";

        case "09":
        if(full) return "September";
        return "Sep";

        case "10":
        if(full) return "October";
        return "Oct";

        case "11":
        if(full) return "November";
        return "Nov";

        case "12":
        if(full) return "December";
        return "Dec";
    }
}

function parseDateYear(date){
    let parseDate = date.split(" ");
    let aux = parseDate[0].split("-");

    return aux[0];

}


function parseDateMonth(date, full){
    let parseDate = date.split(" ");
    let aux = parseDate[0].split("-");

    return translateMonth(aux[1], full);
}

function parseDateDay(date){
    let parseDate = date.split(" ");
    let aux = parseDate[0].split("-");

    return aux[2];
}

function parseDateHours(date, letter){
    let parseDate = date.split(" ");
    let aux = parseDate[1].split(":");

    if(letter)
        return aux[0] + "h" + aux[1];
    else  return aux[0] + ":" + aux[1]; 
}