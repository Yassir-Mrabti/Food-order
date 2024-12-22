<?php include('partials-front/menu.php');?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
                $sql = 'Select * from tbl_category WHERE active ="Yes"';
                //Execute query
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res) ;//Function to get all the rows in db
                //Checking 
                if ($count >0 ){
                    while ($rows = mysqli_fetch_assoc($res)){
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        ?>
                        <a href="category-foods.html">
                            <div class="box-3 float-container">
                                <?php
                                    if ($image_name == ''){
                                        echo  "<div class='alert alert-danger alert-dismissible'>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                        Image not Available
                                        </div>";
                                    }else {
                                        ?>
                                            <img src="<?=SITEURL?>images/category/<?=$image_name?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?> 
                                <h3 class="float-text text-white"><?=$title?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }else{
                    echo  "<div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    Category not Found
                    </div>";
                }     
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->
    <?php include('partials-front/footer.php');?>