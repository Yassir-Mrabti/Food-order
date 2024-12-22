<?php include('partials/menu.php') ?>

<section>
    <div class="container py-5">
        <h1 class="mb-3">Add Category</h1>
        <?php 
                if(isset($_SESSION['operation'])){
                    echo $_SESSION['operation'];
                    unset($_SESSION['operation']);
                }   
        ?>
        <form action="" method="post" enctype="multipart/form-data">
                <div class="myContainer">
                    <table class="table">
                        <tr>
                            <td>
                                <label for="title" class="form-label me-5">Title</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Category title">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="image" class="form-label">Select Image</label>
                            </td>
                            <td>
                                <input type="file" class="form-control" id="image" name="image">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="featured" class="form-label me-3">Featured </label>
                            </td>
                            <td>
                                <input type="radio" id="featured" name="featured" value="Yes"> Yes
                                <input type="radio" id="featured" name="featured" value="No" checked> No
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="active" class="form-label">Active</label>
                            </td>
                            <td>
                                <input type="radio" id="active" name="active" value="Yes"> Yes
                                <input type="radio" id="active" name="active" value="No" checked> No
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="submit" value="Add Category" class="btn btn-success" name="submit">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        <?php 
            if (isset($_POST['submit'])){
                $title = $_POST['title'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                
                // print_r($_FILES['image']);
                // die();
                if (isset($_FILES['image']['name'])){
                    //To upload imgae we need image name , source path and destination path
                    $image_name = $_FILES['image']['name'];
                    // Get the extension of our image
                    if ($image_name <> ""){
                        $ext = end(explode('.',$image_name));
                        //Rename the image
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        
                        $destination_path = "../images/category/".$image_name;
                        // $image_name
                        //Finally we will upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);
                        
                        if ($upload == false){
                            $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                    Failed to Upload image
                                                </div>";
                            //Redirect page
                            header('location:'.SITEURL ."admin/add-category.php");
                            die(); // Break
                        }
                    }
                }else {
                    //Don't upload the image and set the image_name value is blank
                    $image_name= ''; 
                }

                $sql = "Insert into tbl_category set
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                ";

                $res = mysqli_query($conn, $sql);

                if ($res == true) { 
                    //Data Inserted
                    //Creat a session variable to display messsage 
                    $_SESSION['operation'] ="<div class='alert alert-success alert-dismissible'>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                Category Added Successfully
                                            </div>";
                    //Redirect page
                    header('location:'.SITEURL ."admin/manage-category.php");
                }else {
                    //Data not Inserted
                    //Creat a session variable to display messsage 
                    $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                Failed to Add Category
                                            </div>";
                    header('location:'.SITEURL ."admin/manage-category.php");
                }
            }
        ?>
    </div>
</section>
<?php include('partials/footer.php') ?>