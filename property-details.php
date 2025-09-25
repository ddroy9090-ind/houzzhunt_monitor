<?php

$title = 'The Weave JVC - Dubai Off-Plan Properties | Al Ghurair Development';

// Enhanced meta tags with proper SEO
$meta_tags = '
    <!-- Basic Meta -->
    <meta name="description" content="Discover The Weave by Al Ghurair in Jumeirah Village Circle, Dubai. Premium 1, 2 & 3.5 bedroom apartments with rooftop amenities, flexible payment plans, and prime location access.">
    <meta name="keywords" content="The Weave Dubai, Al Ghurair JVC, Jumeirah Village Circle apartments, Dubai off-plan properties, Dubai real estate investment, luxury apartments Dubai">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://yoursite.com/property-details.php">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="The Weave JVC - Premium Dubai Apartments | Al Ghurair">
    <meta property="og:description" content="Luxury 1-3.5 bedroom apartments in Jumeirah Village Circle with rooftop club, pool, and premium amenities. Flexible payment plans available.">
    <meta property="og:image" content="https://houzzhunt.com/assets/images/banner/offplan-banner.webp">
    <meta property="og:url" content="https://yoursite.com/property-details.php">
    <meta property="og:type" content="website">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="The Weave JVC - Premium Dubai Apartments">
    <meta name="twitter:description" content="Luxury apartments in JVC with flexible payment plans and premium amenities.">
    <meta name="twitter:image" content="https://houzzhunt.com/assets/images/banner/offplan-banner.webp">
    
    <!-- Structured Data for Real Estate -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "RealEstateListing",
        "name": "The Weave - Jumeirah Village Circle",
        "description": "Premium residential apartments by Al Ghurair in Dubai\'s vibrant JVC community",
        "url": "https://yoursite.com/property-details.php",
        "image": "https://houzzhunt.com/assets/images/banner/offplan-banner.webp",
        "offers": {
            "@type": "Offer",
            "priceCurrency": "USD",
            "price": "136128505",
            "availability": "https://schema.org/InStock"
        },
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Dubai",
            "addressRegion": "Jumeirah Village Circle",
            "addressCountry": "UAE"
        },
        "floorSize": {
            "@type": "QuantitativeValue",
            "value": "43.828-153.224",
            "unitText": "square meters"
        }
    }
    </script>
';

include 'includes/common-header.php';
include 'includes/navbar.php';
?>

<!-- Enhanced page header with better accessibility -->
<div class="page-header-section" style="background-image: url(assets/images/banner/offplan-banner.webp); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="page-header-heading animate fadeInLeft wow" data-wow-duration="2000ms">
                    <h1 class="h2">The Weave - Premium Apartments in JVC</h1>
                    <p class="lead">Discover Al Ghurair's masterpiece in Jumeirah Village Circle. Exclusive prices, flexible payment plans, and prime future-ready location with world-class amenities.</p>
                </div>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <img src="assets/images/about/arrow-brudcrumb.svg" alt="breadcrumb separator" width="16" height="16">
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span>Property Details</span>
                </li>
            </ol>
        </nav>
    </div>
</div>

<!-- Enhanced Residential Services Section -->
<section class="residential-services-section py-5" aria-labelledby="residential-heading">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-6">
                <div class="residential-text">
                    <h2 id="residential-heading" class="residential-title heading-title">
                        <span>An Iconic Residential Presence in JVC</span>
                    </h2>
                    <p>
                        The Weave by Al Ghurair represents a new standard in Dubai's residential landscape. Our RICS-compliant development offers apartments, designed with meticulous attention to detail. Each unit is crafted based on market analysis, location advantages, and future growth potential.
                    </p>
                    <p>
                        Set within the vibrant community of Jumeirah Village Circle, The Weave introduces a new benchmark for modern apartment living in Dubai. This thoughtfully designed development offers serene community views and lush green surroundings, allowing you to immerse yourself in tranquility while maintaining easy access to premier dining, shopping, and entertainment venues throughout the city.
                    </p>

                    <!-- Added key features -->
                    <div class="key-features mt-4">
                        <h3 class="h5 mb-3">Key Highlights:</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> 1, 2 & 3.5 bedroom apartments</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Rooftop club with premium amenities</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Flexible 80/20 payment plan</li>
                            <li class="mb-2"><i class="fas fa-check text-primary me-2"></i> Prime JVC location</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-6">
                <div class="residential-image">
                    <img src="assets/images/allservices/worth-beyond-1.webp"
                        alt="The Weave residential building exterior view"
                        class="img-fluid rounded shadow-lg"
                        loading="lazy"
                        width="600"
                        height="400">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Property Gallery Section -->
