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
// admin panel monthly addopted chart done,
// admin panel most selling pet chart show done,
// admin panel accerssories sale chart show done,
// admin panel dashbord inquiry show done,
// admin panel dashbord pet adopt list show and datatable not show to solve it ,
// admin panel pet sale addopt and return payment sattus update done,
// admin panel Accessories sale and return payment sattus update done,
//  admin panel service maintain  payment sattus update done,
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      rel="stylesheet"
    />
    <!-- ✅ Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- ✅ DataTables Bootstrap 5 CSS -->
<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"> -->
    <!-- custom css -->
    <link rel="stylesheet" href="css/category.css" />
    <link rel="stylesheet" href="css/dashboard.css" />
    <link rel="stylesheet" href="css/profile.css" />
  </head>
  <style>
    .k-card {
  background-color: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.06);
  height: auto;
}

.k-card-header h5 {
  font-weight: 600;
  font-size: 18px;
}

.k-card-body {
  padding: 0 10px;
}
.k-pie-chart{
  display: block;
    box-sizing: border-box;
    height: 307px !important;
    width: 364px !important;
}
.ds_dash-line{
    border: 0.75px solid #dfdbdb;
}
.ds_noti-inner{
    padding: 0px 15px;
}
/* Hide scrollbar for WebKit browsers (Chrome, Safari) */
.ds_noti-inner::-webkit-scrollbar {
    width: 0; /* Hide scrollbar width */
    background: transparent; /* Optional: Set background to transparent */
}

/* Hide scrollbar for Firefox */
.ds_noti-inner {
    scrollbar-width: none; /* Hide scrollbar */
}

