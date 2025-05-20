<?php
include 'connection.php';

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


?>