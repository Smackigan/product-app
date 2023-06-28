// Product type switcher
let productType = document.getElementById('productType'); // get select elem
let optionFields = document.getElementById('option_fields'); // get option field
let product;

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

  // formData.append('productType', selectedOption);

});


// Validation and AJAX request
const skuInput = document.getElementById('sku');
const nameInput = document.getElementById('name');
const priceInput = document.getElementById('price');
const saveBtn = document.getElementById('save-btn');
const skuErrorContainer = document.getElementById('sku-error');
const nameErrorContainer = document.getElementById('name-error');
const priceErrorContainer = document.getElementById('price-error');
const productErrorContainer = document.getElementById('product-error');

// click event listener to Save button
saveBtn.addEventListener('click', function (e) {
  e.preventDefault();

  const formData = new FormData();

  // Get values
  const sku = skuInput.value.trim();
  const name = nameInput.value.trim();
  const price = priceInput.value.trim();
  let selectedOption = productType.value;

  // Perform client-side validation
  let hasErrors = false;

  // SKU
  if (sku === '') {
    skuErrorContainer.textContent = 'Please provide the SKU';
    hasErrors = true;
  } else {
    skuErrorContainer.textContent = '';
  }

  // NAME
  if (name === '') {
    nameErrorContainer.textContent = 'Please provide the name';
    hasErrors = true;
  } else {
    nameErrorContainer.textContent = '';
  }

  // PRICE
  if (price === '') {
    priceErrorContainer.textContent = 'Please provide the price';
    hasErrors = true;
  } else {
    priceErrorContainer.textContent = '';
  }

  // PRODUCT TYPE
  if (selectedOption === '') {
    productErrorContainer.textContent = 'Please select a product type';
    hasErrors = true;
  } else {
    productErrorContainer.textContent = '';
  }

  // DVD
  if (selectedOption === 'DVD') {
    const size = document.getElementById('dvd').value.trim();
    if (size === '') {
      document.getElementById('size-error').textContent = 'Please provide the size';
      hasErrors = true;
    } else {
      document.getElementById('size-error').textContent = '';
      formData.append('size', size);
    }

    // BOOK
  } else if (selectedOption === 'book') {
    const weight = document.getElementById('weight').value.trim();
    if (weight === '') {
      document.getElementById('weight-error').textContent = 'Please provide the weight';
      hasErrors = true;
    } else {
      document.getElementById('weight-error').textContent = '';
      formData.append('weight', weight);
    }

    // FURNITURE
  } else if (selectedOption === 'furniture') {
    const height = document.getElementById('height').value.trim();
    const width = document.getElementById('width').value.trim();
    const length = document.getElementById('length').value.trim();

    if (height === '') {
      document.getElementById('height-error').textContent = 'Please provide the height';
      hasErrors = true;
    } else {
      document.getElementById('height-error').textContent = '';
      formData.append('height', height);
    }

    if (width === '') {
      document.getElementById('width-error').textContent = 'Please provide the width';
      hasErrors = true;
    } else {
      document.getElementById('width-error').textContent = '';
      formData.append('width', width);
    }

    if (length === '') {
      document.getElementById('length-error').textContent = 'Please provide the length';
      hasErrors = true;
    } else {
      document.getElementById('length-error').textContent = '';
      formData.append('length', length);
    }
  }

  if (hasErrors) {
    return;
  }

  // Prepare the form data to send
  formData.append('sku', sku);
  formData.append('name', name);
  formData.append('price', price);
  formData.append('productType', selectedOption);

  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();

  // AJAX request
  xhr.open('POST', '../controllers/ProductController.php', true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

  // Define callback function to handle AJAX response
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        console.log(xhr.responseText);
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
          priceErrorContainer.textContent = '';
          document.getElementById('size-error').textContent = ''; 
          document.getElementById('weight-error').textContent = ''; 
          document.getElementById('height-error').textContent = ''; 
          document.getElementById('width-error').textContent = ''; 
          document.getElementById('length-error').textContent = ''; 

          // Update SKU error element
          if (errors.skuError) {
            skuErrorContainer.textContent = errors.skuError;
          }

          // Update name error element
          if (errors.nameError) {
            nameErrorContainer.textContent = errors.nameError;
          }

          // Update price error element
          if (errors.priceError) {
            priceErrorContainer.textContent = errors.priceError;
          }

          // Update product type error element
          if (errors.dvdError) {
            document.getElementById('size-error').textContent = errors.dvdError;
          }

          if (errors.bookError) {
            document.getElementById('weight-error').textContent = errors.bookError;
          }

          if (errors.heightError) {
            document.getElementById('height-error').textContent = errors.heightError;
          }
          if (errors.widthError) {
            document.getElementById('width-error').textContent = errors.widthError;
          }
          if (errors.lengthError) {
            document.getElementById('length-error').textContent = errors.lengthError;
          }

        }
      } else {
        console.error('Error:', xhr.status);
        console.log(xhr.responseText);
      }
    }
  };

  // Send AJAX request with the form data
  xhr.send(formData);
});


