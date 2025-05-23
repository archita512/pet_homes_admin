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
    <title>Dashboard</title>
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
                  <div class="k-stat-value">1484</div>
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
                  <div class="k-stat-title">Pets Available for Adoption</div>
                  <div class="k-stat-value">1457</div>
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
                  <div class="k-stat-title">Pending Adoption Requests</div>
                  <div class="k-stat-value">142</div>
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
                  <div class="k-stat-title">Successful Adoptions</div>
                  <div class="k-stat-value">1248</div>
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
                  <table class="table k-adoption-table">
                    <thead>
                      <tr>
                        <th scope="col" class="rounded-start-2">
                          Request ID <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th scope="col">
                          Date <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th scope="col">
                          Pet Name <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th scope="col">
                          Adopter Name <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th scope="col">
                          Location <i class="fas fa-sort ms-1"></i>
                        </th>
                        <th scope="col" class="rounded-end-2">
                          Status <i class="fas fa-sort ms-1"></i>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>#REQ1234</td>
                        <td>05 Feb 2025</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="k-pet-img me-2">
                              <img src="images/t1.jpg" alt="Thor" />
                            </div>
                            Thor
                          </div>
                        </td>
                        <td>Floyd Miles</td>
                        <td>New York, NY</td>
                        <td>
                          <span class="k-status k-approved">Approved</span>
                        </td>
                      </tr>
                      <tr>
                        <td>#REQ1234</td>
                        <td>12 Jan 2025</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="k-pet-img me-2">
                              <img src="images/t2.png" alt="Mochi" />
                            </div>
                            Mochi
                          </div>
                        </td>
                        <td>Ronald Richards</td>
                        <td>Los Angeles, CA</td>
                        <td><span class="k-status k-pending">Pending</span></td>
                      </tr>
                      <tr>
                        <td>#REQ1234</td>
                        <td>12 Jan 2025</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="k-pet-img me-2">
                              <img src="images/t3.png" alt="Chirpy" />
                            </div>
                            Chirpy
                          </div>
                        </td>
                        <td>Theresa Webb</td>
                        <td>Houston, TX</td>
                        <td>
                          <span class="k-status k-rejected">Rejected</span>
                        </td>
                      </tr>
                      <tr>
                        <td>#REQ1234</td>
                        <td>12 Jan 2025</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="k-pet-img me-2">
                              <img src="images/t4.png" alt="Luna" />
                            </div>
                            Luna
                          </div>
                        </td>
                        <td>Ralph Edwards</td>
                        <td>Miami, FL</td>
                        <td>
                          <span class="k-status k-rejected">Rejected</span>
                        </td>
                      </tr>
                      <tr>
                        <td>#REQ1234</td>
                        <td>12 Jan 2025</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="k-pet-img me-2">
                              <img src="images/t5.png" alt="Binky" />
                            </div>
                            Binky
                          </div>
                        </td>
                        <td>Bessie Cooper</td>
                        <td>Chicago, IL</td>
                        <td>
                          <span class="k-status k-approved">Approved</span>
                        </td>
                      </tr>
                      <tr>
                        <td>#REQ1234</td>
                        <td>12 Jan 2025</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="k-pet-img me-2">
                              <img src="images/t6.png" alt="Slinky" />
                            </div>
                            Slinky
                          </div>
                        </td>
                        <td>Wade Warren</td>
                        <td>New York, NY</td>
                        <td><span class="k-status k-pending">Pending</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="k-pagination pt-3">
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="js/Piechart.js"></script>
    
    <script src="js/chnage_password.js"></script>

    <script>
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
