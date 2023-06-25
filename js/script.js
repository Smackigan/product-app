// Product type switcher
let productType = document.getElementById('productType'); // get select elem

let optionFields = document.getElementById('option_fields'); // get option field

productType.addEventListener('change', function() {
    let optionFieldElements = optionFields.getElementsByClassName('option'); // hide all options
    for (let i = 0; i < optionFieldElements.length; i++) {
        optionFieldElements[i].classList.add('d-none');
    }

    let selectedOption = productType.value;

    let selectedOptionField = document.getElementById(selectedOption); // shpw option
    if (selectedOptionField) {
        selectedOptionField.classList.remove('d-none');
    }
});


