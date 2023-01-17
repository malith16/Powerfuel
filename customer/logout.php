<?php
session_start();
unset($_SESSION["usergmail"]);
header('location:login.php?msg=logout success');
?>
