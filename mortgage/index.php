<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';

$recaptchaSiteKey = hh_recaptcha_site_key();

$propertyLocations = [
    'Dubai',
    'Abu Dhabi',
    'Sharjah',
    'Ajman',
    'Umm Al Quwain',
    'Ras Al Khaimah',
    'Fujairah',
];

$defaultLocation = $propertyLocations[0];

$formErrors = [
    'hero'   => null,
    'footer' => null,
];

$formOld = [
    'hero' => [
        'name'         => '',
        'email'        => '',
        'phone'        => '',
        'country_code' => '',
        'location'     => $defaultLocation,
    ],
    'footer' => [
        'name'         => '',
        'email'        => '',
        'phone'        => '',
        'country_code' => '',
        'location'     => $defaultLocation,
    ],
];

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    $formSource = (string)($_POST['form_source'] ?? 'hero');
    if (!in_array($formSource, ['hero', 'footer'], true)) {
        $formSource = 'hero';
    }

    $name        = trim((string)($_POST['name'] ?? ''));
    $email       = trim((string)($_POST['email'] ?? ''));
    $phone       = trim((string)($_POST['phone'] ?? ''));
    $countryCode = trim((string)($_POST['country_code'] ?? ''));
    $location    = trim((string)($_POST['location'] ?? ''));
    $token       = (string)($_POST['g-recaptcha-response'] ?? '');

    if ($phone === '' && isset($_POST['phone_display'])) {
        $phone = trim((string)$_POST['phone_display']);
    }

    if (!in_array($location, $propertyLocations, true)) {
        $location = '';
    }

    $formOld[$formSource] = [
        'name'         => $name,
        'email'        => $email,
        'phone'        => $phone,
        'country_code' => $countryCode,
        'location'     => $location !== '' ? $location : $defaultLocation,
    ];

    if ($name === '' || $email === '' || $phone === '' || $location === '') {
        $formErrors[$formSource] = 'Please complete all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formErrors[$formSource] = 'Please enter a valid email address.';
    } elseif ($token === '') {
        $formErrors[$formSource] = 'Please confirm you are not a robot.';
    } else {
        $secretKey = hh_recaptcha_secret_key();
        if ($secretKey === '' || $secretKey === 'your-secret-key-here') {
            $formErrors[$formSource] = 'Captcha verification is temporarily unavailable. Please try again later.';
        } else {
            $recaptchaVerified = false;
            $postData = http_build_query([
                'secret'   => $secretKey,
                'response' => $token,
                'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
            ]);

            $context = stream_context_create([
                'http' => [
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => $postData,
                    'timeout' => 10,
                ],
            ]);

            $response = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);

            if ($response === false && function_exists('curl_init')) {
                $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
                if ($ch !== false) {
                    curl_setopt_array($ch, [
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST           => true,
                        CURLOPT_POSTFIELDS     => $postData,
                        CURLOPT_TIMEOUT        => 10,
                    ]);
                    $curlResponse = curl_exec($ch);
                    if ($curlResponse !== false) {
                        $response = $curlResponse;
                    }
                    curl_close($ch);
                }
            }

            if ($response !== false) {
                $decodedResponse = json_decode((string)$response, true);
                $recaptchaVerified = is_array($decodedResponse) && ($decodedResponse['success'] ?? false) === true;
            }

            if (!$recaptchaVerified) {
                $formErrors[$formSource] = 'Captcha verification failed. Please try again.';
            } else {
                try {
                    $pdo = hh_db();
                    $stmt = $pdo->prepare(
                        'INSERT INTO mortgage_leads (name, email, phone, country_code, location, form_source, ip_address, user_agent, created_at)
                         VALUES (:name, :email, :phone, :country_code, :location, :form_source, :ip_address, :user_agent, NOW())'
                    );
                    $stmt->execute([
                        ':name'        => $name,
                        ':email'       => $email,
                        ':phone'       => $phone,
                        ':country_code'=> $countryCode !== '' ? $countryCode : null,
                        ':location'    => $location,
                        ':form_source' => $formSource,
                        ':ip_address'  => $_SERVER['REMOTE_ADDR'] ?? null,
                        ':user_agent'  => $_SERVER['HTTP_USER_AGENT'] ?? null,
                    ]);

                    header('Location: thankyou.php');
                    exit;
                } catch (Throwable $exception) {
                    error_log('Mortgage lead form: database error - ' . $exception->getMessage());
                    $formErrors[$formSource] = 'We were unable to submit your request. Please try again later.';
                }
            }
        }
    }
}

