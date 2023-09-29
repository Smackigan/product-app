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
const cancelBtn = document.getElementById('cancel-btn');
cancelBtn.addEventListener('click', function (e) {
	e.preventDefault();
	window.location.href = 'home.view.php';
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
		const size = document.getElementById('size').value.trim();
		if (size === '') {
			document.getElementById('size-error').textContent =
				'Please provide the size';
			hasErrors = true;
		} else {
			document.getElementById('size-error').textContent = '';
			formData.append('size', size);
		}

		// BOOK
	} else if (selectedOption === 'book') {
		const weight = document.getElementById('weight').value.trim();
		if (weight === '') {
			document.getElementById('weight-error').textContent =
				'Please provide the weight';
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
			document.getElementById('height-error').textContent =
				'Please provide the height';
			hasErrors = true;
		} else {
			document.getElementById('height-error').textContent = '';
			formData.append('height', height);
		}

		if (width === '') {
			document.getElementById('width-error').textContent =
				'Please provide the width';
			hasErrors = true;
		} else {
			document.getElementById('width-error').textContent = '';
			formData.append('width', width);
		}

		if (length === '') {
			document.getElementById('length-error').textContent =
				'Please provide the length';
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
				// console.log(xhr.responseText);
				const response = JSON.parse(xhr.responseText);

				if (response.success) {
					// Data successfully inserted
					console.log('Error success:', response);
					window.location.href = '../views/home.view.php';
				} else {
					// Display error messages
					console.log('Error response:', response);
					console.log('Errors:', response.errors);
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
					if (errors.sku) {
						skuErrorContainer.textContent = errors.sku;
					}

					// Update name error element
					if (errors.name) {
						nameErrorContainer.textContent = errors.name;
					}

					// Update price error element
					if (errors.price) {
						priceErrorContainer.textContent = errors.price;
					}

					// Update product type error element
					if (errors.size) {
						document.getElementById('size-error').textContent =
							errors.size;
					}

					if (errors.weight) {
						document.getElementById('weight-error').textContent =
							errors.weight;
					}

					if (errors.height) {
						document.getElementById('height-error').textContent =
							errors.height;
					}
					if (errors.width) {
						document.getElementById('width-error').textContent =
							errors.width;
					}
					if (errors.length) {
						document.getElementById('length-error').textContent =
							errors.length;
					}
				}
			} else {
				console.error('Error:', xhr.status);
				console.log(xhr.responseText);
			}
		}
	};

	console.log('Ready state:', xhr.readyState);
	console.log('Status:', xhr.status);
	// Send AJAX request with the form data
	xhr.send(formData);
});
