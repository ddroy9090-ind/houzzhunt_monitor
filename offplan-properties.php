<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

try {
    $pdo = hh_db();
    $stmt = $pdo->query('SELECT id, hero_banner, gallery_images, project_status, property_type, property_title, property_location, starting_price, bedroom, bathroom, total_area, created_at FROM properties_list ORDER BY created_at DESC');
    $offplanProperties = $stmt->fetchAll();
} catch (Throwable $e) {
    $offplanProperties = [];
}

$propertyCount = count($offplanProperties);
$updatedLabel = date('F j, Y');

$title = 'Dubai Off-Plan Properties for Sale | High ROI Deals';

$meta_tags = '
    <!-- Basic Meta -->
    
    <meta name="description" content="Explore top off-plan projects in Dubai with houzzhunt. Access early-stage deals, flexible payment plans & high-ROI investments in prime locations.">
    <meta name="keywords" content="off plan properties in dubai, dubai off plan projects, buy off plan property dubai, invest in off plan real estate dubai, new off plan launches dubai, off plan apartments in dubai, off plan villas in dubai, affordable off plan properties dubai, dubai off plan investment guide, off plan projects payment plan dubai, best off plan areas dubai, off plan homes near metro dubai, off plan developments under 1m dubai, luxury off plan projects in dubai, cheap off plan units dubai, dubai off plan townhouses, dubai off plan projects 2025, off plan resale in dubai, off plan deals direct from developer dubai, off plan master communities dubai, dubai offshore plan properties, off plan real estate returns dubai, off plan houses dubai, dubai off plan portfolio opportunities, off plan studio apartments dubai, off plan with amenities dubai, off plan waterfront properties dubai, paid off plan returns dubai, off plan to ready move dubai, off plan for expats dubai, DAMAC Riverside off plan dubai, Cubix Residences JVC off plan, Six Senses Residences Dubai Marina off plan, Franck Muller Aeternitas off plan, Mercedes Benz Places off plan Downtown dubai, Address Residences Zabeel off plan, Utopia by DAMAC off plan Al Barsha South, Atlantis The Royal Residences off plan Palm Jumeirah, Heart of Europe World Islands off plan, Dubai Hills Vista by Emaar off plan, Binghatti Skyhall Business Bay off plan, Creek Crescent Dubai Creek Harbour off plan, Safa Two by DAMAC off plan, Malta at DAMAC Lagoons off plan, Expo Golf Villas 6 off plan Emaar South, Peninsula Three Business Bay off plan, Verve by Meraas off plan, Siniya Island by Sobha off plan, DAMAC Islands off plan Dubailand, The Wilds Dubailand off plan, The Acres Phase 3 off plan Dubailand, Jumeirah Peninsula Bay off plan, Waada by BT off plan Dubai South, Palace Villas Ostra Emaar off plan, Canal One by Prestige One off plan, Bugatti Residences Business Bay off plan, Ritz‑Carlton Residences Business Bay off plan, Velora 2 The Valley off plan, Binghatti Jacob & Co Residences off plan, Lime Gardens Dubai Hills Estate off plan, Karl Lagerfeld Villas Meydan off plan, Casa Canal Al Wasl off plan, S Tower Sobha Internet City off plan, Armani Beach Residences Palm Jumeirah off plan, Sobha Seahaven off plan Ras Al Khor, Emaar The Oasis off plan Dubai Hills, Casa Canal by AHS off plan Al Wasl, Verve by Meraas JVT off plan, MJL Madinat Jumeirah Living off plan, Tilal Al Ghaf off plan Majid Al Futtaim, Bay Grove Phase 3 Nakheel off plan, Azizi Venice Dubai South off plan, Peninsula Three Select Group off plan, Sobha One Ras Al Khor off plan, Uptown Dubai Tower 1 off plan JLT, Bayz 102 by Danube off plan, Diamondz JLT off plan Danube, Gemz Danube Properties off plan, Mudan Al Ranim 7 Dubailand off plan, Arabella 3 Mudon off plan, La Violeta Villanova off plan, off plan 1 bhk apartment dubai, off plan 2 bhk apartment dubai, off plan 3 bhk apartment dubai, off plan 4 bhk apartment dubai, off plan studio dubai, off plan 1 bhk townhouse dubai, off plan 2 bhk townhouse dubai, off plan 3 bhk townhouse dubai, off plan 4 bhk townhouse dubai, off plan villa 3 bhk dubai, off plan villa 4 bhk dubai, off plan villa 5 bhk dubai, off plan penthouse dubai, off plan duplex dubai, off plan branded residence dubai, off plan retail units dubai, off plan office spaces dubai, off plan with sea view dubai, off plan with park view dubai, off plan family units dubai, houzzhunt off plan, off plan dubai houzzhunt, houzzhunt dubai property, houzzhunt new projects, dubai off plan listings, off plan homes houzzhunt, houzzhunt apartments sale, houzzhunt villas dubai, off plan real estate hh, houzzhunt property deals, hh off plan properties, houzzhunt payment plan, dubai launch houzzhunt, off plan by houzzhunt, houzzhunt, houzzhunt real estate, houzzhunt dubai">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="houzzhunt | Explore Properties, Real Estate Listings & Investment Opportunities">
    <meta property="og:description" content="Discover top residential and commercial properties, rent or buy your next dream home, and explore investment opportunities with houzzhunt – your reliable real estate portal.">
    <meta property="og:url" content="https://www.houzzhunt.com' . $_SERVER['REQUEST_URI'] . '">
    <meta property="og:image" content="https://www.houzzhunt.com/assets/images/meta-banner.jpg">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="houzzhunt | Explore Properties, Real Estate Listings & Investment Opportunities">
    <meta name="twitter:description" content="Discover top residential and commercial properties, rent or buy your next dream home, and explore investment opportunities with houzzhunt – your reliable real estate portal.">
    <meta name="twitter:image" content="https://www.houzzhunt.com/assets/images/meta-banner.jpg">
