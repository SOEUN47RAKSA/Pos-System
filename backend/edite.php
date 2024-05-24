<?php
   $conn = new mysqli("localhost", "root", "", "product");
   if($conn->connect_error){
   die("Connection Failed: ".$conn->connect_error);
   }

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch data from database
    $sql = "SELECT * FROM p_tbl WHERE id='$id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Now you can populate your edit form with the values from $row
        $pname = $row['pname'];
        $qty = $row['qty'];
        $cost = $row['cost'];
        // Similarly for other fields
        
        if(isset($_POST['submit'])) {
            $pname = $_POST['pname'];
            $qty = $_POST['qty'];
            $cost = $_POST['cost'];
            // Assuming 'image' is not being updated
            
            // SQL query to update record in database
            $update_sql = "UPDATE p_tbl SET pname='$pname', qty='$qty', cost='$cost' WHERE id='$id'";
            
            if ($conn->query($update_sql) === TRUE) {
                echo "Record updated successfully";
                // Redirect to view page or perform other actions after update
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    } else {
        echo "Record not found";
    }
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Product</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="pname">Product Name:</label>
                <input type="text" class="form-control" id="pname" name="pname" value="<?php echo $pname; ?>">
            </div>
            <div class="form-group">
                <label for="qty">Quantity:</label>
                <input type="text" class="form-control" id="qty" name="qty" value="<?php echo $qty; ?>">
            </div>
            <div class="form-group">
                <label for="cost">Cost:</label>
                <input type="text" class="form-control" id="cost" name="cost" value="<?php echo $cost; ?>">
            </div>
            <!-- Add other fields here -->
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional, for some functionalities) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
