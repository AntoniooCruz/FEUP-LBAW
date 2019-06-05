let unlimited = false;
let freeTab = document.querySelector('#pills-free-tab');
let paidTab = document.querySelector('#pills-paid-tab');

if(paidTab!=null && freeTab !=null){
    freeTab.addEventListener('click', function(){
        document.querySelector('#pricePticket').style.display = 'none';
        document.querySelector('#pricePticket input').required = false;
        })

    paidTab.addEventListener('click', function(){
        document.querySelector('#pricePticket').style.display = 'flex';
        document.querySelector('#pricePticket input').required = true;
    })

    document.querySelector('#unlimitedTickets').addEventListener('click', function(){
        unlimited=!unlimited;

        if(unlimited){
            document.querySelector('#capacityDiv input').required = false;
            document.querySelector('#capacityDiv input').disabled = true;
            document.querySelector('.fa-ticket-alt').classList.add('disabled');
            document.querySelector('#capacityDiv input').classList.add('disabled');

        }else{
            document.querySelector('#capacityDiv input').required = true;
            document.querySelector('#capacityDiv input').disabled = false;
            document.querySelector('.fa-ticket-alt').classList.remove('disabled');
            document.querySelector('#capacityDiv input').classList.remove('disabled');
        }
    })

    $(function() {
        $('input[name="date"]').daterangepicker({
          singleDatePicker: true,
          timePicker24Hour: true,
          "locale": {
            "format": "MM/DD/YYYY @ H:mm"
          },
          timePicker: true,
          minDate: moment(),
          maxYear: parseInt(moment().format('YYYY'),10)
        }, function(start, end, label) {
          var years = moment().diff(start, 'years');
          
        });
      });
}

let oldDate;
let errors = (document.getElementById('errors'));
if(errors!=null){
if(document.getElementById('errors').innerHTML!=0){
  $('input[name="date"]').value =oldDate;
  $('#createEventModal').modal();
}
  
document.getElementById('click', function(){
  oldDate = $('input[name="date"]').value;
});
}