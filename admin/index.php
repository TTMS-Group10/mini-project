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

    <title>Admin | Home</title>

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
                <li><a href="reportrr.php"><i class="fa fa-area-chart" aria-hidden="true"></i>Report</a></li>
                <li><a href="feedback.php"><i class="fa fa-comments-o" aria-hidden="true"></i>Feedback</a></li>
            </ul>


        </div>



    </div>

    <div class="content" id="content">

        <div class="logo">
            <img src="../images/partemlogo.png" alt="Logo" height="202">
            <!--            <h3>Travel and Tour <br> Management System</h3>-->
        </div>


        <div class="dashboard">
            <i class="fa fa-tachometer"></i>
            <h2>Dashboard</h2>

            <section class="box_container">

                <ul>

                    <li>
                        <div class="box box1">
                            <i class="fa fa-user"></i>
                            <h3>Users</h3>
                            <h4>
                                <?php                               
                                 $count=mysqli_query($connection,"SELECT count(user_id) AS count_u FROM user_details WHERE account_type='User'");        
                                while($cu=mysqli_fetch_array($count))
                                {                   
                                     echo $cu['count_u']; 
                                } 
                                ?>
                            </h4>
                        </div>
                    </li>

                    <li>
                        <div class="box box2">
                            <i class="fa fa-user"></i>
                            <h3>Agents</h3>
                            <h4>
                                <?php                               
                               $count=mysqli_query($connection,"SELECT count(user_id) AS count_a FROM user_details WHERE account_type='Agent'");        
                        while($cu=mysqli_fetch_array($count))
                        {                   
                             echo $cu['count_a']; 
                        } 
                                ?>

                            </h4>
                        </div>
                    </li>

                    <li>
                        <div class="box box3">
                            <i class="fa fa-map-marker"></i>
                            <h3>Packages</h3>
                            <h4>
                                <?php                               
                               $count=mysqli_query($connection,"SELECT count(package_id) AS count_p FROM package_details");        
                        while($cu=mysqli_fetch_array($count))
                        {                   
                             echo $cu['count_p']; 
                        }
                                ?>

                            </h4>
                        </div>
                    </li>

                    <li>
                        <div class="box box4">
                            <i class="fa fa-book"></i>
                            <h3>Bookings</h3>
                            <h4>
                                <?php                               
                               $count=mysqli_query($connection,"SELECT count(booking_id) AS count_b FROM booking_details");        
                        while($cu=mysqli_fetch_array($count))
                        {                   
                             echo $cu['count_b']; 
                        }
                                ?>

                            </h4>

                        </div>
                    </li>
                </ul>


            </section>

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
