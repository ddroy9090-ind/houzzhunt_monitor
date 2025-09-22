<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="assets/images/logo/HH-logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- include CSS in head -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/25.3.1/build/css/intlTelInput.min.css">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300;400;500;600;700&family=Lora:ital,wght@0,400..700;1,400..700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            font-family: "Hind Madurai", sans-serif;
        }

        h2 {
            font-size: 32px;
            font-weight: 500;
            line-height: 1.3;
            font-family: "Montserrat", sans-serif;
            /* font-family: "Lora", serif !important; */
            color: #111;

        }

        .gradient-btn {
            display: inline-block;
            padding: 14px 36px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 300;
            color: #fff;
            text-decoration: none;
            transition: all 0.4s ease;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Button 1: Green Glossy */
        .btn-green-glossy {
            background: linear-gradient(245deg, #0f635c, #067e74);
        }

        .heading-title>span {
            color: #edbb68;
            font-family: "Lora", serif !important;
            font-style: italic;
            background: linear-gradient(97.08deg, #004a44 0%, #edbb68 55.06%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 300;
        }

        span.whiteYellow {
            color: #fff;
            font-family: "Lora", serif !important;
            font-style: italic;
            background: linear-gradient(97.08deg, #fff 0%, #edbb68 55.06%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 300;
        }

        #hearo-wrapper {
            position: relative;
            background: url('assets/images/banner/dubai-guide-banner.webp') center center/cover no-repeat;
            color: #fff;
            padding: 60px 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        /* Overlay */
        #hearo-wrapper::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.55);
            /* dark overlay */
            z-index: 1;
        }

        /* Content wrapper */
        #hearo-wrapper .container {
            position: relative;
            z-index: 2;
        }

        /* Logo */
        #hearo-wrapper .logo {
            position: absolute;
            top: 20px;
            left: 40px;
            z-index: 3;
        }

        #hearo-wrapper .logo img {
            width: 180px;
        }

        /* Left Content */
        #leftWrapper h1 {
            font-size: 32px;
            font-weight: 500;
            color: #fff;
            margin-bottom: 15px;
            line-height: normal;
            font-family: "Montserrat", sans-serif;
        }

        #leftWrapper p {
            font-size: 16px;
            line-height: normal;
            font-weight: 300;
            max-width: 550px;
        }

        /* Right Form */
        #rightWraper {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            color: #000;
            width: 400px;
            margin: auto;
        }

        #rightWraper h4 {
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #004a44;
            font-family: "Lora", serif;
            font-style: italic;
        }

        #rightWraper label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        #rightWraper input {
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 14px;
            padding-left: 32px;
            box-shadow: none;
            margin-bottom: 25px;
        }


        #rightWraper textarea {
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 14px;
            padding-left: 32px;
            box-shadow: none;
            margin-bottom: 25px;
        }

        #rightWraper select {
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 14px;
            /* padding-left: 32px; */
            box-shadow: none;
            margin-bottom: 25px;
            margin-top: 25px;
        }

        input.form-control:focus,
        textarea.form-control:focus,
        select.form-control:focus {
            border: 1px #004a44 solid;
        }


        /* Input wrapper for icons */
        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            top: 52%;
            left: 8px;
            transform: translateY(-50%);
            color: #a9a9a9;
            pointer-events: none;
            font-size: 14px;
        }

        /* Download button */
        .btn-download {
            background-color: #004a44;
            color: #fff;
            font-weight: 500;
            border-radius: 30px;
            padding: 12px;
            border: none;
            font-size: 16px;
            transition: background-color 0.4s ease, color 0.4s ease;
            /* smooth transition */
        }

        .btn-download:hover {
            background-color: #edbb68;
            /* hover color */
            color: #fff;
            /* text color change */
        }


        .iti {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .investor-guide-content {
            max-width: 100%;
            margin: auto;
            text-align: center;
            padding: 60px 0;
        }

        .investor-guide-content h2 {
            font-size: 32px;
            font-weight: 500;
            /* color: #004a44; */
            line-height: normal;
            margin-bottom: 15px;
        }

        .investor-guide-content p {
            font-size: 16px;
            max-width: 60%;
            margin: auto;
        }

        .market-section {
            padding: 60px 0;
            background-color: #004a44;

        }

        .market-section h2 {
            color: #fff;
        }

        .market-section p {
            color: #fff;
        }

        .market-section .stat-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s;
        }

        .market-section .stat-box:hover {
            transform: translateY(-6px);
        }

        .market-section .stat-box h3 {
            font-size: 24px;
            font-weight: 600;
            margin: 10px 0;
            color: #004a44;
            font-family: "Lora", serif;
            font-style: italic;
        }

        .market-section .stat-box h6 {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .market-section .stat-box p {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .stat-box span {
            display: inline-block;
            background-color: #004a44;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            position: relative;
            cursor: pointer;
            margin-bottom: 5px;
        }

        .stat-box span img {
            width: 100%;
            padding: 12px;
            /* filter: brightness(0) saturate(100%) invert(81%) sepia(47%) saturate(447%) hue-rotate(4deg) brightness(98%) contrast(93%); */
        }

        .paragraph-section {
            padding-bottom: 60px;
        }

        .leftContentImage img {
            width: 95%;
            margin: auto;
            border-radius: 5px;
        }

        .guide-section {
            padding: 60px 0;
        }

        .key-points {
            display: flex;
            margin-bottom: 20px;
        }

        .guide-section .icon-box {
            background: #004a44;
            color: #fff;
            border-radius: 8px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .key-points h6 {
            font-size: 18px;
            font-weight: 600;
            color: #004a44;
            font-family: "Lora", serif;
            font-style: italic;
        }

        .faq {
            padding-bottom: 60px;
        }

        .accordion-button {
            border-radius: 8px !important;
            font-size: 1rem;
            box-shadow: none !important;
        }

        .accordion-button:not(.collapsed) {
            background-color: #fff;
            color: #000;
            border: 1px solid #ccc;
        }

        .accordion-item {
            overflow: hidden;
        }

        .accordion-body {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .accordion-item.shadow-sm {
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05) !important;
        }

        .footer-section-five {
            background-color: #004a44;
            padding: 80px 0;
            /* border-top: 1px #ededed solid; */
            max-width: 100%;
        }

        .footer-about-five {
            position: relative;
            z-index: 1;
        }

        .footer-logo-five {
            margin-bottom: 30px;
        }

        .footer-section-five,
        .footer-section-five p,
        .footer-section-five a,
        .footer-section-five h4,
        .footer-section-five li,
        .footer-section-five input::placeholder {
            color: #fff !important;
            fill: #fff !important;
            list-style: none;
            text-decoration: none;
        }

        .footer-logo-five img {
            position: relative;
            right: 13px;
            height: 45px;
        }

        .footer-about-five p {
            margin-bottom: 25px;
            color: #fff;
            font-size: 16px;
            font-weight: 400;
        }

        ul.footer-social-media-five {
            display: flex;
            align-items: center;
            column-gap: 20px;
            padding: 0;
            list-style: none;
            margin: 0;
        }

        .footer-social-media-five img {
            width: 28px;
        }

        .footer-widget-two {
            position: relative;
            z-index: 1;
            margin: 0;
            border: none;
            padding-left: 65px;
        }

        .footer-section-five h4 {
            color: #fff !important;
            font-size: 20px;
            font-weight: 400;
            line-height: 1.3;
            margin-bottom: 24px;
            font-family: "Lora", serif !important;
        }

        .footer-section-five ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .footer-section-five ul li {
            margin: 10px 0;

        }

        ul.footer-location-four li {
            display: flex;
            align-items: center;
            column-gap: 14px;
        }

        ul.footer-location-four li span {
            height: 58px;
            width: 58px;
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #aaa6a61a;
            flex-shrink: 0;

        }

        .footer-section-five ul.footer-location-four li span img {
            filter: none;
        }

        .site-footer {
            background-color: #004a44;
            color: #fff;
            padding: 15px 20px;
            font-size: 14px;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .footer-left {
            flex: 1;
        }

        .footer-right {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .footer-link {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <!-- -------- Main-section---- -->
    <div id="hearo-wrapper">
        <div class="logo">
            <a href="#"><img src="assets/images/logo/logo.svg" alt="" width="200"></a>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div id="leftWrapper">
                        <h1>Dubai Investor Guide 2025</h1>
                        <p>The ultimate roadmap to building wealth through Dubai’s $427 billion real estate market.
                            Backed by market data, government vision, and proven strategies, this guide reveals how
                            investors achieve double-digit ROI in one of the world’s fastest-growing property hubs.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div id="rightWraper">
                        <h4>Download The Playbook</h4>

                        <form action="">
                            <div class="form-group input-icon">
                                <!-- <label for="fullname">Full Name *</label> -->
                                <input type="text" id="fullname" class="form-control"
                                    placeholder="Enter your full name">
                                <i class="bi bi-person-fill"></i>
                            </div>

                            <div class="form-group input-icon">
                                <!-- <label for="email">Email ID *</label> -->
                                <input type="email" id="email" class="form-control" placeholder="Enter your email">
                                <i class="bi bi-envelope-fill"></i>
                            </div>

                            <div class="form-group input-icon">
                                <!-- <label for="phone">Phone Number *</label> -->
                                <input type="tel" id="phone" class="form-control">
                            </div>

                            <div class="form-group input-icon">

                                <select id="investmentPlaybook" name="investmentPlaybook"
                                    class="form-select form-control" required>
                                    <option value=""> What interests you in this Dubai Investment Playbook?</option>
                                    <option value="investing_soon">I’m ready to invest soon and exploring serious
                                        options</option>
                                    <option value="researching">I’m researching but still learning about the Dubai
                                        market</option>
                                    <option value="curious">I don’t know much about Dubai property but I’m curious
                                    </option>
                                    <option value="agent">I’m a real estate agent who wants to learn from the best
                                    </option>
                                </select>
                            </div>

                            <div class="form-group input-icon">
                                <!-- <label for="message">Message (Optional)</label> -->
                                <textarea name="message" id="message" class="form-control"
                                    placeholder="Type your message"></textarea>
                                <i class="bi bi-chat-dots-fill" style="top:35%"></i>
                            </div>

                            <div class="form-group mb-2">
                                <button class="btn btn-download w-100">Download Now</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- --------- What's Inside the Investor Guide? ---------- -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="investor-guide-content">
                        <h2 class="heading-title">What’s inside the <span>Dubai Investment Playbook?</span> </h2>
                        <p>This guide offers a step-by-step breakdown of how to invest in Dubai property with clear
                            insights
                            for every stage of the process. It highlights the most common mistakes investors make and
                            how to
                            avoid them. You’ll also discover key Off Plan developments and emerging areas worth
                            watching.
                            Finally, the guide explores smart portfolio strategies designed to maximise both ROI and
                            long
                            term capital appreciation.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="paragraph-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="leftContentImage">
                        <img src="assets/images/allservices/investment-consultancy.webp" alt="">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="rightContentSection">
                        <h2 class="heading-title">Let's find <span>your ideal investment</span></h2>
                        <p>Trusted by thousands of investors worldwide and with the Google reviews to prove it, haus &
                            haus is the go-to real estate partner for those who value clarity, performance, and
                            personalised strategy. Whether you're building a portfolio or taking your first step into
                            the market, every recommendation we make is aligned with your goals.</p>
                        <p>With consultants fluent in 20+ languages and clients across six continents, we offer honest,
                            data-led guidance rooted in decades of combined experience. We obsess over our clients
                            because building relationships is at the core of everything we do.</p>
                        <a href="#" class="gradient-btn btn-green-glossy">Speak to a consultants</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- --- Market-Leading Intelligence---- -->
    <section class="market-section text-center">
        <div class="container">
            <h2 class="heading-title">Market-Leading <span class="whiteYellow">Intelligence</span></h2>
            <p class="mb-5">
                Real data. Real performance. Real opportunities.
            </p>

            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="stat-box p-4 h-100">
                        <span><img src="assets/icons/grow-up.png" alt="Sales Growth Icon"></span>
                        <h3>42%</h3>
                        <h6>Sales Growth</h6>
                        <p>2024 Year-on-Year increase</p>
                        <strong>↗ Strong upward trend</strong>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-box p-4 h-100">
                        <span><img src="assets/icons/balance-sheet.png" alt="Market Value Icon"></span>
                        <h3>$427B</h3>
                        <h6>Market Value</h6>
                        <p>Dubai Real Estate in 2024</p>
                        <strong>↗ +34% YoY</strong>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-box p-4 h-100">
                        <span><img src="assets/icons/cash.png" alt="Rental Yields Icon"></span>
                        <h3>6–10%</h3>
                        <h6>Avg Rental Yields</h6>
                        <p>vs 3–4% in London/NYC</p>
                        <strong>↗ Higher global benchmark</strong>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-box p-4 h-100">
                        <span><img src="assets/icons/globe.png" alt="Countries Icon"></span>
                        <h3>193</h3>
                        <h6>Countries Represented</h6>
                        <p>Among Dubai investors</p>
                        <strong>↗ Expanding global base</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- --------- What's Inside the Investor Guide? ---------- -->
    <section class="guide-section">
        <div class="container">
            <div class="row justify-content-center text-center mb-4">
                <div class="col-lg-8">
                    <h2 class="heading-title">
                        What’s Inside the
                        <span>Investor Guide?</span>
                    </h2>
                    <p class="text-muted">
                        Everything you need to make informed, confident investment decisions in Dubai’s dynamic property
                        market.
                    </p>
                </div>
            </div>

            <div class="row align-items-center">
                <!-- Right Content -->
                <div class="col-md-6">
                    <div class="key-points">
                        <div class="icon-box">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="ms-3 text-start">
                            <h6>Market Analysis</h6>
                            <p class="text-muted mb-0">
                                Review 2024 sales, prices, and rental growth with projections for 2025. Understand
                                momentum, time investments wisely, and uncover opportunities shaping Dubai.
                            </p>
                        </div>
                    </div>

                    <div class="key-points">
                        <div class="icon-box">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="ms-3 text-start">
                            <h6>Prime Locations</h6>
                            <p class="text-muted mb-0">
                                Discover Dubai’s strongest communities for capital growth and rental yields. From luxury
                                addresses to rising hotspots, see where investors can maximize returns.
                            </p>
                        </div>
                    </div>

                    <div class="key-points">
                        <div class="icon-box">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="ms-3 text-start">
                            <h6>Legal Framework</h6>
                            <p class="text-muted mb-0">
                                Learn Dubai’s property rules with ease: visa pathways, ownership rights, taxation, and
                                RERA safeguards. Clear guidance ensures secure and protected real estate investments.
                            </p>
                        </div>
                    </div>

                    <div class="key-points">
                        <div class="icon-box">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="ms-3 text-start">
                            <h6>Expert Strategies</h6>
                            <p class="text-muted mb-0">
                                Insights on off-plan versus ready properties, portfolio diversification, and entry
                                timing. Expert strategies tailored for investors seeking consistent returns and wealth
                                in Dubai.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Left Image -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="https://preview--dubai-invest-golden-guide.lovable.app/assets/dubai-business-BdWWqSo7.jpg"
                        alt="Investor Meeting" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- ---- Frequently Asked Questions ---------- -->
    <section class="faq">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="heading-title">
                    Frequently Asked <span>Questions</span>
                </h2>
                <p class="text-muted">
                    Get answers to the most common questions about Dubai real estate investment
                </p>
            </div>

            <div class="accordion" id="faqAccordion">

                <div class="accordion-item shadow-sm mb-3 border-0 rounded">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq1">
                            What makes Dubai real estate so attractive?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            0% tax on income and capital gains, high rental yields (6–10%), freehold ownership for
                            foreigners, and Vision 2040 guaranteeing long-term growth.
                        </div>
                    </div>
                </div>

                <div class="accordion-item shadow-sm mb-3 border-0 rounded">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq2">
                            How much do I need to invest?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            AED 750K+ qualifies for a 2-year Investor Visa. AED 2M+ unlocks a 10-year Golden Visa.
                        </div>
                    </div>
                </div>

                <div class="accordion-item shadow-sm mb-3 border-0 rounded">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq3">
                            Can I get residency through real estate?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Yes — investors and their families qualify for visas depending on property value.
                        </div>
                    </div>
                </div>

                <div class="accordion-item shadow-sm mb-3 border-0 rounded">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faq4">
                            What risks should I be aware of?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            Avoid speculative flipping at peaks, check developer reputation, and diversify across
                            communities.
                        </div>
                    </div>
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

    <footer class="site-footer">
        <div class="container">
            <div class="footer-container">
                <div class="footer-left">
                    © 2025 All rights reserved
                </div>
                <div class="footer-right">
                    <a href="privacy-policy.php" class="footer-link">Privacy Policy</a>
                    <!-- <a href="#" class="footer-link">Cookie Policy</a> -->
                    <a href="terms-and-conditions.php" class="footer-link">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- include JS before closing body -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/25.3.1/build/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/25.3.1/build/js/utils.min.js"></script>
    <script>
        const phoneInput = document.querySelector("#phone");
        const iti = window.intlTelInput(phoneInput, {
            initialCountry: "ae",           // Default to UAE
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/25.3.1/build/js/utils.min.js"
        });
    </script>


</body>

</html>