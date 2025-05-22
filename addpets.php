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
    <title>Add Pets</title>
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
  </head>
    <style>
            .k-form-control{
                width: 100% !important;
            }
    </style>
        <style>
    
                #imagePreviewContainer {
                    display: flex;
                    flex-wrap: wrap; /* Allows wrapping to the next line if necessary */
                    gap: 10px; /* Space between images */
                }
                .image-preview {
                    position: relative;
                    width: 150px; /* Set a fixed width for each image */
                }
                .image-preview img {
                    width: 90%;
                    height: 108px; /* Set a fixed height for each image */
                    object-fit: cover; /* Maintain aspect ratio */
                }

        </style>
     <?php
          if (isset($_GET['id']) && !empty($_GET['id'])) {
              $id_a=$_GET['id'];
              $id=encryptor('decrypt', $id_a);
              $query = mysqli_query($cnn, "select * from pets where id=" . $id . "");
              $row = mysqli_fetch_array($query);
              $name = $row['name'];
              if (is_array($row['image'])) {
                $image = $row['image']; // Already an array
            } else {
                $image = json_decode($row['image'], true); // Decode JSON string to array
            }
              $cat_id = $row['cat_id'];
              $sub_id = $row['sub_id'];
              $price = $row['price'];
              $description = $row['des'];
              $type_listing = $row['type_listing'];
              $pet_age = $row['pet_age'];
              $pets_littel = $row['pets_littel'];
              $pets_available = $row['pets_available'];
              $adv_location = $row['adv_location'];
              $health_check = $row['health_check'];
              $origina_breeder = $row['origina_breeder'];
              $warm_flat = $row['warm_flat'];
              $Vaccination = $row['Vaccination'];
              $pet_viewable = $row['pet_viewable'];
              $kc_register = $row['kc_register'];
              $microchipped = $row['microchipped'];
              $country = $row['country'];



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
            <h2 class="k-modal-title ps-4"><?php if(isset($_GET['id'])){ echo 'Updated Category'; } else { echo 'Add Category'; } ?></h2>
          </div>
          <form id="frm" action="" method="POST" enctype="multipart/form-data">
          <div class="card" style="width: 1517px; margin-left: 50px; margin-top: 30px;height: 1053px;">
          <div class="k-modal-body">
          <div class="row">
            <div class="col-sm-6">
                <div>
                <input id="txtUId" name="txtUId" value="<?php if (isset($_GET['id'])) {
                    echo $row['id'];
                } ?>" hidden />

                <div class="mb-3">
                <div class="k-form-group">
                <label class="k-form-label">Category</label>
                <select name="cat_id" id="cat_id" class="k-form-control" onchange="fetchSubcategories(this.value)">
                        <option value="">Select Category</option>
                        <?php
                        // Retrieve the category ID if updating
                        if (isset($_GET['id'])) {
                            $cat_id = $row['cat_id']; // Use cat_id for comparison
                        }
                        $query = mysqli_query($cnn, "select * from category where status='Active'");    
                        while ($category = mysqli_fetch_array($query)) { // Changed variable name to avoid conflict
                            $selected = (isset($_GET['id']) && $category['id'] == $cat_id) ? 'selected' : '';  // Ensure correct comparison
                            echo "<option value='".$category['id']."' $selected>".$category['name']."</option>";
                        }
                        ?>
                        </select>
                      </div>
                    </div>
                <div class="mb-3">
                <div class="k-form-group">
                        <label class="k-form-label">Pet Name</label>
                        <input
                          type="text"
                          class="k-form-control"
                          placeholder="Pet Name"
                          name="name"
                          id="name"
                          value="<?php if (isset($_GET['id'])) {
                            echo $name;
                        } ?>"
                        />
                      </div>
                    </div>

                    <div class="mb-3">
                   <div class="k-form-group">
                        <label class="k-form-label">Country</label>
                        <input
                          type="text"
                          class="k-form-control"
                          placeholder="Country"
                          name="country"
                          id="country"
                          value="<?php if (isset($_GET['id'])) {
                            echo $country;
                        } ?>"
                        />
                      </div>
                    </div>
                    <div class="k-form-group">
                    <label for="images">Pet Images</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                    <small class="form-text text-muted">Select multiple images (jpg, jpeg, png, gif)</small>
                    </div>
                </div>
                <div class="mb-3">
                     <div class="k-form-group">
                        <label class="k-form-label">Type Of Listitng</label>
                        <input
                          type="text"
                          class="k-form-control"
                          placeholder="Type Of Listitng"
                          name="type_list"
                          id="type_list"
                          value="<?php if (isset($_GET['id'])) {
                            echo $type_listing;
                        } ?>"
                        />
                      </div>
                    </div>
                    <div class="mb-3">
                     <div class="k-form-group">
                        <label class="k-form-label"> Pet Age</label>
                        <input
                          type="text"
                          class="k-form-control"
                          placeholder="Age"
                          name="age"
                          id="age"
                          value="<?php if (isset($_GET['id'])) {
                            echo $pet_age;
                        } ?>"
                        />
                      </div>
                    </div>
                    <div class="mb-3">
                     <div class="k-form-group">
                        <label class="k-form-label"> Pet Available</label>
                        <input
                          type="date"
                          class="k-form-control"
                       
                          name="av_date"
                          id="av_date"
                          value="<?php if (isset($_GET['id'])) {
                            echo $pets_available;
                        } ?>"
                        />
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <div class="k-form-group">
                                    <label class="k-form-label"><b>Health Check</b></label>
                                    <div>
                                        <input type="radio" id="h_check1" name="h_check1" value="Yes" <?php if (isset($_GET['id']) && $health_check == 'Yes') echo 'checked'; ?>>
                                        <label for="h_check1">Yes</label> 
                                        <input type="radio" id="h_check1_no" name="h_check1" value="No" <?php if (isset($_GET['id']) && $health_check == 'No') echo 'checked'; ?>>
                                        <label for="h_check1_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <div class="k-form-group">
                                    <label class="k-form-label"><b>Origina Breeder</b></label>
                                    <div>
                                        <input type="radio" id="h_check2" name="h_check2" value="Yes" <?php if (isset($_GET['id']) && $origina_breeder == 'Yes') echo 'checked'; ?>>
                                        <label for="h_check2">Yes</label> 
                                        <input type="radio" id="h_check2_no" name="h_check2" value="No" <?php if (isset($_GET['id']) && $origina_breeder == 'No') echo 'checked'; ?>>
                                        <label for="h_check2_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <div class="k-form-group">
                                    <label class="k-form-label"><b>Warm Flat</b></label>
                                    <div>
                                        <input type="radio" id="h_check2" name="h_check3" value="Yes" <?php if (isset($_GET['id']) && $warm_flat == 'Yes') echo 'checked'; ?>>
                                        <label for="h_check2">Yes</label> 
                                        <input type="radio" id="h_check2_no" name="h_check3" value="No" <?php if (isset($_GET['id']) && $warm_flat == 'No') echo 'checked'; ?>>
                                        <label for="h_check2_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="mb-3">
                     <div class="k-form-group">
                        <label class="k-form-label">Description</label>
                        <textarea
                          type="text"
                          rows="4"
                          class="k-form-control"
                          placeholder="Description"
                          name="description"
                          id="description"
                         
                        > <?php if (isset($_GET['id'])) {
                            echo $description;
                        } ?></textarea>
                      </div>
                    </div>
              </div>
                <div class="col-sm-6">
                <div class="mb-3">
                <div class="k-form-group">
                <label class="k-form-label">Subcategory</label>
                        <select name="subcat_id" id="subcat_id" class="k-form-control">
                        <option value="">Select Subcategory</option>
                        <?php
                        // Fetch subcategories based on the selected category
                        if (isset($_GET['id'])) {
                            $sub_id = $row['sub_id']; // Get the subcategory ID from the fetched row
                            $query_subcategories = mysqli_query($cnn, "SELECT * FROM subcategory WHERE cat_id = '$cat_id' AND status='Active'");
                            while ($subcategory = mysqli_fetch_array($query_subcategories)) {
                                $selected = ($subcategory['id'] == $sub_id) ? 'selected' : ''; // Check if this subcategory is the selected one
                                echo "<option value='".$subcategory['id']."' $selected>".$subcategory['name']."</option>";
                            }
                        }
                        ?>
                        </select>
                      </div>
                    </div>
                    <div class="mb-3">
                     <div class="k-form-group">
                        <label class="k-form-label">Price</label>
                        <input
                          type="number"
                          class="k-form-control"
                          placeholder="Price"
                          name="price"
                          id="price"
                          value="<?php if (isset($_GET['id'])) {
                            echo $price;
                        } ?>"
                        />
                      </div>
                        </div>
                       
                        <div class="mt-4" id="imagePreviewContainer">
                                 <!-- This will be populated with selected images -->
                              <?php if (isset($_GET['id'])): ?>
                                  <?php 
                                  // Assuming $images is an array of image URLs
                                  foreach ($image as $img): // Loop through each image
                                  ?>
                                      <div class="image-preview">
                                          <img src="../pet_homes/img/<?php echo trim($img); ?>" class="img-thumbnail">
                                          <!-- <button type="button" class="btn btn-sm btn-danger position-absolute" 
                                                  style="top: 5px;right: 29px;padding: 0 5px;width: 23px;" 
                                                  onclick="removeImage(this, '<?php echo trim($img); ?>')">
                                              &times;
                                          </button> -->
                                      </div>
                                  <?php endforeach; ?>
                              <?php endif; ?>
                          </div>
                        <div class="mb-3">
                        <div class="k-form-group">
                        <label class="k-form-label">Pet little</label>
                        <input
                          type="text"
                          class="k-form-control"
                          placeholder="Little"
                          name="little"
                          id="little"
                          value="<?php if (isset($_GET['id'])) {
                            echo $pets_littel;
                        } ?>"
                        />
                      </div>
                    </div>
                    <div class="mb-3">
                     <div class="k-form-group">
                        <label class="k-form-label"> Pet Location</label>
                        <input
                          type="text"
                          class="k-form-control"
                       
                          name="pet_loc"
                          id="pet_loc"
                          value="<?php if (isset($_GET['id'])) {
                            echo $adv_location;
                        } ?>"
                        />
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <div class="k-form-group">
                                    <label class="k-form-label"><b>Vaccination</b></label>
                                    <div>
                                        <input type="radio" id="h_check1" name="h_check4" value="Yes" <?php if (isset($_GET['id']) && $Vaccination == 'Yes') echo 'checked'; ?>>
                                        <label for="h_check1">Yes</label> 
                                        <input type="radio" id="h_check1_no" name="h_check4" value="No" <?php if (isset($_GET['id']) && $Vaccination == 'No') echo 'checked'; ?>>
                                        <label for="h_check1_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <div class="k-form-group">
                                    <label class="k-form-label"><b>Pet Viewable</b></label>
                                    <div>
                                        <input type="radio" id="h_check2" name="h_check5" value="Yes" <?php if (isset($_GET['id']) && $pet_viewable == 'Yes') echo 'checked'; ?>>
                                        <label for="h_check2">Yes</label> 
                                        <input type="radio" id="h_check2_no" name="h_check5" value="No" <?php if (isset($_GET['id']) && $pet_viewable == 'No') echo 'checked'; ?>>
                                        <label for="h_check2_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <div class="k-form-group">
                                    <label class="k-form-label"><b>KC Register</b></label>
                                    <div>
                                        <input type="radio" id="h_check2" name="h_check6" value="Yes" <?php if (isset($_GET['id']) && $kc_register == 'Yes') echo 'checked'; ?>>
                                        <label for="h_check2">Yes</label> 
                                        <input type="radio" id="h_check2_no" name="h_check6" value="No" <?php if (isset($_GET['id']) && $kc_register == 'No') echo 'checked'; ?>>
                                        <label for="h_check2_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <div class="k-form-group">
                                    <label class="k-form-label"><b>Microchipped</b></label>
                                    <div>
                                        <input type="radio" id="h_check2" name="h_check7" value="Yes" <?php if (isset($_GET['id']) && $microchipped == 'Yes') echo 'checked'; ?>>
                                        <label for="h_check2">Yes</label> 
                                        <input type="radio" id="h_check2_no" name="h_check7" value="No" <?php if (isset($_GET['id']) && $microchipped == 'No') echo 'checked'; ?>>
                                        <label for="h_check2_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                   
                    
                    </div>
            </div>
            

            <div class="k-modal-footer">
            <button type="button" class="k-btn-cancel" onclick="window.location.href='pets.php'">Cancel</button>
            <button type="submit"  name="<?php echo isset($_GET['id']) ? 'btnUpdate' : 'btnSubmit'; ?>"
            id="<?php echo isset($_GET['id']) ? 'btnUpdate' : 'btnSubmit'; ?>" class="k-btn-save">Save</button>
          </div>
        </div>
        </form>
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
              <a href="#">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="#" class="active d-flex align-items-center">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
            
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/css/bootstrap-toaster.min.css" integrity="sha512-613efYxCWhUklTCFNFaiPW4q6XXoogGNsn5WZoa0bwOBlVM02TJ/JH7o7SgWBnJIQgz1MMnmhNEcAVGb/JDefw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/css/bootstrap-toaster.css" integrity="sha512-DkcySkzTXJAPu18869uNSKlHOcm9UKvy4phZvC3b60guZveNCHI79sTM3wGJRNaqWSm9/7s07ztsgjonhJhI3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/js/bootstrap-toaster.js" integrity="sha512-vG793m0UbmHpDP9w5eGmPczh4JJ5HUZKi+WBReYTPzaefQ/eLInVo/MeDYvnE0LsM7NlUbgtf/jGG5c6JmO6Pg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/5.0.0/js/bootstrap-toaster.min.js" integrity="sha512-bPZBFTQxrZnfFHJqMjP9VVXVigWPjrDHWoPVgsdo2hGNUEY9WF9HQjWfvWnFEduF9cwmsbtKoQ9QkiPkTTUHwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/fileUpload.js"></script>
    <script src="js/pets.js"></script>
    <script>
      $("#images").on("change", function () {
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
function removeImage(button, imgSrc) {
    // Remove the image preview from the DOM
    $(button).closest('.image-preview').remove();
    
    // Update the hidden input field to reflect the remaining images
    let existingImages = $('#existingImages').val().split(',');
    existingImages = existingImages.filter(img => img !== imgSrc.trim());
    $('#existingImages').val(existingImages.join(','));
    
    // Optionally, you can also update the displayed count of images if needed
    // For example, you can show a message or update a counter
}

    $(document).ready(function() {
        // Image preview functionality
        $('#images').on('change', function() {
            const previewContainer = $('#imagePreviewContainer');
            
            // Only clear existing previews if new files are selected
            if (this.files.length > 0) {
                previewContainer.empty(); // Clear existing previews
            }
            
            if (this.files) {
                const files = Array.from(this.files);
                
                // Check if too many files are selected (optional)
                if (files.length > 10) {
                    alert('Please select a maximum of 10 images');
                    this.value = '';
                    return;
                }
                
                files.forEach(file => {
                    if (!file.type.match('image.*')) {
                        return; // Skip non-image files
                    }
                    
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const preview = $(`
                            <div class="image-preview">
                                <img src="${e.target.result}" class="img-thumbnail">
                                
                            </div>
                        `);
                        
                        // Add remove functionality
                        preview.find('button').on('click', function() {
                            preview.remove(); // Remove the specific image preview
                        });
                        
                        previewContainer.append(preview);
                    };
                    
                    reader.readAsDataURL(file);
                });
            }
        });
    });

    function fetchSubcategories(categoryId) {
            if (categoryId) {
                $.ajax({
                    url: 'crud.php?what=fetch_subcategories', // Create this file to handle the request
                    type: 'POST',
                    data: { category_id: categoryId },
                    success: function(data) {
                        $('#subcat_id').html(data); // Populate subcategory dropdown
                    }
                });
            } else {
                $('#subcat_id').html('<option value="">Select Subcategory</option>'); // Reset subcategory dropdown
            }
        }
    </script>
  </body>
</html>
<!-- <button type="button" class="btn btn-sm btn-danger position-absolute" 
                                //         style="top: 5px;right: 29px;padding: 0 5px;width: 23px;">
                                //     &times;
                                // </button> -->
