<?php 
include 'connection.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>forgot Password</title>
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body>
    <div class="k-pet-image">
      <div class="k-login-container">
        <div class="k-main-container">
          <div class="k-login-form-container">
            <div class="k-logo fs-4">LOGO</div>

            <h2 class="k-login-title text-center fw-semibold">Forgot Password?</h2>
            <p class="k-forgot-subtitle text-center">
                To recover your account, please enter your email below.
            </p>

            <form id="frm" method="post" action="">
              <div class="my-3">
                <label for="email" class="k-form-label">Email</label>
                <input
                  type="email"
                  class="form-control k-form-control k-label-color"
                  id="email"
                  name ="email"
                  placeholder="Your Email"
                  
                />
              </div>

              <button type="submit" class="k-login-btn mt-4" id="btnForgotPassword" name="btnForgotPassword">Send Code</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery Validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    
    <script src="js/forgot_password.js"></script>
  </body>
</html>
