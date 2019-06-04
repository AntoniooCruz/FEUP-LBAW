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

        }else{
            document.querySelector('#capacityDiv input').required = true;
            document.querySelector('#capacityDiv input').disabled = false;
        }
    })
}