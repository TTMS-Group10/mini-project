<?php include('php/user_register.php'); ?>
<?php 
    //if user is not logged in, they can't access this page
   // if(empty($_SESSION['name']))
   // {
  //      header('location: index.php');
   // }

?>


<?php 
   
     // reading agency details from agent

    $agency_name=""; $street_name=""; $city=""; $state=""; $user_id="";

   

     if(isset($_POST['continue']))
    {
           session_start();
        $agency_name=$_POST['agency_name'];
        $street_name=$_POST['street_name'];
        $city=$_POST['city'];
        $state=$_POST['state'];

         
        // For getting the user id of the agent
       $user_id=$_SESSION['user_id'];
         

        
         
        $query="INSERT INTO agency_details (user_id,agency_name,street_name,city,state) VALUES ('$user_id','$agency_name','$street_name','$city','$state')"; mysqli_query($connection,$query);     
       
         $query3="SELECT * FROM agency_details WHERE user_id=$user_id";
        $result3=mysqli_query($connection,$query3);
        while($row3=mysqli_fetch_array($result3))
        {
            $agency_id=$row3['agency_id'];
        }
        $_SESSION['agency_id']=$agency_id; 
        
        header('location: index.php');
                
            
        
    }
    

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PARTEM | Agent</title>

    <link rel="shortcut icon" href="images/partemlogo.png">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">

    <style type="text/css">
        .welcome {
            width: 50%;
            margin: 0 auto;
            margin-top: 20px;
            padding: 10px;
            text-align: center;
        }

        .welcome h1 {
            color: #072a4e;
        }

        .welcome p {
            margin-top: 5px;
            font-size: 18px;
        }

    </style>


</head>



<body>

    <div class="welcome">
        <h1>Welcome,
            <?php session_start(); echo $_SESSION['name']; ?>
        </h1>
        <p>But before starting, we need some more information</p>
    </div>

    <div class="form_container">

        <div class="form">

            <div class="form-head">
                <h1>AGENCY DETAILS</h1>
            </div>

            <div class="tab-content">




                <div id="signup">


                    <form method="post" action="agent.php">

                        <div class="field-wrap">
                            <label>Agency Name<span class="req">*</span></label>
                            <input type="text" name="agency_name" required autocomplete="off" />
                        </div>


                        <div class="field-wrap">
                            <label>Street Name<span class="req">*</span></label>
                            <input type="text" name="street_name" required autocomplete="off" />
                        </div>

                        <div class="field-wrap">
                            <label>City<span class="req">*</span></label>
                            <input type="text" name="city" required autocomplete="off" />
                        </div>

                        <div class="field-wrap">
                            <label>State<span class="req">*</span></label>
                            <input type="text" name="state" required autocomplete="off" />
                        </div>


                        <button type="submit" class="button button-block" name="continue">Continue</button>



                    </form>

                </div>

            </div>


        </div>

    </div>



    <!-- Footer Section-->
    <div class="footer" id="cu">
        <p class="copy">Copyright © 2020 PARTEM Inc. All rights reserved.</p>
</div>

    <!-- Footer Section Ends-->

    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/script.js"></script>
    <script src="js/index.js"></script>


</body>

</html>
