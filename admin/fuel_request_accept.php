<?php
require_once("../database_connection.php");
session_start();
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['request_accept'])){

   echo $requestid=$_POST['request_id']."\n";

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


   if($_SESSION['fuel_status'] >= $_SESSION['request_fuel'] ){
    $random=rand(10,1000000);
    $request_token=$random;
    $accept_date=date("Y-m-d");

  
       $insert_data="INSERT INTO `accepted_request` (`accept_id`, `user_id`, `user_gmail`,`vehicle_number`,`station_id`, `station_district`, `station_location`, `request_fuel`, `accepted_token`, `accepted_date`)
        VALUES (NULL, '$user_id','$user_gmail','$vehicle_number','$stationid', '$station_district', '$station_location', '$requestfuel', '$request_token', '$accept_date')";
        mysqli_query($connection,$insert_data);
        if(mysqli_affected_rows($connection)==1){
                header("location:home.php?msg=send Accept message successfully......");
                $requset_update="UPDATE fuel_request SET accept_status='ACCEPTED' WHERE request_id='$_POST[request_id]'";
                mysqli_query($connection,$requset_update);
                if(isset($user_id) && isset($user_gmail)){
                    $email=$user_gmail;
                    $subject='YOUR FUEL REQUEST HAS BEEN ACCEPTED BY POWER FUEL';
                    $customer_id=$user_id;
                    $vehicle_reg=$vehicle_number;
                    $station_dis=$station_district;
                    $station_loc=$station_location;
                    $req_fuel=$requestfuel;
                    $user_token=$request_token;
//                    rusira.pathum20@gmail.com
//                    mrmahnaf999@gmail.com
                  
                    require_once "PHPMailer/PHPMailer.php";
                    require_once "PHPMailer/SMTP.php";
                    require_once "PHPMailer/Exception.php";


                    $mail=new PHPMailer();


                        //smtp setting

                    $mail->isSMTP();
                    $mail->Host="smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username ="kalaichudarraj999@gmail.com";
                    $mail->Password ="ziytzichhrmkhpgg";
                    $mail->Port=587;
                    $mail->SMTPSecure ='tsl';



                    //email setting
                    $mail->isHTML(true);
                    $mail->setFrom($email,"POWER FUEL PRIVATE LIMITED");
                    $mail->addAddress($user_gmail);
                    $mail->Subject=(($subject));
                    $mail->Body ="Your FUEL ACCEPTED DETAILS"."<br>"." ONE LITER RATE:400."." <br>"." REQUEST USER-ID:".$customer_id ."<br> "."VEHIVLE REGISTRATION NUMBER:".$vehicle_reg." <br> "."STATION DISTRCIT:".$station_dis." <br> "."STATION LOCATION:".$station_loc ."<br>"." REQUEST FUEL:".$req_fuel." <br>"." YOUR TOKEN:".$user_token;

                    if($mail->send()){
                        $status="success";
                        $response="Email is sent";
                    }else{
                        $status="failed";
                        $response="somthing went wrong: </br>".$mail->Errorinfo;
                    }
                    exit(json_encode(array("status"=>$status, "response"=>$response)));

                        
                    }
        }

        else{
            header("location:view_customer_requet.php?error=send Accept message Fails Try Again.....");
        }
   }

   else{
    header("location:home.php?msg=Email HAS been sent.....");
    $requset_update="UPDATE fuel_request SET accept_status='REJECTED' WHERE request_id='$_POST[request_id]'";
    mysqli_query($connection,$requset_update);
    if(isset($user_id) && isset($user_gmail)){
        $email=$user_gmail;
        $subject='YOUR FUEL REQUEST HAS BEEN ACCEPTED BY POWER FUEL';
        $customer_id=$user_id;
        $vehicle_reg=$vehicle_number;
        $station_dis=$station_district;
        $station_loc=$station_location;
        $req_fuel=$requestfuel;
        $user_token=$request_token;

      
        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";


        $mail=new PHPMailer();


            //smtp setting

        $mail->isSMTP();
        $mail->Host="smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username ="kalaichudarraj999@gmail.com";
        $mail->Password ="ziytzichhrmkhpgg";
        $mail->Port=587;
        $mail->SMTPSecure ='tsl';



        //email setting
        $mail->isHTML(true);
        $mail->setFrom($email,"POWER FUEL PRIVATE LIMITED");
        $mail->addAddress($user_gmail);
        $mail->Subject=(($subject));
        $mail->Body ="YOUR REQUEST HAS BEEN REJECTDE"."<br>"."REASON : THE FUEL STATION WHICH YOU ARE SELECTED HAS BEEN OUT OF FUEL";

        if($mail->send()){
            $status="success";
            $response="Email is sent";
        }else{
            $status="failed";
            $response="somthing went wrong: </br>".$mail->Errorinfo;
        }
        exit(json_encode(array("status"=>$status, "response"=>$response)));

            
        }
   }
}

?>