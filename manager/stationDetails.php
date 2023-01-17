<?php
require_once("../database_connection.php");
session_start();
if (!isset($_SESSION["manager_gmail"])) {
?>
    <script>
        window.location = "login.php";
    </script>

<?php
}

$query = "SELECT * FROM fuel_station WHERE email='$_SESSION[manager_gmail]'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $station_id = $row['station_id'];
    $username = $row['station_manager'];
    $station_status = $row['station_status'];
    $station_District = $row['station_District'];
    $station_location = $row['station_location'];
    $station_contact = $row['station_contact'];
    $fuel_status = $row['fuel_status'];
    $email = $row['email'];
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
    <title>STATION DETAILS</title>
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
    <header class="topbar-nav mb-5">
        <nav class="navbar navbar-expand fixed-top">
            <ul class="navbar-nav mr-auto align-items-center">

            </ul>

            <ul class="navbar-nav align-items-center right-nav-link">
                <li class="nav-item dropdown-lg">
                    <a class="nav-link" href="manager_home.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                        <span class="user-profile"><img src="../assets/images/user1.png" class="img-circle" alt="user avatar"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-item user-details">
                            <a href="javaScript:void();">
                                <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" src="../assets/images/user1.png" alt="user avatar"></div>
                                    <div class="media-body">
                                        <h6 class="mt-2 user-title"><?php echo $username;  ?></h6>
                                        <p class="user-subtitle"><?php echo $_SESSION["manager_gmail"];  ?></p>
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

    <div class="mb-5" style="margin-top :100px;">
        <div class="container">

            <div class="row mt-3">
                <div class="col-lg-4">
                    <div class="card profile-card-2">
                        <div class="card-img-block" style="height: 200px">
                            <img class="img-fluid" src="../assets/images/fuel.jpg" alt="Card image cap">
                        </div>
                        <div class="card-body pt-5">
                            <img src="../assets/images/user1.png" alt="profile-image" class="profile">
                            <h5 class="card-title"><?php echo $username; ?> Fuel Station</h5>
                            <p class="card-text">As the leading expert in China, we worn worldwide reputation for the quality. We provide one one-stop service and solution for all kinds of gas station.</p>
                            <div class="icon-block">
                                <a href="javascript:void();"><i class="fa fa-facebook bg-facebook text-white"></i></a>
                                <a href="javascript:void();"> <i class="fa fa-twitter bg-twitter text-white"></i></a>
                                <a href="javascript:void();"> <i class="fa fa-google-plus bg-google-plus text-white"></i></a>
                            </div>
                        </div>

                        <!--                    <div class="card-body border-top border-light">-->
                        <!--                        <div class="media align-items-center">-->
                        <!--                            <div>-->
                        <!--                                <img src="assets/images/timeline/html5.svg" class="skill-img" alt="skill img">-->
                        <!--                            </div>-->
                        <!--                            <div class="media-body text-left ml-3">-->
                        <!--                                <div class="progress-wrapper">-->
                        <!--                                    <p>HTML5 <span class="float-right">65%</span></p>-->
                        <!--                                    <div class="progress" style="height: 5px;">-->
                        <!--                                        <div class="progress-bar" style="width:65%"></div>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                        <hr>-->
                        <!--                        <div class="media align-items-center">-->
                        <!--                            <div><img src="assets/images/timeline/bootstrap-4.svg" class="skill-img" alt="skill img"></div>-->
                        <!--                            <div class="media-body text-left ml-3">-->
                        <!--                                <div class="progress-wrapper">-->
                        <!--                                    <p>Bootstrap 4 <span class="float-right">50%</span></p>-->
                        <!--                                    <div class="progress" style="height: 5px;">-->
                        <!--                                        <div class="progress-bar" style="width:50%"></div>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                        <hr>-->
                        <!--                        <div class="media align-items-center">-->
                        <!--                            <div><img src="assets/images/timeline/angular-icon.svg" class="skill-img" alt="skill img"></div>-->
                        <!--                            <div class="media-body text-left ml-3">-->
                        <!--                                <div class="progress-wrapper">-->
                        <!--                                    <p>AngularJS <span class="float-right">70%</span></p>-->
                        <!--                                    <div class="progress" style="height: 5px;">-->
                        <!--                                        <div class="progress-bar" style="width:70%"></div>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                        <hr>-->
                        <!--                        <div class="media align-items-center">-->
                        <!--                            <div><img src="assets/images/timeline/react.svg" class="skill-img" alt="skill img"></div>-->
                        <!--                            <div class="media-body text-left ml-3">-->
                        <!--                                <div class="progress-wrapper">-->
                        <!--                                    <p>React JS <span class="float-right">35%</span></p>-->
                        <!--                                    <div class="progress" style="height: 5px;">-->
                        <!--                                        <div class="progress-bar" style="width:35%"></div>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!---->
                        <!--                    </div>-->
                    </div>

                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                                <li class="nav-item">
                                    <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs"><span style="color: white">Profile</span></span></a>
                                </li>
                            </ul>
                            <div class="tab-content p-3">
                                <div class="tab-pane active" id="profile">
                                    <!--                                <h5 class="mb-3">User Profile</h5>-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <h6>About - </h6>
                                                <p>
                                                    <?php echo $username; ?>
                                                </p>
                                            </div>

                                            <div class="row">
                                                <h6>Contact - </h6>
                                                <p>
                                                    <?php echo $station_contact; ?>
                                                </p>
                                            </div>

                                            <div class="row">
                                                <h6>Location - </h6>
                                                <p>
                                                    <?php echo $station_location; ?>
                                                </p>
                                            </div>
                                            <div class="row">
                                                <h6>Fuel Status - </h6>
                                                <p class="text-dark" style="font-weight:800">
                                                    <?php echo $fuel_status; ?>
                                                </p>
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span> Recent Activity</h5>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-striped">
                                                    <tbody>

                                                        <?php
                                                        require_once("../database_connection.php");


                                                        $query = "SELECT * FROM accepted_request INNER JOIN customer ON accepted_request.user_id = customer.customer_id WHERE station_id=$station_id";
                                                        $result = mysqli_query($connection, $query);
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            
                                                            echo "<tr>
                                                                    <td>
                                                                         <strong>{$row['customer_name']} - {$row['vehicle_number']} - </strong> {$row['request_fuel']}
                                                                    </td>
                                                                 </tr>";
                                                        }

                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container-fluid mb-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d253498.70751839987!2d79.89257966590877!3d6.900493123320353!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sawissawella%20ceypetco!5e0!3m2!1sen!2slk!4v1670222361081!5m2!1sen!2slk" width="1100" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <!--start overlay-->
            <div class="overlay toggle-menu"></div>
            <!--end overlay-->

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