<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Colors of Life</title>
    <meta name="description" content="The website for Colors of Life">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="assets/pics/logo-white.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="tpl/signin/signin.css">
   
</head>
<body>
    <!-- navigation bar-->
    <?php include __DIR__ . '/../../components/navbar/navbar.php'; ?>


    <section class="login vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                                <h3 class="mb-2">Sign Up</h3>
                                <p>Have an account? <a href="?filename=signin">Login!</a></p>
                                <form action="DB/postListener.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="profile_picture">Profile Picture</label>
                                        <input type="file" class="form-control-file" id="profile_picture" name="profile_picture" accept="image/*">
                                    </div>
                    
                                   <div class="form-outline mb-4">
                                       <input type="text" id="first_name" name="first_name" class="form-control form-control-lg" placeholder="First Name" required/>
                                   </div>
                                   <div class="form-outline mb-4">
                                       <input type="text" id="last_name" name="last_name" class="form-control form-control-lg" placeholder="Surname" required/>
                                   </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" id="signup_email" name="signup_email" class="form-control form-control-lg" placeholder="Email" required/>
                                    </div>
                                  
                                    <div class="form-outline mb-4">
                                        <input type="password" id="signup_password" name="signup_password" class="form-control form-control-lg" placeholder="Password" required/>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="password_confirm" name="password_confirm" class="form-control form-control-lg" placeholder="Confirm Password" required/>
                                    </div>
                                
                                    <div class="form-outline mb-4">
                                        <input type="text" id="contact_num" name="contact_num" class="form-control form-control-lg" placeholder="Cellphone Number" required/>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="text" id="address" name="address" class="form-control form-control-lg" placeholder="Address" required/>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="user_type" id="admin" value="admin" checked>
                                        <label class="form-check-label" for="admin">
                                            admin
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="user_type" id="user" value="user">
                                        <label class="form-check-label" for="user">
                                            user
                                        </label>
                                    </div>

                                    <button class="register-button btn btn-primary btn-lg btn-block" type="submit" name="form_action" value="register">Register</button>
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
