<?php
require_once("../database_connection.php");
session_start();

if (isset($_POST['manager_login'])) {
    $manager_gmail = $_POST['manager_gmail'];
    $manager_password = sha1($_POST['manager_password']);

    $query = "SELECT * FROM fuel_station  WHERE email='$manager_gmail' AND password='$manager_password'";

//    echo $query;
    mysqli_query($connection, $query);
    if (mysqli_affected_rows($connection) == 1) {
        $_SESSION['manager_gmail'] = $_POST['manager_gmail'];
        header("location:manager_home.php");
    } else {
        header("location:manager_login.php?msg=Your login failed Please try Again......");
    }
}

?>