include 'includes/common-header.php';
?>

<!-- Hero Section -->
<section id="hero-section">
    <div id="hero-wrapper">
        <div id="hero-banner" class="d-flex align-items-center  position-relative">
            <div class="container">

                <!-- Logo Top-Left -->
                <div id="hero-logo">
                    <a href="/"><img src="assets/images/logo/logo.svg" alt="HouzzHunt Logo" /></a>
                </div>

                <div class="row align-items-center">
                    <!-- Left Content -->
                    <div class="col-lg-8">
                        <div id="hero-content">
                            <h1 class="hero-heading">Luxury Begins with <br> the Right Mortgage</h1>
                            <p class="lead">Tailored mortgage solutions backed by market insight, exclusive bank offers,
                                and full-service guidance built for discerning buyers across the UAE and beyond.</p>
                            <a href="assets/houzzhunt-mortgage-services.pdf" class="btn btn-light" download>Download Brochure</a>
                        </div>
                    </div>

                    <!-- Right Form -->
                    <div class="col-lg-4">
                        <div id="lead-form-wrapper" class="bg-white p-4 rounded shadow">
                            <h4 class="">Start Your Mortgage Journey Today</h4>
                            <form id="hero-lead-form" method="post">
                                <input type="hidden" name="form_source" value="hero">

                                <?php if ($formErrors['hero'] !== null): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo htmlspecialchars($formErrors['hero'], ENT_QUOTES, 'UTF-8'); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="form-group mb-3">
                                    <label for="hero-name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="hero-name" name="name"
                                        value="<?php echo htmlspecialchars($formOld['hero']['name'], ENT_QUOTES, 'UTF-8'); ?>"
                                        required />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="hero-email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="hero-email" name="email"
                                        value="<?php echo htmlspecialchars($formOld['hero']['email'], ENT_QUOTES, 'UTF-8'); ?>"
                                        required />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="hero-phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control js-intl-phone" id="hero-phone" name="phone_display" required
                                        data-hidden-input="hero-phone-full" data-country-input="hero-country-code"
                                        data-initial-value="<?php echo htmlspecialchars($formOld['hero']['phone'], ENT_QUOTES, 'UTF-8'); ?>" />
                                    <input type="hidden" name="phone" id="hero-phone-full"
                                        value="<?php echo htmlspecialchars($formOld['hero']['phone'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="hidden" name="country_code" id="hero-country-code"
                                        value="<?php echo htmlspecialchars($formOld['hero']['country_code'], ENT_QUOTES, 'UTF-8'); ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="hero-location" class="form-label">Where is the property located? *</label>
                                    <select name="location" id="hero-location" class="form-select form-control" required>
                                        <?php foreach ($propertyLocations as $propertyLocation): ?>
                                            <option value="<?php echo htmlspecialchars($propertyLocation, ENT_QUOTES, 'UTF-8'); ?>"
                                                <?php echo $propertyLocation === ($formOld['hero']['location'] ?? $defaultLocation) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($propertyLocation, ENT_QUOTES, 'UTF-8'); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="g-recaptcha"
                                        data-sitekey="<?php echo htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8'); ?>">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Financing Features Section -->
