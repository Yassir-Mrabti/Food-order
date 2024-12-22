<?php include('partials/menu.php') ?>
    <!-- main section starts -->
     <section>
        <div class="container py-5">
            <h3>DASHBOARD</h3>
            <?php 
                if(isset($_SESSION['operation'])){
                    echo $_SESSION['operation'];
                    unset($_SESSION['operation']);
                }   
            ?>
            <div class="row mt-3">
                <div class="d-flex justify-content-between gap-3">
                    <div class="col-sm-3 bg-light p-5 text-center">
                        <strong>5</strong>
                        <p class="m-0">Categories</p>
                    </div>
                    <div class="col-sm-3 bg-light p-5 text-center">
                        <strong>5</strong>
                        <p class="m-0">Categories</p>
                    </div>
                    <div class="col-sm-3 bg-light p-5 text-center">
                        <strong>5</strong>
                        <p class="m-0">Categories</p>
                    </div>
                    <div class="col-sm-3 bg-light p-5 text-center">
                        <strong>5</strong>
                        <p class="m-0">Categories</p>
                    </div>
                </div>
            </div>
        </div>
     </section>
    <!-- main section ends -->
    <?php include('partials/footer.php') ?> 
   