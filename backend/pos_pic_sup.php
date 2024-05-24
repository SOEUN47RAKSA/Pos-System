<?php 
// Establish database connection
$conn = new mysqli("localhost", "root", "", "sale_ms");
if($conn->connect_error){
    die("Connection Failed: ".$conn->connect_error);
}

// Function to sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to generate a unique filename
function generateUniqueFilename($filename) {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $basename = pathinfo($filename, PATHINFO_FILENAME);
    $unique_filename = $basename . '_' . uniqid() . '.' . $extension;
    return $unique_filename;
}

// Validate and sanitize form inputs
$txtsname = isset($_POST['sname']) ? sanitizeInput($_POST['sname']) : '';
$txtgender = isset($_POST['slgender']) ? sanitizeInput($_POST['slgender']) : '';
$txtemail = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
$txtadress = isset($_POST['address']) ? sanitizeInput($_POST['address']) : '';
$txtphone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
$picture = isset($_FILES["txtfile"]["name"]) ? $_FILES["txtfile"]["name"] : '';

// Check if a file is uploaded
if(empty($picture)) {
    die("Error: No file uploaded.");
}

// Check file type
$imageFileType = strtolower(pathinfo($picture, PATHINFO_EXTENSION));
$allowed_extensions = array("jpg", "jpeg", "png");
if(!in_array($imageFileType, $allowed_extensions)) {
    die("Error: Only JPG, JPEG, and PNG files are allowed.");
}

// Generate unique filename
$picture = generateUniqueFilename($picture);
$target_dir = "../suplier/";
$target_file = $target_dir . $picture;

// Move uploaded file to destination directory
if(move_uploaded_file($_FILES["txtfile"]["tmp_name"], $target_file)) {
    // Insert data into database
    $sql = "INSERT INTO suplier (sname, gender, email, adress, phone, picture) VALUES ('$txtsname', '$txtgender', '$txtemail', '$txtadress', '$txtphone', '$picture')";
    if ($conn->query($sql) === TRUE) {
        echo "Record has been added.";
    } else {
        // Log database error
        error_log("Error: " . $sql . "<br>" . $conn->error, 0);
        echo "Error: Unable to execute query. Please try again.";
    }
} else {
    echo "Error uploading file.";
}

// Close database connection
$conn->close();
?>
