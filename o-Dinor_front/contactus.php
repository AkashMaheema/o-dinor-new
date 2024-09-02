<!DOCTYPE html>

<head>
    <title>Contact Form</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <script src="https://kit.fontawesome.com/f29c112359.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/contactus.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="hero-wrap hero-bread" style="background-image: url('images/checkout.png')">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 text-center">
                    <h1 class="mb-0 bread">Get In Touch</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="contact-section bg-light">
        <div class="container">
            <div class="row d-flex contact-info">
                <div class="w-100"></div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p>
                            <span>Location</span>
                            <br>
                             Pitipana,Homagama
                        </p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p>
                            <span>Phone</span>
                            <br>
                            <a href="tel://1234567920">+94 333 3333 333</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p>
                            <span>Email</span>
                            <br>
                            <a href="mailto:info@yoursite.com">www.o-dinor.com</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p>
                            <span>Visit Between</span>
                            <br>
                            <a href="#">Mon-Sat 8.00-5.00 <br> Sunday Closed</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row block-9 contact-loc">
                <div class="col-md-6 d-flex">
                    <div class="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16788.598473788617!2d80.03319666444177!3d6.820592830666098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2523b05555555%3A0x546c34cd99f6f488!2sNSBM%20Green%20University!5e0!3m2!1sen!2slk!4v1724897421036!5m2!1sen!2slk"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                <div class="col-md-6 order-md-last d-flex">
                    <form action="#" class="bg-white p-2 contact-form">
                        <h1 class="text-center mb-5">Contact Us</h1>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Name" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Email" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Subject" />
                        </div>
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="7" class="form-control"
                                placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn py-3 px-5" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
</body>

</html>