';

include 'includes/common-header.php';
include 'includes/navbar.php';
?>

<!-- page header start -->
<!-- <div class="page-header-section PropertiesList" style="background-image: url(assets/images/banner/offplan-banner.webp);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-heading animate fadeInLeft wow">
                    <h2>Exclusive Off-Plan Properties</h2>
                    <p class="lead">Discover handpicked off-plan projects across Dubai's most prestigious locations. Exclusive prices, flexible payment plans, and prime investment opportunities.</p>
                </div>
            </div>
        </div>

    </div>
</div> -->
<!-- page header start -->

<!-- parent: .hh-hero-01 -->
<div class="hh-hero-01" style="background-image: url(assets/images/banner/offplan-banner.webp);">
    <div class="container">
        <!-- Hero copy -->
        <div class="row">
            <div class="col-12">
                <header>
                    <h1>Exclusive Off-Plan Properties</h1>
                    <p>Discover handpicked off-plan projects across Dubai's most prestigious locations.
                        Exclusive prices, flexible payment plans, and prime investment opportunities.</p>
                </header>
            </div>
        </div>

        <!-- Floating search panel -->
        <div class="row">
            <div class="col-12">
                <form>
                    <div class="container">
                        <div class="row">

                            <!-- Location -->
                            <div class="col-12 col-md">
                                <label>
                                    <span>
                                        <!-- location pin -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-4 h-4 mr-1" data-lov-id="src/components/PropertyCard.tsx:63:12" data-lov-name="MapPin" data-component-path="src/components/PropertyCard.tsx" data-component-line="63" data-component-file="PropertyCard.tsx" data-component-name="MapPin" data-component-content="%7B%22className%22%3A%22w-4%20h-4%20mr-1%22%7D">
                                            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        Location
                                    </span>
                                    <select class="select-dropDownClass">
                                        <option>Downtown Dubai</option>
                                        <option>Dubai Marina</option>
                                        <option>Business Bay</option>
                                    </select>
                                </label>
                            </div>

                            <!-- Type -->
                            <div class="col-12 col-md">
                                <label>
                                    <span>
                                        <!-- home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house w-4 h-4" data-lov-id="src/components/SearchFilters.tsx:34:12" data-lov-name="Home" data-component-path="src/components/SearchFilters.tsx" data-component-line="34" data-component-file="SearchFilters.tsx" data-component-name="Home" data-component-content="%7B%22className%22%3A%22w-4%20h-4%22%7D">
                                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                                            <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        </svg>
                                        Type
                                    </span>
                                    <select id="property-type" class="select-dropDownClass">
                                        <option>Villa</option>
                                        <option>Apartment</option>
                                        <option>Townhouse</option>
                                    </select>
                                </label>
                            </div>

                            <!-- Bedrooms -->
                            <div class="col-12 col-md">
                                <label>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bed w-4 h-4" data-lov-id="src/components/PropertyCard.tsx:71:14" data-lov-name="Bed" data-component-path="src/components/PropertyCard.tsx" data-component-line="71" data-component-file="PropertyCard.tsx" data-component-name="Bed" data-component-content="%7B%22className%22%3A%22w-4%20h-4%22%7D">
                                            <path d="M2 4v16"></path>
                                            <path d="M2 8h18a2 2 0 0 1 2 2v10"></path>
                                            <path d="M2 17h20"></path>
                                            <path d="M6 8v9"></path>
                                        </svg>
                                        Bedrooms
                                    </span>
                                    <select class="select-dropDownClass">
                                        <option>Studio</option>
                                        <option>1 Bed</option>
                                        <option selected>2 Beds</option>
                                        <option>3 Beds</option>
                                        <option>4+ Beds</option>
                                    </select>
                                </label>
                            </div>

                            <!-- Price Range -->
                            <div class="col-12 col-md">
                                <label>
                                    <span>
                                        <!-- dollar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dollar-sign w-4 h-4" data-lov-id="src/components/SearchFilters.tsx:69:12" data-lov-name="DollarSign" data-component-path="src/components/SearchFilters.tsx" data-component-line="69" data-component-file="SearchFilters.tsx" data-component-name="DollarSign" data-component-content="%7B%22className%22%3A%22w-4%20h-4%22%7D">
                                            <line x1="12" x2="12" y1="2" y2="22"></line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg>
                                        Price Range
                                    </span>
                                    <select class="select-dropDownClass">
                                        <option>Budget</option>
                                        <option>Mid</option>
                                        <option>Premium</option>
                                        <option>Ultra</option>
                                    </select>
                                </label>
                            </div>

                            <!-- Search input -->
                            <div class="col-12 col-lg">

                                <label>
                                    <span>
                                        <!-- search -->
                                        <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M21 21 15.8 15.8M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15z" fill="none" stroke="currentColor" stroke-width="2" />
                                        </svg>
                                        Search
                                    </span>
                                    <input type="search" placeholder="Search properties…">
                                </label>
                            </div>

                            <!-- Actions -->
                            <div class="col-12 col-lg-auto">
                                <div class="mt-3">
                                    <button type="submit">Search</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<!-- parent: .hh-properties-01 -->
