  <?php
  include 'connection.php';
  session_start();
  if(!isset($_SESSION['email'])){
      header('Location: Forgot-Password.php');
      exit;
  }
  if(isset($_SESSION['email'])){
      $email = $_SESSION['email'];
  }else{
      $email = "";
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Verify OTP</title>
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

              <h2 class="k-login-title text-center fw-semibold">Verify OTP</h2>
              <p class="k-login-subtitle text-center">
                We've sent a code to <strong class="text-black text-decoration-underline" id=""><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></strong> Please enter it to
                verify your email.
              </p>
              <div class="k-verify-container">
                <form id="frm" method="POST" action="">
                <input type="hidden" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
                <input type="hidden" id="otp" name="otp" value="<?php echo isset($_SESSION['otp']) ? $_SESSION['otp'] : '1234'; ?>">
                  <div class="otp-input-container">
                    <input type="text" maxlength="1" class="otp-input" id="otp1" autofocus>
                    <input type="text" maxlength="1" class="otp-input" id="otp2">
                    <input type="text" maxlength="1" class="otp-input" id="otp3">
                    <input type="text" maxlength="1" class="otp-input" id="otp4">
                    <input type="text" maxlength="1" class="otp-input" id="otp5">
                    <input type="text" maxlength="1" class="otp-input" id="otp6">
                  </div>
                  
                  <button type="submit" class="verify-btn" id="verifyOtp">Verify OTP</button>
                </form>
                
                <p class="resend-text">
                  Didn't received code? <span class="resend-link" id="resendBtn">Resend</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Bootstrap JS Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
      <!-- Bootstrap JS Bundle -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      
      <!-- jQuery Validate -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
      
      <script src="js/forgot_password.js"></script>
      <script>
        // Get stored email from localStorage if available
        document.addEventListener('DOMContentLoaded', function() {
          const storedEmail = localStorage.getItem('userEmail');
          if (storedEmail) {
            document.getElementById('userEmail').textContent = storedEmail;
          }
          
          // Set up OTP input behavior
          const otpInputs = document.querySelectorAll('.otp-input');
          
          otpInputs.forEach((input, index) => {
            // Auto-focus next input when a digit is entered
            input.addEventListener('input', function() {
              if (this.value.length === 1) {
                if (index < otpInputs.length - 1) {
                  otpInputs[index + 1].focus();
                }
              }
            });
            
            // Handle backspace to go to previous input
            input.addEventListener('keydown', function(e) {
              if (e.key === 'Backspace' && this.value.length === 0 && index > 0) {
                otpInputs[index - 1].focus();
              }
            });
            
            // Only allow numbers
            input.addEventListener('keypress', function(e) {
              if (!/[0-9]/.test(e.key)) {
                e.preventDefault();
              }
            });
            
            // Handle paste event
            input.addEventListener('paste', function(e) {
              e.preventDefault();
              const pastedData = e.clipboardData.getData('text');
              const digits = pastedData.match(/\d/g);
              
              if (digits && digits.length > 0) {
                for (let i = 0; i < digits.length && i + index < otpInputs.length; i++) {
                  otpInputs[i + index].value = digits[i];
                  if (i + index < otpInputs.length - 1) {
                    otpInputs[i + index + 1].focus();
                  }
                }
              }
            });
          });
          
          // Handle form submission
          document.getElementById('otpForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Collect OTP values
            let otp = '';
            otpInputs.forEach(input => {
              otp += input.value;
            });
            
            // Validate OTP (in a real app, you would send this to your server)
            if (otp.length === 6) {
              // For demo purposes, redirect to reset password page
              window.location.href = 'resetpassword.php';
            } else {
              alert('Please enter a complete 6-digit OTP');
            }
          });
          
          // Handle resend button
          document.getElementById('resendBtn').addEventListener('click', function() {
            // In a real app, you would call your API to resend the OTP
            alert('New OTP has been sent to your email');
            
            // Reset inputs
            otpInputs.forEach(input => {
              input.value = '';
            });
            otpInputs[0].focus();
          });
        });
      </script>
    </body>
  </html>
