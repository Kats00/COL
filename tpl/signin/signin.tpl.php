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

                            <h3 class="mb-2">Login</h3>
                            <p>Don't have an account? <a href="?filename=register">Sign Up!</a></p>

                            <form action="DB/postListener.php" method="post">
                                <div class="form-outline mb-4">
                                    <input type="email" id="login_email" name="login_email" class="form-control form-control-lg" placeholder="Email" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="login_password" name="login_password" class="form-control form-control-lg" placeholder="Password" required />
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check d-flex justify-content-start mb-4">
                                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                                    <label class="form-check-label" for="form1Example3"> Remember password </label>
                                </div>

                                <button class="login-button btn btn-primary btn-lg btn-block" type="submit" name="form_action" value="signin">Login</button>
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
