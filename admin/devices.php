<?php
    require_once("header.php");
    $chkpage = 16;
    require_once("sidebar.php");


?>
    <style>
        th {
            text-align: center;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div class="header">
            <h4 class="page-header">
                <b><u><i>All Devices</i></u></b>
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
                                    if ($countshowalldevicesinadmin > 0) {
                                        ?>
                                        <table class="table table-striped table-bordered table-hover"
                                               id="dataTables-example">
                                            <thead>
                                            <tr>
                                                <th scope="col">Sl.</th>
                                                <th scope="col">User Email</th>
                                                <th scope="col">Device</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Order ID</th>
                                                <th scope="col">Date Start</th>
                                                <th scope="col">Date Expire</th>
                                                <th scope="col">Days Left</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                $countsl = 0;
                                                while ($rowshowalldevicesinadmin = mysqli_fetch_assoc($resshowalldevicesinadmin)) {
                                                    $countsl++;
                                                    $gtprdid = $rowshowalldevicesinadmin['productid'];
                                                    $sqlprp = "SELECT * FROM `005_omgss_products` WHERE `id`='$gtprdid'";
                                                    $resprp = mysqli_query($conn, $sqlprp);
                                                    $rowprp = mysqli_fetch_assoc($resprp);

                                                    $useridgetemailofuser = $rowshowalldevicesinadmin['userid'];
                                                    $sqlgetemailofuser = "SELECT * FROM `005_omgss_users` WHERE `id`='$useridgetemailofuser'";
                                                    $resgetemailofuser = mysqli_query($conn, $sqlgetemailofuser);
                                                    $rowgetemailofuser = mysqli_fetch_assoc($resgetemailofuser);


                                                    $date1 = date("Y/m/d");
                                                    $date2 = date('Y-m-d H:i:s', strtotime($rowshowalldevicesinadmin['datetime'] . ' + 365 days'));
                                                    $diff = strtotime($date2) - strtotime($date1);
                                                    $dateDiff = abs(round($diff / 86400));
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td scope="row"><?php echo $countsl; ?></td>
                                                        <td scope="row"><?php echo $rowgetemailofuser['eMail']; ?></td>
                                                        <td scope="row"><?php echo $rowprp['name']; ?></td>
                                                        <td scope="row"><?php echo $rowshowalldevicesinadmin['quantity']; ?></td>
                                                        <td scope="row"><?php echo "OMGORD" . $rowshowalldevicesinadmin['orderid']; ?></td>
                                                        <td scope="row"><?php echo $rowshowalldevicesinadmin['datetime']; ?></td>
                                                        <td scope="row"><?php echo date('Y-m-d H:i:s', strtotime($rowshowalldevicesinadmin['datetime'] . ' + 365 days')); ?></td>
                                                        <td><?php if ($diff <= 0) {
                                                                echo "<span style='color:red'>Expired</span>";
                                                            } else {
                                                                echo $dateDiff;
                                                            } ?></td>
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