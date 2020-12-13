<?php include('../php/admin_server.php'); 

    //if user is not logged in, they can't access this page
    if(empty($_SESSION['admin_id']))
    {
        header('location: login.php');
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin | Reports</title>

   <link rel="shortcut icon" href="images/partemlogo.png">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/admin_dash.css">

</head>

<body>

    <div class="side_panel" id="side">
        <div class="nav_toggle">
            <i id="nav_toggle" class="fa fa-bars" onClick="toggleSidebar();"></i>
        </div>


        <div class="side_top">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            <p>
                <?php 
                if(isset($_SESSION['admin_id']))
                    echo $_SESSION['admin_id'] ;
                ?>
            </p>
            <a href="login.php?logout='1'" class="myButton logout">Log Out</a>
        </div>

        <div class="side_menu">
            <ul>
                <li><a href="index.php"><i class="fa fa-tachometer"></i>Dashboard</a></li>
                <li><a href="manage_user.php"><i class="fa fa-users" aria-hidden="true"></i>Manage Users</a></li>
                <li><a href="manage_agent.php"><i class="fa fa-users" aria-hidden="true"></i>Manage Agents</a></li>
                <li><a href="report.php"><i class="fa fa-area-chart" aria-hidden="true"></i>Report</a></li>
                <li><a href="feedback.php"><i class="fa fa-comments-o" aria-hidden="true"></i>Feedback</a></li>
            </ul>


        </div>



    </div>

    <div class="content" id="content">


        <div class="head">
            <i class="fa fa-area-chart" aria-hidden="true"></i>
            <h2>Report</h2>
        </div>


        <?php
        
        // Getting the current month and date
        
        $today=getdate();       
        $month=$today['mon'];
        $day=$today['mday'];
        
        // getting the package with the most no.of booking in the current month
        
        $package=mysqli_query($connection,"SELECT package_id FROM booking_details WHERE EXTRACT(MONTH FROM booking_date)='$month' GROUP BY package_id ORDER BY COUNT(*) DESC LIMIT 1;");
        
        
        //getting all packages booked this month
        
        $all_packages=mysqli_query($connection,"SELECT *,EXTRACT(DAY FROM booking_date) AS day FROM booking_details WHERE EXTRACT(MONTH FROM booking_date)='$month' ORDER BY booking_date");
        
        $count=mysqli_num_rows($all_packages);
        
        
        
        
        ?>



            <div class="most_booked">
                <h3>Most booked package this month </h3>


                <?php if($count>0):?>

                <?php while($row=mysqli_fetch_array($package)){?>

                <?php 
                
                    $package_id=$row['package_id'];
    
                    $package_details=mysqli_query($connection,"SELECT * FROM package_details WHERE package_id='$package_id'");
                
                    //getting no.of times the this packages was booked
    
                    $number=mysqli_query($connection,"SELECT count(package_id) AS count FROM booking_details WHERE package_id='$package_id' AND EXTRACT(MONTH FROM booking_date)='$month'");
                
                
                ?>

                <div class="package">

                    <?php while($pack=mysqli_fetch_array($package_details)){?>

                    <img src="../images/<?php echo $pack['image']; ?>" alt="name">

                    <h4>
                        <?php echo $pack['package_name']; ?>
                    </h4>

                    <?php } ?>
                    <p>No.of Booking :
                        <span>
                     <?php while($nos=mysqli_fetch_array($number)){?>
                        <?php echo $nos['count'] ?>
                    <?php } ?>
                    </span>
                    </p>

                    <div class="gradient">
                    </div>
                </div>

                <?php } ?>

                <?php else:?>

                <div class="error">
                    <p>There are no bookings for this month</p>
                </div>

                <?php endif ?>

            </div>



            <div class="book_month">
                <h3>Bookings for this month</h3>

                <table>

                    <?php if($count>0):?>

                    <thead>
                        <tr>
                            <th>Package Name</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <?php else:?>

                    <div class="error">
                        <p>There are no bookings for this month</p>
                    </div>

                    <?php endif ?>


                    <tbody>


                        <?php while($row=mysqli_fetch_array($all_packages)){?>

                        <?php                 
                    $package_id=$row['package_id'];    
                    $package_details=mysqli_query($connection,"SELECT * FROM package_details WHERE package_id='$package_id'");  
                
                        ?>

                        <tr>
                            <?php while($pack=mysqli_fetch_array($package_details)){?>
                            <td>
                                <?php echo $pack['package_name']; ?>
                            </td>
                            <?php } ?>
                            <td>
                                <?php echo $row['booking_date']; ?>
                            </td>

                            <?php if($row['day']<=$day): ?>

                            <td class="check">
                                <i class="fa fa-check-circle"></i>
                            </td>

                            <?php endif ?>


                        </tr>


                        <?php } ?>
                    </tbody>
                </table>
            </div>



            <?php 
        
            $user_details=mysqli_query($connection,"SELECT * FROM user_details ORDER BY user_id DESC LIMIT 5");
        
            ?>



            <div class="latest_users">

                <h3>Latest Users</h3>

                <?php while($user=mysqli_fetch_array($user_details)){ ?>

                <p>

                    <?php
                        if($user['account_type']=="User")                                             
                            echo $user['name']." registerd as a User.";
                        else
                            echo $user['name']." registerd as an Agent.";                    
                    ?>
                </p>

                <?php } ?>

            </div>



    </div>



    <script src="../js/jquery-3.2.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>


    <script>
        function toggleSidebar() {
            document.getElementById("side").classList.toggle('active');

            document.getElementById("content").classList.toggle('blur');
        }

    </script>
</body>

</html>
