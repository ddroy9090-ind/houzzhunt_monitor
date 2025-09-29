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

$pdo = db();

/**
 * Ensure the properties_list table exists with the expected structure.
 */
function all_properties_ensure_table(PDO $pdo): void
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
      meta_title VARCHAR(255) DEFAULT NULL,
      meta_keywords TEXT NULL,
      meta_description TEXT NULL,
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

  $columnsToEnsure = [
    'location_accessibility' => "ALTER TABLE properties_list ADD location_accessibility LONGTEXT NULL AFTER category",
    'project_name'           => "ALTER TABLE properties_list ADD project_name VARCHAR(255) NULL AFTER property_type",
    'meta_title'             => "ALTER TABLE properties_list ADD meta_title VARCHAR(255) NULL AFTER property_title",
    'meta_keywords'          => "ALTER TABLE properties_list ADD meta_keywords TEXT NULL AFTER meta_title",
    'meta_description'       => "ALTER TABLE properties_list ADD meta_description TEXT NULL AFTER meta_keywords",
  ];

  foreach ($columnsToEnsure as $column => $sql) {
    try {
      $stmt = $pdo->query("SHOW COLUMNS FROM properties_list LIKE '" . $column . "'");
      if ($stmt instanceof PDOStatement && $stmt->rowCount() === 0) {
        $pdo->exec($sql);
      }
    } catch (Throwable $e) {
      error_log('Failed to ensure properties_list column ' . $column . ': ' . $e->getMessage());
    }
  }
}

all_properties_ensure_table($pdo);

