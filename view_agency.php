<?php include('php/connect.php'); ?>
<?php include('php/notification.php'); ?>


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

    <title> Partem | Agency</title>

    <link rel="shortcut icon" href="images/TravelLogoBlackv2icon.png">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <link rel="stylesheet" href="./css/package.css">





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


    <div class="whole agency_whole">
        <div class="agency_details">
            <?php  $agency_details=mysqli_query($connection,"SELECT * FROM agency_details WHERE agency_id=$agency_id");  ?>

            <?php  while($agency=mysqli_fetch_array($agency_details)){ ?>

            <h2>
                <?php echo $agency['agency_name'] ?>
            </h2>
            <p>
                <?php  
                                                                 
            $user_id=$agency['user_id']; 
            $user_details=mysqli_query($connection,"SELECT * FROM user_details WHERE user_id=$user_id");  

            while($u=mysqli_fetch_array($user_details))
            { 
             //   echo $u['name']." | ".$u['phone_no']; 
                echo  "Agent : ".$u['name'];
            } 
            ?>
                <br>
                <?php echo $agency['street_name'].", ".$agency['city'].", ".$agency['state']; ?>

            </p>



            <?php } ?>
        </div>

        <!--        Reading package details from database-->

        <?php  
        $package_details=mysqli_query($connection,"SELECT * FROM package_details WHERE agency_id=$agency_id"); 
        $count_package_a=mysqli_num_rows($package_details);
        
        ?>

        <?php if($count_package_a=='0'):?>
        <p class="empty_p">
            There are no packages currently available
        </p>
        <?php endif ?>

        <div class="grid_container">

            <ul class="grid">

                <?php  while($pack=mysqli_fetch_array($package_details)){ ?>



                <li>

                    <a href="view_package.php?view=<?php echo $pack['package_id'] ;?>">
                        <div class="box boxp">
                            <p><img src="images/<?php echo $pack['image'] ?>" alt="<?php echo $pack['package_name']; ?>" width="363px" height="274px" /></p>
                            <h4 class="links">
                                <?php echo $pack['package_name']; ?> </h4>
                            <div class="overbox">
                                <p><img class="links-outline" src="images/outline.png" alt="" /></p>
                                <div class="title overtext">
                                    <p class="links-title">
                                        <?php echo $pack['package_name']; ?>
                                    </p>
                                </div>
                              <div class="tagline overtext">

                                    <p class="links-description">

                                        <!--Name of the agency -->
                                        <span>
                                                <?php  

                                                $agency_id=$pack['agency_id']; 
                                                $agency_details=mysqli_query($connection,"SELECT * FROM agency_details WHERE agency_id=$agency_id");  

                                                while($ag=mysqli_fetch_array($agency_details)){ 
                                                    echo $ag['agency_name'];
                                                    echo "<br>";
                                                }

                                                ?>
                                      </span>

                                        <!--Details of Package--><br>
                                        <?php echo $pack['places']; ?><br>
                                        <?php echo $pack['days']; ?> days<br> Rs.
                                        <?php echo $pack['cost']; ?>
                                    </p>
                                  <p class="links-read-more">+ learn more</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>

                <?php } ?>


            </ul>



        </div>


    </div>


    </div>






    <!-- Footer Section-->
    <div class="footer" id="cu">
        <p class="copy">Copyright © 2017 PARTEM Inc. All rights reserved.</p>
    </div>

    <!-- Footer Section Ends-->

    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/script.js"></script>





</body>

</html>
