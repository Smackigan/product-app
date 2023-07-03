<?php

session_start();

require_once('..\models\ProductsTable.php');

$productsTable = new ProductsTable();
$products = $productsTable->getAllProducts();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product list</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>



    <div class="d-flex justify-content-between my-4 mx-4 px-4">
        <h2 class="px-4 my-auto">Product List</h2>

        <div class="btns px-4 my-auto">
            <a href="add_product.view.php" type="button"><button id="add-product-btn">ADD</button></a>
            <button type="submit" id="delete-product-btn">MASS DELETE</button>
        </div>
    </div>
    <hr>
    <div class="">
        <!-- Display the list of products from the databas -->

        <form action="../Controller/deleteProductController.php" method="POST" id="product-list-form">
            <?php if (!empty($products)) : ?>
                <div class="row px-5">
                    <?php foreach ($products as $product) : ?>
                        <div class="col-md-3 p-4 mb-4">
                            <div class="border border-2">
                                <div class="card-body p-4">
                                    <div>
                                        <input class="form-check-input" type="checkbox" class="delete-checkbox">
                                    </div>
                                    <div class="text-center lh-1">
                                        <p><?php echo $product->getSku(); ?></p>
                                        <p><?php echo $product->getName(); ?></p>
                                        <p><?php echo $product->getPrice(); ?></p>
                                        <p><?php echo $product->getValue(); ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </form>
    </div>


    <?php include_once "../components/footer.php"; ?>
</body>

</html>