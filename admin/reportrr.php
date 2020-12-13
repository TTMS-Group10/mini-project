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
    <link rel="stylesheet" href="../css/report.css">
    
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


   <!-- Load Font Awesome Icon Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Buttons to choose list or grid view -->
<button onclick="listView()"><i class="fa fa-bars"></i> List</button>
<button onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>

<div class="row">
  <div class="column" style="background-color:#aaa;">
    <h2>Column 1</h2>
    <p>Some text..</p>
  </div>
  <div class="column" style="background-color:#bbb;">
    <h2>Column 2</h2>
    <p>Some text..</p>
  </div>
</div>

<div class="row">
  <div class="column" style="background-color:#ccc;">
    <h2>Column 3</h2>
    <p>Some text..</p>
  </div>
  <div class="column" style="background-color:#ddd;">
    <h2>Column 4</h2>
    <p>Some text..</p>
  </div>
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