<div class="hh-properties-01">
    <div class="container">

        <!-- Heading + sort -->
        <div class="row">
            <div class="col-12">
                <div class="hh-properties-01-head">
                    <div>
                        <h2>Investment Opportunities</h2>
                        <p>Showing <?= htmlspecialchars((string)$propertyCount, ENT_QUOTES, 'UTF-8') ?> <?= $propertyCount === 1 ? 'property' : 'properties' ?> • Updated <?= htmlspecialchars($updatedLabel, ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                    <div>
                        <label>
                            Sort by:
                            <select>
                                <option>Price: High to Low</option>
                                <option>Price: Low to High</option>
                                <option>Newest</option>
                                <option>Oldest</option>
                            </select>
                        </label>
                        <div class="hh-properties-01-toggle">
                            <button type="button" data-view="grid" class="active">
                                <!-- grid icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-grid3x3 w-4 h-4" data-lov-id="src/components/PropertyListing.tsx:142:16" data-lov-name="Grid3X3" data-component-path="src/components/PropertyListing.tsx" data-component-line="142" data-component-file="PropertyListing.tsx" data-component-name="Grid3X3" data-component-content="%7B%22className%22%3A%22w-4%20h-4%22%7D">
                                    <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                                    <path d="M3 9h18"></path>
                                    <path d="M3 15h18"></path>
                                    <path d="M9 3v18"></path>
                                    <path d="M15 3v18"></path>
                                </svg>
                            </button>
                            <button type="button" data-view="list">
                                <!-- list icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list w-4 h-4" data-lov-id="src/components/PropertyListing.tsx:145:16" data-lov-name="List" data-component-path="src/components/PropertyListing.tsx" data-component-line="145" data-component-file="PropertyListing.tsx" data-component-name="List" data-component-content="%7B%22className%22%3A%22w-4%20h-4%22%7D">
                                    <path d="M3 12h.01"></path>
                                    <path d="M3 18h.01"></path>
                                    <path d="M3 6h.01"></path>
                                    <path d="M8 12h13"></path>
                                    <path d="M8 18h13"></path>
                                    <path d="M8 6h13"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards -->
        <div class="row hh-properties-01-grid">
            <?php if ($offplanProperties): ?>
                <?php foreach ($offplanProperties as $property): ?>
                    <?php
                        $heroBanner = trim((string)($property['hero_banner'] ?? ''));
                        $galleryImages = [];
                        if (!empty($property['gallery_images'])) {
                            $decodedGallery = json_decode((string)$property['gallery_images'], true);
                            if (is_array($decodedGallery)) {
                                foreach ($decodedGallery as $imagePath) {
                                    if (is_string($imagePath) && $imagePath !== '') {
                                        $galleryImages[] = $imagePath;
                                    }
                                }
                            }
                        }

                        $primaryImage = $heroBanner !== '' ? $heroBanner : ($galleryImages[0] ?? 'assets/images/offplan/breez-by-danube.webp');

                        $specs = [];
                        if (!empty($property['bedroom'])) {
                            $specs[] = ['icon' => 'assets/icons/bed.png', 'text' => trim((string)$property['bedroom']) . ' Beds'];
                        }
                        if (!empty($property['bathroom'])) {
                            $specs[] = ['icon' => 'assets/icons/bathroom.png', 'text' => trim((string)$property['bathroom']) . ' Baths'];
                        }
                        if (!empty($property['total_area'])) {
                            $specs[] = ['icon' => 'assets/icons/area.png', 'text' => trim((string)$property['total_area'])];
                        }

                        $priceCurrency = '';
                        $priceValue = '';
                        $rawPrice = trim((string)($property['starting_price'] ?? ''));
                        if ($rawPrice !== '') {
                            $priceDisplay = stripos($rawPrice, 'aed') === false ? 'AED ' . $rawPrice : $rawPrice;
                            if (stripos($priceDisplay, 'aed') === 0) {
                                $priceCurrency = 'AED';
                                $priceValue = trim(substr($priceDisplay, 3));
                            } else {
                                $priceValue = $priceDisplay;
                            }
                        }
                    ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="property-details.php?id=<?= (int)($property['id'] ?? 0) ?>" class="property-link">
                            <article>
                                <div class="hh-properties-01-img">
                                    <img src="<?= htmlspecialchars($primaryImage, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($property['property_title'] ?: 'Property', ENT_QUOTES, 'UTF-8') ?>">
                                    <div class="hh-properties-01-tags">
                                        <?php if (!empty($property['project_status'])): ?>
                                            <span class="green"><?= htmlspecialchars($property['project_status'], ENT_QUOTES, 'UTF-8') ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($property['property_type'])): ?>
                                            <span><?= htmlspecialchars($property['property_type'], ENT_QUOTES, 'UTF-8') ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <button type="button" class="hh-properties-01-fav" aria-label="Save">♥</button>
                                </div>
                                <div class="hh-properties-01-body">
                                    <h3><?= htmlspecialchars($property['property_title'] ?: 'Untitled Property', ENT_QUOTES, 'UTF-8') ?></h3>
                                    <?php if (!empty($property['property_location'])): ?>
                                        <p><img src="assets/icons/location.png" width="16" alt=""> <?= htmlspecialchars($property['property_location'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <?php endif; ?>
                                    <?php if ($specs): ?>
                                        <ul>
                                            <?php foreach ($specs as $spec): ?>
                                                <li><img src="<?= htmlspecialchars($spec['icon'], ENT_QUOTES, 'UTF-8') ?>" width="16" alt=""> <?= htmlspecialchars($spec['text'], ENT_QUOTES, 'UTF-8') ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                    <div class="hh-properties-01-foot">
                                        <?php if ($priceValue !== ''): ?>
                                            <strong>
                                                <?php if ($priceCurrency !== ''): ?>
                                                    <span><?= htmlspecialchars($priceCurrency, ENT_QUOTES, 'UTF-8') ?></span>
                                                <?php endif; ?>
                                                <?= htmlspecialchars($priceValue, ENT_QUOTES, 'UTF-8') ?>
                                            </strong>
                                        <?php else: ?>
                                            <strong>Price on request</strong>
                                        <?php endif; ?>
                                        <span class="details-link">View Details</span>
                                    </div>
                                </div>
                            </article>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="mb-0">No off-plan properties available right now. Please check back soon.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>


<script>
    document.querySelectorAll('.hh-properties-01-toggle button').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.hh-properties-01-toggle button')
                .forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const grid = document.querySelector('.hh-properties-01-grid');
            if (btn.dataset.view === 'list') {
                grid.classList.add('list-view');
            } else {
                grid.classList.remove('list-view');
            }
        });
    });
</script>

<style>
    .hh-properties-01-grid.list-view .col-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .hh-properties-01-grid.list-view article {
        display: flex;
        gap: 20px;
    }

    .hh-properties-01-grid.list-view .hh-properties-01-img {
        flex: 0 0 40%;
    }

    .hh-properties-01-grid.list-view .hh-properties-01-body {
        flex: 1;
    }
</style>


<?php include 'includes/footer.php'; ?>
<?php include 'includes/common-footer.php'; ?>