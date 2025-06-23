<?php
include 'connection.php';
include 'config.php'; 
session_start();
// print_r($_SESSION);
if (!isset($_SESSION["admin"]) && $_SESSION['admin'] == NULL ||$_SESSION["admin"] == "") {
    header("Location:login.php");
}
if(isset($_SESSION['admin'])){
  $email = $_SESSION['admin'];
  $query = mysqli_query($cnn,"SELECT * FROM `login` WHERE `email`='$email'");
  $row = mysqli_fetch_array($query);
  $id = $row['id'];
  $name = $row['name'];
  $mno = $row['mno'];
  $image = $row['image'];
  $gender = $row['gender'];
  
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
    <link rel="stylesheet" href="css/profile.css" />
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
            <h4 class="mb-1">Accessories</h4>
            <nav class="k-breadcrumb small">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                  <a href="#" class="k-link-text-color text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active k-link-text-color-active">
                  Accessories
                </li>
              </ol>
            </nav>
          </div>
          <div class="d-flex align-items-center justify-content-center">
           
            <div>
              <a
              href="add_accessories.php"
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
                  <th>Category Name</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                                $query = mysqli_query($cnn,"SELECT ac.name AS cat_name,a.* FROM accessories AS a JOIN acce_catgeory AS ac ON a.cat_id = ac.id ORDER BY a.id DESC");
                                $cnt = 1;
                                while($row = mysqli_fetch_array($query)){
                                  $c_id = encryptor('encrypt',$row['id']);
                
                                  $keyValueArray = explode(',', $row['key']); // Assuming 'key' is the column name
                                  $keyValueArray = array_unique($keyValueArray); // Remove duplicates
                                  $keyValueString = implode(', ', $keyValueArray); // Join with commas
                                  $key = str_replace(['[', ']', '"'], '', $keyValueString); // Remove brackets and quotes
                                  // print_r($key);
                                  // die();
                
                                  $ValueArray = explode(',', $row['value']); // Assuming 'value' is the column name
                                  $ValueArray = array_unique($ValueArray); // Remove duplicates
                                  $ValueString = implode(', ', $ValueArray); // Join with commas
                                  $value = str_replace(['[', ']', '"'], '', $ValueString); // Remove brackets and quotes
                                  echo '<tr class="k-tr">
                                     <td>#' . $cnt . '</td>
                                     <td>
                                       <div class="k-pet-box">
                                         <img src="../pet_homes/img/' . $row['image'] . '" alt="dog" />
                                       </div>
                                     </td>
                                     <td>' . $row['cat_name'] . '</td>
                                     <td>' . $row['name'] . '</td>
                                     <td>' . $row['price'] . '</td>
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
                                             data-key=\'' . json_encode($keyValueArray) . '\' 
                                             data-value=\'' . json_encode($ValueArray) . '\'>  
                                             <img src="images/view.png" alt="" style="width: 24px;height: 25px;" />
                                         </a>
                                         <a href="add_accessories.php?id=' . $c_id . '" class="edit-btn text-decoration-none">
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
          <a href="dashbord.php" class="d-flex align-items-center">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">
              <div>
                <i class="fas fa-paw"></i>
                <span class="ps-2">Pets</span>
              </div>
              <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>

            <ul class="submenu" style="    margin-left: 37px;">
              <li><a href="category.php" class="submenu-link">Category</a></li>
              <li><a href="subcategory.php" class="submenu-link">Subcategory</a></li>
              <li><a href="pets.php" class="submenu-link">Pets</a></li>
            </ul>
          </li>


        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">
              <div>
              <i class="fas fa-shopping-basket"></i>    
                <span class="ps-2">Accessories</span>
              </div>
              <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>

            <ul class="submenu" style="margin-left: 10px;">
              <li><a href="acc_category.php" class="submenu-link">Accessories Catgeory</a></li>
              <li><a href="accessories.php" class="submenu-link">Accessories</a></li>
              
            </ul>
          </li>

          <li>
          <a href="service.php" class="d-flex align-items-center">
            <i class="fas fa-concierge-bell"></i>
            <span>Services</span>
          </a>
        </li>
        <li>
          <a href="offer.php" class="d-flex align-items-center">
          <i class="bi bi-bookmark-star-fill"></i>
            <span>Offers</span>
          </a>
        </li>
        <li>
          <a href="banner.php" class="d-flex align-items-center">
          <i class="fa-solid fa-image"></i>
            <span>Banner</span>
          </a>
        </li>
         <li>
          <a href="Inquiry.php" class="d-flex align-items-center">
          <i class="bi bi-patch-question-fill"></i>
            <span>Inquiry</span>
          </a>
        </li>
       
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">
              <div>
              <i class="fa-solid fa-cat fa-flip-horizontal"></i>
                <span class="ps-2">Pet Adoption / Return</span>
              </div>
              <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>

            <ul class="submenu" style="margin-left: 10px;">
              <li><a href="addoption.php" class="submenu-link">Pet Adoption</a></li>
              <li><a href="pet_return.php" class="submenu-link">Pet Return</a></li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">
              <div>
              <i class="fa-solid fa-cart-shopping"></i>
                <span class="ps-2">Accessories Sale</span>
              </div>
              <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>

            <ul class="submenu" style="margin-left: 10px;">
              <li><a href="ass_pur.php" class="submenu-link">Accessories Sale</a></li>
              <li><a href="ass_retu.php" class="submenu-link">Accessories Return</a></li>
              
            </ul>
          </li>
       
        <li>
          <a href="service_m.php" class="d-flex align-items-center">
          <i class="fa-solid fa-house-chimney-medical"></i>

            <span>Services Maintain</span>
          </a>
        </li>
        <li>
          <a href="user_view.php" class="d-flex align-items-center">
          <i class="fa-solid fa-users"></i>
            <span>Users</span>
          </a>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">
              <div>
              <i class="fa-solid fa-circle-info"></i>
                <span class="ps-2">Others</span>
              </div>
              <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>

            <ul class="submenu" style="margin-left: 10px;">
              <li><a href="aboutus.php" class="submenu-link">About Us</a></li>
              <li><a href="terms.php" class="submenu-link">Terms & Condtiton</a></li>
              <li><a href="privacy.php" class="submenu-link">Privacy Policy</a></li>
             <li><a href="faq.php" class="submenu-link">FAQ Message</a></li>
              <li><a href="report.php" class="submenu-link">Report</a></li>
            </ul>
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
        <h5 class="modal-title" id="accessoryDetailModalLabel">Accessory Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="accessoryKey"></p>
        <p id="accessoryValue"></p>
        <!-- Add more fields as necessary -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade"
      id="changePasswordModal"
      tabindex="-1"
      aria-labelledby="changePasswordModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-bottom">
            <h5 class="modal-title fw-bold" id="changePasswordModalLabel">
              Change Password
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body py-3">
            <form id="frm" method="POST" action="">
            <input type="hidden" name="id" id="id" value="<?php if(isset($_SESSION['admin'])){ echo $id; } ?> ">
              <div class="mb-3">
                <label for="oldPassword" class="form-label">Old Password</label>
                <div class="position-relative">
                  <input
                    type="password"
                    class="form-control"
                    id="oldPassword"
                    name="oldPassword"
                    placeholder="Your Password"
                  />
                  <span
                    class="k-password-toggle position-absolute top-50 end-0 translate-middle-y pe-3"
                    onclick="togglePassword('oldPassword')"
                  >
                    <i class="fas fa-eye-slash"></i>
                  </span>
                </div>
              </div>
              <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <div class="position-relative">
                  <input
                    type="password"
                    class="form-control"
                    id="newPassword"
                    name="newPassword"
                    placeholder="Your Password"
                  />
                  <span
                    class="k-password-toggle position-absolute top-50 end-0 translate-middle-y pe-3"
                    onclick="togglePassword('newPassword')"
                  >
                    <i class="fas fa-eye"></i>
                  </span>
                </div>
              </div>
              <div class="mb-4">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <div class="position-relative">
                  <input
                    type="password"
                    class="form-control"
                    id="confirmPassword"
                    name="confirmPassword"
                    placeholder="Your Password"
                  />
                  <span
                    class="k-password-toggle position-absolute top-50 end-0 translate-middle-y pe-3"
                    onclick="togglePassword('confirmPassword')">
                    <i class="fas fa-eye-slash"></i>
                  </span>
                </div>
              </div>
              <div class="d-flex justify-content-center">
                <button
                  type="button"
                  class="k-btn-cancel"
                  data-bs-dismiss="modal">
                  Cancel
                </button>
                <button type="submit" class="k-btn-reset" name="btnchnage" id="btnchnage">
                  Reset Password
                </button>
              </div>
            </form>
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
    
    <!-- <script src="js/chnage_password.js"></script> -->
    <!-- DataTable Initialization -->
    <script>
      $("#btnchnage").click(function (event) {
       event.preventDefault(); // Prevent form from submitting normally

      // Check if any of the three fields are empty
      if($("#oldPassword").val() == "" || $("#newPassword").val() == "" || $("#confirmPassword").val() == "") {
        var toastHTML = `
                    <div aria-live="polite" aria-atomic="true" class="position-relative">
                        <div class="toast-container position-fixed top-0 end-0 p-3">
                            <div id="otpValidToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto">Error</strong>
                                    <small class="text-muted">just now</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body" style="background-color: #ec7063; color: white;"> 
                                 Fields are required.
                                </div>
                            </div>
                        </div>
                    </div>
                `;
        
        // Append the toast HTML to the body
        $('body').append(toastHTML);
        
        // Show the toast
        var toastEl = document.getElementById("otpValidToast");
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    
            } else {
                const json =  { "id" : $("#id").val(),"cpwd" : $("#oldPassword").val(),"npwd" : $("#newPassword").val(),"cnpwd" : $("#confirmPassword").val() };
                console.log(json);
                $.ajax({
                    type : "POST",
                    method: "POST",
                    url: "crud.php?what=admin_changepwd",
                    data: json,
                    dataType: "JSON",
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            // Create the toast HTML
                            var toastHTML = `
                                <div aria-live="polite" aria-atomic="true" class="position-relative">
                                    <div class="toast-container position-fixed top-0 end-0 p-3">
                                        <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="toast-header">
                                                <strong class="me-auto">Notification</strong>
                                                <small class="text-muted">just now</small>
                                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                            <div class="toast-body" style="background-color: #7dcea0; color: white;"> 
                                                ${response.message}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                    
                            // Append the toast HTML to the body
                            $('body').append(toastHTML);
                    
                            // Show the toast
                            var toastEl = document.getElementById("successToast");
                            var toast = new bootstrap.Toast(toastEl);
                            toast.show();
                    
                            // Redirect after 2 seconds
                            setTimeout(function() {
                                location.reload();
                            }, 2000); // 2000 milliseconds = 2 seconds
                        }
                        else{
                            var toastHTML = `
                                <div aria-live="polite" aria-atomic="true" class="position-relative">
                                    <div class="toast-container position-fixed top-0 end-0 p-3">
                                        <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="toast-header">
                                                <strong class="me-auto">Notification</strong>
                                                <small class="text-muted">just now</small>
                                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                            <div class="toast-body" style="background-color: #ec7063; color: white;"> 
                                                ${response.message}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                    
                            // Append the toast HTML to the body
                            $('body').append(toastHTML);
                    
                            // Show the toast
                            var toastEl = document.getElementById("errorToast");
                            var toast = new bootstrap.Toast(toastEl);
                            toast.show();
                    
                            // Redirect after 2 seconds
                            setTimeout(function() {
                              
                            }, 2000); // 2000 milliseconds = 2 seconds
                        }
                        
                    }
                }); 
            }
            
        });


        function togglePassword(inputId) {
              var input = document.getElementById(inputId);
              if (input.type === "password") {
                input.type = "text"; // Change to text to show password
                // Change icon to eye
                document.querySelector(`#${inputId} + .k-password-toggle i`).classList.remove('fa-eye-slash');
                document.querySelector(`#${inputId} + .k-password-toggle i`).classList.add('fa-eye');
              } else {
                input.type = "password"; // Change back to password to hide
                // Change icon to eye-slash
                document.querySelector(`#${inputId} + .k-password-toggle i`).classList.remove('fa-eye');
                document.querySelector(`#${inputId} + .k-password-toggle i`).classList.add('fa-eye-slash');
              }
            }
    </script>
    <script>
      $(document).ready(function() {
    $('#tbl_cat').DataTable(); // Initialize DataTable
});