<section class="property-gallery-section" aria-labelledby="gallery-heading">
    <div class="container">
        <div class="row g-3">
            <div class="col-lg-12">
                <h2 id="gallery-heading" class="heading-title">The <span>Weave | Al Ghurair | Jumeirah Village Circle,</span> Dubai</h2>
            </div>

            <!-- Main gallery image with modal trigger -->
            <div class="col-12 col-lg-8 position-relative">
                <div class="gallery-main-image h-100" data-bs-toggle="modal" data-bs-target="#galleryModal" style="cursor: pointer;">
                    <img src="https://houzzhunt.com/assets/images/banner/offplan-banner.webp"
                        alt="The Weave main building view"
                        class="img-fluid w-100 rounded h-100 shadow-sm"
                        loading="lazy">
                    <div class="gallery-overlay">
                        <i class="fas fa-expand-alt text-white fa-2x"></i>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="gallery-thumb" data-bs-toggle="modal" data-bs-target="#galleryModal" style="cursor: pointer;">
                            <img src="https://d33om22pidobo4.cloudfront.net/projects/gallery/4jpg-727f9584-8b71-47df-add6-acced22a441d.jpg?d=500x333&f=webp"
                                alt="Rooftop jacuzzi area"
                                class="img-fluid w-100 rounded shadow-sm"
                                loading="lazy">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="gallery-thumb" data-bs-toggle="modal" data-bs-target="#galleryModal" style="cursor: pointer;">
                            <img src="https://d33om22pidobo4.cloudfront.net/projects/gallery/5jpg-dbb4e1d6-8f7d-44cf-8660-e93edec0a993.jpg?d=500x333&f=webp"
                                alt="Modern living room interior"
                                class="img-fluid w-100 rounded shadow-sm"
                                loading="lazy">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced property description -->
            <div class="col-lg-12">
                <div class="property-descriptiondetails">
                    <h3 class="h4 mb-4">About This Development</h3>
                    <div class="description-content">
                        <p>
                            Developed by Al Ghurair, The Weave is a charming new residential development nestled in the vibrant community of Jumeirah Village Circle (JVC), Dubai. Designed to bring people together through thoughtful architecture and inviting spaces, The Weave blends modern urban living with a cozy, neighborhood feel.
                        </p>
                        <p>
                            Offering a collection of impeccably designed 1, 2 and 3.5 bedroom apartments, The Weave is perfect for young professionals, couples, and families seeking comfort, connectivity, and convenience. Each apartment is designed with contemporary finishes, open-plan layouts, and ample natural light - creating a relaxed and airy living environment.
                        </p>
                        <p>
                            The community features a curated selection of lifestyle amenities, including a rooftop club with swimming pool, jacuzzis, sauna, ice room, barbecue and dining area, private cinema and a social lounge for residents to unwind and connect. With its central location in JVC, residents also enjoy easy access to key areas like Dubai Marina, Downtown Dubai, and major highways.
                        </p>
                        <p>
                            The Weave reflects Al Ghurair's commitment to excellence in quality, functionality, and design integrity. Whether you're investing or planning to live in it, The Weave is a place where modern comfort meets meaningful community living.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Amenities Section -->
