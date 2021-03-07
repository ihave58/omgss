<?php
    include('header.php');
?>

<?php
    $rowcat = mysqli_fetch_assoc($rescat);
    $idcat = $rowcat['id'];

    $sqlprd1 = "SELECT * FROM `005_omgss_products` WHERE `categoryid`='$idcat'";
    $rescat1 = mysqli_query($conn, $sqlprd1);

?>
    <style>
        @media (min-width: 992px) {
            .col-lg-3 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 25%;
                flex: 64 33 47% !important;
                max-width: 99% !important;
            }
        }


        #owl-demo .item {

            padding: 30px 0px;
            margin: 10px;

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

        @media only screen and (max-width: 768px) {

            .block-20 {
                overflow: hidden;

                width: 334px !important;
            }

        }

        @media only screen and (min-width: 411px) and (max-width: 731px) {
            .block-20 {
                overflow: hidden;

                width: 387px !important;
            }
        }

    </style>


    <section class="ftco-counter" id="section-counter">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">


                    <h3 style="color: yellow;text-align: center"><?php echo $rowsubcatsm['subcatname']; ?></h3>

                </div>
            </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <section class="ftco-section">
        <div class="container">

            <div class="row d-flex">


                <?php
                    if ($countsubcatsmprod > 0) {
                        while ($rowsubcatsmprod = mysqli_fetch_assoc($ressubcatsmprod)) {
                            $crtchkproductid = $rowsubcatsmprod['id'];
                            if ($_SESSION["sessid"] == "") {

                                $sqlcrtchk = "SELECT * FROM `005_omgss_cart` WHERE `prdid`='$crtchkproductid' AND `ip`='$ip'";
                                $sqlwishchk = "SELECT * FROM `005_omgss_wishlist` WHERE `prdid`='$crtchkproductid' AND `ip`='$ip'";
                            } else {
                                $useridcartchk = $_SESSION["sessid"];
                                $sqlcrtchk = "SELECT * FROM `005_omgss_cart` WHERE `prdid`='$crtchkproductid' AND (`userid`='$useridcartchk' OR `ip`='$ip')";
                                $sqlwishchk = "SELECT * FROM `005_omgss_wishlist` WHERE `prdid`='$crtchkproductid' AND (`userid`='$useridcartchk' OR `ip`='$ip')";
                            }
                            $rescrtchk = mysqli_query($conn, $sqlcrtchk);
                            $countcrtchk = mysqli_num_rows($rescrtchk);

                            $reswishchk = mysqli_query($conn, $sqlwishchk);
                            $countwishchk = mysqli_num_rows($reswishchk);

                            ?>
                            <div class="col-md-4 d-flex ftco-animate">
                                <div class="blog-entry align-self-stretch">
                                    <a href="viewproduct.php?prodid=<?php echo $rowsubcatsmprod['id']; ?>"
                                       class="block-20 rounded"
                                       style="background-image: url('admin/files/prod/<?php echo $rowsubcatsmprod['image']; ?>');">
                                    </a>
                                    <div class="text mt-3">
                                        <div class="posted mb-3 d-flex">

                                            <div class="desc pl-3">


                                                <span><?php echo $rowsubcatsmprod['name']; ?></span>
                                                <span style="color:blue">₹ <?php echo $rowsubcatsmprod['saleprice']; ?> - <del
                                                            style="color:black">₹ <?php echo $rowsubcatsmprod['actualprice']; ?></del></span>

                                                <span><?php echo number_format(((($rowsubcatsmprod['actualprice'] - $rowsubcatsmprod['saleprice']) / $rowsubcatsmprod['actualprice']) * 100), 2); ?>% discount</span>
                                            </div>
                                        </div>

                                        <a type="button" class="btn btn-<?php if ($countwishchk > 0) {
                                            echo 'success';
                                        } else {
                                            echo 'danger';
                                        }; ?>" id="addtowishlist<?php echo $rowsubcatsmprod['id']; ?>"><i
                                                    class="fa fa-heart" aria-hidden="true" style="color:white"></i></a>
                                        <button type="button" class="btn btn-<?php if ($countcrtchk > 0) {
                                            echo 'success';
                                        } else {
                                            echo 'primary';
                                        }; ?>"
                                                id="addtocart<?php echo $rowsubcatsmprod['id']; ?>"><?php if ($countcrtchk > 0) {
                                                echo 'Added';
                                            } else {
                                                echo 'Add to Cart';
                                            } ?></button>
                                    </div>
                                </div>
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

    while ($rowallprd = mysqli_fetch_assoc($resallprd)) {
        ?>
        <script>
            $(document).ready(function () {


                $("#addtocart<?php echo $rowallprd['id'];?>").click(function () {
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