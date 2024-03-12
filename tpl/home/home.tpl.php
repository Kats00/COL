<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Colors of Life</title>
    <meta name="description" content="The website for Colors of Life">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="assets/pics/logo-white.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="tpl/home/home.css">

    <style>
        .hero-bg {
            height: 100%;
            width: 100%;
            background-image: url("https://static.wixstatic.com/media/992931_c8161410131542898b76fcfd3e17ac43~mv2.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: fixed; 
            overflow: hidden; 
            z-index: -99;
        }

        .what-we-do-section, .story{
            background-color: var(--white);
            width: 100vw;
        }

    </style>
</head>
<body>

    <!-- navigation bar -->
    <?php include __DIR__ . '/../../components/navbar/navbar.php'; ?>

    <div class="hero-bg"></div>
    <section class="hero full flex justify-content-between align-items-center column">
        <div class="hero-contents flex justify-content-center align-items-center column">
            <img src="assets/pics/colors-of-life-logo2.png" alt="colors of life">
            <h1>
                Let's Share the Love and Happiness!
            </h1>
        </div>

        <div class="hero-contents button-cont flex row">
            <a href="?filename=donate"><button type="button" class="btn btn-default">Donate</button></a>
            <a href="?filename=joinTeam"><button type="button" class="btn btn-primary">Volunteer</button></a>
        </div>
    </section>

    <section class="video">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 mb-3 mb-md-0">
                    <div class="d-flex justify-content-center align-items-center flex-column h-100">
                        <h1 id="video-title">Upcoming Outreach Project</h1>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/RI_Z2uzqp0I?si=7ykViS5kY6fJcRTY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <div class="d-flex justify-content-center align-items-center flex-column h-100">
                        <p class="description">
                            Another colorful adventure begins!
                            <br><br>
                            As part of our Balik Eskwela 2023, we are excited to return to the community we visited during our first-anniversary outreach in 2019.
                            <br><br>
                            Join us as we take you on a captivating ocular journey, revisiting the Dumagat Remontado community in Sitio Kabuoan, Brgy. Puray, Rodriguez, Rizal!
                            <br><br>
                            <u>#balikeskwela2023</u>
                            <br>
                            <u>#colorsoflifeoutreach</u>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="what-we-do-section">
        <div class="what-we-do container flex justify-content-center align-items-center column">
            <div class="title flex justify-content-center align-items-center">
                <h1>What We Do</h1>
            </div>
            <div class="row">
                <div class="col-sm d-flex flex-column justify-content-center align-items-center text-center">
                    <img src="assets/pics/plate.png" alt="bitten plate">
                    <p>Our mission involves supplying food to indigenous communities we visit, driven by our aspiration to create a community free from hunger among children and parents.</p>
                    <a href="?filename=aboutUs"><button type="button" class="btn btn-primary">Learn More</button></a>
                </div>
                <div class="col-sm d-flex flex-column justify-content-center align-items-center text-center">
                    <img src="assets/pics/bag.png" alt="bag">
                    <p>We strive to reach out, ignite inspiration, and nurture the academic pursuits of every underprivileged child in need of educational assistance.</p>
                    <a href="?filename=aboutUs"><button type="button" class="btn btn-primary">Learn More</button></a>
                </div>
                <div class="col-sm d-flex flex-column justify-content-center align-items-center text-center">
                    <img src="assets/pics/farmer.png" alt="farmer">
                    <p>Our aim is to uplift the livelihoods of tribal communities by enhancing their socio-economic conditions and ensuring access to essential necessities.</p>
                    <a href="?filename=aboutUs"><button type="button" class="btn btn-primary">Learn More</button></a>
                </div>
            </div>
        </div>
    </section>


    <section class="m-0 p-0">
        <div class="stats m-0 p-0">
            <div class="row m-0 p-0">
                <div class="col-md d-flex flex-column justify-content-center align-items-center text-center m-0 p-0" id="kid-container">
                    <h1>1300+</h1>
                    <h2>Kids</h2>
                </div>
                <div class="col-md d-flex flex-column justify-content-center align-items-center text-center m-0 p-0" id="bag-container">
                    <h1>18+</h1>
                    <h2>Indigenous Communities</h2>
                </div>
                <div class="col-md d-flex flex-column justify-content-center align-items-center text-center m-0 p-0" id="farmer-container">
                    <h1>60+</h1>
                    <h2>Active Volunteers</h2>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="story m-0 p-0">
            <div class="row m-0 p-0">
                <div class="col-story col-md d-flex flex-column justify-content-between align-items-left">
                    <h1>THE COL STORY</h1>
                    <p><b>Colors of Life</b> was established in 2018 with the aim of helping underprivileged street children and indigenous communities.</p>
                    <br><br>
                    <p>Initially focused on supporting foundation and street children, our journey took an enriching turn as we immersed ourselves in the lives of indigenous communities, discovering a profound appreciation for their vibrant cultures, cherished traditions, and warm hospitality. This newfound connection fueled our passion to extend our support and embrace the unique needs and aspirations of these remarkable communities.</p>
                    <a href="?filename=aboutUs"><button type="button" class="btn btn-primary">Learn More</button></a>
                </div>
                <div class="col-md d-flex flex-column justify-content-center align-items-center text-center m-0 p-0" id="story-container">
                </div>
            </div>
        </div>
    </section>

    <!-- footer bar -->
    <?php include __DIR__ . '/../../components/footer/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
