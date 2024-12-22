<?php include('partials/menu.php');
ob_start();
?>
<!-- main section starts -->
    <section class="main_section">
        <div class="container pt-5">
            <h1>Update Food</h1>
        </div>
        <?php 
            if (isset($_GET['id'])){
                $id = $_GET['id'];
                $sql = "select * from tbl_food where id ='$id'";

                $res = mysqli_query($conn, $sql);
                
                $count = mysqli_num_rows($res);
                if ($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $current_image = $row['image_name'] ;
                    $featured = $row['featured'];
                    $active = $row['active'];
                }else {
                    header('location:'.SITEURL.'admin/manage-food.php');
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
                            <input type="text" class="form-control" id="title" name="title" value="<?=$title?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="price" class="form-label me-5">Price</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="price" name="price" value="<?=$price?>">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="description" class="form-label me-5">Price</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="description" name="description" value="<?=$description?>">
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
                                        <img src="<?php echo SITEURL;?>/images/Food/<?=$current_image;?>" style="width: 60px; height:60px" name="image">
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
                            <input type="submit" value="Update Food" class="btn btn-success" name="submit">
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
            $price = $_POST['price'];
            $description = $_POST['description'];
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
                $image_name = "Food_Food_".rand(0000,9999).'.'.$extention;
                $source_path = $_FILES['image']['tmp_name'];    
                $destination_path = "../images/food/".$image_name;
                // $image_name
                //Finally we will upload the image
                $upload = move_uploaded_file($source_path, $destination_path);
                if ($upload == false){
                    $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                            Failed to Upload image
                                        </div>";
                    //Redirect page
                    header('location:'.SITEURL ."admin/manage-food.php");
                    die(); // Break
                }
                if ($current_image == ""){
                    $image_name = $image_name;
                }else{
                    $remove_path = "../images/food/$current_image";
                    $remove = unlink($remove_path);
                    //check the image is removed or not 
                    //If failed to remove then display message and stop the process
                    if ($remove == false){
                        $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                Failed to Remove the current image
                                            </div>";
                        header('location:'.SITEURL ."admin/manage-food.php"); exit;
                    }   
                }
            
            }else {
                $image_name = $current_image;
            }
            
            
            $sql_update = "UPDATE tbl_food SET 
                title = '$title', 
                price = '$price', 
                description = '$description', 
                image_name = '$image_name',
                featured = '$featured', 
                active = '$active'
                WHERE id = '$id'";
        
            $res_update = mysqli_query($conn, $sql_update);
            if ($res_update == true) {
                $_SESSION['operation'] ="<div class='alert alert-success alert-dismissible'>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                Food Updated Successfully
                                        </div>";
                header('location:'.SITEURL."admin/manage-food.php");exit;
            }else {
                $_SESSION['operation'] ="<div class='alert alert-danger alert-dismissible'>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                                Failed to Update Food
                                        </div>";
                                        
                header('location:'.SITEURL."admin/manage-food.php");exit;
            }
        }
    ?>
    <!-- main section ends -->
<?php include('partials/footer.php') ;
    ob_end_flush();
?>