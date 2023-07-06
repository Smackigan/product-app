// MASS DELETE function
const deleteBtn = document.getElementById('delete-product-btn');
deleteBtn.addEventListener('click', select);

function select() {
    let checkboxes = document.getElementsByClassName('delete-checkbox');
    let selectedIDs = [];

    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = true;
        if (checkboxes[i].checked) {
            let id = checkboxes[i].name;
            selectedIDs.push(id);
        }
    }
    console.log(selectedIDs);


    if (selectedIDs.length > 0) {

        // Prepare data
        let data = JSON.stringify({ selectedIDs: selectedIDs });
        console.log(data);

        // Send AJAX request to server
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../controllers/DeleteProductsController.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    
                    try {
                        const response = JSON.parse(xhr.responseText);
                        console.log(response);
        
                        if (response.success) {
                            // Data deleted
                            window.location.href = '../views/home.view.php'; 
                            console.log('Deletion successful');
                        } else {
                            console.log('Deletion unsuccessful');
                            console.error('Error:', xhr.status);
                        }
                    } catch (error) {
                        console.error('Error parsing JSON:', error);
                    }
                }
            }
        };

        xhr.send(data);
    }
}
