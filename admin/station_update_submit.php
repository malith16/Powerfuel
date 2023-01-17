<?php
session_start();
require_once("../database_connection.php");

if(isset($_POST['station_update'])){
   $station_id=$_SESSION['station_id'];
   $station_manager=$_POST['managername'];
   $station_district=$_POST['stationdistrict'];
   $station_location=$_POST['stationlocation'];
   $station_contact=$_POST['stationcontact'];
                           
   $query="UPDATE fuel_station SET station_manager='$station_manager',station_District='$station_district',station_location='$station_location',station_contact='$station_contact' WHERE station_id='$station_id'";
                          
   mysqli_query($connection,$query);
                        
   if(mysqli_affected_rows($connection)==1){
                              
       header("location:view_fuel_station_details.php?msg=update Station Details Successfully........");


                          
   }else{

   }


}



?>