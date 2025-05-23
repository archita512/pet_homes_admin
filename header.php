<?php
// print_r($_SESSION);
if(isset($_SESSION['admin'])){
  $admin =$_SESSION['admin'];
  $query_user = mysqli_query($cnn,"SELECT * FROM `login` WHERE email='$admin'");
  $row_user = mysqli_fetch_array($query_user);
  $id1 = $row_user['id'];
  $email1 = $row_user['email'];
  $name1 = $row_user['name'];
  $image1 = $row_user['image'];


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

              <img src="images/<?php echo $image1; ?>" alt="User Avatar" />
              <div>
                <div class="fw-bold"><?php echo $name1; ?></div>
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
      