<?php
require_once("../database_connection.php");
session_start();

if(isset($_POST['admin_login'])){
    $admingmail=$_POST['admingmail'];
    $adminpassword=sha1($_POST['adminpassword']);

    $query="SELECT * FROM admin  WHERE admin_gmail='$admingmail' AND admin_password='$adminpassword'";
    mysqli_query($connection,$query);
    if(mysqli_affected_rows($connection)==1){
        $_SESSION['admingmail']=$_POST['admingmail'];
      header("location:home.php");
    }else{
        header("location:login.php?msg=Your login failed Please try Again......");
    }
}

?>