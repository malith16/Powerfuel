<?php
require_once("../database_connection.php");
session_start();
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['request_accept'])){

    $check_request="SELECT * FROM fuel_request WHERE request_id='$_POST[request_id]'";
    $requset_result=mysqli_query($connection,$check_request);
    while($request_row=mysqli_fetch_assoc($requset_result)){
        $stationid=$request_row['request_stationid'];
        $_SESSION['request_stationid']=$stationid;

        $requestfuel=$request_row['request_fuel'];
        $_SESSION['request_fuel']=$requestfuel;

        $request_usergmail=$request_row['request_usergmail'];
        $_SESSION['request_usergmail']=$request_usergmail;


        $user_id=$request_row['request_userid'];
        $_SESSION['request_userid']=$user_id;

        $user_gmail=$request_row['request_usergmail'];
        $_SESSION['request_usergmail']=$user_gmail;

        $station_district=$request_row['request_stationdistrict'];
        $_SESSION['request_stationdistrict']=$station_district;

        $station_location=$request_row['request_stationlocation'];
        $_SESSION['request_stationlocation']=$station_location;


        $vehicle_number=$request_row['request_vehiclenumber'];
        $_SESSION['request_vehiclenumber']=$vehicle_number;
    }
    echo $_SESSION['request_stationid']."\n";
    echo $_SESSION['request_fuel']."\n";

    $check_station="SELECT * FROM fuel_station WHERE station_id='$_SESSION[request_stationid]'";
    $station_result=mysqli_query($connection,$check_station);
    while($station_row=mysqli_fetch_assoc($station_result)){
        $station_fuelstatus=$station_row['fuel_status'];
        $_SESSION['fuel_status']=$station_fuelstatus;
    }

    echo  $_SESSION['fuel_status'];

    if($_SESSION['fuel_status'] >= $_SESSION['request_fuel'] ) {
        $random = rand(10, 1000000);
        $request_token = $random;
        $accept_date = date("Y-m-d");

        $insert_data="INSERT INTO `accepted_request` (`accept_id`, `user_id`, `user_gmail`,`vehicle_number`,`station_id`, `station_district`, `station_location`, `request_fuel`, `accepted_token`, `accepted_date`)
        VALUES (NULL, '$user_id','$user_gmail','$vehicle_number','$stationid', '$station_district', '$station_location', '$requestfuel', '$request_token', '$accept_date')";
        mysqli_query($connection,$insert_data);
        if(mysqli_affected_rows($connection)==1){

            $count = $_SESSION['fuel_status'] - $_SESSION['request_fuel'];
            $stID= $_SESSION['request_stationid'];
            $update_fuel_status = "UPDATE fuel_station SET fuel_status='$count' WHERE station_id='$stID'";
            echo $update_fuel_status;
            mysqli_query($connection,$update_fuel_status);

            header("location:acceptedRequest.php?msg=Request has been accepted successfully");
            $requset_update="UPDATE fuel_request SET accept_status='ACCEPTED' WHERE request_id='$_POST[request_id]'";
            mysqli_query($connection,$requset_update);


        }

        else{
            header("location:acceptedRequest.php?error=Request Accept message Fails Try Again.....");
        }

    }

    else {
        header("location:acceptedRequest.php?error=Request has been declined as we are out of stock");
    }
}
