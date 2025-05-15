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
        $name = $_POST['name'];
        $cat_id = $_POST['cat_id'];
        $subcat_id = $_POST['subcat_id'];
        $type_list = $_POST['type_list'];
        $age = $_POST['age'];
        $av_date = $_POST['av_date'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $little = $_POST['little'];
        $pet_loc = $_POST['pet_loc'];
        
        // Handle radio button values - default to 'No' if not set
        $health_check = isset($_POST['h_check1']) ? $_POST['h_check1'] : 'No';
        $origina_breeder = isset($_POST['h_check2']) ? $_POST['h_check2'] : 'No';
        $warm_flat = isset($_POST['h_check3']) ? $_POST['h_check3'] : 'No';
        $vaccination = isset($_POST['h_check4']) ? $_POST['h_check4'] : 'No';
        $pet_viewable = isset($_POST['h_check5']) ? $_POST['h_check5'] : 'No';
        $kc_register = isset($_POST['h_check6']) ? $_POST['h_check6'] : 'No';
        $microchipped = isset($_POST['h_check7']) ? $_POST['h_check7'] : 'No';
        
        // Handle image upload
        $image = '';
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            $filename = $_FILES['image']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            if(in_array(strtolower($ext), $allowed)) {
                $new_filename = uniqid() . '.' . $ext;
                $upload_path = '../pet_homes/img/' . $new_filename;
                
                if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                    $image = $new_filename;
                } else {
                    throw new Exception("Failed to upload image");
                }
            } else {
                throw new Exception("Invalid file format. Allowed formats: jpg, jpeg, png, gif");
            }
        } else {
            throw new Exception("Image is required");
        }
        
        // Create SQL query with all the fields including radio button values
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
                    status
                ) VALUES (
                    '$name', 
                    '$cat_id', 
                    '$subcat_id', 
                    '$image', 
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
                    'Active'
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
?>