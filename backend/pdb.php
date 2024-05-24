<?php 
	include("../connection.php");

	// Check if form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$txtpname = isset($_POST['txtpname']) ? $_POST['txtpname'] : "";
		$txtpcode = isset($_POST['txtpcode']) ? $_POST['txtpcode'] : "";
		$txtcatid = isset($_POST['slcat']) ? $_POST['slcat'] : "";
		$txtqty   = isset($_POST['txtqty']) ? $_POST['txtqty'] : "";
		$txtprice  = isset($_POST['txtprice']) ? $_POST['txtprice'] : "";
		$pimage = isset($_FILES["txtfile"]["name"]) ? $_FILES["txtfile"]["name"] : "";
		
		$target_dir = "products/";
		$target_file = $target_dir . basename($pimage);
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		if ($pimage == "" || $pimage == null) {
			echo 1; // No picture uploaded
		} elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png','webp'])) {
			echo 1; // Invalid file type
		} else {
			// Attempt to move uploaded file
			if (move_uploaded_file($_FILES["txtfile"]["tmp_name"], $target_file)) {
				// Insert data into database
				$sql = "INSERT INTO p_tbl (pname, pimage, pcode, categoryid, qty, price) VALUES ('$txtpname', '$pimage', '$txtpcode', '$txtcatid', '$txtqty', '$txtprice')";

				if ($conn->query($sql) === TRUE) {
					echo "Record has been added.";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			} else {
				echo "Error uploading file.";
			}
		}
	}
?>
