<?php
require_once("../database_connection.php");
session_start();

if(isset($_POST['send_request'])){
    $userid=$_SESSION['user_id'];
    $usergmail=$_SESSION['usergmail'];
    $vehicle_number=$_SESSION['vehicle_registration'];
    $station_id=$_SESSION['station_id'];
    $station_district=$_SESSION['station_District'];
   $station_location=$_SESSION['station_location'];
    $fuel_liters=$_POST['request_fuel'];
   $request_Date=date("y/m/d");

   $query1="SELECT * FROM `fuel_request` where request_userid='$userid'";
   mysqli_query($connection,$query1);
   if(mysqli_affected_rows($connection)==1){
    
    ?>
    <script>
        alert("You Cann't be send another request with in 7 Days........");
        window.location="home.php";
    </script>

    <?php
   }else{
    $query="INSERT INTO `fuel_request` (`request_id`, `request_userid`, `request_usergmail`,`request_vehiclenumber`,`request_stationid`, `request_stationdistrict`, `request_stationlocation`, `request_fuel`,`request_date`,`accept_status`)
    VALUES (NULL, '$userid', '$usergmail','$vehicle_number','$station_id', '$station_district', '$station_location', '$fuel_liters', '$request_Date','PENDING')";
    mysqli_query($connection,$query);
    if(mysqli_affected_rows($connection)==1){
        echo "requset send Success";
        // header("location:fuel_request_form.php?msg=request Send Successfully.......");
        header("location:home.php?msg=request Send Successfully.......");
    }else{
        echo "requset send fails";
        header("loation:fuel_request_form.php?error=request not send Fails try again........");
    }
   }


 
   

}


?>