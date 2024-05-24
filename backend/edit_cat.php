<?php
// Include your database connection file
include("../connection.php");

// Set the content type to JSON
header('Content-Type: application/json');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $catid = $_POST["catid"];
    $catname = $_POST["txteditcatname"];
    $status = $_POST["editstatus"];

    // Check if all required fields are filled
    if (empty($catname) || empty($status)) {
        // Return JSON response indicating missing data
        echo json_encode(array("status" => "error", "message" => "Missing data"));
    } else {
        // Prepare and execute SQL statement to update category in the database
        $sql = "UPDATE category SET catname = ?, status = ? WHERE catid = ?";
        $stmt = $conn->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bind_param("sii", $catname, $status, $catid);

        if ($stmt->execute()) {
            // Return JSON response indicating successful update
            echo json_encode(array("status" => "success", "message" => "Category updated successfully"));
        } else {
            // Return JSON response indicating update failure
            echo json_encode(array("status" => "error", "message" => "Failed to update category"));
        }
    }
} else {
    // If the form is not submitted via POST method, return JSON response with error
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}
?>
