<?php include('php/connect.php'); ?>
<?php include('php/user_register.php'); ?>
<?php include('php/notification.php'); ?>
<?php 
    $user_msg="Login | Sign Up";
    $login_url="login.php";
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> PARTEM | Home</title>

    <link rel="shortcut icon" href="images/partemlogo.png">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Stylesheets for the carousel in featured packages -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <link rel="stylesheet" href="css/featuredpack.css">

    <!-- Stylesheet for the loading screen -->
    <link rel="stylesheet" href="css/loading.css">



</head>

<body>

    <!--Loading image and animation-->
    <div id="loading_overlay">
        <div class="loading">
          <ul>
                <li></li>
            </ul>
        </div>
    </div>
    <!-- ------------------------------------------------------------------ -->

    <header id="showcase">
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
            <a class="name_mob" href="<?php echo $login_url ?>" onClick="toggle_visibility('notifications');"><i class=" fa fa-user-circle hide " aria-hidden="true "></i> 
                    
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
                <li><a href="#pack" onClick="initScroll('pack'); return false;">Packages</a></li>
                <li><a href="#agent" onClick="initScroll('agent'); return false;">Agencies</a></li>

                <?php if(isset($_SESSION['account_type'])=="Agent"): ?>
                <?php if($_SESSION['account_type']=="Agent"): ?>
                <li><a href="manage_package.php">Manage</a></li>
                <?php endif ?>
                <?php endif ?>

                <li><a href="#cu" onClick="initScroll('cu'); return false;">Contact Us</a></li>
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



         <div class="landing_content">

           <p><img src="images/partemlogo.png" alt="Partem" height="266" id="logo"></p>
           <p>𝑻𝒉𝒆 𝒃𝒆𝒔𝒕 𝒕𝒓𝒂𝒗𝒆𝒍 𝒂𝒏𝒅 𝒕𝒐𝒖𝒓 𝒑𝒂𝒄𝒌𝒂𝒈𝒆𝒔 𝒇𝒓𝒐𝒎 𝒕𝒉𝒆 𝒎𝒐𝒔𝒕 𝒕𝒓𝒖𝒔𝒕𝒚 𝒕𝒓𝒂𝒗𝒆𝒍 𝒂𝒈𝒆𝒏𝒄𝒊𝒆𝒔 𝒂𝒕 𝒚𝒐𝒖𝒓 𝒇𝒊𝒏𝒈𝒆𝒓𝒕𝒊𝒑𝒔...</p>
           <p>&nbsp;</p>
           <p>&nbsp;</p>
           <p><a href="#f_pack" class="start_button hide" onClick="initScroll('f_pack'); return false;">Get Started</a> </p>
      </div>

    </header>


    <!--    Main Section -->

    <div class="content">
        <h1 id="f_pack">Featured Packages</h1>


        <?php 
        
        $f_package_details=mysqli_query($connection,"SELECT * FROM package_details LIMIT 6"); 
        
        ?>

        <div id="owl-demo">

            <?php while($f_pack=mysqli_fetch_array($f_package_details)){ ?>



            <div class="item">

                <img src="images/<?php echo $f_pack['image'] ?>" alt="<?php echo $f_pack['package_name'] ?>">
              <div class="info">
                    <p>
                        <?php echo $f_pack['package_name'] ?>
                        <br>
                        

                    </p>
                </div>

            </div>

            <?php } ?>

        </div>


        <!-- Search Bar    -->
        <div class="search" id="search">
            <div>
                <form action="index.php#search" method="post" class="search-box-wrapper">
                    <input name="search" type="text" placeholder="Search for Packages" class="search-box-input">
                    <button class="search-box-button"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>

        <!-- Search Bar Ends    -->



        <!--  All Packages -->
        <section id="pack">

            <div class="packages">

                <h1>Packages</h1>




              <div class="sort"></div>




                <!--show more packages-->
                <?php
            
                $limit_p=6;
                if(isset($_GET['more_p']))
                {
                    
                    $limit_p=$limit_p+$_GET['more_p'];
                }    
            
            
                ?>


                    <!--        Reading package details from database after checking for sort or search-->

                    <?php  
            $count_p="";   
            
            if(isset($_GET['sort_p']))
            {
                $sort=$_GET['sort_p'];
                if($sort=='htl')
                {
                    $package_details=mysqli_query($connection,"SELECT * FROM package_details ORDER BY cost DESC"); 
                }
                if($sort=='lth')
                {
                    $package_details=mysqli_query($connection,"SELECT * FROM package_details ORDER BY cost"); 
                }
            }
            else if(isset($_POST['search']))
            {
                
                $searchq=$_POST['search'];
                $searchq=preg_replace("#[^0-9a-z]#i","",$searchq);
                
                $package_details=mysqli_query($connection,"SELECT * FROM package_details WHERE package_name LIKE '%$searchq%'"); 
                
                
                $count_p=mysqli_num_rows($package_details);
                
                
                if($count_p==0)
                    $search_error_p="Oops! There are no results for $searchq"; 
               
            }
            else
            {
                $package_details=mysqli_query($connection,"SELECT * FROM package_details LIMIT $limit_p");
                $count_p=mysqli_num_rows($package_details);
            }
            
            ?>

                    <!-- displaying error if there are no search results-->
                    <?php if(isset($search_error_p)): ?>

                    <div class="search_error">
                        <p>
                            <i class="fa fa-frown-o" aria-hidden="true"></i>
                            <?php echo $search_error_p; ?>
                        </p>
                    </div>
                    <?php endif ?>

                    <div class="grid_container">

                        <ul class="grid">

                            <?php  while($pack=mysqli_fetch_array($package_details)){ ?>



                            <li>

                                <a href="view_package.php?view=<?php echo $pack['package_id'] ;?>">
                                    <div class="box boxp">
                                        <img src="images/<?php echo $pack['image'] ?>" alt="<?php echo $pack['package_name']; ?>" width="363px" height="274px" />
                                        <p></p>
                                        <h4 class="links">
                                            <?php echo $pack['package_name']; ?> </h4>
                                        <div class="overbox">
                                            <img class="links-outline" src="images/outline.png" alt="" />
                                            <p></p>
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
                                                $agency_details=mysqli_query($connection,"SELECT * FROM agency_details WHERE   
											agency_id=$agency_id");  

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







        </section>

        <!--Show more packages -->
        <?php if($limit_p<=$count_p): ?>
        <div class="showmore">
            <br>
            <a href="index.php?more_p=<?php echo $limit_p; ?>#pack">Show More <i class="fa fa-caret-down" aria-hidden="true"></i></a>

        </div>
        <?php endif ?>

        <!--Paralax Effect-->
        <section class="paralax quote">
            <div class="paralax_content">
                <h3>“Traveling – it leaves you speechless, then turns you into a storyteller.” <br> <span>– Ibn Battuta</span></h3>
            </div>
        </section>



        <!-- All Agencies -->

        <section id="agent">

            <h1>Travel Agencies</h1>
            <!-- Sort alphabetical option-->
          <div class="sort"></div>


            <!--show more agencies -->
            <?php
            
                $limit_a=6;
                if(isset($_GET['more_a']))
                {
                    
                    $limit_a=$limit_a+$_GET['more_a'];
                }
            
            
            ?>

                <!--        Reading agency details from database after checking for sort or search-->

                <?php             
            $count_a="";
            if(isset($_GET['sort_a']))
            {
                $sort=$_GET['sort_a'];
                if($sort=='atz')
                {
                     $agency_details=mysqli_query($connection,"SELECT * FROM agency_details ORDER BY agency_name ASC");  
                }
                if($sort=='zta')
                {
                     $agency_details=mysqli_query($connection,"SELECT * FROM agency_details ORDER BY agency_name DESC");   
                }
            }
            else if(isset($_POST['search']))
            {
                
                $searchq=$_POST['search'];
                $searchq=preg_replace("#[^0-9a-z]#i","",$searchq);                
                
                $agency_details=mysqli_query($connection,"SELECT * FROM agency_details WHERE agency_name LIKE '%$searchq%'");
                
                
                $count_a=mysqli_num_rows($agency_details);                
                
                
                if($count_a==0)
                    $search_error_a="Oops! There are no results for $searchq";
                    
            }
            else
            {
                  
                $agency_details=mysqli_query($connection,"SELECT * FROM agency_details LIMIT $limit_a");  
                 $count_a=mysqli_num_rows($agency_details);
            }
            
            ?>

          
		  
		  
		  
		  
		  
		  
		  
		  
		      

                <!--        Reading agency details from database-->

                <div class="grid_container">

                    <ul class="grid">

                        <?php  while($agency=mysqli_fetch_array($agency_details)){ ?>
                        <li>
						
                            <a href="view_agency.php?view=<?php echo $agency['agency_id']; ?>">
                                    
                                <div class="box boxt">
                                  <p> <img src="images/maxresdefault%20(2).jpg" alt="" width="363px" height="274px" /></p>  
									
                                    <h4 class="links">
                                        <?php echo $agency['agency_name']; ?>
                                    </h4>
                                    <div class="overbox">
                                        
                                        <p><img class="links-outline" src="images/outline.png" alt="" /></p>
                                        <div class="title overtext">
                                            <p class="links-title">
                                                <?php echo $agency['agency_name']; ?>
                                            </p>
                                        </div>
                                        <div class="tagline overtext">
                                            <p class="links-description">
											

                                                <!--Name and phone no of the agent -->
                                                <span>
                                <?php  
                                                                     
                                $user_id=$agency['user_id']; 
                                $user_details=mysqli_query($connection,"SELECT * FROM user_details WHERE user_id=$user_id");  
                                                                     
                                while($u=mysqli_fetch_array($user_details)){ 
                                  //  echo $u['phone_no']; 
                                  //  echo "<br> <br>"; 
                                     echo "<br>";
                                    echo "</span> "; echo " Agent : ".$u['name']; echo "<br>"; } ?>

                                                <!-- No.of packages-->

                                                <?php 
                                $agency_id=$agency['agency_id']; 
                                $package_count=mysqli_query($connection,"SELECT COUNT(agency_id) AS total FROM package_details WHERE agency_id=$agency_id");  
                                                                  
                                while($c=mysqli_fetch_array($package_count))
                                {                                   
                                    if($c['total']==1)
                                        echo "Offers ".$c['total']." package"; 
                                    else
                                        echo "Offers ".$c['total']." packages"; 
                                }
                                echo "<br>"
                                                                  
                                
                            ?>


                                                <!-- Minimun Cost of package-->

                                                <?php 
                              
                            $min_cost=mysqli_query($connection,"SELECT MIN(cost) AS min FROM package_details WHERE agency_id=$agency_id");        
                            while($mc=mysqli_fetch_array($min_cost))
                                {
                                    if($mc['min']==0)
                                        echo " "; 
                                    else
                                       echo "Starting at Rs.".$mc['min']; 
                                }        
                                    
                            ?>


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







        </section>
        <!--Show more -->
        <?php if($limit_a<=$count_a): ?>
        <div class="showmore">
            <br>
            <a href="index.php?more_a=<?php echo $limit_a; ?>#agent">Show More <i class="fa fa-caret-down" aria-hidden="true"></i></a>
        </div>
        <?php endif ?>


        <div class="gototop">
            <a href="#showcase" onClick="toTop('showcase'); return false;"><span>Top</span></a>
        </div>


        </div>


    </div>


    <!--Paralax Effect-->
    <section id="hills">
    </section>


    <!--   Main Section Ends-->

    <!-- Footer Section-->
    <div class="footer" id="cu">
        <div class="social">

            <h3>About Us</h3>
            <p>The objective of “PARTEM” is to provide a website that gives you the facility of booking various types of tours and travel packages. The project currently aims to provide a convenient way for colleges, schools and other institutions to select different tour packages based on different criteria and book them.            </p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            
			<h3>CONTACT US</h3>
            <p>Ph: +919945600000</p>
            <p>Call Centre Time : 24*7</p>
            <p>For enquiries, please send email to</p>
            <p>partem@travel.com</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <a href="#"><img src="images/facebook.png" alt="Facebook"></a>
            <a href="#"><img src="images/twitter.png" alt="Twitter"></a>
            <a href="#"><img src="images/google-plus.png" alt="GPlus"></a>

        </div>




        <!--        php to store the feedback details to the db-->

        <?php 
        
        // when user clicks the register button
    
        if(isset($_POST['c-submit']))
        {
            $name="";
            $email="";
            $feedback="";
            
            $name=$_POST['c-name']; 
            $email=$_POST['c-email']; 
            $feedback=$_POST['c-message'];            
            
            $query="INSERT INTO feedback_details (name,email,feedback) VALUES ('$name','$email','$feedback')";
            mysqli_query($connection,$query);
            
        }
        
        ?>


        <div class="contact">
            <h3>Feedback</h3>
            <form class="contact" name="contact-form" method="post" action="index.php">

                <label for="c-name">Name</label>
                <br>
                <input class="text" name="c-name" type="text" required autocomplete="off">
                <br><br>

                <label for="c-email">E-Mail</label>
                <br>
                <input class="text" name="c-email" type="email" required autocomplete="off">
                <br><br>

                <label for="c-message">Message</label>
                <br>
                <textarea class="c-message" name="c-message" required autocomplete="off"></textarea>
                <br><br>

                <input class="c-submit" name="c-submit" type="submit" value="SEND">
            </form>
        </div>



        <p class="copy">Copyright © 2020 PARTEM Inc. All rights reserved.</p>
    </div>

    <!-- Footer Section Ends-->




    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/script.js"></script>




    <!-- Scripts for the carousel in featured package section -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/featuredpack.js"></script>

    <!--for loading screen with atleast 1.5 loading time-->
    <script>
        var overlay = document.getElementById("loading_overlay");

        /*  window.addEventListener('load', function() {
              overlay.style.display = 'none';
          });*/

        window.addEventListener('load', setTimeout(function() {
            overlay.style.display = 'none';
        }, 1000));

    </script>


</body>

</html>

