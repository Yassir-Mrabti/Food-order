<?php
//Authorizaton - Access control
    if (!isset($_SESSION['user'])){ // if the user is not set

        $_SESSION['no-login-message'] = "<div class='alert alert-danger alert-dismissible'>
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                    Please login to access Admin Panel.
                                            </div>";
        header('location:'.SITEURL ."admin/login.php");
    }
?>