<?php include('partials-front/menu.php');?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
                $sql = 'Select * from tbl_category WHERE active ="Yes" and featured ="Yes" LIMIT 3';
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
                            <a href="category-foods.php">
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
                    Category not Added
                    </div>";
                }     
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
                <?php 
                    $sql_food = 'Select * from tbl_food WHERE active ="Yes" and featured ="Yes"';
                    //Execute query
                    $res_food = mysqli_query($conn, $sql_food);
                    $count_food = mysqli_num_rows($res_food) ;//Function to get all the rows in db
                    //Checking 
                    if ($count_food >0 ){
                        while ($row = mysqli_fetch_assoc($res_food)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $description = $row['description'];
                            $price = $row['price'];
                            ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if ($image_name == ''){
                                        echo  "<div class='alert alert-danger alert-dismissible'>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                                        Image not Available
                                        </div>";
                                    }else {
                                        ?>
                                            <img src="<?=SITEURL?>images/food/<?=$image_name?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>    
                            </div>

                            <div class="food-menu-desc">
                                <h4><?=$title?></h4>
                                <p class="food-price">$<?=$price?></p>
                                <p class="food-detail"><?=$description?></p>
                                <br>
                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    <?php }}?>
            </div>
            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

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
