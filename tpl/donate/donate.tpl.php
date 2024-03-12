<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Colors of Life</title>
    <meta name="description" content="The website for Colors of Life">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="assets/pics/logo-white.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="tpl/donate/donate.css?>">

    <style>
        .editButton, .deleteButton, .addToCart {
            display: none;
        }

        .item-box-blog-image figure img{
            display: flexbox;
            height: 200px;
            image-rendering: auto;
        }

        .item-box-blog-image figure {
            display: flexbox;
            height: 170px;
        }

        .item-box-blog-heading h5 {
            margin-top: 1rem;
        }

        .quantity-section {
            margin-bottom: 1rem;
        }

        .addToCart {
            margin-top: 2rem !important;
        }

        .addProductCont {
            display: flex;
            margin-top: 5rem !important;
            justify-content: center;
            align-items: center;
        }

        section {
            margin-top: 5rem;
        }

        .row h3 {
            color: var(--blue);
            font-weight: bolder;
            margin-top: 4rem;
            margin-bottom: 2rem;
        }
        
    </style>

</head>
<body>
    <!-- navigation bar -->
    <?php include __DIR__ . '/../../components/navbar/navbar.php'; ?>

    <div class="addProductCont my-4">
        <?php if ($_SESSION['role'] == 'admin') { ?>
            <a href="?filename=addProduct" class="btn btn-primary">Add Product</a>
        <?php } ?>
    </div>
    
    <section>
        <?php include __DIR__ . '/../../components/carousel/carousel.php'; ?>
    </section>
    
    <?php include __DIR__ . '/../../components/editModal/editModal.php'; ?>

    <div id="user-id-container" data-user-id="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>"></div>
    <div id="user-type-container" data-user-role="<?php echo isset($_SESSION['role']) ? $_SESSION['role'] : ''; ?>"></div>
    
    <!-- footer bar -->
    <?php include __DIR__ . '/../../components/footer/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="tpl/donate/donate.js"></script>
</body>
</html>
