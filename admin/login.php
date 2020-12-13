<?php include('../php/admin_server.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin | Login</title>

   <link rel="shortcut icon" href="images/partemlogo.png">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>

    <div class="header">
        <img src="../images/partemlogo.png" alt="logo">
        <h3>Admin Login</h3>
    </div>

<div class="image">

</div>

    <div class="form_container">
        <form action="login.php" method="post">

            <!-- Displaying errors in login through php      -->
            <?php include('../php/errors.php'); ?>

            <label for="admin_id"><i class="fa fa-user-circle" aria-hidden="true"></i> Admin ID</label>
            <input type="text" name="admin_id" required autocomplete="off">
            <br>

            <label for="password"><i class="fa fa-key" aria-hidden="true"></i> Password</label>
            <input type="password" name="password" required autocomplete="off">
            <br>

            <input type="submit" name="login" value="Login" class="btn">

        </form>
    </div>



</body>

</html>
