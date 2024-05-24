<?php
   $conn = new mysqli("localhost", "root", "", "bol");
   if($conn->connect_error){
    die("Connection Failed: ".$conn->connect_error);
   }
   $id = $_POST['edit_id'];
   $ful_name= $_POST['edit_full_name'];
    $pass = $_POST['passE'];
   $user = $_POST['edit_username'];
   $email = $_POST['edit_email'];
   $sex = $_POST['edit_sex'];
   $skill = $_POST['edit_skill'];
   $phone_num = $_POST['edit_phone_number'];
   $year = $_POST['edit_year'];

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
