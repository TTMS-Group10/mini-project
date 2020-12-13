<?php include('php/connect.php'); ?>
<?php 
    //if user is not logged in, they can't access this page
    if(empty($_SESSION['user_id']))
    {
        header('location: index.php');
    }

?>
<!--booking notifications-->

<!--Show only requested bookings for agents and show accepted or declined bookings for users-->
<?php 

            $count_rows="";
            if(isset($_SESSION['account_type']))
            {
                if($_SESSION['account_type']=='Agent')
                {
                    $agency_id=$_SESSION['agency_id'];
                    $booking_details=mysqli_query($connection,"SELECT * FROM booking_details WHERE agency_id='$agency_id' AND status='requested' ORDER BY booking_id DESC");
                    $count_rows=mysqli_num_rows($booking_details);
                }
                elseif($_SESSION['account_type']=='User')
                {
                    $user_id=$_SESSION['user_id'];
                    $booking_details=mysqli_query($connection,"SELECT * FROM booking_details WHERE user_id='$user_id' AND (status='accepted' OR status='declined') ORDER BY booking_id DESC");
                    $count_rows=mysqli_num_rows($booking_details);
                }
                else
                {

                } 
            }
           
    
        ?>

<!--Updating booking status -->

<?php

    if(isset($_GET['accept']))
    {
        $booking_id=$_GET['accept'];        
        $query=mysqli_query($connection,"UPDATE booking_details SET status='accepted' WHERE booking_id='$booking_id'");   
        header('location: notifications.php');
    }

    if(isset($_GET['decline']))
    {
        $booking_id=$_GET['decline'];        
        $query=mysqli_query($connection,"UPDATE booking_details SET status='declined' WHERE booking_id='$booking_id'");
         header('location: notifications.php');
        
    }
                    
    if(isset($_GET['read']))
    {
        $booking_id=$_GET['read'];     
        $test=mysqli_query($connection,"SELECT status FROM booking_details WHERE booking_id='$booking_id'");
        $test_result=mysqli_fetch_array($test);
        $status=$test_result['status'];
        if($status=="accepted")
            $query=mysqli_query($connection,"UPDATE booking_details SET status='read_a' WHERE booking_id='$booking_id'");
        else
            $query=mysqli_query($connection,"UPDATE booking_details SET status='read_d' WHERE booking_id='$booking_id'");
        header('location: notifications.php');
        
    }


?>



    <?php 

    $user_msg="Login | Sign Up";
    $login_url="login.html";
    
?>


    <!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> Disa | Notifications</title>

        <link rel="shortcut icon" href="images/TravelLogoBlackv2icon.png">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <style>
            .all_notifications {
                min-height: 100vh;
                width: 80%;
                margin: 0 auto;
                margin-top: 65px;
            }

            .all_notifications h3 {
                color: #072a4e;
                font-size: 20px;
                margin-bottom: 10px;
            }

            .all_notifications ul {
                list-style: none;
                width: 100%;
            }

            .all_notifications ul li {
                padding: 10px;
                margin-top: 5px;
                background-color: rgba(187, 214, 239, 0.58);
                border-radius: 10px;

            }

            .all_notifications p {
                font-size: 16px !important;
                margin-bottom: 10px;
                color: black;
            }

            .all_notifications i {
                margin-right: 5px;
            }

            .all_notifications a {
                padding: 5px 10px;
                text-decoration: none;
                font-size: 16px;
                border-radius: 8px;
                color: white;
            }

            .all_notifications span {
                color: #064567;
                font-size: 18px;
            }

            .all_notifications hr {
                clear: both;
                margin-top: 45px;
            }

            #main_hr {
                margin-top: 0;
            }

            #read li {
                background-color: white !important;
            }

            .n_msg p {
                margin-left: -10px;
                font-size: 18px !important;
            }

            @media (max-width: 768px) {
                .all_notifications {
                    width: 90%;
                }

            }

        </style>



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
            <a class="name_mob" href="<?php echo $login_url ?>" onclick="toggle_visibility('notifications');"><i class="fa fa-user-circle hide" aria-hidden="true"></i> 
                    
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

                        <a href="<?php echo $login_url ?>" class="hide" onclick="toggle_visibility('notifications');"><i class="fa fa-user-circle" aria-hidden="true"></i> 
                    
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

        <?php 
    //not able to view notification area in view all page
