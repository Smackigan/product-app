// Product type switcher
let productType = document.getElementById('productType'); // get select elem

let optionFields = document.getElementById('option_fields'); // get option field

productType.addEventListener('change', function () {
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

//        Validation
// Get the form elements
const skuInput = document.getElementById('sku');
const nameInput = document.getElementById('name');
const saveBtn = document.getElementById('save-btn');
const errorContainer = document.getElementById('sku-error');

// Add a click event listener to the Save button
saveBtn.addEventListener('click', function (e) {
    e.preventDefault(); // Prevent the default button behavior

    // Get the SKU value
    const sku = skuInput.value.trim();

    // Perform client-side validation
    if (sku === '') {
        errorContainer.textContent = 'Please, provide the SKU';
        return;
    }


    // Clear any previous error message
    errorContainer.textContent = '';

    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Configure AJAX request
    xhr.open('POST', '../controllers/ProductController.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    // Define callback function to handle AJAX response
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                if (response.success) {
                    // Data was successfully inserted
                    window.location.href = '../views/home.view.php';
                } else {
                    // Display the error message to the user
                    const skuErrorMessage = response.message;
                    errorContainer.textContent = skuErrorMessage;
                }
            } else {
                console.error('Error:', xhr.status);
            }
        }
    };

    // Prepare the form data to send
    const formData = new FormData();
    formData.append('sku', sku);

    // Send AJAX request with the form data
    xhr.send(formData);
});


