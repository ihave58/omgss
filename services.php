<?php
    include('header.php');
?>
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');"
             data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i
                                        class="fa fa-chevron-right"></i></a></span> <span>Services <i
                                    class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Services</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">We offer Services</span>
                    <h2>Our services</h2>
                </div>
            </div>
            <div class="row">
                <?php
                    $rowcat = mysqli_fetch_assoc($rescat);
                ?>

                <div class="col-md-4 services ftco-animate">

                    <div class="d-block d-flex">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-car-service"></span>
                        </div>
                        <div class="media-body pl-3">
                            <h3 class="heading"><?php echo $rowcat['name']; ?></h3>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                                unorthographic.</p>
                            <p><a href="moreservices.php?catid=<?php echo $rowcat['id']; ?>" class="btn-custom">Read
                                    more</a></p>
                        </div>
                    </div>

                    <?php
                        $rowcat = mysqli_fetch_assoc($rescat);
                    ?>
                    <div class="d-block d-flex">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-tyre"></span>
                        </div>
                        <div class="media-body pl-3">
                            <h3 class="heading"><?php echo $rowcat['name']; ?></h3>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                                unorthographic.</p>
                            <p><a href="moreservices.php?catid=<?php echo $rowcat['id']; ?>" class="btn-custom">Read
                                    more</a></p>
                        </div>
                    </div>

                </div>
                <?php
                    $rowcat = mysqli_fetch_assoc($rescat);
                ?>
                <div class="col-md-4 services ftco-animate">
                    <div class="d-block d-flex">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-battery"></span>
                        </div>
                        <div class="media-body pl-3">
                            <h3 class="heading"><?php echo $rowcat['name']; ?></h3>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                                unorthographic.</p>
                            <p><a href="moreservices.php?catid=<?php echo $rowcat['id']; ?>" class="btn-custom">Read
                                    more</a></p>
                        </div>
                    </div>
                    <?php
                        $rowcat = mysqli_fetch_assoc($rescat);
                    ?>
                    <div class="d-block d-flex">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-car-engine"></span>
                        </div>
                        <div class="media-body pl-3">
                            <h3 class="heading"><?php echo $rowcat['name']; ?></h3>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                                unorthographic.</p>
                            <p><a href="moreservices.php?catid=<?php echo $rowcat['id']; ?>" class="btn-custom">Read
                                    more</a></p>
                        </div>
                    </div>
                </div>
                <?php
                    $rowcat = mysqli_fetch_assoc($rescat);
                ?>
                <div class="col-md-4 services ftco-animate">
                    <div class="d-block d-flex">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-tow-truck"></span>
                        </div>
                        <div class="media-body pl-3">
                            <h3 class="heading"><?php echo $rowcat['name']; ?></h3>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                                unorthographic.</p>
                            <p><a href="moreservices.php?catid=<?php echo $rowcat['id']; ?>" class="btn-custom">Read
                                    more</a></p>
                        </div>
                    </div>
                    <?php
                        $rowcat = mysqli_fetch_assoc($rescat);
                    ?>
                    <div class="d-block d-flex">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-repair"></span>
                        </div>
                        <div class="media-body pl-3">
                            <h3 class="heading"><?php echo $rowcat['name']; ?></h3>
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                                unorthographic.</p>
                            <p><a href="moreservices.php?catid=<?php echo $rowcat['id']; ?>" class="btn-custom">Read
                                    more</a></p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mt-4 mt-md-5 justify-content-between">
                <div class="col-md-7 ftco-animate">
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It
                        is a paradisematic country, in which roasted parts of sentences fly into your mouth. Far far
                        away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
                        blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large
                        language ocean.</p>
                </div>
                <div class="col-md-4 ftco-animate">
                    <h5 class="font-weight-bold">Our Advantages</h5>
                    <ul class="services-2">
                        <li><span class="fa fa-check"></span>Free Diagnostics &amp; Brake Check</li>
                        <li><span class="fa fa-check"></span>Certified Repair Service</li>
                        <li><span class="fa fa-check"></span>Repair Estimates</li>
                        <li><span class="fa fa-check"></span>Auto Repair Shops Serving Customer</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

<?php
    include('footer.php');
?>