/* Optional: Add padding to the inner div to prevent content from being cut off */
.ds_noti-inner {
    padding-right: 10px; /* Add padding to the right */
}
  </style>
  <body>
    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>


  <!-- Header -->
  
  <!-- Main Content -->
  <div class="k-content" style="background-color: #f5f5f5">
    <!-- Header -->
    
    <?php include 'header.php'; ?>

      <!-- Dashboard -->
      <div class="k-dashboard">
        <div class="container-fluid py-4">
          <h4 class="mb-4">Dashboard</h4>
          <div class="row g-4 dashboard-stats">
            <!-- Total Pets Card -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="k-stat-card">
                <div class="k-stat-content">
                  <div class="k-stat-title">Total Pets</div>
                  <div class="k-stat-value"><?php 
                      $query = mysqli_query($cnn,"SELECT count(*) as total_pets FROM `pets`");
                      $row = mysqli_fetch_array($query);
                      $total_pets = $row['total_pets'];
                      echo $total_pets;
                  ?>
                  </div>
                </div>
                <div class="k-stat-icon">
                  <i class="fas fa-cat"></i>
                </div>
              </div>
            </div>

            <!-- Pets Available for Adoption Card -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="k-stat-card">
                <div class="k-stat-content">
                  <div class="k-stat-title">Total Accessories</div>
                  <div class="k-stat-value"><?php 
                      $query = mysqli_query($cnn,"SELECT count(*) as total_accessories FROM `accessories`");
                      $row = mysqli_fetch_array($query);
                      $total_accessories = $row['total_accessories'];
                      echo $total_accessories;
                  ?>
                  </div>
                </div>
                <div class="k-stat-icon">
                <i class="fas fa-shopping-basket"></i>    
                </div>
              </div>
            </div>

            <!-- Pending Adoption Requests Card -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="k-stat-card">
                <div class="k-stat-content">
                  <div class="k-stat-title">Total Services</div>
                  <div class="k-stat-value"><?php 
                      $query = mysqli_query($cnn,"SELECT count(*) as total_services FROM `service`");
                      $row = mysqli_fetch_array($query);
                      $total_services = $row['total_services'];
                      echo $total_services;
                  ?>
                  </div>
                </div>
                <div class="k-stat-icon">
                  <i class="fas fa-concierge-bell"></i>
                </div>
              </div>
            </div>

            <!-- Successful Adoptions Card -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="k-stat-card">
                <div class="k-stat-content">
                  <div class="k-stat-title">Total Users</div>
                  <div class="k-stat-value"><?php 
                      $query = mysqli_query($cnn,"SELECT count(*) as total_users FROM `login`");
                      $row = mysqli_fetch_array($query);
                      $total_users = $row['total_users'];
                      echo $total_users;
                  ?>
                  </div>
                </div>
                <div class="k-stat-icon">
                  <i class="fas fa-users"></i>
                </div>
              </div>
            </div>
          </div>

          
        </div>
        <div class="container-fluid py-4">
        
          <div class="row g-4 dashboard-stats" style="margin-top: -49px;">
            <!-- Total Pets Card -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="k-stat-card">
                <div class="k-stat-content">
                  <div class="k-stat-title">Adopted Pets</div>
                  <div class="k-stat-value"><?php
                      $query = mysqli_query($cnn,"SELECT count(*) as total_adopted_pets FROM `addopt_pet`");
                      $row = mysqli_fetch_array($query);
                      $total_adopted_pets = $row['total_adopted_pets'];
                      echo $total_adopted_pets;
                  ?>
                  </div>
                </div>
                <div class="k-stat-icon">
                  <i class="fas fa-cat"></i>
                </div>
              </div>
            </div>

            <!-- Pets Available for Adoption Card -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="k-stat-card">
                <div class="k-stat-content">
                  <div class="k-stat-title">Accessories Sales</div>
                  <div class="k-stat-value"><?php
                      $query = mysqli_query($cnn,"SELECT count(*) as total_sales FROM `acc_sale`");
                      $row = mysqli_fetch_array($query);
                      $total_sales = $row['total_sales'];
                      echo $total_sales;
                  ?>
                  </div>
                </div>
                <div class="k-stat-icon">
                  <i class="fas fa-paw"></i>
                </div>
              </div>
            </div>

            <!-- Pending Adoption Requests Card -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="k-stat-card">
                <div class="k-stat-content">
                  <div class="k-stat-title">Services Maintain</div>
                  <div class="k-stat-value"><?php
                      $query = mysqli_query($cnn,"SELECT count(*) as total_sales FROM `service_maintain`");
                      $row = mysqli_fetch_array($query);
                      $total_sales = $row['total_sales'];
                      echo $total_sales;
                  ?>
                  </div>
                </div>
                <div class="k-stat-icon">
                  <i class="fas fa-hourglass-half"></i>
                </div>
              </div>
            </div>

            <!-- Successful Adoptions Card -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="k-stat-card">
                <div class="k-stat-content">
                  <div class="k-stat-title">Pets Return</div>
                  <div class="k-stat-value"><?php
                      $query = mysqli_query($cnn,"SELECT count(*) as total_sales FROM `pet_return`");
                      $row = mysqli_fetch_array($query);
                      $total_sales = $row['total_sales'];
                      echo $total_sales;
                  ?>
                  </div>
                </div>
                <div class="k-stat-icon">
                  <i class="fas fa-check-circle"></i>
                </div>
              </div>
            </div>
          </div>

          
        </div>
        <!-- chart section -->
        <div class="k-charts-container container-fluid py-4">
          <div class="row">
          <div class="col-12 col-xl-8 mb-4">
            <div class="k-card shadow-sm rounded p-3" style="background-color: #fff;">
              <div class="k-card-header d-flex justify-content-between align-items-center mb-3">
                <div class="k-chart-heading">
                  <h5 class="mb-0">Monthly Adoption Rate</h5>
                  <small class="text-muted">2025</small>
                </div>
                <div class="k-card-actions">
                  <button class="btn btn-sm btn-light">
                    <i class="fas fa-ellipsis-v"></i>
                  </button>
                </div>
              </div>
              <div class="k-card-body">
                <canvas id="adoptionChart" style="display: block; box-sizing: border-box; height: 374px; width: 993px;margin-top: -50px;"></canvas>
              </div>
            </div>
          </div>
            <div class="col-12 col-xl-4 mb-4">
              <div class="k-card">
                <div class="k-card-header d-flex justify-content-between">
                  <div class="k-chart-heading">
                    <h5 class="mb-1">Most Adopted Pets</h5>
                    <span class="text-muted">This Month</span>
                  </div>
                  <div class="k-card-actions">
                    <button class="k-card-menu-btn">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                  </div>
                </div>
                <div style="display: flex; justify-content: center; align-items: center;" >
                    <canvas id="topPetsChart" class="k-pie-chart" style="margin:auto;"></canvas>
                  </div>

              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-xl-4 mb-4">
              <div class="k-world-chart k-card">
                <div class="k-card-header d-flex justify-content-between">
                  <div class="k-chart-heading">
                    <h5 class="mb-1">Inquiry</h5>
                    <span class="text-muted">User Inquiry</span>
                  </div>
                  <div class="k-card-actions">
                    <button class="k-card-menu-btn">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                  </div>
                </div>
              

                      <div class="ds_noti-inner ms-3" style="max-height: 474px; overflow-y: auto;margin-top: 13px;"> <!-- Added styles for scrolling -->
                      <?php  
                          date_default_timezone_set('Asia/Kolkata');

                          $query = mysqli_query($cnn,"SELECT * FROM contact_us ORDER BY id DESC");
                          while($row = mysqli_fetch_assoc($query)){
                              $date = $row['created_at'];
                              // Removed timestamp calculations
                              
                              echo '<div>
                                  <div class="d-flex justify-content-between mt-3">
                                      <div>
                                          <span class="ms-2" style="font-weight: 600;">
                                              ' . $row['name'] . '
                                          </span>
                                      </div>';
                                      // Display the created_at date directly
                                      echo '<p class="ds_noti-color me-3"> ' . date('d M Y', strtotime($date)) . '</p>'; // Show only the date
                                      echo '</div>
                                      <p class="ds_noti-color ds_line-height" style="margin-left: 15px;">'. substr($row['message'], 0, 80) .'</p>
                                  </div>';
                          }
                          ?>
                      </div>
                
             
              </div>
            </div>
            <div class="col-12 col-xl-8 mb-4">
              <div class="k-card">
                <div class="k-card-header d-flex justify-content-between">
                  <div class="k-chart-heading">
                    <h5 class="mb-1">Accessories Sales</h5>
                    <span class="text-muted"
                      >Number of sales per month</span
                    >
                  </div>
                  <div class="k-card-actions">
                    <button class="k-card-menu-btn">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                  </div>
                </div>
                <div class="k-card-body">
                <canvas id="accessoriesChart" style="display: block; box-sizing: border-box; height: 490px; width: 993px;margin-top: -50px;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- table section  -->
        <div class="k-dash-table-container">
          <div class="container-fluid">
            <div class="k-card">
              <div
                class="k-card-header d-flex justify-content-between align-items-center"
              >
                <div class="k-chart-heading">
                  <h5 class="mb-0">Adoption Requests</h5>
                </div>
              </div>
              <div class="k-card-body" style="padding: 22px 35px;">
                <div class="table-responsive">
                <table id="tbl_cat" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Image</th>
                  <th>Addoption Date</th>

                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone No</th>
                  <th>Discount</th>
                  <th>Total Price</th>
                  <th>Address</th>
                 
                  
                </tr>
              </thead>
              <tbody>
                <?php
                  $query = mysqli_query($cnn,"SELECT ad.*,p.image FROM `addopt_pet` AS ad JOIN pets AS p ON ad.pet_id = p.id ORDER BY ad.id DESC");
                  $cnt = 1;
                  while($row = mysqli_fetch_array($query)){
                    $c_id = encryptor('encrypt',$row['id']);
                    $images = json_decode($row['image']); // Assuming images are stored as a JSON array
                    $first_image = $images[0]; // Get the first image from the array
  
                    echo '<tr class="k-tr">
                        <td>#' . $cnt . '</td>
                        <td><img src="../pet_homes/img/' . $first_image .'" style="width: 90px; height: 60px;"></td>
                       <td>' . date('d M Y', strtotime($row['ad_date'])) . '</td>
                        <td>' . $row['name'] . '</td>
                         <td>' . $row['email'] . '</td>
                          <td>' . $row['mno'] . '</td>
                          <td>$' . $row['discount'] . '</td>
                          <td>$' . $row['total_price'] . '</td>
                         <td>' . substr($row['address'], 0, 10) . '...</td> 
                       
                       
                      </tr>'; // Corrected closing of the echo statement
  
                    $cnt++;
                  } // Correctly closing the while loop
                  ?>
                
              </tbody>
            </table>
                </div>
              
              </div>
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
            <form id="passwordForm" method="POST" action="">
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
                    <i class="fas fa-eye-slash"></i>
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
    <!-- Logout Modal -->
    <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      aria-labelledby="logoutModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-bottom-4">
            <h5 class="modal-title fw-bold" id="logoutModalLabel">Logout</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body text-center pb-4">
            <div class="k-logout-icon mb-3">
              <img src="images/delete-conform.png" alt="" />
            </div>
            <h5 class="mb-3">Are you sure?</h5>
            <p class="text-muted mb-4">
              You are about to log out of the admin panel. Any unsaved changes
              will be lost.
            </p>
            <div class="d-flex justify-content-center gap-3">
              <button
                type="button"
                class="k-btn-cancel"
                data-bs-dismiss="modal"
              >
                Cancel
              </button>
              <button type="button" class="k-btn-logout">Logout</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/data/countries2.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="js/worldchart.js"></script>
    <!-- <script src="js/barchart.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

  <!-- ✅ Bootstrap 5 Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- ✅ DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/css/bootstrap-toaster.min.css" integrity="sha512-613efYxCWhUklTCFNFaiPW4q6XXoogGNsn5WZoa0bwOBlVM02TJ/JH7o7SgWBnJIQgz1MMnmhNEcAVGb/JDefw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/css/bootstrap-toaster.css" integrity="sha512-DkcySkzTXJAPu18869uNSKlHOcm9UKvy4phZvC3b60guZveNCHI79sTM3wGJRNaqWSm9/7s07ztsgjonhJhI3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/js/bootstrap-toaster.js" integrity="sha512-vG793m0UbmHpDP9w5eGmPczh4JJ5HUZKi+WBReYTPzaefQ/eLInVo/MeDYvnE0LsM7NlUbgtf/jGG5c6JmO6Pg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- <script src="js/SmoothedLineChart.js"></script> -->

    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

    
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- DataTables JS -->
    <!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script> -->

