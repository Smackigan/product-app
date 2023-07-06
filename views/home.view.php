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
<header>
<?php include_once "../components/header.php"; ?>
</header>


    <div >
        <!-- Display the list of products from the databas -->

        <form action="/controllers/DeleteProductsController.php" method="POST" id="product-list-form">
            <?php if (!empty($products)) : ?>
                <div class="row px-5">
                    <?php foreach ($products as $product) : ?>
                        <div class="col-md-3 p-4 mb-4">
                            <div class="border border-2">
                                <div class="card-body p-4 pb-5">
                                    <div class="form-check-inline">
                                        <label class="form-check-inline">
                                            <input class="delete-checkbox form-check-input" form="delete-form" type="checkbox" id="checkbox" name="<?php echo $product->getId(); ?>">
                                            <?php $id = $product->getId(); ?>
                                        </label>
                                    </div>
                                    <div class="text-center lh-md">
                                        <p class="card-title"><?php echo $product->getSku(); ?></p>
                                        <p class="card-title"><?php echo $product->getName(); ?></p>
                                        <p class="card-title"><?php echo $product->getPrice(); ?></p>
                                        <p class="card-title"><?php echo $product->getValue(); ?></p>
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
    <script src="../js/index.js"></script>
</body>

</html>