<section class="amenities-section py-5" aria-labelledby="amenities-heading">
    <div class="container">
        <h2 id="amenities-heading" class="section-title heading-title mb-5"><span>Amenities & Property Details</span></h2>

        <!-- Enhanced Listing Details -->
        <div class="listing-details mb-5">
            <h3 class="sub-title h4 mb-4">Property Information</h3>
            <div class="row g-4">
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="detail-item p-3 border rounded">
                        <p class="label mb-1 text-muted small">Property ID</p>
                        <p class="value mb-0 fw-bold">5TF65R</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="detail-item p-3 border rounded">
                        <p class="label mb-1 text-muted small">MLS#</p>
                        <p class="value mb-0 fw-bold">GS-S-48420</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="detail-item p-3 border rounded">
                        <p class="label mb-1 text-muted small">Starting Price</p>
                        <p class="value mb-0 fw-bold text-primary">From $850K</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="detail-item p-3 border rounded">
                        <p class="label mb-1 text-muted small">Property Type</p>
                        <p class="value mb-0 fw-bold">Apartments</p>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="detail-item p-3 border rounded">
                        <p class="label mb-1 text-muted small">Developed By</p>
                        <p class="value mb-0 fw-bold">Al Ghurair Real Estate</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="detail-item p-3 border rounded">
                        <p class="label mb-1 text-muted small">Status</p>
                        <p class="value mb-0 fw-bold text-success">Available</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="detail-item p-3 border rounded">
                        <p class="label mb-1 text-muted small">Completion</p>
                        <p class="value mb-0 fw-bold">Q4 2026</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unit Specifications -->
        <div class="interior-details mt-5">
            <h3 class="sub-title h4 mb-4">Unit Specifications</h3>
            <div class="row g-4">
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="detail-item p-3 border rounded">
                        <p class="label mb-1 text-muted small">Bathrooms</p>
                        <p class="value mb-0 fw-bold">1-3</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="detail-item p-3 border rounded">
                        <p class="label mb-1 text-muted small">Bedrooms</p>
                        <p class="value mb-0 fw-bold">1-3.5</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-6">
                    <div class="detail-item p-3 border rounded">
                        <p class="label mb-1 text-muted small">Size Range</p>
                        <p class="value mb-0 fw-bold">43.8 - 153.2 sqm</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Amenities List -->
        <div class="amenities-list mt-5">
            <h3 class="sub-title h4 mb-4">World-Class Amenities</h3>
            <div class="row g-3">
                <div class="col-md-6 col-lg-4">
                    <div class="amenity-item d-flex align-items-center p-2">
                        <i class="fas fa-swimming-pool text-primary me-3"></i>
                        <span>Rooftop Swimming Pool</span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="amenity-item d-flex align-items-center p-2">
                        <i class="fas fa-hot-tub text-primary me-3"></i>
                        <span>Jacuzzis & Spa</span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="amenity-item d-flex align-items-center p-2">
                        <i class="fas fa-film text-primary me-3"></i>
                        <span>Private Cinema</span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="amenity-item d-flex align-items-center p-2">
                        <i class="fas fa-dumbbell text-primary me-3"></i>
                        <span>Fitness Center</span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="amenity-item d-flex align-items-center p-2">
                        <i class="fas fa-fire text-primary me-3"></i>
                        <span>BBQ & Dining Area</span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="amenity-item d-flex align-items-center p-2">
                        <i class="fas fa-users text-primary me-3"></i>
                        <span>Social Lounge</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Floor Plans Section -->
