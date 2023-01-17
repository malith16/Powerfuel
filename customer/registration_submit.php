<?php
require_once("../database_connection.php");
session_start();

if(isset($_POST['register'])){
    $username=$_POST['username'];
    $usergmail=$_POST['usergmail'];
    $userpassword=sha1($_POST['userpassword']);
    $vehicleregister=$_POST['vehicleregister'];
    $userdistrict=$_POST['userdistrict'];
    $usercontact=$_POST['usercontact'];
    $useraddress=$_POST['useraddress'];

    $query1="SELECT * FROM `customer` WHERE customer_gmail='$usergmail' OR vehicle_registration='$vehicleregister'";
    mysqli_query($connection,$query1);
    if(mysqli_affected_rows($connection)==1){
        header("location:register.php?error=your Vehicle Number Or Gmail Address Already Exist...");
    }else{
        $sql="INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_gmail`, `customer_password`, `vehicle_registration`, `customer_District`, `cusomer_contact`, `customer_address`)
     VALUES (NULL, '$username', '$usergmail','$userpassword', '$vehicleregister', '$userdistrict', '$usercontact', '$useraddress')";
     mysqli_query($connection,$sql);
     if(mysqli_affected_rows($connection)==1){
        header("location:login.php?reg=register Successfully........");
     }else{
        header("location:register.php?error=register Faild try again.......");
     }
    }
  
}


?>