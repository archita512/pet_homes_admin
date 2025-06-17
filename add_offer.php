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
            .k-form-control{
                width: 100% !important;
            }
            .imgBox {
            border: 1px solid black;
            width: 230px;
            height: 200px;
        }
        .key_Add {
            width: 82% !important;
        }
    </style>
        <style>
    
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
          if (isset($_GET['id']) && !empty($_GET['id'])) {
              $id_a=$_GET['id'];
              $id=encryptor('decrypt', $id_a);
              $query = mysqli_query($cnn, "select * from offer where id=" . $id . "");
              $row = mysqli_fetch_array($query);
              $name = $row['name'];
            
                $image = $row['image']; // Already an array
           
              // $cat_id = $row['cat_id'];
             
            //   $price = $row['price'];
              $description = $row['des'];
              // $key = $row['key'];
              // $value = $row['value'];
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
            <h2 class="k-modal-title ps-4"><?php if(isset($_GET['id'])){ echo 'Updated Offer'; } else { echo 'Add Offer'; } ?></h2>
          </div>
          <form id="frm" action="" method="POST" enctype="multipart/form-data">
          <div class="card" style="width: 1517px; margin-left: 50px; margin-top: 30px;height: auto;">
          <div class="k-modal-body">
          <div class="row">
            <div class="col-sm-6">
                <div>
                <input id="txtUId" name="txtUId" value="<?php if (isset($_GET['id'])) {
                    echo $row['id'];
                } ?>" hidden />

                
               
                    <div class="mb-3">
                        <div class="k-form-group">
                                <label class="k-form-label">Offer Name</label>
                                <input
                                type="text"
                                class="k-form-control"
                                placeholder="Service Name"
                                name="name"
                                id="name"
                                value="<?php if (isset($_GET['id'])) {
                                    echo $name;
                                } ?>"
                                />
                            </div>
                            </div>
                           
                        
                            <div class="mb-3">
                        <div class="k-form-group">
                                <label class="k-form-label">Description</label>
                                <textarea
                                cols="5"
                                rows="3"
                              
                                class="k-form-control"
                                placeholder="Description"
                                name="des"
                                id="des"
                              
                                ><?php if(isset($_GET['id'])) {  echo $description; } ?></textarea>
                            </div>
                            </div>
                   
                    </div>
              </div>
                <div class="col-sm-6">
                <div class="k-form-group" style="margin-top: -19px;">
                            <label for="image" class="k-form-label mt-3">Image</label>
                        <input type="file" id="image" name="image" accept="image/*" class="k-form-control" value="<?php if (isset($_GET['id'])) {
                            echo $image;
                        } ?>"/><br>
                        </div>
                        <div class="mt-4">
                <img src="<?php if (isset($_GET['id'])) {
                    echo "../pet_homes/img/" . $image;
                } ?>" id="txtImport" name="txtImport" class="imgBox" width="100%" height="100%" style="margin-left: 128px;" />
                </div>
                        </div>
                  
                    <!-- </div> -->
            </div>
      
            <div class="k-modal-footer">
                <button type="button" class="k-btn-cancel" onclick="window.location.href='offer.php'">Cancel</button>
                <button type="submit" name="<?php echo isset($_GET['id']) ? 'btnUpdate' : 'btnSubmit'; ?>"
                    id="<?php echo isset($_GET['id']) ? 'btnUpdate' : 'btnSubmit'; ?>" class="k-btn-save">Save</button>
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
    <script src="js/offer.js"></script>
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

      function setupRemoveButtons() {
    document.querySelectorAll('.k-btn-remove').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('.key-value-pair'); // Find the closest row
            if (row) {
                row.remove(); // Remove the row
            }
        });
    });
}

// Call this function after the DOM is loaded and whenever you add new rows
setupRemoveButtons();
      $("#image").on("change", function () {
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

document.getElementById('addMoreBtn').addEventListener('click', function() {
    var container = document.getElementById('keyValueContainer');
    var newRow = document.createElement('div');
    newRow.className = 'row key-value-pair'; // Add the same class for styling
    newRow.innerHTML = `
        <div class="col-sm-4">
            <div class="k-form-group">
                <label class="k-form-label">Key</label>
                <input type="text" class="k-form-control key_Add" placeholder="key" name="key[]" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="k-form-group">
                <label class="k-form-label">Value</label>
                <input type="text" class="k-form-control key_Add" placeholder="Value" name="value[]" />
            </div>
        </div>
        <div class="col-sm-4" style="margin-top: 40px;">
            <a class="k-btn-remove btn_key" style="text-decoration:none;color:#976239">Remove</a>
        </div>
    `;
    container.appendChild(newRow);

    // Add event listener for the remove button
    newRow.querySelector('.k-btn-remove').addEventListener('click', function() {
        container.removeChild(newRow); // Remove the new row when clicked
    });
});
    </script>
  </body>
</html>
<!-- <button type="button" class="btn btn-sm btn-danger position-absolute" 
                                //         style="top: 5px;right: 29px;padding: 0 5px;width: 23px;">
                                //     &times;
                                // </button> -->
