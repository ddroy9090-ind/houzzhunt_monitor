<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/render.php';
require_once __DIR__ . '/includes/auth.php';

process_logout();

if (!is_authenticated()) {
  header('Location: login.php');
  exit;
}

$errors = [];
$successMessage = null;

if (isset($_SESSION['add_property_success'])) {
  $successMessage = is_string($_SESSION['add_property_success'])
    ? $_SESSION['add_property_success']
    : null;
  unset($_SESSION['add_property_success']);
}

$formData = [
  'project_status'                 => '',
  'property_type'                  => '',
  'project_name'                   => '',
  'property_title'                 => '',
  'property_location'              => '',
  'starting_price'                 => '',
  'bedroom'                        => '',
  'bathroom'                       => '',
  'parking'                        => '',
  'total_area'                     => '',
  'completion_date'                => '',
  'about_project'                  => '',
  'developer_name'                 => '',
  'developer_established'          => '',
  'about_developer'                => '',
  'completed_projects'             => '',
  'international_awards'           => '',
  'on_time_delivery'               => '',
  'video_link'                     => '',
  'location_map'                   => '',
  'landmark_name'                  => '',
  'distance_time'                  => '',
  'category'                       => '',
  'roi_potential'                  => '',
  'capital_growth'                 => '',
  'occupancy_rate'                 => '',
  'resale_value'                   => '',
  'booking_percentage'             => '',
  'booking_amount'                 => '',
  'during_construction_percentage' => '',
  'during_construction_amount'     => '',
  'handover_percentage'            => '',
  'handover_amount'                => '',
  'permit_no'                      => '',
];

$floorPlanFormData = [
  [
    'title' => '',
    'area'  => '',
    'price' => '',
  ],
];

$locationAccessibilityFormData = [
  [
    'landmark_name' => '',
    'distance_time' => '',
    'category'      => '',
  ],
];

$amenitiesOptions = [
  'infinity_pool'            => 'Infinity Pool',
  'fully_equipped_gym'       => 'Fully Equipped Gym',
  'landscaped_gardens'       => 'Landscaped Gardens',
  'kids_play_area'           => "Kids' Play Area",
  'bbq_area'                 => 'BBQ & Picnic Area',
  'concierge_services'       => 'Concierge Services',
  'twenty_four_security'     => '24/7 Security',
  'retail_outlets'           => 'Retail & Dining Outlets',
  'covered_parking'          => 'Covered Parking',
  'smart_home_technology'    => 'Smart Home Technology',
];

$selectedAmenityKeys = [];
$selectedAmenities     = [];

/**
 * Ensure the properties_list table exists with the expected structure.
 */
function add_property_ensure_table(PDO $pdo): void
{
  $pdo->exec(
    'CREATE TABLE IF NOT EXISTS properties_list (
      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      hero_banner VARCHAR(255) DEFAULT NULL,
      brochure VARCHAR(255) DEFAULT NULL,
      gallery_images LONGTEXT NULL,
      developer_logo VARCHAR(255) DEFAULT NULL,
      permit_barcode VARCHAR(255) DEFAULT NULL,
      project_status VARCHAR(255) DEFAULT NULL,
      property_type VARCHAR(100) DEFAULT NULL,
      project_name VARCHAR(255) DEFAULT NULL,
      property_title VARCHAR(255) DEFAULT NULL,
      property_location VARCHAR(255) DEFAULT NULL,
      starting_price VARCHAR(255) DEFAULT NULL,
      bedroom VARCHAR(255) DEFAULT NULL,
      bathroom VARCHAR(255) DEFAULT NULL,
      parking VARCHAR(255) DEFAULT NULL,
      total_area VARCHAR(255) DEFAULT NULL,
      completion_date DATE DEFAULT NULL,
      about_project LONGTEXT NULL,
      developer_name VARCHAR(255) DEFAULT NULL,
      developer_established VARCHAR(255) DEFAULT NULL,
      about_developer LONGTEXT NULL,
      completed_projects VARCHAR(255) DEFAULT NULL,
      international_awards VARCHAR(255) DEFAULT NULL,
      on_time_delivery VARCHAR(255) DEFAULT NULL,
      floor_plans LONGTEXT NULL,
      amenities LONGTEXT NULL,
      video_link VARCHAR(255) DEFAULT NULL,
      location_map VARCHAR(255) DEFAULT NULL,
      landmark_name VARCHAR(255) DEFAULT NULL,
      distance_time VARCHAR(255) DEFAULT NULL,
      category VARCHAR(255) DEFAULT NULL,
      location_accessibility LONGTEXT NULL,
      roi_potential VARCHAR(255) DEFAULT NULL,
      capital_growth VARCHAR(255) DEFAULT NULL,
      occupancy_rate VARCHAR(255) DEFAULT NULL,
      resale_value VARCHAR(255) DEFAULT NULL,
      booking_percentage VARCHAR(255) DEFAULT NULL,
      booking_amount VARCHAR(255) DEFAULT NULL,
      during_construction_percentage VARCHAR(255) DEFAULT NULL,
      during_construction_amount VARCHAR(255) DEFAULT NULL,
      handover_percentage VARCHAR(255) DEFAULT NULL,
      handover_amount VARCHAR(255) DEFAULT NULL,
      permit_no VARCHAR(255) DEFAULT NULL,
      created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
  );

  try {
    $columnCheck = $pdo->query("SHOW COLUMNS FROM properties_list LIKE 'location_accessibility'");

    if ($columnCheck instanceof PDOStatement && $columnCheck->rowCount() === 0) {
      $pdo->exec("ALTER TABLE properties_list ADD location_accessibility LONGTEXT NULL AFTER category");
    }
  } catch (Throwable $e) {
    error_log('Failed to ensure location_accessibility column: ' . $e->getMessage());
  }

  try {
    $columnCheck = $pdo->query("SHOW COLUMNS FROM properties_list LIKE 'project_name'");

    if ($columnCheck instanceof PDOStatement && $columnCheck->rowCount() === 0) {
      $pdo->exec("ALTER TABLE properties_list ADD project_name VARCHAR(255) NULL AFTER property_type");
    }
  } catch (Throwable $e) {
    error_log('Failed to ensure project_name column: ' . $e->getMessage());
  }

  try {
    $columnCheck = $pdo->query("SHOW COLUMNS FROM properties_list LIKE 'amenities'");

    if ($columnCheck instanceof PDOStatement && $columnCheck->rowCount() === 0) {
      $pdo->exec("ALTER TABLE properties_list ADD amenities LONGTEXT NULL AFTER floor_plans");
    }
  } catch (Throwable $e) {
    error_log('Failed to ensure amenities column: ' . $e->getMessage());
  }
}

