<?php 
    $agency_id="";
    $package_id="";
    $package_name="";
    $places="";
    $days="";
    $cost="";
    $description="";
    $user_id="";
    $image="";
    $msg="";
    $target="";  
    $edit_state=false;
   

// Inserting

    if(isset($_POST['add']))
    {
        $package_name=$_POST['package_name'];
        $places=$_POST['places'];
        $days=$_POST['days'];
        $cost=$_POST['cost'];
        $description=$_POST['description'];
        
          // For getting the user id of the agent
         $user_id=$_SESSION['user_id'];

        // For getting the agency id of the agent using his user id
        $result=mysqli_query($connection,"SELECT agency_id FROM agency_details WHERE user_id='$user_id'");
        while($row=mysqli_fetch_array($result))
        {
            $agency_id=$row['agency_id'];           
        }
        
        
        // Image uploading
        
        // location for the uploaded image
        $target="images/".basename($_FILES['image']['name']);
        
        $image=$_FILES['image']['name'];
       
        
        
        //inserting
        $query="INSERT INTO package_details (agency_id,package_name,places,days,cost,image,description) VALUES ('$agency_id','$package_name','$places','$days','$cost','$image','$description')";
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
        
   


      // For getting the user id of the agent
        $user_id=$_SESSION['user_id'];

        // For getting the agency id of the agent using his user id
        $result=mysqli_query($connection,"SELECT agency_id FROM agency_details WHERE user_id='$user_id'");
        while($row=mysqli_fetch_array($result))
        {
            $agency_id=$row['agency_id'];           
        }

        $result=mysqli_query($connection,"SELECT agency_name FROM agency_details WHERE user_id='$user_id'");
        while($row=mysqli_fetch_array($result))
        {
            $agency_name=$row['agency_name'];           
        }


   
    //updating
    if(isset($_GET['edit']))
    {
        $edit_state=true;
        $package_id=$_GET['edit'];
        $_SESSION['package_id']=$package_id;
        $resultu=mysqli_query($connection,"SELECT * FROM package_details WHERE package_id='$package_id'");
        while($rowu=mysqli_fetch_array($result))
        {
             $package_name=$rowu['package_name'];
            $places=$rowu['places'];
            $days=$rowu['days'];
            $cost=$rowu['cost'];
            $description=$rowu['description']; 
            
        }
       
       
    }

      //inserting the updated records
        if(isset($_POST['update']))
        {
            $package_name=$_POST['package_name'];
        $places=$_POST['places'];
        $days=$_POST['days'];
        $cost=$_POST['cost'];
        $description=$_POST['description'];
           
        $package_id=$_SESSION['package_id'];
          
        // Image uploading
        
        // location for the uploaded image
        $target="images/".basename($_FILES['image']['name']);
        
        $image=$_FILES['image']['name'];
            
             $query="UPDATE package_details SET package_name='$package_name', places='$places', days='$days', cost='$cost', image='$image', description='$description' WHERE package_id='$package_id'";
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




  


    //deleting
    if(isset($_GET['del']))
    {
        $package_id=$_GET['del'];
        mysqli_query($connection,"DELETE FROM package_details WHERE package_id=$package_id");
        header('location: ./manage_package.php');
    }
    
?>
