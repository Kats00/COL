<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Colors of Life</title>
    <meta name="description" content="The website for Colors of Life">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="assets/pics/logo-white.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="tpl/aboutUs/aboutUs.css">
   
</head>
<body>
    <!-- navigation bar -->
    <?php include __DIR__ . '/../../components/navbar/navbar.php'; ?>

    <section class="hero flex full">
    </section>

    <section class="story flex justify-content-between align-items-center column text-center">
        <h1>THE COL STORY</h1>
        <br>
        <p>Colors of Life was established in 2018 with the aim of helping underprivileged street children and indigenous communities.</p>
        <br>
        <p>Initially focused on supporting foundation and street children, our journey took an enriching turn as we immersed ourselves in the lives of indigenous communities, discovering a profound appreciation for their vibrant cultures, cherished traditions, and warm hospitality. This newfound connection fueled our passion to extend our support and embrace the unique needs and aspirations of these remarkable communities.</p>
    </section>

    <section>
        <div class="story m-0 p-0">
            <div class="row m-0 p-0">
                <div class="col-md d-flex flex-column justify-content-center align-items-center text-center m-0 p-0" id="story-container">
                </div>
                <div class="col-story col-md d-flex flex-column justify-content-between align-items-left">
                    <p><b>Our Vision</b>
                    <br>
                    <p>Enriching lives through education and livelihood to create a sustainable and self-sufficient community.</p>
                    <br><br>
                    <p><b>Our Mission</b>
                    <br>
                    <p>To extend helping hands, inspire and build the passion for every child who is in need of educational support.</p>
                    <p>Give assistance to tribe communities by improving livelihood status and providing other necessities.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- footer bar -->
    <?php include __DIR__ . '/../../components/footer/footer.php'; ?>
</body>
</html>
