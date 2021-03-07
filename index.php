<?php
include('header.php');
?>
<style>
    .owl-stage-outer {
        height: 440px !important;
    }

    div[class="hero-wrap"] .owl-stage-outer {
        height: auto !important;
    }


    #owl-demo .item {

        padding: 0px 0px;
        margin-top: 10px;

        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        text-align: center;
    }

    .owl-carousel .owl-dots .owl-dot {

        background: blue !important;

    }

    .btn-primary {
        color: #fff !important;
        background-color: #007bff !important;
        border-color: #007bff !important;
    }


    @media (min-width: 992px) {
        .col-lg-3 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 25%;
            flex: 64 33 47% !important;
            max-width: 99% !important;
        }
    }


    #owl-demo1 .item1 {

        padding: 0px 0px;
        margin-top: 10px;

        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        text-align: center;
    }

    .owl-carousel .owl-dots .owl-dot {

        background: blue !important;

    }


    #owl-demo2 .item2 {

        padding: 0px 0px;
        margin-top: 10px;

        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        text-align: center;
    }

    .owl-carousel .owl-dots .owl-dot {

        background: blue !important;

    }


</style>


<div class="hero-wrap">
    <div class="home-slider owl-carousel">


        <?php
        if ($counthomeslider > 0) {
            $counter = 0;
            while ($rowhomeslider = mysqli_fetch_assoc($reshomeslider)) {
                $counter++;
                if ($counter == 1) {
                    $tg1 = $rowhomeslider['tagline1'];
                    $tg2 = $rowhomeslider['tagline2'];
                }
                ?>
                <div class="slider-item"
                     style="background-image:url(admin/files/extras/<?php echo $rowhomeslider['sliderimage']; ?>);">
                    <div class="overlay"></div>
                    <div class="container" style="margin-top: 220px !important;">
                        <div class="row no-gutters slider-text align-items-center justify-content-start">
                            <div class="col-md-6 ftco-animate">

                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>


    </div>
</div>

<section class="intro">

    <div class="containernew intro-wrap">
        <div class="col-md-12 col-lg-12 bg-intro d-sm-flex align-items-center align-items-stretch">
            <div class="intro-box d-flex align-items-center">
                <div class="icon d-flex align-items-center justify-content-center">
                    <i class="flaticon-repair"></i>
                </div>
                <h2 class="mb-0"><?php echo $tg1; ?> <span><?php echo $tg2; ?> </span></h2>
            </div>
            <a href="hire.php" class="bg-primary btn-custom d-flex align-items-center"><span>Book an Appointment</span></a>
        </div>
        <div class="row no-gutters">

        </div>
    </div>
</section>


<?php
$rowcat = mysqli_fetch_assoc($rescat);
$idcat = $rowcat['id'];

$sqlprd1 = "SELECT * FROM `005_omgss_products` WHERE `categoryid`='$idcat'";
$rescat1 = mysqli_query($conn, $sqlprd1);

?>


<section class="ftco-counter" id="section-counter">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">


                <h3 style="color: yellow;text-align: center"><?php echo $rowcat['name']; ?></h3>

            </div>
        </div>
</section>


<div id="owl-demo" class="owl-carousel owl-theme">

    <?php
    while ($rowcat1 = mysqli_fetch_assoc($rescat1)) {
        $checkcartid = $rowcat1['id'];
        if ($loggeduserid) {
            $sqlchkcrt = "SELECT * FROM `005_omgss_cart` WHERE `prdid`='$checkcartid' AND (`ip`='$ip' OR `userid`='$loggeduserid')";
        } else {
            $sqlchkcrt = "SELECT * FROM `005_omgss_cart` WHERE `ip`='$ip' AND `prdid`='$checkcartid'";
        }

        $reschkcrt = mysqli_query($conn, $sqlchkcrt);
        if (mysqli_num_rows($reschkcrt) > 0) {
            $cartbtntxt = "Added";
        } else {
            $cartbtntxt = "Add to Cart";
        }

        $checkwishid = $rowcat1['id'];
        if ($loggeduserid) {
            $sqlchkwish = "SELECT * FROM `005_omgss_wishlist` WHERE `prdid`='$checkwishid' AND (`ip`='$ip' OR `userid`='$loggeduserid')";
        } else {
            $sqlchkwish = "SELECT * FROM `005_omgss_wishlist` WHERE `ip`='$ip' AND `prdid`='$checkwishid'";
        }

        $reschkwish = mysqli_query($conn, $sqlchkwish);
        if (mysqli_num_rows($reschkwish) > 0) {
            $wishbtntxt = "Added";
        } else {
            $wishbtntxt = "Add to Cart";
        }
        ?>
        <div class="item">
            <div class="col-md-12 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch" style="width: inherit;">
                    <a href="viewproduct.php?prodid=<?php echo $rowcat1['id']; ?>" class="block-20 rounded"
                       style="background-image: url('admin/files/prod/<?php echo $rowcat1['image']; ?>');">
                    </a>
                    <div class="text mt-3">
                        <div class="posted mb-3 d-flex">
                            <!-- <div class="img author" style="background-image: url(images/person_2.jpg);"></div> -->
                            <div class="desc pl-3">
                                <span><?php echo $rowcat1['name']; ?></span>
                                <span style="color:blue">₹ <?php echo $rowcat1['saleprice']; ?> - <del
                                            style="color:black">₹ <?php echo $rowcat1['actualprice']; ?></del> per <?php echo $rowcat1['units']; ?></span>

                                <span style="color:red"><?php echo number_format(((($rowcat1['actualprice'] - $rowcat1['saleprice']) / $rowcat1['actualprice']) * 100), 2); ?>% discount</span>
                            </div>
                        </div>
                        <!-- <h3 class="heading"><a href="#">Best wheel alignment &amp; air conditioning</a></h3> -->
                        <a type="button" class="btn btn-<?php if ($wishbtntxt == "Added") {
                            echo 'success';
                        } else {
                            echo 'danger';
                        }; ?>" id="addtowishlist<?php echo $rowcat1['id']; ?>"><i class="fa fa-heart" aria-hidden="true"
                                                                                  style="color:white"></i></a>
                        <button type="button" class="btn btn-<?php if ($cartbtntxt == "Added") {
                            echo 'success';
                        } else {
                            echo 'primary';
                        }; ?>" id="addtocart<?php echo $rowcat1['id']; ?>"><?php echo $cartbtntxt; ?></button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>


</div>


<script>
    $(document).ready(function () {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 3,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                    dots: false
                },
                600: {
                    items: 1,
                    nav: false,
                    dots: false
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: false
                }
            }
        });

        $("#owl-demo").owlCarousel({
            navigation: true
        });

        owl.trigger('owl.play', 1000); //owl.play event accept autoPlay speed as second parameter


    });
