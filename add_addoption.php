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
    <title>Add Pets</title>
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
    <link rel="stylesheet" href="css/profile.css" />
  </head>
    <style>
      .box {
          border: 1px solid #EFAEA5;
          border-radius: 15px;
          transition: transform 0.2s ease;
      }
      

            .k-form-control{
                width: 100% !important;
            }
            .card_pet{
              padding: 21px 26px;
            }
            /* Optional: Add some smooth transitions */
              #selectedPetContainer {
                  transition: opacity 0.3s ease-in-out;
              }

              #defaultMessage {
                  transition: opacity 0.3s ease-in-out;
              }

              /* Optional: Add hover effect for the pet card */
              .card:hover {
                  transform: translateY(-2px);
                  transition: transform 0.2s ease-in-out;
                  box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
              }
    </style>
        <style>
                    p {
                    margin-top: 0;
                    margin-bottom: 0.2rem;
                }
                #imagePreviewContainer {
                    display: flex;
                    flex-wrap: wrap; /* Allows wrapping to the next line if necessary */
                    gap: 10px; /* Space between images */
                }
                .image-preview {
                    position: relative;
                    width: 150px; /* Set a fixed width for each image */
                }
                .image-preview img {
                    width: 90%;
                    height: 108px; /* Set a fixed height for each image */
                    object-fit: cover; /* Maintain aspect ratio */
                }

        </style>
        <?php
              // First, fetch all pets data and store in JavaScript-accessible format
          // First, fetch all pets data and store in JavaScript-accessible format
          $pets_data = [];
          $query = mysqli_query($cnn, "SELECT * FROM pets WHERE status='Active'");
          while ($pet = mysqli_fetch_array($query)) {
              // Decode the JSON array of images and get the first image
              $images = json_decode($pet['image'], true); // Added 'true' for associative array
              $first_image = isset($images[0]) ? $images[0] : 'default.jpg'; // Fallback to default image
              
              $pets_data[] = [
                  'id' => $pet['id'],
                  'name' => $pet['name'],
                  'description' => $pet['des'],
                  'age' => $pet['pet_age'],
                  'image' => $first_image,
                  'country' => $pet['country'],
                  'price' => $pet['price'],
                  'type_listing' => $pet['type_listing'],
                  'gender' => $pet['pet_gander'],
                  'weight' => $pet['pet_weight'],
                  'color' => $pet['pet_color']

                ];
            }
            ?>
    <body>
    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <div class="k-content">
      <div class="k-add-content">
       <?php include 'header.php'; ?>
        <div class="k-modal">
          <div class="add-btn">
            <h2 class="k-modal-title ps-4"><?php if(isset($_GET['id'])){ echo 'Updated Addoption Pet'; } else { echo 'Add Addoption Pet'; } ?></h2>
          </div>
          <form id="frm" action="" method="POST" enctype="multipart/form-data">
          <div class="card" style="width: 1517px; margin-left: 50px; margin-top: 30px;height: auto;">
          <div class="k-modal-body">
          <div class="row">
            <div class="col-sm-12">
                <div>
                <input id="txtUId" name="txtUId" value="<?php if (isset($_GET['id'])) {
                    echo $row['id'];
                } ?>" hidden />

                <div class="mb-3">
                    <div class="k-form-group">
                        <label class="k-form-label">Pets</label>
                        <select name="pet_id" id="pet_id" class="k-form-control" onchange="showSelectedPet()">
                            <option value="">Select Pets</option>
                            <?php
                            // Retrieve the category ID if updating
                            if (isset($_GET['id'])) {
                                $id = $row['id']; // Use cat_id for comparison
                            }
                            $query = mysqli_query($cnn, "SELECT * FROM pets WHERE status='Active'");    
                            while ($category = mysqli_fetch_array($query)) { // Changed variable name to avoid conflict
                                $selected = (isset($_GET['id']) && $category['id'] == $id) ? 'selected' : '';  // Ensure correct comparison
                                echo "<option value='".$category['id']."' $selected>".$category['name']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            

                </div>
              </div>
            
              <div class="row">
                  <div id="selectedPetContainer" style="display: none;">
                      <div class="col-md-12">
                          <div class="card mb-4 shadow-sm box d-flex flex-row align-items-center p-3" style="height: 220px;">
                              <img id="petImage" src="" class="card-img" alt="" style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
                              <div class="ms-4">
                                  <b><h5 id="petName" class="card-title mb-2"></h5></b>
                                  
                                  <div class="row">
                                  <div class="col-sm-6">
                                    <p class="card-text">
                                      <b>Gender:</b> <span id="petgender"></span>
                                    </p>
                                    <p class="card-text">
                                      <b>Age:</b> <span id="petAge"></span>
                                    </p>
                                    <p class="card-text">
                                      <b>Country:</b> <span id="petcountry"></span>
                                    </p>
                                    <p class="card-text">
                                      <b>Price:</b> <span id="petprice"></span>
                                    </p>
                                  </div>
                                    <div class="col-sm-6">

                                    <p  class="card-text">
                                    <b>Listing:</b><span id="pettype_listing"></span>
                                    </p>
                                    <p class="card-text">
                                      <b>Pets Weight: </b><span id="petweight"></span>
                                    </p>
                                    <p id="" class="card-text">
                                      <b>Pets Color: </b><span id="petcolor"></span>
                                    </p>
                                  </div>
                                  </div>
                                  
                                  <p id="petDescription" class="card-text mt-3"></p>
                                 
                              </div>
                          </div>
                      </div>
               </div>

            
            <!-- Default message when no pet is selected -->
                <div id="defaultMessage" class="col-md-12">
                    <div class="card mb-4 shadow-sm box d-flex justify-content-center align-items-center p-3" style="height: 220px;">
                        <p class="text-muted">Please select a pet to view details</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
              <div class="col-sm-6">
                <div>
                  <div class="mb-3">
                    <div class="k-form-group">
                      <label class="k-form-label">Name</label>
                      <input type="text" class="form-control" id="pname" name="pname" placeholder="Enter Person name">
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="k-form-group">
                    <label class="k-form-label">Addoption Date</label>
                    <input type="date" name="a_date" id="a_date" class="form-control">
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <div class="k-form-group">
                    <label class="k-form-label">Address</label>
                    <textarea class="form-control" id="add" name="add" cols="3" rows="3" placeholder="Enter Address"></textarea>
                    </div>
                  </div>
                 
                  
                </div>
              </div>
                
                <div class="col-sm-6">
                <div>
                <div class="mb-3">
                    <div class="k-form-group">
                        <label class="k-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"  placeholder="Enter Email">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="k-form-group">
                        <label class="k-form-label">Mobile No</label>
                        <input type="tel" class="form-control" id="mno" name="mno" placeholder="Enter Mobile No.">
                    </div>
                </div>
                
               <!-- Hidden inputs to hold values for backend -->
                <input type="hidden" name="totalCost" id="totalCostInput">
                <input type="hidden" name="billingPrice" id="billingPriceInput">

                <div class="card p-3 shadow-sm" style="max-width: 400px;">
                  <h5 class="mb-3">Billing Details</h5>

                  <div class="d-flex justify-content-between mb-2">
                    <span>Price:</span>
                    <strong>$<span id="billingPrice">0</span></strong>
                  </div>

                  <div class="d-flex justify-content-between mb-2">
                    <span>Discount:</span>
                    <input type="number" class="form-control" id="discount" name="discount" value="0" style="width: 71px;" min="0" max="50" inputmode="numeric">
                  </div>

                  <div class="d-flex justify-content-between border-top pt-2">
                    <span>Total Cost:</span>
                    <strong>$<span id="totalCost">0</span></strong>
                  </div>
                </div>
                 
            </form>
            </div>
          </div>
          <div class="k-modal-footer">
              <button type="button" class="k-btn-cancel" onclick="window.location.href='addoption.php'">Cancel</button>
              <button type="submit"  name="<?php echo isset($_GET['id']) ? 'btnUpdate' : 'btnSubmit'; ?>"
              id="<?php echo isset($_GET['id']) ? 'btnUpdate' : 'btnSubmit'; ?>" class="k-btn-save">Save</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
            
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/css/bootstrap-toaster.min.css" integrity="sha512-613efYxCWhUklTCFNFaiPW4q6XXoogGNsn5WZoa0bwOBlVM02TJ/JH7o7SgWBnJIQgz1MMnmhNEcAVGb/JDefw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/css/bootstrap-toaster.css" integrity="sha512-DkcySkzTXJAPu18869uNSKlHOcm9UKvy4phZvC3b60guZveNCHI79sTM3wGJRNaqWSm9/7s07ztsgjonhJhI3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/js/bootstrap-toaster.js" integrity="sha512-vG793m0UbmHpDP9w5eGmPczh4JJ5HUZKi+WBReYTPzaefQ/eLInVo/MeDYvnE0LsM7NlUbgtf/jGG5c6JmO6Pg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/js/bootstrap-toaster.min.js" integrity="sha512-bPZBFTQxrZnfFHJqMjP9VVXVigWPjrDHWoPVgsdo2hGNUEY9WF9HQjWfvWnFEduF9cwmsbtKoQ9QkiPkTTUHwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/fileUpload.js"></script>
    <script src="js/addopt_pets.js"></script>
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
    
    <!-- <script src="js/chnage_password.js"></script> -->
    <script>
      $("#images").on("change", function () {
    var img = this;
    // console.log(img);
    if (img.files && img.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#txtImport").attr("src", e.target.result);
        }
        reader.readAsDataURL(img.files[0]);
    }

});
function removeImage(button, imgSrc) {
    // Remove the image preview from the DOM
    $(button).closest('.image-preview').remove();
    
    // Update the hidden input field to reflect the remaining images
    let existingImages = $('#existingImages').val().split(',');
    existingImages = existingImages.filter(img => img !== imgSrc.trim());
    $('#existingImages').val(existingImages.join(','));
    
    // Optionally, you can also update the displayed count of images if needed
    // For example, you can show a message or update a counter
}

    $(document).ready(function() {
        // Image preview functionality
        $('#images').on('change', function() {
            const previewContainer = $('#imagePreviewContainer');
            
            // Only clear existing previews if new files are selected
            if (this.files.length > 0) {
                previewContainer.empty(); // Clear existing previews
            }
            
            if (this.files) {
                const files = Array.from(this.files);
                
                // Check if too many files are selected (optional)
                if (files.length > 10) {
                    alert('Please select a maximum of 10 images');
                    this.value = '';
                    return;
                }
                
                files.forEach(file => {
                    if (!file.type.match('image.*')) {
                        return; // Skip non-image files
                    }
                    
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const preview = $(`
                            <div class="image-preview">
                                <img src="${e.target.result}" class="img-thumbnail">
                                
                            </div>
                        `);
                        
                        // Add remove functionality
                        preview.find('button').on('click', function() {
                            preview.remove(); // Remove the specific image preview
                        });
                        
                        previewContainer.append(preview);
                    };
                    
                    reader.readAsDataURL(file);
                });
            }
        });
    });

    function fetchSubcategories(categoryId) {
            if (categoryId) {
                $.ajax({
                    url: 'crud.php?what=fetch_subcategories', // Create this file to handle the request
                    type: 'POST',
                    data: { category_id: categoryId },
                    success: function(data) {
                        $('#subcat_id').html(data); // Populate subcategory dropdown
                    }
                });
            } else {
                $('#subcat_id').html('<option value="">Select Subcategory</option>'); // Reset subcategory dropdown
            }
        }


