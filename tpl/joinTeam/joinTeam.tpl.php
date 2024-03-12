<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Colors of Life</title>
    <meta name="description" content="The website for Colors of Life">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="assets/pics/logo-white.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="tpl/joinTeam/joinTeam.css?>">
   
</head>
<body>
    <!-- navigation bar -->
    <?php include __DIR__ . '/../../components/navbar/navbar.php'; ?>

    <section class="hero flex full">
    </section>

    <section class="story flex justify-content-between align-items-center column text-center">
        <h1>Volunteer</h1>
        <br>
        <p>Volunteering for Colors of Life's cause presents a remarkable opportunity to be a catalyst for change and join a vibrant community of individuals dedicated to making a difference. With a strong foundation established in 2018, boasting <b>80+ active volunteers</b>, Colors of Life has consistently driven impactful initiatives that span from livelihood development to educational outreach.</p>
        <br>
        <p>By becoming a part of this passionate team, volunteers not only contribute to ongoing projects but also amplify their impact through collective action. Whether it's through organizing events, conducting workshops, or lending a helping hand to the underserved, volunteering with Colors of Life means embracing a meaningful journey of shared purpose and leaving a lasting positive imprint on every community we reach.</p>
        <a href="?filename=questions"><button type="button" class="btn btn-primary">Join Team</button></a>
    </section>

    <section class="sponsors flex justify-content-between align-items-center column text-center">
        <div class="container">
            <h1>Thanks to Our Sponsors</h1>
            <div class="row">
                <div class="col-md d-flex flex-column" id="sponsor1"></div>
                <div class="col-md d-flex flex-column" id="sponsor2"></div>
                <div class="col-md d-flex flex-column" id="sponsor3"></div>
            </div>
        </div>
    </section>

    <section class="story flex justify-content-between align-items-center column text-center">
        <h3>If you're interested in sponsoring us, <u><a href="">please send us a message</a></u></h3>
    </section>

    <!-- footer bar -->
    <?php include __DIR__ . '/../../components/footer/footer.php'; ?>
</body>
</html>
