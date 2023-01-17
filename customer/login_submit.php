<?php
require_once("../database_connection.php");
session_start();

if(isset($_POST['login'])){
    $usergmail=$_POST['usergmail'];
    $userpassword=sha1($_POST['userpassword']);

    $query="SELECT * FROM customer WHERE customer_gmail='$usergmail' AND customer_password='$userpassword'";
    mysqli_query($connection,$query);
    if(mysqli_affected_rows($connection)==1){
        $_SESSION['usergmail']=$_POST['usergmail'];
        header("location:home.php");
    }else{
        header("location:login.php?msg=Your login failed Please try Again......");
    }


}

?>