<?php 

/*Changing Password*/

$old_pass="";
$new_pass="";
$re_pass="";
$error="";
$success="";



    if(isset($_POST['save_pass']))
    {
        $old_pass=$_POST['old_pass'];
        $new_pass=$_POST['new_pass'];
        $re_pass=$_POST['re_pass'];
        
        $user_id=$_SESSION['user_id'];
        
        /*checking the old password*/
        
        $check_pass=mysqli_query($connection,"SELECT password FROM user_details WHERE user_id='$user_id'");
        
        while($row=mysqli_fetch_array($check_pass))
        {
            $current_pass=$row['password'];
        }
        
        if($current_pass==$old_pass)
        {
            if($new_pass==$re_pass)
            {
                mysqli_query($connection,"UPDATE user_details SET password='$new_pass' WHERE user_id='$user_id'");
                $success="Password changed successfully";
            }
            else
            {
                $error="Please retype the password correctly";
            }
            
        }
        else
        {
            $error="Current password doesn't match";
        }
        
        
        
    }



?>


<?php 

/*Updating Agency Details*/
    $agency_name="";
$street_name="";
$city="";
$state="";
$update_msg="";

    if(isset($_POST['update_agency']))
    {
        $agency_name=$_POST['agency_name'];
        $street_name=$_POST['street_name'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        
        $user_id=$_SESSION['user_id'];
        
        mysqli_query($connection,"UPDATE agency_details SET agency_name='$agency_name', street_name='$street_name', city='$city', state='$state' WHERE user_id='$user_id'");
        
        $update_msg="Successfully Updated";
        
    }






?>
