<?php
   $conn = new mysqli("localhost", "root", "", "bol");
   if($conn->connect_error){
    die("Connection Failed: ".$conn->connect_error);
   }
   $id = $_POST['userid'];
   $ful_name= $_POST['full_name'];
   $pass = $_POST['passw'];
   $user = $_POST['username'];
   $email = $_POST['email'];
   $sex = $_POST['sex'];
   $skill = $_POST['skill'];
   $phone_num = $_POST['phone_number'];
   $year = $_POST['year'];

   $sql = "UPDATE member 
           SET
           full_name = '".$ful_name."',
           username ='".$user."',
           password ='".$pass."',
           gmail ='".$email."',
           sex ='".$sex."',
           skill= '".$skill."',
           mobile_number ='".$phone_num."',
           years='".$year."'
           WHERE id ='".$id."'";

           
   $result = $conn->query($sql);
   echo 1;
?>