<section class="floorplans-section py-5" aria-labelledby="floorplans-heading">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-12">
                <h2 id="floorplans-heading" class="heading-title mb-4"><span>Floor Plans & Unit Types</span></h2>
            </div>
            <div class="col-12 col-lg-7">
                <div class="floorplan-tabs">
                    <div class="floorplan-tab active p-3 border rounded mb-3"
                        data-image="https://a.storyblok.com/f/165304/762x726/1beddd4474/gardenia-bay-floor-plan.png"
                        role="button" tabindex="0">
                        <h4 class="h5 mb-2">Studio Apartment</h4>
                        <p class="mb-1 text-muted">43.828 to 45.625 sqm</p>
                        <p class="mb-0 small text-primary">Starting from $850K</p>
                    </div>
                    <div class="floorplan-tab p-3 border rounded mb-3"
                        data-image="https://a.storyblok.com/f/165304/668x690/d73ba1d330/gardenia-bay-floor-plan.png"
                        role="button" tabindex="0">
                        <h4 class="h5 mb-2">1 Bedroom Apartment</h4>
                        <p class="mb-1 text-muted">70.780 to 73.467 sqm</p>
                        <p class="mb-0 small text-primary">Starting from $1.2M</p>
                    </div>
                    <div class="floorplan-tab p-3 border rounded mb-3"
                        data-image="https://a.storyblok.com/f/165304/996x668/1a83678dd5/gardenia-bay-floor-plan.png"
                        role="button" tabindex="0">
                        <h4 class="h5 mb-2">2 Bedroom Apartment</h4>
                        <p class="mb-1 text-muted">106.375 to 109.641 sqm</p>
                        <p class="mb-0 small text-primary">Starting from $1.8M</p>
                    </div>
                    <div class="floorplan-tab p-3 border rounded mb-3"
                        data-image="https://a.storyblok.com/f/165304/1322x750/97d0d615e6/gardenia-bay-floor-plan.png"
                        role="button" tabindex="0">
                        <h4 class="h5 mb-2">3 Bedroom Apartment</h4>
                        <p class="mb-1 text-muted">145.533 to 153.224 sqm</p>
                        <p class="mb-0 small text-primary">Starting from $2.5M</p>
                    </div>
                    <div class="floorplan-tab p-3 border rounded mb-3"
                        data-image="https://a.storyblok.com/f/165304/800x800/0ff6642c7e/gardenia-bay-4-br-townhouse-floor-plan.png"
                        role="button" tabindex="0">
                        <h4 class="h5 mb-2">3.5 Bedroom Duplex</h4>
                        <p class="mb-1 text-muted">165+ sqm</p>
                        <p class="mb-0 small text-primary">Starting from $3.2M</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="floorplan-image-wrapper text-center">
                    <img id="floorplan-image"
                        src="https://a.storyblok.com/f/165304/762x726/1beddd4474/gardenia-bay-floor-plan.png"
                        alt="Studio apartment floor plan"
                        class="img-fluid rounded shadow-lg"
                        loading="lazy">
                    <p class="mt-3 text-muted small">Click on unit types to view different floor plans</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Location Section -->
<section class="location-section py-5" aria-labelledby="location-heading">
    <div class="container">
        <div class="row g-4">
            <div class="col-12 col-lg-6">
                <div class="map-container">
                    <iframe
                        src="https://www.openstreetmap.org/export/embed.html?bbox=55.2620%2C25.1850%2C55.3050%2C25.2300&layer=mapnik&marker=25.2048%2C55.2708"
                        style="border:0; width:100%; height:400px; border-radius:15px;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="The Weave location map in Jumeirah Village Circle">
                    </iframe>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="location-content">
                    <h2 id="location-heading" class="heading-title mb-4"><span>Prime JVC Location</span></h2>
                    <h3 class="location-title h4 mb-4">Strategically positioned in Jumeirah Village Circle, offering connectivity and community lifestyle</h3>

                    <div class="location-highlights mb-4">
                        <h4 class="h5 mb-3">Nearby Attractions & Distances:</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> Dubai Marina - 10 minutes</li>
                            <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> Dubai Mall - 20 minutes</li>
                            <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> Palm Jumeirah - 15 minutes</li>
                            <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> DXB Airport - 35 minutes</li>
                            <li class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> Circle Mall JVC - 5 minutes</li>
                        </ul>
                    </div>

                    <p class="location-description mb-3">
                        The Weave is strategically located in Jumeirah Village Circle, offering seamless connectivity to key destinations throughout Dubai. With excellent access to major highways, residents enjoy easy commutes to business districts, entertainment hubs, and shopping destinations while living in a peaceful, family-friendly community.
                    </p>
                    <p class="location-description">
                        JVC is renowned for its pet-friendly environment, numerous parks, and family-oriented facilities, making it one of Dubai's most sought-after residential communities for those seeking quality of life and investment potential.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Payment Plan Section -->
