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
              <input type="text" class="form-control" id="project_status" name="project_status" placeholder="e.g., Off-plan">
            </div>
            <div class="col-md-4">
              <label for="property_type" class="form-label">Property Type</label>
              <select class="form-select form-control" id="property_type" name="property_type">
                <option value="" selected disabled>Select property type</option>
                <option value="Apartment">Apartment</option>
                <option value="Villa">Villa</option>
                <option value="Townhouse">Townhouse</option>
                <option value="Penthouse">Penthouse</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="property_title" class="form-label">Property Title</label>
              <input type="text" class="form-control" id="property_title" name="property_title" placeholder="Project name">
            </div>
            <div class="col-md-4">
              <label for="property_location" class="form-label">Property Location</label>
              <input type="text" class="form-control" id="property_location" name="property_location" placeholder="City, Community">
            </div>
            <div class="col-md-4">
              <label for="starting_price" class="form-label">Starting From (Price AED)</label>
              <input type="text" class="form-control" id="starting_price" name="starting_price" min="0" step="1000" placeholder="AED">
            </div>
            <div class="col-md-4">
              <label for="bedroom" class="form-label">Bedroom</label>
              <input type="text" class="form-control" id="bedroom" name="bedroom" placeholder="e.g., 1 - 4">
            </div>
            <div class="col-md-4">
              <label for="bathroom" class="form-label">Bathroom</label>
              <input type="text" class="form-control" id="bathroom" name="bathroom" placeholder="e.g., 1 - 3">
            </div>
            <div class="col-md-4">
              <label for="parking" class="form-label">Parking</label>
              <input type="text" class="form-control" id="parking" name="parking" placeholder="e.g., 1 Allocated">
            </div>
            <div class="col-md-4">
              <label for="total_area" class="form-label">Total Area</label>
              <input type="text" class="form-control" id="total_area" name="total_area" placeholder="e.g., 1,200 sq.ft">
            </div>
            <div class="col-md-4">
              <label for="completion_date" class="form-label">Completion Date</label>
              <input type="date" class="form-control" id="completion_date" name="completion_date">
            </div>
            <div class="col-12">
              <label for="about_project" class="form-label">About Project (Overview In Rich Text Editor)</label>
              <textarea class="form-control" id="about_project" name="about_project" rows="6" placeholder="Enter an engaging project overview..."></textarea>
            </div>
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
              <input type="text" class="form-control" id="developer_name" name="developer_name" placeholder="Developer name">
            </div>
            <div class="col-md-6">
              <label for="developer_established" class="form-label">Established</label>
              <input type="text" class="form-control" id="developer_established" name="developer_established" placeholder="Year established">
            </div>
            <div class="col-12">
              <label for="about_developer" class="form-label">About Developer</label>
              <textarea class="form-control" id="about_developer" name="about_developer" rows="4" placeholder="Highlight the developer's experience and vision..."></textarea>
            </div>
            <div class="col-md-4">
              <label for="completed_projects" class="form-label">Completed Projects</label>
              <input type="text" class="form-control" id="completed_projects" name="completed_projects" min="0" step="1" placeholder="Number of projects">
            </div>
            <div class="col-md-4">
              <label for="international_awards" class="form-label">International Awards</label>
              <input type="text" class="form-control" id="international_awards" name="international_awards" placeholder="List or count awards">
            </div>
            <div class="col-md-4">
              <label for="on_time_delivery" class="form-label">On-Time Delivery</label>
              <input type="text" class="form-control" id="on_time_delivery" name="on_time_delivery" placeholder="e.g., 95%">
            </div>
          </div>
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
              <input type="url" class="form-control" id="video_link" name="video_link" placeholder="https://">
            </div>
            <div class="col-md-6">
              <label for="location_map" class="form-label">Location Map</label>
              <input type="url" class="form-control" id="location_map" name="location_map" placeholder="Google Maps embed link">
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
            <p class="section-subtitle">Highlight key landmarks and travel times.</p>
          </div>
          <div class="row g-4">
            <div class="col-md-4">
              <label for="landmark_name" class="form-label">Landmark Name</label>
              <input type="text" class="form-control" id="landmark_name" name="landmark_name" placeholder="Nearest landmark">
            </div>
            <div class="col-md-4">
              <label for="distance_time" class="form-label">Distance Time</label>
              <input type="text" class="form-control" id="distance_time" name="distance_time" placeholder="e.g., 10 mins by car">
            </div>
            <div class="col-md-4">
              <label for="category" class="form-label">Location Category</label>
              <input type="text" class="form-control" id="category" name="category" placeholder="e.g., Luxury">
            </div>
          </div>
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
              <input type="text" class="form-control" id="roi_potential" name="roi_potential" placeholder="e.g., 8%">
            </div>
            <div class="col-md-3">
              <label for="capital_growth" class="form-label">Capital Growth</label>
              <input type="text" class="form-control" id="capital_growth" name="capital_growth" placeholder="e.g., 15%">
            </div>
            <div class="col-md-3">
              <label for="occupancy_rate" class="form-label">Occupancy Rate</label>
              <input type="text" class="form-control" id="occupancy_rate" name="occupancy_rate" placeholder="e.g., 90%">
            </div>
            <div class="col-md-3">
              <label for="resale_value" class="form-label">Resale Value</label>
              <input type="text" class="form-control" id="resale_value" name="resale_value" placeholder="e.g., High">
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
              <input type="text" class="form-control" id="booking_percentage" name="booking_percentage" placeholder="e.g., 10%">
            </div>
            <div class="col-md-4">
              <label for="booking_amount" class="form-label">Booking Amount</label>
              <input type="text" class="form-control" id="booking_amount" name="booking_amount" min="0" step="1000" placeholder="AED">
            </div>
            <div class="col-md-4">
              <label for="during_construction_percentage" class="form-label">During Construction Percentage</label>
              <input type="text" class="form-control" id="during_construction_percentage" name="during_construction_percentage" placeholder="e.g., 50%">
            </div>
            <div class="col-md-4">
              <label for="during_construction_amount" class="form-label">During Construction Amount</label>
              <input type="text" class="form-control" id="during_construction_amount" name="during_construction_amount" min="0" step="1000" placeholder="AED">
            </div>
            <div class="col-md-4">
              <label for="handover_percentage" class="form-label">Handover Percentage</label>
              <input type="text" class="form-control" id="handover_percentage" name="handover_percentage" placeholder="e.g., 40%">
            </div>
            <div class="col-md-4">
              <label for="handover_amount" class="form-label">Handover Amount</label>
              <input type="text" class="form-control" id="handover_amount" name="handover_amount" min="0" step="1000" placeholder="AED">
            </div>
            <div class="col-md-4">
              <label for="permit_no" class="form-label">Permit No</label>
              <input type="text" class="form-control" id="permit_no" name="permit_no" placeholder="Enter permit number">
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
  (function () {
    const textarea = document.getElementById('about_project');
    if (!textarea) {
      return;
    }

    const form = textarea.closest('form');

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
  })();
</script>
<?php
render_footer();
?>
