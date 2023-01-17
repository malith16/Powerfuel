<?php
require_once("../database_connection.php");

if(isset($_POST['set_status']) && !empty($_POST['set_status'])){
    $query="UPDATE `fuel_station` SET `station_status` = '{$_POST['set_status']}' WHERE `fuel_station`.`station_id` ={$_POST['station_id']}";
   
    mysqli_query($connection,$query);
//    echo  mysqli_affected_rows($connection);
   if(mysqli_affected_rows($connection)==1){
       header('location:view_fuel_station_details.php?msg=status update successful');

   }elseif(mysqli_affected_rows($connection)==0){
    header('location:view_fuel_station_details.php?msg=status is up-to-date');

   }
}


?>