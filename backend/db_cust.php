<?php 
	include("../connection.php");

	// Check if form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$txtcusname = isset($_POST['txtcusname']) ? $_POST['txtcusname'] : "";
		$txtcusemail = isset($_POST['txtcusemail']) ? $_POST['txtcusemail'] : "";
		$slgender = isset($_POST['cuslgender']) ? $_POST['cuslgender'] : "";
		$phone    = isset($_POST['txtcusphone']) ? $_POST['txtcusphone'] : "";
		$address  = isset($_POST['txtaddress']) ? $_POST['txtaddress'] : "";
		$picture = isset($_FILES["txtfile"]["name"]) ? $_FILES["txtfile"]["name"] : "";
		
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($picture);
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		if ($picture == "" || $picture == null) {
			echo 1; // No picture uploaded
		} elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
			echo 1; // Invalid file type
		} else {
			// Attempt to move uploaded file
			if (move_uploaded_file($_FILES["txtfile"]["tmp_name"], $target_file)) {
				// Insert data into database
				$sql = "INSERT INTO costomer (cusname, email, gender, phone, address, picture) VALUES ('$txtcusname', '$txtcusemail', '$slgender', '$phone', '$address', '$picture')";
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
