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
?>




<?php 

$name=""; $email=""; $phone_no=""; $password=""; $account_type="";
$correct_no="";
$phone_error="";
// registering new user
 if(isset($_POST['register']))
    {
        session_start();
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone_no=$_POST['phone_no'];
     
        if(is_numeric($phone_no))
            $correct_no="true";
     
        $password=$_POST['password'];
        if (isset($_POST['account_type'])) 
            $account_type = $_POST['account_type'];

     
        // to check if the email id entered already exist in the database
        $check_email="SELECT * FROM user_details WHERE email='$email'";
        $res_email=mysqli_query($connection,$check_email) or die(mysqli_error($connection));
     
     
        if(mysqli_num_rows($res_email)>0)
        {
            $email_error="This E-Mail ID already has an account"; 
        }
        else
        {
            if($correct_no=="true")
            {
            //inserting
               $query="INSERT INTO user_details (name,email,phone_no,password,account_type) VALUES ('$name','$email',$phone_no,'$password','$account_type')"; mysqli_query($connection,$query);
     
       
                 $query="SELECT * FROM user_details WHERE email='$email'";
                $result=mysqli_query($connection,$query);
                 while($row=mysqli_fetch_array($result))
                 {
                    $user_id=$row['user_id'];
                     $_SESSION['user_id']=$user_id;
                 }
                
            
                $_SESSION['account_type']=$account_type;     

                if($_SESSION['account_type']=="User")
                {
                    $_SESSION['name']=$name;
                    $_SESSION['email']=$email;
                    header('location: index.php');
                }

                else if($_SESSION['account_type']=="Agent")  
                {
                    $_SESSION['name']=$name;
                    $_SESSION['email']=$email;
                    header('location: agent.php');  
                }

                else
                {
                    $acc_error="Please select an account type";

                }
            }
            else
            {
                $phone_error="Enter a valid phone number";    
            }
        }
        
                     
            
        
    }






    //loging in existitng user
 if(isset($_POST['login']))
 {
    
     
     $email=$_POST['email'];      
     $password=$_POST['password']; 
     
     $query="SELECT * FROM user_details";
    $result=mysqli_query($connection,$query);
     
     
     while($row=mysqli_fetch_array($result))
     {
         $db_userid=$row['user_id'];
         $db_name=$row['name'];
         $db_email=$row['email'];
         $db_password=$row['password'];
         $db_account_type=$row['account_type'];
         
         if($email==$db_email && $password==$db_password)
         {
             session_start();
               //log user in
             $_SESSION['name']=$db_name;
             $_SESSION['account_type']=$db_account_type;  
             $_SESSION['email']=$db_email;
             $_SESSION['user_id']=$db_userid;
             
            if($db_account_type=="Agent")
            {
                $query2="SELECT * FROM agency_details WHERE user_id=$db_userid";
                $result2=mysqli_query($connection,$query2);
                while($row2=mysqli_fetch_array($result2))
                {
                    $agency_id=$row2['agency_id'];
                }
                $_SESSION['agency_id']=$agency_id;
            }
     
            
                header('location: index.php');             
             
         }
         else
         {
            $login_error="Invalid E-Mail/Password Combination"; 
         }
     } 
     
 }
    



    // logout user

    if(isset($_GET['logout']))
    {
        session_destroy();
        unset($_SESSION['name']);
        header('location: index.php');
    }



   

?>
