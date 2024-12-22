<?php include('partials/menu.php') ?>
<!-- main section starts -->
    <section class="main_section">
        <div class="container pt-5">
            <h1>Update Admin</h1>
        </div>
        <?php 
            $id = $_GET['id'];

            $sql = "select * from tbl_admin where id =$id";

            $res = mysqli_query($conn, $sql);

            if ($res == True){
                $count = mysqli_num_rows($res);
                if ($count == 1){
                    $row = mysqli_fetch_assoc($res);

                    $fullname = $row['full_name'];
                    $username = $row['username'];

                }else {
                    header('location:'. SITEURL. 'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="post">
            <div class="container pt-3 ">
                <div class="d-flex gap-3 align-items-center mb-3">
                    <div>
                        <label for="fullName">Fullname &nbsp;</label>
                    </div>
                    <div>
                        <input type="text" class="form-control" id="fullName" name="full_name" value="<?php echo $fullname ?>">
                    </div>
                </div>
                <div class="d-flex gap-3 align-items-center mb-3">
                    <div>
                        <label for="userName">Username</label>
                    </div>
                    <div>
                        <input type="text" class="form-control" id="userName" name="user_name" value="<?php echo $username ?>">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                </div>
                <input type="submit" value="Update Admin" class="btn btn-success mb-5" name="submit">
            </div>
        </form>
    </section>
    <?php
        if (isset($_POST['submit'])){
            $id = $_POST['id'];
            echo $id;
            $fullname = $_POST['full_name'];
            $username = $_POST['user_name'];
            $sql = "update tbl_admin set full_name ='$fullname', username ='$username' where id =$id";
            $res = mysqli_query($conn, $sql);
            
            if ($res == true) {
                $_SESSION['operation'] ="<div class='alert alert-success alert-dismissible'>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                Admin Updated Successfully
                                        </div>";
                //Redirect page
                header('location:'.SITEURL ."admin/manage-admin.php");
            }else {
                $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                Failed to Update Admin
                                        </div>";
                                        
                header('location:'.SITEURL ."admin/manage-admin.php");
            }
        }

        
    ?>
    <!-- main section ends -->
<?php include('partials/footer.php') ?>