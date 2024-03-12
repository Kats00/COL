<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="tpl/signin/signin.css">
   
</head>
<body>
    <!-- navigation bar -->
    <?php include __DIR__ . '/../../components/navbar/navbar.php'; ?>

    <section class="login vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-2">Add Product</h3>

                            <form action="DB/postListener.php" method="post" enctype="multipart/form-data">

                                <div class="form-group mb-4">
                                    <label for="edit_product_picture">Product Picture:</label>
                                    <input type="file" class="form-control-file" id="product_picture" name="product_picture" accept="image/*">
                                </div>
                            
                                <div class="form-outline mb-4">
                                    <input type="text" id="product_name" name="product_name" class="form-control form-control-lg" placeholder="Product Name" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="num" id="product_price" name="product_price" class="form-control form-control-lg" placeholder="Product Price" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="num" id="product_qty" name="product_qty" class="form-control form-control-lg" placeholder="Quantity" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="text" id="product_description" name="product_description" class="form-control form-control-lg" placeholder="Product Description" required />
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="product_for" id="kid" value="kid" checked>
                                    <label class="form-check-label" for="kid">
                                        For the Kids
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="product_for" id="com" value="com">
                                    <label class="form-check-label" for="com">
                                        For the Community
                                    </label>
                                </div>


                                <button class="login-button btn btn-primary btn-lg btn-block" type="submit" name="form_action" value="addProduct">Add Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- footer bar -->
    <?php include __DIR__ . '/../../components/footer/footer.php'; ?>
</body>
</html>
