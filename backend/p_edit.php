<?php
    include("../connection.php");

    // Check if form data is received properly
    if(isset($_POST['uid']) && isset($_POST['pname']) && isset($_POST['pcode']) && isset($_POST['selecat']) && isset($_POST['qty']) && isset($_POST['price'])) {
        
        // Extract data from POST request
        $uid = $_POST['uid'];
        $pname = $_POST['pname'];
        $pcode = $_POST['pcode'];
        $selecat = $_POST['selecat'];
        $qty = $_POST['qty'];
        $price = $_POST['price'];

        // Check if an image file is uploaded
        if(isset($_FILES['txtfile']['name']) && !empty($_FILES['txtfile']['name'])) {
            // Handle image upload and update image filename in database
            $image_name = $_FILES['txtfile']['name'];
            $target_dir = "products/";
            $target_file = $target_dir . basename($image_name);
        
            // Check if the file is successfully uploaded
            if(move_uploaded_file($_FILES['txtfile']['tmp_name'], $target_file)) {
                // Update product with image filename
                $sql = "UPDATE p_tbl SET pname = '$pname', pcode = '$pcode', categoryid = '$selecat', qty = '$qty', price = '$price', pimage = '$image_name' WHERE id = '$uid'";
            } else {
                echo "Error uploading image file"; // Display error message if file upload fails
            }
        } else {
            // Update product without changing the image filename
            $sql = "UPDATE p_tbl SET pname = '$pname', pcode = '$pcode', categoryid = '$selecat', qty = '$qty', price = '$price' WHERE id = '$uid'";
        }

        // Execute the update query
        if ($conn->query($sql) === TRUE) {
            echo "1"; // Indicate success
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Incomplete data received";
    }

    // Close the database connection
    $conn->close();
?>
