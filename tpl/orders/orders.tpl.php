<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="tpl/orders/orders.css?>">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

   
</head>
<body>
    <!-- navigation bar -->
    <?php include __DIR__ . '/../../components/navbar/navbar.php'; ?>

    <section class="intro">
        <div class="bg-image h-100">
            <div class="mask d-flex align-items-center h-100" style="background-color: rgba(25, 185, 234,.25);">
            <div class="container">
                <div class="table-row row justify-content-center">
                    <h1 class="my-5">Orders</h1>
                <div class="col-12">
                    <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Date Ordered</th>
                                <th scope="col">Status</th>
                                <th scope="col">Customer Email</th>
                                <th scope="col">Ordered Products (qty)</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>
   

    <div id="user-id-container" data-user-id="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>"></div>

    <!-- footer bar -->
    <?php include __DIR__ . '/../../components/footer/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="tpl/orders/orders.js"></script>
</body>
</html>