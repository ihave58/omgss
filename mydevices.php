<?php
include('header.php');
if ($_SESSION["sessid"] == "") {
    echo '<script>window.location.href="index.php";</script>';
}
?>
    <style>
        label {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="css/w3.css">

    <div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left"
         style="width:217px; background: #0071ff;    color: white !important;     padding-top: 35px;" id="mySidebar">
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
                <h1 style="margin-left: 33px;color: white;">My Devices</h1>
            </div>
        </div>

        <div class="w3-container">


            <section class="ftco-section bg-light" style="">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="table-responsive" style="overflow-x: none !important;padding: 16px;">


                                <?php
                                if ($countgetdevicesfr > 0) {
                                    ?>
                                    <table class="table table-striped  table-hover" id="dataTables-example">
                                        <thead style="color:black">
                                        <th>Sl.</th>
                                        <th>Device Name</th>
                                        <th>Device Id</th>
                                        <th>Quantity</th>
                                        <th>Order ID</th>
                                        <th>Date (Start)</th>
                                        <th>Date (Expire)</th>
                                        <th>Days Left</th>


                                        </thead>
                                        <tbody>

                                        <?php
                                        $counterbadd = 0;
                                        while ($rowgetdevicesfr = mysqli_fetch_assoc($resgetdevicesfr)) {
                                            $counterbadd++;
                                            $gtprdid = $rowgetdevicesfr['productid'];
                                            $sqlprp = "SELECT * FROM `005_omgss_products` WHERE `id`='$gtprdid'";
                                            $resprp = mysqli_query($conn, $sqlprp);
                                            $rowprp = mysqli_fetch_assoc($resprp);

                                            $date1 = date("Y/m/d");
                                            $date2 = date('Y-m-d H:i:s', strtotime($rowgetdevicesfr['datetime'] . ' + 365 days'));
                                            $diff = strtotime($date2) - strtotime($date1);
                                            $dateDiff = abs(round($diff / 86400));

                                            ?>
                                            <tr>
                                                <td><?php echo $counterbadd; ?></td>
                                                <td><?php echo $rowprp['name']; ?></td>
                                                <td><?php echo $rowprp['id']; ?></td>
                                                <td><?php echo $rowgetdevicesfr['quantity']; ?></td>
                                                <td><?php echo "OMGORD" . $rowgetdevicesfr['orderid']; ?></td>
                                                <td><?php echo $rowgetdevicesfr['datetime']; ?></td>
                                                <td><?php echo $date2; ?></td>
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
                                    echo '<p>No Orders Found</p>';
                                }
                                ?>


                            </div>
                            <div class="wrapper">

                                <div class="row no-gutters">

                                    <div class="col-md-7 d-flex">
                                        <div class="container-fluid">

                                            <div class="row">
                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-4"><a href="javascript:void(0)"
                                                                         class="btn btn-danger" id="complaintbtndevices"
                                                                         style="width: 100%;">Complain</a></div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


        </div>

    </div>


<?php
$selopt = "";
while ($rowgetdevicesfrcom = mysqli_fetch_assoc($resgetdevicesfrcom)) {
    $gtprdidcom = $rowgetdevicesfrcom['productid'];
    $sqlprpcom = "SELECT * FROM `005_omgss_products` WHERE `id`='$gtprdidcom'";
    $resprpcom = mysqli_query($conn, $sqlprpcom);
    $rowprpcom = mysqli_fetch_assoc($resprpcom);
    $selopt .= "<option value='" . $rowgetdevicesfrcom['id'] . "'>" . $rowprpcom['name'] . "</option>";
}
?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#complaintbtndevices").click(function () {
                var span = document.createElement("span");
                span.innerHTML = "<form method='post'>Select Device<select required class='form-control' name='dev'><option>Select</option><?php echo $selopt; ?></select><br>Complaint: <textarea required class='form-control' name='complaint' col=80></textarea><br><input type='submit' name='submitbtncomplain' value='Submit' class='btn btn-success'></form>";
                swal({
                    title: "Enter Your Complaint :",
                    text: "",
                    content: span,
                    closeOnClickOutside: false,
                })


            });
            $(document).on("click", "#btnA", function () {
                alert(this.id);
            });

        });
    </script>
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