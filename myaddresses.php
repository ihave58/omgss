<?php
    include('header.php');
    if ($_SESSION["sessid"] == "") {
        echo '<script>window.location.href="index.php";</script>';
    }
?>

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
                <h1 style="margin-left: 33px;color: white;">My Addresses</h1>
            </div>
        </div>

        <div class="w3-container">


            <section class="ftco-section bg-light" style="">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <a href="addaddress.php" class="btn btn-primary"
                               style="background-color: #0071ff;    float:right">Add New</a>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive"
                                 style="overflow-x: none !important;padding: 16px;border: 1px solid lightgrey;">


                                <?php
                                    if ($countbilladd > 0) {
                                        ?>
                                        <table class="table table-striped table-bordered table-hover"
                                               id="dataTables-example">
                                            <thead>
                                            <th>Sl.</th>
                                            <th>Address Profile Name</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Zip</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            </thead>
                                            <tbody>

                                            <?php
                                                $counterbadd = 0;
                                                while ($rowbilladd = mysqli_fetch_assoc($resbilladd)) {
                                                    $counterbadd++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $counterbadd; ?></td>
                                                        <td><?php echo $rowbilladd['addressprofilename']; ?></td>
                                                        <td><?php echo $rowbilladd['fullname']; ?></td>
                                                        <td><?php echo $rowbilladd['Email']; ?></td>
                                                        <td><?php echo $rowbilladd['Address']; ?></td>
                                                        <td><?php echo $rowbilladd['City']; ?></td>
                                                        <td><?php echo $rowbilladd['State']; ?></td>
                                                        <td><?php echo $rowbilladd['Zip']; ?></td>
                                                        <td style="text-align:center"><a
                                                                    href="addaddress.php?badd=<?php echo $rowbilladd['id'] ?>&typebadd=edit"><i
                                                                        class="fa fa-edit" style="color:green"
                                                                        aria-hidden="true"></i></a></td>
                                                        <td style="text-align:center"><a
                                                                    href="subfunctions/delbadd.php?id=<?php echo $rowbilladd['id'] ?>"
                                                                    onclick="return confirm('Are you sure you want to delete this item?');"><i
                                                                        class="fa fa-window-close" style="color:red"
                                                                        aria-hidden="true"></i></a></td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>

                                            </tbody>
                                        </table>
                                        <?php
                                    } else {
                                        echo '<p>No Address Found</p>';
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