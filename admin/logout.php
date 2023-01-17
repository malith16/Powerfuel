<?php
session_start();
unset($_SESSION["admingmail"]);
header('location:login.php?msg=logout success');
?>