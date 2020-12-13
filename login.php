<?php include('php/user_register.php'); ?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> PARTEM | Login</title>

    <link rel="shortcut icon" href="images/partemlogo.png">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">



</head>

<body>

    <div class="menu_icon">
        <i class="fa fa-bars" aria-hidden="true" id="menu_toggle"></i>
    </div>

    <div class="nav">

        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#pack">Packages</a></li>
            <li><a href="index.php#agent">Agencies</a></li>
            <li><a href="index.php#cu">Contact Us</a></li>

        </ul>

    </div>

    <div class="form_container">

        <div class="form">

            <div class="form-head">
                <h1>Log In</h1>
            </div>

            <div class="tab-content">


                <div id="login">
                    <h1>Welcome Back!</h1>

                    <form action="login.php" method="post">

                        <div class="field-wrap">
                            <label>Email Address<span class="req">*</span></label>
                            <input type="email" name="email" required autocomplete="off" />
                        </div>

                        <div class="field-wrap">
                            <label>Password<span class="req">*</span></label>
                            <input type="password" name="password" required autocomplete="off" />
                        </div>


                        

                        <!-- Login error-->
                        <?php if(isset($login_error)): ?>
                        <p class="error" style="margin-bottom:0px;">
                            <?php echo $login_error ;?>
                        </p>
                        <?php endif ?>



                        <!-- Booking error-->

                        <!-- This will be displayed, when the user tries to book a package without loging in first -->
                        <?php if(isset($_GET['error'])): ?>
                        <p class="error" style="margin-bottom:0px;">
                            <?php if($_GET['error']=="booking")
                                {
                                    echo "Please login to book the package!" ;
                                }
                            ?>
                        </p>
                        <?php endif ?>



                        <button class="button button-block logbtn" name="login">Log In</button>
                        <!--</button>-->

                        <div class="form-foot">
                            <p>Not a member yet? <a href="register.php">Sign Up</a> </p>
                        </div>

                    </form>

                </div>



            </div>
            <!-- tab-content -->

        </div>

    </div>




    <!-- Footer Section-->
    <div class="footer" id="cu">
        <p class="copy">Copyright © 2020 PARTEM Inc. All rights reserved.</p>
</div>

    <!-- Footer Section Ends-->

    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/script.js"></script>
    <script src="js/index.js"></script>




</body>

</html>