$successMessage = $_SESSION['property_success'] ?? null;
unset($_SESSION['property_success']);
$errorMessage = $_SESSION['property_error'] ?? null;
unset($_SESSION['property_error']);
$sessionFormData = $_SESSION['property_form_data'] ?? null;
unset($_SESSION['property_form_data']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_check($_POST['csrf'] ?? '');
  $action = (string)($_POST['action'] ?? '');

  if ($action === 'delete') {
    rl_hit('delete-property', 20);
    $propertyId = (int)($_POST['property_id'] ?? 0);
    if ($propertyId <= 0) {
      $_SESSION['property_error'] = 'Invalid property selected for deletion.';
      header('Location: all_properties.php');
      exit;
    }

    try {
      $stmt = $pdo->prepare('DELETE FROM properties_list WHERE id = :id');
      $stmt->bindValue(':id', $propertyId, PDO::PARAM_INT);
      $stmt->execute();
      $_SESSION['property_success'] = 'Your Property Details has been deleted successfully.';
    } catch (Throwable $e) {
      error_log('Failed to delete property: ' . $e->getMessage());
      $_SESSION['property_error'] = 'An unexpected error occurred while deleting the property.';
    }

    header('Location: all_properties.php');
    exit;
  }

  if ($action === 'update') {
    rl_hit('update-property', 30);
    $propertyId = (int)($_POST['property_id'] ?? 0);
    if ($propertyId <= 0) {
      $_SESSION['property_error'] = 'Invalid property selected for update.';
      header('Location: all_properties.php');
      exit;
    }

    try {
      $stmt = $pdo->prepare('SELECT id FROM properties_list WHERE id = :id');
      $stmt->bindValue(':id', $propertyId, PDO::PARAM_INT);
      $stmt->execute();
      $exists = $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    } catch (Throwable $e) {
      error_log('Failed to verify property existence: ' . $e->getMessage());
      $_SESSION['property_error'] = 'Unable to update the property at this time.';
      header('Location: all_properties.php');
      exit;
    }

    if (!$exists) {
      $_SESSION['property_error'] = 'The selected property could not be found.';
      header('Location: all_properties.php');
      exit;
    }

    $columns = [
      'project_status'                 => 'string',
      'property_type'                  => 'string',
      'project_name'                   => 'string',
      'property_title'                 => 'string',
      'meta_title'                     => 'string',
      'meta_keywords'                  => 'string',
      'meta_description'               => 'string',
      'property_location'              => 'string',
      'starting_price'                 => 'string',
      'bedroom'                        => 'string',
      'bathroom'                       => 'string',
      'parking'                        => 'string',
      'total_area'                     => 'string',
      'completion_date'                => 'date',
      'about_project'                  => 'string',
      'developer_name'                 => 'string',
      'developer_established'          => 'string',
      'about_developer'                => 'string',
      'completed_projects'             => 'string',
      'international_awards'           => 'string',
      'on_time_delivery'               => 'string',
      'video_link'                     => 'string',
      'location_map'                   => 'string',
      'landmark_name'                  => 'string',
      'distance_time'                  => 'string',
      'category'                       => 'string',
      'roi_potential'                  => 'string',
      'capital_growth'                 => 'string',
      'occupancy_rate'                 => 'string',
      'resale_value'                   => 'string',
      'booking_percentage'             => 'string',
      'booking_amount'                 => 'string',
      'during_construction_percentage' => 'string',
      'during_construction_amount'     => 'string',
      'handover_percentage'            => 'string',
      'handover_amount'                => 'string',
      'permit_no'                      => 'string',
    ];

    $updateValues = [];
    $formSnapshot = ['id' => $propertyId];
    $errors = [];

    foreach ($columns as $column => $type) {
      $raw = $_POST[$column] ?? '';
      if ($type === 'date') {
        $raw = is_string($raw) ? trim($raw) : '';
        if ($raw === '') {
          $updateValues[$column] = null;
          $formSnapshot[$column] = '';
        } else {
          try {
            $dt = new DateTimeImmutable($raw);
            $updateValues[$column] = $dt->format('Y-m-d');
            $formSnapshot[$column] = $dt->format('Y-m-d');
          } catch (Throwable $e) {
            $errors[] = 'Please provide a valid completion date (YYYY-MM-DD).';
            $updateValues[$column] = null;
            $formSnapshot[$column] = $raw;
          }
        }
      } else {
        $value = is_string($raw) ? trim($raw) : '';
        $updateValues[$column] = $value;
        $formSnapshot[$column] = $value;
      }
    }

    if ($errors !== []) {
      $_SESSION['property_error'] = implode(' ', $errors);
      $_SESSION['property_form_data'] = $formSnapshot;
      header('Location: all_properties.php?edit=' . urlencode((string)$propertyId));
      exit;
    }

    $setParts = [];
    foreach (array_keys($updateValues) as $column) {
      $setParts[] = $column . ' = :' . $column;
    }

    try {
      $sql = 'UPDATE properties_list SET ' . implode(', ', $setParts) . ' WHERE id = :id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $propertyId, PDO::PARAM_INT);
      foreach ($updateValues as $column => $value) {
        $param = ':' . $column;
        if ($value === null) {
          $stmt->bindValue($param, null, PDO::PARAM_NULL);
        } else {
          $stmt->bindValue($param, $value);
        }
      }
      $stmt->execute();
      $_SESSION['property_success'] = 'Your Property Details has been Updated.';
    } catch (Throwable $e) {
      error_log('Failed to update property: ' . $e->getMessage());
      $_SESSION['property_error'] = 'An unexpected error occurred while updating the property.';
      $_SESSION['property_form_data'] = $formSnapshot;
    }

    header('Location: all_properties.php?edit=' . urlencode((string)$propertyId));
    exit;
  }

  $_SESSION['property_error'] = 'Unsupported action requested.';
  header('Location: all_properties.php');
  exit;
}

$editId = (int)($_GET['edit'] ?? 0);
$editingProperty = null;

if ($editId > 0) {
  try {
    $stmt = $pdo->prepare('SELECT * FROM properties_list WHERE id = :id');
    $stmt->bindValue(':id', $editId, PDO::PARAM_INT);
    $stmt->execute();
    $editingProperty = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
  } catch (Throwable $e) {
    error_log('Failed to fetch property for editing: ' . $e->getMessage());
    $editingProperty = null;
    $errorMessage = $errorMessage ?: 'Unable to load the selected property for editing.';
  }

  if ($editingProperty === null && $errorMessage === null) {
    $errorMessage = 'The selected property could not be found.';
  }
}

