<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

hh_session_start();

$popupFormError = $_SESSION['popup_form_error'] ?? null;
$popupFormOld   = $_SESSION['popup_form_old'] ?? [];

unset($_SESSION['popup_form_error'], $_SESSION['popup_form_old']);

$recaptchaSiteKey = hh_recaptcha_site_key();
?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo isset($title) ? htmlspecialchars($title) : 'houzzhunt | Buy, Sell & Invest in Dubai Real Estate'; ?>
    </title>
    <?php echo $meta_tags; ?>
    <?php $current_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $canonical_url = str_replace("https://houzzhunt.com", "https://www.houzzhunt.com", $current_url); ?>

    <!-- Canonical Tag -->
    <link rel="canonical" href="<?php echo $canonical_url; ?>">


    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5J236XFD');
    </script>
    <!-- End Google Tag Manager -->
</head>


<body class="custom-cursor">

    <!-- Preloader Start -->
    <div id="preloader">
        <img src="assets/images/logo/preloader.gif" alt="houzzhunt loader">
    </div> 
    <!-- Preloader End -->

    <!-- <elevenlabs-convai agent-id="agent_3301k15cbk5jfxsr5dp18e65e5kd"></elevenlabs-convai>
    <script src="https://unpkg.com/@elevenlabs/convai-widget-embed" async type="text/javascript"></script> -->

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J236XFD" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Popup Form -->
    <div class="popup-overlay" id="popupForm">
        <div class="popup-content">
            <div class="popup-image"></div>
            <div class="popup-form">
                <div class="popup-close" onclick="closePopup()">X</div>
                <h4 class="heading-title"><span>Register Your Interest</span></h4>
                <p style="font-size: 15px !important; margin-bottom: 10px;">
                    Unlock expert advice, exclusive listings & investment insights.
                </p>

                <form method="POST" class="appointment-form" action="popup-handler">
                    <input type="hidden" name="redirect"
                        value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/', ENT_QUOTES, 'UTF-8'); ?>">

                    <?php if ($popupFormError): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlspecialchars($popupFormError, ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="popup_name">Enter Name</label>
                        <input type="text" name="name" id="popup_name"
                            value="<?php echo htmlspecialchars($popupFormOld['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="popup_email">Enter Email</label>
                        <input type="email" name="email" id="popup_email"
                            value="<?php echo htmlspecialchars($popupFormOld['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="popup_country">Select Country</label>
                        <input type="text" name="country" id="popup_country"
                            value="<?php echo htmlspecialchars($popupFormOld['country'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="popup_phone">Phone Number</label>
                        <input type="tel" name="phone" id="popup_phone"
                            value="<?php echo htmlspecialchars($popupFormOld['phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha"
                            data-sitekey="<?php echo htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="gradient-btn btn-green-glossy w-100 mt-3 text-center">
                            Submit Enquiry
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <?php if (!defined('HH_RECAPTCHA_SCRIPT_LOADED')): ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <?php define('HH_RECAPTCHA_SCRIPT_LOADED', true); ?>
    <?php endif; ?>
    


    <!-- Career Form -->
    <div class="popup-overlay" id="popupFormCareer">
        <div class="popup-content">
            <div class="popup-image popup-image1"></div>
            <div class="popup-form">
                <div class="popup-close" onclick="closePopup1()">×</div>
                <h4 class="heading-title"><span>Submit your CV</span></h4>

                <form method="POST" id="leadFormone" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Enter Name</label>
                        <input type="text" name="name" id="nameone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" id="mobile" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Enter Email</label>
                        <input type="email" name="email" id="emailone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" id="city" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Attach CV</label>
                        <input type="file" name="cv" id="cv" class="form-control" accept=".pdf,.doc,.docx" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="gradient-btn btn-green-glossy w-100 mt-3 text-center">
                            Submit Enquiry
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>