// Convert PHP array to JavaScript
const petsData = <?php echo json_encode($pets_data); ?>;

function showSelectedPet() {
    const selectElement = document.getElementById('pet_id');
    const selectedPetId = selectElement.value;
    const selectedPetContainer = document.getElementById('selectedPetContainer');
    const defaultMessage = document.getElementById('defaultMessage');
    
    if (selectedPetId === '') {
        // No pet selected, show default message
        selectedPetContainer.style.display = 'none';
        defaultMessage.style.display = 'block';
        return;
    }
    
    // Find the selected pet data
    const selectedPet = petsData.find(pet => pet.id == selectedPetId);
    if (selectedPet) {
        // Update the pet information with correct image path
        document.getElementById('petImage').src = '../pet_homes/img/' + selectedPet.image;
        document.getElementById('petImage').alt = selectedPet.name;
        document.getElementById('petName').textContent = selectedPet.name;
        document.getElementById('petDescription').textContent = selectedPet.description;
        document.getElementById('petAge').textContent = selectedPet.age;
        document.getElementById('petprice').textContent = '$' + selectedPet.price;
        document.getElementById('pettype_listing').textContent = selectedPet.type_listing;
        document.getElementById('petgender').textContent = selectedPet.gender;
        document.getElementById('petcolor').textContent = selectedPet.color;
        document.getElementById('petweight').textContent = selectedPet.weight;

        // Set billing price and reset discount
        updateBillingPrice(selectedPet.price);
        
        // Debug the country issue
        const countryElement = document.getElementById('petcountry');
        console.log('Country element:', countryElement);
        console.log('Country value:', selectedPet.country);

        if (countryElement && selectedPet.country) {
            countryElement.textContent = selectedPet.country;
        } else {
            console.log('Either country element not found or country value is missing');
        }

        // Show selected pet container and hide default message
        selectedPetContainer.style.display = 'block';
        defaultMessage.style.display = 'none';
        
        // Add smooth transition effect
        selectedPetContainer.style.opacity = '0';
        setTimeout(() => {
            selectedPetContainer.style.transition = 'opacity 0.3s ease-in-out';
            selectedPetContainer.style.opacity = '1';
        }, 10);
    }
}

