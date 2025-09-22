<?php
$title = 'houzzhunt | Real Estate Insights & Trends';
$meta_tags = '
    

    <!-- Basic Meta -->
    <meta name="title" content="houzzhunt | Real Estate Insights & Trends ">
    <meta name="description" content="Stay informed with expert insights from houzzhunt. Explore real estate trends, market updates, and investment tips across UAE and global property markets.">
    <meta name="keywords" content="global real estate insights, real estate insights, commercial real estate insights, real estate investment insights, real estate industry insights, real estate market insights, best real estate blogs, real estate blog in dubai, dubai real estate news, real estate news, uae real estate news, dubai real estate news today, abu dhabi real estate news, latest dubai real estate news, dubai real estate market, abu dhabi real estate market, uae real estate market, residential real estate analysis, ajman real estate market, international real estate market, sharjah real estate market, top real estate companies in dubai, best real estate companies in dubai, real estate companies in abu dhabi, real estate companies in uae, real estate companies near me, real estate companies in sharjah, top 10 real estate companies in dubai, real estate companies in business bay, real estate company in business bay, list of real estate companies in dubai, best real estate companies in abu dhabi, real estate companies in ras al khaimah, houzzhunt, houzzhunt dubai, houzzhunt blogs">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="houzzhunt | Explore Properties, Real Estate Listings & Investment Opportunities">
    <meta property="og:description" content="Discover top residential and commercial properties, rent or buy your next dream home, and explore investment opportunities with houzzhunt – your reliable real estate portal.">
    <meta property="og:url" content="https://www.houzzhunt.com">
    
    
    <!-- Optional: replace with your actual image -->

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="houzzhunt | Explore Properties, Real Estate Listings & Investment Opportunities">
    <meta name="twitter:description" content="Discover top residential and commercial properties, rent or buy your next dream home, and explore investment opportunities with houzzhunt – your reliable real estate portal.">
    <meta name="twitter:image" content="https://www.houzzhunt.com/assets/images/meta-banner.jpg"> 

    <!-- Optional -->
';

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

function fetch_blog_count(PDO $pdo): int
{
    try {
        $statement = $pdo->query('SELECT COUNT(*) FROM blogs');
        $count     = $statement !== false ? (int)$statement->fetchColumn() : 0;

        return max(0, $count);
    } catch (Throwable $exception) {
        error_log('Failed to count blogs: ' . $exception->getMessage());
    }

    return 0;
}

function fetch_blogs_page(PDO $pdo, int $page, int $perPage): array
{
    $page    = max(1, $page);
    $perPage = max(1, $perPage);
    $offset  = ($page - 1) * $perPage;

    try {
        $statement = $pdo->prepare(
            'SELECT id, image_path, heading, short_description, author_name, category, created_at '
            . 'FROM blogs ORDER BY created_at DESC LIMIT :limit OFFSET :offset'
        );
        $statement->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();

        $blogs = $statement->fetchAll();

        return is_array($blogs) ? $blogs : [];
    } catch (Throwable $exception) {
        error_log('Failed to fetch paginated blogs: ' . $exception->getMessage());
    }

    return [];
}

function fetch_recent_blogs(PDO $pdo, int $limit = 3): array
{
    $limit = max(1, $limit);

    try {
        $statement = $pdo->prepare(
            'SELECT id, image_path, heading, created_at FROM blogs ORDER BY created_at DESC LIMIT :limit'
        );
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        $blogs = $statement->fetchAll();

        return is_array($blogs) ? $blogs : [];
    } catch (Throwable $exception) {
        error_log('Failed to fetch recent blogs: ' . $exception->getMessage());
    }

    return [];
}

function resolve_blog_image_path(?string $path, string $default): string
{
    $path = trim((string)$path);

    if ($path === '') {
        return $default;
    }

    if (preg_match('#^(?:https?:)?//#i', $path)) {
        return $path;
    }

    $normalized = ltrim($path, '/');
    if (strpos($normalized, './') === 0) {
        $normalized = substr($normalized, 2);
    }

    $uploadBase = 'admin/assets/uploads/';
    if (strpos($normalized, $uploadBase) !== 0) {
        $normalized = $uploadBase . $normalized;
    }

    return $normalized;
}

function build_blog_page_url(int $page): string
{
    $page = max(1, $page);
    $params = $_GET;

    if (!is_array($params)) {
        $params = [];
    }

    unset($params['page']);
    $params['page'] = $page;

    $queryString = http_build_query($params);

    return 'blogs.php' . ($queryString !== '' ? '?' . $queryString : '');
}

function format_blog_date_parts(?string $date): array
{
    if (!$date) {
        return ['', ''];
    }

    try {
        $dateTime = new DateTimeImmutable($date);
    } catch (Throwable $exception) {
        error_log('Failed to parse blog date: ' . $exception->getMessage());

        return ['', ''];
    }

    return [$dateTime->format('d'), $dateTime->format('F')];
}

function format_recent_blog_date(?string $date): string
{
    if (!$date) {
        return '';
    }

    try {
        $dateTime = new DateTimeImmutable($date);
    } catch (Throwable $exception) {
        error_log('Failed to parse recent blog date: ' . $exception->getMessage());

        return '';
    }

    return $dateTime->format('d F Y');
}

$blogsPerPage = 3;
$currentPage  = max(1, (int)($_GET['page'] ?? 1));
$blogs        = [];
$recentBlogs  = [];
$totalBlogs   = 0;
$totalPages   = 0;

