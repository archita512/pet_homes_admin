// File Upload Functionality
document.addEventListener("DOMContentLoaded", function () {
  const dropArea = document.getElementById("dropArea");
  const fileInput = document.getElementById("fileInput");
  const browseLink = document.getElementById("browseLink");
  const filePreview = document.getElementById("filePreview");
  const fileName = document.getElementById("fileName");
  const fileSize = document.getElementById("fileSize");
  const progressBar = document.getElementById("progressBar");
  const progressPercentage = document.getElementById("progressPercentage");
  const removeFile = document.getElementById("removeFile");

  // Failed upload elements
  const fileFailedPreview = document.getElementById("fileFailedPreview");
  const failedFileName = document.getElementById("failedFileName");
  const failedFileThumb = document.getElementById("failedFileThumb");
  const deleteFailedFile = document.getElementById("deleteFailedFile");
  const retryFailedFile = document.getElementById("retryFailedFile");

  let currentFile = null;

  // Trigger file input when browse link is clicked
  browseLink.addEventListener("click", function (e) {
    e.preventDefault();
    fileInput.click();
  });

  // Trigger file input when drop area is clicked
  dropArea.addEventListener("click", function (e) {
    if (e.target !== browseLink) {
      fileInput.click();
    }
  });

  // Handle file selection
  fileInput.addEventListener("change", function () {
    if (this.files && this.files[0]) {
      handleFile(this.files[0]);
    }
  });

  // Handle drag and drop events
  ["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
    dropArea.addEventListener(eventName, preventDefaults, false);
  });

  function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
  }

  ["dragenter", "dragover"].forEach((eventName) => {
    dropArea.addEventListener(eventName, highlight, false);
  });

  ["dragleave", "drop"].forEach((eventName) => {
    dropArea.addEventListener(eventName, unhighlight, false);
  });

  function highlight() {
    dropArea.classList.add("k-drag-over");
  }

  function unhighlight() {
    dropArea.classList.remove("k-drag-over");
  }

  // Handle dropped files
  dropArea.addEventListener("drop", function (e) {
    const dt = e.dataTransfer;
    const files = dt.files;

    if (files && files[0]) {
      handleFile(files[0]);
    }
  });

  // Process the selected file
  function handleFile(file) {
    // Store the current file
    currentFile = file;

    // Check file type
    const validTypes = ["image/jpeg", "image/png"];
    if (!validTypes.includes(file.type)) {
      alert("Only JPG and PNG files are allowed!");
      return;
    }

    // Check file size (max 10MB)
    if (file.size > 10 * 1024 * 1024) {
      alert("File size exceeds 10MB limit!");
      return;
    }

    // Reset any previous failed state
    fileFailedPreview.style.display = "none";

    // Update file info
    const extension = file.name.split(".").pop().toUpperCase();
    const fileNameElement = document.querySelector(".k-file-extension");
    fileNameElement.textContent = extension;

    fileName.textContent = file.name;
    fileSize.textContent = formatFileSize(file.size);

    // Show file preview
    filePreview.style.display = "block";

    // Create thumbnail for potential failed state
    createThumbnail(file);

    // Simulate upload progress with random success/failure
    simulateUpload();
  }

  // Create thumbnail from file
  function createThumbnail(file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      failedFileThumb.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }

  // Format file size
  function formatFileSize(bytes) {
    if (bytes < 1024) return bytes + "B";
    else if (bytes < 1048576) return (bytes / 1024).toFixed(0) + "KB";
    else return (bytes / 1048576).toFixed(1) + "MB";
  }

  // Simulate file upload progress
  function simulateUpload() {
    let progress = 0;
    progressBar.style.width = "0%";
    progressPercentage.textContent = "0%";

    const interval = setInterval(() => {
      progress += 5;
      progressBar.style.width = progress + "%";
      progressPercentage.textContent = progress + "%";

      // Simulate random failure (for demo purposes)
      // Reduced failure probability from 0.3 (30%) to 0.05 (5%)
      // You can set it to 0 to completely disable failures
      if (progress >= 75 && Math.random() < 0.05) {
        clearInterval(interval);
        showUploadFailed();
        return;
      }

      if (progress >= 100) {
        clearInterval(interval);
        // Hide progress bar when upload is complete
        setTimeout(() => {
          document.querySelector(".k-progress-container").style.display =
            "none";
          // You could also add a success indicator here if desired
          // For example: document.querySelector('.k-file-details').classList.add('k-upload-success');
        }, 500); // Short delay to let the user see 100%

        console.log("Upload completed successfully");
      }
    }, 200);
  }

  // Show upload failed state
  function showUploadFailed() {
    // Hide progress preview
    filePreview.style.display = "none";

    // Update failed file info
    failedFileName.textContent = currentFile.name;

    // Show failed preview
    fileFailedPreview.style.display = "flex";
  }

  // Remove file
  removeFile.addEventListener("click", function () {
    filePreview.style.display = "none";
    fileInput.value = "";
    currentFile = null;
  });

  // Delete failed file
  deleteFailedFile.addEventListener("click", function () {
    fileFailedPreview.style.display = "none";
    fileInput.value = "";
    currentFile = null;
  });

  // Retry failed upload
  retryFailedFile.addEventListener("click", function () {
    fileFailedPreview.style.display = "none";
    if (currentFile) {
      // Show progress preview again
      filePreview.style.display = "block";
      // Try upload again
      simulateUpload();
    }
  });
});

// Close button functionality
document.querySelector(".k-btn-cancel").addEventListener("click", function () {
  // In a real application, this would hide the modal
  console.log("Modal canceled");
});

// Save button functionality
document.querySelector(".k-btn-save").addEventListener("click", function () {
  // In a real application, this would save the category
  console.log("Category saved");
});
