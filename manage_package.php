<?php include('php/connect.php'); ?>
<?php 
    //if user is not logged in, they can't access this page
    if($_SESSION['account_type']!='Agent')
    {
        header('location: index.php');
    }

?>
<?php include('php/package.php'); ?>
<?php include('php/notification.php'); ?>

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

    <title> Partem| Manage Packages</title>

    <link rel="shortcut icon" href="images/TravelLogoBlackv2icon.png">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">


    <link rel="stylesheet" href="css/tmcss.css">

    <link rel="stylesheet" href="./css/manage.css">
    <link rel="stylesheet" href="./css/package.css">




</head>

<body>


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

    <div class="manage">

        <h1>
            <?php echo $agency_name;?>
        </h1>

        <?php if($edit_state==false): ?>

        <h3>Add New Package <i class="fa fa-plus-square" aria-hidden="true"></i> </h3>
        <div class="add_pack">

            <form action="manage_package.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-20">
                        <label for="package_name">Package Name</label>
                    </div>
                    <div class="col-80">
                        <input type="text" name="package_name" placeholder="package name....." required autocomplete="off">
                    </div>
                </div>

                <div class="row">
                    <div class="col-20">
                        <label for="places">Places</label>
                    </div>
                    <div class="col-80">
                        <input type="text" name="places" placeholder="places....." required autocomplete="off">
                    </div>
                </div>

                <div class="row">
                    <div class="col-20">
                        <label for="days">No.of Days</label>
                    </div>
                    <div class="col-80">
                        <input type="number" name="days" placeholder="no.of days....." required autocomplete="off">
                    </div>
                </div>

                <div class="row">
                    <div class="col-20">
                        <label for="cost">Package Cost</label>
                    </div>
                    <div class="col-80">
                        <input type="number" name="cost" placeholder="package cost....." required autocomplete="off">
                    </div>
                </div>


                <div class="row">
                    <div class="col-20">
                        <label for="image">Description</label>
                    </div>
                    <div class="col-80">
                        <textarea class="desc" name="description" placeholder="Provide a description....." required autocomplete="off"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-20">
                        <label for="image">Insert an Image</label>
                    </div>
                    <div class="col-80">
                        <input type="file" name="image" placeholder="insert an appropriate image....." required autocomplete="off" accept="image/*">
                    </div>
                </div>

                <div class="row">
                    <input type="submit" value="Add Package" name="add">

                </div>



                <?php else: ?>

                <h3>Update Package <i class="fa fa-refresh" aria-hidden="true"></i> </h3>
                <div class="add_pack">

                    <form action="manage_package.php" method="post" enctype="multipart/form-data">
                        <?php while($rowu=mysqli_fetch_array($resultu)){ ?>




                        <div class="row">
                            <div class="col-20">
                                <label for="package_name">Package Name</label>
                            </div>
                            <div class="col-80">
                                <input type="text" name="package_name" value="<?php echo $rowu['package_name']; ?>" required autocomplete="off">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-20">
                                <label for="places">Places</label>
                            </div>
                            <div class="col-80">
                                <input type="text" name="places" value="<?php echo $rowu['places']; ?>" required autocomplete="off">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-20">
                                <label for="days">No.of Days</label>
                            </div>
                            <div class="col-80">
                                <input type="number" name="days" value="<?php echo $rowu['days']; ?>" required autocomplete="off">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-20">
                                <label for="cost">Package Cost</label>
                            </div>
                            <div class="col-80">
                                <input type="number" name="cost" value="<?php echo $rowu['cost']; ?>" required autocomplete="off">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-20">
                                <label for="image">Description</label>
                            </div>
                            <div class="col-80">
                                <textarea class="desc" name="description" required autocomplete="off"><?php echo $rowu['description']; ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-20">
                                <label for="image">Insert an Image</label>
                            </div>
                            <div class="col-80">
                                <input type="file" name="image" placeholder="insert an appropriate image....." required autocomplete="off" accept="image/*">
                            </div>
                        </div>
                        <?php  } ?>
                        <div class="row">
                            <input type="submit" value="Update Package" name="update">

                        </div>


                        <?php endif ?>



                    </form>


                </div>


                <h3 id="manage">Manage Package <i class="fa fa-pencil-square-o" aria-hidden="true"></i></h3>

                <!-- Search Bar    -->
                <div class="pack_search_wrap">
                    <div class="pack_search">
                        <form action="manage_package.php#manage" method="post">
                            <input name="search" type="text" placeholder="Search in Package Name, Places">
                            <button><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>

                <!-- Search Bar Ends    -->

                <?php 
            
                //retreiving records
            $count="";
            $pack_empty="";
            if(isset($_POST['search']))
            {
                
                $searchq=$_POST['search'];
                $searchq=preg_replace("#[^0-9a-z]#i","",$searchq);                 
                
                $results=mysqli_query($connection,"SELECT * FROM package_details WHERE agency_id='$agency_id' AND (package_name LIKE '%$searchq%' OR places LIKE '%$searchq%') ORDER BY package_id ");
                
                $count=mysqli_num_rows($results);
                
                
                if($count==0)
                    $search_error="Oops! There are no results for $searchq"; 
               
            }
            else
            {
                   
                $results=mysqli_query($connection,"SELECT * FROM package_details WHERE agency_id='$agency_id' ORDER BY package_id");
                $count=mysqli_num_rows($results);
                if($count==0)
                    $pack_empty="There are currently no packages available"; 
              
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
                <!-- displaying Message if there are no packages-->
                <?php if(isset($pack_empty)): ?>
                <p class="message">
                    <?php echo $pack_empty; ?>
                </p>

                <?php endif ?>

                <div class="table-responsive">


                    <table class="table table-condensed">

                        <thead>
                            <!--The table headings will only be visible, if there are any records during search or complete view-->
                            <?php if($count>0 ):?>

                            <tr>
                                <th>Package Name</th>
                                <th>Places</th>
                                <th>Days</th>
                                <th>Cost</th>
                                <th>Image</th>
                                <th>Description</th>
                            </tr>
                            <?php endif ?>
                        </thead>


                        <tbody>



                            <?php while($row=mysqli_fetch_array($results)){ ?>

                            <tr>
                                <td>
                                    <a href="view_package.php?view=<?php echo $row['package_id']?>">
                                        <?php echo $row['package_name'] ?>
                                    </a>

                                </td>
                                <td>
                                    <?php echo $row['places'] ?>
                                </td>
                                <td>
                                    <?php echo $row['days'] ?>
                                </td>
                                <td>
                                    <?php echo $row['cost'] ?>
                                </td>
                                <td><img src="images/<?php echo $row['image'] ?>" alt="<?php echo $row['package_name'] ?>" height="70px" width="auto"></td>
                                <td>
                                    <?php echo $row['description'] ?>
                                </td>
                                <td class="del edit"><a href="manage_package.php?edit=<?php echo $row['package_id']; ?>"><i class="fa fa-cog" aria-hidden="true"></i></a></td>


                                <!-- <td class="del"><a href="manage_package.php?del=<?php echo $row['package_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>-->


                                <td class="del">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#DelPack<?php echo $row['package_id'];?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>


                            </tr>

                            <!-- .................................................................. -->


                            <!-- Modal for deleting package-->
                            <div class="modal fade" id="DelPack<?php echo $row['package_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                                            <a href="javascript:void(0)" type="button" class="close" data-dismiss="modal">                                             
                                              <i class="fa fa-window-close"></i>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete
                                            <?php echo "\"".$row['package_name']; ?>" package?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <a class="btn btn-danger" href="manage_package.php?del=<?php echo $row['package_id'];?>">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- .................................................................. -->








                            <?php  } ?>


                        </tbody>


                    </table>


                </div>





        </div>



        <!-- Footer Section-->
        <div class="footer" id="cu">
            <p class="copy">Copyright © 2017 Partem Inc. All rights reserved.</p>
        </div>

        <!-- Footer Section Ends-->

        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/script.js"></script>
        <script src="js/index.js"></script>

        <script src="js/tmjs.js"></script>






</body>

</html>
