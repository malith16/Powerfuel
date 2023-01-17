<?php
require_once("../database_connection.php");
session_start();

if(isset($_POST['delete_details'])){
    $station_id=$_POST['station_id'];

    $sql="DELETE FROM fuel_station WHERE station_id='$station_id'";
   $result=mysqli_query($connection,$sql);
   if($result==1){
    header("location:view_fuel_station_details.php?msg=Delete Successfully");
   }else{
    header("location:view_fuel_station_details.php?error=Delete Fails");
   }
}



?>