<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="tpl/questions/questions.css">
   
</head>
<body>
    <!-- navigation bar -->
    <?php include __DIR__ . '/../../components/navbar/navbar.php'; ?>

    <section class="hero flex full">
    </section>

    <section class="form flex justify-content-between align-items-center column my-5">
        <div class="container">
            <div class="row">
                <div class="col-md d-flex flex-column" id="thanks-message">
                    <h1 class="my-2 py-4">Want to support our cause? Contact us today.</h1>
                    <p>Culiat, Quezon City</p>
                    <p>Pinagbuhatan, Pasig City</p>
                    <p>colorsoflife.ph@gmail.com</p>
                    <p>+63999 172 5157</p>
                </div>
                <div class="col-md d-flex flex-column my-2 py-4" id="message-inputs">
                    <form class="form-card" action="DB/postListener.php" method="post">
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex"> <input type="text" id="name" name="name" placeholder="Name" required"> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <input type="text" id="email" name="email" placeholder="Email" required"> </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex"> <input type="tel" id="phone" name="phone" placeholder="Phone" required"> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <input type="text" id="address" name="address" placeholder="Address" required"> </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-12 flex-column d-flex"> <input type="text" id="subject" name="subject" placeholder="Subject" required> </div>
                        </div>
                        <div class="message row justify-content-between text-left">
                            <div class="form-group col-12 flex-column d-flex">
                                <input type="text" id="message" name="message" placeholder="Type your message here..." required class="taller-textbox">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-sm-6"> <button type="submit" name="form_action" value="sendMessage" class="btn-block btn-primary">Submit</button> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="maps flex justify-content-between align-items-center column text-center">
        <div class="container">
            <div class="row">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d17840.96011093161!2d121.02889573485531!3d14.646402204519275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b75ed7edddd9%3A0xd3d232f82279f418!2sColors%20of%20Life!5e0!3m2!1sen!2sph!4v1705095358917!5m2!1sen!2sph"
                    style="width: 100%; height: 450px; border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- footer bar -->
    <?php include __DIR__ . '/../../components/footer/footer.php'; ?>
</body>
</html>