//    include('php/notifications_display.php');
    ?>
        <!--........................................................................................................-->

        </div>


        <div class="all_notifications">

            <h3>All Notifications</h3>
            <hr id="main_hr">
            <ul>

                <!--Displaying necessary notifications for agents(requests)-->
                <?php if($_SESSION['account_type']=='Agent'):?>

                <?php  while($book=mysqli_fetch_array($booking_details)){ ?>

                <?php 
                                    //for displaying user name and package name later
                                    $ui=$book['user_id'];
                                    $user_d=mysqli_query($connection,"SELECT * FROM user_details WHERE user_id='$ui'");

                                    $pi=$book['package_id'];
                                    $package_d=mysqli_query($connection,"SELECT * FROM package_details WHERE package_id='$pi'");
                                ?>
                <li>
                    <p>
                        <!--displaying name of the user who booked the package by using the user-id in booking details table-->
                        <?php 
                                            while($user=mysqli_fetch_array($user_d)){
                                                echo $user['name']; 
                                            }
                                        ?> have requested a booking for the package
                        <!--displaying name of the package the user booked using the package-id in booking details table-->
                        <?php
                                            while($package=mysqli_fetch_array($package_d)){
                                                echo "'".$package['package_name']."'";  
                                                }                                
                                        ?> for the date
                            <?php echo $book['booking_date']; ?> for
                            <?php echo $book['people']; ?> people.
                    </p>

                    <a href="notifications.php?accept=<?php echo $book['booking_id']; ?>" class="accept"><i class="fa fa-check-circle "></i>Accept</a>
                    <a href="notifications.php?decline=<?php echo $book['booking_id']; ?>" class="decline"><i class="fa fa-times-circle "></i>Decline</a>

                    <hr>
                </li>

                <?php } ?>

                <?php endif?>


                <!--Displaying necessary notifications for users(accpeted or declined)-->

                <?php if($_SESSION['account_type']=='User'):?>
                <?php  while($book=mysqli_fetch_array($booking_details)){ ?>

                <?php 
                                //for displaying user name and package name later
                                $ui=$book['user_id'];
                                $user_d=mysqli_query($connection,"SELECT * FROM user_details WHERE user_id='$ui'");

                                $pi=$book['package_id'];
                                $package_d=mysqli_query($connection,"SELECT * FROM package_details WHERE package_id='$pi'");
    
                                $ai=$book['agency_id'];
                                $agency_d=mysqli_query($connection,"SELECT * FROM agency_details WHERE agency_id='$ai'");
    
                                while($ad=mysqli_fetch_array($agency_d))
                                {
                                    $agent_id=$ad['user_id'];
                                }
    
                                $agent_d=mysqli_query($connection,"SELECT * FROM user_details WHERE user_id='$agent_id'");
                            ?>

                <li>
                    <p>
                        Your request for the package
                        <?php
                                        while($package=mysqli_fetch_array($package_d)){
                                            echo "'".$package['package_name']."'";  
                                        }                                
                                    ?>
                            for the date
                            <?php echo $book['booking_date']; ?> for
                            <?php echo $book['people']; ?> people has been
                            <?php 
                                        $status=$book['status'];                                
                                        if($status=='accepted')
                                        {
                                            echo "accepted. Contact the agent "; 
                                            while($agent=mysqli_fetch_array($agent_d)){
                                                echo "<span>";
                                                echo $agent['name']; 
                                                echo "</span>";
                                                echo " for more details."; 
                                                echo "<br><br>Ph: ";
                                                echo "<span>";
                                                echo $agent['phone_no']; 
                                                echo "</span>";
                                            } 
                                        }
                                                                           
                                        else
                                            echo "declined.";
                                    ?>
                    </p>

                    <a href="notifications.php?read=<?php echo $book['booking_id'];?>" class="accept"><i class="fa fa-check-circle "></i>OK</a>
                    <hr>
                </li>

                <?php } ?>

                <?php endif?>



                <!--    ---------------------------------------------------------------------------------------------------------------------------------- -->

                <?php
                        
            
              $count_rows2="";
            if(isset($_SESSION['account_type']))
            {
                if($_SESSION['account_type']=='Agent')
                {
                    $agency_id=$_SESSION['agency_id'];                    
                    $result=mysqli_query($connection,"SELECT * FROM booking_details WHERE agency_id='$agency_id' AND status!='requested'");
                    $count_rows2=mysqli_num_rows($result);                    
                }
                elseif($_SESSION['account_type']=='User')
                {
                    $id=$_SESSION['user_id'];
                    $result=mysqli_query($connection,"SELECT * FROM booking_details WHERE user_id='$id' AND (status='read_a' OR status='read_d') ");
                    $count_rows2=mysqli_num_rows($result);
                }
                else
                {

                } 
            }
            
            if($count_rows2+$count_rows==0)
                $no_noti="There are no notifications";
    
        ?>








            </ul>

            <!--Displaying necessary notifications for agents(requests)-->
            <ul id="read">
                <?php if($_SESSION['account_type']=='Agent'):?>

                <?php  while($row=mysqli_fetch_array($result)){ ?>

                <?php 
                                    //for displaying user name and package name later
                                    $ui=$row['user_id'];
                                    $user_d=mysqli_query($connection,"SELECT * FROM user_details WHERE user_id='$ui'");

                                    $pi=$row['package_id'];
                                    $package_d=mysqli_query($connection,"SELECT * FROM package_details WHERE package_id='$pi'");
        ?>

                <li>
                    <p>
                        You have
                        <?php 
                    if($row['status']=='accepted' || $row['status']=='read_a' )
                        echo "accepted";
                    else
                        echo "declined";
                ?>
                        <!--displaying name of the user who booked the package by using the user-id in booking details table-->
                        <?php 
                                            while($user=mysqli_fetch_array($user_d)){
                                                echo $user['name']; 
                                            }
                                        ?>'s request for the package
                        <!--displaying name of the package the user booked using the package-id in booking details table-->
                        <?php
                                            while($package=mysqli_fetch_array($package_d)){
                                                echo "'".$package['package_name']."'";  
                                                }                                
                                        ?> for the date
                            <?php echo $row['booking_date']; ?> for
                            <?php echo $row['people']; ?> people.

                    </p>
                    <hr>
                </li>

                <?php } ?>

                <?php endif?>

                <!--        User all read notifications-->


                <?php if($_SESSION['account_type']=='User'):?>

                <?php while($row=mysqli_fetch_array($result)){ ?>

                <?php 
                 //for displaying user name and package name later
                                $ui=$row['user_id'];
                                $user_d=mysqli_query($connection,"SELECT * FROM user_details WHERE user_id='$ui'");

                                $pi=$row['package_id'];
                                $package_d=mysqli_query($connection,"SELECT * FROM package_details WHERE package_id='$pi'");
    
                                $ai=$row['agency_id'];
                                $agency_d=mysqli_query($connection,"SELECT * FROM agency_details WHERE agency_id='$ai'");
    
                                while($ad=mysqli_fetch_array($agency_d))
                                {
                                    $agent_id=$ad['user_id'];
                                }
    
                                $agent_d=mysqli_query($connection,"SELECT * FROM user_details WHERE user_id='$agent_id'");
        
            ?>


                <li>
                    <p>
                        Your request for the package
                        <?php
                            
                                        while($package=mysqli_fetch_array($package_d)){
                                            echo "'".$package['package_name']."'";  
                                        }                                
                                    ?>
                            for the date
                            <?php echo $row['booking_date']; ?> for
                            <?php echo $row['people']; ?> people has been
                            <?php 
                                        $status=$row['status'];                                
                                        if($status=='read_a')
                                        {
                                            echo "accepted. Contact the agent "; 
                                            while($agent=mysqli_fetch_array($agent_d)){
                                                echo "<span>";
                                                echo $agent['name']; 
                                                echo "</span>";
                                                echo " for more details."; 
                                                echo "<br><br>Ph: ";
                                                echo "<span>";
                                                echo $agent['phone_no']; 
                                                echo "</span>";
                                            } 
                                        }
                                                                           
                                        else
                                            echo "declined.";
                                    ?>
                    </p>


                    <hr>
                </li>




                <?php } ?>
                <?php endif?>
                <?php if(isset($no_noti)): ?>
                <div class="n_msg">
                    <p>
                        <?php echo $no_noti; ?>
                    </p>
                </div>
                <?php endif ?>
            </ul>
        </div>




        <!-- Footer Section-->
        <div class="footer" id="cu">
            <p class="copy">Copyright © 2017 Disa Inc. All rights reserved.</p>
        </div>

        <!-- Footer Section Ends-->

        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/script.js"></script>





    </body>

    </html>
