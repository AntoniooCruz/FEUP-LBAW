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


     document.querySelectorAll('#price div input').forEach(cat => {
        if(cat.checked) {
            price.push(cat.value);
        }
     });
     sendAjaxRequest('get', '/api/search', {"searchquery":searchquery,"categories":categories, "price":price}, filterHandler);
}

function filterHandler () {
    console.log(this);
}