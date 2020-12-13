<?php 

   // Creating the database connection
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="disa";
    $connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

    // testing if connection occurred
    if(mysqli_connect_errno())
    {
        die("Database connection failed : ").
            mysqli_connect_error().
            " (".mysqli_connect_errno().")" ;
    }



 //clearing the feedbacks
    
            if(isset($_POST['clear']))
            {

                $clear="DELETE FROM feedback_details";
                mysqli_query($connection,$clear);


                $resetid="ALTER TABLE feedback_details AUTO_INCREMENT=1";
                mysqli_query($connection,$resetid);

                header('location: ../admin/feedback.php');

            }
            
       


    

    //deleting records
    if(isset($_GET['del_a']))
    {
        $id=$_GET['del_a'];
        mysqli_query($connection,"DELETE FROM user_details WHERE user_id=$id");
        header('location: ../admin/manage_agent.php');
    }

    if(isset($_GET['del_u']))
    {
        $id=$_GET['del_u'];
        mysqli_query($connection,"DELETE FROM user_details WHERE user_id=$id");
        header('location: ../admin/manage_user.php');
    }

    if(isset($_GET['del_f']))
    {
        $id=$_GET['del_f'];
        mysqli_query($connection,"DELETE FROM feedback_details WHERE id=$id");
        header('location: ../admin/feedback.php');
    }

?>
