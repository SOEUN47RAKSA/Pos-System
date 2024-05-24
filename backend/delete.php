<?php
 $conn = new mysqli("localhost", "root", "", "product");
 if($conn->connect_error){
 die("Connection Failed: ".$conn->connect_error);
 }

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete record from database
    $sql = "DELETE FROM p_tbl WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