<section id="financing-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="financing-intro">
                    <h2>UNLOCK YOUR PROPERTY DREAMS WITH<br><span>SMART, STREAMLINED FINANCING</span></h2>
                    <p>
                        At HouzzHunt, we go beyond property listings. We are your dedicated partner in every step of
                        your real
                        estate journey—from finding the perfect home to securing the financing that makes it yours.
                        Backed by
                        Reliant Consultancy Group, our mortgage assistance services are designed to eliminate confusion,
                        reduce delays, and empower you with expert-backed financial clarity.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Feature Item -->
            <div class="col-md-4 col-sm-6">
                <div class="feature-box">
                    <img src="assets/icons/expert-guidence.png" alt="Expert Guidance" />
                    <h4>Expert Guidance</h4>
                    <p>Mortgage experts at your service, offering professional advice tailored to your needs.</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-box">
                    <img src="assets/icons/fast-approval.png" alt="Fast Approval" />
                    <h4>Fast Approval Process</h4>
                    <p>Streamlined procedures for quick and hassle-free mortgage approvals.</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-box">
                    <img src="assets/icons/Tailored.png" alt="Tailored Solutions" />
                    <h4>Tailored Financing Solutions</h4>
                    <p>Crafting mortgage solutions that fit your unique financial goals and circumstances.</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-box">
                    <img src="assets/icons/customer-support.png" alt="Customer Support" />
                    <h4>Dedicated Customer Support</h4>
                    <p>Responsive assistance and support for all your mortgage-related queries and concerns.</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-box">
                    <img src="assets/icons/local-user.png" alt="Local Market" />
                    <h4>Local Market Insight</h4>
                    <p>In-depth knowledge of the local real estate market to secure the best terms for you.</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="feature-box">
                    <img src="assets/icons/trust.png" alt="Trustworthy" />
                    <h4>Trustworthy Partnership</h4>
                    <p>A trusted ally guiding you through every step of your mortgage journey.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Mortgage Services Section -->
<section id="mortgage-services">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 id="mortgage-title">COMPREHENSIVE MORTGAGE SERVICES WE OFFER</h3>
            </div>
        </div>

        <div class="row" id="mortgage-boxes">
            <!-- Residential Mortgage -->
            <div class="col-md-4">
                <div class="mortgage-box">
                    <img src="assets/images/residential-property.webp" alt="Residential Mortgage" class="mortgage-img">
                    <h4 class="mortgage-heading">RESIDENTIAL PROPERTY MORTGAGE</h4>
                    <p class="mortgage-desc">Tailored mortgages for your dream home.</p>
                    <ul class="mortgage-list">
                        <li>Home purchase financing</li>
                        <li>Pre-approval assistance</li>
                        <li>Mortgage Insurance options</li>
                        <li>Legal & documentation support</li>
                    </ul>
                </div>
            </div>

            <!-- Commercial Mortgage -->
            <div class="col-md-4">
                <div class="mortgage-box">
                    <img src="assets/images/comercial.webp" alt="Commercial Mortgage" class="mortgage-img">
                    <h4 class="mortgage-heading">COMMERCIAL PROPERTY MORTGAGE</h4>
                    <p class="mortgage-desc">Financing solutions for commercial realestate ventures.</p>
                    <ul class="mortgage-list">
                        <li>Business property loans</li>
                        <li>Customized repayment plans</li>
                        <li>Expert commercial property advice</li>
                        <li>Competitive interest rates</li>
                    </ul>
                </div>
            </div>

            <!-- Plot & Land Loans -->
            <div class="col-md-4">
                <div class="mortgage-box">
                    <img src="assets/images/plot-and-land.webp" alt="Plot & Land Loans" class="mortgage-img">
                    <h4 class="mortgage-heading">PLOT & LAND LOANS</h4>
                    <p class="mortgage-desc">Unlock the potential of your land investments.</p>
                    <ul class="mortgage-list">
                        <li>Loans for land acquisition</li>
                        <li>Flexible financing options</li>
                        <li>Assistance in land purchase</li>
                        <li>Competitive interest rates</li>
                    </ul>
                </div>
            </div>

            <!-- Refinance -->
            <div class="col-md-4">
                <div class="mortgage-box">
                    <img src="assets/images/refinance.webp" alt="Refinance" class="mortgage-img">
                    <h4 class="mortgage-heading">REFINANCE</h4>
                    <p class="mortgage-desc">Optimize your mortgage with better terms.</p>
                    <ul class="mortgage-list">
                        <li>Refinancing for improved rates</li>
                        <li>Simplified paperwork</li>
                        <li>Potential cost savings</li>
                    </ul>
                </div>
            </div>

            <!-- Islamic Finance -->
            <div class="col-md-4">
                <div class="mortgage-box">
                    <img src="assets/images/islamic-finance.webp" alt="Islamic Finance" class="mortgage-img">
                    <h4 class="mortgage-heading">ISLAMIC FINANCE</h4>
                    <p class="mortgage-desc">Ethical home financing for Sharia-compliant buyers.</p>
                    <ul class="mortgage-list">
                        <li>Interest-free financing solutions</li>
                        <li>Compliance with Islamic principles</li>
                        <li>Various Sharia-compliant products</li>
                        <li>Support for ethical investments</li>
                    </ul>
                </div>
            </div>

            <!-- Non-Resident Mortgages -->
            <div class="col-md-4">
                <div class="mortgage-box">
                    <img src="assets/images/non-resident-mortage.webp" alt="Non-Resident Mortgages"
                        class="mortgage-img">
                    <h4 class="mortgage-heading">NON–RESIDENT MORTGAGES</h4>
                    <p class="mortgage-desc">Mortgages for international investors.</p>
                    <ul class="mortgage-list">
                        <li>Specialized financing solutions</li>
                        <li>Legal & regulatory guidance</li>
                        <li>Competitive rates for expats</li>
                        <li>Support for non-resident clients</li>
                    </ul>
                </div>
            </div>
        </div>


    </div>
