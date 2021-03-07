<?php
    include('header.php');
    $searchtext = runUserInputSanitizationHook($_POST['searchtext']);
    if ($searchtext) {
        $sqlsearch = "SELECT * FROM `005_omgss_subcategories` WHERE `subcatname` LIKE '%$searchtext%'";
        $ressearch = mysqli_query($conn, $sqlsearch);
        $countsearch = mysqli_num_rows($ressearch);


        $sqlsearchp = "SELECT * FROM `005_omgss_products` WHERE `name` LIKE '%$searchtext%' OR `description` LIKE '%$searchtext%'";
        $ressearchp = mysqli_query($conn, $sqlsearchp);
        $countsearchp = mysqli_num_rows($ressearchp);
    }

?>
    <style>
        .testimony-wrap .user-img {
            width: 309px !important;
            height: 240px !important;
        }

        .testimony-wrap {

            background: #a4a0e2 !important;

        }

        .text {
            height: 329px !important;
        }

        .col-md-4 {
            margin-top: 30px;
        }

        <
        style >

        @media (min-width: 992px) {
            .col-lg-3 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 25%;
                flex: 64 33 47% !important;
                max-width: 99% !important;
            }
        }

    </style>


<?php
    if ($countsearch > 0) {
        ?>
        <section class="ftco-section testimony-section bg-light">
            <div class="container">
                <div class="row justify-content-center pb-5 mb-3">
                    <div class="col-md-7 heading-section heading-section-white text-center ftco-animate">
                        <!-- <span class="subheading">Testimonies</span> -->
                        <h2 style="color: #f79f24;">Search Results (Categories)</h2>
                    </div>
                </div>
                <div class="row ftco-animate">


                    <?php
                        while ($rowsearch = mysqli_fetch_assoc($ressearch)) {
                            ?>

                            <div class="col-md-4">
                                <!--    <div class="carousel-testimony owl-carousel ftco-owl"> -->
                                <a href="products.php?scatid=<?php echo $rowsearch['id']; ?>">
                                    <div class="item" style="width: 100%;">
                                        <div class="testimony-wrap py-4">
                                            <!-- <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div> -->
                                            <div class="text">
                                                <div class="user-img"
                                                     style="background-image: url(admin/files/sub/<?php echo $rowsearch['subcatimage']; ?>)"></div>
                                                <div class="align-items-center">

                                                    <div class="pl-12">
                                                        <p class="name"
                                                           style="text-align: center"><?php echo $rowsearch['subcatname']; ?></p>
                                                        <!-- <span class="position">Marketing Manager</span> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </a>

                                <!-- </div> -->
                            </div>

                            <?php
                        }

                    ?>


                </div>
            </div>
        </section>
        <?php
    }

?>
<?php
    if ($countsearchp > 0) {
        ?>
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center pb-5 mb-3">
                    <div class="col-md-7 heading-section text-center ftco-animate">

                        <h2 style="color: #f79f24;">Search Results (Products)</h2>
                    </div>
                </div>
                <div class="row d-flex">


                    <?php
                        while ($rowsearchp = mysqli_fetch_assoc($ressearchp)) {
                            ?>
                            <div class="col-md-4 d-flex ftco-animate">
                                <div class="blog-entry align-self-stretch">
                                    <a href="viewproduct.php?prodid=<?php echo $rowsearchp['id']; ?>"
                                       class="block-20 rounded"
                                       style="background-image: url('admin/files/prod/<?php echo $rowsearchp['image']; ?>');">
                                    </a>
                                    <div class="text mt-3">
                                        <div class="posted mb-3 d-flex">

                                            <div class="desc pl-3">


                                                <span><?php echo $rowsearchp['name']; ?></span>
                                                <span style="color:blue">₹ <?php echo $rowsearchp['saleprice']; ?> - <del
                                                            style="color:black">₹ <?php echo $rowsearchp['actualprice']; ?></del></span>

                                                <span><?php echo number_format(((($rowsearchp['actualprice'] - $rowsearchp['saleprice']) / $rowsearchp['actualprice']) * 100), 2); ?>% discount</span>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-primary"
                                                id="addtocart<?php echo $rowsearchp['id']; ?>">Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                    ?>


                </div>
            </div>
        </section>
        <?php
    }

?>


<?php
    if (!($countsearch > 0) && !($countsearchp > 0)) {
        ?>
        <section class="ftco-section testimony-section bg-light">
            <div class="container">
                <div class="row justify-content-center pb-5 mb-3">
                    <div class="col-md-7 heading-section heading-section-white text-center ftco-animate">

                        <h2 style="color: #f79f24;">Search Results</h2>
                    </div>
                </div>
                <div class="row ftco-animate">


                    <p>No Items to Display</p>


                </div>
            </div>
        </section>
        <?php
    }

?>


<?php
    include('footer.php');
?>