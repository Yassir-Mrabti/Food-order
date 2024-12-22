<?php include('partials/menu.php') ?>
<!-- main section starts -->
    <section>
        <div class="container py-5">
            <h1 class="mb-3">Add Admin</h1>

            <form action="" method="post">
                <div class="myContainer">
                    <div class="d-flex gap-3 align-items-center mb-3">
                        <div>
                            <label for="fullName">Fullname &nbsp;</label>
                        </div>
                        <div>
                            <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Enter your Name">
                        </div>
                    </div>
                    <div class="d-flex gap-3 align-items-center mb-3">
                        <div>
                            <label for="userName">Username</label>
                        </div>
                        <div>
                            <input type="text" class="form-control" id="userName" name="user_name" placeholder="Enter your Username">
                        </div>
                    </div>

                    <div class="d-flex gap-3 align-items-center mb-3">
                        <div>
                            <label for="pwd">Password&nbsp;</label>
                        </div>
                        <div>
                            <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter your Password">
                        </div>
                    </div>
                    <input type="submit" value="Add Admin" class="btn btn-success" name="submit">
                </div>
                
            </form>
        </div>
     </section>
    <!-- main section ends -->
<?php include('partials/footer.php') ?>

<?php
    //check the value from form and save it in dataBase
    
         //check wether the submit bottom is clicked or not
    if(isset($_POST['submit'])){
        // echo 'Button Clicked';
        //1. Get the data from the form
        $fullname = $_POST['full_name'];
        $username = $_POST['user_name'];
        $password = md5($_POST['password']);//PassWord Encryption with md5();
        //2. Sql query to save data
        $sql = "Insert into tbl_admin set
            full_name = '$fullname',
            username = '$username',
            password = '$password'
        ";
        //3. Execute query & save it.
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check wether (Query is Executed) data is inserted or not and display approgriate message
        if ($res == true) { 
            //Data Inserted
            //Creat a session variable to display messsage 
            $_SESSION['operation'] ="<div class='alert alert-success alert-dismissible'>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                        Admin Added Successfully
                                    </div>";
            //Redirect page
            header('location:'.SITEURL ."admin/manage-admin.php");
        }else {
            //Data not Inserted
            //Creat a session variable to display messsage 
            $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                        Failed to Add Admin
                                    </div>";
            //Redirect page
            header('location:'.SITEURL ."admin/manage-admin.php");
        }
    }
?>