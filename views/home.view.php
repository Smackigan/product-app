<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <form action="../Controller/deleteProductController.php" method="POST" id="product-list-form">

            <div class="d-flex justify-content-between my-4 mx-4">
                <h2 class="">Product List</h2>

                <div class="btns">
                    <a href="#" type="button"><button id="add-product-btn">ADD</button></a>
                    <button type="submit" id="delete-product-btn">MASS DELETE</button>
                </div>
            </div>
        <hr>
        <div>
            <!-- Display the list of products from the databas -->
        </div>
    </form>

    <?php include_once "../components/footer.php"; ?>
</body>

</html>