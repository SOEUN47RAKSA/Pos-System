<?php 
  // create connection to mysql database 
  $conn = new mysqli("localhost","root","","sale_ms");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  //echo "Connected successfully";

  //insert, update  and delete 

  $userid = $_POST['userid'];
  
  
  $sql = "DELETE FROM suplier WHERE id='".$userid."'";
  $result = $conn->query($sql);
  echo "Record has been deleted.";
  
?>