<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

<nav class="navbar navbar-expand-lg fixed-top bg-light navbar-light">
  <div class="container">
    <a class="navbar-brand" href="#">
        <img
        id="COL-logo"
        src="assets/pics/colors-of-life-logo.png"
        alt="COL Logo"
        draggable="false"
        height="40"
        />
        Colors of Life
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item">
                <a class="nav-link mx-2" href="?filename=home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-2" href="?filename=aboutUs">Get to Know Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-2" href="?filename=joinTeam">Join Our Team</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-2" href="?filename=donate">Ways to Help</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-2" href="?filename=questions">Got Questions?</a>
            </li>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>

                <li class="nav-item">
                    <a class="nav-link mx-2" href="?filename=orders">Orders</a>
                </li>

            <?php } else { ?>
                
            <?php } ?>

            <?php if (isset($_SESSION['user_id'])) { ?>
                <li class="nav-item">
                <a class="nav-link mx-2" href="?filename=cart"><span class="material-symbols-outlined">shopping_bag</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mx-2" href="?filename=profile"><span class="material-symbols-outlined">account_circle</span></a>
                </li>
            <?php } ?>

            <?php if (isset($_SESSION['user_id'])) { ?>
                <li class="nav-item ms-3">
                    <a class="btn btn-black btn-rounded" id="logout" href="<?='./components/logout.php'; ?>">Logout</a>
                </li>

            <?php } else { ?>
                <!-- If user is not logged in, display the Sign in button -->
                <li class="nav-item ms-3">
                    <a class="btn btn-black btn-rounded" href="?filename=signin">Sign in</a>
                </li>
            <?php } ?>
      </ul>
    </div>
  </div>
</nav>