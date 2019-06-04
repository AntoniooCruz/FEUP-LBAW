let checkbox_free = document.querySelector("#checkFree");
let checkbox_paid = document.querySelector("#checkPaid");

let checkboxes = document.querySelectorAll(".form-check")

checkboxes.forEach(form => {
   let checkbox = form.querySelector('input[type="checkbox"]');
   checkbox.addEventListener('change',checkboxHandler);
});

function checkboxHandler() {
    let categories = [];

    checkboxes.forEach(form => {
        let checkbox = form.querySelector('input[type="checkbox"]');
        if(checkbox.checked) {
            categories.push(checkbox.value);
        }
     });

     sendAjaxRequest('get', '/api/search/' ,{'categories': categories}, filterHandler);
}

function filterHandler () {

}