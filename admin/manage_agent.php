<?php include('../php/admin_server.php'); 

    //if user is not logged in, they can't access this page
    if(empty($_SESSION['admin_id']))
    {
        header('location: login.php');
    }

?>

<?php include('../php/admin_um.php'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin | User Management</title>

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

        <div class="container">


            <div class="head">
                <i class="fa fa-users" aria-hidden="true"></i>
                <h2>Agent Management</h2>
                <!-- Search Bar    -->
                <div class="search" id="search">
                    <div>
                        <form action="manage_agent.php" method="post" class="search-box-wrapper">
                            <input name="search" type="text" placeholder="Search in Name, Email" class="search-box-input">
                            <button class="search-box-button"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>


            <?php 
            
                //retreiving records
            $count="";
            if(isset($_POST['search']))
            {
                
                $searchq=$_POST['search'];
                $searchq=preg_replace("#[^0-9a-z]#i","",$searchq); 
                $results=mysqli_query($connection,"SELECT * FROM user_details WHERE account_type='Agent' AND (name LIKE '%$searchq%' OR email LIKE '%$searchq%')");
                
                $count=mysqli_num_rows($results);
                
                
                if($count==0)
                    $search_error="Oops! There are no results for $searchq"; 
               
            }
            else
            {
                $results=mysqli_query($connection,"SELECT * FROM user_details WHERE account_type='Agent' ORDER BY user_id");
              
            }

                
            ?>

            <!-- displaying error if there are no search results-->
            <?php if(isset($search_error)): ?>

            <div class="search_error">
                <p>
                    <i class="fa fa-frown-o" aria-hidden="true"></i>
                    <?php echo $search_error; ?>
                </p>
            </div>
            <?php endif ?>


            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <!--If there are no search results, then the table headings will not be shown-->
                        <?php if(!isset($search_error)): ?>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                        </tr>
                        <?php endif ?>
                    </thead>
                    <tbody>
                        <?php while($row=mysqli_fetch_array($results)){ ?>
                        <tr>
                            <td>
                                <?php echo $row['user_id']; ?>
                            </td>
                            <td>
                                <?php echo $row['name']; ?>
                            </td>
                            <td>
                                <?php echo $row['email']; ?>
                            </td>
                            <td>
                                <?php echo $row['phone_no']; ?>
                            </td>

                            <td class="del">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#DelAgent<?php echo $row['user_id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>


                        <!-- .................................................................. -->


                        <!-- Modal for clearing all feedbacks-->
                        <div class="modal fade" id="DelAgent<?php echo $row['user_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete
                                        <?php echo $row['name']; ?>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-danger" href="../php/admin_um.php?del_a=<?php echo $row['user_id'];?>">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- .................................................................. -->
                        <?php } ?>
                    </tbody>

                </table>
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
