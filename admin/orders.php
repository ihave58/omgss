<?php
require_once("header.php");
$chkpage = 13;
require_once("sidebar.php");


?>
    <style>
        th {
            text-align: center;
        }

        select {
            display: block !important;
        }

        th.st.sorting {
            min-width: 116px !important;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div class="header">
            <h4 class="page-header">
                <b><u><i>All Orders</i></u></b>
            </h4>
            <!-- <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Data</li>
        </ol>  -->

        </div>

        <div id="page-inner">

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="card">
                        <!--  <div class="card-action">
                              Advanced Tables
                         </div> -->

                        <div class="card-content">
                            <div class="table-responsive">

                                <?php
                                if ($countordersad > 0) {
                                    ?>
                                    <table class="table table-striped table-bordered table-hover"
                                           id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th scope="col">Sl.</th>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">User Email</th>
                                            <th scope="col">Orders Details</th>
                                            <th scope="col">Billing Details</th>
                                            <th scope="col">Payment Type</th>
                                            <th scope="col">Total</th>
                                            <th scope="col" class="st">Status</th>
                                            <th scope="col">Transaction ID</th>
                                            <th scope="col">Coupon Code</th>
                                            <th scope="col">Date Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $countsl = 0;
                                        while ($rowordersad = mysqli_fetch_assoc($resordersad)) {
                                            $countsl++;
                                            ?>
                                            <tr class="odd gradeX">
                                                <td scope="row"><?php echo $countsl; ?></td>
                                                <td>OMGORD<?php echo $rowordersad['id']; ?></td>
                                                <td><?php $uid = $rowordersad['userid'];

                                                    $sqluid = "SELECT * FROM `005_omgss_users` WHERE `id`='$uid'";
                                                    $resuid = mysqli_query($conn, $sqluid);
                                                    $rowuid = mysqli_fetch_assoc($resuid);

                                                    echo $rowuid['Name']; ?><br><?php echo $rowuid['eMail']; ?></td>
                                                <td><?php
                                                    $orddet = json_decode($rowordersad['orderdetails']);
                                                    foreach ($orddet as $itm) {
                                                        $orddetprdid = $itm->productid;
                                                        $orddetqnty = $itm->quantity;

                                                        $sqlorddetprdid = "SELECT * FROM `005_omgss_products` WHERE `id`='$orddetprdid'";
                                                        $resorddetprdid = mysqli_query($conn, $sqlorddetprdid);
                                                        $roworddetprdid = mysqli_fetch_assoc($resorddetprdid);

                                                        echo "Name: " . $roworddetprdid['name'] . " - " . "Qty: " . $orddetqnty . "<br><br>";
                                                    }
                                                    /*$countorddetprd=count($orddet);
                                                    for($i=1;$i<=$countorddetprd;$i++)
                                                    {
                                                      print_r($orddet[$i]) ;
                                                    }*/


                                                    ?></td>
                                                <td><?php echo $rowordersad['fullname']; ?>
                                                    <br><?php echo $rowordersad['email']; ?>
                                                    <br><?php echo $rowordersad['address']; ?>
                                                    <br><?php echo $rowordersad['city']; ?>
                                                    <br><?php echo $rowordersad['state']; ?>
                                                    <br><?php echo $rowordersad['zip']; ?></td>
                                                <td><?php if ($rowordersad['paymenttype'] == "cos") {
                                                        echo "Cash On Service";
                                                    } else {
                                                        echo "Prepaid";
                                                    } ?></td>
                                                <td><?php echo $rowordersad['totalordervalue']; ?></td>
                                                <td><!-- <?php echo $rowordersad['orderstate']; ?> -->


                                                    <form method="Post">
                                                        <select name="orderst"
                                                                id="orderst<?php echo $rowordersad['id']; ?>" required>
                                                            <option selected disabled>Select</option>
                                                            <option value="Received" <?php if ($rowordersad['orderstate'] == "Received") {
                                                                echo 'selected';
                                                            } ?>>Received
                                                            </option>
                                                            <option value="Processing" <?php if ($rowordersad['orderstate'] == "Processing") {
                                                                echo 'selected';
                                                            } ?>>Processing
                                                            </option>
                                                            <option value="Delivered" <?php if ($rowordersad['orderstate'] == "Delivered") {
                                                                echo 'selected';
                                                            } ?>>Delivered
                                                            </option>
                                                        </select>
                                                        <input type="text" name="ordid"
                                                               value="<?php echo $rowordersad['id']; ?>" hidden>
                                                        <input type="submit" name="changeordst"
                                                               id="changeordst<?php echo $rowordersad['id']; ?>" hidden>
                                                    </form>
                                                    <script>
                                                        $(document).ready(function () {
                                                            $("#orderst<?php echo $rowordersad['id']; ?>").change(function () {
                                                                $("#changeordst<?php echo $rowordersad['id']; ?>").click();
                                                            });
                                                        });
                                                    </script>
                                                </td>
                                                <td><?php echo $rowordersad['razorpayid']; ?></td>
                                                <td><?php $ccid = $rowordersad['couponcode'];

                                                    $sqlcc = "SELECT * FROM `005_omgss_coupons` WHERE `id`='$ccid'";
                                                    $rescc = mysqli_query($conn, $sqlcc);
                                                    $rowcc = mysqli_fetch_assoc($rescc);


                                                    echo $rowcc['couponcode']; ?></td>
                                                <td><?php echo $rowordersad['datetimeind']; ?></td>


                                            </tr>
                                            <?php
                                        }
                                        ?>


                                        </tbody>
                                    </table>

                                    <?php

                                } else {
                                    echo 'No record Exists !!!';
                                }

                                ?>

                            </div>

                        </div>

                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>

<?php
require_once("footer.php");
?>