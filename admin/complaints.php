<?php
    require_once("header.php");
    $chkpage = 17;
    require_once("sidebar.php");
    mysqli_query($conn, "UPDATE `005_omgss_complaints` SET `countnotify`='Yes' WHERE `countnotify`='No'");

?>
    <style>
        th {
            text-align: center;
        }

        select {
            display: block !important;
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
                                    if ($countshowallcomplaintsinadmin > 0) {
                                        ?>
                                        <table class="table table-striped table-bordered table-hover"
                                               id="dataTables-example">
                                            <thead>
                                            <tr>
                                                <th scope="col">Sl.</th>
                                                <th scope="col">User Email</th>
                                                <th scope="col">Device</th>
                                                <th scope="col">Complaint</th>
                                                <th scope="col">Status</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                $countsl = 0;
                                                while ($rowshowallcomplaintsinadmin = mysqli_fetch_assoc($resshowallcomplaintsinadmin)) {
                                                    $countsl++;
                                                    $devid = $rowshowallcomplaintsinadmin['deviceid'];

                                                    $sqldev = "SELECT * FROM `003_omgss_devices` WHERE `id`='$devid'";
                                                    $resdev = mysqli_query($conn, $sqldev);
                                                    $rowdev = mysqli_fetch_assoc($resdev);
                                                    $odridincm = $rowdev['orderid'];

                                                    $sqlodrdelcm = "SELECT * FROM `005_omgss_orders` WHERE `id`='$odridincm'";
                                                    $resodrdelcm = mysqli_query($conn, $sqlodrdelcm);
                                                    $rowodrdelcm = mysqli_fetch_assoc($resodrdelcm);


                                                    $gtprdid = $rowdev['productid'];
                                                    $sqlprp = "SELECT * FROM `005_omgss_products` WHERE `id`='$gtprdid'";
                                                    $resprp = mysqli_query($conn, $sqlprp);
                                                    $rowprp = mysqli_fetch_assoc($resprp);

                                                    $useridgetemailofuser = $rowshowallcomplaintsinadmin['userid'];
                                                    $sqlgetemailofuser = "SELECT * FROM `005_omgss_users` WHERE `id`='$useridgetemailofuser'";
                                                    $resgetemailofuser = mysqli_query($conn, $sqlgetemailofuser);
                                                    $rowgetemailofuser = mysqli_fetch_assoc($resgetemailofuser);
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td scope="row"><?php echo $countsl; ?></td>
                                                        <td scope="row"><?php echo $rowgetemailofuser['eMail']; ?>
                                                            <br><?php echo $rowodrdelcm['fullname']; ?>
                                                            <br><?php echo $rowodrdelcm['address']; ?>
                                                            <br><?php echo $rowodrdelcm['city']; ?>
                                                            <br><?php echo $rowodrdelcm['state']; ?>
                                                            <br><?php echo $rowodrdelcm['zip']; ?></td>
                                                        <td scope="row"><?php echo $rowprp['name']; ?></td>
                                                        <td scope="row"><?php echo $rowshowallcomplaintsinadmin['complaint']; ?></td>
                                                        <td scope="row">
                                                            <form method="post">
                                                                <select required
                                                                        id="statuscom<?php echo $rowshowallcomplaintsinadmin['id']; ?>"
                                                                        name="statuscom">
                                                                    <option value="">Select</option>
                                                                    <option value="Processing" <?php if ($rowshowallcomplaintsinadmin['status'] == "Processing") {
                                                                        echo 'selected';
                                                                    } ?>>Processing
                                                                    </option>
                                                                    <option value="Solved" <?php if ($rowshowallcomplaintsinadmin['status'] == "Solved") {
                                                                        echo 'selected';
                                                                    } ?>>Solved
                                                                    </option>
                                                                </select>
                                                                <input type="text" name="comid"
                                                                       value="<?php echo $rowshowallcomplaintsinadmin['id']; ?>"
                                                                       hidden>
                                                                <input type="submit" name="combtnchange"
                                                                       id="combtnchange<?php echo $rowshowallcomplaintsinadmin['id']; ?>"
                                                                       hidden>
                                                            </form>
                                                            <script>
                                                                $(document).ready(function () {
                                                                    $("#statuscom<?php echo $rowshowallcomplaintsinadmin['id']; ?>").change(function () {
                                                                        $("#combtnchange<?php echo $rowshowallcomplaintsinadmin['id']; ?>").click();
                                                                    });
                                                                });
                                                            </script>
                                                        </td>
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