</section>


<!-- Equity Release Section -->
<section id="equity-release-section">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-4">
                <div class="equity-text-wrapper">
                    <div class="equity-img-wrapper">
                        <img src="assets/images/equity-release.webp" alt="Equity Release" class="equity-img" />
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="equity-text-wrapper">
                    <h4 class="equity-heading">EQUITY RELEASE/BUYOUTS</h4>
                    <p class="equity-description">
                        Unlock the value tied up in your existing property. Whether you're looking to free up capital,
                        lower your monthly payments, or refinance at better terms, we help you access equity with
                        clarity and confidence—on your terms, without the fine print.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Mortgage Application Process Vertical Layout -->
<section id="mortgage-process-vertical">
    <div class="container">
        <h2 class="process-title">THE MORTGAGE APPLICATION PROCESS</h2>

        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="process-vertical-wrapper">
                    <!-- Step 1 -->
                    <div class="process-step-vertical">
                        <div class="step-circle">1</div>
                        <div class="step-content">
                            <h5>Initial Consultation & Financial Assessment</h5>
                            <p>Discuss your property goals and financial profile with our mortgage advisors.</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="process-step-vertical">
                        <div class="step-circle">2</div>
                        <div class="step-content">
                            <h5>Pre–Approval Application:</h5>
                            <p>We prepare and submit your pre-approval application with all supporting documents.</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="process-step-vertical">
                        <div class="step-circle">3</div>
                        <div class="step-content">
                            <h5>Property Selection & Formal Offer:</h5>
                            <p>With your pre-approval, you can confidently make an offer on your property.</p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="process-step-vertical">
                        <div class="step-circle">4</div>
                        <div class="step-content">
                            <h5>Formal Mortgage Application:</h5>
                            <p>Once your offer is accepted, we submit the full mortgage application for bank underwriting.</p>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="process-step-vertical">
                        <div class="step-circle">5</div>
                        <div class="step-content">
                            <h5>Valuation & Approval:</h5>
                            <p>The bank arranges a property valuation. Upon approval, you receive the formal loan offer.</p>
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="process-step-vertical">
                        <div class="step-circle">6</div>
                        <div class="step-content">
                            <h5>Sign Loan Agreement & Loan Disbursement:</h5>
                            <p>We assist in signing documents and registering the mortgage with the land department.</p>
                        </div>
                    </div>

                    <!-- Step 7 -->
                    <div class="process-step-vertical">
                        <div class="step-circle">7</div>
                        <div class="step-content">
                            <h5>Register Mortgage & Property Transfer:</h5>
                            <p>The bank disburses funds to the seller, completing the property purchase.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="equity-text-wrapper">
                    <div class="equity-img-wrapper">
                        <img src="assets/images/banner/application-banner.png" alt="Equity Release" class="equity-img" />
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<!-- Mortgage Calculator -->
<div class="container py-5">
    <div class="row g-5">
        <!-- Left Panel -->
        <div class="col-lg-6">
            <div class="p-4 rounded-4 shadow-sm bg-white border border-dark-subtle">
                <h4 class="mb-4" style="color:#4b0082;">Houzzhunt Mortgage Calculator</h4>

                <!-- Residency Status -->
                <div class="mb-3">
                    <label class="form-label">Residency Status</label>
                    <div class="btn-group w-100">
                        <button type="button" class="btn btn-outline-dark w-50 active" data-type="resident">UAE Resident</button>
                        <button type="button" class="btn btn-outline-dark w-50 " data-type="nonresident">International Investor</button>
                    </div>
                </div>

                <!-- Income Type -->
                <div class="mb-3">
                    <label class="form-label">Income Type</label>
                    <div class="btn-group w-100">
                        <button type="button" class="btn btn-outline-dark w-50 active">Salaried</button>
                        <button type="button" class="btn btn-outline-dark w-50">Self-Employed</button>
                    </div>
                </div>

                <!-- Property Value -->
                <div class="mb-3">
                    <label class="form-label">Property Price (AED)</label>
                    <input type="number" id="propertyValue" class="form-control" value="1000000">
                </div>

                <!-- Down Payment -->
                <div class="mb-3">
                    <label class="form-label">Down Payment (AED)</label>
                    <input type="number" id="downPayment" class="form-control" value="200000">
                </div>

                <!-- Interest Rate -->
                <div class="mb-3">
                    <label class="form-label">Interest Rate (%)</label>
                    <input type="number" id="interestRate" class="form-control" value="3.99" step="0.01" min="2" max="8">
                </div>

                <!-- Loan Duration -->
                <div class="mb-3">
                    <label class="form-label">Loan Term (Years)</label>
                    <input type="range" class="form-range" id="loanDuration" min="1" max="25" value="20">
                    <p class="text-end"><span id="durationLabel">20</span> Years</p>
                </div>

                <!-- Notices -->
                <div class="mt-4 p-3 highlight-box">
                    <small class="text-dark">
                        <ul class="mb-0 ps-3">
                            <li>Minimum down payment for UAE residents: 20%</li>
                            <li>Minimum down payment for international investors: 40%</li>
                            <li>Maximum loan term: 25 years</li>
                        </ul>
                    </small>
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="col-lg-6">
            <!-- Loan Summary -->
            <div class="p-4 rounded-4 shadow-sm" style="background-color: #4b0082; color: white;">
                <h5 class="mb-4 text-white">Loan Summary</h5>
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mb-1 text-white">Maximum Loan Amount</p>
                        <h4 id="loanAmount" class="text-white">AED 800,000</h4>
                    </div>
                    <div>
                        <p class="mb-1 text-white">Monthly Payment</p>
                        <h4 id="monthlyCost" class="text-white">AED 4,844</h4>
                    </div>
                    <div>
                        <p class="mb-1 text-white">Total Interest Paid</p>
                        <h4 id="interestPaid" class="text-white">AED 362,471</h4>
                    </div>
                </div>
            </div>

            <!-- Upfront Costs -->
            <div class="mt-4 p-4 rounded-4 shadow-sm bg-white">
                <h6 class="mb-3">Upfront Costs</h6>
                <div class="row">
                    <div class="col-6">
                        <p>Down Payment</p>
                        <p>Dubai Land Department Fee (4%)</p>
                        <p>Valuation Fee</p>
                        <p>Registration Fee</p>
                    </div>
                    <div class="col-6 text-end">
                        <p id="upfrontDown">AED 200,000</p>
                        <p id="upfrontDLD">AED 40,000</p>
                        <p>AED 3,000</p>
                        <p>AED 4,000</p>
                    </div>
                    <div class="col-6">
                        <p>Mortgage Registration (0.25%)</p>
                        <p>Real Estate Agency Fee (2%)</p>
                    </div>
                    <div class="col-6 text-end">
                        <p id="upfrontMR">AED 2,000</p>
                        <p id="upfrontAgency">AED 20,000</p>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Total Upfront Cost</span>
                    <span id="totalUpfront">AED 269,000</span>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Why Choose HouzzHunt Section -->
