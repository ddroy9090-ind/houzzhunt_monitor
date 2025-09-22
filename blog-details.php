<?php

$blogId = (int)($_GET['id'] ?? 0);

function connect_blog_pdo(): ?PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    try {
        $dsn = 'mysql:host=localhost;port=3306;dbname=hmonitor_portal;charset=utf8mb4';
        $pdo = new PDO($dsn, 'root', '', [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    } catch (Throwable $exception) {
        error_log('Failed to connect to the blogs database: ' . $exception->getMessage());
        $pdo = null;
    }

    return $pdo;
}

function fetch_blog_by_id(PDO $pdo, int $blogId): ?array
{
    $statement = $pdo->prepare('SELECT * FROM blogs WHERE id = :id');
    $statement->execute([':id' => $blogId]);
    $blog = $statement->fetch();

    return $blog ?: null;
}

function fetch_recent_blogs(PDO $pdo, int $excludeId, int $limit = 3): array
{
    $sql = 'SELECT id, image_path, heading, created_at FROM blogs';
    $params = [];

    if ($excludeId > 0) {
        $sql .= ' WHERE id != :excludeId';
        $params[':excludeId'] = $excludeId;
    }

    $sql .= ' ORDER BY created_at DESC LIMIT ' . max(1, (int)$limit);

    try {
        $statement = $pdo->prepare($sql);
        $statement->execute($params);
        $blogs = $statement->fetchAll();

        return is_array($blogs) ? $blogs : [];
    } catch (Throwable $exception) {
        error_log('Failed to fetch recent blogs: ' . $exception->getMessage());
    }

    return [];
}

function format_recent_blog_date(?string $date): string
{
    if (!$date) {
        return '';
    }

    try {
        $dateTime = new DateTimeImmutable($date);
    } catch (Throwable $exception) {
        error_log('Failed to parse blog date: ' . $exception->getMessage());

        return '';
    }

    return $dateTime->format('d F Y');
}

function format_heading_with_span(string $heading): string
{
    $heading = trim($heading);
    if ($heading === '') {
        return '';
    }

    $words = preg_split('/\s+/', $heading, -1, PREG_SPLIT_NO_EMPTY);
    if (!$words) {
        return htmlspecialchars($heading, ENT_QUOTES, 'UTF-8');
    }

    if (count($words) === 1) {
        return '<span>' . htmlspecialchars($words[0], ENT_QUOTES, 'UTF-8') . '</span>';
    }

    $first  = array_shift($words);
    $last   = array_pop($words);
    $middle = implode(' ', $words);

    if ($middle === '') {
        return htmlspecialchars($first, ENT_QUOTES, 'UTF-8') . ' <span>' . htmlspecialchars($last, ENT_QUOTES, 'UTF-8') . '</span>';
    }

    return htmlspecialchars($first, ENT_QUOTES, 'UTF-8') . ' <span>' . htmlspecialchars($middle, ENT_QUOTES, 'UTF-8') . '</span> ' . htmlspecialchars($last, ENT_QUOTES, 'UTF-8');
}

$blog = null;
$recentBlogs = [];
$blogError = null;

$pdo = connect_blog_pdo();
if ($pdo) {
    if ($blogId > 0) {
        try {
            $blog = fetch_blog_by_id($pdo, $blogId);
        } catch (Throwable $exception) {
            error_log('Failed to load blog details: ' . $exception->getMessage());
            $blog = null;
        }
    } else {
        $blogError = 'Invalid blog request.';
    }

    try {
        $recentBlogs = fetch_recent_blogs($pdo, $blogId);
    } catch (Throwable $exception) {
        error_log('Failed to load recent blogs for sidebar: ' . $exception->getMessage());
        $recentBlogs = [];
    }
} else {
    $blogError = 'We are unable to connect to the blog database at this time.';
}

if (!$blog) {
    if (!$blogError) {
        $blogError = 'The requested blog could not be found.';
    }
    http_response_code(404);
}

$defaultBannerDescription = 'Uncover high-yield luxury investments in Dubai’s most exclusive and under-the-radar locations.';
$defaultHeading          = 'Dubai Luxury Secrets';
$defaultImage            = 'assets/images/blog/top-roi-areas-in-dubai-banner.webp';

$heading           = (string)($blog['heading'] ?? $defaultHeading);
$bannerDescription = (string)($blog['banner_description'] ?? $defaultBannerDescription);
$imagePath         = (string)($blog['image_path'] ?? $defaultImage);
$shortDescription  = (string)($blog['short_description'] ?? '');
$authorName        = (string)($blog['author_name'] ?? 'houzzhunt');
$category          = trim((string)($blog['category'] ?? ''));
$createdAt         = $blog['created_at'] ?? null;
$blogContent       = $blog ? (string)($blog['content'] ?? '') : '';

$metaTitle = $blog ? (string)($blog['meta_title'] ?? $heading) : 'Blog Details';
$metaDescription = $blog
    ? ((string)($blog['meta_description'] ?? ($shortDescription !== '' ? $shortDescription : $bannerDescription)))
    : 'Discover the latest real estate insights from houzzhunt.';
$metaKeywords = $blog ? trim((string)($blog['meta_keywords'] ?? '')) : 'houzzhunt, real estate insights, dubai real estate';
$metaImage    = $imagePath !== '' ? $imagePath : $defaultImage;
$metaUrl      = 'https://www.houzzhunt.com/blog-details.php' . ($blogId > 0 ? '?id=' . $blogId : '');

$title = $metaTitle;

$escapedDescription = htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8');
$escapedMetaTitle   = htmlspecialchars($metaTitle, ENT_QUOTES, 'UTF-8');
$escapedMetaUrl     = htmlspecialchars($metaUrl, ENT_QUOTES, 'UTF-8');
$escapedMetaImage   = htmlspecialchars((strpos($metaImage, 'http') === 0 ? $metaImage : 'https://www.houzzhunt.com/' . ltrim($metaImage, '/')), ENT_QUOTES, 'UTF-8');
$escapedKeywords    = htmlspecialchars($metaKeywords, ENT_QUOTES, 'UTF-8');

$metaTags = [
    '<!-- Basic Meta -->',
    '<meta name="description" content="' . $escapedDescription . '">',
];

if ($metaKeywords !== '') {
    $metaTags[] = '<meta name="keywords" content="' . $escapedKeywords . '">';
}

$metaTags = array_merge($metaTags, [
    '<!-- Open Graph / Facebook -->',
    '<meta property="og:type" content="article">',
    '<meta property="og:title" content="' . $escapedMetaTitle . '">',
    '<meta property="og:description" content="' . $escapedDescription . '">',
    '<meta property="og:url" content="' . $escapedMetaUrl . '">',
    '<meta property="og:image" content="' . $escapedMetaImage . '">',
    '',
    '<!-- Twitter -->',
    '<meta name="twitter:card" content="summary_large_image">',
    '<meta name="twitter:title" content="' . $escapedMetaTitle . '">',
    '<meta name="twitter:description" content="' . $escapedDescription . '">',
    '<meta name="twitter:image" content="' . $escapedMetaImage . '">',
]);

$meta_tags = "\n    " . implode("\n    ", $metaTags) . "\n";

$currentBlogLink    = $blog ? 'blog-details.php?id=' . rawurlencode((string)$blogId) : 'blogs.php';
$publishedDate      = format_recent_blog_date($createdAt);
$metaItems = [];

if ($blog) {
    $metaItems[] = '<li><span>by </span><a href="' . htmlspecialchars($currentBlogLink, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($authorName, ENT_QUOTES, 'UTF-8') . '</a></li>';
    if ($category !== '') {
        $metaItems[] = '<li>|</li>';
        $metaItems[] = '<li><a href="' . htmlspecialchars($currentBlogLink, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($category, ENT_QUOTES, 'UTF-8') . '</a></li>';
    }
    if ($publishedDate !== '') {
        $metaItems[] = '<li>|</li>';
        $metaItems[] = '<li>' . htmlspecialchars($publishedDate, ENT_QUOTES, 'UTF-8') . '</li>';
    }
}

include 'includes/common-header.php';
include 'includes/navbar.php';
?>

<!-- page header start -->
<div class="page-header-section" style="background-image: url(<?= htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') ?>);">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="page-header-heading animate fadeInLeft wow" data-wow-duration="2000ms">
                    <h2><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?></h2>
                    <p class="lead"><?= nl2br(htmlspecialchars($bannerDescription, ENT_QUOTES, 'UTF-8')) ?></p>
                </div>
            </div>
        </div>
        <ul class="breadcrumb">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <img src="assets/images/about/arrow-brudcrumb.svg" alt="icon">
            </li>
            <li>
                <a href="blogs.php">blog</a>
            </li>

        </ul>
    </div>
</div>
<!-- page header start -->

<!-- blog start -->
<div class="blog-single-section" id="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php if ($blog): ?>
                    <div class="blog-list-box animate fadeInLeft wow" data-wow-duration="1500ms" data-wow-delay="200ms">
                        <h2 class="heading-title"><?= format_heading_with_span($heading) ?></h2>
                        <?php if ($bannerDescription !== ''): ?>
                            <p><?= nl2br(htmlspecialchars($bannerDescription, ENT_QUOTES, 'UTF-8')) ?></p>
                        <?php endif; ?>
                        <?php if ($metaItems): ?>
                            <div class="blog-single-meta">
                                <ul>
                                    <?php foreach ($metaItems as $item): ?>
                                        <?= $item ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="blog-list-box animate fadeInLeft wow" data-wow-duration="1500ms" data-wow-delay="300ms">
                        <div class="blog-content">
                            <?= $blogContent ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="blog-list-box animate fadeInLeft wow" data-wow-duration="1500ms" data-wow-delay="200ms">
                        <div class="blog-single-details">
                            <h4>Blog unavailable</h4>
                            <p><?= htmlspecialchars($blogError, ENT_QUOTES, 'UTF-8') ?></p>
                            <a href="blogs.php" class="gradient-btn btn-green-glossy">Back to Blogs</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <div class="blog-block animate fadeInRight wow" data-wow-duration="1500ms" data-wow-delay="200ms">
                        <div class="blog-serch-widget">
                            <form action="#">
                                <input type="search" placeholder="Search Here ... ">
                                <button type="submit"><img src="assets/images/svg/header/Search.svg"
                                        alt="icon"></button>
                            </form>
                        </div>
                    </div>
                    <div class="blog-block animate fadeInRight wow" data-wow-duration="1500ms" data-wow-delay="400ms">
                        <div class="category-widget">
                            <h4>Categories</h4>
                            <ul>
                                <li><a href="residential.php">Residential</a> </li>
                                <li><a href="commercial.php">Commercial</a> </li>
                                <li><a href="mortgage-services.php">Mortgage</a> </li>
                                <li><a href="investment.php">Investment</a> </li>
                                <li><a href="valuation-advisory.php">Valuation Advisory</a> </li>
                                <li><a href="research.php">Research</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="blog-block animate fadeInRight wow" data-wow-duration="1500ms" data-wow-delay="600ms">
                        <div class="recent-blog-widget">
                            <h4>Recent Post</h4>
                            <?php if (!$recentBlogs): ?>
                                <div class="recent-blog-widget-item">
                                    <div class="recent-blog-widget-item-title">
                                        <span></span>
                                        <a href="javascript:void(0)">No recent posts available.</a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php foreach ($recentBlogs as $recent): ?>
                                    <?php
                                    $recentId = (int)($recent['id'] ?? 0);
                                    $recentLink = $recentId > 0 ? 'blog-details.php?id=' . rawurlencode((string)$recentId) : 'javascript:void(0)';
                                    $recentImage = (string)($recent['image_path'] ?? '');
                                    if ($recentImage === '') {
                                        $recentImage = 'assets/images/blog/Blog-bg.jpg';
                                    }
                                    $recentHeading = (string)($recent['heading'] ?? '');
                                    $recentDate = format_recent_blog_date($recent['created_at'] ?? null);
                                    ?>
                                    <div class="recent-blog-widget-item">
                                        <img src="<?= htmlspecialchars($recentImage, ENT_QUOTES, 'UTF-8') ?>" alt="blog-image">
                                        <div class="recent-blog-widget-item-title">
                                            <span><?= htmlspecialchars($recentDate, ENT_QUOTES, 'UTF-8') ?></span>
                                            <a href="<?= htmlspecialchars($recentLink, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($recentHeading, ENT_QUOTES, 'UTF-8') ?></a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="blog-block animate fadeInRight wow" data-wow-duration="1500ms" data-wow-delay="800ms">
                        <div class="tag-widget">
                            <h4>Our Tags</h4>
                            <ul>
                                <li><a href="javascript:void(0)">Buying</a></li>
                                <li><a href="javascript:void(0)">Selling</a></li>
                                <li><a href="javascript:void(0)">Renting</a></li>
                                <li><a href="javascript:void(0)">Finance</a></li>
                                <li><a href="javascript:void(0)">Bank</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="blog-block cta-widget animate fadeInRight wow" data-wow-duration="1500ms"
                        data-wow-delay="1000ms">
                        <div class="bolg-cta-widget">
                            <h4>Request a Call Back</h4>
                            <p>Unlock exclusive opportunities in Dubai’s most coveted addresses. From curated listings to personalized advisory, we make your property journey seamless, secure, and rewarding.</p>
                            <a href="tel:+971 42554683" class="tel">+971 42554683</a>
                            <a href="contact.php" class="gradient-btn btn-green-glossy">Contact Us</a>
                        </div>
                    </div>
                    <div class="blog-block mb-0 animate fadeInRight wow" data-wow-duration="1500ms"
                        data-wow-delay="1200ms">
                        <div class="insta-post-widget">
                            <h4>Instagram Post</h4>
                            <div class="insta-post">
                                <a href="#" class="insta-image">
                                    <img src="assets/images/blog/tech-driven.webp" alt="insta-image">
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- blog end -->


<?php include 'includes/faq.php'; ?>
<?php include 'includes/footer.php'; ?>
<?php include 'includes/common-footer.php'; ?>
