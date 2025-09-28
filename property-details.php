<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <title>Breez by Danube</title>
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/country-select-js@2.0.1/build/css/countrySelect.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="assets/css/properties.css">
</head>

<body>


    <!-- parent: .hh-property-hero -->
    <div class="hh-property-hero">
        <!-- Top bar fixed at top of hero -->
        <div class="hh-property-hero-top">
            <a href="offplan-properties.php" class="hh-property-hero-back">← Back to Listings</a>
            <div class="hh-property-hero-top-actions">
                <!-- <button type="button" aria-label="Save" class="hh-iconbtn">♡</button>
                <button type="button" aria-label="Share" class="hh-iconbtn">⇪</button> -->
                <button type="button" class="hh-primarypill" onclick="openPopup()">☎ Contact Agent</button>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Info block -->
                    <div class="hh-property-hero-info">
                        <div class="hh-property-hero-tags">
                            <span class="green">New Launch</span>
                            <span>Apartment</span>
                        </div>
                        <h1>Unparalleled Seafront Luxury Living in Dubai Maritime City</h1>
                        <div class="hh-property-hero-loc"><img src="assets/icons/location.png" alt="" width="16">Dubai
                            Maritime City, UAE</div>
                        <div class="hh-property-hero-price"><span class="AED">AED</span> 1.3M <span>Starting from</span>
                        </div>
                        <ul class="hh-property-hero-specs">
                            <li><img src="assets/icons/bed.png" alt="" width="16"> 5 Bedrooms</li>
                            <li><img src="assets/icons/bathroom.png" alt="" width="16"> 4 Bathrooms</li>
                            <li><img src="assets/icons/parking.png" alt="" width="16"> 2 Parking</li>
                            <li><img src="assets/icons/area.png" alt="" width="16"> 2,100 sq ft</li>
                            <li><img src="assets/icons/calendar.png" alt="" width="16"> Q1 2029 Completion</li>
                        </ul>
                    </div>

                    <!-- Bottom CTA buttons -->
                    <div class="hh-property-hero-ctas">
                        <button type="button" class="cta-solid" onclick="openPopup()">Enquire Now</button>
                        <button type="button" class="cta-outline" onclick="Brochurepopup()">Download Brochure</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- parent: .hh-gallery-01 -->
    <div class="hh-gallery-01">
        <div class="container">

            <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <div class="hh-gallery-01-head">
                        <h3>Property Gallery</h3>
                        <div class="hh-gallery-01-head-actions">
                            <button type="button" class="ghost" data-action="view-all">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <path d="M4 5h7v6H4zM13 5h7v6h-7zM4 13h7v6H4zM13 13h7v6h-7z" fill="currentColor" />
                                </svg>
                                View All (5)
                            </button>
                            <button type="button" class="solid" data-action="video">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <path d="M4 5h11a2 2 0 0 1 2 2v1.5l3-2v11l-3-2V17a2 2 0 0 1-2 2H4z"
                                        fill="currentColor" />
                                </svg>
                                Video Tour
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery + Agent -->
            <div class="row">
                <!-- Left: Gallery -->
                <div class="col-12 col-lg-8">
                    <div class="hh-gallery-01-wrap">

                        <!-- Main swiper -->
                        <div class="swiper hh-gallery-01-main">
                            <div class="swiper-wrapper">
                                <!-- slides -->
                                <div class="swiper-slide">
                                    <img src="assets/images/offplan/breez-by-danube.webp" alt="Image 1">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/offplan/1.webp" alt="Image 2">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/offplan/2.webp" alt="Image 3">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/offplan/3.webp" alt="Image 4">
                                </div>
                                <div class="swiper-slide">
                                    <img src="assets/images/offplan/4.webp" alt="Image 5">
                                </div>
                            </div>

                            <!-- overlay controls -->
                            <button type="button" class="nav prev" aria-label="Previous"></button>
                            <button type="button" class="nav next" aria-label="Next"></button>
                            <button type="button" class="fullscreen" aria-label="Full screen">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <path
                                        d="M9 5H5v4H3V3h6v2zm6-2h6v6h-2V5h-4V3zM5 15H3v6h6v-2H5v-4zm16 0v6h-6v-2h4v-4h2z"
                                        fill="currentColor" />
                                </svg>
                            </button>
                            <div class="fraction"><span>1</span> of <span>5</span></div>
                            <div class="progress"><i style="width:20%"></i></div>
                        </div>

                        <!-- Thumbs swiper -->
                        <div class="swiper hh-gallery-01-thumbs">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img src="assets/images/offplan/breez-by-danube.webp" alt="">
                                </div>
                                <div class="swiper-slide"><img src="assets/images/offplan/1.webp" alt=""></div>
                                <div class="swiper-slide"><img src="assets/images/offplan/2.webp" alt=""></div>
                                <div class="swiper-slide"><img src="assets/images/offplan/3.webp" alt=""></div>
                                <div class="swiper-slide"><img src="assets/images/offplan/4.webp" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Agent panel -->
                <div class="col-12 col-lg-4">
                    <aside class="hh-gallery-01-agent">
                        <div class="card-head">
                            <div class="avatar">
                                <svg width="28" height="28" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2a5 5 0 1 1 0 10A5 5 0 0 1 12 2Zm0 12c4.2 0 8 2.1 8 5v3H4v-3c0-2.9 3.8-5 8-5Z"
                                        fill="#fff" />
                                </svg>
                            </div>
                            <div class="info">
                                <strong>Sarah Al-Mansouri</strong>
                                <span>Senior Property Consultant</span>
                                <em>★★★★★ · 5.0 Rating</em>
                            </div>
                        </div>

                        <div class="cta-row">
                            <button type="button" class="call" onclick="window.location.href='tel:+971 42554683'">
                                <img src="assets/flaticons/phone.png" alt="" width="16">
                                Call
                            </button>
                            <button type="button" class="wa"
                                onclick="window.open('https://wa.me/97142554683','_blank')">
                                <img src="assets/flaticons/whatsapp.png" alt="WhatsApp" width="20">
                                WhatsApp
                            </button>

                        </div>

                        <button type="button" class="ghost-wide" onclick="openPopup()">
                            <img src="assets/icons/calendar.png" alt="" width="16">
                            Schedule Viewing
                        </button>

                        <div class="actions">
                            <button type="button">
                                <img src="assets/icons/video-call.png" alt="" width="20">
                                3D Virtual Tour
                            </button>
                            <button type="button" onclick="Brochurepopup()">
                                <img src="assets/icons/brochure-download.png" alt="" width="20">
                                Download Brochure
                            </button>
                            <button type="button" onclick="openPopup()">
                                <img src="assets/icons/floorplan.png" alt="" width="20">
                                View Floor Plans
                            </button>
                        </div>
                    </aside>
                </div>
            </div>
        </div>

        <!-- Lightbox (custom, no extra lib) -->
        <div class="hh-gallery-01-lightbox" aria-hidden="true">
            <button type="button" class="lb-close" aria-label="Close">×</button>
            <button type="button" class="lb-prev" aria-label="Previous"></button>
            <img alt="">
            <button type="button" class="lb-next" aria-label="Next"></button>
        </div>
    </div>

    <!-- parent: .hh-details-01 -->
    <div class="hh-details-01">
        <div class="container">
            <!-- Body -->
            <div class="row">
                <div class="col-12 col-lg-8">
                    <nav class="hh-tabs" role="tablist" aria-label="Property details tabs">
                        <ul>
                            <li>
                                <button id="hh-tab-overview-btn" type="button" class="active" role="tab"
                                    aria-selected="true" aria-controls="hh-tab-overview" data-bs-toggle="tab"
                                    data-bs-target="#hh-tab-overview">
                                    Overview
                                </button>
                            </li>
                            <li>
                                <button id="hh-tab-features-btn" type="button" role="tab" aria-selected="false"
                                    aria-controls="hh-tab-features" data-bs-toggle="tab"
                                    data-bs-target="#hh-tab-features">
                                    Features
                                </button>
                            </li>
                            <li>
                                <button id="hh-tab-floor-btn" type="button" role="tab" aria-selected="false"
                                    aria-controls="hh-tab-floor" data-bs-toggle="tab" data-bs-target="#hh-tab-floor">
                                    Floor Plan
                                </button>
                            </li>
                            <li>
                                <button id="hh-tab-developer-btn" type="button" role="tab" aria-selected="false"
                                    aria-controls="hh-tab-developer" data-bs-toggle="tab"
                                    data-bs-target="#hh-tab-developer">
                                    Developer
                                </button>
                            </li>
                        </ul>
                    </nav>

                    <!-- Bootstrap required wrapper -->
                    <div class="tab-content">

                        <!-- Overview -->
                        <div id="hh-tab-overview" class="tab-pane fade show active" role="tabpanel"
                            aria-labelledby="hh-tab-overview-btn">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12 p-0">
                                        <div class="project-overview">
                                            <div class="project-header">
                                                <h3>Breez by Danube</h3>
                                                <h6>At Dubai Maritime City</h6>
                                            </div>
                                            <p>Discover Danube Breez, where seafront elegance meets the dynamic energy
                                                of Dubai Maritime City. This isn’t just a residence it’s a lifestyle
                                                upgrade. Every element of Breez is designed to offer comfort,
                                                sophistication, and effortless living, from panoramic ocean views to a
                                                location that keeps the city’s vibrant opportunities within easy reach.
                                                Here, the sea isn’t just scenery; it’s part of your daily experience,
                                                creating a tranquil backdrop to a life of modern luxury.
                                            </p>
                                            <p>Homes at Breez range from chic studios to expansive four-bedroom villas,
                                                each thoughtfully designed to maximize space, natural light, and
                                                comfort. Large windows frame breathtaking vistas, while smart layouts
                                                ensure every corner of your home is functional and inviting. The design
                                                is meant not only to impress but to provide a sanctuary where you can
                                                relax, entertain, and enjoy life at your own pace.</p>
                                            <p>The lifestyle extends far beyond the interiors, with over 40 resort-style
                                                amenities at your disposal. Lounge by the infinity pool, enjoy family
                                                movie nights under the stars at the outdoor cinema, or perfect your
                                                swing at the mini-golf course—all without leaving home. Backed by the
                                                trusted Danube Properties and flexible payment plans, Breez offers a
                                                seamless path to luxury living. It’s not just a property; it’s a
                                                permanent vacation and a smart investment in a life of ease and
                                                indulgence.</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Features -->
                        <div id="hh-tab-features" class="tab-pane fade" role="tabpanel"
                            aria-labelledby="hh-tab-features-btn">
                            <!-- parent: .hh-amenities-01 -->
                            <div class="hh-amenities-01">
                                <div class="container-fluid">
                                    <h3>Key Features & Amenities</h3>
                                    <ul class="amenities-list">
                                        <li><img src="assets/icons/tick.png" alt="✓"> Cinema</li>
                                        <li><img src="assets/icons/tick.png" alt="✓"> Club</li>
                                        <li><img src="assets/icons/tick.png" alt="✓"> Spa & Sauna</li>
                                        <li><img src="assets/icons/tick.png" alt="✓"> Gym</li>
                                        <li><img src="assets/icons/tick.png" alt="✓"> Hammock BBQ</li>
                                        <li><img src="assets/icons/tick.png" alt="✓"> Kids Daycare</li>
                                        <li><img src="assets/icons/tick.png" alt="✓"> Kids Splash Pool</li>
                                        <li><img src="assets/icons/tick.png" alt="✓"> Pool</li>
                                        <li><img src="assets/icons/tick.png" alt="✓"> Swing</li>
                                        <li><img src="assets/icons/tick.png" alt="✓"> View Deck</li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <!-- Floor Plan -->
                        <div id="hh-tab-floor" class="tab-pane fade" role="tabpanel" aria-labelledby="hh-tab-floor-btn">
                            <div class="hh-floorplans-01">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Interactive Floor Plans</h3>
                                            <p>Click on rooms to view details</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Left: plan canvas -->
                                        <div class="col-12 col-lg-8">
                                            <div class="fp-canvas tab-content">
                                                <!-- Tab 1 -->
                                                <div id="fp-tab-ground" class="fp-pane tab-pane fade show active" role="tabpanel">
                                                    <img src="assets/images/offplan/studio.png" alt="">
                                                </div>
                                                <!-- Tab 2 -->
                                                <div id="fp-tab-first" class="fp-pane tab-pane fade" role="tabpanel">
                                                    <img src="assets/images/offplan/1-br.png" alt="">
                                                </div>
                                                <!-- Tab 3 -->
                                                <div id="fp-tab-second" class="fp-pane tab-pane fade" role="tabpanel">
                                                    <img src="assets/images/offplan/2-br.png" alt="">
                                                </div>
                                                <!-- Tab 4 -->
                                                <div id="fp-tab-third" class="fp-pane tab-pane fade" role="tabpanel">
                                                    <img src="assets/images/offplan/3-br.png" alt="">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right: vertical tabs -->
                                        <div class="col-12 col-lg-4">
                                            <aside class="fp-aside nav flex-column" role="tablist" aria-orientation="vertical">
                                                <!-- Button 1 -->
                                                <button id="fp-btn-ground" type="button" class="fp-box active"
                                                    data-bs-toggle="tab" data-bs-target="#fp-tab-ground" role="tab" aria-selected="true">
                                                    <div class="fp-box-head">
                                                        <img src="assets/icons/floorplan.png" alt="">
                                                        <div><strong>Studio</strong></div>
                                                    </div>
                                                    <ul class="fp-meta">
                                                        <li><em>Total Area</em><b>1,600 sq ft</b></li>
                                                        <li><em>Bedrooms</em><b>0</b></li>
                                                        <li><em>Total Rooms</em><b>1</b></li>
                                                    </ul>
                                                </button>

                                                <!-- Button 2 -->
                                                <button id="fp-btn-first" type="button" class="fp-box"
                                                    data-bs-toggle="tab" data-bs-target="#fp-tab-first" role="tab" aria-selected="false">
                                                    <div class="fp-box-head">
                                                        <img src="assets/icons/floorplan.png" alt="">
                                                        <div><strong>1 Bedroom</strong></div>
                                                    </div>
                                                    <ul class="fp-meta">
                                                        <li><em>Total Area</em><b>1,450 sq ft</b></li>
                                                        <li><em>Bedrooms</em><b>1</b></li>
                                                        <li><em>Total Rooms</em><b>3</b></li>
                                                    </ul>
                                                </button>

                                                <!-- Button 3 -->
                                                <button id="fp-btn-second" type="button" class="fp-box"
                                                    data-bs-toggle="tab" data-bs-target="#fp-tab-second" role="tab" aria-selected="false">
                                                    <div class="fp-box-head">
                                                        <img src="assets/icons/floorplan.png" alt="">
                                                        <div><strong>2 Bedroom</strong></div>
                                                    </div>
                                                    <ul class="fp-meta">
                                                        <li><em>Total Area</em><b>2,800 sq ft</b></li>
                                                        <li><em>Bedrooms</em><b>2</b></li>
                                                        <li><em>Total Rooms</em><b>5</b></li>
                                                    </ul>
                                                </button>

                                                <!-- Button 4 -->
                                                <button id="fp-btn-third" type="button" class="fp-box"
                                                    data-bs-toggle="tab" data-bs-target="#fp-tab-third" role="tab" aria-selected="false">
                                                    <div class="fp-box-head">
                                                        <img src="assets/icons/floorplan.png" alt="">
                                                        <div><strong>3 Bedroom</strong></div>
                                                    </div>
                                                    <ul class="fp-meta">
                                                        <li><em>Total Area</em><b>3,200 sq ft</b></li>
                                                        <li><em>Bedrooms</em><b>3</b></li>
                                                        <li><em>Total Rooms</em><b>7</b></li>
                                                    </ul>
                                                </button>
                                            </aside>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Developer -->
                        <div id="hh-tab-developer" class="tab-pane fade" role="tabpanel"
                            aria-labelledby="hh-tab-developer-btn">
                            <div class="hh-developer-01">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4>About the Developer</h4>
                                        </div>
                                        <div class="col-12">
                                            <section class="dev-card">
                                                <div class="dev-head">
                                                    <div class="dev-ico">
                                                        <img src="assets/flaticons/residential.png" width="25" alt="">
                                                    </div>
                                                    <div class="dev-title">
                                                        <strong>Danube Properties</strong>
                                                        <div class="dev-rating">
                                                            <svg width="14" height="14" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 17.3l-6.2 3.3 1.2-6.9L2 8.9l7-1 3-6 3 6 7 1-5 4.8 1.2 6.9z"
                                                                    fill="#fff" />
                                                            </svg>
                                                            4.9 Developer Rating
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dev-body">

                                                    <div class="row justify-content-start align-items-center">
                                                        <!-- <div class="col-lg-5">
                                                            <div class="developer-profile">
                                                                <img class="img-fluid" src="assets/images/offplan/DANUBE-Logo.png" alt="">
                                                            </div>
                                                        </div> -->
                                                        <div class="col-lg-12">
                                                            <div class="developer-profile-logo">
                                                                <img class="img-fluid" src="assets/images/offplan/DANUBE-Logo.png" alt="">
                                                            </div>
                                                            <p>Danube Properties is widely recognized as one of the most
                                                                reliable and respected real estate developers in the
                                                                UAE. Over
                                                                the years, the company has built a strong reputation for
                                                                delivering residential and commercial projects that
                                                                combine
                                                                quality, affordability, and modern design. As the real
                                                                estate
                                                                arm of the Danube Group, the brand reflects the same
                                                                values of
                                                                trust, innovation, and excellence that have made the
                                                                group a
                                                                household name across the region. With a commitment to
                                                                providing
                                                                homes that cater to both investors and end-users, Danube
                                                                Properties has successfully bridged the gap between
                                                                luxury
                                                                living and affordability.</p>
                                                        </div>
                                                    </div>

                                                    <div class="row dev-stats">
                                                        <div class="col-6 col-lg-3">
                                                            <div class="stat">
                                                                <strong>1985</strong>
                                                                <span>Established</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-lg-3">
                                                            <div class="stat">
                                                                <strong>187</strong>
                                                                <span>Completed Projects</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-lg-3">
                                                            <div class="stat">
                                                                <strong>🏆</strong>
                                                                <span>International Awards</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-lg-3">
                                                            <div class="stat">
                                                                <strong>98%</strong>
                                                                <span>On-Time Delivery</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- Right: sidebar -->
                <div class="col-12 col-lg-4">
                    <aside>
                        <!-- Contact Agent card -->
                        <div class="agent-card">
                            <div class="agent-title">Contact Agent</div>

                            <div class="agent-head">
                                <div class="avatar">
                                    <img src="assets/icons/chat.png" alt="">
                                </div>
                                <div class="agent-info">
                                    <strong>Get in Touch</strong>
                                    <span>Schedule your private viewing</span>
                                </div>
                            </div>

                            <form>
                                <label>
                                    <span class="field-head">
                                        <img src="assets/icons/local-user.png" alt="" class="ico">
                                        <span>Full Name *</span>
                                    </span>
                                    <input type="text" placeholder="Enter your full name">
                                </label>

                                <label>
                                    <span class="field-head">
                                        <img src="assets/flaticons/email.png" alt="" class="ico">
                                        <span>Email Address *</span>
                                    </span>
                                    <input type="email" placeholder="your.email@example.com">
                                </label>

                                <label>
                                    <span class="field-head">
                                        <img src="assets/flaticons/phone.png" alt="" class="ico">
                                        <span>Phone Number *</span>
                                    </span>
                                    <input type="tel" name="phone" id="phone" placeholder="+971 50 123 4567">
                                </label>


                                <label>
                                    <span class="field-head">
                                        <img src="assets/icons/conversation.png" alt="" class="ico">
                                        <span>Inquiry Type</span>
                                    </span>
                                    <div class="select-ico ">
                                        <select class="form-control select-dropDownClass">
                                            <option>Select inquiry type</option>
                                            <option>Schedule Viewing</option>
                                            <option>Request Callback</option>
                                            <option>Download Brochure</option>
                                        </select>
                                    </div>
                                </label>

                                <label>
                                    <span class="field-head">
                                        <img src="assets/icons/message.png" alt="" class="ico">
                                        <span>Additional Message</span>
                                    </span>
                                    <textarea rows="4" placeholder="Any specific questions or requirements…"></textarea>
                                </label>

                                <!-- <div class="switches">
                                    <label class="switch">
                                        <input type="checkbox">
                                        <img src="assets/icons/circle.png" width="14" alt="">
                                        <span>Subscribe to our newsletter for latest property updates</span>
                                    </label>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <img src="assets/icons/circle.png" width="14" alt="">
                                        <span>Receive SMS updates about this property</span>
                                    </label>
                                </div> -->

                                <button type="button" class="send">Send Message</button>
                            </form>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <!-- parent: .hh-invest-01 -->
    <div class="hh-invest-01">
        <div class="container">
            <div class="row">
                <!-- LEFT: Highlights + Payment Plan -->
                <div class="col-12 col-lg-8">

                    <!-- Investment Highlights -->
                    <section class="inv-high">
                        <header>
                            <span><img src="assets/icons/growth-chart.png" alt="" width="25"></span>
                            <h4>Investment Highlights</h4>
                        </header>

                        <div class="hi-grid">
                            <div>
                                <strong>8–12%</strong>
                                <span>ROI Potential</span>
                                <em>Annual rental yield</em>
                            </div>
                            <div>
                                <strong>+15%</strong>
                                <span>Capital Growth</span>
                                <em>Expected 3-year growth</em>
                            </div>
                            <div>
                                <strong>95%</strong>
                                <span>Occupancy Rate</span>
                                <em>Marina average</em>
                            </div>
                            <div>
                                <strong>High</strong>
                                <span>Resale Value</span>
                                <em>Prime location advantage</em>
                            </div>
                        </div>
                    </section>

                    <!-- Flexible Payment Plan -->
                    <section class="pay-plan">
                        <header>
                            <span><img src="assets/icons/wallet.png" alt="" width="25"></span>
                            <h4>Flexible Payment Plan</h4>
                        </header>

                        <div class="plan-list">
                            <!-- item -->
                            <div class="plan-item">
                                <div class="pct">10%</div>
                                <div class="txt">
                                    <strong>Down Payment</strong>
                                    <span>Secure your unit</span>
                                </div>
                                <div class="amt">
                                    <b>AED 1,300,000</b>
                                    <em>10% of total</em>
                                </div>
                            </div>

                            <div class="plan-item">
                                <div class="pct">70%</div>
                                <div class="txt">
                                    <strong>During Construction</strong>
                                    <span>Flexible payment options</span>
                                </div>
                                <div class="amt">
                                    <b>AED 1,300,000</b>
                                    <em>70% of total</em>
                                </div>
                            </div>

                            <div class="plan-item">
                                <div class="pct">20%</div>
                                <div class="txt">
                                    <strong>On Handover</strong>
                                    <span>Upon completion</span>
                                </div>
                                <div class="amt">
                                    <b>AED 1,300,000</b>
                                    <em>20% of total</em>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>

                <!-- RIGHT: Mortgage Calculator -->
                <div class="col-12 col-lg-4">
                    <aside class="mort-card">
                        <header>
                            <img src="assets/icons/mortgage.png" alt="" width="20">
                            <h5>Mortgage Calculator</h5>
                        </header>

                        <!-- price + rate -->
                        <div class="fld-row">
                            <label>Property Price</label>
                            <div class="amount">
                                <span class="adorn">$</span>
                                <input id="mc-price" type="text" value="2,500,000" inputmode="numeric" />
                            </div>
                        </div>

                        <div class="fld-row">
                            <label>Interest Rate (%)</label>
                            <div class="amount">
                                <span class="adorn">%</span>
                                <input id="mc-rate" type="number" step="0.1" value="3.5" />
                            </div>
                        </div>

                        <!-- Down payment -->
                        <div class="range-row">
                            <div class="r-label">
                                <span>Down Payment: <b id="mc-dp-lbl">25%</b> (<b id="mc-dp-amt">AED 625,000</b>)</span>
                            </div>
                            <input id="mc-dp" type="range" min="10" max="50" step="1" value="25" />
                            <div class="r-scale">
                                <span>10%</span><span>50%</span>
                            </div>
                        </div>

                        <!-- Loan term -->
                        <div class="range-row">
                            <div class="r-label">
                                <span>Loan Term: <b id="mc-term-lbl">25 years</b></span>
                            </div>
                            <input id="mc-term" type="range" min="10" max="35" step="1" value="25" />
                            <div class="r-scale">
                                <span>10 years</span><span>35 years</span>
                            </div>
                        </div>

                        <!-- Results -->
                        <div class="result-row">
                            <div class="pill gray">
                                <span>Loan Amount</span>
                                <strong id="mc-loan">AED 1,875,000</strong>
                            </div>
                            <div class="pill green">
                                <span>Monthly Payment</span>
                                <strong id="mc-monthly">AED 9,387</strong>
                            </div>
                        </div>

                        <div class="totals">
                            <div>
                                <span>Total Interest</span>
                                <b id="mc-interest">AED 941,008</b>
                            </div>
                            <div>
                                <span>Total Payment</span>
                                <b id="mc-total">AED 2,816,008</b>
                            </div>
                            <div>
                                <span>P&I Payment</span>
                                <b id="mc-pi">AED 9,387</b>
                            </div>
                        </div>

                        <button type="button" class="cta">Get Pre-Approved</button>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <!-- parent: .hh-location-01 -->
    <div class="hh-location-01">
        <div class="container">

            <!-- Heading -->
            <div class="row">
                <div class="col-12">
                    <div>
                        <div class="hh-location-01-head">
                            <img src="assets/icons/location.png" alt="" />
                            <h3>Prime Location &amp; Connectivity</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main grid -->
            <div class="row">
                <!-- LEFT: Map + Landmarks (col-lg-8) -->
                <div class="col-12 col-lg-8">
                    <div class="row">
                        <!-- Map card -->
                        <div class="col-12 col-md-6">
                            <div class="hh-location-01-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14432.090492336873!2d55.26420855!3d25.2698244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f4384740a5241%3A0xe6d78cfd14c6ada3!2sDubai%20Maritime%20City%20-%20Dubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1758894120139!5m2!1sen!2sin" width="100%" height="290" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>

                        <!-- Landmarks list -->
                        <div class="col-12 col-md-6">
                            <div class="hh-location-01-landmarks">

                                <!-- item -->
                                <button type="button">
                                    <div class="left">
                                        <img class="dot" src="assets/icons/dot-green.png" alt="" />
                                        <div>
                                            <b>Port Rashid Boat Station</b>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <a href="#">2 Mins</a>
                                        <em>Shopping</em>
                                    </div>
                                </button>

                                <button type="button">
                                    <div class="left">
                                        <img class="dot" src="assets/icons/dot-green.png" alt="" />
                                        <div>
                                            <b>Dubai Cruise Terminal 2</b>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <a href="#">3 Mins</a>
                                        <em>Shopping</em>
                                    </div>
                                </button>

                                <button type="button">
                                    <div class="left">
                                        <img class="dot" src="assets/icons/dot-green.png" alt="" />
                                        <div>
                                            <b>Gold Souk & Jumeirah Beach</b>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <a href="#">8 Mins</a>
                                        <em>Shopping</em>
                                    </div>
                                </button>

                                <button type="button">
                                    <div class="left">
                                        <img class="dot" src="assets/icons/dot-green.png" alt="" />
                                        <div>
                                            <b>Dubai World Trade Centre</b>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <a href="#">8 Mins</a>
                                        <em>Shopping</em>
                                    </div>
                                </button>

                                <button type="button">
                                    <div class="left">
                                        <img class="dot" src="assets/icons/dot-green.png" alt="" />
                                        <div>
                                            <b>Burj Khalifa</b>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <a href="#">10 Mins</a>
                                        <em>Shopping</em>
                                        
                                    </div>
                                </button>

                                <button type="button">
                                    <div class="left">
                                        <img class="dot" src="assets/icons/dot-green.png" alt="" />
                                        <div>
                                            <b>Dubai International Airport</b>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <a href="#">15 Mins</a>
                                        <em>Shopping</em>
                                        
                                    </div>
                                </button>



                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Permit + Quick Contact (col-lg-4) -->
                <div class="col-12 col-lg-4">
                    <div class="hh-location-01-side">

                        <!-- Permit card -->
                        <div class="hh-location-01-permit">
                            <div class="head">
                                <strong>Property Permit</strong>
                            </div>

                            <div class="qr-row">
                                <img class="qr" src="assets/images/offplan/danube-permit-QR.png" alt="Permit QR" />
                                <div class="permit-box">
                                    <span>Listing Number.</span>
                                    <b>0662770883</b>
                                    <em>End Date: 25/12/2025</em>
                                </div>
                            </div>
                        </div>

                        <!-- Quick contact -->
                        <div class="hh-location-01-contact">
                            <div class="head">
                                <strong>Quick Contact</strong>
                            </div>

                            <button type="button" class="call" onclick="window.location.href='tel:+971 42554683'">
                                <img src="assets/flaticons/phone.png" alt="" />
                                <span>Call Now: +971 42554683</span>
                            </button>

                            <button type="button" class="email" onclick="openPopup()">
                                <img src="assets/flaticons/email.png" alt="" />
                                <span>Email Agent</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- parent: .hh-cta-01 -->
    <div class="hh-cta-01">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="cta-banner">
                        <h3>Ready to Invest in Your Future?</h3>
                        <p>Contact our property specialists today for exclusive pricing.</p>

                        <div class="cta-actions">
                            <button onclick="window.location.href='tel:+971 42554683'" type="button"
                                class="cta-btn">Call Now</button>
                            <button type="button" class="cta-btn" onclick="openPopup()">Enquire Now</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- parent: .hh-register-01 -->
    <div class="hh-register-01">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <form class="reg-card" action="#" method="post" novalidate>
                        <div class="reg-head">
                            <h3>Register your interest</h3>
                            <p>Fill form below and our agent will contact you shortly.</p>
                        </div>

                        <div class="row">

                            <div class="col-12 col-lg-4">
                                <label for="ri-name">Full Name*</label>
                                <input id="ri-name" name="full_name" type="text" placeholder="Full Name*">
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="ri-email">Email*</label>
                                <input id="ri-email" name="email" type="email" placeholder="Email Address*">
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="ri-mobile">Mobile*</label>
                                <input id="ri-mobile" name="mobile" type="tel" placeholder="50 123 4567">
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="ri-project">Interested In*</label>
                                <select id="ri-project" name="project_name" class="select-dropDownClass">
                                    <option value="">Interested In</option>
                                    <option value="jumeirah-reside">Secondary</option>
                                    <option value="downtown-dubai">Offplan</option>
                                </select>
                            </div>


                            <div class="col-12 col-lg-4">
                                <label for="ri-budget">Select Country*</label>
                                <input id="ri-budget" name="budget_range" type="text" placeholder="Budget Range*">
                            </div>

                            <div class="col-12 col-lg-4">
                                <label class="only-for-space">&nbsp;</label>
                                <button type="submit" class="submit-btn">Submit Details</button>
                            </div>
                        </div>

                        <p class="reg-note">
                            By clicking Submit, you agree to our
                            <a href="terms-and-conditions.php">Terms</a> &amp;
                            <a href="privacy-policy.php">Privacy Policy</a>.
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- footer five start -->
    <div class="footer-section-five">
        <div class="container">
            <div class="row gutter-y-30">
                <div class="col-12 col-lg-3 col-md-6">
                    <div class="footer-about-five">
                        <div class="footer-logo-five animate fadeInUp wow">
                            <img src="assets/images/logo/logo.svg">
                        </div>
                        <p class="lead">Your trusted partner in premium real estate across the UAE and Middle East. We
                            bring
                            you curated properties, expert advice and a smooth real estate experience tailored for
                            modern
                            living.
                        </p>
                        <ul class="footer-social-media-five">
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

            </div>
        </div>
    </div>
    <!-- footer five end -->

    <!-- Popup Form -->
    <div class="popup-overlay" id="propertyEnquirey">
        <div class="popup-content">
            <div class="popup-image"></div>
            <div class="popup-form">
                <div class="popup-close" onclick="closePopup()">X</div>
                <h4 class="heading-title"><span>Register Your Interest</span></h4>
                <p style="font-size: 14px !important; margin-bottom: 10px;">
                    Unlock expert advice, exclusive listings & investment insights.
                </p>
                <form method="POST" class="appointment-form" action="danuber">
                    <div class="form-group">
                        <label for="full_name">Enter Name</label>
                        <input type="text" name="name" id="full_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email_address">Enter Email</label>
                        <input type="email" name="email" id="email_address" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="country">Select Country</label>
                        <input type="text" name="country" id="country" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="mobile_number">Phone Number</label>
                        <input type="tel" name="phone" id="mobile_number" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY_HERE"></div>
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


    <!-- Download Brochure -->
    <div class="popup-overlay" id="downloadBrochure">
        <div class="popup-content">
            <div class="popup-image"></div>
            <div class="popup-form">
                <div class="popup-close" onclick="closeBrochurepopup()">X</div>
                <h4 class="heading-title"><span>Download Brochure</span></h4>
                <p style="font-size: 14px !important; margin-bottom: 10px;">
                    Get your brochure instantly. Enter your details below to access the download.
                </p>
                <form method="POST" class="appointment-form" action="download-brochure">
                    <div class="form-group">
                        <label for="brochure_name">Full Name</label>
                        <input type="text" name="brochure_name" id="brochure_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="brochure_email">Email Address</label>
                        <input type="email" name="brochure_email" id="brochure_email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="brochure_country">Country</label>
                        <input type="text" name="brochure_country" id="brochure_country" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="brochure_phone">Phone Number</label>
                        <input type="tel" name="brochure_phone" id="brochure_phone" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY_HERE"></div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="gradient-btn btn-green-glossy w-100 mt-3 text-center">
                            Download Brochure
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/jquery/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/country-select-js@2.0.1/build/js/countrySelect.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


    <script>
        /* ---- Swiper thumbs + main ---- */
        (function() {
            // thumbs
            const thumbs = new Swiper('.hh-gallery-01 .hh-gallery-01-thumbs', {
                slidesPerView: 4.5,
                spaceBetween: 12,
                watchSlidesProgress: true,
                breakpoints: {
                    576: {
                        slidesPerView: 5,
                        spaceBetween: 12
                    },
                    992: {
                        slidesPerView: 5,
                        spaceBetween: 14
                    }
                }
            });

            // main
            const main = new Swiper('.hh-gallery-01 .hh-gallery-01-main', {
                slidesPerView: 1,
                speed: 500,
                effect: 'slide',
                thumbs: {
                    swiper: thumbs
                },
                on: {
                    slideChange: function() {
                        // update fraction + progress
                        const cur = this.realIndex + 1;
                        const total = this.slides.length;
                        const root = this.el.closest('.hh-gallery-01');
                        root.querySelector('.fraction span:first-child').textContent = cur;
                        root.querySelector('.fraction span:last-child').textContent = total;
                        root.querySelector('.progress i').style.width = (cur / total * 100) + '%';
                    }
                }
            });

            // init fraction at load
            main.emit('slideChange');

            // custom nav
            document.querySelector('.hh-gallery-01 .nav.prev').addEventListener('click', () => main.slidePrev());
            document.querySelector('.hh-gallery-01 .nav.next').addEventListener('click', () => main.slideNext());

            // Lightbox
            const lb = document.querySelector('.hh-gallery-01 .hh-gallery-01-lightbox');
            const lbImg = lb.querySelector('img');
            let lbIndex = 0;

            function openLB(i) {
                lbIndex = i;
                lbImg.src = main.slides[lbIndex].querySelector('img').src;
                lb.classList.add('open');
                lb.setAttribute('aria-hidden', 'false');
            }

            function closeLB() {
                lb.classList.remove('open');
                lb.setAttribute('aria-hidden', 'true');
            }

            function prevLB() {
                lbIndex = (lbIndex - 1 + main.slides.length) % main.slides.length;
                lbImg.src = main.slides[lbIndex].querySelector('img').src;
                main.slideTo(lbIndex);
            }

            function nextLB() {
                lbIndex = (lbIndex + 1) % main.slides.length;
                lbImg.src = main.slides[lbIndex].querySelector('img').src;
                main.slideTo(lbIndex);
            }

            // click on main image or "View All"
            document.querySelectorAll('.hh-gallery-01 .hh-gallery-01-main .swiper-slide img').forEach((img, i) => {
                img.style.cursor = 'zoom-in';
                img.addEventListener('click', () => openLB(i));
            });
            document.querySelector('.hh-gallery-01 [data-action="view-all"]').addEventListener('click', () => openLB(main.realIndex));
            document.querySelector('.hh-gallery-01 .fullscreen').addEventListener('click', () => openLB(main.realIndex));

            // lb controls
            lb.querySelector('.lb-close').addEventListener('click', closeLB);
            lb.querySelector('.lb-prev').addEventListener('click', prevLB);
            lb.querySelector('.lb-next').addEventListener('click', nextLB);
            lb.addEventListener('click', (e) => {
                if (e.target === lb) closeLB();
            });

            // keyboard nav
            window.addEventListener('keydown', (e) => {
                if (!lb.classList.contains('open')) return;
                if (e.key === 'Escape') closeLB();
                if (e.key === 'ArrowLeft') prevLB();
                if (e.key === 'ArrowRight') nextLB();
            });
        })();
    </script>

    <script>
        (function() {
            const section = document.querySelector('.hh-floorplans-01');
            if (!section) return;
            const canvas = section.querySelector('.fp-canvas');

            function showPane(targetSel) {
                canvas.querySelectorAll('.fp-pane').forEach(p => p.classList.remove('active'));
                const pane = canvas.querySelector(targetSel);
                if (pane) pane.classList.add('active');
            }

            // Default ground floor
            showPane('#fp-tab-ground');

            // Bind vertical buttons
            section.querySelectorAll('.fp-aside [data-bs-toggle="tab"]').forEach(btn => {
                btn.addEventListener('click', function() {
                    section.querySelectorAll('.fp-box').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    const targetSel = this.getAttribute('data-bs-target');
                    showPane(targetSel);
                });
            });
        })();
    </script>

    <script>
        (function() {
            const root = document.querySelector('.hh-invest-01');
            if (!root) return;

            const priceEl = root.querySelector('#mc-price');
            const rateEl = root.querySelector('#mc-rate');
            const dpEl = root.querySelector('#mc-dp');
            const termEl = root.querySelector('#mc-term');

            const dpLbl = root.querySelector('#mc-dp-lbl');
            const dpAmt = root.querySelector('#mc-dp-amt');
            const termLbl = root.querySelector('#mc-term-lbl');

            const outLoan = root.querySelector('#mc-loan');
            const outMon = root.querySelector('#mc-monthly');
            const outInt = root.querySelector('#mc-interest');
            const outTot = root.querySelector('#mc-total');
            const outPI = root.querySelector('#mc-pi');

            function toNum(str) {
                return Number(String(str).replace(/[^\d.]/g, ''));
            }

            function fmt(n) {
                const parts = Math.round(n).toString().split('');
                for (let i = parts.length - 3; i > 0; i -= 3) {
                    parts.splice(i, 0, ',');
                }
                return 'AED ' + parts.join('');
            }

            function compute() {
                const P = toNum(priceEl.value || 0);
                const rA = Number(rateEl.value || 0); // annual %
                const dp = Number(dpEl.value || 0); // %
                const yrs = Number(termEl.value || 0);

                const down = P * dp / 100;
                const L = Math.max(P - down, 0);
                const i = (rA / 100) / 12;
                const n = yrs * 12;

                const M = (i > 0) ? (L * i * Math.pow(1 + i, n)) / (Math.pow(1 + i, n) - 1) : (n > 0 ? L / n : 0);
                const totalPay = M * n;
                const totalInt = totalPay - L;

                dpLbl.textContent = dp + '%';
                dpAmt.textContent = fmt(down);
                termLbl.textContent = yrs + ' years';

                outLoan.textContent = fmt(L);
                outMon.textContent = fmt(M);
                outPI.textContent = fmt(M);
                outTot.textContent = fmt(totalPay);
                outInt.textContent = fmt(totalInt);
            }

            // formatting on blur for price
            priceEl.addEventListener('blur', () => {
                priceEl.value = (toNum(priceEl.value) || 0).toLocaleString();
                compute();
            });
            [priceEl, rateEl].forEach(el => el.addEventListener('input', compute));
            [dpEl, termEl].forEach(el => el.addEventListener('input', compute));

            // init
            priceEl.value = (toNum(priceEl.value) || 0).toLocaleString();
            compute();
        })();
    </script>

    <script>
        function openPopup() {
            document.getElementById("propertyEnquirey").classList.add("show");
            document.body.classList.add("no-scroll");
        }

        function closePopup() {
            document.getElementById("propertyEnquirey").classList.remove("show");
            document.body.classList.remove("no-scroll");
        }

        function Brochurepopup() {
            document.getElementById("downloadBrochure").classList.add("show");
            document.body.classList.add("no-scroll");
        }

        function closeBrochurepopup() {
            document.getElementById("downloadBrochure").classList.remove("show");
            document.body.classList.remove("no-scroll");
        }

        // Optional: Auto open after delay
        // window.addEventListener("load", function () {
        //   setTimeout(function () {
        //     openPopup();
        //   }, 3000);
        // });
    </script>

    <script>
        $(document).ready(function() {
            $("#country").countrySelect({
                defaultCountry: "ae",
                preferredCountries: ['ae', 'in', 'gb'] // gb = United Kingdom
            });

            $("#brochure_country").countrySelect({
                defaultCountry: "ae",
                preferredCountries: ['ae', 'in', 'gb']
            });

            $("#ri-budget").countrySelect({
                defaultCountry: "ae",
                preferredCountries: ['ae', 'in', 'gb']
            });
        });
    </script>


    <script>
        // Initialize multiple inputs with intlTelInput
        function initIntlTelInput(id) {
            const input = document.querySelector(id);
            if (!input) return null;

            const iti = window.intlTelInput(input, {
                initialCountry: "ae", // Default UAE
                separateDialCode: true,
                preferredCountries: ["ae", "in", "us", "gb", "sa"], // Common options
            });

            // Get full number on form submit
            input.form.addEventListener("submit", function() {
                input.value = iti.getNumber();
            });

            return iti;
        }

        // Apply on both IDs
        const itiPhone = initIntlTelInput("#phone");
        const itiRiMobile = initIntlTelInput("#ri-mobile");
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.select-dropDownClass').forEach(el => {
                new Choices(el, {
                    searchEnabled: false,
                    itemSelectText: '',
                    shouldSort: false
                });
            });
        });
    </script>

</body>

</html>