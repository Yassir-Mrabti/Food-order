<?php 
    include('../config/constants.php');
    include('login-check.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/all.min.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Food order website home page</title>
</head>
<body>
    <!-- menu section starts -->
     <header>
        <nav class="nav d-flex justify-content-center shadow-sm">
            <ul class="nav navbar">
                <li class="nav-item"><a href="index.php" class="nav-link text-danger text-hover">Home</a></li>
                <li class="nav-item"><a href="manage-admin.php" class="nav-link text-danger text-hover">Admin</a></li>
                <li class="nav-item"><a href="manage-category.php" class="nav-link text-danger text-hover">Category</a></li>
                <li class="nav-item"><a href="manage-food.php" class="nav-link text-danger text-hover">Food</a></li>
                <li class="nav-item"><a href="manage-order.php" class="nav-link text-danger text-hover">Order</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-danger text-hover">Logout</a></li>
            </ul>
        </nav>
     </header>
    <!-- menu section ends -->
     
