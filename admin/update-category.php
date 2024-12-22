<?php include('partials/menu.php') ?>
<!-- main section starts -->
    <section class="main_section">
        <div class="container pt-5">
            <h1>Update Category</h1>
        </div>
        <?php 
            if (isset($_GET['id'])){
                $id = $_GET['id'];
                // $image_name = $_GET['image_name'];
                $sql = "select * from tbl_category where id ='$id'";

                $res = mysqli_query($conn, $sql);
                
                $count = mysqli_num_rows($res);
                if ($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['id'];
                    $title = $row['title'];
                    $current_image = $row['image_name'] ;
                    $featured = $row['featured'];
                    $active = $row['active'];

                }else {
                    header('location:'. SITEURL. 'admin/manage-category.php');
                }
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="container">
                <table class="table">
                    <tr>
                        <td>
                            <label for="title" class="form-label me-5">Title</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $title?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="image" class="form-label">Current Image</label>
                        </td>
                        <td>
                            <?php
                                if ($current_image <> ""){
                                    ?>
                                        <img src="<?php echo SITEURL;?>/images/category/<?php echo $current_image;?>" style="width: 60px; height:60px" name="image">
                                    <?php 
                                }else {
                                    echo "<div class='text-danger'>
                                                Image not Added
                                        </div>";
                                }
                            ?> 
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="new_image" class="form-label">Select New Image</label>
                        </td>
                        <td>
                        <input type="file" class="form-control" id="image" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="featured" class="me-3">Featured </label>
                        </td>
                        <td>
                            <input <?php if ($featured =="Yes")echo 'checked'?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if ($featured =="No")echo 'checked'?> type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="active" >Active</label>
                        </td>
                        <td>
                            <input <?php if ($active =="Yes")echo 'checked'?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if ($active =="No")echo 'checked'?> type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" value="Update Category" class="btn btn-success" name="submit">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </section>
    <?php
        if (isset($_POST['submit'])){
            $id = $id;
            $title = $_POST['title'];
            $current_image= $current_image;
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            

            echo $current_image;
            // Remove the new Image
            //Upload new image
            
                //To upload imgae we need image name , source path and destination path
            $image_name = $_FILES['image']['name'];
            // Get the extension of our image
            if ($image_name <> ""){
                // $extention = end(explode('.',$image_name));
                $tmp = explode('.', $image_name);
                $extention = end($tmp);
                //Rename the image
                $image_name = "Food_Category_".rand(000,999).'.'.$extention;
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
                    header('location:'.SITEURL ."admin/manage-category.php");
                    die(); // Break
                }
                if ($current_image == ""){
                    $image_name = $image_name;
                }else{
                    $remove_path = "../images/category/$current_image";
                    $remove = unlink($remove_path);
                    //check the image is removed or not 
                    //If failed to remove then display message and stop the process
                    if ($remove == false){
                        $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                Failed to Remove the current image
                                            </div>";
                                            header('location:'.SITEURL ."admin/manage-category.php"); die(); 
                    }   
                }
            
            }else {
                $image_name = $current_image;
            }
            
            
            $sql_update = "UPDATE tbl_category SET 
                title = '$title', 
                image_name = '$image_name',
                featured = '$featured', 
                active = '$active'
                WHERE id = '$id'";
        
            $res_update = mysqli_query($conn, $sql_update);
            
            if ($res_update == true) {
                $_SESSION['operation'] ="<div class='alert alert-success alert-dismissible'>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                Category Updated Successfully
                                        </div>";
                header('location:'.SITEURL."admin/manage-category.php");
            }else {
                $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                Failed to Update Category
                                        </div>";
                                        
                header('location:'.SITEURL."admin/manage-category.php");
            }
            
        }
    ?>
    <!-- main section ends -->
<?php include('partials/footer.php') ?>