// Initialize on page load if there's a pre-selected pet
document.addEventListener('DOMContentLoaded', function() {
    const selectElement = document.getElementById('pet_id');
    if (selectElement.value !== '') {
        showSelectedPet();
    }
    
    // Also add event listener for discount changes
    const discountInput = document.getElementById('discount');
    if (discountInput) {
        discountInput.addEventListener('input', updateTotalCost);
    }
});

function updateTotalCost() {
    const price = parseFloat(document.getElementById('billingPrice').innerText) || 0;
    const discountPercent = parseFloat(document.getElementById('discount').value) || 0;

    // Calculate discount amount and total
    const discountAmount = price * (discountPercent / 100);
    const total = price - discountAmount;

    // Update display - ensure we show proper decimal places
    document.getElementById('totalCost').innerText = total.toFixed(2);

    // Update hidden inputs for backend
    document.getElementById('totalCostInput').value = total.toFixed(2);
    document.getElementById('billingPriceInput').value = price.toFixed(2);
}

// Function to set billing price and reset everything properly
function updateBillingPrice(newPrice) {
    const price = parseFloat(newPrice) || 0;
    
    // Update billing price display
    document.getElementById('billingPrice').innerText = price.toFixed(2);
    
    // Reset discount to 0
    document.getElementById('discount').value = 0;
    
    // Update total cost (which will be same as price since discount is 0)
    document.getElementById('totalCost').innerText = price.toFixed(2);
    
    // Update hidden inputs
    document.getElementById('billingPriceInput').value = price.toFixed(2);
    document.getElementById('totalCostInput').value = price.toFixed(2);
}
    </script>
  </body>
</html>
<!-- <button type="button" class="btn btn-sm btn-danger position-absolute" 
                                //         style="top: 5px;right: 29px;padding: 0 5px;width: 23px;">
                                //     &times;
                                // </button> -->
