<?php
// Include the connection file
include("../connection.php");

// Check if form data is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST["userid"];
    $full_name = $_POST["txtfname"];
    $gender = $_POST["slgender"];
    $email = $_POST["email"];
    $phone = $_POST["txtphone"];
    $address = $_POST["txtaddress"];
    
    // Handle uploaded file if any
    $file_name = "";
    if(isset($_FILES["txtfile"]) && $_FILES["txtfile"]["error"] == 0) {
        $file_name = $_FILES["txtfile"]["name"];
        move_uploaded_file($_FILES["txtfile"]["tmp_name"], "uploads/" . $file_name);
    }

    // Update customer information in the database
    $sql = "UPDATE costomer SET cusname='$full_name', gender='$gender', email='$email', phone='$phone', address='$address'";
    if(!empty($file_name)) {
        $sql .= ", picture='$file_name'";
    }
    $sql .= " WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "1"; // Return success response
    } else {
        echo "Error updating record: " . $conn->error; // Return error response
    }
} else {
    echo "Invalid request"; // Return error response for invalid request method
}

// Close the database connection
$conn->close();
?>
