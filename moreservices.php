<?php
    include('header.php');
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
    </style>


    <section class="ftco-section testimony-section bg-light">
        <div class="container">
            <div class="row justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section heading-section-white text-center ftco-animate">
                    <!-- <span class="subheading">Testimonies</span> -->
                    <h2 style="color: #f79f24;"><?php echo $rowcatname['name']; ?></h2>
                </div>
            </div>
            <div class="row ftco-animate">


                <?php
                    if ($countsubcats > 0) {
                        while ($rowsubcats = mysqli_fetch_assoc($ressubcats)) {
                            ?>

                            <div class="col-md-4">
                                <!--    <div class="carousel-testimony owl-carousel ftco-owl"> -->
                                <a href="products.php?scatid=<?php echo $rowsubcats['id']; ?>">
                                    <div class="item" style="width: 100%;">
                                        <div class="testimony-wrap py-4">
                                            <!-- <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div> -->
                                            <div class="text">
                                                <div class="user-img"
                                                     style="background-image: url(admin/files/sub/<?php echo $rowsubcats['subcatimage']; ?>)"></div>
                                                <div class="align-items-center">

                                                    <div class="pl-12">
                                                        <p class="name"
                                                           style="text-align: center"><?php echo $rowsubcats['subcatname']; ?></p>
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

                    } else {
                        ?>
                        <p>No Items to Display</p>
                        <?php
                    }
                ?>


            </div>
        </div>
    </section>


<?php
    include('footer.php');
?>