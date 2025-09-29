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

  $_SESSION['property_error'] = 'Unsupported action requested.';
  header('Location: all_properties.php');
  exit;
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
                          <a class="btn btn-sm btn-outline-primary" href="add_property.php?edit=<?= urlencode((string)$property['id']); ?>" title="Edit">
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

    </main>
  </div>
</div>
<?php
render_footer();
