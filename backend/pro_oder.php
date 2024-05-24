<?php 

     include("../connection.php");

	$txtcode = $_POST['txtcode'];
	$sql = "select * from p_tbl where pcode='".$txtcode."' limit 1";
	
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		$str=$row['id'].";".$row['pname'].";".$row['qty'].";".$row['price'];
		echo $str;
	}else{
		echo 0;
	}
	
?>
