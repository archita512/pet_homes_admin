<?php
  session_start();
  include 'connection.php';
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
    <title>Profile</title>
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
      <div class="k-profile-container">
        <h2 class="mb-4">Profile</h2>
        <div class="k-profile">
          <!-- Profile View Section -->
          <div class="k-profile-view">
            <div class="k-profile-header">
              <div class="k-profile-bg"></div>
              <div class="k-profile-img">
                <img src="images/profile-img.png" alt="Profile Image" />
              </div>
              <h4 class="k-profile-name"><?php echo $name; ?></h4>
              <p class="k-profile-email">wadewarren123@gmail.com</p>
            </div>

            <div class="k-profile-info">
              <h5 class="mb-3">Personal Info</h5>
              <div class="k-profile-info-item">
                <div class="k-profile-info-label">Full Name</div>
                <div class="k-profile-info-value">: Wade Warren</div>
              </div>
              <div class="k-profile-info-item">
                <div class="k-profile-info-label">Email</div>
                <div class="k-profile-info-value text-nowrap text-truncate">
                  : wadewarren123@gmail.com
                </div>
              </div>
              <div class="k-profile-info-item">
                <div class="k-profile-info-label">Contact Number</div>
                <div class="k-profile-info-value">: (403) 555-0128</div>
              </div>
              <div class="k-profile-info-item">
                <div class="k-profile-info-label">Gender</div>
                <div class="k-profile-info-value">: Male</div>
              </div>
            </div>
          </div>

          <!-- Profile Edit Section -->
          <div class="k-profile-edit">
            <h4 class="k-profile-edit-title">Edit Profile</h4>
            <div class="k-profile-edit-img">
              <img
                src="images/profile-img.png"
                alt="Profile Image"
                id="profilePreview"
              />
              <div
                class="camera-icon"
                onclick="document.getElementById('profileImageInput').click()"
              >
                <i class="fas fa-camera"></i>
              </div>
              <input
                type="file"
                id="profileImageInput"
                accept="image/*"
                style="display: none"
                onchange="previewImage(this)"
              />
            </div>

            <form class="k-profile-edit-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="name">Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    value="Wade Warren"
                  />
                </div>
                <div class="col-md-6 form-group">
                  <label for="email">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    value="wadewarren123@gmail.com"
                  />
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-md-6 form-group">
                  <label for="contact">Contact</label>
                  <input
                    type="text"
                    class="form-control"
                    id="contact"
                    value="Wade Warren"
                  />
                </div>
                <div class="col-md-6 form-group">
                  <label for="gender">Gender</label>
                  <select class="form-select" id="gender">
                    <option value="male" selected>Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </div>
              </div>

              <div class="k-profile-actions">
                <button type="button" class="btn-cancel">Cancel</button>
                <button type="submit" class="btn-save">Save Changes</button>
              </div>
            </form>
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
              <a href="dashbord.html">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="category.html" class="active d-flex align-items-center">
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
    <!-- Change Password Modal -->
    <div
      class="modal fade"
      id="changePasswordModal"
      tabindex="-1"
      aria-labelledby="changePasswordModalLabel"
      aria-hidden="true"
    >
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
            <form id="changePasswordForm">
              <div class="mb-3">
                <label for="oldPassword" class="form-label">Old Password</label>
                <div class="position-relative">
                  <input
                    type="password"
                    class="form-control"
                    id="oldPassword"
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
                <label for="confirmPassword" class="form-label"
                  >Confirm Password</label
                >
                <div class="position-relative">
                  <input
                    type="password"
                    class="form-control"
                    id="confirmPassword"
                    placeholder="Your Password"
                  />
                  <span
                    class="k-password-toggle position-absolute top-50 end-0 translate-middle-y pe-3"
                    onclick="togglePassword('confirmPassword')"
                  >
                    <i class="fas fa-eye-slash"></i>
                  </span>
                </div>
              </div>
              <div class="d-flex justify-content-center">
                <button
                  type="button"
                  class="k-btn-cancel"
                  data-bs-dismiss="modal"
                >
                  Cancel
                </button>
                <button type="submit" class="k-btn-reset">
                  Reset Password
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
      <!-- Logout Modal -->
      <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header border-bottom-4">
              <h5 class="modal-title fw-bold" id="logoutModalLabel">Logout</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pb-4">
              <div class="k-logout-icon mb-3">
                <img src="images/delete-conform.png" alt="">
              </div>
              <h5 class="mb-3">Are you sure?</h5>
              <p class="text-muted mb-4">You are about to log out of the admin panel. Any unsaved changes will be lost.</p>
              <div class="d-flex justify-content-center gap-3">
                <button type="button" class="k-btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="k-btn-logout">Logout</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
      function previewImage(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
            document.getElementById("profilePreview").src = e.target.result;
          };

          reader.readAsDataURL(input.files[0]);
        }
      }

      function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        const icon = passwordInput.nextElementSibling.querySelector("i");

        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          icon.classList.remove("fa-eye-slash");
          icon.classList.add("fa-eye");
        } else {
          passwordInput.type = "password";
          icon.classList.remove("fa-eye");
          icon.classList.add("fa-eye-slash");
        }
      }
    </script>
  </body>
</html>
