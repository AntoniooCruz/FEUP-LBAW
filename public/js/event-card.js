window.addEventListener("load",loadHandler);

function loadHandler() {
    titles = document.querySelectorAll("#event-card-title");
    titles.forEach(title => {
        if(title.textContent.length > 22)
        title.textContent = title.textContent.substring(0,22) + "...";
    });

    months = document.querySelectorAll("#eventMonth");
    months.forEach(date => {
        date.textContent = parseDateMonth(date.textContent);
    });

    days = document.querySelectorAll("#eventPageDay");
    days.forEach(date => {
        date.textContent = parseDateDay(date.textContent);
    });

    hours = document.querySelectorAll("#event-card-hour");
    hours.forEach(date => {
        date.textContent = parseDateHours(date.textContent);
    });
    
}

function translateMonth(number){
    switch(number){
        case "01":
        return "Jan";

        case "02":
        return "Feb";

        case "03":
        return "Mar";

        case "04":
        return "Apr";
        
        case "05":
        return "May";

        case "06":
        return "Jun";

        case "07":
        return "Jul";

        case "08":
        return "Aug";

        case "09":
        return "Sep";

        case "10":
        return "Oct";

        case "11":
        return "Nov";

        case "12":
        return "Dec";
    }
}

function parseDateMonth(date){
    let parseDate = date.split(" ");
    let aux = parseDate[0].split("-");

    return translateMonth(aux[1]);
}

function parseDateDay(date){
    let parseDate = date.split(" ");
    let aux = parseDate[0].split("-");

    return aux[2];
}

function parseDateHours(date){
    let parseDate = date.split(" ");
    let aux = parseDate[1].split(":");

    return aux[0] + ":" + aux[1];
}