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