/**
 * Handle a single file upload and return the stored relative path or an error message.
 *
 * @return array{0: ?string, 1: ?string}
 */
function add_property_handle_upload(?array $file, array $allowedMimeMap, string $uploadDir, string $prefix): array
{
  if (!$file || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
    return [null, null];
  }

  $error = (int)($file['error'] ?? UPLOAD_ERR_OK);

  if ($error !== UPLOAD_ERR_OK) {
    return [null, 'There was a problem uploading the file.'];
  }

  $tmpName = (string)($file['tmp_name'] ?? '');

  if ($tmpName === '' || !is_uploaded_file($tmpName)) {
    return [null, 'Invalid file upload received.'];
  }

  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mime  = $finfo ? finfo_file($finfo, $tmpName) : null;
  if ($finfo) {
    finfo_close($finfo);
  }

  $extension = null;

  if ($mime && isset($allowedMimeMap[$mime])) {
    $extension = $allowedMimeMap[$mime];
  } else {
    $originalExtension = strtolower((string)pathinfo((string)($file['name'] ?? ''), PATHINFO_EXTENSION));
    if ($originalExtension !== '' && in_array($originalExtension, array_values($allowedMimeMap), true)) {
      $extension = $originalExtension;
    }
  }

  if (!$extension) {
    return [null, 'Unsupported file type uploaded.'];
  }

  if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
      return [null, 'Unable to create the upload directory.'];
    }
  }

  $filename     = $prefix . bin2hex(random_bytes(16)) . '.' . $extension;
  $destination  = rtrim($uploadDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $filename;
  $relativePath = 'assets/uploads/properties/' . $filename;

  if (!move_uploaded_file($tmpName, $destination)) {
    return [null, 'Failed to save the uploaded file.'];
  }

  return [$relativePath, null];
}

