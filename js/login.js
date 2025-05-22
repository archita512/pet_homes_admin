$(document).ready(function() {
    // Prevent the default form submission
    $("#frm").submit(function(event) {
        event.preventDefault();
        validateAndSubmit();
    });

    // Also handle the button click event
    $("#btnlogin").click(function(event) {
        event.preventDefault();
        validateAndSubmit();
    });

    function validateAndSubmit() {
        // Check if email is empty
        if ($("#email").val() == "" || $("#email").val() == null) {
            showToast("Error", "Email field is required.", "error");
            return false;
        }
        
        // Check if password is empty
        if ($("#password").val() == "" || $("#password").val() == null) {
            showToast("Error", "Password field is required.", "error");
            return false;
        }

        // If validation passes, proceed with login
        const json = { 
            "email": $("#email").val(), 
            "password": $("#password").val() 
        };
        
        console.log(json);
        
        // Send AJAX request
        $.ajax({
            type: "POST",
            url: "crud.php?what=admin_login",
            data: json,
            dataType: "JSON",
            success: function(response) {
                console.log(response);
                if (response.success) {
                    showToast("Notification", response.message, "success");
                    
                    // Redirect after 2 seconds
                    setTimeout(function() {
                        window.location.href = "dashbord.php";
                    }, 2000);
                } else {
                    showToast("Notification", response.message, "error");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error);
                showToast("Error", "Something went wrong. Please try again.", "error");
            }
        });
    }

    // Function to show toast messages
    function showToast(title, message, type) {
        // Remove any existing toast first
        $(".toast-container").remove();
        
        // Set background color based on type
        let bgColor = "#ec7063"; // default red for errors
        if (type === "success") {
            bgColor = "#7dcea0"; // green for success
        }
        
        const toastHTML = `
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div class="toast" id="customToast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">${title}</strong>
                        <small class="text-muted">just now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body" style="background-color: ${bgColor}; color: white;"> 
                        ${message}
                    </div>
                </div>
            </div>
        `;
        
        $('body').append(toastHTML);
        const toastEl = document.getElementById("customToast");
        const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 2000 });
        toast.show();
        
        // Remove toast from DOM after hiding
        toastEl.addEventListener('hidden.bs.toast', function() {
            $(this).parent().remove();
        });
    }
});