<?php include('partials/menu.php') ?>
<!-- main section starts -->
    <section >
        <div class="container py-5">
            <h1>Manage Category</h1>

            <?php 
                if(isset($_SESSION['operation'])){
                    echo $_SESSION['operation'];
                    unset($_SESSION['operation']);
                }   
            ?>
            <div class="my-3">
            <a href="add-category.php" class="btn btn-primary">Add Category</a>
            </div>
            
            <table class="table table-bordered p-0">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image Name</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    //Query to get all categories
                    $sql = 'Select * from tbl_category';
                    //Execute query
                    $res = mysqli_query($conn, $sql);
                    //Checking 

                    $sn = 1;
                    if ($res == true){
                        $count = mysqli_num_rows($res) ;//Function to get all the rows in db
                        if ($count >0 ){
                            while ($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $image_name = $rows['image_name'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];
                            ?>
                            <tr class="">
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $title ?></td>

                                <td>
                                    <?php 
                                        
                                        if ($image_name <> ""){
                                            ?>
                                            <img src="<?php echo SITEURL;?>/images/category/<?php echo $image_name;?>" class="myImg" style="width: 60px; height:60px">
                                            <?php
                                        }else{
                                            echo "<div class='text-danger'>
                                                    Image not Added
                                                </div>";
                                        }
                                    ?>
                                </td>

                                <td><?php echo $featured ?></td>
                                <td><?php echo $active ?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id ?>" class="btn btn-success">Update Category</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id ?>" class="btn btn-danger">Delete Category</a>
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