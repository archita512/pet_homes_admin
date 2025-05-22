// Enhanced email validation with toast notifications
$("#btnForgotPassword").click(function (e) {
    e.preventDefault(); // Prevent form submission
    
    // Get email value and trim whitespace
    const emailValue = $("#email").val().trim();
    
    // Check if email is empty or null
    if (emailValue === "" || emailValue === null) {
        showToast("Error", "Email field is required.", "error");
        return false;
    }
    
    // Basic email format validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(emailValue)) {
        showToast("Error", "Please enter a valid email address.", "error");
        return false;
    }
    
    // If validation passes, proceed with AJAX request
    const json = { "mail": emailValue };
    console.log(json);
    
    // Disable button during request
    $(this).prop("disabled", true).addClass("btn-disabled");
    
    $.ajax({
        type: "POST",
        method: "POST",
        url: "crud.php?what=sendEmail",
        data: json,
        dataType: "JSON",
        success: function (response) {
            // Re-enable button
            $("#btnForgotPassword").prop("disabled", false).removeClass("btn-disabled");
            
            window.scrollTo({ "top": 0, "behavior": "smooth" });
            
            if (response["success"]) {
                showToast("Success", "OTP has been sent successfully.", "success");
                
                // Store OTP and redirect after delay
                setTimeout(function() {
                    sessionStorage.setItem('otp', response['otp']);
                    window.location.href = "verifyotp.php";
                }, 2000);
            } else {
                showToast("Error", response['message'] || "Failed to send OTP.", "error");
            }
        },
        error: function(xhr, status, error) {
            $("#btnForgotPassword").prop("disabled", false).removeClass("btn-disabled");
            console.error("AJAX Error:", error);
            showToast("Error", "Something went wrong. Please try again.", "error");
        }
    });
});

// Utility function to show toast notifications
function showToast(title, message, type) {
    // Remove any existing toast first
    $("#customToast").remove();
    
    // Determine colors based on type
    let backgroundColor, iconColor;
    switch(type) {
        case 'success':
            backgroundColor = '#7dcea0';
            iconColor = '#27ae60';
            break;
        case 'error':
            backgroundColor = '#ec7063';
            iconColor = '#e74c3c';
            break;
        default:
            backgroundColor = '#85c1e9';
            iconColor = '#3498db';
    }
    
    const toastHTML = `
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
            <div class="toast" id="customToast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                   
                    <strong class="me-auto">${title}</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: ${backgroundColor}; color: white;"> 
                    ${message}
                </div>
            </div>
        </div>
    `;
    
    // Remove any existing toast container
    $('.toast-container').remove();
    
    // Add new toast to body
    $('body').append(toastHTML);
    
    // Initialize and show toast
    const toastEl = document.getElementById("customToast");
    const toast = new bootstrap.Toast(toastEl, { 
        autohide: true, 
        delay: 3000 
    });
    
    toast.show();
    
    // Clean up DOM after toast is hidden
    toastEl.addEventListener('hidden.bs.toast', function () {
        $('.toast-container').remove();
    });
}

// Optional: Real-time validation on input blur
$("#email").on('blur', function() {
    const emailValue = $(this).val().trim();
    
    if (emailValue !== "" && emailValue !== null) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailValue)) {
            showToast("Warning", "Please enter a valid email format.", "error");
        }
    }
});

// Optional: Clear validation styling on input focus
$("#email").on('focus', function() {
    $(this).removeClass('is-invalid');
});

$(document).ready(function() {
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

    // Handle form submission - prevent default form submission
    $("#frm").on('submit', function(e) {
        e.preventDefault(); // Prevent form submission
        verifyOtp(); // Call our verification function
    });

    // Handle verify button click
    $("#verifyOtp").click(function(e) {
        e.preventDefault(); // Prevent form submission
        verifyOtp(); // Call our verification function
    });

    // Handle resend button
    $("#resendBtn").click(function() {
        showToast("Info", "New OTP has been sent to your email", "#3498db");
        
        // Reset inputs
        otpInputs.forEach(input => {
            input.value = '';
        });
        otpInputs[0].focus();
    });
});

