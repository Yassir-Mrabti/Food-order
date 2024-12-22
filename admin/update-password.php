<?php include('../admin/partials/menu.php')?>

<!-- main section starts -->
<section class="main_section">
        <div class="container py-5">
            <h1 class="mb-3">Change Password</h1>

            <form action="" method="post">
                <div class="myContainer">
                    <div class="d-flex gap-3 align-items-center mb-3">
                        <div>
                            <label for="current_password" class="me-2">Current Password&nbsp;</label>
                        </div>
                        <div>
                            <input type="password" class="form-control" id="old" name="current_password" placeholder="Current Password">
                        </div>
                    </div>
                    <div class="d-flex gap-3 align-items-center mb-3">
                        <div>
                            <label for="new_password" class="me-4">New Password &nbsp;</label>
                        </div>
                        <div>
                            <input type="password" class="form-control" id="new" name="new_password" placeholder="New Password">
                        </div>
                    </div>

                    <div class="d-flex gap-3 align-items-center mb-3">
                        <div>
                            <label for="pass_word">Confirm Password &nbsp;</label>
                        </div>
                        <div>
                            <input type="password" class="form-control" id="pwd" name="pass_word" placeholder="Confirm Password">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id = $_GET['id']; ?>">
                    <input type="submit" value="Change Password" class="btn btn-success" name="submit">
                </div>
            </form>
        </div>
     </section>
    <!-- main section ends -->

    <?php
        if (isset($_POST['submit'])){
            $id = $_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirmation = md5($_POST['pass_word']);
            if ($new_password == $confirmation){
                $sql = "SELECT * FROM tbl_admin WHERE id = '$id' AND password = '$current_password'";
    
                $res = mysqli_query($conn, $sql);
                if ($res == true){
                    $count = mysqli_num_rows($res);
                    
                    if ($count == 1){
                        echo 'user exist';
                        $sql1= "Update tbl_admin set password='$new_password' where id=$id and password='$current_password'";
                        $res1 = mysqli_query($conn, $sql1); 
                        if ($res1 == true){
                            $_SESSION['operation'] ="<div class='alert alert-success alert-dismissible'>
                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                            Password change Successfuly
                            </div>";
                            header('location:'.SITEURL ."admin/manage-admin.php");
                        }else {
                            $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                            Failed to change Password
                            </div>";

                            header('location:'.SITEURL ."admin/manage-admin.php");
                        }
                    }else{
                        $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                    Admin doesn't Exist
                                            </div>";
                        
                        header('location:'.SITEURL ."admin/manage-admin.php");
                        
                    }
                }
            }else {
                $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                    Password did not match
                                            </div>";
                        
                        header('location:'.SITEURL ."admin/manage-admin.php");
            }
        }

    ?>

<?php include('../admin/partials/footer.php')?>