if ($editingProperty !== null && is_array($sessionFormData)) {
  $editingProperty = array_merge($editingProperty, $sessionFormData);
} elseif ($sessionFormData !== null && $editingProperty === null) {
  $editingProperty = $sessionFormData;
}

try {
  $listStmt = $pdo->query(
    'SELECT id, property_title, property_location, property_type, project_status, starting_price, created_at
       FROM properties_list
      ORDER BY created_at DESC, id DESC'
  );
  $properties = $listStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
  error_log('Failed to fetch properties list: ' . $e->getMessage());
  $properties = [];
  if ($errorMessage === null) {
    $errorMessage = 'Unable to load properties at the moment. Please try again later.';
  }
}

render_head('All Properties', 'dashboard-body');
?>
<div class="container-fluid">
  <div class="row">
    <?php render_sidebar('all-properties'); ?>
    <main class="col-12 col-md-9 col-lg-10 ms-auto p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">All Properties</h1>
        <a class="btn btn-primary" href="add_property.php"><i class="bi bi-plus-lg me-2"></i>Add New Property</a>
      </div>

      <?php if ($successMessage): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <?php if ($errorMessage): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <div class="card mb-4">
        <div class="card-header bg-white">
          <h2 class="h5 mb-0">Properties List</h2>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped table-hover mb-0 align-middle">
              <thead class="table-light">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Property Title</th>
                  <th scope="col">Location</th>
                  <th scope="col">Type</th>
                  <th scope="col">Status</th>
                  <th scope="col">Starting Price</th>
                  <th scope="col">Created At</th>
                  <th scope="col" class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($properties === []): ?>
                  <tr>
                    <td colspan="8" class="text-center py-4">No properties found.</td>
                  </tr>
                <?php else: ?>
                  <?php foreach ($properties as $property): ?>
                    <tr>
                      <td><?= htmlspecialchars((string)$property['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?= htmlspecialchars((string)($property['property_title'] ?? '—'), ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?= htmlspecialchars((string)($property['property_location'] ?? '—'), ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?= htmlspecialchars((string)($property['property_type'] ?? '—'), ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?= htmlspecialchars((string)($property['project_status'] ?? '—'), ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?= htmlspecialchars((string)($property['starting_price'] ?? '—'), ENT_QUOTES, 'UTF-8'); ?></td>
                      <td>
                        <?php
                        $createdAt = $property['created_at'] ?? null;
                        if ($createdAt) {
                          try {
                            $dt = new DateTimeImmutable((string)$createdAt);
                            echo htmlspecialchars($dt->format('M j, Y g:i A'), ENT_QUOTES, 'UTF-8');
                          } catch (Throwable $e) {
                            echo htmlspecialchars((string)$createdAt, ENT_QUOTES, 'UTF-8');
                          }
                        } else {
                          echo '—';
                        }
                        ?>
                      </td>
                      <td class="text-end">
                        <div class="btn-group" role="group" aria-label="Property Actions">
                          <a class="btn btn-sm btn-outline-primary" href="all_properties.php?edit=<?= urlencode((string)$property['id']); ?>" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                          </a>
                          <form method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this property?');">
                            <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8'); ?>">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="property_id" value="<?= htmlspecialchars((string)$property['id'], ENT_QUOTES, 'UTF-8'); ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <?php if ($editingProperty !== null): ?>
        <div class="card">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Edit Property #<?= htmlspecialchars((string)($editingProperty['id'] ?? $editId), ENT_QUOTES, 'UTF-8'); ?></h2>
            <a href="all_properties.php" class="btn btn-outline-secondary btn-sm">Cancel</a>
          </div>
          <div class="card-body">
            <form method="post">
              <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8'); ?>">
              <input type="hidden" name="action" value="update">
              <input type="hidden" name="property_id" value="<?= htmlspecialchars((string)($editingProperty['id'] ?? $editId), ENT_QUOTES, 'UTF-8'); ?>">
              <div class="row g-3">
                <?php
                $fields = [
                  'project_status' => ['label' => 'Project Status', 'type' => 'text'],
                  'property_type' => ['label' => 'Property Type', 'type' => 'text'],
                  'project_name' => ['label' => 'Project Name', 'type' => 'text'],
                  'property_title' => ['label' => 'Property Title', 'type' => 'text'],
                  'meta_title' => ['label' => 'Meta Title', 'type' => 'text'],
                  'meta_keywords' => ['label' => 'Meta Keywords', 'type' => 'textarea'],
                  'meta_description' => ['label' => 'Meta Description', 'type' => 'textarea'],
                  'property_location' => ['label' => 'Location', 'type' => 'text'],
                  'starting_price' => ['label' => 'Starting Price', 'type' => 'text'],
                  'bedroom' => ['label' => 'Bedrooms', 'type' => 'text'],
                  'bathroom' => ['label' => 'Bathrooms', 'type' => 'text'],
                  'parking' => ['label' => 'Parking', 'type' => 'text'],
                  'total_area' => ['label' => 'Total Area', 'type' => 'text'],
                  'completion_date' => ['label' => 'Completion Date', 'type' => 'date'],
                  'about_project' => ['label' => 'About Project', 'type' => 'textarea'],
                  'developer_name' => ['label' => 'Developer Name', 'type' => 'text'],
                  'developer_established' => ['label' => 'Developer Established', 'type' => 'text'],
                  'about_developer' => ['label' => 'About Developer', 'type' => 'textarea'],
                  'completed_projects' => ['label' => 'Completed Projects', 'type' => 'text'],
                  'international_awards' => ['label' => 'International Awards', 'type' => 'text'],
                  'on_time_delivery' => ['label' => 'On Time Delivery', 'type' => 'text'],
                  'video_link' => ['label' => 'Video Link', 'type' => 'text'],
                  'location_map' => ['label' => 'Location Map URL', 'type' => 'text'],
                  'landmark_name' => ['label' => 'Landmark Name', 'type' => 'text'],
                  'distance_time' => ['label' => 'Distance / Time', 'type' => 'text'],
                  'category' => ['label' => 'Category', 'type' => 'text'],
                  'roi_potential' => ['label' => 'ROI Potential', 'type' => 'text'],
                  'capital_growth' => ['label' => 'Capital Growth', 'type' => 'text'],
                  'occupancy_rate' => ['label' => 'Occupancy Rate', 'type' => 'text'],
                  'resale_value' => ['label' => 'Resale Value', 'type' => 'text'],
                  'booking_percentage' => ['label' => 'Booking Percentage', 'type' => 'text'],
                  'booking_amount' => ['label' => 'Booking Amount', 'type' => 'text'],
                  'during_construction_percentage' => ['label' => 'During Construction Percentage', 'type' => 'text'],
                  'during_construction_amount' => ['label' => 'During Construction Amount', 'type' => 'text'],
                  'handover_percentage' => ['label' => 'Handover Percentage', 'type' => 'text'],
                  'handover_amount' => ['label' => 'Handover Amount', 'type' => 'text'],
                  'permit_no' => ['label' => 'Permit Number', 'type' => 'text'],
                ];

                foreach ($fields as $name => $meta):
                  $value = $editingProperty[$name] ?? '';
                  $escapedValue = htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
                  $label = htmlspecialchars($meta['label'], ENT_QUOTES, 'UTF-8');
                  $type = $meta['type'];
                  $colClass = $type === 'textarea' ? 'col-12' : 'col-12 col-md-6';
                ?>
                  <div class="<?= $colClass; ?>">
                    <label class="form-label" for="field-<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>"><?= $label; ?></label>
                    <?php if ($type === 'textarea'): ?>
                      <textarea class="form-control" id="field-<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" name="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" rows="3"><?= $escapedValue; ?></textarea>
                    <?php elseif ($type === 'date'): ?>
                      <input type="date" class="form-control" id="field-<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" name="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" value="<?= $escapedValue; ?>">
                    <?php else: ?>
                      <input type="text" class="form-control" id="field-<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" name="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" value="<?= $escapedValue; ?>">
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>
              <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="all_properties.php" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Update Property</button>
              </div>
            </form>
          </div>
        </div>
      <?php endif; ?>
    </main>
  </div>
</div>
<?php
render_footer();