$pdo = connect_blog_pdo();
if ($pdo) {
    $totalBlogs = fetch_blog_count($pdo);
    $totalPages = $totalBlogs > 0 ? (int)ceil($totalBlogs / $blogsPerPage) : 0;

    if ($totalPages > 0 && $currentPage > $totalPages) {
        $currentPage = $totalPages;
    }

    if ($totalBlogs > 0) {
        $blogs = fetch_blogs_page($pdo, $currentPage, $blogsPerPage);
    }

    $recentBlogs = fetch_recent_blogs($pdo, 3);
}

// Include header and navbar
include 'includes/common-header.php';
include 'includes/navbar.php';
?>

<!-- page header start -->
<div class="page-header-section" style="background-image: url(assets/images/banner/investmemt-banner.webp);">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="page-header-heading animate fadeInLeft wow" data-wow-duration="2000ms">
                    <h2>Blogs and Insights</h2>
                    <p class="lead">Explore expert insights, market trends, and curated advice to guide every step of your property journey.</p>
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
                <span>Blog</span>
            </li>
        </ul>
    </div>
</div>
<!-- page header end -->


<!-- blog start -->
<div class="blog-single-section">
    <div class="container">
        <div class="row gutter-y-40">

            <div class="col-lg-8">
                <?php if (!$blogs): ?>
                    <div class="blog-list-box animate fadeInLeft wow" data-wow-duration="1500ms" data-wow-delay="200ms">
                        <div class="blog-single-details">
                            <h4>Stay tuned!</h4>
                            <p>Our insights team is preparing new stories. Please check back soon for the latest updates.</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($blogs as $index => $blog): ?>
                        <?php
                        $blogId           = (int)($blog['id'] ?? 0);
                        $imagePath        = resolve_blog_image_path($blog['image_path'] ?? '', 'assets/images/blog/Blog-bg.jpg');
                        $heading          = (string)($blog['heading'] ?? '');
                        $shortDescription = (string)($blog['short_description'] ?? '');
                        $authorName       = (string)($blog['author_name'] ?? 'houzzhunt');
                        $category         = trim((string)($blog['category'] ?? ''));
                        $createdAt        = $blog['created_at'] ?? null;

                        [$day, $month] = format_blog_date_parts($createdAt);

                        $blogLink = $blogId > 0 ? 'blog-details.php?id=' . rawurlencode((string)$blogId) : 'javascript:void(0)';
                        $delay    = 200 + ($index * 200);
                        ?>
                        <div class="blog-list-box animate fadeInLeft wow" data-wow-duration="1500ms" data-wow-delay="<?= htmlspecialchars((string)$delay, ENT_QUOTES, 'UTF-8') ?>ms">
                            <div class="blog-single-image">
                                <a href="<?= htmlspecialchars($blogLink, ENT_QUOTES, 'UTF-8') ?>"><img src="<?= htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') ?>" alt="blog-image"></a>
                                <a href="<?= htmlspecialchars($blogLink, ENT_QUOTES, 'UTF-8') ?>" class="d-none">
                                    <p><?= htmlspecialchars($day, ENT_QUOTES, 'UTF-8') ?></p><span><?= htmlspecialchars($month, ENT_QUOTES, 'UTF-8') ?></span>
                                </a>
                            </div>
                            <div class="blog-single-meta">
                                <ul>
                                    <li><span>by </span><a href="<?= htmlspecialchars($blogLink, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($authorName, ENT_QUOTES, 'UTF-8') ?></a></li>
                                    <?php if ($category !== ''): ?>
                                        <li>|</li>
                                        <li><a href="<?= htmlspecialchars($blogLink, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="blog-single-details">
                                <h4><a href="<?= htmlspecialchars($blogLink, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?></a></h4>
                                <p><?= nl2br(htmlspecialchars($shortDescription, ENT_QUOTES, 'UTF-8')) ?></p>

                                <a href="<?= htmlspecialchars($blogLink, ENT_QUOTES, 'UTF-8') ?>" class="gradient-btn btn-green-glossy">Read More</a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php if ($totalPages > 1): ?>
                        <nav class="blog-pagination animate fadeInLeft wow" data-wow-duration="1500ms"
                            data-wow-delay="<?= htmlspecialchars((string)(200 + (count($blogs) * 200)), ENT_QUOTES, 'UTF-8') ?>ms"
                            aria-label="Blog navigation">
                            <ul class="pagination">
                                <?php if ($currentPage > 1): ?>
                                    <li class="page-item prev">
                                        <a class="page-link" href="<?= htmlspecialchars(build_blog_page_url($currentPage - 1), ENT_QUOTES, 'UTF-8') ?>"
                                            aria-label="Previous page">
                                            &laquo; Previous
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                                    <li class="page-item<?= $page === $currentPage ? ' active' : '' ?>">
                                        <?php if ($page === $currentPage): ?>
                                            <span class="page-link" aria-current="page"><?= htmlspecialchars((string)$page, ENT_QUOTES, 'UTF-8') ?></span>
                                        <?php else: ?>
                                            <a class="page-link" href="<?= htmlspecialchars(build_blog_page_url($page), ENT_QUOTES, 'UTF-8') ?>">
                                                <?= htmlspecialchars((string)$page, ENT_QUOTES, 'UTF-8') ?>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($currentPage < $totalPages): ?>
                                    <li class="page-item next">
                                        <a class="page-link" href="<?= htmlspecialchars(build_blog_page_url($currentPage + 1), ENT_QUOTES, 'UTF-8') ?>"
                                            aria-label="Next page">
                                            Next &raquo;
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
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
                                    $recentImage = resolve_blog_image_path($recent['image_path'] ?? '', 'assets/images/blog/Blog-bg.jpg');
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

<?php include 'includes/footer.php'; ?>
<?php include 'includes/common-footer.php'; ?>