try {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check($_POST['csrf'] ?? '');
    rl_hit('add-property', 20);

    foreach ($formData as $key => $_) {
      $formData[$key] = trim((string)($_POST[$key] ?? ''));
    }

    $amenitiesInput = $_POST['amenities'] ?? [];
    if (!is_array($amenitiesInput)) {
      $amenitiesInput = [];
    }

    foreach ($amenitiesOptions as $amenityKey => $amenityLabel) {
      if (in_array($amenityKey, $amenitiesInput, true)) {
        $selectedAmenityKeys[] = $amenityKey;
        $selectedAmenities[]   = $amenityLabel;
      }
    }

    $titles = $_POST['floor_plan_title'] ?? [];
    $areas  = $_POST['floor_plan_area'] ?? [];
    $prices = $_POST['floor_plan_price'] ?? [];
    $locationLandmarks = $_POST['location_landmark'] ?? [];
    $locationDistances = $_POST['location_distance'] ?? [];
    $locationCategories = $_POST['location_category'] ?? [];

    if (!is_array($titles)) {
      $titles = [];
    }
    if (!is_array($areas)) {
      $areas = [];
    }
    if (!is_array($prices)) {
      $prices = [];
    }
    if (!is_array($locationLandmarks)) {
      $locationLandmarks = [];
    }
    if (!is_array($locationDistances)) {
      $locationDistances = [];
    }
    if (!is_array($locationCategories)) {
      $locationCategories = [];
    }

    $maxFloorPlans       = max(count($titles), count($areas), count($prices), 1);
    $floorPlanFormData   = [];
    $floorPlansForInsert = [];
    $maxLocations                 = max(count($locationLandmarks), count($locationDistances), count($locationCategories), 1);
    $locationAccessibilityFormData = [];
    $locationAccessibilityForInsert = [];

    $pdo = db();
    add_property_ensure_table($pdo);

    $uploadDir             = __DIR__ . '/assets/uploads/properties';
    $uploadedFilesToCleanup = [];

    $imageMimeMap = [
      'image/jpeg'  => 'jpg',
      'image/pjpeg' => 'jpg',
      'image/png'   => 'png',
      'image/x-png' => 'png',
      'image/gif'   => 'gif',
      'image/webp'  => 'webp',
      'image/svg+xml' => 'svg',
    ];

    $pdfMimeMap = [
      'application/pdf' => 'pdf',
    ];

    [$heroBannerPath, $heroBannerError] = add_property_handle_upload($_FILES['hero_banner'] ?? null, $imageMimeMap, $uploadDir, 'hero_banner_');
    if ($heroBannerError) {
      $errors[] = $heroBannerError;
    } elseif ($heroBannerPath) {
      $uploadedFilesToCleanup[] = $heroBannerPath;
    }

    [$brochurePath, $brochureError] = add_property_handle_upload($_FILES['brochure'] ?? null, $pdfMimeMap, $uploadDir, 'brochure_');
    if ($brochureError) {
      $errors[] = $brochureError;
    } elseif ($brochurePath) {
      $uploadedFilesToCleanup[] = $brochurePath;
    }

    [$developerLogoPath, $developerLogoError] = add_property_handle_upload($_FILES['developer_logo'] ?? null, $imageMimeMap, $uploadDir, 'developer_logo_');
    if ($developerLogoError) {
      $errors[] = $developerLogoError;
    } elseif ($developerLogoPath) {
      $uploadedFilesToCleanup[] = $developerLogoPath;
    }

    [$permitBarcodePath, $permitBarcodeError] = add_property_handle_upload($_FILES['permit_barcode'] ?? null, $imageMimeMap, $uploadDir, 'permit_barcode_');
    if ($permitBarcodeError) {
      $errors[] = $permitBarcodeError;
    } elseif ($permitBarcodePath) {
      $uploadedFilesToCleanup[] = $permitBarcodePath;
    }

    $galleryPaths = [];
    $galleryFiles = $_FILES['gallery_images'] ?? null;
    if ($galleryFiles && isset($galleryFiles['name']) && is_array($galleryFiles['name'])) {
      $countGallery = count($galleryFiles['name']);
      for ($i = 0; $i < $countGallery; $i++) {
        $file = [
          'name'     => $galleryFiles['name'][$i] ?? null,
          'type'     => $galleryFiles['type'][$i] ?? null,
          'tmp_name' => $galleryFiles['tmp_name'][$i] ?? null,
          'error'    => $galleryFiles['error'][$i] ?? UPLOAD_ERR_NO_FILE,
          'size'     => $galleryFiles['size'][$i] ?? 0,
        ];

        [$path, $error] = add_property_handle_upload($file, $imageMimeMap, $uploadDir, 'gallery_');
        if ($error) {
          $errors[] = $error;
        } elseif ($path) {
          $galleryPaths[]            = $path;
          $uploadedFilesToCleanup[] = $path;
        }
      }
    }

    $floorPlanFiles = $_FILES['floor_plan_file'] ?? null;

    for ($i = 0; $i < $maxFloorPlans; $i++) {
      $title = trim((string)($titles[$i] ?? ''));
      $area  = trim((string)($areas[$i] ?? ''));
      $price = trim((string)($prices[$i] ?? ''));

      $floorPlanFormData[] = [
        'title' => $title,
        'area'  => $area,
        'price' => $price,
      ];

      $fileForIndex = null;
      if ($floorPlanFiles && isset($floorPlanFiles['name']) && is_array($floorPlanFiles['name']) && array_key_exists($i, $floorPlanFiles['name'])) {
        $fileForIndex = [
          'name'     => $floorPlanFiles['name'][$i] ?? null,
          'type'     => $floorPlanFiles['type'][$i] ?? null,
          'tmp_name' => $floorPlanFiles['tmp_name'][$i] ?? null,
          'error'    => $floorPlanFiles['error'][$i] ?? UPLOAD_ERR_NO_FILE,
          'size'     => $floorPlanFiles['size'][$i] ?? 0,
        ];
      }

      $floorPlanPath = null;
      if ($fileForIndex) {
        [$floorPlanPath, $floorPlanError] = add_property_handle_upload($fileForIndex, $imageMimeMap + $pdfMimeMap, $uploadDir, 'floor_plan_');
        if ($floorPlanError) {
          $errors[] = $floorPlanError;
        } elseif ($floorPlanPath) {
          $uploadedFilesToCleanup[] = $floorPlanPath;
        }
      }

      if ($title !== '' || $area !== '' || $price !== '' || $floorPlanPath !== null) {
        $floorPlansForInsert[] = [
          'title' => $title,
          'area'  => $area,
          'price' => $price,
          'file'  => $floorPlanPath,
        ];
      }
    }

    if (empty($floorPlanFormData)) {
      $floorPlanFormData[] = [
        'title' => '',
        'area'  => '',
        'price' => '',
      ];
    }

    for ($i = 0; $i < $maxLocations; $i++) {
      $landmark = trim((string)($locationLandmarks[$i] ?? ''));
      $distance = trim((string)($locationDistances[$i] ?? ''));
      $category = trim((string)($locationCategories[$i] ?? ''));

      $locationAccessibilityFormData[] = [
        'landmark_name' => $landmark,
        'distance_time' => $distance,
        'category'      => $category,
      ];

      if ($landmark !== '' || $distance !== '' || $category !== '') {
        $locationAccessibilityForInsert[] = [
          'landmark_name' => $landmark,
          'distance_time' => $distance,
          'category'      => $category,
        ];
      }
    }

    if (empty($locationAccessibilityFormData)) {
      $locationAccessibilityFormData[] = [
        'landmark_name' => '',
        'distance_time' => '',
        'category'      => '',
      ];
    }

    $firstLocationAccessibility = $locationAccessibilityFormData[0];
    $formData['landmark_name']   = $firstLocationAccessibility['landmark_name'] ?? '';
    $formData['distance_time']   = $firstLocationAccessibility['distance_time'] ?? '';
    $formData['category']        = $firstLocationAccessibility['category'] ?? '';

    $locationAccessibilityJson = $locationAccessibilityForInsert
      ? json_encode($locationAccessibilityForInsert, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
      : null;

    $amenitiesJson = $selectedAmenities
      ? json_encode($selectedAmenities, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
      : null;

    if (empty($errors)) {
      $completionDate = $formData['completion_date'] !== '' ? $formData['completion_date'] : null;

      $stmt = $pdo->prepare(
        'INSERT INTO properties_list (
          hero_banner,
          brochure,
          gallery_images,
          developer_logo,
          permit_barcode,
          project_status,
          property_type,
          project_name,
          property_title,
          property_location,
          starting_price,
          bedroom,
          bathroom,
          parking,
          total_area,
          completion_date,
          about_project,
          developer_name,
          developer_established,
          about_developer,
          completed_projects,
          international_awards,
          on_time_delivery,
          floor_plans,
          amenities,
          video_link,
          location_map,
          landmark_name,
          distance_time,
          category,
          location_accessibility,
          roi_potential,
          capital_growth,
          occupancy_rate,
          resale_value,
          booking_percentage,
          booking_amount,
          during_construction_percentage,
          during_construction_amount,
          handover_percentage,
          handover_amount,
          permit_no
        ) VALUES (
          :hero_banner,
          :brochure,
          :gallery_images,
          :developer_logo,
          :permit_barcode,
          :project_status,
          :property_type,
          :project_name,
          :property_title,
          :property_location,
          :starting_price,
          :bedroom,
          :bathroom,
          :parking,
          :total_area,
          :completion_date,
          :about_project,
          :developer_name,
          :developer_established,
          :about_developer,
          :completed_projects,
          :international_awards,
          :on_time_delivery,
          :floor_plans,
          :amenities,
          :video_link,
          :location_map,
          :landmark_name,
          :distance_time,
          :category,
          :location_accessibility,
          :roi_potential,
          :capital_growth,
          :occupancy_rate,
          :resale_value,
          :booking_percentage,
          :booking_amount,
          :during_construction_percentage,
          :during_construction_amount,
          :handover_percentage,
          :handover_amount,
          :permit_no
        )'
      );

      $stmt->execute([
        ':hero_banner'                   => $heroBannerPath,
        ':brochure'                      => $brochurePath,
        ':gallery_images'                => json_encode($galleryPaths, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        ':developer_logo'                => $developerLogoPath,
        ':permit_barcode'                => $permitBarcodePath,
        ':project_status'                => $formData['project_status'],
        ':property_type'                 => $formData['property_type'],
        ':project_name'                  => $formData['project_name'],
        ':property_title'                => $formData['property_title'],
        ':property_location'             => $formData['property_location'],
        ':starting_price'                => $formData['starting_price'],
        ':bedroom'                       => $formData['bedroom'],
        ':bathroom'                      => $formData['bathroom'],
        ':parking'                       => $formData['parking'],
        ':total_area'                    => $formData['total_area'],
        ':completion_date'               => $completionDate,
        ':about_project'                 => $formData['about_project'],
        ':developer_name'                => $formData['developer_name'],
        ':developer_established'         => $formData['developer_established'],
        ':about_developer'               => $formData['about_developer'],
        ':completed_projects'            => $formData['completed_projects'],
        ':international_awards'          => $formData['international_awards'],
        ':on_time_delivery'              => $formData['on_time_delivery'],
        ':floor_plans'                   => json_encode($floorPlansForInsert, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        ':amenities'                     => $amenitiesJson,
        ':video_link'                    => $formData['video_link'],
        ':location_map'                  => $formData['location_map'],
        ':landmark_name'                 => $formData['landmark_name'],
        ':distance_time'                 => $formData['distance_time'],
        ':category'                      => $formData['category'],
        ':location_accessibility'        => $locationAccessibilityJson,
        ':roi_potential'                 => $formData['roi_potential'],
        ':capital_growth'                => $formData['capital_growth'],
        ':occupancy_rate'                => $formData['occupancy_rate'],
        ':resale_value'                  => $formData['resale_value'],
        ':booking_percentage'            => $formData['booking_percentage'],
        ':booking_amount'                => $formData['booking_amount'],
        ':during_construction_percentage'=> $formData['during_construction_percentage'],
        ':during_construction_amount'    => $formData['during_construction_amount'],
        ':handover_percentage'           => $formData['handover_percentage'],
        ':handover_amount'               => $formData['handover_amount'],
        ':permit_no'                     => $formData['permit_no'],
      ]);

      $_SESSION['add_property_success'] = 'Your Property Has Been Added Successfully';
      $uploadedFilesToCleanup = [];

      header('Location: add_property.php');
      exit;
    }

    if (!empty($errors) && $uploadedFilesToCleanup) {
      foreach ($uploadedFilesToCleanup as $relativePath) {
        $absolute = __DIR__ . '/' . ltrim($relativePath, '/');
        if (is_file($absolute)) {
          @unlink($absolute);
        }
      }
    }
  }
} catch (Throwable $e) {
  $errors[] = 'An unexpected error occurred while saving the property. Please try again.';
  error_log('Failed to add property: ' . $e->getMessage());
}

$pageTitle = 'Add Property';
$pageDescription = 'Create a new property listing by sharing project details, media, and investment highlights.';

render_head($pageTitle);
echo '<div class="container-fluid layout">';
echo '<div class="row g-0">';
render_sidebar('add-property');
?>
<main class="col-12 col-md-9 col-lg-10 content">
  <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
    <div>
      <h2 class="title-heading"><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></h2>
      <p class="para mb-0"><?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?></p>
    </div>
  </div>

  <div class="box">
    <?php if ($successMessage): ?>
      <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" data-success-alert data-auto-dismiss="5000">
        <?= htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <?php if ($errors): ?>
      <div class="alert alert-danger mb-4" role="alert">
        <p class="mb-2 fw-semibold">Please address the following issues:</p>
        <ul class="mb-0">
          <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="row g-4">
      <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">

      <div class="col-12">
        <section class="form-section">
          <div class="section-header">
            <h4 class="section-title">
              <img src="assets/images/file.png" alt="Media uploads icon" class="section-title-icon">
              <span>Media Uploads</span>
            </h4>
            <p class="section-subtitle">Upload the marketing assets that will showcase this project.</p>
          </div>
          <div class="row g-4">
            <div class="col-lg-4">
              <label for="hero_banner" class="form-label">Upload Project Hero Banner</label>
              <div class="upload-box">
                <input
                  type="file"
                  class="form-control file-input"
                  id="hero_banner"
                  name="hero_banner"
                  accept="image/*">
                <div class="upload-content">
                  <img src="assets/images/file.png" alt="Upload Icon" width="30px">
                  <p>Drop files here or click to upload</p>
                  <p class="upload-file-name text-muted"></p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <label for="brochure" class="form-label">Upload Brochure</label>
              <div class="upload-box">
                <input
                  type="file"
                  class="form-control file-input"
                  id="brochure"
                  name="brochure"
                  accept="application/pdf">
                <div class="upload-content">
                  <img src="assets/images/file.png" alt="Upload Icon" width="30px">
                  <p>Drop files here or click to upload</p>
                  <p class="upload-file-name text-muted"></p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <label for="gallery_images" class="form-label">Upload Gallery Images (Multiple)</label>
              <div class="upload-box">
                <input
                  type="file"
                  class="form-control file-input"
                  id="gallery_images"
                  name="gallery_images[]"
                  accept="image/*"
                  multiple>
                <div class="upload-content">
                  <img src="assets/images/file.png" alt="Upload Icon" width="30px">
                  <p>Drop files here or click to upload</p>
                  <p class="upload-file-name text-muted"></p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <label for="developer_logo" class="form-label">Upload Developer Logo</label>
              <div class="upload-box">
                <input
                  type="file"
                  class="form-control file-input"
                  id="developer_logo"
                  name="developer_logo"
                  accept="image/*">
                <div class="upload-content">
                  <img src="assets/images/file.png" alt="Upload Icon" width="30px">
                  <p>Drop files here or click to upload</p>
                  <p class="upload-file-name text-muted"></p>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <label for="permit_barcode" class="form-label">Upload Permit Barcode</label>
              <div class="upload-box">
                <input
                  type="file"
                  class="form-control file-input"
                  id="permit_barcode"
                  name="permit_barcode"
                  accept="image/*">
                <div class="upload-content">
                  <img src="assets/images/file.png" alt="Upload Icon" width="30px">
                  <p>Drop files here or click to upload</p>
                  <p class="upload-file-name text-muted"></p>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <div class="col-12">
        <section class="form-section">
          <div class="section-header">
            <h4 class="section-title">
              <img src="assets/images/icon-project-details.svg" alt="Project details icon" class="section-title-icon">
              <span>Project Details</span>
            </h4>
            <p class="section-subtitle">Capture essential project details to help clients evaluate the opportunity.</p>
          </div>
          <div class="row g-4">
            <div class="col-md-4">
              <label for="project_status" class="form-label">Project Status</label>
              <input
                type="text"
                class="form-control"
                id="project_status"
                name="project_status"
                placeholder="e.g., Off-plan"
                value="<?= htmlspecialchars($formData['project_status'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="property_type" class="form-label">Property Type</label>
              <select class="form-select form-control" id="property_type" name="property_type">
                <option value="" disabled <?= $formData['property_type'] === '' ? 'selected' : '' ?>>Select property type</option>
                <option value="Apartment" <?= $formData['property_type'] === 'Apartment' ? 'selected' : '' ?>>Apartment</option>
                <option value="Villa" <?= $formData['property_type'] === 'Villa' ? 'selected' : '' ?>>Villa</option>
                <option value="Townhouse" <?= $formData['property_type'] === 'Townhouse' ? 'selected' : '' ?>>Townhouse</option>
                <option value="Penthouse" <?= $formData['property_type'] === 'Penthouse' ? 'selected' : '' ?>>Penthouse</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="property_title" class="form-label">Property Title</label>
              <input
                type="text"
                class="form-control"
                id="property_title"
                name="property_title"
                placeholder="Project name"
                value="<?= htmlspecialchars($formData['property_title'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="project_name" class="form-label">Project Name</label>
              <input
                type="text"
                class="form-control"
                id="project_name"
                name="project_name"
                placeholder="e.g., Bluewaters Residences"
                value="<?= htmlspecialchars($formData['project_name'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="property_location" class="form-label">Property Location</label>
              <input
                type="text"
                class="form-control"
                id="property_location"
                name="property_location"
                placeholder="City, Community"
                value="<?= htmlspecialchars($formData['property_location'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="starting_price" class="form-label">Starting From (Price AED)</label>
              <input
                type="text"
                class="form-control"
                id="starting_price"
                name="starting_price"
                min="0"
                step="1000"
                placeholder="AED"
                value="<?= htmlspecialchars($formData['starting_price'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="bedroom" class="form-label">Bedroom</label>
              <input
                type="text"
                class="form-control"
                id="bedroom"
                name="bedroom"
                placeholder="e.g., 1 - 4"
                value="<?= htmlspecialchars($formData['bedroom'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="bathroom" class="form-label">Bathroom</label>
              <input
                type="text"
                class="form-control"
                id="bathroom"
                name="bathroom"
                placeholder="e.g., 1 - 3"
                value="<?= htmlspecialchars($formData['bathroom'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="parking" class="form-label">Parking</label>
              <input
                type="text"
                class="form-control"
                id="parking"
                name="parking"
                placeholder="e.g., 1 Allocated"
                value="<?= htmlspecialchars($formData['parking'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="total_area" class="form-label">Total Area</label>
              <input
                type="text"
                class="form-control"
                id="total_area"
                name="total_area"
                placeholder="e.g., 1,200 sq.ft"
                value="<?= htmlspecialchars($formData['total_area'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="completion_date" class="form-label">Completion Date</label>
              <input
                type="date"
                class="form-control"
                id="completion_date"
                name="completion_date"
                value="<?= htmlspecialchars($formData['completion_date'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-12">
              <label for="about_project" class="form-label">About Project (Overview In Rich Text Editor)</label>
              <textarea class="form-control" id="about_project" name="about_project" rows="6" placeholder="Enter an engaging project overview..."><?= htmlspecialchars($formData['about_project'], ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
          </div>
        </section>
      </div>

      <div class="col-12">
        <section class="form-section">
          <div class="section-header">
            <h4 class="section-title">
              <img src="assets/images/icons/community.svg" alt="Amenities icon" class="section-title-icon">
              <span>Key Features &amp; Amenities</span>
            </h4>
            <p class="section-subtitle">Select the standout amenities that define this project.</p>
          </div>
          <div class="row g-3">
            <?php foreach ($amenitiesOptions as $amenityKey => $amenityLabel): ?>
              <div class="col-sm-6 col-lg-4">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="amenity_<?= htmlspecialchars($amenityKey, ENT_QUOTES, 'UTF-8') ?>"
                    name="amenities[]"
                    value="<?= htmlspecialchars($amenityKey, ENT_QUOTES, 'UTF-8') ?>"
                    <?= in_array($amenityKey, $selectedAmenityKeys, true) ? 'checked' : '' ?>>
                  <label class="form-check-label" for="amenity_<?= htmlspecialchars($amenityKey, ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($amenityLabel, ENT_QUOTES, 'UTF-8') ?>
                  </label>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </section>
      </div>

      <div class="col-12">
        <section class="form-section">
          <div class="section-header">
            <h4 class="section-title">
              <img src="../assets/flaticons/residential.png" alt="Developer information icon" class="section-title-icon">
              <span>Developer Information</span>
            </h4>
            <p class="section-subtitle">Share the developer's credentials and proven track record.</p>
          </div>
          <div class="row g-4">
            <div class="col-md-6">
              <label for="developer_name" class="form-label">Developer Name</label>
              <input
                type="text"
                class="form-control"
                id="developer_name"
                name="developer_name"
                placeholder="Developer name"
                value="<?= htmlspecialchars($formData['developer_name'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-6">
              <label for="developer_established" class="form-label">Established</label>
              <input
                type="text"
                class="form-control"
                id="developer_established"
                name="developer_established"
                placeholder="Year established"
                value="<?= htmlspecialchars($formData['developer_established'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-12">
              <label for="about_developer" class="form-label">About Developer</label>
              <textarea class="form-control" id="about_developer" name="about_developer" rows="4" placeholder="Highlight the developer's experience and vision..."><?= htmlspecialchars($formData['about_developer'], ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
            <div class="col-md-4">
              <label for="completed_projects" class="form-label">Completed Projects</label>
              <input
                type="text"
                class="form-control"
                id="completed_projects"
                name="completed_projects"
                min="0"
                step="1"
                placeholder="Number of projects"
                value="<?= htmlspecialchars($formData['completed_projects'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="international_awards" class="form-label">International Awards</label>
              <input
                type="text"
                class="form-control"
                id="international_awards"
                name="international_awards"
                placeholder="List or count awards"
                value="<?= htmlspecialchars($formData['international_awards'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="on_time_delivery" class="form-label">On-Time Delivery</label>
              <input
                type="text"
                class="form-control"
                id="on_time_delivery"
                name="on_time_delivery"
                placeholder="e.g., 95%"
                value="<?= htmlspecialchars($formData['on_time_delivery'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
          </div>
        </section>
      </div>

      <div class="col-12">
        <section class="form-section">
          <div class="section-header">
            <h4 class="section-title">
              <img src="../assets/icons/floorplan.png" alt="Floor plan icon" class="section-title-icon">
              <span>Floor Plans</span>
            </h4>
            <p class="section-subtitle">Upload floor plans with their key details.</p>
          </div>
          <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" id="add-floor-plan">Add Floor Plan</button>
          </div>
          <div class="floor-plan-list" data-floor-plan-list>
            <?php foreach ($floorPlanFormData as $index => $plan): ?>
              <div class="floor-plan-item border rounded p-3 mb-3" data-floor-plan-index="<?= (int)$index ?>">
                <div class="row g-4 align-items-end">
                  <div class="col-lg-12">
                    <label for="floor_plan_file_<?= (int)$index ?>" class="form-label" data-floor-plan-label="file">
                      Upload Floor Plan
                    </label>
                    <div class="upload-box">
                      <input
                        type="file"
                        class="form-control file-input"
                        id="floor_plan_file_<?= (int)$index ?>"
                        name="floor_plan_file[]"
                        accept="image/*,application/pdf"
                        data-floor-plan-input="file">
                      <div class="upload-content">
                        <img src="assets/images/file.png" alt="Upload Icon" width="30px">
                        <p>Drop files here or click to upload</p>
                        <p class="upload-file-name text-muted"></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4">
                    <label for="floor_plan_title_<?= (int)$index ?>" class="form-label" data-floor-plan-label="title">Floor Plan Title Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="floor_plan_title_<?= (int)$index ?>"
                      name="floor_plan_title[]"
                      placeholder="e.g., 2 Bedroom"
                      data-floor-plan-input="title"
                      value="<?= htmlspecialchars($plan['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                  </div>
                  <div class="col-lg-4 col-md-4">
                    <label for="floor_plan_area_<?= (int)$index ?>" class="form-label" data-floor-plan-label="area">Total Area</label>
                    <input
                      type="text"
                      class="form-control"
                      id="floor_plan_area_<?= (int)$index ?>"
                      name="floor_plan_area[]"
                      placeholder="e.g., 1,200 sq.ft"
                      data-floor-plan-input="area"
                      value="<?= htmlspecialchars($plan['area'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                  </div>
                  <div class="col-lg-4 col-md-4">
                    <label for="floor_plan_price_<?= (int)$index ?>" class="form-label" data-floor-plan-label="price">Price In</label>
                    <input
                      type="text"
                      class="form-control"
                      id="floor_plan_price_<?= (int)$index ?>"
                      name="floor_plan_price[]"
                      placeholder="e.g., AED"
                      data-floor-plan-input="price"
                      value="<?= htmlspecialchars($plan['price'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                  </div>
                  <div class="col-lg-1 col-12 text-lg-end">
                    <button type="button" class="btn btn-outline-danger remove-floor-plan <?= $index === 0 ? 'd-none' : '' ?>">Delete</button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <template id="floor-plan-template">
            <div class="floor-plan-item border rounded p-3 mb-3" data-floor-plan-index="">
              <div class="row g-4 align-items-end">
                <div class="col-lg-3 col-md-6">
                  <label class="form-label" data-floor-plan-label="file">Upload Floor Plan</label>
                  <input
                    type="file"
                    class="form-control"
                    name="floor_plan_file[]"
                    accept="image/*,application/pdf"
                    data-floor-plan-input="file">
                </div>
                <div class="col-lg-3 col-md-6">
                  <label class="form-label" data-floor-plan-label="title">Floor Plan Title Name</label>
                  <input
                    type="text"
                    class="form-control"
                    name="floor_plan_title[]"
                    placeholder="e.g., 2 Bedroom"
                    data-floor-plan-input="title">
                </div>
                <div class="col-lg-3 col-md-6">
                  <label class="form-label" data-floor-plan-label="area">Total Area</label>
                  <input
                    type="text"
                    class="form-control"
                    name="floor_plan_area[]"
                    placeholder="e.g., 1,200 sq.ft"
                    data-floor-plan-input="area">
                </div>
                <div class="col-lg-2 col-md-6">
                  <label class="form-label" data-floor-plan-label="price">Price In</label>
                  <input
                    type="text"
                    class="form-control"
                    name="floor_plan_price[]"
                    placeholder="e.g., AED"
                    data-floor-plan-input="price">
                </div>
                <div class="col-lg-1 col-12 text-lg-end">
                  <button type="button" class="btn btn-outline-danger remove-floor-plan">Delete</button>
                </div>
              </div>
            </div>
          </template>
        </section>
      </div>

      <div class="col-12">
        <section class="form-section">
          <div class="section-header">
            <h4 class="section-title">
              <img src="assets/images/icons/video-call.png" alt="Video and links icon" class="section-title-icon">
              <span>Media &amp; Links</span>
            </h4>
            <p class="section-subtitle">Add supporting media links to enhance the listing.</p>
          </div>
          <div class="row g-4">
            <div class="col-md-6">
              <label for="video_link" class="form-label">Add Video Link</label>
              <input
                type="url"
                class="form-control"
                id="video_link"
                name="video_link"
                placeholder="https://"
                value="<?= htmlspecialchars($formData['video_link'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-6">
              <label for="location_map" class="form-label">Location Map</label>
              <input
                type="url"
                class="form-control"
                id="location_map"
                name="location_map"
                placeholder="Google Maps embed link"
                value="<?= htmlspecialchars($formData['location_map'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
          </div>
        </section>
      </div>

      <div class="col-12">
        <section class="form-section">
          <div class="section-header">
            <h4 class="section-title">
              <img src="assets/images/icons/location.png" alt="Location pin icon" class="section-title-icon">
              <span>Location &amp; Accessibility</span>
            </h4>
          </div>
          <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-3">
            <p class="section-subtitle mb-0">Highlight key landmarks and travel times.</p>
            <button type="button" class="btn btn-primary" id="add-location-accessibility">Add Location</button>
          </div>
          <div class="location-accessibility-list" data-location-list>
            <?php foreach ($locationAccessibilityFormData as $index => $location): ?>
              <div class="location-accessibility-item border rounded p-3 mb-3" data-location-index="<?= (int)$index ?>">
                <div class="row g-4 align-items-end">
                  <div class="col-md-4">
                    <label for="location_landmark_<?= (int)$index ?>" class="form-label" data-location-label="landmark">Landmark Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="location_landmark_<?= (int)$index ?>"
                      name="location_landmark[]"
                      placeholder="Nearest landmark"
                      value="<?= htmlspecialchars($location['landmark_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                      data-location-input="landmark">
                  </div>
                  <div class="col-md-4">
                    <label for="location_distance_<?= (int)$index ?>" class="form-label" data-location-label="distance">Distance Time</label>
                    <input
                      type="text"
                      class="form-control"
                      id="location_distance_<?= (int)$index ?>"
                      name="location_distance[]"
                      placeholder="e.g., 10 mins by car"
                      value="<?= htmlspecialchars($location['distance_time'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                      data-location-input="distance">
                  </div>
                  <div class="col-md-3">
                    <label for="location_category_<?= (int)$index ?>" class="form-label" data-location-label="category">Location Category</label>
                    <input
                      type="text"
                      class="form-control"
                      id="location_category_<?= (int)$index ?>"
                      name="location_category[]"
                      placeholder="e.g., Luxury"
                      value="<?= htmlspecialchars($location['category'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                      data-location-input="category">
                  </div>
                  <div class="col-md-1 text-md-end">
                    <button type="button" class="btn btn-outline-danger remove-location <?= $index === 0 ? 'd-none' : '' ?>">Delete</button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <template id="location-accessibility-template">
            <div class="location-accessibility-item border rounded p-3 mb-3" data-location-index="">
              <div class="row g-4 align-items-end">
                <div class="col-md-4">
                  <label class="form-label" data-location-label="landmark">Landmark Name</label>
                  <input
                    type="text"
                    class="form-control"
                    name="location_landmark[]"
                    placeholder="Nearest landmark"
                    data-location-input="landmark">
                </div>
                <div class="col-md-4">
                  <label class="form-label" data-location-label="distance">Distance Time</label>
                  <input
                    type="text"
                    class="form-control"
                    name="location_distance[]"
                    placeholder="e.g., 10 mins by car"
                    data-location-input="distance">
                </div>
                <div class="col-md-3">
                  <label class="form-label" data-location-label="category">Location Category</label>
                  <input
                    type="text"
                    class="form-control"
                    name="location_category[]"
                    placeholder="e.g., Luxury"
                    data-location-input="category">
                </div>
                <div class="col-md-1 text-md-end">
                  <button type="button" class="btn btn-outline-danger remove-location">Delete</button>
                </div>
              </div>
            </div>
          </template>
        </section>
      </div>

      <div class="col-12">
        <section class="form-section">
          <div class="section-header">
            <h4 class="section-title">
              <img src="assets/images/icons/growth-chart.png" alt="Investment growth icon" class="section-title-icon">
              <span>Investment Highlights</span>
            </h4>
            <p class="section-subtitle">Summarize the investment rationale to attract buyers.</p>
          </div>
          <div class="row g-4">
            <div class="col-md-3">
              <label for="roi_potential" class="form-label">ROI Potential</label>
              <input
                type="text"
                class="form-control"
                id="roi_potential"
                name="roi_potential"
                placeholder="e.g., 8%"
                value="<?= htmlspecialchars($formData['roi_potential'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-3">
              <label for="capital_growth" class="form-label">Capital Growth</label>
              <input
                type="text"
                class="form-control"
                id="capital_growth"
                name="capital_growth"
                placeholder="e.g., 15%"
                value="<?= htmlspecialchars($formData['capital_growth'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-3">
              <label for="occupancy_rate" class="form-label">Occupancy Rate</label>
              <input
                type="text"
                class="form-control"
                id="occupancy_rate"
                name="occupancy_rate"
                placeholder="e.g., 90%"
                value="<?= htmlspecialchars($formData['occupancy_rate'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-3">
              <label for="resale_value" class="form-label">Resale Value</label>
              <input
                type="text"
                class="form-control"
                id="resale_value"
                name="resale_value"
                placeholder="e.g., High"
                value="<?= htmlspecialchars($formData['resale_value'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
          </div>
        </section>
      </div>

      <div class="col-12">
        <section class="form-section">
          <div class="section-header">
            <h4 class="section-title">
              <img src="assets/images/icons/wallet.png" alt="Payment plan icon" class="section-title-icon">
              <span>Payment Plan</span>
            </h4>
            <p class="section-subtitle">Outline the financial structure to help investors plan their purchase.</p>
          </div>
          <div class="row g-4">
            <div class="col-md-4">
              <label for="booking_percentage" class="form-label">Booking Percentage</label>
              <input
                type="text"
                class="form-control"
                id="booking_percentage"
                name="booking_percentage"
                placeholder="e.g., 10%"
                value="<?= htmlspecialchars($formData['booking_percentage'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="booking_amount" class="form-label">Booking Amount</label>
              <input
                type="text"
                class="form-control"
                id="booking_amount"
                name="booking_amount"
                min="0"
                step="1000"
                placeholder="AED"
                value="<?= htmlspecialchars($formData['booking_amount'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="during_construction_percentage" class="form-label">During Construction Percentage</label>
              <input
                type="text"
                class="form-control"
                id="during_construction_percentage"
                name="during_construction_percentage"
                placeholder="e.g., 50%"
                value="<?= htmlspecialchars($formData['during_construction_percentage'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="during_construction_amount" class="form-label">During Construction Amount</label>
              <input
                type="text"
                class="form-control"
                id="during_construction_amount"
                name="during_construction_amount"
                min="0"
                step="1000"
                placeholder="AED"
                value="<?= htmlspecialchars($formData['during_construction_amount'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="handover_percentage" class="form-label">Handover Percentage</label>
              <input
                type="text"
                class="form-control"
                id="handover_percentage"
                name="handover_percentage"
                placeholder="e.g., 40%"
                value="<?= htmlspecialchars($formData['handover_percentage'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="handover_amount" class="form-label">Handover Amount</label>
              <input
                type="text"
                class="form-control"
                id="handover_amount"
                name="handover_amount"
                min="0"
                step="1000"
                placeholder="AED"
                value="<?= htmlspecialchars($formData['handover_amount'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="col-md-4">
              <label for="permit_no" class="form-label">Permit No</label>
              <input
                type="text"
                class="form-control"
                id="permit_no"
                name="permit_no"
                placeholder="Enter permit number"
                value="<?= htmlspecialchars($formData['permit_no'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
          </div>
        </section>
      </div>

      <div class="col-12">
        <div class="d-flex justify-content-end gap-2">
          <button type="reset" class="btn btn-outline-secondary">Reset</button>
          <button type="submit" class="btn btn-primary">Save Property</button>
        </div>
      </div>
    </form>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@39.0.1/build/ckeditor.js"></script>
<script>
  (function() {
    const form = document.querySelector('.box form');
    const successAlert = document.querySelector('[data-success-alert]');

    if (form) {
      const updateFileInputFileName = input => {
        const uploadBox = input.closest('.upload-box');
        const fileNameOutput = uploadBox ? uploadBox.querySelector('.upload-file-name') : null;

        if (!fileNameOutput) {
          return;
        }

        const {
          files
        } = input;

        if (!files || files.length === 0) {
          fileNameOutput.textContent = '';
          return;
        }

        const names = Array.from(files)
          .map(file => file.name)
          .join(', ');
        fileNameOutput.textContent = names;
      };

      const uploadInputs = form.querySelectorAll('.file-input');

      uploadInputs.forEach(input => {
        input.addEventListener('change', () => updateFileInputFileName(input));
      });

      form.addEventListener('change', event => {
        const target = event.target;

        if (!target.classList || !target.classList.contains('file-input')) {
          return;
        }

        updateFileInputFileName(target);
      });

      form.addEventListener('reset', () => {
        window.setTimeout(() => {
          const fileNameOutputs = form.querySelectorAll('.upload-file-name');
          fileNameOutputs.forEach(output => {
            output.textContent = '';
          });
        }, 0);
      });

      if (successAlert) {
        window.setTimeout(() => {
          form.reset();
        }, 0);
      }
    }

    const floorPlanList = document.querySelector('[data-floor-plan-list]');
    const floorPlanTemplate = document.getElementById('floor-plan-template');
    const addFloorPlanButton = document.getElementById('add-floor-plan');

    const renumberFloorPlans = () => {
      if (!floorPlanList) {
        return;
      }

      const items = floorPlanList.querySelectorAll('.floor-plan-item');

      items.forEach((item, index) => {
        item.dataset.floorPlanIndex = String(index);

        const labels = item.querySelectorAll('[data-floor-plan-label]');
        labels.forEach(label => {
          const field = label.getAttribute('data-floor-plan-label');

          if (field) {
            label.setAttribute('for', `floor_plan_${field}_${index}`);
          }
        });

        const inputs = item.querySelectorAll('[data-floor-plan-input]');
        inputs.forEach(input => {
          const field = input.getAttribute('data-floor-plan-input');

          if (field) {
            input.id = `floor_plan_${field}_${index}`;
            input.name = `floor_plan_${field}[]`;
          }
        });
      });

      const deleteButtons = floorPlanList.querySelectorAll('.remove-floor-plan');
      deleteButtons.forEach((button, index) => {
        button.classList.toggle('d-none', index === 0);
      });
    };

    if (floorPlanList && floorPlanTemplate && addFloorPlanButton) {
      addFloorPlanButton.addEventListener('click', () => {
        const clone = floorPlanTemplate.content.cloneNode(true);
        floorPlanList.appendChild(clone);
        renumberFloorPlans();
      });

      floorPlanList.addEventListener('click', event => {
        const target = event.target.closest('.remove-floor-plan');

        if (!target) {
          return;
        }

        const items = floorPlanList.querySelectorAll('.floor-plan-item');

        if (items.length <= 1) {
          return;
        }

        const item = target.closest('.floor-plan-item');

        if (item) {
          item.remove();
          renumberFloorPlans();
        }
      });

      renumberFloorPlans();
    }

    const locationList = document.querySelector('[data-location-list]');
    const locationTemplate = document.getElementById('location-accessibility-template');
    const addLocationButton = document.getElementById('add-location-accessibility');

    const renumberLocations = () => {
      if (!locationList) {
        return;
      }

      const items = locationList.querySelectorAll('.location-accessibility-item');

      items.forEach((item, index) => {
        item.dataset.locationIndex = String(index);

        const labels = item.querySelectorAll('[data-location-label]');
        labels.forEach(label => {
          const field = label.getAttribute('data-location-label');

          if (field) {
            label.setAttribute('for', `location_${field}_${index}`);
          }
        });

        const inputs = item.querySelectorAll('[data-location-input]');
        inputs.forEach(input => {
          const field = input.getAttribute('data-location-input');

          if (field) {
            input.id = `location_${field}_${index}`;
          }
        });
      });

      const deleteButtons = locationList.querySelectorAll('.remove-location');
      deleteButtons.forEach((button, index) => {
        button.classList.toggle('d-none', index === 0);
      });
    };

    if (locationList && locationTemplate && addLocationButton) {
      addLocationButton.addEventListener('click', () => {
        const clone = locationTemplate.content.cloneNode(true);
        locationList.appendChild(clone);
        renumberLocations();
      });

      locationList.addEventListener('click', event => {
        const target = event.target.closest('.remove-location');

        if (!target) {
          return;
        }

        const items = locationList.querySelectorAll('.location-accessibility-item');

        if (items.length <= 1) {
          return;
        }

        const item = target.closest('.location-accessibility-item');

        if (item) {
          item.remove();
          renumberLocations();
        }
      });

      renumberLocations();
    }

    const textarea = document.getElementById('about_project');

    if (!textarea) {
      return;
    }

    ClassicEditor
      .create(textarea)
      .then(editor => {
        if (textarea.hasAttribute('required')) {
          textarea.removeAttribute('required');
        }

        if (form) {
          form.addEventListener('submit', () => {
            textarea.value = editor.getData();
          });

          form.addEventListener('reset', () => {
            editor.setData('');
            textarea.value = '';
          });
        }
      })
      .catch(error => {
        console.error('CKEditor initialization failed for About Project field', error);
      });

    if (successAlert) {
      const dismissAfter = Number(successAlert.getAttribute('data-auto-dismiss') || 5000);

      window.setTimeout(() => {
        if (typeof window.bootstrap !== 'undefined' && window.bootstrap.Alert) {
          const alertInstance = window.bootstrap.Alert.getOrCreateInstance(successAlert);
          alertInstance.close();
        } else {
          successAlert.classList.remove('show');
          successAlert.addEventListener('transitionend', () => successAlert.remove(), { once: true });
          window.setTimeout(() => {
            if (successAlert.parentNode) {
              successAlert.parentNode.removeChild(successAlert);
            }
          }, 300);
        }
      }, Number.isFinite(dismissAfter) ? dismissAfter : 5000);
    }
  })();
</script>
<?php
render_footer();
?>