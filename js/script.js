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
const skuErrorContainer = document.getElementById('sku-error');
const nameErrorContainer = document.getElementById('name-error');

// Add a click event listener to the Save button
saveBtn.addEventListener('click', function (e) {
    e.preventDefault(); // Prevent the default button behavior

    // Get the SKU and name values
    const sku = skuInput.value.trim();
    const name = nameInput.value.trim();

    // Perform client-side validation
    let hasErrors = false;

    if (sku === '') {
        skuErrorContainer.textContent = 'Please provide the SKU';
        hasErrors = true;
    } else {
        skuErrorContainer.textContent = '';
    }

    if (name === '') {
        nameErrorContainer.textContent = 'Please provide the name';
        hasErrors = true;
    } else {
        nameErrorContainer.textContent = '';
    }

    if (hasErrors) {
        return;
    }

    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // AJAX request
    xhr.open('POST', '../controllers/ProductController.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    // Define callback function to handle AJAX response
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                if (response.success) {
                    // Data successfully inserted
                    window.location.href = '../views/home.view.php';
                } else {
                    // Display error messages
                    const errors = response.errors;
    
                    // Clear previous error messages
                    skuErrorContainer.textContent = '';
                    nameErrorContainer.textContent = '';
    
                    // Update SKU error element
                    if (errors.skuError) {
                        skuErrorContainer.textContent = errors.skuError;
                    }
    
                    // Update name error element
                    if (errors.nameError) {
                        nameErrorContainer.textContent = errors.nameError;
                    }
                }
            } else {
                console.error('Error:', xhr.status);
                console.log(xhr.responseText);
            }
        }
    };

    // Prepare the form data to send
    const formData = new FormData();
    formData.append('sku', sku);
    formData.append('name', name);

    // Send AJAX request with the form data
    xhr.send(formData);
});


