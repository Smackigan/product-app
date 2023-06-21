<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <header>
        <nav>
            <div class="d-flex justify-content-between my-4 mx-4">
                <h2 class="">Product Add</h2>

                <div class="btns">
                    <a href="#" type="button"><button id="save-btn">Save</button></a>
                    <a href="#" type="button"><button id="cancel-btn">Cancel</button></a>
                </div>
            </div>
        </nav>
    </header>
    <hr>
    <div>
        <form action="" method="POST" id="product_form" class="ms-3">
            <div class="mb-3 d-flex">
                <label class="form-label col-2" for="sku">SKU</label>
                <input class="form-control w-25" type="text" id="sku" required>
            </div>

            <div class="mb-3 d-flex">
                <label class="form-label col-2" for="name">Name</label>
                <input class="form-control w-25" type="text" id="name" required>
            </div>

            <div class="mb-3 d-flex">
                <label class="form-label col-2" for="price">Price ($)</label>
                <input class="form-control w-25" type="number" id="price" required>
            </div>

            <div class="mb-3 d-flex">
                <label class="form-label col-2">Type Switcher</label>
                <select class="form-control w-25" id="productType" required>
                    <option value="">Choose product type</option>
                    <option value="DVD" >DVD</option>
                    <option value="book" >Book</option>
                    <option value="furniture">Furniture</option>
                </select>
            </div>

    <br>

            <div id="option_fields">
                <div id="DVD" class="hidden mb-3 d-flex row">
                    <p>Please, provide size of DVD in MB</p>
                    <label class="form-label col-2">Size (MB)</label>
                    <input class="form-control w-25" name="size" type="text" id="size" required>
                </div>

                <div id="furniture" class="hidden">
                <p>Please provide dimensions in HxWxL format</p>
                    <div class="mb-3 d-flex row">
                        <label class="form-label col-2">Height (CM)</label>
                        <input type="number" name="height" class="form-control w-25" id="height" required>
                    </div>
                    <div class="mb-3 d-flex row">
                        <label class="form-label col-2">Width (CM)</label>
                        <input type="number" name="width" class="form-control w-25" id="width" required>
                    </div>
                    <div class="mb-3 d-flex row">
                        <label class="form-label col-2">Length (CM)</label>
                        <input type="number" name="length" class="form-control w-25" id="length" required>
                    </div>
                </div>

                <div id="book" class="hidden mb-3 d-flex row">
                    <p>Please, provide weigth of the book</p>
                    <label class="form-label col-2">Weight (KG)</label>
                    <input class="form-control w-25" name="weight" type="text" id="weight" required>
                </div>
            </div>
            
            
        </form>
    </div>

    <?php include_once "../components/footer.php"; ?>
</body>


</html>