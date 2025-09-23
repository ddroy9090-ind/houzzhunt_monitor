<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$subscribeFormError = $_SESSION['subscribe_form_error'] ?? null;
$subscribeFormOld   = $_SESSION['subscribe_form_old'] ?? [];

unset($_SESSION['subscribe_form_error'], $_SESSION['subscribe_form_old']);

$recaptchaSiteKey = hh_recaptcha_site_key();
?>
<div class="contact-section">
    <div class="container">
        <div class="row align-items-center gy-4">

            <div class="col-lg-4">
                <div class="left-contact">
                    <h2 class="mb-3 heading-title">Connect with <br> <span>houzzhunt Real Estate</span></h2>
                    <img src="assets/images/homepage/help-contact.webp" class="img-fluid w-100" alt="Team">
                    <div class="bg-green text-white p-4">
                        <h5 class="text-white">Let’s Talk Luxury, Strategy & Returns</h5>
                        <p class="mt-3 mb-1">Follow us :</p>
                        <ul class="footer-social-media-five">
                            <li><a href="https://www.instagram.com/houzzhunt/?hl=en"><img
                                        src="assets/icons/instagram.png" alt="icon"></a></li>
                            <li><a href="https://www.facebook.com/people/Houzz-Hunt/61574436629351/"><img
                                        src="assets/icons/facebook.png" alt="icon"></a></li>
                            <li><a href="https://x.com/HouzzHunt"><img src="assets/icons/twitter.png" alt="icon"></a>
                            </li>
                            <li><a href="https://www.linkedin.com/company/houzz-hunt/"><img
                                        src="assets/icons/linkedin.png" alt="icon"></a></li>
                            <li><a href="https://www.youtube.com/@HouzzHunt"><img style="position: relative; top: 5px;"
                                        src="assets/icons/youtube.png" alt="icon"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>


            <div class="col-lg-7">
                <p class="mb-4">
                    Looking to buy, sell, or invest in Dubai’s thriving property market? Share your details, and our
                    experts will get in touch with advice tailored to your goals—so you can move forward with clarity,
                    confidence, and real results.
                </p>
                <div class="p-4 bg-light">

                    <h4 class="mb-4">Get in Touch with us!</h4>

                    <?php if ($subscribeFormError): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlspecialchars($subscribeFormError, ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    <?php endif; ?>
                    <form id="leadForm" method="post" action="subscribe-handler.php">
                        <input type="hidden" name="redirect"
                            value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/', ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Your Name</label>
                                <input type="text" name="name" required
                                    value="<?php echo htmlspecialchars($subscribeFormOld['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                    class="form-control border-0 border-bottom rounded-0 shadow-none">
                            </div>
                            <div class="col">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" required
                                    value="<?php echo htmlspecialchars($subscribeFormOld['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                    class="form-control border-0 border-bottom rounded-0 shadow-none">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" required
                                    value="<?php echo htmlspecialchars($subscribeFormOld['phone'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                    class="form-control border-0 border-bottom rounded-0 shadow-none">
                            </div>
                            <div class="col">
                                <label class="form-label">Select Country</label>
                                <input type="text" name="country1" required id="country1"
                                    value="<?php echo htmlspecialchars($subscribeFormOld['country1'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                    class="form-control border-0 border-bottom rounded-0 shadow-none">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="g-recaptcha"
                                data-sitekey="<?php echo htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8'); ?>">
                            </div>
                        </div>
                        <button type="submit" class="gradient-btn btn-green-glossy">Connect Now</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php if (!defined('HH_RECAPTCHA_SCRIPT_LOADED')): ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php define('HH_RECAPTCHA_SCRIPT_LOADED', true); ?>
<?php endif; ?>