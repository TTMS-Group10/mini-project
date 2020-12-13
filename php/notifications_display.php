<div id="notification_display">

    <!--To display notification count if it is greater than zero-->
    <?php if($count_rows>0): ?>
    <div class="n_count">
        <p>
            <?php echo $count_rows; ?>
        </p>
    </div>
    <?php else: ?>
    <?php $no_noti="There are no new notifications"; ?>
    <?php endif ?>

    <div class="notification_wrapper" id="notifications">

        <div class="link">
        </div>

        <div class="notification_area">
            <div class="n_head">
                <p>Notifications</p>
            </div>

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

                    <a href="index.php?accept=<?php echo $book['booking_id']; ?>" class="accept"><i class="fa fa-check-circle "></i>Accept</a>
                    <a href="index.php?decline=<?php echo $book['booking_id']; ?>" class="decline"><i class="fa fa-times-circle "></i>Decline</a>

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

                    <a href="index.php?read=<?php echo $book['booking_id'];?>" class="accept"><i class="fa fa-check-circle "></i>OK</a>
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

                <li><a href="notifications.php" class="view_all">View All</a></li>
            </ul>
        </div>


    </div>


</div>
