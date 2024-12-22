<?php
    include('../config/constants.php');
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $sql1 = "select * from tbl_food where id ='$id'";
        $res1 = mysqli_query($conn, $sql1);
        
        $count = mysqli_num_rows($res1);
        if ($count == 1){
            $row = mysqli_fetch_assoc($res1);
            $image_name = $row['image_name'] ? $row['image_name'] : ' ' ;
        }else {
            header('location:'. SITEURL. 'admin/manage-food.php');
        }
    }

    if ($image_name != ""){
        $path = "../images/food/".$image_name;
        
        echo $path;
        //Remove the Image
        $remove = unlink($path);
        if ($remove== false){
            $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                        Failed to delete Image
                                </div>";
                                
        }
    }
    $sql = "Delete from tbl_food where id ='$id'";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['operation'] ="<div class='alert alert-success alert-dismissible'>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                        Food Deleted Successfully
                                </div>";
        header('location:'.SITEURL ."admin/manage-food.php");exit;
    }else {
        echo $path;
        $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                        Failed to delete Food
                                </div>";
        header('location:'.SITEURL ."admin/manage-food.php");exit;
    }
?>