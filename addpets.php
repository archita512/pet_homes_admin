<?php 
include 'connection.php'; 
include 'config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add category</title>
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
        .imgBox {
            border: 1px solid black;
            width: 230px;
            height: 200px;
        }
    </style>
     <?php
          if (isset($_GET['id']) && !empty($_GET['id'])) {
              $id_a=$_GET['id'];
              $id=encryptor('decrypt', $id_a);
              $query = mysqli_query($cnn, "select * from subcategory where id=" . $id . "");
              $row = mysqli_fetch_array($query);
              $name = $row['name'];
              $image = $row['image'];
              $cat_id = $row['cat_id'];

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
          <div class="card" style="width: 1517px; margin-left: 50px; margin-top: 30px;height: 953px;">
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
                        <select name="cat_id" id="cat_id" class="k-form-control">
                        <option value="">Select Category</option>
                        <?php
                        // Retrieve the restaurant ID if updating
                        if (isset($_GET['id'])) {
                            $cat_id = $row['cat_id']; // Use cat_id for comparison
                        }
                        $query = mysqli_query($cnn, "select * from category where status='Active'");    
                        while ($row = mysqli_fetch_array($query)) {
                            $selected = (isset($_GET['id']) && $row['id'] == $cat_id) ? 'selected' : '';  
                            echo "<option value='".$row['id']."' $selected>".$row['name']."</option>";
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

                  
                    <div class="k-form-group">
                    <label for="image" class="k-form-label mt-3">Image</label>
                    <input type="file" id="image" name="image" accept="image/*" class="k-form-control" value="<?php if (isset($_GET['id'])) {
                        echo $image;
                    } ?>" multiple/>
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
                            echo $age;
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
                                        <input type="radio" id="h_check1" name="h_check1" value="Yes">
                                        <label for="h_check1">Yes</label> 
                                        <input type="radio" id="h_check1_no" name="h_check1" value="No">
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
                                        <input type="radio" id="h_check2" name="h_check2" value="Yes">
                                        <label for="h_check2">Yes</label> 
                                        <input type="radio" id="h_check2_no" name="h_check2" value="No">
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
                                        <input type="radio" id="h_check2" name="h_check3" value="Yes">
                                        <label for="h_check2">Yes</label> 
                                        <input type="radio" id="h_check2_no" name="h_check3" value="No">
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
                          value="<?php if (isset($_GET['id'])) {
                            echo $pets_littel;
                        } ?>"
                        ></textarea>
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
                        // Retrieve the restaurant ID if updating
                        if (isset($_GET['id'])) {
                            $sub_id = $row['sub_id']; // Use sub_id for comparison
                        }
                        $query = mysqli_query($cnn, "select * from subcategory where status='Active'");    
                        while ($row = mysqli_fetch_array($query)) {
                            $selected = (isset($_GET['id']) && $row['id'] == $sub_id) ? 'selected' : '';  
                            echo "<option value='".$row['id']."' $selected>".$row['name']."</option>";
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
                    <div class="mt-4">
                    <img src="<?php if (isset($_GET['id'])) {
                        echo "../pet_homes/img/" . $image;
                    } ?>" id="txtImport" name="txtImport" class="imgBox" width="100%" height="100%" style="margin-left: 128px;" />
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
                                        <input type="radio" id="h_check1" name="h_check4" value="Yes">
                                        <label for="h_check1">Yes</label> 
                                        <input type="radio" id="h_check1_no" name="h_check4" value="No">
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
                                        <input type="radio" id="h_check2" name="h_check5" value="Yes">
                                        <label for="h_check2">Yes</label> 
                                        <input type="radio" id="h_check2_no" name="h_check5" value="No">
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
                                        <input type="radio" id="h_check2" name="h_check6" value="Yes">
                                        <label for="h_check2">Yes</label> 
                                        <input type="radio" id="h_check2_no" name="h_check6" value="No">
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
                                        <input type="radio" id="h_check2" name="h_check7" value="Yes">
                                        <label for="h_check2">Yes</label> 
                                        <input type="radio" id="h_check2_no" name="h_check7" value="No">
                                        <label for="h_check2_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                   
                    
                    </div>
            </div>
            

            <div class="k-modal-footer">
            <button type="button" class="k-btn-cancel" onclick="window.location.href='category.php'">Cancel</button>
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
  </body>
</html>
