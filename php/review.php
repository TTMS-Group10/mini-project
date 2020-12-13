<!-- Entering Review -->

<?php 

    $title="";
    $comment="";
    $rating="";   
    if(isset($_SESSION['name']))
    {
        if(isset($_POST['review_submit']))
        {
            
            $rating=$_POST['rating'];
            $title=$_POST['title'];
            $comment=$_POST['comment'];
            
            $user_id=$_SESSION['user_id'];          
            
            
            
             // to check if the the user have already reviewd the selected package
            $check="SELECT * FROM review_details WHERE package_id='$package_id' AND user_id='$user_id'";
            $check_review=mysqli_query($connection,$check) or die(mysqli_error($connection));
            
            if(mysqli_num_rows($check_review)>0)
            {
                $query="UPDATE review_details SET rating='$rating',title='$title',comment='$comment' WHERE (user_id='$user_id' AND package_id='$package_id')";
                mysqli_query($connection,$query); 
            }             
            else
            {
                $query="INSERT INTO review_details(package_id,user_id,rating,title,comment) VALUES ('$package_id','$user_id','$rating','$title','$comment')";
                mysqli_query($connection,$query); 
            }
            
            
        }
    }


?>
