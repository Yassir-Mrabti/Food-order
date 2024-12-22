<?php include('partials/menu.php') ?>

    <!-- main section starts -->
     <section>
        <div class="container py-5">
            <h1>Manage Admin</h1>
            <?php 
                if(isset($_SESSION['operation'])){
                    echo $_SESSION['operation'];
                    unset($_SESSION['operation']);
                }   
            ?>
            <div class="my-3">
            <a href="add-admin.php" class="btn btn-primary">Add Admin</a>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    //Query to get all Admin
                    $sql = 'Select * from tbl_admin';
                    //Execute query
                    $res = mysqli_query($conn, $sql);
                    //Checking 

                    $sn = 1;
                    if ($res == true){
                        $count = mysqli_num_rows($res) ;//Function to get all the rows in db
                        if ($count >0 ){
                            while ($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];
                            ?>
                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $full_name ?></td>
                                <td><?php echo $username ?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id ?>" class="btn btn-primary">Change password</a>
                                    <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id ?>" class="btn btn-success">Update Admin</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id ?>" class="btn btn-danger">Delete Admin</a>
                                </td>
                            </tr>
                            <?php }
                        }
                    }else {

                    }
                ?>
            </table>
        </div>
     </section>
    <!-- main section ends -->
    <?php include('partials/footer.php') ?>