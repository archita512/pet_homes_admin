<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pet Admin Dashboard</title>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      rel="stylesheet"
    />
    <!-- custom css -->
    <link rel="stylesheet" href="css/category.css" />
  </head>
  <body>
    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <div class="k-content">
      <!-- Header -->
   <?php include 'header.php'; ?>

      <!-- Page Content -->
      <div class="k-page-content">
        <div class="k-page-header">
          <div>
            <h4 class="mb-1">Category</h4>
            <nav class="k-breadcrumb small">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                  <a href="#" class="k-link-text-color text-decoration-none"
                    >Dashboard</a
                  >
                </li>
                <li class="breadcrumb-item active k-link-text-color-active">
                  Category
                </li>
              </ol>
            </nav>
          </div>
          <div class="d-flex align-items-center justify-content-center">
            <div class="input-group me-4">
              <input
                type="text"
                class="form-control k-input"
                placeholder="Search..."
              />
            </div>
            <div>
              <a
              href="addcategory.php"
                class="k-add-btn d-flex align-items-center justify-content-center text-decoration-none"
              >
                <i class="fas fa-plus me-1 k-icon-plus"></i>
                <p class="p-0 m-0">Add</p>
              </a>
            </div>
          </div>
        </div>

        <!-- Table Container -->
        <div
          class="k-table-container d-flex flex-column justify-content-between"
        >
          <div class="table-responsive">
            <table class="table k-table">
              <thead>
                <tr>
                  <th>ID <i class="fas fa-sort ms-1"></i></th>
                  <th>Image <i class="fas fa-sort ms-1"></i></th>
                  <th>Name <i class="fas fa-sort ms-1"></i></th>
                  <th>Status <i class="fas fa-sort ms-1"></i></th>
                  <th>Action <i class="fas fa-sort ms-1"></i></th>
                </tr>
              </thead>
              <tbody>
                <tr class="k-tr">
                  <td>1</td>
                  <td>
                    <div class="k-pet-box">
                      <img src="images/dog.png" alt="dog" />
                    </div>
                  </td>
                  <td>Dog</td>
                  <td>
                    <label class="toggle-switch">
                      <input type="checkbox" checked />
                      <span class="toggle-slider"></span>
                    </label>
                  </td>
                  <td class="action-buttons">
                    <a href="editcategory.html" class="edit-btn text-decoration-none">
                      <img src="images/update.svg" alt="" />
                    </a>
                    <div class="delete-btn">
                      <img src="images/delete.svg" alt="" />
                    </div>
                  </td>
                </tr>
                <tr class="k-tr">
                  <td>2</td>
                  <td>
                    <div class="k-pet-box">
                      <img src="images/cat.png" alt="cat" />
                    </div>
                  </td>
                  <td>Cat</td>
                  <td>
                    <label class="toggle-switch">
                      <input type="checkbox" checked />
                      <span class="toggle-slider"></span>
                    </label>
                  </td>
                  <td class="action-buttons">
                    <button class="edit-btn">
                      <img src="images/update.svg" alt="" />
                    </button>
                    <button class="delete-btn">
                      <img src="images/delete.svg" alt="" />
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Empty State -->
          <!-- <div class="k-empty-state">
            <img src="images/no-data.png" alt="No Data" />
            <p>No data Available</p>
          </div> -->

          <!-- Pagination -->
          <div class="k-pagination pt-3">
            <div>Showing 0 of 0</div>
            <div>
              <nav>
                <ul class="pagination p-0 m-0">
                  <li class="page-item k-prev">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item">
                    <a class="page-link text-black" href="#">1/10</a>
                  </li>
                  <li class="page-item k-next">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
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
                data-bs-dismiss="offcanvas"
              >
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content k-delete-modal">
          <div class="modal-header k-modal-header">
            <h5 class="modal-title k-modal-title" id="deleteConfirmModalLabel">Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center py-4">
            <div class="k-warning-icon mb-3">
              <img src="images/delete-conform.png" alt="">
            </div>
            <h4 class="mb-3">Are you sure?</h4>
            <p class="text-muted">Once deleted, you will not able to recover this data.</p>
          </div>
          <div class="modal-footer k-modal-footer">
            <button type="button" class="k-cancel-btn" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="k-delete-confirm-btn">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <!-- Add JavaScript for delete modal functionality -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Get all delete buttons
        const deleteButtons = document.querySelectorAll('.delete-btn');
        
        // Add click event to all delete buttons
        deleteButtons.forEach(button => {
          button.addEventListener('click', function() {
            // Show the delete confirmation modal
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            deleteModal.show();
          });
        });
      });
    </script>
  </body>
</html>
