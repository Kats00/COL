<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Colors of Life</title>
    <meta name="description" content="The website for Colors of Life">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="assets/pics/logo-white.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="tpl/profile/profile.css">
   
</head>
<body>
    <!-- navigation bar -->
    <?php include __DIR__ . '/../../components/navbar/navbar.php'; ?>

    <div id="user-id-container" data-user-id="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>"></div>
    
    <div class="container">
    <div class="main-body my">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
            <div class="row gutters-sm" >
                <div class="col-md-5 mb-3">
                    <div class="card">
                        <div class="card-body" id="user-card">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="assets/Uploads/noPic.png" alt="profile picture" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>FirstName LastName</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="card mt-3">
                    <div class="card-body" id="user-details">
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            Kenneth Valdez
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            fip@jukmuh.al
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            (239) 816-9029
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Mobile</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            (320) 380-4539
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            Bay Area, San Francisco, CA
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
              <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Date Ordered</th>
                                <th scope="col">Status</th>
                                <th scope="col">Items (qty)</th>
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

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editProfileForm" action="DB/postListener.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                        
                        <div class="form-group">
                            <label for="profile_picture">Profile Picture:</label>
                            <input type="file" class="form-control-file" id="profile_picture" name="profile_picture" accept="image/*">
                        </div>
                        
                        <div class="form-outline mb-4">
                            <input type="text" id="first_name" name="first_name" class="form-control form-control-lg" placeholder="First Name" required/>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="text" id="last_name" name="last_name" class="form-control form-control-lg" placeholder="Surname" required/>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" required/>
                        </div>
                    
                        <div class="form-outline mb-4">
                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required/>
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
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="user_type" id="user" value="user">
                            <label class="form-check-label" for="user">
                                user
                            </label>
                        </div>
                        <?php } ?>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="submit btn btn-primary" type="submit" name="form_action" value="editProfile">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- footer bar -->
    <?php include __DIR__ . '/../../components/footer/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="tpl/profile/profile.js"></script>
</body>
</html>