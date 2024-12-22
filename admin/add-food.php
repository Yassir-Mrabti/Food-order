<?php 
include('partials/menu.php'); 
// Start the output buffer
ob_start(); 
?>
<section>
    <div class="container px-5 pt-3 ">
        <h1 class="mb-3">Add Food</h1>
        <form action="add-food.php" method="post" enctype="multipart/form-data">
                <div class="myContainer">
                <table class="table">
                        <tr>
                            <td>
                                <label for="title" class="form-label me-5">Title</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title of the Food">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="desc" class="form-label">Description</label>
                            </td>
                            <td>
                                <textarea class="form-control" id="desc" name="desc" rows="5" placeholder="Description of The Food"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="price" class="form-label me-5">Price</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="price" name="price">
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
                                <label for="category" class="form-label me-5">Category</label>
                            </td>
                            <td>
                                <select name="category" class="form-select">
                                <?php 
                                    $sql= "Select * From tbl_category where active='Yes'";
                                    $res = mysqli_query($conn, $sql);
                                    $count = mysqli_num_rows($res);
                                    if ($count > 0){
                                    while ($rows = mysqli_fetch_assoc($res)){
                                    $id = $rows['id'];
                                    $title = $rows['title'];
                                    ?>
                                        <option value="<?=$id?>" name="category"><?=$title;?></option> 
                                    <?php
                                    }}else {
                                    ?>
                                        <option value="0">No Category available</option> 
                                    <?php }?>
                                </select>
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
                                <input type="submit" value="Add Food" class="btn btn-success" name="submit">
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $title = $_POST['title'];
                    $desc = $_POST['desc'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    if (isset($_FILES['image'])){
                        $image_name = $_FILES['image']['name'];
                        if ($image_name <> ""){
                            $tmp=explode('.',$image_name);
                            $ext = end($tmp);
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
                    } else {
                        $image_name = ""; // default value (blank)
                    }

                    $sql_insert = "Insert into tbl_food set
                            title = '$title',
                            description = '$desc',
                            image_name = '$image_name',
                            price = '$price',
                            category_id = '$category',
                            featured = '$featured',
                            active = '$active'";
                    $res_insert = mysqli_query($conn, $sql_insert);

                    if ($res_insert == true) {
                        $_SESSION['operation'] = "<div class='alert alert-success alert-dismissible'>
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        Food Added Successfully
                        </div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        exit;
                    }else {
                        $_SESSION['operation'] = "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        Failed to Add Food
                        </div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                }
            ?>
    </div>
</section>

<?php 
include('partials/footer.php'); 
ob_end_flush(); // Flush the output buffer and turn off output buffering
?>
