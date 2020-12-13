<?php include('php/connect.php'); ?>
<?php include('php/notification.php'); ?>

<?php include('php/profile_settings.php'); ?>


<?php 

    $user_msg="Login | Sign Up";
    $login_url="login.php";
    
?>

<?php  
    if(isset($_GET['view']))
    {
        $agency_id=$_GET['view'];
        
    }
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> PARTEM | Profile</title>

    <link rel="shortcut icon" href="images/partemlogo.png">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <link rel="stylesheet" href="css/profile.css">









</head>

<body>



    <!--For smaller screens-->
    <div class="menu_icon">
        <i class="fa fa-bars" aria-hidden="true" id="menu_toggle"></i>
        <!--........................................................................................................-->
        <!--                if the user is logged in, this will show the user name and logout button -->
        <?php if(isset($_SESSION['name'])): ?>
        <?php 
                        $user_msg=$_SESSION['name'];
                        $login_url="javascript:void(0)";
                ?>
        <a class="name_mob" href="<?php echo $login_url ?>" onClick="toggle_visibility('notifications');"><i class="fa fa-user-circle hide" aria-hidden="true"></i> 
                    
                    <?php                         
                        echo $user_msg; 
                    ?>
                    
      </a>
        <!--Settings icon when logged in-->

        <a href="profile.php" class="user_settings"><i class="fa fa-cogs"></i></a>
        <?php endif ?>


        <!-- if the user is not logged in, this will show the login option -->
        <?php if(!isset($_SESSION['name'])): ?>

        <a class="log_mob" href="<?php echo $login_url ?>"><i class="fa fa-user-circle hide" aria-hidden="true"></i>

            <?php                         
                                echo $user_msg; 
                            ?>

      </a>


        <?php endif ?>


    </div>

    <div class="nav">

        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#pack">Packages</a></li>
            <li><a href="index.php#agent">Agencies</a></li>

            <?php if(isset($_SESSION['account_type'])=="Agent"): ?>
            <?php if($_SESSION['account_type']=="Agent"): ?>
            <li><a href="manage_package.php">Manage</a></li>
            <?php endif ?>
            <?php endif ?>

            <li><a href="index.php#cu">Contact Us</a></li>
            <!--........................................................................................................-->
            <!--                if the user is logged in, this will show the user name and logout button -->
            <?php if(isset($_SESSION['name'])): ?>
            <?php 
                        $user_msg=$_SESSION['name'];
                        $login_url="javascript:void(0)";
                ?>

            <div class="nav_r">

                <li class="login1">

                    <a href="<?php echo $login_url ?>" class="hide" onClick="toggle_visibility('notifications');"><i class="fa fa-user-circle" aria-hidden="true"></i> 
                    
                    <?php                         
                        echo $user_msg; 
                    ?>                    
                    </a>
                </li>

                <!--Settings icon when logged in-->

                <li class="user_settings hide_s"><a href="profile.php"><i class="fa fa-cogs"></i></a></li>
            </div>

        </ul>
    </div>
    <a href="index.php?logout='1" class="logout_btn">Log Out</a>
    <?php endif ?>
    <!--........................................................................................................-->
    <!-- if the user is not logged in, this will show the login option -->
    <?php if(!isset($_SESSION['name'])): ?>

    <li class="login">

        <a href="<?php echo $login_url ?>" class="hide"><i class="fa fa-user-circle" aria-hidden="true"></i> 

                            <?php                         
                                echo $user_msg; 
                            ?>

      </a>
    </li>
    </ul>
    </div>
    <?php endif ?>
    <!--........................................................................................................-->

    <?php include('php/notifications_display.php'); ?>
    <!--........................................................................................................-->

    </div>



    <div class="content">


        <h1>Profile Settings</h1>

        <div class="password">
            <h3>Change Password</h3>
            <form action="profile.php" method="post">

                <label for="current_password">Current Password</label>
                <input type="password" required autocomplete="off" name="old_pass">
                <br><br>
                <label for="new_password">New Password</label>
                <input type="password" required autocomplete="off" name="new_pass" id="new_pass">
                <br><br>
                <label for="retype_password">Retype Password</label>
                <input type="password" required autocomplete="off" name="re_pass" id="old_pass">
                <br><br>

                <?php if(isset($error)): ?>

                <p class="error">
                    <?php echo $error ?>
                </p>

                <?php endif ?>

                <?php if(isset($success)): ?>

                <p class="success">
                    <?php echo $success ?>
                </p>

                <?php endif ?>

                <input type="submit" value="Save Changes" name="save_pass">


            </form>

        </div>


        <?php if(isset($_SESSION['account_type'])):?>

        <?php if($_SESSION['account_type']=='Agent'): ?>


        <?php 
        
            $user_id=$_SESSION['user_id'];
            $agency_details=mysqli_query($connection,"SELECT * FROM agency_details WHERE user_id='$user_id'");
        
        ?>



        <div class="agency" id="update_section">
            <h3>Edit Agency Details</h3>
            <hr>

            <form action="profile.php#update_section" method="post">


                <?php while($row=mysqli_fetch_array($agency_details)) {?>

                <label for="agency_name">Agency Name</label>
                <input type="text" value="<?php echo $row['agency_name']; ?>" required autocomplete="off" name="agency_name">
                <br><br>
                <label for="street_name">Street Name</label>
                <input type="text" value="<?php echo $row['street_name']; ?>" required autocomplete="off" name="street_name">
                <br><br>
                <label for="city">City</label>
                <input type="text" value="<?php echo $row['city']; ?>" required autocomplete="off" name="city">
                <br><br>
                <label for="state">State</label>
                <input type="text" value="<?php echo $row['state']; ?>" required autocomplete="off" name="state">
                <br><br><br>

                <?php if(isset($update_msg)): ?>

                <p class="success" id="smsg">
                    <?php echo $update_msg ?>
                </p>

                <?php endif ?>

                <input type="submit" value="Update" name="update_agency">

                <?php } ?>

            </form>




        </div>




        <?php endif ?>
        <?php endif ?>




    </div>








    <!-- Footer Section-->
    <div class="footer" id="cu">
        <p class="copy">Copyright © 2020 PARTEM Inc. All rights reserved.</p>
</div>

    <!-- Footer Section Ends-->

    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/script.js"></script>




</body>

</html>
