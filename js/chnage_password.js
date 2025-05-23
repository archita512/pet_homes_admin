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