</script>


<?php
$rowcat = mysqli_fetch_assoc($rescat);
$idcat1 = $rowcat['id'];

$sqlprd2 = "SELECT * FROM `005_omgss_products` WHERE `categoryid`='$idcat1'";
$rescat2 = mysqli_query($conn, $sqlprd2);
?>
<section class="ftco-counter" id="section-counter">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">


                <h3 style="color: yellow;text-align: center"><?php echo $rowcat['name']; ?></h3>

            </div>
        </div>
</section>


<div id="owl-demo1" class="owl-carousel owl-theme">

    <?php
    while ($rowcat2 = mysqli_fetch_assoc($rescat2)) {
        $checkcartid = $rowcat2['id'];
        if ($loggeduserid) {
            $sqlchkcrt = "SELECT * FROM `005_omgss_cart` WHERE `prdid`='$checkcartid' AND (`ip`='$ip' OR `userid`='$loggeduserid')";
        } else {
            $sqlchkcrt = "SELECT * FROM `005_omgss_cart` WHERE `ip`='$ip' AND `prdid`='$checkcartid'";
        }

        $reschkcrt = mysqli_query($conn, $sqlchkcrt);
        if (mysqli_num_rows($reschkcrt) > 0) {
            $cartbtntxt = "Added";
        } else {
            $cartbtntxt = "Add to Cart";
        }
        $checkwishid = $rowcat2['id'];
        if ($loggeduserid) {
            $sqlchkwish = "SELECT * FROM `005_omgss_wishlist` WHERE `prdid`='$checkwishid' AND (`ip`='$ip' OR `userid`='$loggeduserid')";
        } else {
            $sqlchkwish = "SELECT * FROM `005_omgss_wishlist` WHERE `ip`='$ip' AND `prdid`='$checkwishid'";
        }

        $reschkwish = mysqli_query($conn, $sqlchkwish);
        if (mysqli_num_rows($reschkwish) > 0) {
            $wishbtntxt = "Added";
        } else {
            $wishbtntxt = "Add to Cart";
        }
        ?>
        <div class="item1">
            <div class="col-md-12 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch" style="width: inherit;">
                    <a href="viewproduct.php?prodid=<?php echo $rowcat2['id']; ?>" class="block-20 rounded"
                       style="background-image: url('admin/files/prod/<?php echo $rowcat2['image']; ?>');">
                    </a>
                    <div class="text mt-3">
                        <div class="posted mb-3 d-flex">
                            <!-- <div class="img author" style="background-image: url(images/person_2.jpg);"></div> -->
                            <div class="desc pl-3">
                                <!-- <span><?php echo $rowcat2['name']; ?></span>
                    <span>₹ <?php echo $rowcat2['saleprice']; ?> - ₹ <?php echo $rowcat2['actualprice']; ?></span> -->

                                <span><?php echo $rowcat2['name']; ?></span>
                                <span style="color:blue">₹ <?php echo $rowcat2['saleprice']; ?> - <del
                                            style="color:black">₹ <?php echo $rowcat2['actualprice']; ?></del> per <?php echo $rowcat1['units']; ?></span>

                                <span style="color:red"><?php echo number_format(((($rowcat2['actualprice'] - $rowcat2['saleprice']) / $rowcat2['actualprice']) * 100), 2); ?>% discount</span>
                            </div>
                        </div>
                        <!-- <h3 class="heading"><a href="#">Best wheel alignment &amp; air conditioning</a></h3> -->
                        <a type="button" class="btn btn-<?php if ($wishbtntxt == "Added") {
                            echo 'success';
                        } else {
                            echo 'danger';
                        }; ?>" id="addtowishlist<?php echo $rowcat2['id']; ?>"><i class="fa fa-heart" aria-hidden="true"
                                                                                  style="color:white"></i></a>
                        <a href="javascript:void(0)" class="btn btn-<?php if ($cartbtntxt == "Added") {
                            echo 'success';
                        } else {
                            echo 'primary';
                        }; ?>" id="addtocart<?php echo $rowcat2['id']; ?>"><?php echo $cartbtntxt; ?></a>
                    </div>
                </div>
            </div>
        </div>


        <?php
    }
    ?>


