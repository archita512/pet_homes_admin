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
                <img src="images/<?php echo $image; ?>" alt="Profile Image" />
              </div>
              <h4 class="k-profile-name"><?php echo $name; ?></h4>
              <p class="k-profile-email"><?php echo $email; ?></p>
            </div>

            <div class="k-profile-info">
              <h5 class="mb-3">Personal Info</h5>
              <div class="k-profile-info-item">
                <div class="k-profile-info-label">Full Name</div>
                <div class="k-profile-info-value">: <?php echo $name; ?></div>
              </div>
              <div class="k-profile-info-item">
                <div class="k-profile-info-label">Email</div>
                <div class="k-profile-info-value text-nowrap text-truncate">
                  : <?php echo $email; ?>
                </div>
              </div>
              <div class="k-profile-info-item">
                <div class="k-profile-info-label">Contact Number</div>
                <div class="k-profile-info-value">: <?php echo $mno; ?></div>
              </div>
              <div class="k-profile-info-item">
                <div class="k-profile-info-label">Gender</div>
                <div class="k-profile-info-value">: <?php echo $gender; ?></div>
              </div>
            </div>
          </div>

          <!-- Profile Edit Section -->
          <div class="k-profile-edit">
            <form class="k-profile-edit-form" id="profileEditForm">
            <h4 class="k-profile-edit-title">Edit Profile</h4>
            <div class="k-profile-edit-img">
              <img
                src="images/<?php echo $image; ?>"  
                alt="Profile Image"
                id="profilePreview"
              />
              <div
                class="camera-icon"
                onclick="document.getElementById('profileImageInput').click()">
                <i class="fas fa-camera"></i>
              </div>
              <input
                type="file"
                id="profileImageInput"
                name="profileImageInput"
                accept="image/*"
                style="display: none"
                onchange="previewImage(this)"
              />
            </div>
            <!-- Moved the form fields below the image -->
            <div class="row mt-3">
              <div class="col-md-6 form-group">
                <label for="name">Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                  value="<?php echo $name; ?>"
                />
              </div>
              <div class="col-md-6 form-group">
                <label for="email">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  value="<?php echo $email; ?>" disabled
                />
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-6 form-group">
                <label for="contact">Contact</label>
                <input
                  type="number"
                  class="form-control"
                  id="contact"
                  name="contact"
                  value="<?php echo $mno; ?>"
                />
              </div>
              <div class="col-md-6 form-group">
                <label for="gender">Gender</label>
                <select class="form-select" id="gender" name="gender">
                  <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                  <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                  <option value="other" <?php echo ($gender == 'other') ? 'selected' : ''; ?>>Other</option>
                </select>
              </div>
            </div>

            <div class="k-profile-actions">
            <button type="button" class="btn-cancel" onclick="window.location.href='dashbord.php';">Cancel</button>
              <button type="submit" class="btn-save" id="btnsave">Save Changes</button>
            </div>
            </form>
          </div>
          <!--  -->
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
   

      <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery Validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    
    <script src="js/forgot_password.js"></script>

      <script src="js/chnage_password.js"></script>
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
