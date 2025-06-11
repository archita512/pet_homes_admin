$(document).ready(function() {
    $("#frm").validate({
        rules: {
            name: {
                required: true
            },
            cat_id: {
                required: true
            },
            // image : {
            //     required: true
            // },
            type_list : {
                required: true
            },
            age : {
                required: true
            },
            av_date : {
                required: true
            },
            description : {
                required: true
            },
            subcat_id : {
                required: true
            },
            price : {
                required: true
            },
            little : {
                required: true
            },
            pet_loc : {
                required: true
            },
        
        },
        messages: {
           
            name: {
                required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>",
            },
            cat_id: {
                required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>",
            },
            // image: {
            //     required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>",
            // },
            type_list : {
                required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>",
            },
            age : {
                required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>",
            },
            av_date : {
                required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>",
            },
            description : {
                required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>",
            },
            subcat_id : {
                required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>",

            },
            price : {
                required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>",
            },
            little : {
                required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>",
            },
            pet_loc : {
                required: "<span class='text-danger' style='font-size:small;'>This field is required.</span>",

            }


           
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
        
        // Check if image is selected
        const imageInput = $("#frm input[type='file']"); // Adjust selector based on your image input
        let imageSelected = false;
        
        // Check if any file input has a file selected
        imageInput.each(function() {
            if (this.files && this.files.length > 0) {
                imageSelected = true;
                return false; // Break out of loop
            }
        });
        
        // If no image is selected, show error message
        if (!imageSelected) {
            // Toast HTML for error
            const toastHTML = `
                <div class="toast-container position-fixed top-0 end-0 p-3">
                    <div class="toast" id="customToast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">Error</strong>
                            <small class="text-muted">just now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                       <div class="toast-body" style="background-color: #ec7063; color: white;"> 
                            Image is not selected. Please choose an image.
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
            
            return; // Stop form submission
        }
        
        // Log the form data for debugging
        console.log("Form data being submitted:");
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
        
        
        $.ajax({
            type: "POST",
            url: "crud.php?what=add_pet",
            data: formData,
            contentType: false, // Prevent jQuery from overriding content type
            processData: false, // Prevent jQuery from processing the data
            success: function (response) {
                // Parse the response if it's a string
                if (typeof response === 'string') {
                    try {
                        response = JSON.parse(response);
                    } catch (e) {
                        console.error("Error parsing response:", e);
                    }
                }
                
                console.log("AJAX Response:", response);

                if (response.success) {
                    // Toast HTML for success
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
                        window.location.href = "pets.php"; // Redirect
                    });
                } else {
                    // Toast HTML for error
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
                
                // Show error toast for AJAX failures
                const toastHTML = `
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div class="toast" id="customToast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto">Error</strong>
                                <small class="text-muted">just now</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                           <div class="toast-body" style="background-color: #ec7063; color: white;"> 
                                An error occurred while processing your request.
                            </div>
                        </div>
                    </div>
                `;
                
                $('body').append(toastHTML);
                const toastEl = document.getElementById("customToast");
                const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 2000 });
                toast.show();
            },
        });
    }
});
$("#btnUpdate").click(function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    if ($("#frm").valid()) {
        const formData = new FormData($("#frm")[0]); // Create FormData object from the form
        
        // Log the form data for debugging
        console.log("Form data being submitted:");
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
        
        $.ajax({
            type: "POST",
            url: "crud.php?what=update_pet",
            data: formData,
            contentType: false, // Prevent jQuery from overriding content type
            processData: false, // Prevent jQuery from processing the data
            success: function (response) {
                // Parse the response if it's a string
                if (typeof response === 'string') {
                    try {
                        response = JSON.parse(response);
                    } catch (e) {
                        console.error("Error parsing response:", e);
                    }
                }
                
                console.log("AJAX Response:", response);

                if (response.success) {
                    // Toast HTML for success
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
                        window.location.href = "pets.php"; // Redirect
                    });
                } else {
                    // Toast HTML for error
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
                
                // Show error toast for AJAX failures
                const toastHTML = `
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div class="toast" id="customToast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <strong class="me-auto">Error</strong>
                                <small class="text-muted">just now</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                           <div class="toast-body" style="background-color: #ec7063; color: white;"> 
                                An error occurred while processing your request.
                            </div>
                        </div>
                    </div>
                `;
                
                $('body').append(toastHTML);
                const toastEl = document.getElementById("customToast");
                const toast = new bootstrap.Toast(toastEl, { autohide: true, delay: 2000 });
                toast.show();
            },
        });
    }
});