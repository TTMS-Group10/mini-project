<?php include('php/connect.php'); ?>

<?php include('php/notification.php'); ?>


<?php 

    $user_msg="Login | Sign Up";
    $login_url="login.php";
    
?>

<?php  
    if(isset($_GET['view']))
    {
        $package_id=$_GET['view'];
        
    }

   
?>

<?php include('php/review.php'); ?>

<?php include('php/booking.php'); ?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Partem | Packages</title>

    <link rel="shortcut icon" href="images/TravelLogoBlackv2icon.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">


    <link rel="stylesheet" href="css/lightbox.min.css">
    <script src="js/lightbox-plus-jquery.min.js"></script>


    <link rel="stylesheet" href="./css/manage.css">
    <link rel="stylesheet" href="./css/package.css">

    <style>
        .whole {
            width: 65%;
        }

        @media (max-width: 768px) {
            .whole {
                width: 95%;

            }
        }

    </style>


    <!--JavaScript for booking pop up (show/hide div)-->

    <script type="text/javascript">
        <!--
        function toggle_visibility(id) {



            var e = document.getElementById(id);
            if (e.style.display == 'block')
                e.style.display = 'none';
            else
                e.style.display = 'block';


        }
        //-->

    </script>



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

    <?php include('php/notifications_display.php'); ?>
    <!--........................................................................................................-->

    </div>


    <div class="whole">

        <?php  $package_details=mysqli_query($connection,"SELECT * FROM package_details WHERE package_id=$package_id");  ?>

        <?php  while($pack=mysqli_fetch_array($package_details)){ ?>



        <h2>
            <?php echo $pack['package_name']; ?>
        </h2>

        <div class="package_container">


            <div class="image_contain">
                <img src="./images/<?php echo $pack['image']; ?>" alt="<?php echo $pack['package_name']; ?>">
            </div>

            <div class="details">
                <h3>Itinerary</h3>

                <ul>
                    <?php 
                                                                 
            $p_list=$pack['places'];
            $array =  explode(',', $p_list);
            foreach ($array as $item) 
            {
                echo "<li>$item</li>";
            }  
            ?>
                </ul>

                <p>
                    <i class="fa fa-inr" aria-hidden="true"></i>
                    <?php echo $pack['cost']." per person"; ?>
                </p>
                <p>
                    <?php echo "No.of days : ".$pack['days']; ?>
                </p>
                <p>
                    <?php echo $pack['description']; ?>
                </p>

                <!--        Agency Name-->
                <h3>Provided by</h3>
                <?php  
                                                                     
            $agency_id=$pack['agency_id']; 
            $agency_details=mysqli_query($connection,"SELECT * FROM agency_details WHERE agency_id=$agency_id");  

            while($ag=mysqli_fetch_array($agency_details))
            { 
                echo "<p>".$ag['agency_name']."<br>";
                
                $user_id=$ag['user_id'];
                $user_details=mysqli_query($connection,"SELECT * FROM user_details WHERE user_id=$user_id");
                
                while($u=mysqli_fetch_array($user_details))
                {
                     echo "Agent : ".$u['name']."<br>";
                    // echo "Contact : ".$u['phone_no']."</p>";
                }
                

            }
                                                                     
         ?>

                <!--        booking and booking pop up-->

                <!--        This will be the section that pops up -->


                <div id="popup_box" class="popup_position">
                    <div id="popup_wrapper">
                        <a href="javascript:void(0)" onclick="toggle_visibility('popup_box');"><i class="fa fa-window-close" aria-hidden="true"></i></a>

                        <div id="popup_container">

                            <div class="form_container">


                                <form action="view_package.php?pack=<?php echo $pack['package_id']; ?>&status=book" class="booking_form" method="post">

                                    <?php
                                                                 
                                    $today=getdate();
                                                                 
                                    $day=$today['mday'];                                    
                                    $day_2 = sprintf("%02d", $day);                             
                                                                 
                                    $month=$today['mon'];
                                    $month_2 = sprintf("%02d", $month); 
                                                                 
                                    $year=$today['year'];                              
                                                                 
                                    
                                                                 
                                                                 
                                                                 
                                    ?>

                                        <label for="date">Book For</label>
                                        <input type="date" required name="b_date" min="<?php echo $year; ?>-<?php echo $month_2; ?>-<?php echo $day_2; ?>">

                                        <label for="people">No.of People</label>
                                        <input type="number" required id="total" min="1" max="50" name="people">

                                        <!-- JavaScript for displaying total amount -->

                                        <script src="js/jquery-3.2.1.js"></script>

                                        <script>
                                            $('.booking_form').on('input', '#total', function() {
                                                var totalcost = 0;
                                                $('.booking_form #total').each(function() {
                                                    var inputVal = $(this).val();
                                                    if ($.isNumeric(inputVal)) {
                                                        totalcost += parseFloat(inputVal);
                                                        totalcost = totalcost * <?php echo $pack['cost']; ?>;
                                                    }



                                                });
                                                $('#result').text(totalcost);
                                            });

                                        </script>

                                        <!-- .................................................................. -->

                                        <label for="total" class="total">Total : Rs.</label>
                                        <output id="result" name="total"></output>
                                        <p>*Rates are negotiable</p>

                                        <div class="submit_container">
                                            <input type="submit" name="booking_confirm" value="Confirm Booking">
                                        </div>





                                </form>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- This is the booking button -->
                <?php if(isset($_SESSION['name'])):?>
                <?php if($_SESSION['account_type']=='Agent'): ?>
                <?php else: ?>
                <div class="booking">

                    <a href="javascript:void(0)" class="book" onclick="toggle_visibility('popup_box');">Book Now</a>

                </div>


                <?php endif ?>
                <?php else: ?>
                <div class="booking">

                    <a href="javascript:void(0)" class="book" onclick="toggle_visibility('popup_box');">Book Now</a>

                </div>
                <?php endif ?>

                <?php } ?>
            </div>


        </div>

        <!-- ........................................................................................................................ -->
        <!--Gallery Section-->


        <?php
        
        $image="";
        $msg="";
        $target=""; 
        
            if(isset($_POST['add_img']))
            {
                 // Image uploading

            // location for the uploaded image
            $target="images/".basename($_FILES['image']['name']);

            $image=$_FILES['image']['name'];

                 //inserting
            $query="INSERT INTO gallery_details (package_id,image) VALUES ('$package_id','$image')";
            mysqli_query($connection,$query);

                if(move_uploaded_file($_FILES['image']['tmp_name'],$target))
            {
                $msg="Image uploaded successfully";
            }
            else
            {
                $msg="There was a problem uploading the image";
            }      
       
            
        }
        
        ?>




            <div class="gallery_container" id="gallery">
                <h3>Captured Moments</h3>
                <?php
                    if(isset($_GET['del_i']))
                    {
                        $id=$_GET['del_i'];
                        mysqli_query($connection,"DELETE FROM gallery_details WHERE image_id=$id");
                      // header('location: view_package.php?view=$package');
                    }
                
                ?>
                    <ul class="gallery_grid">

                        <?php  
                        
                        $gallery_details=mysqli_query($connection,"SELECT * FROM gallery_details WHERE package_id=$package_id"); 
                        $count_g=mysqli_num_rows($gallery_details);
                    
                    ?>

                        <?php  while($gal=mysqli_fetch_array($gallery_details)){ ?>

                        <li id="gal_img">
                            <a href="images/<?php echo $gal['image']; ?>" data-lightbox="gallery"><img src="images/<?php echo $gal['image']; ?>" alt="Image"></a>




                            <?php if(isset($_SESSION['name'])):?>
                            <?php if($_SESSION['account_type']=='Agent'): ?>

                            <?php 
                    $check=mysqli_query($connection,"SELECT * FROM package_details WHERE package_id=$package_id");           
                    

                  while($check_aid=mysqli_fetch_array($check))
                  { 
                    $c_aid=$check_aid['agency_id'];  
                  }
                ?>

                            <?php if($_SESSION['agency_id']==$c_aid): ?>

                            <a href="view_package.php?view=<?php echo $package_id; ?>&del_i=<?php echo $gal['image_id']; ?>#gallery" class="del_img">Delete</a>

                            <?php endif ?>
                            <?php endif ?>
                            <?php endif ?>


                        </li>


                        <?php  } ?>
                    </ul>

                    <?php if($count_g==0):?>
                    <div class="g_msg">
                        <p>

                            There are no images in the gallery.
                        </p>
                    </div>
                    <?php endif ?>




                    <?php if(isset($_SESSION['name'])):?>
                    <?php if($_SESSION['account_type']=='Agent'): ?>

                    <?php 
                    $check=mysqli_query($connection,"SELECT * FROM package_details WHERE package_id=$package_id");           
                    

                  while($check_aid=mysqli_fetch_array($check))
                  { 
                    $c_aid=$check_aid['agency_id'];  
                  }
                ?>

                    <?php if($_SESSION['agency_id']==$c_aid): ?>
                    <form action="view_package.php?view=<?php echo $package_id; ?>&img=added#gallery" method="post" enctype="multipart/form-data" class="new_img">
                        <label for="add">Add new image</label>
                        <input type="file" name="image" required accept="image/*">
                        <input type="submit" name="add_img" value="Upload">

                    </form>
                    <?php endif ?>
                    <?php endif ?>
                    <?php endif ?>

            </div>







            <!-- ........................................................................................................................ -->

            <div class="review">

                <!--displaying average rating-->
                <div class="circle">
                    <p>
                        <?php 
                              
                            $avg_rating=mysqli_query($connection,"SELECT AVG(rating) AS avg FROM review_details WHERE package_id=$package_id");        
                            while($avg=mysqli_fetch_array($avg_rating))
                                {
                                    if($avg['avg']==0)
                                        echo " "; 
                                    else
                                       echo round($avg['avg'],1); 
                                }        
                                    
                        ?>
                        <i class="fa fa-star" aria-hidden="true"></i>

                        <span>
                <!--to display review count-->
                        <?php 
                              
                            $r_count=mysqli_query($connection,"SELECT COUNT(review_id) AS count FROM review_details WHERE package_id=$package_id");        
                            while($count=mysqli_fetch_array($r_count))
                                {                                   
                                       echo "(".$count['count'].")"; 
                                }        
                                    
                        ?>
                        
                        </span>

                    </p>
                </div>
                <div class="user_r">

                    <?php if(isset($_SESSION['name'])): ?>
                    <?php if($_SESSION['account_type']=='User'):?>
                    <h3>Rate this package</h3>
                    <form action="#" method="post">

                        <fieldset class="rating">

                            <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>

                            <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>

                            <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Satisfactory - 3 stars"></label>

                            <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>

                            <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Very Poor - 1 star"></label>

                        </fieldset>
                        <br>
                        <br>
                        <label for="title" class="rev">Title</label>
                        <input type="text" name="title" required autocomplete="off">

                        <label for="comment" class="rev">Comment</label>
                        <textarea name="comment" id="" cols="30" rows="10" required autocomplete="off"></textarea>

                        <input class="submit" name="review_submit" type="submit" value="SUBMIT">

                    </form>
                    <?php endif ?>
                    <?php endif ?>
                </div>

                <br>

                <div class="all_r">
                    <h3>Reviews</h3>

                    <?php 
                    $count_r=mysqli_query($connection,"SELECT * FROM review_details WHERE package_id='$package_id'");
                    $count_review=mysqli_num_rows($count_r);
                    ?>

                    <?php if($count_review=='0'):?>
                    <p class="empty">
                        There are no reviews available
                    </p>
                    <?php endif ?>



                    <?php  $review_details=mysqli_query($connection,"SELECT * FROM review_details WHERE package_id=$package_id ORDER BY review_id DESC");  ?>
                    <?php  while($review=mysqli_fetch_array($review_details)){ ?>

                    <p>
                        <span class="r_icon">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    </span>
                        <?php
                $user_id=$review['user_id'];
                $user_details=mysqli_query($connection,"SELECT * FROM user_details WHERE user_id=$user_id");
                 while($u_name=mysqli_fetch_array($user_details))
                {
                     echo "<span class='r_name'>";
                     echo $u_name['name']."<br>"; 
                     echo "</span>";
                }
                ?>

                            <!--star rating-->
                            <?php 
                        for($i=0;$i<$review['rating'];$i++)
                        {
                    ?>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <?php      
                        }
                    ?>
                            <!--remaining star-->
                            <?php 
                        for($i=0;$i<(5-$review['rating']);$i++)
                        {
                    ?>
                            <span><i class="fa fa-star"></i></span>
                            <?php      
                        }
                    ?>

                            <br>
                            <?php                        
                        echo "<span class='r_title'>";
                        echo $review['title']; 
                        echo "</span>";
                    
                        ?>
                            <br>
                            <?php echo $review['comment']; ?>
                            <br>
                    </p>
                    <hr>
                    <?php } ?>


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
    <script src="js/index.js"></script>
    <script src="js/sweetalert2.all.js"></script>

    <script>
        /* $(document).ready(function() { $("form.booking_form").submit(function() { swal( 'Good job!', 'You clicked the button!', 'success' ); }); });*/

        $(document).ready(function() {
            function getUrlVars() {
                var vars = {};
                var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
                    vars[key] = value;
                });
                return vars;
            }

            var status = getUrlVars()["status"];

            if (status == "book") {
                swal(
                    'Booking Success!',
                    'Please wait for confirmation from the agent',
                    'success'
                )
            }

            var img = getUrlVars()["img"];

            if (img == "added#gallery") {
                swal(
                    'Image Added!',
                    'Image has been successfully added to the gallery',
                    'success'
                )
            }
        });

    </script>

</body>

</html>
