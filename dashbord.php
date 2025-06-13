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
    <title>Dashboard</title>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      rel="stylesheet"
    />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- custom css -->
    <link rel="stylesheet" href="css/category.css" />
    <link rel="stylesheet" href="css/dashboard.css" />
    <link rel="stylesheet" href="css/profile.css" />
  </head>
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
              <div class="k-card">
                <div class="k-card-header d-flex justify-content-between">
                  <div class="k-chart-heading">
                    <h5 class="mb-1">Monthly Adoption Rate</h5>
                    <span class="text-muted">2024</span>
                  </div>
                  <div class="k-card-actions">
                    <button class="k-card-menu-btn">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                  </div>
                </div>
                <div class="k-card-body">
                  <div id="SmoothedLineChart"></div>
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
                <div class="k-card-body">
                  <div id="PieChart" class="k-pie-chart"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-xl-4 mb-4">
              <div class="k-world-chart k-card">
                <div class="k-card-header d-flex justify-content-between">
                  <div class="k-chart-heading">
                    <h5 class="mb-1">Adopter Demographics</h5>
                    <span class="text-muted">Map of adoption locations</span>
                  </div>
                  <div class="k-card-actions">
                    <button class="k-card-menu-btn">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                  </div>
                </div>
                <div class="k-card-body">
                  <div id="chartdiv" class="k-world-map"></div>
                  <div class="k-country-stats mt-4">
                    <div class="row g-4">
                      <div class="col-6 col-md-4">
                        <div class="k-country-stat">
                          <div class="k-country-flag">
                            <img src="images/US.png" alt="US Flag" />
                          </div>
                          <div class="k-country-info">
                            <h6 class="text-nowrap text-truncate">
                              United State (USA)
                            </h6>
                            <div class="k-country-data">
                              <span class="k-percentage">54%</span>
                              <span class="k-users text-nowrap"
                                >5,761,687 Users</span
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-6 col-md-4">
                        <div class="k-country-stat">
                          <div class="k-country-flag">
                            <img src="images/china.png" alt="China Flag" />
                          </div>
                          <div class="k-country-info">
                            <h6 class="text-nowrap text-truncate">China</h6>
                            <div class="k-country-data">
                              <span class="k-percentage">31%</span>
                              <span class="k-users text-nowrap"
                                >698,723 Users</span
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-md-4">
                        <div class="k-country-stat">
                          <div class="k-country-flag">
                            <img src="images/russia.png" alt="Russia Flag" />
                          </div>
                          <div class="k-country-info">
                            <h6 class="text-nowrap text-truncate">Russia</h6>
                            <div class="k-country-data">
                              <span class="k-percentage">19%</span>
                              <span class="k-users text-nowrap"
                                >68,412 Users</span
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-xl-8 mb-4">
              <div class="k-card">
                <div class="k-card-header d-flex justify-content-between">
                  <div class="k-chart-heading">
                    <h5 class="mb-1">Adoption Statistics by Country</h5>
                    <span class="text-muted"
                      >Number of adoptions per country</span
                    >
                  </div>
                  <div class="k-card-actions">
                    <button class="k-card-menu-btn">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                  </div>
                </div>
                <div class="k-card-body">
                  <div id="barchart" class="k-bar-chart"></div>
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
              <div class="k-card-body">
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
                 
                  <th>Action</th>
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
                       
                        <td class="action-buttons">
                          <a href="#" 
                                class="edit-btn text-decoration-none" 
                                data-bs-toggle="modal" 
                                data-bs-target="#accessoryDetailModal"
                                data-description="' . htmlspecialchars($row['address']) . '">
                                <img src="images/view.png" alt="" style="width: 24px;height: 25px;" />
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
                <!-- <div class="k-pagination pt-3">
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
                </div> -->
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
    <script src="js/barchart.js"></script>
    <script src="js/SmoothedLineChart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Bootstrap JS Bundle -->
    
    <!-- jQuery Validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/Piechart.js"></script>
    
    <script src="js/chnage_password.js"></script>

    <script>
          $(document).ready(function() {
            $('#tbl_cat').DataTable(); // Initialize DataTable
        });

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
  </body>
</html>