</div>


<script>
    $(document).ready(function () {

        $("#owl-demo1").owlCarousel({
            navigation: true
        });

    });
</script>


<?php
$rowcat = mysqli_fetch_assoc($rescat);
$idcat2 = $rowcat['id'];

$sqlprd3 = "SELECT * FROM `005_omgss_products` WHERE `categoryid`='$idcat2'";
$rescat3 = mysqli_query($conn, $sqlprd3);
?>


<section class="ftco-counter" id="section-counter">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">


                <h3 style="color: yellow;text-align: center"><?php echo $rowcat['name']; ?></h3>

            </div>
        </div>
</section>


<div id="owl-demo2" class="owl-carousel owl-theme">

    <?php
    while ($rowcat3 = mysqli_fetch_assoc($rescat3)) {
        $checkcartid = $rowcat3['id'];
        if ($loggeduserid) {
            $sqlchkcrt = "SELECT * FROM `005_omgss_cart` WHERE `prdid`='$checkcartid' AND (`ip`='$ip' OR `userid`='$loggeduserid')";
        } else {
            $sqlchkcrt = "SELECT * FROM `005_omgss_cart` WHERE `ip`='$ip' AND `prdid`='$checkcartid'";
        }

        $reschkcrt = mysqli_query($conn, $sqlchkcrt);
        if (mysqli_num_rows($reschkcrt) > 0) {
            $cartbtntxt = "Added";
        } else {
            $cartbtntxt = "Add to Cart";
        }
        $checkwishid = $rowcat3['id'];
        if ($loggeduserid) {
            $sqlchkwish = "SELECT * FROM `005_omgss_wishlist` WHERE `prdid`='$checkwishid' AND (`ip`='$ip' OR `userid`='$loggeduserid')";
        } else {
            $sqlchkwish = "SELECT * FROM `005_omgss_wishlist` WHERE `ip`='$ip' AND `prdid`='$checkwishid'";
        }

        $reschkwish = mysqli_query($conn, $sqlchkwish);
        if (mysqli_num_rows($reschkwish) > 0) {
            $wishbtntxt = "Added";
        } else {
            $wishbtntxt = "Add to Cart";
        }
        ?>
        <div class="item2">
            <div class="col-md-12 d-flex ftco-animate">
                <div class="blog-entry align-self-stretch" style="width: inherit;">
                    <a href="viewproduct.php?prodid=<?php echo $rowcat3['id']; ?>" class="block-20 rounded"
                       style="background-image: url('admin/files/prod/<?php echo $rowcat3['image']; ?>');">
                    </a>
                    <div class="text mt-3">
                        <div class="posted mb-3 d-flex">
                            <!-- <div class="img author" style="background-image: url(images/person_2.jpg);"></div> -->
                            <div class="desc pl-3">
                                <!--  <span><?php echo $rowcat3['name']; ?></span>
                    <span>₹ <?php echo $rowcat3['saleprice']; ?> - ₹ <?php echo $rowcat3['actualprice']; ?></span> -->


                                <span><?php echo $rowcat3['name']; ?></span>
                                <span style="color:blue">₹ <?php echo $rowcat3['saleprice']; ?> - <del
                                            style="color:black">₹ <?php echo $rowcat3['actualprice']; ?></del> per <?php echo $rowcat1['units']; ?></span>

                                <span style="color:red"><?php echo number_format(((($rowcat3['actualprice'] - $rowcat3['saleprice']) / $rowcat3['actualprice']) * 100), 2); ?>% discount</span>
                            </div>
                        </div>
                        <!-- <h3 class="heading"><a href="#">Best wheel alignment &amp; air conditioning</a></h3> -->
                        <a type="button" class="btn btn-<?php if ($wishbtntxt == "Added") {
                            echo 'success';
                        } else {
                            echo 'danger';
                        }; ?>" id="addtowishlist<?php echo $rowcat3['id']; ?>"><i class="fa fa-heart" aria-hidden="true"
                                                                                  style="color:white"></i></a>
                        <button type="button" class="btn btn-<?php if ($cartbtntxt == "Added") {
                            echo 'success';
                        } else {
                            echo 'primary';
                        }; ?>" id="addtocart<?php echo $rowcat3['id']; ?>"><?php echo $cartbtntxt; ?></button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>


