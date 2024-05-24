<?php 

     include("../connection.php");

	$txtcatid = $_POST['catid'];
	$txtcatname = $_POST['txtcatname'];

	$status = $_POST['status'];
	$picture = $_FILES["txtfile"]["name"];
	$target_dir = "uploads/";
	$target_file = $target_dir.basename($picture);

	//echo "catid:".$txtcatid;
	if(move_uploaded_file($_FILES["txtfile"]["tmp_name"], $target_file))
	{
		// update info
		$sqlupdate = "UPDATE suplier SET categoryname='".$txtcatname."',
			    picture = '".$picture."',
			    status = '".$status."'
			    WHERE catid='".$txtcatid."'";
		$conn->query($sqlupdate);
		echo 1;

	}



	
?>