<section id="houzzhunt-mortgage">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mortgage-main-title">OWN YOUR DREAM HOME WITH<br>HOUZZHUNT MORTGAGE</h2>
                <p class="mortgage-subtitle">Here’s why smart buyers choose HouzzHunt to secure their mortgage:</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Box 1 -->
            <div class="col-md-6">
                <div class="mortgage-card d-flex">
                    <img src="assets/icons/expert-guidence.png" alt="Expert Guidance" class="me-3" style="width: 30px; height: 30px;">
                    <div>
                        <h5>Expert Mortgage Guidance</h5>
                        <p>From how much you can borrow to timelines and paperwork — we walk you through the entire process.</p>
                    </div>
                </div>
            </div>

            <!-- Box 2 -->
            <div class="col-md-6">
                <div class="mortgage-card d-flex">
                    <img src="assets/icons/local-user.png" alt="Best Rates" class="me-3" style="width: 30px; height: 30px;">
                    <div>
                        <h5>Access the Best Rates</h5>
                        <p>We compare top bank offers to secure the best deal and lower your upfront costs.</p>
                    </div>
                </div>
            </div>

            <!-- Box 3 -->
            <div class="col-md-6">
                <div class="mortgage-card d-flex">
                    <img src="assets/icons/trust.png" alt="Transparent Process" class="me-3" style="width: 30px; height: 30px;">
                    <div>
                        <h5>100% Transparent Process</h5>
                        <p>No surprises, no hidden fees. What you see is what you get — with full clarity at every step.</p>
                    </div>
                </div>
            </div>

            <!-- Box 4 -->
            <div class="col-md-6">
                <div class="mortgage-card d-flex">
                    <img src="assets/icons/fast-approval.png" alt="Faster Approvals" class="me-3" style="width: 30px; height: 30px;">
                    <div>
                        <h5>Faster Approvals, Less Waiting</h5>
                        <p>Using a broker means quicker processing, faster results, and no roadblocks along the way.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
    .btn {
        border-radius: 5px !important;
    }

    .btn.active {
        background-color: #4b0082;
        color: white;
        border-color: #4b0082;
    }

    .btn-outline-dark {
        border-radius: 8px;
    }

    .form-control,
    .form-range {
        border-color: #ccc;
    }

    .highlight-box {
        background-color: #fff3cd;
        border-left: 5px solid #ecbb69;
    }

    /* .form-control,
    .form-range {
        border-color: #fff;
    } */

    .btn-group {
        display: -webkit-inline-box;
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        flex-wrap: nowrap;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        gap: 30px;
        margin-bottom: 10px;
    }
