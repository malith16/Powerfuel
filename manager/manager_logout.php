<?php
session_start();
unset($_SESSION["manager_gmail"]);
header('location:../index.php?msg=logout success');
?>