document.getElementById('accessoryDetailModal').addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const accessoryKey = button.getAttribute('data-key');
    const accessoryValue = button.getAttribute('data-value');

    const modalContent = this.querySelector('.modal-body'); // Select the modal body
    modalContent.innerHTML = ''; // Clear previous content

    if (accessoryKey && accessoryValue) {
        try {
            const keysArray = JSON.parse(accessoryKey);
            const valuesArray = JSON.parse(accessoryValue);

            const formattedDetails = keysArray
                .map((key, index) => {
                    const cleanKey = key.replace(/"/g, '').trim().replace(/^\[|\]$/g, '');
                    const cleanValue = valuesArray[index] ? valuesArray[index].replace(/"/g, '').trim().replace(/^\[|\]$/g, '') : '';
                    return `${cleanKey}: ${cleanValue}`;
                })
                .filter(detail => detail.split(': ')[1] !== '')
                .join('<br>');

            modalContent.innerHTML = formattedDetails || '<em>No accessory detail stored</em>';
        } catch (error) {
            console.error('Error parsing JSON:', error);
            modalContent.innerHTML = '<em>No accessory detail stored</em>';
        }
    } else {
        modalContent.innerHTML = '<em>No accessory detail stored</em>';
    }
});


const deleteCategoryModal = document.getElementById('deleteConfirmModal');
deleteCategoryModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // Button that triggered the modal
    const categoryId = button.getAttribute('data-id'); // Extract info from data-* attributes
    const message = `Are you sure you want to delete Accessories?`;

    console.log(categoryId);
    
    // Update the modal's content
    const modalMessage = deleteCategoryModal.querySelector('.modal-body p'); // Corrected selector to target the paragraph
    modalMessage.textContent = message; // Update the message in the modal

    // Add event listener for the delete button
    const deleteButton = deleteCategoryModal.querySelector('.d_deletebtn');
    deleteButton.onclick = function() {
        fetch(`crud.php?what=delete_accessories`, {
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
                fetch('crud.php?what=update_status_acceccrios', {
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