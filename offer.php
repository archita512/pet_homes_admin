<?php
include 'connection.php';
include 'config.php'; 
session_start();
// print_r($_SESSION);
if (!isset($_SESSION["admin"]) && $_SESSION['admin'] == NULL ||$_SESSION["admin"] == "") {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pet Admin Dashboard</title>

    <!-- CSS Libraries -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- DataTables CSS - Bootstrap 5 version -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/category.css" />
  </head>
  <style>
    .k-pet-box img {
    max-width: 92px !important;
    max-height: 51px !important;
    object-fit: contain;
}
.k-pet-box {
    width: 35px;
    background-color: #ebebeb00 !important;
}
  </style>
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
            <h4 class="mb-1">Offers</h4>
            <nav class="k-breadcrumb small">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                  <a href="#" class="k-link-text-color text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active k-link-text-color-active">
                  Offers
                </li>
              </ol>
            </nav>
          </div>
          <div class="d-flex align-items-center justify-content-center">
           
            <div>
              <a
              href="add_offer.php"
                class="k-add-btn d-flex align-items-center justify-content-center text-decoration-none"
              >
                <i class="fas fa-plus me-1 k-icon-plus"></i>
                <p class="p-0 m-0">Add</p>
              </a>
            </div>
          </div>
        </div>

        <!-- Table Container -->
        <div class="k-table-container d-flex flex-column justify-content-between">
          <div class="table-responsive">
            <table id="tbl_cat" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th style="width: 15%;">Image</th>

                  <th>Name</th>
               
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query = mysqli_query($cnn,"SELECT * FROM `offer` ORDER BY id DESC");
                  $cnt = 1;
                  while($row = mysqli_fetch_array($query)){
                    $c_id = encryptor('encrypt',$row['id']);
  
                    echo '<tr class="k-tr">
                        <td>#' . $cnt . '</td>
                        <td>
                          <div class="k-pet-box">
                            <img src="../pet_homes/img/' . $row['image'] . '" alt="dog" />
                          </div>
                        </td>

                        <td>' . $row['name'] . '</td>
                       
                        <td class="status">
                          <label class="toggle-switch">
                              <input type="checkbox" value="' . ($row['status'] === 'Active' ? '1' : '0') . '" ' . ($row['status'] === 'Active' ? 'checked' : '') . ' class="status-checkbox" data-id="' . $row['id'] . '">
                              <span class="toggle-slider"></span>
                          </label>
                        </td>
                        <td class="action-buttons">
                          <a href="#" 
                                class="edit-btn text-decoration-none" 
                                data-bs-toggle="modal" 
                                data-bs-target="#accessoryDetailModal"
                                data-description="' . htmlspecialchars($row['des']) . '"> <!-- Added data-description attribute -->
                                <img src="images/view.png" alt="" style="width: 24px;height: 25px;" />
                          </a>
                            <a href="add_offer.php?id=' . $c_id . '" class="edit-btn text-decoration-none">
                                <img src="images/update.svg" alt="" />
                            </a>
                            <div class="delete-btn" data-id="' . $row['id'] . '" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                <img src="images/delete.svg" alt="" />
                            </div>
                        </td>
                      </tr>'; // Corrected closing of the echo statement
  
                    $cnt++;
                  } // Correctly closing the while loop
                  ?>
                
              </tbody>
            </table>
          </div>

          <!-- Empty State -->
          <!-- <div class="k-empty-state">
            <img src="images/no-data.png" alt="No Data" />
            <p>No data Available</p>
          </div> -->
        </div>
      </div>
    </div>

    <!-- offcanvas sidebar -->
    <div
      class="offcanvas offcanvas-start"
      tabindex="-1"
      id="offcanvasExample"
      aria-labelledby="offcanvasExampleLabel">
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
            <button type="button" class="k-delete-confirm-btn d_deletebtn">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for displaying accessory details -->
    <div class="modal fade" id="accessoryDetailModal" tabindex="-1" aria-labelledby="accessoryDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="accessoryDetailModalLabel">Service Description</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="des"></p>
       
        <!-- Add more fields as necessary -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



    <!-- JavaScript Libraries - Order is important! -->
    <!-- jQuery must come first -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- DataTable Initialization -->
    <script>
      $(document).ready(function() {
    $('#tbl_cat').DataTable(); // Initialize DataTable
});

document.getElementById('accessoryDetailModal').addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // Button that triggered the modal
    const description = button.getAttribute('data-description'); // Get the description from data-* attribute

    // Update the modal's content
    const modalContent = this.querySelector('#des'); // Select the paragraph for description
    modalContent.textContent = description; // Set the description text
});



const deleteCategoryModal = document.getElementById('deleteConfirmModal');
deleteCategoryModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // Button that triggered the modal
    const categoryId = button.getAttribute('data-id'); // Extract info from data-* attributes
    const message = `Are you sure you want to delete Offer?`;

    console.log(categoryId);
    
    // Update the modal's content
    const modalMessage = deleteCategoryModal.querySelector('.modal-body p'); // Corrected selector to target the paragraph
    modalMessage.textContent = message; // Update the message in the modal

    // Add event listener for the delete button
    const deleteButton = deleteCategoryModal.querySelector('.d_deletebtn');
    deleteButton.onclick = function() {
        fetch(`crud.php?what=delete_offer`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: categoryId }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Category deleted successfully');
                location.reload(); // Reload the page to see the changes
            } else {
                console.error('Error deleting category');
            }
        })
        .catch(error => console.error('Error:', error));
    };
});
  // Live update for status checkbox
  const statusCheckboxes = document.querySelectorAll('.status-checkbox');
        statusCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const id = this.getAttribute('data-id');
                const status = this.checked ? 'Active' : 'Block';

                // AJAX request to update status
                fetch('crud.php?what=update_status_offer', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: id, status: status }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Status updated successfully');
                    } else {
                        console.error('Error updating status');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });

   
    </script>
    
   
  </body>
</html>