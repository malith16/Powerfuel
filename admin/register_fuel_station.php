<?php
session_start();
require_once("../database_connection.php");

if (!isset($_SESSION["admingmail"])) {
?>
    <script>
        window.location = "login.php";
    </script>

<?php
}

$_SESSION['admingmail'];

$query = "SELECT * FROM admin WHERE admin_gmail='$_SESSION[admingmail]'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $username = $row['admin_name'];
    $_SESSION['username'] = $username;
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
    <title>Fuel Station Registration</title>


    <!-- Bootstrap core CSS-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="../assets/css/animate.css" rel="stylesheet" type="text/css" />

    <!-- Custom Style-->
    <link href="../assets/css/app-style.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        .errormsg {
            color: #fff;
            font-size: 12px;
        }
    </style>

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
                            <span class="user-profile"><img src="../assets/images/user1.png" class="img-circle" alt="user avatar"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item user-details">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <div class="avatar"><img class="align-self-start mr-3" src="../assets/images/user1.png" alt="user avatar"></div>
                                        <div class="media-body">
                                            <h6 class="mt-2 user-title"><?php echo $username;  ?></h6>
                                            <p class="user-subtitle"><?php echo $_SESSION['admingmail'];  ?></p>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li class="dropdown-item"><i class="icon-power mr-2"></i><a href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header></br></br></br>
        <!--End topbar header-->



        <div id="wrapper">

            <div class="card card-authentication1 mx-auto my-4">
                <div class="card-body">
                    <div class="card-content p-2">


                        <?php

                        $nameErr = $sdistrictErr = $slocationErr  = $contactErr = $fstatusErr = $passwordErr = $emailErr = "";
                        $managername = $stationdistrict = $stationlocation = $stationcontact = $fuelstatus = "";


                        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                            //String Validation field 1
                            if (empty($_POST["managername"])) {
                                $nameErr = "Manager name is required";
                            } else {
                                $managername = input_data($_POST["managername"]);
                                // check only for letters
                                if (!preg_match("/^[a-zA-Z ]*$/", $managername)) {
                                    $nameErr = "Only letters are allowed";
                                }
                            }

                            //String Validation field 2

                            if (empty($_POST["stationdistrict"])) {
                                $sdistrictErr = "Station district name is required";
                            } else {
                                $stationdistrict = input_data($_POST["stationdistrict"]);
                                if (!preg_match("/^[a-zA-Z ]*$/", $stationdistrict)) {
                                    $sdistrictErr  = "Only letters are allowed";
                                }
                            }

                            //String and number Validation field 3

                            if (empty($_POST["stationlocation"])) {
                                $slocationErr = "Station location is required";
                            } else {
                            }



                            //Number Validation field 4  
                            if (empty($_POST["stationcontact"])) {
                                $contactErr = "Mobile no is required";
                            } else {
                                $stationcontact = input_data($_POST["stationcontact"]);

                                if (!preg_match("/^[0-9]*$/", $stationcontact)) {
                                    $contactErr = "Only numeric value is allowed.";
                                }

                                if (strlen($stationcontact) != 10) {
                                    $contactErr = "Mobile no must contain 10 digits.";
                                }
                            }

                            //Number Validation field 5

                            if (empty($_POST["fuelstatus"])) {

                                $fstatusErr = "Fuel status is required";
                            } else {
                                $fuelstatus = input_data($_POST["fuelstatus"]);

                                if (!preg_match("/^[0-9]*$/", $fuelstatus)) {
                                    $fstatusErr = "Only number value is allowed.";
                                }

                                if (strlen($fuelstatus) >= 6) {
                                    $fstatusErr = "Must contain 6 digits";
                                }
                            }

                            if (empty($_POST["email"])) {

                                $emailErr = "Email is required";
                            } else {
                                
                            }

                            if (empty($_POST["password"])) {

                                $passwordErr = "Password is required";
                            } else {
                                
                            }

                        }
                        function input_data($data)
                        {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }



                        ?>
                        <div class="card-title text-uppercase text-center py-3">FUEL STATION REGISTER</div>
                        <form action="register_fuel_station.php" method="POST">
                            <div class="form-group">
                                <label>Manager Name</label> <span>*</span>
                                <div class="position-relative">
                                    <input type="text" id="" class="form-control" placeholder="Enter Station Manager Name" name="managername">
                                    <span class="errormsg"><?php echo $nameErr; ?> </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Station District</label><span>*</span>
                                <div class="position-relative">
                                    <input type="text" id="" class="form-control" placeholder="Enter Station District" name="stationdistrict">
                                    <span class="errormsg"><?php echo $sdistrictErr; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Station Location</label><span>*</span>
                                <div class="position-relative">
                                    <input type="text" id="" class="form-control" placeholder="Enter Station Location" name="stationlocation">
                                    <span class="errormsg"><?php echo $slocationErr; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Station Contact Number</label><span>*</span>
                                <div class="position-relative">
                                    <input type="text" id="" class="form-control" placeholder="Enter the Station Contact Number" name="stationcontact" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
                                    <span class="errormsg"><?php echo $contactErr; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Station fuel Status (Liters)</label><span>*</span>
                                <div class="position-relative">
                                    <input type="text" id="nameError" class="form-control" placeholder="Enter The Fuel status" name="fuelstatus" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
                                    <span class="errormsg"><?php echo $fstatusErr; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label><span>*</span>
                                <div class="position-relative">
                                    <input type="email" id="" class="form-control" placeholder="Enter The Email" name="email">
                                    <span class="errormsg"><?php echo $emailErr; ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label><span>*</span>
                                <div class="position-relative">
                                    <input type="password" id="" class="form-control" placeholder="Enter The password" name="password">
                                    <span class="errormsg"><?php echo $passwordErr; ?></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="station_register">REGISTER</button>


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


<?php

if (isset($_POST['station_register'])) {

    if ($nameErr == "" && $sdistrictErr == "" &&  $slocationErr == "" && $contactErr == "" && $fstatusErr == "" && $emailErr == "" && $passwordErr == "") {

        $managername = $_POST['managername'];
        $stationdistrict = $_POST['stationdistrict'];
        $stationlocation = $_POST['stationlocation'];
        $stationcontact = $_POST['stationcontact'];
        $fuelstatus = $_POST['fuelstatus'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']);;


        $query = "INSERT INTO `fuel_station` (`station_id`, `station_manager`, `station_status`, `station_District`, `station_location`, `station_contact`, `fuel_status`, `email`, `password`)
       VALUES (NULL, '$managername', 'Active', '$stationdistrict', '$stationlocation', '$stationcontact', '$fuelstatus', '$email', '$password')";
        $run_station = mysqli_query($connection, $query);

        echo "<script>alert('Your registration is completed')</script>";

        echo "<script>window.open('home.php','_self')</script>";
    } else {

        echo "<p>Form is not completed</p>";
    }
}



?>