<!--     
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    
    <!-- Bootstrap JS Bundle -->
    
    <!-- jQuery Validate -->
    <!-- Bootstrap JS -->
    <!-- <script src="js/Piechart.js"></script> -->
    <script>
$(document).ready(function () {
  $('#tbl_cat').DataTable({
    pageLength: 5, // default to 5 rows per page
    lengthMenu: [ [5, 10, 25, 50, 100], [5, 10, 25, 50, 100] ] // custom dropdown values
  });
});

  </script>
    <script src="js/chnage_password.js"></script>
    <?php
            $query = "
                SELECT DATE_FORMAT(ad_date, '%b') AS month, COUNT(*) AS count
                FROM addopt_pet
                GROUP BY MONTH(ad_date)
                ORDER BY MONTH(ad_date)
            ";

            $result = mysqli_query($cnn, $query);

            $monthCounts = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $monthCounts[$row['month']] = $row['count'];
            }

            // Prepare full month list
            $allMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            $labels = [];
            $data = [];

            foreach ($allMonths as $month) {
                $labels[] = $month;
                $data[] = isset($monthCounts[$month]) ? $monthCounts[$month] : 0;
            }
            ?>
             <?php
            $query_accessories = "
                SELECT DATE_FORMAT(date, '%b') AS month, COUNT(*) AS count
                FROM acc_sale
                GROUP BY MONTH(date)
                ORDER BY MONTH(date)
            ";

            $result_accessories = mysqli_query($cnn, $query_accessories);

            $monthCounts_accessories = [];
            while ($row = mysqli_fetch_assoc($result_accessories)) {
                $monthCounts_accessories[$row['month']] = $row['count'];
            }

            // Prepare full month list
            $allMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            $labels_accessories = [];
            $data_accessories = [];

            foreach ($allMonths as $month) {
                $labels_accessories[] = $month;
                $data_accessories[] = isset($monthCounts_accessories[$month]) ? $monthCounts_accessories[$month] : 0;
            }
            ?>
            <?php
                $query_top_pets = "SELECT p.name,c.name AS category_name, COUNT(*) as total
                      FROM addopt_pet
                      JOIN pets AS p ON addopt_pet.pet_id = p.id
                      JOIN category AS c ON p.cat_id = c.id
                      GROUP BY p.cat_id
                      ORDER BY total DESC
                      LIMIT 5";

                $result_top_pets = mysqli_query($cnn, $query_top_pets);

                      $labels_top_pets = [];
                      $data_top_pets = [];

                      while ($row = mysqli_fetch_assoc($result_top_pets)) {
                          $labels_top_pets[] = $row['category_name'];
                          $data_top_pets[] = $row['total'];
                      }

                      $total_count = array_sum($data_top_pets); // 👈 For center total
                        ?>    
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Adoption Line Chart
    const ctx1 = document.getElementById('adoptionChart').getContext('2d');
    const adoptionlabel = <?php echo json_encode($labels); ?>;
    const adoptiondata = <?php echo json_encode($data); ?>;
    const adoptionChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: adoptionlabel,
            datasets: [{
                label: 'Adoptions per Month',
                data: adoptiondata,
                backgroundColor: '#eadfd7',
                borderColor: '#976239',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            layout: {
                padding: {
                    left: 0
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#976239'
                    }
                },
                title: {
                    display: true,
                    color: '#976239',
                    font: { size: 16 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: <?php echo max($data); ?> + 100,
                    ticks: {
                        stepSize: 10,
                        color: '#333'
                    }
                },
                x: {
                    ticks: {
                        color: '#333'
                    }
                }
            }
        }
    });

    
    // Top Pets Doughnut Chart
    const ctx2 = document.getElementById('topPetsChart').getContext('2d');
    const labels = <?php echo json_encode($labels_top_pets); ?>;
    const data = <?php echo json_encode($data_top_pets); ?>;
    const total = <?php echo $total_count; ?>;

    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: ['#5B9A8B', '#2A4365', '#B83280', '#4A5568', '#ECC94B'],
                borderWidth: 0,
                // position: 'right'
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'right',
                    labels: { usePointStyle: true }
                },
                datalabels: {
                    color: '#fff',
                    formatter: (value, ctx) => ctx.chart.data.labels[ctx.dataIndex],
                    font: { weight: 'bold' },
                    
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.label + ": " + context.raw;
                        }
                    }
                }
            },
            cutout: '70%'
        },
        plugins: [
            ChartDataLabels,
            {
              id: 'centerText',
              beforeDraw(chart) {
                const { width, height, ctx } = chart;
                ctx.save();

                const fontSize = Math.min(height / 4, 40); // Auto-adjust font size
                ctx.font = `${fontSize}px sans-serif`;
                ctx.fillStyle = "#333";
                ctx.textBaseline = "middle";
                ctx.textAlign = "center";
                // ctx.position = 'center';

                const text = total.toString();
                const centerX = width / 2;
                const centerY = height / 2;

                ctx.fillText(text, centerX, centerY);
                ctx.restore();
              }
            }
                    ]
                });

                 // Accessories Line Chart
    const ctx3 = document.getElementById('accessoriesChart').getContext('2d');
    const labels_accessories = <?php echo json_encode($labels_accessories); ?>;
    const data_accessories = <?php echo json_encode($data_accessories); ?>;
    const accessoriesChart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: labels_accessories,
            datasets: [{
                label: 'Accessories per Month',
                data: data_accessories,
                backgroundColor: '#eadfd7',
                borderColor: '#976239',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            layout: {
                padding: {
                    left: 0
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#976239'
                    }
                },
                title: {
                    display: true,
                    color: '#976239',
                    font: { size: 16 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: <?php echo max($data); ?> + 100,
                    ticks: {
                        stepSize: 10,
                        color: '#333'
                    }
                },
                x: {
                    ticks: {
                        color: '#333'
                    }
                }
            }
        }
    });
            });

            
        </script>

    <script>
  //     $("#btnchnage").click(function (event) {
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
  </body>
</html>
