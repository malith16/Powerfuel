<?php
session_start();
require_once("../database_connection.php");

if(!isset($_SESSION["usergmail"])){
    ?>
<script>
window.location = "login.php";
</script>

<?php
   }
$_SESSION['usergmail'];

$query="SELECT * FROM customer WHERE customer_gmail='$_SESSION[usergmail]'";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($result)){
    $username=$row['customer_name'];
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
    <title>CUSTOMER FUEL STATION SEARCH PAGE</title>
    <!-- loader-->
    <link href="../assets/css/pace.min.css" rel="stylesheet" />
    <script src="../assets/js/pace.min.js"></script>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</head>

<body class="bg-theme bg-theme1">

    <!-- Start wrapper-->
    <div id="wrapper">




        <!--Start topbar header-->
        <header class="topbar-nav">
            <nav class="navbar navbar-expand fixed-top">
                <ul class="navbar-nav mr-auto align-items-center">
                    <li class="nav-item">

                    </li></br></br>
                    <li class="nav-item">
                        <form class="search-bar" action="" method="POST">
                            <input type="text" class="form-control" placeholder="Enter keywords" name="serach_input">
                            <a><button type="submit" name="search"><i class="icon-magnifier"></i></button></a>
                        </form>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center right-nav-link">
                    <li class="nav-item dropdown-lg">
                        <a class="nav-link " href="home.php">Home</a>
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
                                            <p class="user-subtitle"><?php echo $_SESSION['usergmail'];  ?></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            
                            <li class="dropdown-divider"></li>

                            <li class="dropdown-item"><i class="icon-power mr-2"></i><a href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <!--End topbar header-->

        <div class="clearfix"></div>


        <div class="container-fluid">
            <div class="row align-items-center vh-100">
                <div class="col-12 col-lg-12">
                    <div class="card">

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush table-borderless">
                                <thead>
                                    <tr>
                                        <th>Fuel Station ID</th>
                                        <th>Station Manager Name</th>
                                        <th>Station Contact Number </th>
                                        <th>Station District</th>
                                        <th>Station Location</th>
                                        <th>Station status</th>
                                        <th>Request</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($_POST['search'])){
                                            $query1="SELECT * FROM `fuel_station` WHERE station_location LIKE('$_POST[serach_input]%')";
                                            $result1=mysqli_query($connection,$query1);
                                            while($row1=mysqli_fetch_assoc($result1)){
                                                echo "<tr>";
                                                echo "<td>{$row1['station_id']}</td>";
                                                echo "<td>{$row1['station_manager']}</td>";
                                                echo "<td>{$row1['station_contact']}</td>";
                                                echo "<td>{$row1['station_District']}</td>";
                                                echo "<td>{$row1['station_location']}</td>";
                                                echo "<td>{$row1['station_status']}</td>";
                                                echo "<td>";
                                                echo "<form action='fuel_request_form.php' method='post'>";
                                                echo "<input type='hidden' value='{$row1['station_id']}' name='station_id'>";
                                                echo "<button type='submit' class='btn btn-success' value='request' name='request' >Request</button></br></br>";
                                                echo "</form>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }

                                        }else{
                                            $query="SELECT * FROM `fuel_station`";
                                            $result=mysqli_query($connection,$query);
                                            while($row=mysqli_fetch_assoc($result)){
                                               echo "<tr>";
                                               echo "<td>{$row['station_id']}</td>";
                                               echo "<td>{$row['station_manager']}</td>";
                                               echo "<td>{$row['station_contact']}</td>";
                                               echo "<td>{$row['station_District']}</td>";
                                               echo "<td>{$row['station_location']}</td>";
                                               echo "<td>{$row['station_status']}</td>";
                                               echo "<td>";
                                               echo "<form action='fuel_request_form.php' method='post'>";
                                                echo "<input type='hidden' value='{$row['station_id']}' name='station_id'>";
                                                echo "<button type='submit' class='btn btn-success' value='request' name='request'  >Request</button></br></br>";
                                                echo "</form>";
                                               echo "</td>";
                                               echo "</tr>";
                                            }
                                        }
                                        

                                        ?>
                                    </td>
                                    </tr>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Row-->

            <!--End Dashboard Content-->

            <!--start overlay-->
            <div class="overlay toggle-menu"></div>
            <!--end overlay-->

        </div>
        <!-- End container-fluid-->

    </div>
    <!--End content-wrapper-->


    </div>
    <!--End wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="countdown.js">

    </script>
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