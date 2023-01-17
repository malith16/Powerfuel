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
    
// echo $_POST['station_id'];
    
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
    <title>CUSTOMER REQUEST FUEL PAGE</title>
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

                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><i class="icon-power mr-2"></i><a href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header></br></br></br>
        <!--End topbar header-->

        <div class="clearfix"></div>
        <?php
          $check_user="SELECT * FROM customer WHERE customer_gmail='$_SESSION[usergmail]'";
          $user_result=mysqli_query($connection,$check_user);
          while($user_row=mysqli_fetch_array($user_result)){
            $user_id=$user_row['customer_id'];
            $_SESSION['user_id']=$user_id;
            $user_vehicle_number=$user_row['vehicle_registration'];
            $_SESSION['vehicle_registration']=$user_vehicle_number;
            
          }

          $check_fuelstation="SELECT * FROM fuel_station WHERE station_id='$_POST[station_id]'";
          $fuel_result=mysqli_query($connection,$check_fuelstation);
          while($fuel_row=mysqli_fetch_assoc($fuel_result)){
            $station_district=$fuel_row['station_District'];
            $_SESSION['station_District']=$station_district;
            $station_location=$fuel_row['station_location'];
            $_SESSION['station_location']=$station_location;
            $station_id=$fuel_row['station_id'];
            $_SESSION['station_id']=$station_id;
          }

          error_reporting(0);

          $check_request="SELECT * FROM fuel_request WHERE request_userid='$_SESSION[user_id]'";
          $request_result=mysqli_query($connection,$check_request);
          while($request_row=mysqli_fetch_assoc($request_result)){
            $requset_date=$request_row['request_date'];
            $_SESSION['request_date']=$requset_date;
          }
          $date=date('Y-m-d', strtotime($_SESSION['request_date']. ' + 07 days'));
          
          $sql="DELETE FROM fuel_request WHERE request_date< now() - interval 07 DAY AND request_userid='$_SESSION[user_id]'";
          mysqli_query($connection,$sql);

        ?>
        <script>
        var count_id = "<?php echo $date; ?>";
        var countdowndate = new Date(count_id).getTime();

        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countdowndate - now;

            var day = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var second = Math.floor((distance % (1000 * 60)) / 1000);


            document.getElementById("demo1").innerHTML = day + " d :" + hours + " H :" + minutes + " M :" +
                second + " S ";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo1").innerHTML = "Delete Success.....";



            }
        }, 1000);
        </script>


        <div class="container-fluid">
            <div class="card card-authentication1 mx-auto my-4">
                <div class="card-body">
                    <div class="card-title">FUEL REQUET FORM</div>
                    <!-- <div class="card-title" id="demo1"></div> -->
                    <?php
                     if(isset($_GET['error'])){
                        echo '<div class="alert alert-danger" role="alert">' ;
                        echo $_GET['error'];
                        echo '</div>' ;
                     }

                    ?>
                    <hr>
                    <form class="form" action="request_fuel_form_submit.php" method="POST">
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">User ID</label>
                            <input type="text" class="form-control" id="userid" value="<?php echo $user_id;  ?>"
                                name="userid" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="inputPassword4" class="form-label">User Gmail</label>
                            <input type="text" class="form-control" id="usergmail"
                                value="<?php echo $_SESSION['usergmail'];  ?>" name="usergmail" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="inputPassword4" class="form-label">User Vehicle Number</label>
                            <input type="text" class="form-control" id="usergmail"
                                value="<?php echo $_SESSION['vehicle_registration'];  ?>" name="usergmail" disabled>
                        </div>

                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Fuel Station ID</label>
                            <input type="text" class="form-control" id="stationid"
                                value="<?php echo $_SESSION['station_id'];  ?>" name="stationid" disabled>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Station District</label>
                            <input type="text" class="form-control" id="stationdistrict"
                                value="<?php echo $station_district;  ?>" name="stationdistrict" disabled>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Station Location</label>
                            <input type="text" class="form-control" id="stationlocation"
                                value="<?php echo $station_location;  ?>" name="stationlocation" disabled>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Enter Request Fuel liters</label>
                            <input type="text" class="form-control" id="requestfuel" placeholder="Enter Fuel LIters"
                                name="request_fuel"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
                        </div>
                        <div class="col-12">
                            <div class="form-check">

                                <label class="form-check-label" for="gridCheck">

                                </label>
                            </div>

                            <div class="col-12" align="center">
                                <button type="submit" class="btn btn-primary" value="submit" name="send_request">SEND
                                    REQUEST</button>
                            </div>
                            <span id="responce"></span>
                    </form>

                    <!--start overlay-->
                    <div class="overlay toggle-menu"></div>
                    <!--end overlay-->
                </div>
            </div>
            <!-- End container-fluid-->

        </div>
        <!--End content-wrapper-->


    </div>
    <!--End wrapper-->
    <script src="countdown.js"></script>
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