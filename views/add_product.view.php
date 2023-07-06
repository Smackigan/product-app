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

<body class="">
    <form action="/controllers/ProductController.php" method="POST" id="product_form" >
        <header>

                <div class="d-flex justify-content-between my-5 px-4 border-bottom border-1 border-secondary">
                    <h2 class="px-4 mb-4">Product Add</h2>

                    <div class="btns px-4">
                        <a href="#" type="button"><button id="save-btn" onclick="">Save</button></a>
                        <a href="#" type="button"><button id="cancel-btn" onclick="">Cancel</button></a>
                    </div>
                </div>
        </header>
        <div class="ms-5">

            <div class="mb-3 d-flex">
                <label class="form-label col-2 my-auto" for="sku">SKU</label>
                <input class="form-control w-25" type="text" id="sku" name="sku">
                <div id="sku-error" class="sku-error-message ms-2 my-auto"></div>
            </div>

            <div class="mb-3 d-flex">
                <label class="form-label col-2 my-auto" for="name">Name</label>
                <input class="form-control w-25" type="text" id="name" name="name">
                <div id="name-error" class="name-error-message ms-2 my-auto"></div>
            </div>

            <div class="mb-3 d-flex">
                <label class="form-label col-2 my-auto" for="price">Price ($)</label>
                <input class="form-control w-25" type="number" id="price" name="price">
                <div id="price-error" class="price-error-message ms-2 my-auto"></div>
            </div>

            <div class="mb-3 d-flex">
                <label class="form-label col-2 my-auto">Type Switcher</label>
                <select class="form-control w-25" id="productType">
                    <option value="">Choose product type</option>
                    <option value="DVD">DVD</option>
                    <option value="book">Book</option>
                    <option value="furniture">Furniture</option>
                </select>
                <div id="product-error" class="product-error-message my-auto ms-2"></div>
            </div>

            <br>

            <div id="option_fields">
                <div id="DVD" class="d-none row option my-auto">
                    <p>Please, provide size of DVD in MB</p>
                    <div class="d-flex">
                        <label class="form-label col-2 my-auto">Size (MB)</label>
                        <input class="form-control w-25" type="number" id="dvd" name="dvd">
                        <div id="size-error" class="size-error-message ms-2 my-auto"></div>
                    </div>
                </div>

                <div id="book" class="d-none mb-3 d-flex row option my-auto">
                    <p>Please, provide weigth of the book</p>
                    <div class="d-flex">
                        <label class="form-label col-2 my-auto">Weight (KG)</label>
                        <input class="form-control w-25" name="weight" type="number" id="weight">
                        <div id="weight-error" class="weight-error-message ms-2 my-auto"></div>
                    </div>
                </div>

                <div id="furniture" class="d-none option">
                    <p>Please provide dimensions in HxWxL format:</p>
                    <div class="mb-3 d-flex row">
                        <div class="d-flex">
                            <label class="form-label col-2 my-auto">Height (CM)</label>
                            <input type="number" name="height" class="form-control w-25" id="height">
                            <div id="height-error" class="height-error-message ms-2 my-auto"></div>
                        </div>
                    </div>
                    <div class="mb-3 d-flex row">
                        <div class="d-flex">
                            <label class="form-label col-2 my-auto">Width (CM)</label>
                            <input type="number" name="width" class="form-control w-25" id="width">
                            <div id="width-error" class="width-error-message ms-2 my-auto"></div>
                        </div>
                    </div>
                    <div class="mb-3 d-flex row">
                        <div class="d-flex">
                            <label class="form-label col-2 my-auto">Length (CM)</label>
                            <input type="number" name="length" class="form-control w-25" id="length">
                            <div id="length-error" class="length-error-message ms-2 my-auto"></div>
                        </div>
                    </div>
                </div>

            </div>

    </form>
    </div>

    <?php include_once "../components/footer.php"; ?>
    <script src="../js/addProduct.js"></script>
</body>


</html>