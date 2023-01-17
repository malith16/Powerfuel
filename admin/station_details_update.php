<?php
session_start();
require_once("../database_connection.php");

if(!isset($_SESSION["admingmail"])){
    ?>
<script>
window.location = "login.php";
</script>

<?php
   }

$_SESSION['admingmail'];

$query="SELECT * FROM admin WHERE admin_gmail='$_SESSION[admingmail]'";
$result=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($result)){
    $username=$row['admin_name'];
    $_SESSION['username']=$username;
    

    
}

 $station_id= $_POST['station_id'];


$query1="SELECT * FROM fuel_station WHERE station_id='$station_id'";
$result1=mysqli_query($connection,$query1);
while($row1=mysqli_fetch_assoc($result1)){
    $id=$row1['station_id'];
    $_SESSION['station_id']=$id;
    
    $station_manager=$row1['station_manager'];
    $_SESSION['station_manager']=$station_manager;

    $station_district=$row1['station_District'];
    $_SESSION['station_District']=$station_district;

    $station_location=$row1['station_location'];
    $_SESSION['station_location']=$station_location;

    $station_contact=$row1['station_contact'];
    $_SESSION['station_contact']=$station_contact;
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
    <title>Station Details Update</title>

  <!-- Bootstrap core CSS-->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="../assets/css/animate.css" rel="stylesheet" type="text/css" />

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
                        <a class="nav-link" href="home.php">Home</a>
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
                                            <p class="user-subtitle"><?php echo $_SESSION['admingmail'];  ?></p>
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



        <div id="wrapper">

            <div class="card card-authentication1 mx-auto my-4">
                <div class="card-body">
                    <div class="card-content p-2">
                        <div class="card-title text-uppercase text-center py-3">FUEL STATION UPDATE</div>
                        <?php
        if(isset($_GET['msg'])){
            echo '<div class="alert alert-success" role="alert">' ;
            echo $_GET['msg'];
            echo '</div>' ;
         }
         if(isset($_GET['error'])){
            echo '<div class="alert alert-danger" role="alert">' ;
            echo $_GET['error'];
            echo '</div>' ;
         }

      ?>
                        <form action="station_update_submit.php" method="POST">
                            <div class="form-group">
                                <label>Manager Name</label>
                                <div class="position-relative">
                                    <input type="text" id="" class="form-control"
                                        placeholder="Enter Station Manager Name" name="managername"
                                        value="<?php echo $_SESSION['station_manager'];  ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Station District</label>
                                <div class="position-relative">
                                    <input type="text" id="" class="form-control"
                                        placeholder="Enter Station District" name="stationdistrict"
                                        value="<?php echo $_SESSION['station_District'];  ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Station Location</label>
                                <div class="position-relative">
                                    <input type="text" id="" class="form-control"
                                        placeholder="Enter Station Location" name="stationlocation"
                                        value="<?php echo $_SESSION['station_location'];  ?>">

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Station Contact Number</label>
                                <div class="position-relative">
                                    <input type="text" id="" class="form-control"
                                        placeholder="Enter the Station Contact Number" name="stationcontact"
                                        value="<?php echo $_SESSION['station_contact'];  ?>">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary"
                                name="station_update">UPDATE</button>


                        </form>
                    </div>
                </div>

            </div>



        </div>
        <!--wrapper-->

    </div>
    <!--End content-wrapper-->


    </div>
 <!-- Bootstrap core JavaScript-->
 <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Index js -->
    <script src="../assets/js/index.js"></script>


</body>

</html>