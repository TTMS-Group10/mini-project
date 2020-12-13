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

    <title>Admin | Feedbacks</title>

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
                <i class="fa fa-comments-o" aria-hidden="true"></i>
                <h2>Feedback</h2>
            </div>



            <?php
            $results=mysqli_query($connection,"SELECT * FROM feedback_details");
            
            $count=mysqli_num_rows($results);
            ?>


                <div class="table-responsive">
                    <table class="table table-striped table-bordered ">
                        <thead>
                            <?php  if($count>0): ?>

                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Feedback</th>
                            </tr>

                            <?php  else: ?>
                            <div class="search_error">
                                <p>
                                    <i class="fa fa-frown-o" aria-hidden="true"></i>
                                    <?php echo "There are no feedbacks available"; ?>
                                </p>
                            </div>

                            <?php  endif ?>
                        </thead>
                        <tbody>
                            <?php while($row=mysqli_fetch_array($results)){ ?>
                            <tr>
                                <td>
                                    <?php echo $row['id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['name']; ?>
                                </td>
                                <td>
                                    <?php echo $row['email']; ?>
                                </td>
                                <td>
                                    <?php echo $row['feedback']; ?>
                                </td>

                                <td class="del">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#DelFeedback<?php echo $row['id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>

                            <!-- .................................................................. -->


                            <!-- Modal for deleting a feedback-->
                            <div class="modal fade" id="DelFeedback<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this feedback?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <a class="btn btn-danger" href="../php/admin_um.php?del_f=<?php echo $row['id'];?>">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- .................................................................. -->




                            <?php } ?>
                        </tbody>

                    </table>
                </div>



                <?php  if($count>0): ?>

                <div class="contain_clear">
                    <button type="button" class="btn btn-outline-danger clear" data-toggle="modal" data-target="#ClearFeedback">
                          Clear
                        </button>

                </div>

                <!-- Button trigger modal -->


                <?php  endif ?>








        </div>

    </div>

    <!-- .................................................................. -->


    <!-- Modal for clearing all feedbacks-->
    <div class="modal fade" id="ClearFeedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Clear</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to clear all feedbacks?
                </div>
                <div class="modal-footer">
                    <form action="../php/admin_um.php" method="post">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>




                        <button type="submit" class="btn btn-danger" name="clear">CLEAR</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- .................................................................. -->



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