<section class="payment-plan-section py-5" aria-labelledby="payment-heading">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-12 text-center">
                <h2 id="payment-heading" class="payment-title heading-title mb-3"><span>Flexible Payment Plan</span></h2>
                <p class="lead text-muted">Investor-friendly payment structure designed for your convenience</p>
            </div>
        </div>
        <div class="row justify-content-center g-4">
            <div class="col-12 col-md-5">
                <div class="payment-box text-center p-5 border rounded shadow-sm">
                    <h3 class="payment-percentage display-4 text-primary mb-3">80%</h3>
                    <p class="payment-description h5 mb-3">During Construction</p>
                    <p class="text-muted small">Flexible installments spread over construction period</p>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="payment-box text-center p-5 border rounded shadow-sm">
                    <h3 class="payment-percentage display-4 text-success mb-3">20%</h3>
                    <p class="payment-description h5 mb-3">On Completion</p>
                    <p class="text-muted small">Final payment upon handover in Q4 2026</p>
                </div>
            </div>
        </div>

        <!-- Added CTA section -->
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-8 text-center">
                <div class="cta-section p-4 bg-light rounded">
                    <h3 class="h4 mb-3">Ready to Invest in Your Future?</h3>
                    <p class="mb-4">Contact our property specialists today for exclusive pricing and floor plan details.</p>
                    <div class="row g-3 justify-content-center">
                        <div class="col-auto">
                            <a href="tel:+971-XXX-XXXX" class="btn btn-primary btn-lg">
                                <i class="fas fa-phone me-2"></i>Call Now
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#inquiry-form" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-envelope me-2"></i>Request Info
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Image Gallery Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalLabel">The Weave - Property Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div id="propertyGalleryCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://houzzhunt.com/assets/images/banner/offplan-banner.webp" class="d-block w-100" alt="Building exterior">
                        </div>
                        <div class="carousel-item">
                            <img src="https://d33om22pidobo4.cloudfront.net/projects/gallery/4jpg-727f9584-8b71-47df-add6-acced22a441d.jpg?d=1200x800&f=webp" class="d-block w-100" alt="Rooftop jacuzzi">
                        </div>
                        <div class="carousel-item">
                            <img src="https://d33om22pidobo4.cloudfront.net/projects/gallery/5jpg-dbb4e1d6-8f7d-44cf-8660-e93edec0a993.jpg?d=1200x800&f=webp" class="d-block w-100" alt="Living room interior">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#propertyGalleryCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#propertyGalleryCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter section start -->
<?php include 'includes/subscribe-form.php'; ?>
<!-- Newsletter section end -->

