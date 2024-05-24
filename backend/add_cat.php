<?php 
	include("../connection.php");

	// Check if form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$txtcatname = isset($_POST['txtcatname']) ? $_POST['txtcatname'] : "";
		$status = isset($_POST['status']) ? $_POST['status'] : "";
		$picture = isset($_FILES["txtfile"]["name"]) ? $_FILES["txtfile"]["name"] : "";
		
		$target_dir = "category/";
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
				$sql = "INSERT INTO category (catname, picture,status) VALUES ('$txtcatname', '$picture','$status')";
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
