<?php include('partials/menu.php') ?>
<!-- main section starts -->
    <section class="main_section">
        <div class="container py-5">
            <h1 >Manage Food</h1 >
            <?php 
                if(isset($_SESSION['operation'])){
                    echo $_SESSION['operation'];
                    unset($_SESSION['operation']);
                }
            ?>
            <div class="my-3">
            <a href="add-food.php" class="btn btn-primary">Add Food</a>
            </div>
            <table class="table table-bordered p-0">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image name</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    //Query to get all categories
                    $sql = 'Select * from tbl_food';
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
                                $price = $rows['price'];
                                $image_name = $rows['image_name'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];
                            ?>
                            <tr class="">
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $title ?></td>
                                <td><?php echo $price.' '.'DH' ?></td>

                                <td>
                                    <?php 
                                        
                                        if ($image_name <> ""){
                                            ?>
                                            <img src="<?php echo SITEURL;?>/images/food/<?php echo $image_name;?>" class="myImg" style="width: 60px; height:60px">
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
                                    <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?=$id ?>" class="btn btn-success">Update Food</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?=$id ?>" class="btn btn-danger">Delete Food</a>
                                </td>
                            </tr>
                            <?php }}}
                ?>
            </table>
        </div>
     </section>
    <!-- main section ends -->
<?php include('partials/footer.php') ?>