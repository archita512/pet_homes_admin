<?php
include 'connection.php';

if ($_GET['what'] == "add_category") {
    $name = mysqli_real_escape_string($cnn, $_POST['name']);
    
    $response = [];

    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] == 0) {
        $targetDir = "../pet_homes/img/";
        $fileName = basename($_FILES["fileInput"]["name"]);
        $uniqueName = time() . "_" . $fileName;
        $targetFilePath = $targetDir . $uniqueName;
    
        if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $targetFilePath)) {
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
?>