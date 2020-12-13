<?php include('php/user_register.php'); ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> PARTEM | Register</title>

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
                <h1>Register</h1>
            </div>

            <div class="tab-content">




                <div id="signup">
                    <h1>Sign Up for Free</h1>

                    <form method="post" action="register.php">
                        <div class="field-wrap">

                            <label class="name">Name<span class="req">*</span></label>
                            <input type="text" name="name" required autocomplete="off" />
                        </div>


                        <div class="field-wrap">
                            <label>Email Address<span class="req">*</span></label>
                            <input type="email" name="email" required autocomplete="off" />
                        </div>

                        <div class="field-wrap">
                            <label>Phone Number<span class="req">*</span></label>
                            <input type="tel" name="phone_no" required autocomplete="off" maxlength="10" minlength="10" />
                        </div>

                        <div class="field-wrap">
                            <label>Set A Password<span class="req">*</span></label>
                            <input type="password" name="password" required autocomplete="off" />
                        </div>


                        <!--                  For selecting the type of user-->

                        <div class="field-wrap combo">

                            <label id="at_label" style=" -webkit-transform: translateY(50px);
                            transform: translateY(50px);
                            left: 2px;
                            font-size: 14px;
                            top:-15px;
                            visibility: hidden; ">Account Type</label>

                            <select class="AccountType" id="account_type" name="account_type">
                              <option value="AT" selected disabled hidden>Choose Your Account Type</option>
                              <option value="User">User</option>
                              <option value="Agent">Agent</option>               
                            </select>

                        </div>

                        <!-- To display email error -->
                        <?php if(isset($email_error)): ?>
                        <p class="error">
                            <?php echo $email_error ;?>
                        </p>

                        <?php endif ?>

                        <!-- To display account type error -->
                        <?php if(isset($acc_error)): ?>
                        <p class="error">
                            <?php echo "Please Select an Account Type";?>
                        </p>

                        <?php endif ?>

                        <!-- To display phone no error -->
                        <?php if(isset($phone_error)): ?>
                        <p class="error">
                            <?php echo $phone_error;?>
                        </p>

                        <?php endif ?>

                        <button type="submit" class="button button-block" name="register">REGISTER</button>
                        <div class="form-foot">
                            <p>Already a Member? <a href="login.php">Sign in</a> </p>
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
