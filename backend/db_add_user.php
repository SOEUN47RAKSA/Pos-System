<?php
   $conn = new mysqli("localhost", "root", "", "sale_ms");
   if($conn->connect_error){
    die("Connection Failed: ".$conn->connect_error);
   }
   
 
   $pass = $_POST['upass'];
   $user = $_POST['username'];
   

   $sql = "INSERT INTO login_ms 
           SET
           username ='".$user."',
           password ='".$pass."'";
           

           
   $result = $conn->query($sql);
   $lastid = $conn->insert_id;

   if($lastid){
      echo 1;
   } else {
      echo 0;
   }
?>