</div>


<script>
    $(document).ready(function () {

        $("#owl-demo2").owlCarousel({
            navigation: true
        });

    });
</script>


<?php

while ($rowallprd = mysqli_fetch_assoc($resallprd)) {
    ?>
    <script>
        $(document).ready(function () {


            $("#addtocart<?php echo $rowallprd['id'];?>").click(function () {
                /*alert();*/
                var ip = "<?php echo $ip;?>";
                var userid = "<?php echo $_SESSION["sessid"];?>";
                var prdid = "<?php echo $rowallprd['id'];?>";
                $.ajax({
                    type: "POST",
                    url: "subfunctions/addtocart.php",
                    data: {userid: userid, ip: ip, prdid: prdid, action: 'alertqueryd'},
                    success: function (result) {
                        $('#addtocart<?php echo $rowallprd['id'];?>').html(result);
                        $('#addtocart<?php echo $rowallprd['id'];?>').attr('class', 'btn btn-success');


                    }
                });


            });

            $("#addtowishlist<?php echo $rowallprd['id'];?>").click(function () {
                /*alert();*/
                var ip = "<?php echo $ip;?>";
                var userid = "<?php echo $_SESSION["sessid"];?>";
                var prdid = "<?php echo $rowallprd['id'];?>";
                $.ajax({
                    type: "POST",
                    url: "subfunctions/addtowishlist.php",
                    data: {userid: userid, ip: ip, prdid: prdid, action: 'alertqueryd'},
                    success: function (result) {
                        $('#addtowishlist<?php echo $rowallprd['id'];?>').attr('class', 'btn btn-success');


                    }
                });


            });
        });
    </script>

    <?php
}
?>
<?php
include('footer.php');
?>