<!-- Enhanced JavaScript with better functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enhanced floor plan tab functionality
        const tabs = document.querySelectorAll('.floorplan-tab');
        const image = document.getElementById('floorplan-image');

        tabs.forEach(tab => {
            // Mouse click event
            tab.addEventListener('click', function() {
                switchFloorPlan(this);
            });

            // Keyboard accessibility
            tab.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    switchFloorPlan(this);
                }
            });

            // Hover effects for better UX
            tab.addEventListener('mouseenter', function() {
                if (!this.classList.contains('active')) {
                    this.style.backgroundColor = '#f8f9fa';
                    this.style.transition = 'background-color 0.3s ease';
                }
            });

            tab.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    this.style.backgroundColor = '';
                }
            });
        });

        function switchFloorPlan(activeTab) {
            // Remove active state from all tabs
            tabs.forEach(t => {
                t.classList.remove('active');
                t.style.backgroundColor = '';
                t.style.borderColor = '';
            });

            // Add active state to clicked tab
            activeTab.classList.add('active');
            activeTab.style.backgroundColor = '#e3f2fd';
            activeTab.style.borderColor = '#2196f3';

            // Get new image source and alt text
            const newSrc = activeTab.getAttribute('data-image');
            const unitType = activeTab.querySelector('h4').textContent;

            // Smooth image transition with loading state
            image.style.opacity = '0.3';
            image.style.transition = 'opacity 0.3s ease';

            // Create new image to preload
            const newImage = new Image();
            newImage.onload = function() {
                image.src = newSrc;
                image.alt = unitType + ' floor plan';
                image.style.opacity = '1';
            };
            newImage.src = newSrc;

            // Update URL hash for deep linking
            const unitSlug = unitType.toLowerCase().replace(/\s+/g, '-');
            history.replaceState(null, null, '#' + unitSlug);
        }

        // Gallery modal enhancements
        const galleryImages = document.querySelectorAll('.gallery-thumb, .gallery-main-image');
        const modal = document.getElementById('galleryModal');
        const carousel = document.getElementById('propertyGalleryCarousel');

        if (galleryImages && modal && carousel) {
            galleryImages.forEach((img, index) => {
                img.addEventListener('click', function() {
                    // Set active slide based on clicked image
                    const carouselItems = carousel.querySelectorAll('.carousel-item');
                    carouselItems.forEach((item, i) => {
                        item.classList.toggle('active', i === index);
                    });
                });
            });
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Load specific floor plan from URL hash
        const urlHash = window.location.hash.substring(1);
        if (urlHash) {
            const targetTab = Array.from(tabs).find(tab => {
                const unitType = tab.querySelector('h4').textContent.toLowerCase().replace(/\s+/g, '-');
                return unitType === urlHash;
            });

            if (targetTab) {
                switchFloorPlan(targetTab);
            }
        }

        // Lazy loading enhancement for images
        const lazyImages = document.querySelectorAll('img[loading="lazy"]');
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.classList.add('fade-in');
                        observer.unobserve(img);
                    }
                });
            });

            lazyImages.forEach(img => imageObserver.observe(img));
        }

        // Form validation and enhancement (if contact forms exist)
        const contactForms = document.querySelectorAll('form');
        contactForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('is-invalid');

                        // Remove invalid class after user starts typing
                        field.addEventListener('input', function() {
                            this.classList.remove('is-invalid');
                        });
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    // Scroll to first invalid field
                    const firstInvalid = form.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                }
            });
        });

        // Add loading states for buttons
        const buttons = document.querySelectorAll('button, .btn');
        buttons.forEach(btn => {
            if (btn.type === 'submit') {
                btn.addEventListener('click', function() {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                    this.disabled = true;

                    // Re-enable after 3 seconds (adjust based on your needs)
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }, 3000);
                });
            }
        });

        // Performance: Preload critical images
        const criticalImages = [
            'https://houzzhunt.com/assets/images/banner/offplan-banner.webp',
            'assets/images/allservices/worth-beyond-1.webp'
        ];

        criticalImages.forEach(src => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = 'image';
            link.href = src;
            document.head.appendChild(link);
        });
    });

    // Advanced analytics tracking (Google Analytics 4 example)
    function trackPropertyInterest(action, property_name = 'The Weave JVC') {
        if (typeof gtag !== 'undefined') {
            gtag('event', action, {
                'custom_parameter_1': property_name,
                'custom_parameter_2': 'JVC',
                'value': 1
            });
        }
    }

    // Track floor plan views
    document.addEventListener('DOMContentLoaded', function() {
        const floorPlanTabs = document.querySelectorAll('.floorplan-tab');
        floorPlanTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const unitType = this.querySelector('h4').textContent;
                trackPropertyInterest('view_floor_plan', `The Weave - ${unitType}`);
            });
        });
    });
</script>

<!-- Additional CSS for enhancements -->
<style>
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 15px;
    }

    .gallery-main-image:hover .gallery-overlay,
    .gallery-thumb:hover .gallery-overlay {
        opacity: 1;
    }

    .floorplan-tab {
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid #e9ecef !important;
    }

    .floorplan-tab:hover {
        border-color: #dee2e6 !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .floorplan-tab.active {
        background-color: #e3f2fd !important;
        border-color: #2196f3 !important;
        box-shadow: 0 4px 8px rgba(33, 150, 243, 0.2);
    }

    .amenity-item {
        transition: background-color 0.3s ease;
    }

    .amenity-item:hover {
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .detail-item {
        transition: box-shadow 0.3s ease;
    }

    .detail-item:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .cta-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .floorplan-tabs .floorplan-tab {
            margin-bottom: 1rem;
        }

        .payment-box {
            margin-bottom: 2rem;
        }

        .detail-item {
            margin-bottom: 1rem;
        }
    }

    /* Accessibility improvements */
    .floorplan-tab:focus {
        outline: 2px solid #2196f3;
        outline-offset: 2px;
    }

    .btn:focus {
        box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.3);
    }

    /* Print styles */
    @media print {

        .gallery-overlay,
        .modal,
        .btn {
            display: none !important;
        }

        .container {
            max-width: none !important;
        }
    }
</style>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/common-footer.php'; ?>