<?php
include 'connection.php';
session_start();
if ($_GET['what'] == "admin_login") {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $query = mysqli_query($cnn, "select count(*) from login  where email='" . $email . "'");
    $row = mysqli_fetch_array($query);
    if ($row[0] > 0) {
        $response['success'] = true;
        $query_chk = mysqli_query($cnn, "select * from login where email='" . $email . "'");
        $row_chk = mysqli_fetch_array($query_chk);
        $check = password_verify($pass, $row_chk['password']);
        if ($check == true) {
            $response['success'] = true;
            $query_status = mysqli_query($cnn, "select * from login where email='" . $email . "'");
            $row_status = mysqli_fetch_array($query_status);
            if ($row_status['status'] == "Active") {
                $response['success'] = true;
                $response['message'] = "<span  style='font-weight:100;color:black;font-size:15px;'>Login successfully.</span>";
                $_SESSION['admin'] = $row_status['email'];

            } else {
                $response['success'] = false;
                $response['message'] = "<span  style='font-weight:100;color:black;font-size:15px;'>Your account has been block.</span>";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "<span  style='font-weight:100;color:black;font-size:15px;'>Password not match.</span>";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "<span  style='font-weight:100;color:black;font-size:15px;'>Email not found.</span>";
    }
    echo json_encode($response);
}

//  forget password asend mail
if ($_GET['what'] == "sendEmail") {
    $mail = $_POST['mail'];
    // Check if the email exists in the database
    $query = mysqli_query($cnn, "SELECT count(*) FROM login WHERE email='" . $mail . "'");
    
    // Fetch the result
    $row = mysqli_fetch_array($query);
    
    // Check if the email exists
    if ($row[0] > 0) {
        // Email exists, proceed to send OTP
        $num = rand(100000, 999999);
        $to = $mail;
        $subject = "Pets Home Admin Password Reset";
        $message = "Dear " . $mail . ",\n\nYour OTP for resetting password is " . $num . "";
        $headers = "From: Pets Home Admin ";
        
        // Send the email
        mail($to, $subject, $message, $headers);
        
        // Store OTP in session and update in database
        $_SESSION['otp'] = $num;
        $_SESSION['email'] = $mail;
        $query = mysqli_query($cnn, "UPDATE login SET otp = '$num' WHERE email = '$mail'");
        
        if ($query) {
            $response["success"] = true;
            $response["message"] = "<span style='font-size:14px;' class='text-dark'>OTP sent successfully</span>";
            $response["otp"] = $num;
        } else {
            $response['success'] = false;
            $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Failed to update OTP in database.</span>";
        }
    } else {
        // Email not found
        $response['success'] = false;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Email not found</span>";
    }
    
    echo json_encode($response);
}
// forgetpassword new password update
if ($_GET['what'] == "sendNewPwd") {
    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $query = mysqli_query($cnn, "update login set password='" . $pwd . "' where email='" . $email . "'");
    if ($query > 0) {
        $response['success'] = true;
        $response['message'] = "<span  style='font-weight:100;color:black;font-size:15px;' >Password updated successfully</span>";
    } else {
        $response['success'] = false;
        $response['message'] = "<span  style='font-weight:100;color:black;font-size:15px;' >Some error occured.Please try again</span>";

    }
    echo json_encode($response);
}
if ($_GET['what'] == "add_category") {
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    
    $response = [];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the file name in DB
            $imageName = $uniqueName;
        } else {
            echo json_encode(["success" => false, "message" => "Image upload failed."]);
           
        }
    }
    if (!empty($name)) {
        $query = mysqli_query($cnn, "SELECT COUNT(*) AS count FROM category WHERE name = '$name'");
        $row = mysqli_fetch_assoc($query);

        if ($row['count'] > 0) {
            $response['success'] = false;
            $response['message'] = "Category already exists.";
        } else {
            // Insert category with status
            $query_insert = mysqli_query($cnn, "INSERT INTO category (name,image, status) VALUES ('$name','$imageName', 'Active')");
            if ($query_insert) {
                $response['success'] = true;
                $response['message'] = "Category added successfully.";
            } else {
                // Capture SQL error
                $response['success'] = false;
                $response['message'] = "Failed to add category. SQL Error: " . mysqli_error($cnn);
            }
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Category name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if ($_GET['what'] == "update_category") {
    $id = mysqli_real_escape_string($cnn, $_POST['txtUId']);
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    
    $response = [];
    $imageName = ""; // Initialize imageName

    // Fetch existing image name from the database
    $existingQuery = mysqli_query($cnn, "SELECT image FROM category WHERE id = '$id'");
    $existingRow = mysqli_fetch_assoc($existingQuery);
    $existingImage = $existingRow['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the new file name in DB
            $imageName = $uniqueName;
        } else {
            echo json_encode(["success" => false, "message" => "Image upload failed."]);
        }
    } else {
        // If no new image is uploaded, use the existing image name
        $imageName = $existingImage;
    }

    if (!empty($name)) {
        // Insert category with status
        $query_insert = mysqli_query($cnn, "UPDATE category SET name = '$name', image = '$imageName' WHERE id = '$id'");
        if ($query_insert) {
            $response['success'] = true;
            $response['message'] = "Category Update successfully.";
        } else {
            // Capture SQL error
            $response['success'] = false;
            $response['message'] = "Failed to add category. SQL Error: " . mysqli_error($cnn);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Category name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if($_GET['what'] == "update_status"){
    // Get the JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];
    $status = $input['status'];

    // Update the status in the database
    $query = "UPDATE category SET status = ? WHERE id = ?";
    $stmt = $cnn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    
    if($stmt->execute()){
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();
}
if ($_GET['what'] == "delete_category") {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];

    $query = mysqli_query($cnn, "DELETE FROM category WHERE id = " . intval($id));

    if ($query) {
        $response['success'] = true;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Record Deleted successfully</span>";
    } else {
        $response['success'] = false;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Some error occurred. Please try again</span>";
    }

    echo json_encode($response);
   
}
if ($_GET['what'] == "add_subcategory") {
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    $cat_id = mysqli_real_escape_string($cnn, $_POST['cat_id']);
    
    $response = [];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the file name in DB
            $imageName = $uniqueName;
        } else {
            echo json_encode(["success" => false, "message" => "Image upload failed."]);
           
        }
    }
    if (!empty($name)) {
        $query = mysqli_query($cnn, "SELECT COUNT(*) AS count FROM subcategory WHERE name = '$name'");
        $row = mysqli_fetch_assoc($query);

        if ($row['count'] > 0) {
            $response['success'] = false;
            $response['message'] = "Subcategory already exists.";
        } else {
            // Insert subcategory with status
            $query_insert = mysqli_query($cnn, "INSERT INTO subcategory (name,image, status,cat_id) VALUES ('$name','$imageName', 'Active','$cat_id')");
            if ($query_insert) {
                $response['success'] = true;
                $response['message'] = "Subcategory added successfully.";
            } else {
                // Capture SQL error
                $response['success'] = false;
                $response['message'] = "Failed to add Subcategory. SQL Error: " . mysqli_error($cnn);
            }
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Subcategory name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if ($_GET['what'] == "update_subcategory") {
    $id = mysqli_real_escape_string($cnn, $_POST['txtUId']);
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    $cat_id = mysqli_real_escape_string($cnn, $_POST['cat_id']);
    
    $response = [];
    $imageName = ""; // Initialize imageName

    // Fetch existing image name from the database
    $existingQuery = mysqli_query($cnn, "SELECT image FROM subcategory WHERE id = '$id'");
    $existingRow = mysqli_fetch_assoc($existingQuery);
    $existingImage = $existingRow['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the new file name in DB
            $imageName = $uniqueName;
        } else {
            echo json_encode(["success" => false, "message" => "Image upload failed."]);
        }
    } else {
        // If no new image is uploaded, use the existing image name
        $imageName = $existingImage;
    }

    if (!empty($name)) {
        // Insert category with status
        $query_insert = mysqli_query($cnn, "UPDATE subcategory SET name = '$name', image = '$imageName',cat_id = '$cat_id' WHERE id = '$id'");
        if ($query_insert) {
            $response['success'] = true;
            $response['message'] = "Subcategory Update successfully.";
        } else {
            // Capture SQL error
            $response['success'] = false;
            $response['message'] = "Failed to add Subcategory. SQL Error: " . mysqli_error($cnn);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Subcategory name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if ($_GET['what'] == "delete_subcategory") {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];

    $query = mysqli_query($cnn, "DELETE FROM subcategory WHERE id = " . intval($id));

    if ($query) {
        $response['success'] = true;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Record Deleted successfully</span>";
    } else {
        $response['success'] = false;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Some error occurred. Please try again</span>";
    }

    echo json_encode($response);
   
}
if($_GET['what'] == "update_status_sub"){
    // Get the JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];
    $status = $input['status'];

    // Update the status in the database
    $query = "UPDATE subcategory SET status = ? WHERE id = ?";
    $stmt = $cnn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    
    if($stmt->execute()){
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();
}
if ($_GET['what'] == 'add_pet') {
    header('Content-Type: application/json');
    $response = array();
    
    try {
        // Get form data
        $name = mysqli_real_escape_string($cnn, $_POST['name']);
        $cat_id = mysqli_real_escape_string($cnn, $_POST['cat_id']);
        $subcat_id = mysqli_real_escape_string($cnn, $_POST['subcat_id']);
        $type_list = mysqli_real_escape_string($cnn, $_POST['type_list']);
        $age = mysqli_real_escape_string($cnn, $_POST['age']);
        $av_date = mysqli_real_escape_string($cnn, $_POST['av_date']);
        $description = mysqli_real_escape_string($cnn, $_POST['description']);
        $price = mysqli_real_escape_string($cnn, $_POST['price']);
        $little = mysqli_real_escape_string($cnn, $_POST['little']);
        $pet_loc = mysqli_real_escape_string($cnn, $_POST['pet_loc']);
        $country = mysqli_real_escape_string($cnn, $_POST['country']);
        
        // Handle radio button values - default to 'No' if not set
        $health_check = isset($_POST['h_check1']) ? mysqli_real_escape_string($cnn, $_POST['h_check1']) : 'No';
        $origina_breeder = isset($_POST['h_check2']) ? mysqli_real_escape_string($cnn, $_POST['h_check2']) : 'No';
        $warm_flat = isset($_POST['h_check3']) ? mysqli_real_escape_string($cnn, $_POST['h_check3']) : 'No';
        $vaccination = isset($_POST['h_check4']) ? mysqli_real_escape_string($cnn, $_POST['h_check4']) : 'No';
        $pet_viewable = isset($_POST['h_check5']) ? mysqli_real_escape_string($cnn, $_POST['h_check5']) : 'No';
        $kc_register = isset($_POST['h_check6']) ? mysqli_real_escape_string($cnn, $_POST['h_check6']) : 'No';
        $microchipped = isset($_POST['h_check7']) ? mysqli_real_escape_string($cnn, $_POST['h_check7']) : 'No';
        
        // Handle multiple image uploads
        $images = []; // Initialize an array to hold image names
        if (isset($_FILES['images']) && $_FILES['images']['error'][0] == 0) {
            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            
            foreach ($_FILES['images']['name'] as $key => $filename) {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                
                if (in_array(strtolower($ext), $allowed)) {
                    $new_filename = uniqid() . '.' . $ext;
                    $upload_path = '../pet_homes/img/' . $new_filename;
                    
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $upload_path)) {
                        $images[] = $new_filename; // Add the new filename to the array
                    } else {
                        throw new Exception("Failed to upload image: " . $filename);
                    }
                } else {
                    throw new Exception("Invalid file format for image: " . $filename);
                }
            }
        } else {
            // If no new images are uploaded, use the existing image name
            $images[] = $existingImage; // Keep the existing image
        }

        // Convert the images array to a JSON string for storage and properly escape it
        $images_json = mysqli_real_escape_string($cnn, json_encode($images));
       
        // Ensure the JSON string is a flat array
        $images_json = str_replace(['[[', ']]'], ['[', ']'], $images_json);
       
        $adv_id = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3) . rand(100, 999);
        
        // Create SQL query with prepared statement approach
        $sql = "INSERT INTO pets (
                    name, 
                    cat_id, 
                    sub_id, 
                    image, 
                    type_listing, 
                    pet_age, 
                    pets_available, 
                    health_check, 
                    origina_breeder, 
                    warm_flat, 
                    des, 
                    price, 
                    pets_littel, 
                    adv_location, 
                    Vaccination, 
                    pet_viewable, 
                    kc_register, 
                    microchipped, 
                    country,
                    status,
                    adv_id
                ) VALUES (
                    '$name', 
                    '$cat_id', 
                    '$subcat_id', 
                    '$images_json', 
                    '$type_list', 
                    '$age', 
                    '$av_date', 
                    '$health_check', 
                    '$origina_breeder', 
                    '$warm_flat', 
                    '$description', 
                    '$price', 
                    '$little', 
                    '$pet_loc', 
                    '$vaccination', 
                    '$pet_viewable', 
                    '$kc_register', 
                    '$microchipped', 
                    '$country',
                    'Active',
                    '$adv_id'
                )";
        
        if(mysqli_query($cnn, $sql)) {
            $response['success'] = true;
            $response['message'] = "Pet added successfully!";
        } else {
            throw new Exception("Database error: " . mysqli_error($cnn));
        }
        
    } catch (Exception $e) {
        $response['success'] = false;
        $response['message'] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit;
}
if ($_GET['what'] == 'update_pet') {
    header('Content-Type: application/json');
    $response = array();
    
    try {
        // Get form data
        $id = mysqli_real_escape_string($cnn, $_POST['txtUId']);
        $name = mysqli_real_escape_string($cnn, $_POST['name']);
        $cat_id = mysqli_real_escape_string($cnn, $_POST['cat_id']);
        $subcat_id = mysqli_real_escape_string($cnn, $_POST['subcat_id']);
        $type_list = mysqli_real_escape_string($cnn, $_POST['type_list']);
        $age = mysqli_real_escape_string($cnn, $_POST['age']);
        $av_date = mysqli_real_escape_string($cnn, $_POST['av_date']);
        $description = mysqli_real_escape_string($cnn, $_POST['description']);
        $price = mysqli_real_escape_string($cnn, $_POST['price']);
        $little = mysqli_real_escape_string($cnn, $_POST['little']);
        $pet_loc = mysqli_real_escape_string($cnn, $_POST['pet_loc']);
        $country = mysqli_real_escape_string($cnn, $_POST['country']);
        
        // Handle radio button values - default to 'No' if not set
        $health_check = isset($_POST['h_check1']) ? mysqli_real_escape_string($cnn, $_POST['h_check1']) : 'No';
        $origina_breeder = isset($_POST['h_check2']) ? mysqli_real_escape_string($cnn, $_POST['h_check2']) : 'No';
        $warm_flat = isset($_POST['h_check3']) ? mysqli_real_escape_string($cnn, $_POST['h_check3']) : 'No';
        $vaccination = isset($_POST['h_check4']) ? mysqli_real_escape_string($cnn, $_POST['h_check4']) : 'No';
        $pet_viewable = isset($_POST['h_check5']) ? mysqli_real_escape_string($cnn, $_POST['h_check5']) : 'No';
        $kc_register = isset($_POST['h_check6']) ? mysqli_real_escape_string($cnn, $_POST['h_check6']) : 'No';
        $microchipped = isset($_POST['h_check7']) ? mysqli_real_escape_string($cnn, $_POST['h_check7']) : 'No';
        
        // Fetch existing image name from the database
        $existingQuery = mysqli_query($cnn, "SELECT image FROM pets WHERE id = '$id'");
        $existingRow = mysqli_fetch_assoc($existingQuery);
        $existingImage = $existingRow['image'];

        // Initialize images_json variable
        $images_json = $existingImage; // Default to existing image
        
        // Check if new images are being uploaded
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            // New images are being uploaded
            $images = []; // Initialize an array to hold image names
            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            
            foreach ($_FILES['images']['name'] as $key => $filename) {
                if ($_FILES['images']['error'][$key] == 0) { // Check if this specific file has no error
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    
                    if (in_array(strtolower($ext), $allowed)) {
                        $new_filename = uniqid() . '.' . $ext;
                        $upload_path = '../pet_homes/img/' . $new_filename;
                        
                        if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $upload_path)) {
                            $images[] = $new_filename; // Add the new filename to the array
                        } else {
                            throw new Exception("Failed to upload image: " . $filename);
                        }
                    } else {
                        throw new Exception("Invalid file format for image: " . $filename);
                    }
                }
            }
            
            // Only update images_json if new images were successfully uploaded
            if (!empty($images)) {
                // Convert the images array to a JSON string for storage and properly escape it
                $images_json = mysqli_real_escape_string($cnn, json_encode($images));
                
                // Ensure the JSON string is a flat array
                $images_json = str_replace(['[[', ']]'], ['[', ']'], $images_json);
            }
        }
        
        // Create SQL query with prepared statement approach for update
        $sql = "UPDATE pets SET 
                    name = '$name', 
                    cat_id = '$cat_id', 
                    sub_id = '$subcat_id', 
                    image = '$images_json', 
                    type_listing = '$type_list', 
                    pet_age = '$age', 
                    pets_available = '$av_date', 
                    health_check = '$health_check', 
                    origina_breeder = '$origina_breeder', 
                    warm_flat = '$warm_flat', 
                    des = '$description', 
                    price = '$price', 
                    pets_littel = '$little', 
                    adv_location = '$pet_loc', 
                    Vaccination = '$vaccination', 
                    pet_viewable = '$pet_viewable', 
                    kc_register = '$kc_register', 
                    microchipped = '$microchipped', 
                    country = '$country',
                    status = 'Active' 
                WHERE id = '$id'";
        
        if(mysqli_query($cnn, $sql)) {
            $response['success'] = true;
            $response['message'] = "Pet updated successfully!";
        } else {
            throw new Exception("Database error: " . mysqli_error($cnn));
        }
        
    } catch (Exception $e) {
        $response['success'] = false;
        $response['message'] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit;
}
if($_GET['what'] == "update_status_pets"){
    // Get the JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];
    $status = $input['status'];

    // Update the status in the database
    $query = "UPDATE pets SET status = ? WHERE id = ?";
    $stmt = $cnn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    
    if($stmt->execute()){
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();
}
if ($_GET['what'] == "delete_pets") {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];

    $query = mysqli_query($cnn, "DELETE FROM pets WHERE id = " . intval($id));

    if ($query) {
        $response['success'] = true;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Record Deleted successfully</span>";
    } else {
        $response['success'] = false;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Some error occurred. Please try again</span>";
    }

    echo json_encode($response);
   
}
if($_GET['what'] == "fetch_subcategories"){
    if (isset($_POST['category_id'])) {
        $categoryId = $_POST['category_id'];
        $query = mysqli_query($cnn, "SELECT * FROM subcategory WHERE cat_id = '$categoryId' AND status='Active'");
        
        while ($row = mysqli_fetch_array($query)) {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
        }
    }
}
if ($_GET['what'] == "add_acc_category") {
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    
    $response = [];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the file name in DB
            $imageName = $uniqueName;
        } else {
            echo json_encode(["success" => false, "message" => "Image upload failed."]);
           
        }
    }
    if (!empty($name)) {
        $query = mysqli_query($cnn, "SELECT COUNT(*) AS count FROM acce_catgeory WHERE name = '$name'");
        $row = mysqli_fetch_assoc($query);

        if ($row['count'] > 0) {
            $response['success'] = false;
            $response['message'] = "Accessories Category already exists.";
        } else {
            // Insert category with status
            $query_insert = mysqli_query($cnn, "INSERT INTO acce_catgeory (name,image, status) VALUES ('$name','$imageName', 'Active')");
            if ($query_insert) {
                $response['success'] = true;
                $response['message'] = "Accessories Category added successfully.";
            } else {
                // Capture SQL error
                $response['success'] = false;
                $response['message'] = "Failed to add Accessories Category. SQL Error: " . mysqli_error($cnn);
            }
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Accessories Category name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if ($_GET['what'] == "update_acc_category") {
    $id = mysqli_real_escape_string($cnn, $_POST['txtUId']);
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    
    $response = [];
    $imageName = ""; // Initialize imageName

    // Fetch existing image name from the database
    $existingQuery = mysqli_query($cnn, "SELECT image FROM acce_catgeory WHERE id = '$id'");
    $existingRow = mysqli_fetch_assoc($existingQuery);
    $existingImage = $existingRow['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the new file name in DB
            $imageName = $uniqueName;
        } else {
            echo json_encode(["success" => false, "message" => "Image upload failed."]);
        }
    } else {
        // If no new image is uploaded, use the existing image name
        $imageName = $existingImage;
    }

    if (!empty($name)) {
        // Insert category with status
        $query_insert = mysqli_query($cnn, "UPDATE acce_catgeory SET name = '$name', image = '$imageName' WHERE id = '$id'");
        if ($query_insert) {
            $response['success'] = true;
            $response['message'] = "Accessories Category Update successfully.";
        } else {
            // Capture SQL error
            $response['success'] = false;
            $response['message'] = "Failed to add Accessories Category. SQL Error: " . mysqli_error($cnn);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Accessories Category name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if($_GET['what'] == "update_status_acc"){
    // Get the JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];
    $status = $input['status'];

    // Update the status in the database
    $query = "UPDATE acce_catgeory SET status = ? WHERE id = ?";
    $stmt = $cnn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    
    if($stmt->execute()){
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();
}
if ($_GET['what'] == "delete_category_acc") {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];

    $query = mysqli_query($cnn, "DELETE FROM acce_catgeory WHERE id = " . intval($id));

    if ($query) {
        $response['success'] = true;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Record Deleted successfully</span>";
    } else {
        $response['success'] = false;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Some error occurred. Please try again</span>";
    }

    echo json_encode($response);
   
}
if ($_GET['what'] == "add_accessories") {
    $cat_id = mysqli_real_escape_string($cnn, $_POST['cat_id']);
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    $price = mysqli_real_escape_string($cnn, $_POST['price']);
    $des = mysqli_real_escape_string($cnn, $_POST['des']);
    
    // Expecting arrays
    $keys = isset($_POST['key']) ? $_POST['key'] : []; // Ensure it's an array
    $values = isset($_POST['value']) ? $_POST['value'] : []; // Ensure it's an array
    
    $response = [];

    // Convert keys and values to JSON strings for storage
    $keys_json = mysqli_real_escape_string($cnn, json_encode($keys));
    $values_json = mysqli_real_escape_string($cnn, json_encode($values));

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/"; // Ensure this path is correct and writable
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;

        // Check if the target directory exists and is writable
        if (!is_dir($targetDir) || !is_writable($targetDir)) {
            echo json_encode(["success" => false, "message" => "Target directory does not exist or is not writable."]);
            exit; // Exit if the directory is not writable
        }

        // Attempt to move the uploaded file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the file name in DB
            $imageName = $uniqueName;
        } else {
            echo json_encode(["success" => false, "message" => "Image upload failed. Check permissions or file size."]);
            exit; // Exit if image upload fails
        }
    } else {
        echo json_encode(["success" => false, "message" => "No image uploaded or there was an upload error."]);
        exit; // Exit if no image is uploaded
    }

    if (!empty($name)) {
        // Insert category with status, including keys and values
        $query_insert = mysqli_query($cnn, "INSERT INTO accessories (name, image, status, cat_id, des, price, `key`, `value`) VALUES ('$name', '$imageName', 'Active', '$cat_id', '$des', '$price', '$keys_json', '$values_json')");
        if ($query_insert) {
            $response['success'] = true;
            $response['message'] = "Accessories added successfully.";
        } else {
            // Capture SQL error
            $response['success'] = false;
            $response['message'] = "Failed to add Accessories. SQL Error: " . mysqli_error($cnn);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Accessories name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if ($_GET['what'] == "update_accessories") {
    $id = mysqli_real_escape_string($cnn, $_POST['txtUId']);
    $cat_id = mysqli_real_escape_string($cnn, $_POST['cat_id']);
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    $price = mysqli_real_escape_string($cnn, $_POST['price']);
    $des = mysqli_real_escape_string($cnn, $_POST['des']);
    
    // Expecting arrays
    $keys = isset($_POST['key']) ? $_POST['key'] : []; // Ensure it's an array
    $values = isset($_POST['value']) ? $_POST['value'] : []; // Ensure it's an array
    
    $response = [];

    // Convert keys and values to JSON strings for storage
    $keys_json = mysqli_real_escape_string($cnn, json_encode($keys));
    $values_json = mysqli_real_escape_string($cnn, json_encode($values));

    // Fetch existing image name from the database
    $existingQuery = mysqli_query($cnn, "SELECT image FROM accessories WHERE id = '$id'");
    $existingRow = mysqli_fetch_assoc($existingQuery);
    $existingImage = $existingRow['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the new file name in DB
            $imageName = $uniqueName;
        } else {
            // If image upload fails, use the existing image name
            $imageName = $existingImage;
        }
    } else {
        // If no new image is uploaded, use the existing image name
        $imageName = $existingImage;
    }

    if (!empty($name)) {
        // Update category with status, including keys and values
        $query_update = mysqli_query($cnn, "UPDATE accessories SET name = '$name', image = '$imageName', cat_id = '$cat_id', des = '$des', price = '$price', `key` = '$keys_json', `value` = '$values_json' WHERE id = '$id'");
        if ($query_update) {
            $response['success'] = true;
            $response['message'] = "Accessories updated successfully.";
        } else {
            // Capture SQL error
            $response['success'] = false;
            $response['message'] = "Failed to update Accessories. SQL Error: " . mysqli_error($cnn);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Accessories name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if($_GET['what'] == "update_status_acceccrios"){
    // Get the JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];
    $status = $input['status'];

    // Update the status in the database
    $query = "UPDATE accessories SET status = ? WHERE id = ?";
    $stmt = $cnn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    
    if($stmt->execute()){
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();
}
if ($_GET['what'] == "delete_accessories") {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];

    $query = mysqli_query($cnn, "DELETE FROM accessories WHERE id = " . intval($id));

    if ($query) {
        $response['success'] = true;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Record Deleted successfully</span>";
    } else {
        $response['success'] = false;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Some error occurred. Please try again</span>";
    }

    echo json_encode($response);
   
}
if ($_GET['what'] == "add_services") {
   
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    $price = mysqli_real_escape_string($cnn, $_POST['price']);
    $des = mysqli_real_escape_string($cnn, $_POST['des']);

    $response = [];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the file name in DB
            $imageName = $uniqueName;
        } else {
            echo json_encode(["success" => false, "message" => "Image upload failed."]);
            exit; // Exit if image upload fails
        }
    }

    if (!empty($name)) {
        // Insert category with status, including keys and values
        $query_insert = mysqli_query($cnn, "INSERT INTO service (name, image, status,des, price) VALUES ('$name', '$imageName', 'Active','$des', '$price')");
        if ($query_insert) {
            $response['success'] = true;
            $response['message'] = "Services added successfully.";
        } else {
            // Capture SQL error
            $response['success'] = false;
            $response['message'] = "Failed to add Services. SQL Error: " . mysqli_error($cnn);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Services name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if ($_GET['what'] == "update_services") {
    $id = mysqli_real_escape_string($cnn, $_POST['txtUId']);
  
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    $price = mysqli_real_escape_string($cnn, $_POST['price']);
    $des = mysqli_real_escape_string($cnn, $_POST['des']);
    
   
    
    $response = [];

    

    // Fetch existing image name from the database
    $existingQuery = mysqli_query($cnn, "SELECT image FROM `service` WHERE id = '$id'");
    $existingRow = mysqli_fetch_assoc($existingQuery);
    $existingImage = $existingRow['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the new file name in DB
            $imageName = $uniqueName;
        } else {
            // If image upload fails, use the existing image name
            $imageName = $existingImage;
        }
    } else {
        // If no new image is uploaded, use the existing image name
        $imageName = $existingImage;
    }

    if (!empty($name)) {
        // Update category with status, including keys and values
        $query_update = mysqli_query($cnn, "UPDATE `service` SET name = '$name', image = '$imageName', des = '$des', price = '$price' WHERE id = '$id'");
        if ($query_update) {
            $response['success'] = true;
            $response['message'] = "Service updated successfully.";
        } else {
            // Capture SQL error
            $response['success'] = false;
            $response['message'] = "Failed to update Service. SQL Error: " . mysqli_error($cnn);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Service name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if($_GET['what'] == "update_status_service"){
    // Get the JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];
    $status = $input['status'];

    // Update the status in the database
    $query = "UPDATE `service` SET status = ? WHERE id = ?";
    $stmt = $cnn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    
    if($stmt->execute()){
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();
}
if ($_GET['what'] == "delete_services") {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];

    $query = mysqli_query($cnn, "DELETE FROM `service` WHERE id = " . intval($id));

    if ($query) {
        $response['success'] = true;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Record Deleted successfully</span>";
    } else {
        $response['success'] = false;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Some error occurred. Please try again</span>";
    }

    echo json_encode($response);
   
}
if ($_GET['what'] == "add_offer") {
   
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    $des = mysqli_real_escape_string($cnn, $_POST['des']);

    $response = [];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the file name in DB
            $imageName = $uniqueName;
        } else {
            echo json_encode(["success" => false, "message" => "Image upload failed."]);
            exit; // Exit if image upload fails
        }
    }

    if (!empty($name)) {
        // Insert category with status, including keys and values
        $query_insert = mysqli_query($cnn, "INSERT INTO offer (name, image, status,des) VALUES ('$name', '$imageName', 'Active','$des')");
        if ($query_insert) {
            $response['success'] = true;
            $response['message'] = "Offer added successfully.";
        } else {
            // Capture SQL error
            $response['success'] = false;
            $response['message'] = "Failed to add Offer. SQL Error: " . mysqli_error($cnn);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Offer name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if ($_GET['what'] == "update_offer") {
    $id = mysqli_real_escape_string($cnn, $_POST['txtUId']);
  
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    
    $des = mysqli_real_escape_string($cnn, $_POST['des']);
    
   
    
    $response = [];

    

    // Fetch existing image name from the database
    $existingQuery = mysqli_query($cnn, "SELECT image FROM `offer` WHERE id = '$id'");
    $existingRow = mysqli_fetch_assoc($existingQuery);
    $existingImage = $existingRow['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the new file name in DB
            $imageName = $uniqueName;
        } else {
            // If image upload fails, use the existing image name
            $imageName = $existingImage;
        }
    } else {
        // If no new image is uploaded, use the existing image name
        $imageName = $existingImage;
    }

    if (!empty($name)) {
        // Update category with status, including keys and values
        $query_update = mysqli_query($cnn, "UPDATE `offer` SET name = '$name', image = '$imageName', des = '$des' WHERE id = '$id'");
        if ($query_update) {
            $response['success'] = true;
            $response['message'] = "Offer updated successfully.";
        } else {
            // Capture SQL error
            $response['success'] = false;
            $response['message'] = "Failed to update Offer. SQL Error: " . mysqli_error($cnn);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Offer name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if($_GET['what'] == "update_status_offer"){
    // Get the JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];
    $status = $input['status'];

    // Update the status in the database
    $query = "UPDATE `offer` SET status = ? WHERE id = ?";
    $stmt = $cnn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    
    if($stmt->execute()){
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();
}   
if ($_GET['what'] == "delete_offer") {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];

    $query = mysqli_query($cnn, "DELETE FROM `offer` WHERE id = " . intval($id));

    if ($query) {
        $response['success'] = true;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Record Deleted successfully</span>";
    } else {
        $response['success'] = false;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Some error occurred. Please try again</span>";
    }

    echo json_encode($response);
   
}
if ($_GET['what'] == "add_banner") {
   
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    $des = mysqli_real_escape_string($cnn, $_POST['des']);

    $response = [];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the file name in DB
            $imageName = $uniqueName;
        } else {
            echo json_encode(["success" => false, "message" => "Image upload failed."]);
            exit; // Exit if image upload fails
        }
    }

    if (!empty($name)) {
        // Insert category with status, including keys and values
        $query_insert = mysqli_query($cnn, "INSERT INTO banner (name, image, status,des) VALUES ('$name', '$imageName', 'Active','$des')");
        if ($query_insert) {
            $response['success'] = true;
            $response['message'] = "Banner Image added successfully.";
        } else {
            // Capture SQL error
            $response['success'] = false;
            $response['message'] = "Failed to add Banner Image. SQL Error: " . mysqli_error($cnn);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Banner Image name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if ($_GET['what'] == "update_banner") {
    $id = mysqli_real_escape_string($cnn, $_POST['txtUId']);
  
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    
    $des = mysqli_real_escape_string($cnn, $_POST['des']);
    
   
    
    $response = [];

    

    // Fetch existing image name from the database
    $existingQuery = mysqli_query($cnn, "SELECT image FROM `banner` WHERE id = '$id'");
    $existingRow = mysqli_fetch_assoc($existingQuery);
    $existingImage = $existingRow['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["image"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Only store the new file name in DB
            $imageName = $uniqueName;
        } else {
            // If image upload fails, use the existing image name
            $imageName = $existingImage;
        }
    } else {
        // If no new image is uploaded, use the existing image name
        $imageName = $existingImage;
    }

    if (!empty($name)) {
        // Update category with status, including keys and values
        $query_update = mysqli_query($cnn, "UPDATE `banner` SET name = '$name', image = '$imageName', des = '$des' WHERE id = '$id'");
        if ($query_update) {
            $response['success'] = true;
            $response['message'] = "Banner Image updated successfully.";
        } else {
            // Capture SQL error
            $response['success'] = false;
            $response['message'] = "Failed to update Banner Image. SQL Error: " . mysqli_error($cnn);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Banner Image name is required.";
    }
    ob_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
}
if($_GET['what'] == "update_status_banner"){
    // Get the JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];
    $status = $input['status'];

    // Update the status in the database
    $query = "UPDATE `banner` SET status = ? WHERE id = ?";
    $stmt = $cnn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    
    if($stmt->execute()){
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();
}
if ($_GET['what'] == "delete_banner") {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];

    $query = mysqli_query($cnn, "DELETE FROM `banner` WHERE id = " . intval($id));

    if ($query) {
        $response['success'] = true;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Record Deleted successfully</span>";
    } else {
        $response['success'] = false;
        $response['message'] = "<span style='font-weight:100;color:black;font-size:15px;'>Some error occurred. Please try again</span>";
    }

    echo json_encode($response);
   
}
if($_GET['what'] == "update_profile"){
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $email = $_SESSION['admin']; // Assuming the email is stored in session

    // Handle file upload
    if (isset($_FILES['profileImageInput']) && $_FILES['profileImageInput']['error'] == UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['profileImageInput']['tmp_name'];
        $imageName = $_FILES['profileImageInput']['name'];
        $imagePath = 'images/' . basename($imageName);

        // Move the uploaded file to the /images directory
        if (move_uploaded_file($imageTmpPath, $imagePath)) {
            // Update query with image name
            $query = "UPDATE `login` SET `name`='$name', `mno`='$contact', `gender`='$gender', `image`='$imageName' WHERE `email`='$email'";
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to move uploaded file.']);
            exit;
        }
    } else {
        // If no image is uploaded, just update other fields
        $query = "UPDATE `login` SET `name`='$name', `mno`='$contact', `gender`='$gender' WHERE `email`='$email'";
    }

    if (mysqli_query($cnn, $query)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($cnn)]);
    }
}
if ($_GET['what'] == "admin_changepwd") {
    $id = $_POST['id'];
    $cpwd = $_POST['cpwd'];
    $npwd = $_POST['npwd'];
    $cnpwd = $_POST['cnpwd'];
    // $pass = $_POST['password'];
    $sql = mysqli_query($cnn,"SELECT * FROM login WHERE id = '$id'");
    $row = mysqli_fetch_assoc($sql);
    $check = password_verify($cpwd,$row['password']);
    if($check == true){
        // Check if new password and confirm password match
        if ($cnpwd == $npwd) {
            $new_password = password_hash($npwd, PASSWORD_DEFAULT);
            $query = mysqli_query($cnn, "UPDATE login SET password = '$new_password' WHERE id = '$id'");
            if ($query) {
                $response['success'] = true;
                $response['message'] = "Password changed successfully.";
            } else {
                $response['success'] = false;
                $response['message'] = "Failed to change password. SQL Error: " . mysqli_error($cnn);
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Confirm Password and New Password do not match.";
        }
    } else {
        // Change the message to be more user-friendly
        $response['success'] = false;
        $response['message'] = "The current password you entered is incorrect. Please try again.";
    }
    
   echo json_encode($response);
}
?>