window.addEventListener("load",loadHandler);

//date format
function loadHandler() {
    titles = document.querySelectorAll("#event-card-title");
    titles.forEach(title => {
        if(title.textContent.length > 22)
        title.textContent = title.textContent.substring(0,22) + "...";
    });

    months = document.querySelectorAll(".eventMonth");
    months.forEach(date => {
        date.textContent = parseDateMonth(date.textContent, false);
    });

    days = document.querySelectorAll(".eventPageDay");
    days.forEach(date => {
        date.textContent = parseDateDay(date.textContent);
    });

    hours = document.querySelectorAll(".event-card-hour");
    hours.forEach(date => {
        date.textContent = parseDateHours(date.textContent, false);
    });

    let dates = document.querySelectorAll('.extendedDate');

    dates.forEach(element => {
        console.log(element);
        let year = parseDateYear(element.innerHTML);
        let month = parseDateMonth(element.innerHTML, true);
        let day = parseDateDay(element.innerHTML);
        element.innerHTML =day + " " + month + " " + year;
    });
    
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

