<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Our Services</title>
    <link rel="shortcut icon" href="assets/images/logo/HH-logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/country-select-js@2.0.1/build/css/countrySelect.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/slick/slick.css">
    <link rel="stylesheet" href="assets/vendors/animation/animate.min.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendors/youtube-popup/youtube-popup.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <style>
        .site-footer {
            background-color: #004a44;
        }

        .page-header-heading {
            border-left: 0;
        }

        .page-header-section {
            background: url('assets/images/banner/investmemt-banner.webp') no-repeat center center/cover;
            position: relative;
            padding: 200px 0 250px 0;

        }

        .page-header-section::before {
            content: "";
            position: absolute;
            top: 30px;
            left: 133px;
            width: 250px;
            height: 50px;
            background: url('assets/images/logo/logo.svg') no-repeat left center;
            background-size: contain;
            z-index: 99;
        }

        .service-section-two.srvice {
            padding: 30px 0;
            background-color: #fff;
        }

        .service-section-two .heading-box {
            margin-bottom: 0;
        }

        .services-section .service-box {
            display: block;
            text-align: center;
            background: #fff;
            border-radius: 12px;
            padding: 0 0 20px 0;
            height: 100%;
            transition: all 0.3s ease;
        }

        .services-section .service-img {
            width: 100%;
            height: 160px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 15px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .services-section .service-img img {
            width: 100%;
            height: 100%;
            object-fit: inherit;
            transition: transform 0.4s ease;
        }

        .services-section .service-title {
            font-size: 14px;
            font-weight: 500;
            margin: 8px 0;
            color: #004a44;
        }

        /* Hover effect */
        .services-section .service-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .services-section .service-box:hover img {
            transform: scale(1.05);
        }




        /* ✅ Mobile view (up to 767px) */
        @media only screen and (max-width: 767px) {
            .page-header-section {
                padding: 126px 0 250px 0;
                height: 250px;
            }

            .page-header-section::before {
                top: 30px;
                left: 33px;
                width: 180px;
            }

            .services-section .col-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .services-section .service-img {
                height: 120px;
                /* smaller for mobile */
            }
        }
    </style>
</head>


<body class="custom-cursor">

    <!-- page header start -->
    <div class="page-header-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="page-header-heading animate fadeInLeft wow" data-wow-duration="2000ms">
                        <h2>Our Services</h2>
                        <p class="lead">Expertly curated property solutions designed to simplify decisions and maximize
                            long-term value.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page header end -->



    <!-- service two start -->
    <div class="service-section-two srvice">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="heading-box text-center service-heading">
                        <h2 class="heading-title animate fadeInUp wow" data-wow-duration="1500ms"
                            data-wow-delay="200ms">
                            <span>Your Trusted Partner</span> for Smarter Real Estate Solutions
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service two end -->

    <section class="services-section py-5">
        <div class="container">
            <div class="row g-4">

                <!-- Service 1 -->
                <div class="col-6 col-md-4">
                    <a href="residential.php" class="service-box">
                        <div class="service-img">
                            <img src="assets/images/services/RESIDENTIAL.webp" alt="Residential">
                        </div>
                        <h5 class="service-title">Residential</h5>
                    </a>
                </div>

                <!-- Service 2 -->
                <div class="col-6 col-md-4">
                    <a href="commercial.php" class="service-box">
                        <div class="service-img">
                            <img src="assets/images/services/commercial.webp" alt="Commercial">
                        </div>
                        <h5 class="service-title">Commercial</h5>
                    </a>
                </div>

                <!-- Service 3 -->
                <div class="col-6 col-md-4">
                    <a href="mortgage-services.php" class="service-box">
                        <div class="service-img">
                            <img src="assets/images/services/mortgage.webp" alt="Mortgage Services">
                        </div>
                        <h5 class="service-title">Mortgage Services</h5>
                    </a>
                </div>

                <!-- Service 4 -->
                <div class="col-6 col-md-4">
                    <a href="investment.php" class="service-box">
                        <div class="service-img">
                            <img src="assets/images/services/investment.webp" alt="Investment">
                        </div>
                        <h5 class="service-title">Investment</h5>
                    </a>
                </div>

                <!-- Service 5 -->
                <div class="col-6 col-md-4">
                    <a href="valuation-advisory.php" class="service-box">
                        <div class="service-img">
                            <img src="assets/images/services/valuation-and-advisory.webp" alt="Valuation & Advisory">
                        </div>
                        <h5 class="service-title">Valuation & Advisory</h5>
                    </a>
                </div>

                <!-- Service 6 -->
                <div class="col-6 col-md-4">
                    <a href="research.php" class="service-box">
                        <div class="service-img">
                            <img src="assets/images/services/research.webp" alt="Research">
                        </div>
                        <h5 class="service-title">Research</h5>
                    </a>
                </div>

            </div>
        </div>
    </section>




    <!-- footer five start -->
    <div class="footer-section-five">
        <div class="container">
            <div class="row gutter-y-30">
                <div class="col-12 col-lg-3 col-md-6">
                    <div class="footer-about-five">
                        <div class="footer-logo-five animate fadeInUp wow">
                            <a href="index.php"><img src="assets/images/logo/houzz-hun-golden-logo.png" alt="logo"></a>
                        </div>
                        <p class="lead">Your trusted partner in premium real estate across the UAE and Middle East. We
                            bring
                            you curated properties, expert advice and a smooth real estate experience tailored for
                            modern
                            living.
                        </p>
                        <ul class="footer-social-media-five desktopView">
                            <li>
                                <a href="https://www.instagram.com/houzzhunt/?hl=en"><img
                                        src="assets/icons/instagram.png" alt="icon"></a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/people/Houzz-Hunt/61574436629351/"><img
                                        src="assets/icons/facebook.png" alt="icon"></a>
                            </li>
                            <li>
                                <a href="https://x.com/HouzzHunt"><img src="assets/icons/twitter.png" alt="icon"></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/company/houzz-hunt/"><img
                                        src="assets/icons/linkedin.png" alt="icon"></a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/@HouzzHunt"><img src="assets/icons/youtube.png"
                                        alt="icon"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="footer-widget-two">
                        <h4>Usefull Links</h4>
                        <ul class="footer-menu-two">
                            <li>

                                <a href="index.php">Home</a>
                            </li>
                            <li>

                                <a href="about.php">About</a>
                            </li>
                            <li>

                                <a href="services.php">Services </a>
                            </li>
                            <li>

                                <a href="blogs.php">Blogs</a>
                            </li>
                            <li>

                                <a href="contact.php">Contact Us</a>
                            </li>
                            <li>

                                <a href="careers.php">Career</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="footer-widget-two">
                        <h4>Services</h4>
                        <ul class="footer-menu-two">
                            <li>

                                <a href="residential.php">Residential</a>
                            </li>
                            <li>

                                <a href="commercial.php">Commercial</a>
                            </li>
                            <li>

                                <a href="mortgage-services.php">Mortgage Services</a>
                            </li>
                            <li>

                                <a href="investment.php">Investment</a>
                            </li>
                            <li>

                                <a href="valuation-advisory.php">Valuation & Advisory</a>
                            </li>
                            <li>

                                <a href="research.php">Research</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-md-6">
                    <div class="footer-widget-contact">
                        <h4>Contact Us</h4>
                        <ul class="footer-location-four">
                            <li>
                                <span><img src="assets/images/svg/footer-two/footer-two-mail.svg" alt="icon"></span>
                                <a href="mailto:contact@houzzhunt.com">contact@houzzhunt.com</a>
                            </li>
                            <li>
                                <span><img src="assets/images/svg/footer-two/footer-two-address.svg" alt="icon"></span>
                                <p>806, Capital Golden Tower

                                    Business Bay, Dubai, U.A.E</p>
                            </li>
                            <li>
                                <span><img src="assets/images/svg/footer-two/footer-two-call.svg" alt="icon"></span>
                                <a href="telto:+97142554683">+971 42554683</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- <div class="col-lg-8 ms-auto">
                <div class="newslatter-five animate fadeInUp wow">
                    <h4>Get in touch</h4>
                    <form action="#">
                        <input type="email" name="email" placeholder="enter your email" class="form-control">
                        <button type="submit" class="btn btn-secondary btn-theme">Subscribe </button>
                    </form>
                </div>
            </div> -->
            </div>
        </div>
    </div>
    <!-- footer five end -->

    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/jquery/jquery-3.7.1.min.js"></script>
    <script src="assets/vendors/slick/slick.min.js"></script>
    <script src="assets/vendors/wow/wow.js"></script>
    <script src="assets/vendors/youtube-popup/youtube-popup.jquery.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>