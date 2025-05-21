
$(document).ready(function() {
    $("#frm").validate({
        rules: {
            name: {
                required: true
            },
            price: {
                required: true,
            },
            des : {
                required: true
            },
           
        },
        messages: {
           
            name: {
                required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>",
            },
            price : {
                required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>", 
            },
            des : {
                required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>", 
            },
           
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
$("#btnSubmit").click(function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    if ($("#frm").valid()) {
        const formData = new FormData($("#frm")[0]); // Create FormData object from the form
        
        // Log all form data to the console
        for (const [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }
        $.ajax({
            type: "POST",
            url: "crud.php?what=add_offer",
            data: formData,
            contentType: false, // Prevent jQuery from overriding content type
            processData: false, // Prevent jQuery from processing the data
            success: function (response) {
                console.log("AJAX Response:", response);

                if (response.success) {
                    // Toast HTML
                    const toastHTML = `
                        <div class="toast-container position-fixed top-0 end-0 p-3">
                            <div class="toast" id="customToast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto">Success</strong>
                                    <small class="text-muted">just now</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                               <div class="toast-body" style="background-color: #7dcea0; color: white;"> 
                                    ${response.message}
                                </div>
                            </div>
                        </div>
                    `;

                    // Append toast to the body
                    $('body').append(toastHTML);

                    // Initialize and show the toast
                    const toastEl = document.getElementById("customToast");
                    const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 2000 });
                    toast.show();

                    // Remove toast from DOM after hiding
                    toastEl.addEventListener('hidden.bs.toast', function () {
                        toastEl.remove();
                        window.location.href = "offer.php"; // Redirect
                    });
                } else {
                    const toastHTML = `
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div class="toast" id="customToast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto">Error</strong>
                                <small class="text-muted">just now</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                           <div class="toast-body" style="background-color: #ec7063; color: white;"> 
                                ${response.message}
                            </div>
                        </div>
                    </div>
                `;

                // Append toast to the body
                $('body').append(toastHTML);

                // Initialize and show the toast
                const toastEl = document.getElementById("customToast");
                const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 2000 });
                toast.show();
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                console.error("Response Text:", xhr.responseText);
            },
        });
    }
});
$("#btnUpdate").click(function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    if ($("#frm").valid()) {
        const formData = new FormData($("#frm")[0]); // Create FormData object from the form
        
        // Log all form data to the console
        for (const [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }
        $.ajax({
            type: "POST",
            url: "crud.php?what=update_offer",
            data: formData,
            contentType: false, // Prevent jQuery from overriding content type
            processData: false, // Prevent jQuery from processing the data
            success: function (response) {
                console.log("AJAX Response:", response);

                if (response.success) {
                    // Toast HTML
                    const toastHTML = `
                        <div class="toast-container position-fixed top-0 end-0 p-3">
                            <div class="toast" id="customToast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto">Success</strong>
                                    <small class="text-muted">just now</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                               <div class="toast-body" style="background-color: #7dcea0; color: white;"> 
                                    ${response.message}
                                </div>
                            </div>
                        </div>
                    `;

                    // Append toast to the body
                    $('body').append(toastHTML);

                    // Initialize and show the toast
                    const toastEl = document.getElementById("customToast");
                    const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 2000 });
                    toast.show();

                    // Remove toast from DOM after hiding
                    toastEl.addEventListener('hidden.bs.toast', function () {
                        toastEl.remove();
                        window.location.href = "offer.php"; // Redirect
                    });
                } else {
                    const toastHTML = `
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div class="toast" id="customToast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto">Error</strong>
                                <small class="text-muted">just now</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                           <div class="toast-body" style="background-color: #ec7063; color: white;"> 
                                ${response.message}
                            </div>
                        </div>
                    </div>
                `;

                // Append toast to the body
                $('body').append(toastHTML);

                // Initialize and show the toast
                const toastEl = document.getElementById("customToast");
                const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 2000 });
                toast.show();
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                console.error("Response Text:", xhr.responseText);
            },
        });
    }
});