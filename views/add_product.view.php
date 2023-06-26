<?php

session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <form action="/controllers/ProductController.php" method="POST" id="product_form" class="ms-3">
        <header>
            <nav>
                <div class="d-flex justify-content-between my-4 mx-4">
                    <h2 class="">Product Add</h2>

                    <div class="btns">
                        <a href="#" type="button"><button id="save-btn" onclick="">Save</button></a>
                        <a href="#" type="button"><button id="cancel-btn">Cancel</button></a>
                    </div>
                </div>
            </nav>
        </header>
        <hr>
        <div>

            <div class="mb-3 d-flex">
                <label class="form-label col-2" for="sku">SKU</label>
                <input class="form-control w-25" type="text" id="sku" name="sku">
                <div id="sku-error" class="sku-error-message"></div>
            </div>

            <div class="mb-3 d-flex">
                <label class="form-label col-2" for="name">Name</label>
                <input class="form-control w-25" type="text" id="name" name="name">
                <div id="name-error" class="name-error-message"></div>
            </div>

            <div class="mb-3 d-flex">
                <label class="form-label col-2" for="price">Price ($)</label>
                <input class="form-control w-25" type="number" id="price">
            </div>

            <div class="mb-3 d-flex">
                <label class="form-label col-2">Type Switcher</label>
                <select class="form-control w-25" id="productType">
                    <option value="">Choose product type</option>
                    <option value="DVD">DVD</option>
                    <option value="book">Book</option>
                    <option value="furniture">Furniture</option>
                </select>
            </div>

            <br>

            <div id="option_fields">
                <div id="DVD" class="d-none mb-3 d-flex row option">
                    <p>Please, provide size of DVD in MB</p>
                    <label class="form-label col-2">Size (MB)</label>
                    <input class="form-control w-25" name="size" type="text" id="size">
                </div>

                <div id="furniture" class="d-none option">
                    <p>Please provide dimensions in HxWxL format</p>
                    <div class="mb-3 d-flex row">
                        <label class="form-label col-2">Height (CM)</label>
                        <input type="number" name="height" class="form-control w-25" id="height">
                    </div>
                    <div class="mb-3 d-flex row">
                        <label class="form-label col-2">Width (CM)</label>
                        <input type="number" name="width" class="form-control w-25" id="width">
                    </div>
                    <div class="mb-3 d-flex row">
                        <label class="form-label col-2">Length (CM)</label>
                        <input type="number" name="length" class="form-control w-25" id="length">
                    </div>
                </div>

                <div id="book" class="d-none mb-3 d-flex row option">
                    <p>Please, provide weigth of the book</p>
                    <label class="form-label col-2">Weight (KG)</label>
                    <input class="form-control w-25" name="weight" type="text" id="weight">
                </div>
            </div>


    </form>
    </div>

    <?php include_once "../components/footer.php"; ?>
    <script src="../js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>


</html>