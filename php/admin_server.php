<?php 

    session_start();

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
?>


<?php 

    $admin_id="";
    $password="";
    $errors=array();


    // log user

    if(isset($_POST['login'])){
        $admin_id=$_POST['admin_id'];
        $password=$_POST['password'];
        
        
        if(count($errors)==0)
        {
           // $password=md5($password);//to encrypt before comaparing in db
            $query="SELECT * FROM admin_login WHERE admin_id='$admin_id' AND password='$password'";
            $result=mysqli_query($connection,$query);
            
            if(mysqli_num_rows($result)==1)
            {
                //log user in
                $_SESSION['admin_id']=$admin_id;               
                header('location: index.php'); // redirect to admin_page                
            }
            else
            {
                array_push($errors, "The Admin ID and Password does not match!!");                
            }
        
        
        
        
        }
        
    }






    //logout
    if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['admin_id']);
        header('location: login.php');
        
    }



?>
