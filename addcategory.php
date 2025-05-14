<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add category</title>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/category.css" />
    <link rel="stylesheet" href="css/addcategory.css" />
  </head>
  <body>
    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <div class="k-content">
      <div class="k-add-content">
       <?php include 'header.php'; ?>
        <div class="k-modal">
          <div class="add-btn">
            <h2 class="k-modal-title ps-4">Add Category</h2>
          </div>
          <form id="frm" action="" method="POST" enctype="multipart/form-data">
          <div class="card" style="width: 889px; margin-left: 50px; margin-top: 30px;">
          <div class="k-modal-body">
            <div class="k-form-group">
              <label class="k-form-label">Category</label>
              <input
                type="text"
                class="k-form-control"
                name="name"
                id="name"
                placeholder="Category Name"
              />
            </div>
            
            <div class="k-form-group">
              <div class="k-image-upload-area" id="dropArea">
                <input
                  type="file"
                  id="fileInput"
                  name="fileInput"
                  class="k-file-input"
                  accept=".jpg,.png"
                  hidden
                />
                <div class="k-upload-icon">
                  <img src="images/upload.svg" alt="" />
                </div>
                <p class="k-upload-text">
                  Drag your image or <a href="#" id="browseLink">browse</a>
                </p>
                <p class="k-file-info">Max 10 MB files are allowed</p>
              </div>
              <div class="k-file-type-info">Only support .jpg, .png files.</div>

              <!-- File Upload Preview -->
              <div
                class="k-file-preview"
                id="filePreview"
                style="display: none"
              >
                <div class="k-file-details">
                  <div class="k-file-icon">
                    <span class="k-file-extension">JPG</span>
                  </div>
                  <div class="k-file-info-container">
                    <div class="k-file-name" id="fileName">dog.jpg</div>
                    <div class="k-file-size" id="fileSize">500kb</div>
                  </div>
                  <button class="k-file-remove" id="removeFile">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <div class="k-progress-container">
                  <div class="k-progress-bar" id="progressBar"></div>
                  <div class="k-progress-percentage" id="progressPercentage">
                    60%
                  </div>
                </div>
              </div>

              <!-- Failed Upload Preview -->
              <div
                class="k-file-failed"
                id="fileFailedPreview"
                style="display: none"
              >
                <div class="k-file-icon">
                  <img id="failedFileThumb" src="" alt="File Thumbnail" />
                </div>
                <div class="k-file-info-container">
                  <div class="k-file-name" id="failedFileName">dog.jpg</div>
                  <div class="k-file-status">Upload failed</div>
                </div>
                <div class="k-file-actions">
                  <button class="k-file-delete" id="deleteFailedFile">
                    <i class="fas fa-trash"></i>
                  </button>
                  <button class="k-file-retry" id="retryFailedFile">
                    <i class="fas fa-redo-alt"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="k-modal-footer">
          <button class="k-btn-cancel" onclick="window.location.href='category.php'">Cancel</button>
          <button type="submit" name="btnSubmit" id="btnSubmit" class="k-btn-save">Save</button>
          </div>
        </div>
        </form>
        </div>
      </div>
    </div>

    <!-- offcanvas sidebar -->
    <div
      class="offcanvas offcanvas-start"
      tabindex="-1"
      id="offcanvasExample"
      aria-labelledby="offcanvasExampleLabel"
    >
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <div class="k-sidebar" id="sidebar">
          <!-- Sidebar content remains the same -->
          <div class="k-logo">
            <div>
              <p class="p-0 m-0 text-start text-lg-center">LOGO</p>
            </div>
            <div>
              <button
                class="k-close-sidebar"
                id="closeSidebar"
                data-bs-dismiss="offcanvas">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <ul class="k-sidebar-menu">
            <li>
              <a href="#">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="#" class="active d-flex align-items-center">
                <img src="images/s2.svg" alt="" class="text-dark" />
                <span class="ps-2">Category</span>
              </a>
            </li>
            <li>
              <a href="#" class="d-flex align-items-center">
                <i class="fas fa-layer-group"></i>
                <span>Subcategory</span>
              </a>
            </li>
            <li>
              <a href="#" class="d-flex align-items-center">
                <i class="fas fa-paw"></i>
                <span>Pets</span>
              </a>
            </li>
            <li>
              <a href="#" class="d-flex align-items-center">
                <i class="fas fa-shopping-basket"></i>
                <span>Accessories</span>
              </a>
            </li>
            <li>
              <a href="#" class="d-flex align-items-center">
                <i class="fas fa-concierge-bell"></i>
                <span>Services</span>
              </a>
            </li>
            <li>
              <a href="#" class="d-flex align-items-center">
                <i class="fas fa-user"></i>
                <span>User</span>
              </a>
            </li>
            <li>
              <a href="#" class="d-flex align-items-center">
                <i class="fas fa-history"></i>
                <span>Adoption History</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
            
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/css/bootstrap-toaster.min.css" integrity="sha512-613efYxCWhUklTCFNFaiPW4q6XXoogGNsn5WZoa0bwOBlVM02TJ/JH7o7SgWBnJIQgz1MMnmhNEcAVGb/JDefw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/css/bootstrap-toaster.css" integrity="sha512-DkcySkzTXJAPu18869uNSKlHOcm9UKvy4phZvC3b60guZveNCHI79sTM3wGJRNaqWSm9/7s07ztsgjonhJhI3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/js/bootstrap-toaster.js" integrity="sha512-vG793m0UbmHpDP9w5eGmPczh4JJ5HUZKi+WBReYTPzaefQ/eLInVo/MeDYvnE0LsM7NlUbgtf/jGG5c6JmO6Pg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/js/bootstrap-toaster.min.js" integrity="sha512-bPZBFTQxrZnfFHJqMjP9VVXVigWPjrDHWoPVgsdo2hGNUEY9WF9HQjWfvWnFEduF9cwmsbtKoQ9QkiPkTTUHwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/fileUpload.js"></script>
    <script src="js/catgeory.js"></script>
  </body>
</html>
