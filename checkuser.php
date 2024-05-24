<?php
	session_start();
	include("connection.php");
	$user = $_POST['txtuser'];
	$pass = $_POST["txtpass"];

	$sql = "SELECT * FROM login_ms
			WHERE username='".$user."' and 
				  password='".$pass."' limit 1";
	//echo $sql;
	// execute sql 
	$result = $conn->query($sql);
	$numberOfrow = $result->num_rows;

	$row = $result->fetch_assoc();

	$userid = $row["id"];
	$username = $row["username"];
	$_SESSION['USERID'] = $userid;
	$_SESSION['USERNAME'] = $username;
	
	
	if($numberOfrow> 0){
		echo 1;
	}else{
		echo 0;
	}

?>