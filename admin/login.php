<?php include('../config/constants.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/all.min.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Login</title>
</head>
<body>
<section>
    <div class="container bg-light my-5 p-5 sec-width shadow">
        <form method="post">
            <div class="text-center">
                <h3>Login</h3>
                <?php 
                if(isset($_SESSION['operation'])){
                    echo $_SESSION['operation'];
                    unset($_SESSION['operation']);
                } 
                if (isset($_SESSION['no-login-message'])) echo  $_SESSION['no-login-message'];
            ?>
            </div>
            <div class="pb-4 d-flex justify-content-center">
                <input type="text" name="username" class="form-control h-sixty" placeholder="Username">
            </div>

            <div class="d-flex pb-4 justify-content-center">
                <input type="password" name="password" class="form-control h-sixty" placeholder="Password">
            </div>

            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-success px-3 py-2" name="submit" value="Log in">
            </div>
        </form>
    </div>
</section>

    <?php
        if (isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count == 1){
                    $_SESSION['operation'] ="<div class='alert alert-success alert-dismissible'>
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                    Login Successfully
                                            </div>";
                    $_SESSION['user'] = $username;
                    header('location:'.SITEURL ."admin/");
            }else {
                    $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                    Username or password not match.
                                            </div>";                       
                    header('location:'.SITEURL ."admin/login.php");
            }
        }
    ?>
    
    <script src="../bootstrap/all.min.js"></script>
    <script src="../bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>