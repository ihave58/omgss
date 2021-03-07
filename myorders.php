<?php
include('header.php');
if ($_SESSION["sessid"] == "") {
    echo '<script>window.location.href="index.php";</script>';
}
?>
    <style>
        section.ftco-section.bg-light {
            margin-left: 0px !important;
        }

        label {
            display: none !important;
        }

        .ftco-section {
            padding: inherit !important;
        }

        .w3-sidebar {
            /* height: 874% !important;*/
            height: auto !important;
        }

        @media (max-width: 640px) {
            .w3-sidebar {
                /*height: 800px !important;*/
            }

            .w3-sidebar.w3-collapse {
                display: none;
                z-index: 9;
                height: 956% !important;
            }
        }
    </style>
    <link rel="stylesheet" href="css/w3.css">

    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left"
         style="width:198px; background: #0071ff;    color: white !important;     padding-top: 35px;" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
        <?php
        include('sidebar.php');
        ?>
    </div>
<?php
include('datatables.php');
?>
    <div class="w3-main" style="margin-left:200px; "><!--  height: 500px !important; -->
        <div class="w3-teal" style="background-color: #f79f24!important;">
            <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h1 style="margin-left: 33px;color: white;">My Orders</h1>
            </div>
        </div>

        <div class="w3-container">


            <section class="ftco-section bg-light" style="">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="table-responsive" style="overflow-x: none !important;padding: 16px;">


                                <?php
                                if ($countordersofuser > 0) {
                                    ?>
                                    <table class="table table-striped  table-hover" id="dataTables-example">
                                        <thead style="color:black">
                                        <th>Sl.</th>
                                        <th>Order ID</th>
                                        <th>Order Details</th>
                                        <th>Order Type</th>
                                        <th>Address</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                        <th>Status</th>

                                        </thead>
                                        <tbody>

                                        <?php
                                        $counterbadd = 0;
                                        while ($rowordersofuser = mysqli_fetch_assoc($resordersofuser)) {
                                            $counterbadd++;
                                            $orddet = json_decode($rowordersofuser['orderdetails']);
                                            $coupondetails = json_decode($rowordersofuser['coupondetails']);
                                            ?>
                                            <tr style="color:white;background: <?php if ($rowordersofuser['orderstate'] == "Received") {
                                                echo '#0071ff';
                                            } else if ($rowordersofuser['orderstate'] == "Processing") {
                                                echo '#aeae00';
                                            } else if ($rowordersofuser['orderstate'] == "Delivered") {
                                                echo 'green';
                                            } else if ($rowordersofuser['orderstate'] == "Cancelled") {
                                                echo 'orange';
                                            } ?>">
                                                <td><?php echo $counterbadd; ?></td>
                                                <td><?php echo "OMGORD" . $rowordersofuser['id']; ?></td>
                                                <td>
                                                    <table class="table" style="background:transparent;">
                                                        <thead>
                                                        <th>Sl.</th>
                                                        <th>Product</th>
                                                        <th>Quantity</th>
                                                        <th>Total</th>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $sl = 0;
                                                        $producttotal = 0;
                                                        foreach ($orddet as $itm) {
                                                            $sl++;
                                                            $orddetprdid = $itm->productid;
                                                            $orddetqnty = $itm->quantity;
                                                            $saleprice = $itm->saleprice;
                                                            $sqlorddetprdid = "SELECT * FROM `005_omgss_products` WHERE `id`='$orddetprdid'";
                                                            $resorddetprdid = mysqli_query($conn, $sqlorddetprdid);
                                                            $roworddetprdid = mysqli_fetch_assoc($resorddetprdid);

                                                            ?>
                                                            <tr>
                                                                <td><?php echo $sl; ?></td>
                                                                <td><?php echo $roworddetprdid['name']; ?></td>
                                                                <td><?php echo $orddetqnty; ?>
                                                                    x <?php echo $saleprice; ?></td>
                                                                <td style="    width: 24%;">
                                                                    Rs. <?php echo $orddetqnty * $saleprice;
                                                                    $producttotal = $producttotal + $orddetqnty * $saleprice; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Sub-total:</td>
                                                            <td>Rs. <?php echo $producttotal; ?></td>
                                                        </tr>

                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Taxes(18%):</td>
                                                            <td>Rs. <?php echo $producttotal * (18 / 100); ?></td>
                                                        </tr>
                                                        <?php
                                                        if ($coupondetails != "") {
                                                            ?>
                                                            <tr>
                                                                <td></td>
                                                                <td><?php if (($coupondetails->coupontype) == 1) {
                                                                        echo ($coupondetails->couponamount) . "%, Code: " . ($coupondetails->couponcode);
                                                                    } else {
                                                                        echo "Rs. " . ($coupondetails->couponamount) . ", Code: " . ($coupondetails->couponcode);
                                                                    } ?></td>
                                                                <td>Discount:</td>
                                                                <td>Rs. <?php if (($coupondetails->coupontype) == 1) {
                                                                        echo($producttotal * ($coupondetails->couponamount) / 100);
                                                                    } else {
                                                                        echo($coupondetails->couponamount);
                                                                    } ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>

                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Total:</td>
                                                            <td>Rs. <?php if (($coupondetails->coupontype) == 1) {
                                                                    echo $producttotal + ($producttotal * (18 / 100)) - (($producttotal * ($coupondetails->couponamount) / 100));
                                                                } else {
                                                                    echo $producttotal - ($coupondetails->couponamount);
                                                                } ?></td>
                                                        </tr>


                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td><?php if ($rowordersofuser['paymenttype'] == 'cos') {
                                                        echo 'Cash on Service';
                                                    } else {
                                                        echo 'Prepaid';
                                                    }; ?></td>
                                                <td><?php echo $rowordersofuser['address']; ?><?php echo $rowordersofuser['city']; ?><?php echo $rowordersofuser['state']; ?><?php echo $rowordersofuser['zip']; ?></td>
                                                <td style="    width: 10%;">
                                                    Rs. <?php echo $rowordersofuser['totalordervalue']; ?></td>
                                                <td><?php echo $rowordersofuser['datetime']; ?></td>
                                                <td><?php echo $rowordersofuser['orderstate']; ?>
                                                    <?php
                                                    if (($rowordersofuser['orderstate'] == "Delivered") || ($rowordersofuser['orderstate'] == "Cancelled")) {

                                                    } else {
                                                        ?>
                                                        <a href="subfunctions/cancelorder.php?id=<?php echo $rowordersofuser['id']; ?>"
                                                           class="btn btn-danger" style="font-size: xx-small;"
                                                           onclick="return confirm('Are you sure you want to cancel this?');">Cancel</a>
                                                        <?php
                                                    }
                                                    ?>

                                                </td>


                                            </tr>
                                            <?php
                                        }
                                        ?>

                                        </tbody>
                                    </table>
                                    <?php
                                } else {
                                    echo '<p>No Orders Found</p>';
                                }
                                ?>


                            </div>
                            <div class="wrapper">

                                <div class="row no-gutters">

                                    <div class="col-md-7 d-flex">


                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


        </div>

    </div>

    <script>
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
        }
    </script>

<?php
include('footer.php');
?>