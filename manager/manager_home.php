<?php
require_once("../database_connection.php");
session_start();
if(!isset($_SESSION["manager_gmail"])){
    ?>
<script>
window.location = "login.php";
</script>

<?php
   }

$query="SELECT * FROM fuel_station WHERE email='$_SESSION[manager_gmail]'";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($result)){
    $username=$row['station_manager'];
    $_SESSION['username']=$username;

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ADMIN HOME PAGE</title>
    <!-- loader-->
    <link href="../assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <!-- Vector CSS -->
    <link href="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- simplebar CSS-->
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="../assets/css/animate.css" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Sidebar CSS-->
    <link href="../assets/css/sidebar-menu.css" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="../assets/css/app-style.css" rel="stylesheet" />

</head>

<body class="bg-theme bg-theme1">



    <!--Start topbar header-->
    <header class="topbar-nav">
        <nav class="navbar navbar-expand fixed-top">
            <ul class="navbar-nav mr-auto align-items-center">

            </ul>

            <ul class="navbar-nav align-items-center right-nav-link">
                <li class="nav-item dropdown-lg">
                    <a class="nav-link" href="manager_home.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                        <span class="user-profile"><img src="../assets/images/user1.png" class="img-circle"
                                alt="user avatar"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-item user-details">
                            <a href="javaScript:void();">
                                <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3"
                                            src="../assets/images/user1.png" alt="user avatar"></div>
                                    <div class="media-body">
                                        <h6 class="mt-2 user-title"><?php echo $username;  ?></h6>
                                        <p class="user-subtitle"><?php echo $_SESSION['manager_gmail'];  ?></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        
                        <li class="dropdown-divider"></li>

                        <li class="dropdown-item"><i class="icon-power mr-2"></i><a href="manager_logout.php">Logout</a> </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <!--End topbar header-->


    <div class="container">
        <div class="row align-items-center vh-100">
            <div class="col-8 mx-auto">
                <div class="card shadow border">

                    <div class="card-body d-flex flex-column align-items-center">
                        <p class="card-text">View Accepted Requests</p>
                        <a href="acceptedRequest.php" class="btn btn-primary">VIEW ACCEPTED REQUESTS</a>
                    </div>
                </div>
                <div class="card shadow border">
                    <div class="card-body d-flex flex-column align-items-center">
                        <p class="card-text">View Station Details with Fuel Stock</p>
                        <a href="stationDetails.php" class="btn btn-primary">VIEW STATION DETAILS WITH FUEL STOCK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- simplebar js -->
    <script src="../assets/plugins/simplebar/js/simplebar.js"></script>
    <!-- sidebar-menu js -->
    <script src="../assets/js/sidebar-menu.js"></script>
    <!-- loader scripts -->
    <script src="../assets/js/jquery.loading-indicator.js"></script>
    <!-- Custom scripts -->
    <script src="../assets/js/app-script.js"></script>
    <!-- Chart js -->

    <script src="../assets/plugins/Chart.js/Chart.min.js"></script>

    <!-- Index js -->
    <script src="../assets/js/index.js"></script>


</body>

</html>