</style>

<!-- Contact Form Section -->
<section id="contact-section">
    <div class="contact-wrapper">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <!-- Right Side Form -->
                <div class="col-lg-6">
                    <div id="lead-form-wrapper" class="bg-white p-4 rounded shadow w-100">
                        <h4 class="">Start Your Mortgage Journey Today</h4>
                        <form id="footer-lead-form" method="post">
                            <input type="hidden" name="form_source" value="footer">

                            <?php if ($formErrors['footer'] !== null): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo htmlspecialchars($formErrors['footer'], ENT_QUOTES, 'UTF-8'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="form-group mb-3">
                                <label for="footer-name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="footer-name" name="name"
                                    value="<?php echo htmlspecialchars($formOld['footer']['name'], ENT_QUOTES, 'UTF-8'); ?>"
                                    required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="footer-email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="footer-email" name="email"
                                    value="<?php echo htmlspecialchars($formOld['footer']['email'], ENT_QUOTES, 'UTF-8'); ?>"
                                    required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="footer-phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control js-intl-phone" id="footer-phone" name="phone_display" required
                                    data-hidden-input="footer-phone-full" data-country-input="footer-country-code"
                                    data-initial-value="<?php echo htmlspecialchars($formOld['footer']['phone'], ENT_QUOTES, 'UTF-8'); ?>" />
                                <input type="hidden" name="phone" id="footer-phone-full"
                                    value="<?php echo htmlspecialchars($formOld['footer']['phone'], ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="country_code" id="footer-country-code"
                                    value="<?php echo htmlspecialchars($formOld['footer']['country_code'], ENT_QUOTES, 'UTF-8'); ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="footer-location" class="form-label">Where is the property located? *</label>
                                <select name="location" id="footer-location" class="form-select form-control" required>
                                    <?php foreach ($propertyLocations as $propertyLocation): ?>
                                        <option value="<?php echo htmlspecialchars($propertyLocation, ENT_QUOTES, 'UTF-8'); ?>"
                                            <?php echo $propertyLocation === ($formOld['footer']['location'] ?? $defaultLocation) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($propertyLocation, ENT_QUOTES, 'UTF-8'); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <div class="g-recaptcha"
                                    data-sitekey="<?php echo htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8'); ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof window.intlTelInput !== 'function') {
            return;
        }

        var phoneInputs = document.querySelectorAll('.js-intl-phone');
        phoneInputs.forEach(function(input) {
            var hiddenInputId = input.getAttribute('data-hidden-input') || '';
            var countryInputId = input.getAttribute('data-country-input') || '';
            var hiddenInput = hiddenInputId ? document.getElementById(hiddenInputId) : null;
            var countryInput = countryInputId ? document.getElementById(countryInputId) : null;

            var iti = window.intlTelInput(input, {
                initialCountry: 'ae',
                autoPlaceholder: 'polite'
            });

            var initialValue = input.getAttribute('data-initial-value');
            if (initialValue) {
                try {
                    iti.setNumber(initialValue);
                } catch (error) {
                    if (window.console && typeof window.console.warn === 'function') {
                        window.console.warn('Unable to set initial phone number', error);
                    }
                }
            }

            var form = input.form;
            if (!form) {
                return;
            }

            if (!form._intlTelEntries) {
                form._intlTelEntries = [];
                form.addEventListener('submit', function() {
                    form._intlTelEntries.forEach(function(entry) {
                        var number = entry.iti.getNumber();
                        if (entry.hiddenInput) {
                            entry.hiddenInput.value = number || entry.input.value.trim();
                        }
                        if (entry.countryInput) {
                            var countryData = entry.iti.getSelectedCountryData();
                            entry.countryInput.value = countryData && countryData.dialCode ? '+' + countryData.dialCode : '';
                        }
                    });
                });
            }

            form._intlTelEntries.push({
                input: input,
                iti: iti,
                hiddenInput: hiddenInput,
                countryInput: countryInput
            });
        });
    });
</script>

<?php include 'includes/common-footer.php'; ?>
