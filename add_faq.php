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
    <title>FAQ Message</title>
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
    .k-modal-body {
    padding: 11px !important;
}
            .k-form-control {
                width: 100% !important;
   
            }
            .imgBox {
                border: 1px solid black;
                width: 230px;
                height: 200px;
            }
            .k-form-group {
            position: relative;
            margin: 20px;
            max-width: 600px;
        }

        .k-form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .k-form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            resize: vertical;
            transition: border-color 0.3s ease;
        }

        .k-form-control:focus {
            outline: none;
            border-color: #976239;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .emoji-container {
            position: relative;
            display: inline-block;
        }

        .emoji-button {
            background: linear-gradient(135deg,hsl(26, 62.60%, 58.00%) 0%,rgb(223, 157, 106) 100%);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
        }

        .emoji-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .emoji-picker {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            border: 2px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 350px;
            max-height: 400px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
            animation: fadeInUp 0.3s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .emoji-picker.show {
            display: block;
        }

        .emoji-header {
            padding: 15px;
            border-bottom: 1px solid #eee;
            background: linear-gradient(135deg,rgb(180, 119, 72) 0%,rgb(242, 201, 170) 100%);
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .emoji-header h4 {
            margin: 0;
            font-size: 16px;
        }

        .emoji-categories {
            display: flex;
            padding: 10px;
            border-bottom: 1px solid #eee;
            gap: 5px;
            flex-wrap: wrap;
        }

        .category-btn {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 5px 10px;
            border-radius: 15px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s ease;
        }

        .category-btn:hover, .category-btn.active {
            background: #976239;
            color: white;
            border-color: #976239;
        }

        .emoji-grid {
            padding: 15px;
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 8px;
            max-height: 250px;
            overflow-y: auto;
        }

        .emoji-item {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 6px;
            font-size: 18px;
            transition: all 0.2s ease;
            background: #f8f9fa;
        }

        .emoji-item:hover {
            background: #e9ecef;
            transform: scale(1.2);
        }

        .search-box {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .search-input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-size: 14px;
            outline: none;
        }

        .search-input:focus {
            border-color: #007bff;
        }

        /* Scrollbar styling */
        .emoji-grid::-webkit-scrollbar {
            width: 6px;
        }

        .emoji-grid::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .emoji-grid::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .emoji-grid::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
  </style>
  <?php
          if (isset($_GET['id']) && !empty($_GET['id'])) {
              $id_a=$_GET['id'];
              $id=encryptor('decrypt', $id_a);
              $query_about = mysqli_query($cnn, "select * from que_ans where id=" . $id . "");
              $row_about = mysqli_fetch_array($query_about);
              $question = $row_about['question'];
              $ans = $row_about['ans'];

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
            <h2 class="k-modal-title ps-4"><?php if(isset($_GET['id'])){ echo 'Updated FAQ Message'; } else { echo 'Add FAQ Message'; } ?></h2>
          </div>
          <form id="frm" action="" method="POST" enctype="multipart/form-data">
          <div class="card" style="width: 889px; margin-left: 50px; margin-top: 30px;">
          <div class="k-modal-body">
          <div class="row">
            <div class="col-sm-12">
                <div>
                <input id="id_faq" name="id_faq" value="<?php if (isset($_GET['id'])) {
                    echo $row_about['id'];
                } ?>" hidden />
                <div class="mb-3">
                <div class="k-form-group">
                    <label class="k-form-label">Question</label>
                    <input
                        type="text"
                        class="k-form-control"
                        placeholder="Question"
                        name="question"
                        id="question"
                        value="<?php if (isset($_GET['id'])) {
                            echo $question;
                        } else{
                            echo '';
                        }?>"
                    />
                    </div>
                    </div>
                  
                    <div class="k-form-group">
                      
                        <label for="ans" class="k-form-label mt-3">Answer</label>
                        <textarea name="ans" id="ans" class="k-form-control" rows="3" placeholder="Answer"><?php if(isset($_GET['id'])){ echo $ans; } ?></textarea>
                        
                      </div>
                      <div class="emoji-container" style="margin-left: 18px;margin-top: -5px;margin-bottom: 14px;">
                          <button type="button" class="emoji-button" id="emojiBtn">
                              😀 Add Emoji
                          </button>
                          
                          <div class="emoji-picker" id="emojiPicker">
                              <div class="emoji-header">
                                  <h4>Choose an Emoji</h4>
                              </div>
                              
                              <div class="search-box">
                                  <input type="text" class="search-input" id="emojiSearch" placeholder="Search emojis...">
                              </div>
                              
                              <div class="emoji-categories">
                                  <button class="category-btn active" data-category="all">All</button>
                                  <button class="category-btn" data-category="faces">😀 Faces</button>
                                  <button class="category-btn" data-category="animals">🐱 Animals</button>
                                  <button class="category-btn" data-category="food">🍎 Food</button>
                                  <button class="category-btn" data-category="activities">⚽ Activities</button>
                                  <button class="category-btn" data-category="travel">🚗 Travel</button>
                                  <button class="category-btn" data-category="objects">💡 Objects</button>
                                  <button class="category-btn" data-category="symbols">❤️ Symbols</button>
                              </div>
                              
                              <div class="emoji-grid" id="emojiGrid">
                                  <!-- Emojis will be loaded here -->
                              </div>
                          </div>
                      </div>
                </div>
              </div>

               
            <div class="k-modal-footer">
            <button type="button" class="k-btn-cancel" onclick="window.location.href='faq.php'">Cancel</button>
            <button type="submit"  name="<?php echo isset($_GET['id']) ? 'btnUpdate' : 'btnSubmit'; ?>"
            id="<?php echo isset($_GET['id']) ? 'btnUpdate' : 'btnSubmit'; ?>" class="k-btn-save">Save</button>
          </div>
        </div>
        </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
            
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/css/bootstrap-toaster.min.css" integrity="sha512-613efYxCWhUklTCFNFaiPW4q6XXoogGNsn5WZoa0bwOBlVM02TJ/JH7o7SgWBnJIQgz1MMnmhNEcAVGb/JDefw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/css/bootstrap-toaster.css" integrity="sha512-DkcySkzTXJAPu18869uNSKlHOcm9UKvy4phZvC3b60guZveNCHI79sTM3wGJRNaqWSm9/7s07ztsgjonhJhI3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/js/bootstrap-toaster.js" integrity="sha512-vG793m0UbmHpDP9w5eGmPczh4JJ5HUZKi+WBReYTPzaefQ/eLInVo/MeDYvnE0LsM7NlUbgtf/jGG5c6JmO6Pg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/js/bootstrap-toaster.min.js" integrity="sha512-bPZBFTQxrZnfFHJqMjP9VVXVigWPjrDHWoPVgsdo2hGNUEY9WF9HQjWfvWnFEduF9cwmsbtKoQ9QkiPkTTUHwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/fileUpload.js"></script>
    <script src="js/faq.js"></script>
    
    <!-- <script src="js/chnage_password.js"></script> -->
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
    </script>
     <script>
    const emojis = {
    faces: ['😀', '😃', '😄', '😁', '😆', '😅', '🤣', '😂', '🙂', '🙃', '😉', '😊', '😇', '🥰', '😍', '🤩', '😘', '😗', '😚', '😙', '😋', '😛', '😜', '🤪', '😝', '🤑', '🤗', '🤭', '🤫', '🤔', '🤐', '🤨', '😐', '😑', '😶', '😏', '😒', '🙄', '😬', '🤥', '😔', '😪', '🤤', '😴', '😷', '🤒', '🤕', '🤢', '🤮', '🤧', '🥵', '🥶', '🥴', '😵', '🤯', '🤠', '🥳', '😎', '🤓', '🧐'],
    animals: ['🐶', '🐱', '🐭', '🐹', '🐰', '🦊', '🐻', '🐼', '🐨', '🐯', '🦁', '🐮', '🐷', '🐽', '🐸', '🐵', '🙈', '🙉', '🙊', '🐒', '🐔', '🐧', '🐦', '🐤', '🐣', '🐥', '🦆', '🦅', '🦉', '🦇', '🐺', '🐗', '🐴', '🦄', '🐝', '🐛', '🦋', '🐌', '🐞', '🐜', '🦟', '🦗', '🕷️', '🕸️', '🦂', '🐢', '🐍', '🦎', '🦖', '🦕', '🐙', '🦑', '🦐', '🦞', '🦀', '🐡', '🐠', '🐟', '🐬', '🐳', '🐋', '🦈', '🐊', '🐅', '🐆', '🦓', '🦍', '🦧', '🐘', '🦛', '🦏', '🐪', '🐫', '🦒', '🦘', '🐃', '🐂', '🐄', '🐎', '🐖', '🐏', '🐑', '🦙', '🐐', '🦌', '🐕', '🐩', '🦮', '🐕‍🦺', '🐈', '🐓', '🦃', '🦚', '🦜', '🦢', '🦩', '🕊️', '🐇', '🦝', '🦨', '🦡', '🦦', '🦥', '🐁', '🐀', '🐿️'],
    food: ['🍎', '🍐', '🍊', '🍋', '🍌', '🍉', '🍇', '🍓', '🫐', '🍈', '🍒', '🍑', '🥭', '🍍', '🥥', '🥝', '🍅', '🍆', '🥑', '🥦', '🥬', '🥒', '🌶️', '🫑', '🌽', '🥕', '🫒', '🧄', '🧅', '🥔', '🍠', '🥐', '🥯', '🍞', '🥖', '🥨', '🧀', '🥚', '🍳', '🧈', '🥞', '🧇', '🥓', '🥩', '🍗', '🍖', '🦴', '🌭', '🍔', '🍟', '🍕', '🫓', '🥪', '🥙', '🧆', '🌮', '🌯', '🫔', '🥗', '🥘', '🫕', '🥫', '🍝', '🍜', '🍲', '🍛', '🍣', '🍱', '🥟', '🦪', '🍤', '🍙', '🍚', '🍘', '🍥', '🥠', '🥮', '🍢', '🍡', '🍧', '🍨', '🍦', '🥧', '🧁', '🎂', '🍰', '🎂', '🍪', '🍫', '🍬', '🍭', '🍮', '🍯'],
    activities: ['⚽', '🏀', '🏈', '⚾', '🥎', '🎾', '🏐', '🏉', '🥏', '🎱', '🪀', '🏓', '🏸', '🏒', '🏑', '🥍', '🏏', '🪃', '🥅', '⛳', '🪁', '🏹', '🎣', '🤿', '🥊', '🥋', '🎽', '🛹', '🛼', '🛷', '⛸️', '🥌', '🎿', '⛷️', '🏂', '🪂', '🏋️‍♀️', '🏋️', '🏋️‍♂️', '🤼‍♀️', '🤼', '🤼‍♂️', '🤸‍♀️', '🤸', '🤸‍♂️', '⛹️‍♀️', '⛹️', '⛹️‍♂️', '🤺', '🤾‍♀️', '🤾', '🤾‍♂️', '🏌️‍♀️', '🏌️', '🏌️‍♂️', '🏇', '🧘‍♀️', '🧘', '🧘‍♂️', '🏄‍♀️', '🏄', '🏄‍♂️', '🏊‍♀️', '🏊', '🏊‍♂️', '🤽‍♀️', '🤽', '🤽‍♂️', '🚣‍♀️', '🚣', '🚣‍♂️', '🧗‍♀️', '🧗', '🧗‍♂️', '🚵‍♀️', '🚵', '🚵‍♂️', '🚴‍♀️', '🚴', '🚴‍♂️', '🏆', '🥇', '🥈', '🥉', '🏅', '🎖️', '🏵️', '🎗️'],
    travel: ['🚗', '🚕', '🚙', '🚌', '🚎', '🏎️', '🚓', '🚑', '🚒', '🚐', '🛻', '🚚', '🚛', '🚜', '🦯', '🦽', '🦼', '🛴', '🚲', '🛵', '🏍️', '🛺', '🚨', '🚔', '🚍', '🚘', '🚖', '🚡', '🚠', '🚟', '🚃', '🚋', '🚞', '🚝', '🚄', '🚅', '🚈', '🚂', '🚆', '🚇', '🚊', '🚉', '✈️', '🛫', '🛬', '🛩️', '💺', '🛰️', '🚁', '🛸', '🚀', '🛶', '⛵', '🚤', '🛥️', '🛳️', '⛴️', '🚢', '⚓', '⛽', '🚧', '🚦', '🚥', '🚏', '🗺️', '🗿', '🗽', '🗼', '🏰', '🏯', '🏟️', '🎡', '🎢', '🎠', '⛱️', '🏖️', '🏝️', '🏜️', '🌋', '⛰️', '🏔️', '🗻', '🏕️', '⛺', '🏠', '🏡', '🏘️', '🏚️', '🏗️', '🏭', '🏢', '🏬', '🏣', '🏤', '🏥', '🏦', '🏨', '🏪', '🏫', '🏩', '💒', '🏛️', '⛪', '🕌', '🕍', '🛕'],
    objects: ['💡', '🔦', '🕯️', '🪔', '🧯', '🛢️', '💸', '💵', '💴', '💶', '💷', '🪙', '💰', '💳', '💎', '⚖️', '🪜', '🧰', '🪛', '🔧', '🔨', '⚒️', '🛠️', '⛏️', '🪚', '🔩', '⚙️', '🪤', '🧱', '⛓️', '🧲', '🔫', '💣', '🧨', '🪓', '🔪', '🗡️', '⚔️', '🛡️', '🚬', '⚰️', '🪦', '⚱️', '🏺', '🔮', '📿', '🧿', '💈', '⚗️', '🔭', '🔬', '🕳️', '🩹', '🩺', '💊', '💉', '🩸', '🧬', '🦠', '🧫', '🧪', '🌡️', '🧹', '🪣', '🧴', '🧷', '🧼', '🪒', '🧽', '🪥', '🪞', '🛁', '🛀', '🧻', '🪑', '🚽', '🪠', '🚿', '🛄', '🛅', '🧳'],
    symbols: ['❤️', '🧡', '💛', '💚', '💙', '💜', '🖤', '🤍', '🤎', '💔', '❣️', '💕', '💞', '💓', '💗', '💖', '💘', '💝', '💟', '☮️', '✝️', '☪️', '🕉️', '☸️', '✡️', '🔯', '🕎', '☯️', '☦️', '🛐', '⛎', '♈', '♉', '♊', '♋', '♌', '♍', '♎', '♏', '♐', '♑', '♒', '♓', '🆔', '⚛️', '🉑', '☢️', '☣️', '📴', '📳', '🈶', '🈚', '🈸', '🈺', '🈷️', '✴️', '🆚', '💮', '🉐', '㊙️', '㊗️', '🈴', '🈵', '🈹', '🈲', '🅰️', '🅱️', '🆎', '🆑', '🅾️', '🆘', '❌', '⭕', '🛑', '⛔', '📛', '🚫', '💯', '💢', '♨️', '🚷', '🚯', '🚳', '🚱', '🔞', '📵', '🚭', '❗', '❕', '❓', '❔', '‼️', '⁉️', '🔅', '🔆', '〽️', '⚠️', '🚸', '🔱', '⚜️', '🔰', '♻️', '✅', '🈯', '💹', '❇️', '✳️', '❎', '🌐', '💠', 'Ⓜ️', '🌀', '💤', '🏧', '🚾', '♿', '🅿️', '🈳', '🈂️', '🛂', '🛃', '🛄', '🛅', '🚹', '🚺', '🚼', '⚧️', '🚻', '🚮', '🎦', '📶', '🈁', '🔣', 'ℹ️', '🔤', '🔡', '🔠', '🆖', '🆗', '🆙', '🆒', '🆕', '🆓', '0️⃣', '1️⃣', '2️⃣', '3️⃣', '4️⃣', '5️⃣', '6️⃣', '7️⃣', '8️⃣', '9️⃣', '🔟']
};

const allEmojis = Object.values(emojis).flat();

let currentCategory = 'all';
let filteredEmojis = allEmojis;

// Wait for DOM to be loaded
document.addEventListener('DOMContentLoaded', function() {
    const emojiBtn = document.getElementById('emojiBtn');
    const emojiPicker = document.getElementById('emojiPicker');
    const emojiGrid = document.getElementById('emojiGrid');
    const emojiSearch = document.getElementById('emojiSearch');
    const textarea = document.getElementById('ans');
    const categoryBtns = document.querySelectorAll('.category-btn');

    // Check if elements exist before adding event listeners
    if (!emojiBtn || !emojiPicker || !emojiGrid || !textarea) {
        console.error('Emoji picker elements not found');
        return;
    }

    // Toggle emoji picker
    emojiBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        emojiPicker.classList.toggle('show');
        if (emojiPicker.classList.contains('show')) {
            renderEmojis();
            if (emojiSearch) {
                emojiSearch.focus();
            }
        }
    });

    // Close picker when clicking outside
    document.addEventListener('click', (e) => {
        if (!emojiPicker.contains(e.target) && !emojiBtn.contains(e.target)) {
            emojiPicker.classList.remove('show');
        }
    });

    // Category selection
    categoryBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            
            // Remove active class from all buttons
            categoryBtns.forEach(b => b.classList.remove('active'));
            
            // Add active class to clicked button
            btn.classList.add('active');
            
            // Update current category
            currentCategory = btn.dataset.category;
            
            // Clear search when changing category
            if (emojiSearch) {
                emojiSearch.value = '';
            }
            
            // Update filtered emojis and render
            updateFilteredEmojis();
            renderEmojis();
        });
    });

    // Search functionality
    if (emojiSearch) {
        emojiSearch.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase().trim();
            
            if (searchTerm) {
                // Filter emojis based on current category and search term
                const baseEmojis = currentCategory === 'all' ? allEmojis : (emojis[currentCategory] || []);
                
                // For now, just show all from current category when searching
                // You can enhance this by adding emoji names/keywords mapping
                filteredEmojis = baseEmojis;
            } else {
                updateFilteredEmojis();
            }
            renderEmojis();
        });
    }

    function updateFilteredEmojis() {
        if (currentCategory === 'all') {
            filteredEmojis = allEmojis;
        } else {
            filteredEmojis = emojis[currentCategory] || [];
        }
    }

    function renderEmojis() {
        if (!emojiGrid) return;
        
        emojiGrid.innerHTML = '';
        
        if (filteredEmojis.length === 0) {
            emojiGrid.innerHTML = '<div style="text-align: center; color: #666; padding: 20px;">No emojis found</div>';
            return;
        }
        
        filteredEmojis.forEach(emoji => {
            const emojiElement = document.createElement('div');
            emojiElement.className = 'emoji-item';
            emojiElement.textContent = emoji;
            emojiElement.style.cursor = 'pointer';
            emojiElement.style.padding = '8px';
            emojiElement.style.borderRadius = '4px';
            emojiElement.style.fontSize = '20px';
            emojiElement.style.textAlign = 'center';
            emojiElement.style.transition = 'background-color 0.2s';
            
            // Hover effect
            emojiElement.addEventListener('mouseenter', () => {
                emojiElement.style.backgroundColor = '#f0f0f0';
            });
            
            emojiElement.addEventListener('mouseleave', () => {
                emojiElement.style.backgroundColor = 'transparent';
            });
            
            // Click to insert emoji
            emojiElement.addEventListener('click', (e) => {
                e.stopPropagation();
                insertEmojiIntoTextarea(emoji);
                
                // Close the emoji picker after selection
                emojiPicker.classList.remove('show');
            });
            
            emojiGrid.appendChild(emojiElement);
        });
    }

    function insertEmojiIntoTextarea(emoji) {
        if (!textarea) return;
        
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const text = textarea.value;
        
        // Insert emoji at cursor position
        textarea.value = text.substring(0, start) + emoji + text.substring(end);
        
        // Move cursor after the inserted emoji
        textarea.selectionStart = textarea.selectionEnd = start + emoji.length;
        
        // Focus back to textarea
        textarea.focus();
        
        // Trigger input event in case there are other listeners
        textarea.dispatchEvent(new Event('input', { bubbles: true }));
    }

    // Initialize
    updateFilteredEmojis();
    renderEmojis();
});
    </script>
  </body>
</html>
