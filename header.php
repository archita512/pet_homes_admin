<?php
// print_r($_ SESSION);
if(isset($_SESSION['admin'])){
  $email =$_SESSION['admin'];
  $query = mysqli_query($cnn,"SELECT * FROM `login` WHERE status='Active'");
  $row = mysqli_fetch_array($query);
  $id = $row['id'];
  $email = $row['email'];
  $name = $row['name'];
  $image = $row['image'];


}
?>
 <div class="k-content">
      <!-- Header -->
      <div class="k-header-container">
        <div class="k-header d-flex justify-content-between align-center-center">
          <div>
            <button
              class="k-toggle-sidebar"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasExample">
              <i class="fas fa-bars"></i>
            </button>
          </div>
          <div class="k-user-info dropdown">
            <div
              class="d-flex align-items-center"
              role="button"
              id="userDropdown"
              data-bs-toggle="dropdown"
              aria-expanded="false">

              <img src="images/profile-img.png" alt="User Avatar" />
              <div>
                <div class="fw-bold">Wade Warren</div>
                <div class="small text-muted d-flex align-items-center">
                  <p class="mb-0 me-1">Admin</p>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
              </div>
            </div>
            <ul
              class="dropdown-menu k-user-dropdown"
              aria-labelledby="userDropdown"
            >
              <li>
                <a
                  class="dropdown-item d-flex align-items-center"
                  href="profile.php"
                >
                  <i class="fas fa-user me-2"></i> My Profile
                </a>
              </li>
              <li>
                <a
                  class="dropdown-item d-flex align-items-center"
                  href="#"
                  data-bs-toggle="modal"
                  data-bs-target="#changePasswordModal"
                >
                  <i class="fas fa-lock me-2"></i> Change Password
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                  <i class="fas fa-power-off me-2"></i> Logout
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Page Content -->
     
    </div>
     <!-- Change Password Modal -->
     <div
      class="modal fade"
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
                    id="cpwd"
                    name ="cpwd"
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
                    id="npwd"
                    name="npwd"
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
                    id="cnpwd"
                    name="cnpwd"
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
                <button type="button" class="k-btn-logout"  onclick="window.location.href='logout.php';">Logout</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      