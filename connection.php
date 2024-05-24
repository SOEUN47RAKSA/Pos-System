<?php 
	$conn = new mysqli("localhost", "root", "", "sale_ms");
	if($conn->connect_error){
	 die("Connection Failed: ".$conn->connect_error);
	}
	?>