// // Main OTP verification function
function verifyOtp() {
    // Get all OTP values and trim whitespace
    const otpFields = [
        $("#otp1").val().trim(),
        $("#otp2").val().trim(),
        $("#otp3").val().trim(),
        $("#otp4").val().trim(),
        $("#otp5").val().trim(),
        $("#otp6").val().trim()
    ];
    
    const email = $("#email").val();
    const expectedOtp = $("#otp").val();



    // Check if any field is empty
    if (otpFields.some(field => field === '')) {
        showToast1("Error", "All OTP fields are required.", "#ec7063");
        return;
    }

    // Combine entered OTP
    const enteredOtp = otpFields.join('');
    

    
    if (expectedOtp !== enteredOtp) {
        showToast1("Error", "OTP is incorrect.", "#ec7063");
    } else {
        $("#verifyOtp").prop("disabled", false);
        showToast1("Success", "OTP verified successfully.", "#7dcea0");
        
        setTimeout(function() {
            sessionStorage.setItem('otp', expectedOtp);
            window.location.href = "resetpassword.php";
        }, 2000);
    }
}

// // Toast helper function
function showToast1(title, message, backgroundColor) {
    const toastId = 'toast_' + Date.now();
    
    const toastHTML = `
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div class="toast" id="${toastId}" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">${title}</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: ${backgroundColor}; color: white;"> 
                    ${message}
                </div>
            </div>
        </div>
    `;

    $('body').append(toastHTML);
    const toastEl = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 3000 });
    toast.show();
    
    toastEl.addEventListener('hidden.bs.toast', function () {
        $(toastEl).parent().remove();
    });
}

$("#resetPwd").click(function () {
    var email = $("#email").val();
    // console.log(email);
    if ($("#newPassword").val() == "" || $("#newPassword").val() == null && $("#confirmPassword").val() == "" || $("#confirmPassword").val() == null) {
        const toastHTML = `
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div class="toast" id="customToast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Error</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #ec7063; color: white;"> 
                    Both Field is required.
                </div>
            </div>
        </div>
    `;

    $('body').append(toastHTML);
    const toastEl = document.getElementById("customToast");
    const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 2000 });
    toast.show();
    
    // Remove toast from DOM after hiding
    toastEl.addEventListener('hidden.bs.toast', function () {
        toastEl.remove();
    });
    } else if ($("#newPassword").val() != $("#confirmPassword").val()) {
        const toastHTML = `
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div class="toast" id="customToast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Error</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #ec7063; color: white;"> 
                    Password and Confirm Password is not match.
                </div>
            </div>
        </div>
    `;

    $('body').append(toastHTML);
    const toastEl = document.getElementById("customToast");
    const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 2000 });
    toast.show();
    
    // Remove toast from DOM after hiding
    toastEl.addEventListener('hidden.bs.toast', function () {
        toastEl.remove();
    });
    } else {
        
        const json = { "email": email, "pwd": $("#newPassword").val() };
        console.log(json);
        $.ajax({
            type: "POST",
            method: "POST",
            url: "crud.php?what=sendNewPwd",
            data: json,
            dataType: "JSON",
            success: function (response) {
                $("#resetPwd").removeAttr("disabled");
                // console.log(response);
                window.scrollTo({ "top": 0, "behavior": "smooth" });
                if (response["success"]) {
                    const toastHTML = `
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div class="toast" id="customToast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto">Success</strong>
                                <small class="text-muted">just now</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body" style="background-color: #7dcea0; color: white;"> 
                                Password updated successfully.
                            </div>
                        </div>
                    </div>`;
                    
                    $('body').append(toastHTML);
                    const toastEl = document.getElementById("customToast");
                    const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 2000 });
                    toast.show();
                    
                    setTimeout(function() {
                        window.location.href = "login.php"; // Redirect after 3 seconds
                    }, 2000); // 3000 milliseconds = 3 seconds;

                }
                else {
                    const toastHTML = `
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div class="toast" id="customToast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto">Error</strong>
                                <small class="text-muted">just now</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body" style="background-color: #ec7063; color: white;"> 
                                    ${response['message']}
                            </div>
                        </div>
                    </div>`;

                    $('body').append(toastHTML);    
                    const toastEl = document.getElementById("customToast");
                    const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 2000 });
                    toast.show();
                    
                }
            }
        });
    }
});