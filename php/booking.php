<?php 

    $b_date="";
    $people="";
    $name="";
    $status="requested";


    if(isset($_POST['booking_confirm']))
    {
        if(!isset($_SESSION['user_id']))
        {
            header('location: login.php?error=booking');
        }
            
        else
        {
            $b_date=$_POST['b_date'];
            $people=$_POST['people'];
            
            if(isset($_GET['pack']))
            {
                $package_id=$_GET['pack'];
        
            }  
            
                // For getting the agency id of the agent using his user id
            $result=mysqli_query($connection,"SELECT agency_id FROM package_details WHERE package_id='$package_id'");
            while($row=mysqli_fetch_array($result))
            {
                $agency_id=$row['agency_id'];           
            }
          
            $user_id=$_SESSION['user_id'];
            
            $query="INSERT INTO booking_details (package_id,agency_id,user_id,booking_date,people,status) VALUES ('$package_id',$agency_id,'$user_id','$b_date','$people','$status')"; mysqli_query($connection,$query); 
            
            
            
        }
    }
        






?>
