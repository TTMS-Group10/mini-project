<!--booking notifications-->

<!--Show only requested bookings for agents and show accepted or declined bookings for users-->
<?php 

            $count_rows="";
            if(isset($_SESSION['account_type']))
            {
                if($_SESSION['account_type']=='Agent')
                {
                    $agency_id=$_SESSION['agency_id'];
                    $booking_details=mysqli_query($connection,"SELECT * FROM booking_details WHERE agency_id='$agency_id' AND status='requested' ORDER BY booking_id DESC");
                    $count_rows=mysqli_num_rows($booking_details);
                }
                elseif($_SESSION['account_type']=='User')
                {
                    $user_id=$_SESSION['user_id'];
                    $booking_details=mysqli_query($connection,"SELECT * FROM booking_details WHERE user_id='$user_id' AND (status='accepted' OR status='declined') ORDER BY booking_id DESC");
                    $count_rows=mysqli_num_rows($booking_details);
                }
                else
                {

                } 
            }
           
    
        ?>

<!--Updating booking status -->

<?php

    if(isset($_GET['accept']))
    {
        $booking_id=$_GET['accept'];        
        $query=mysqli_query($connection,"UPDATE booking_details SET status='accepted' WHERE booking_id='$booking_id'");   
        header('location: index.php');
    }

    if(isset($_GET['decline']))
    {
        $booking_id=$_GET['decline'];        
        $query=mysqli_query($connection,"UPDATE booking_details SET status='declined' WHERE booking_id='$booking_id'");
        header('location: index.php');
        
    }
                    
    if(isset($_GET['read']))
    {
        $booking_id=$_GET['read'];     
        $test=mysqli_query($connection,"SELECT status FROM booking_details WHERE booking_id='$booking_id'");
        $test_result=mysqli_fetch_array($test);
        $status=$test_result['status'];
        if($status=="accepted")
            $query=mysqli_query($connection,"UPDATE booking_details SET status='read_a' WHERE booking_id='$booking_id'");
        else
            $query=mysqli_query($connection,"UPDATE booking_details SET status='read_d' WHERE booking_id='$booking_id'");
        header('location: index.php');
        
    }


?>
