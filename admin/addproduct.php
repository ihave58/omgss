<?php

    include('header.php');
    include('sidebar.php');
?>


    <style>
        tr {
            margin-top: 10px !important;
        }

        /*input[type="text"]{
          width: 50% !important;
          float:right !important;
        }
        input[type="file"]{
          width: 50% !important;
          float:right !important;
        }*/
        input[type="text"] {
            width: 70%;
        }

        label {
            font-weight: bold;
            color: black;
        }

        select {
            display: block !important;
            width: 50%;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div class="header">
            <h4 class="page-header">
                <b><u><i> <?php if ($typeprod == "edit") {
                                echo 'Edit';
                            } else {
                                echo 'Add';
                            } ?> Product </i></u></b>

            </h4>


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
                                <div id="login" class="animate form">
                                    <form enctype="multipart/form-data" method="post">

                                        <p>
                                            <label for="productname" class="uname" data-icon="u">Product Name</label>
                                            <input id="productname" name="productname" required="required" type="text"
                                                   value="<?php echo $rowprodsedit['name']; ?>"
                                                   placeholder="Product Name"/>
                                        </p>
                                        <p>
                                            <label for="category" class="uname" data-icon="u">Category</label>
                                            <select id="category" name="category" required="required"
                                                    placeholder="Category">
                                                <option selected disabled>Select</option>
                                                <?php
                                                    while ($rowcat = mysqli_fetch_assoc($rescat)) {
                                                        ?>
                                                        <option value="<?php echo $rowcat['id']; ?>" <?php if ($rowprodsedit['categoryid'] == $rowcat['id']) {
                                                            echo 'selected';
                                                        } ?>><?php echo $rowcat['name']; ?></option>
                                                        <?php
                                                    }

                                                ?>

                                            </select>
                                        </p>
                                        <p>
                                            <label for="subcategory" class="uname" data-icon="u">Sub Category</label>
                                            <select id="subcategory" name="subcategory" required="required"
                                                    placeholder="Sub Category">
                                                <option selected disabled>Select</option>
                                                <?php
                                                    if ($typeprod == "edit") {
                                                        $prdsubcatid = $rowprodsedit['subcategoryid'];
                                                        $sqlprdsubcat = "SELECT * FROM `005_omgss_subcategories` WHERE `id`='$prdsubcatid'";
                                                        $resprdsubcat = mysqli_query($conn, $sqlprdsubcat);
                                                        $rowprdsubcat = mysqli_fetch_assoc($resprdsubcat);
                                                        ?>
                                                        <option value="<?php echo $prdsubcatid; ?>"
                                                                selected><?php echo $rowprdsubcat['subcatname']; ?></option>
                                                        <?php
                                                    }
                                                ?>


                                            </select>
                                        </p>

                                        <script>
                                            $(document).ready(function () {
                                                $('#category').change(function () {
                                                    var categoryval = $('#category').val();
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "subfunction/getsubcat.php",
                                                        data: {categoryval: categoryval, action: 'query4'},
                                                        success: function (result) {
                                                            $('#subcategory').html(result);
                                                        }
                                                    });
                                                });
                                            });
                                        </script>

                                        <p>
                                            <label for="productimage" class="uname" data-icon="u">Product Image</label>
                                            <input id="productimage"
                                                   name="productimage" <?php if ($typeprod != "edit") {
                                                echo 'required="required"';
                                            } ?> type="file" placeholder="Product Image"/>

                                            <?php
                                                if ($typeprod == "edit") {

                                                    ?>
                                                    <img src="files/prod/<?php echo $rowprodsedit['image']; ?>"
                                                         style="height:100px;width:100px">
                                                    <?php
                                                }
                                            ?>

                                        </p>

                                        <p>
                                            <label for="saleprice" class="uname" data-icon="u">Sale Price</label>
                                            <input id="saleprice" name="saleprice" required="required" type="text"
                                                   value="<?php echo $rowprodsedit['saleprice']; ?>"
                                                   placeholder="Sale Price"/>
                                        </p>

                                        <p>
                                            <label for="units" class="uname" data-icon="u">Units</label>
                                            <select id="units" name="units" required="required">
                                                <option value="" selected disabled>Select</option>
                                                <option value="Nos" <?php if ($rowprodsedit['units'] == "Nos") {
                                                    echo 'selected';
                                                } ?>>Nos
                                                </option>
                                                <option value="Ton" <?php if ($rowprodsedit['units'] == "Ton") {
                                                    echo 'selected';
                                                } ?>>Ton
                                                </option>
                                                <option value="Sq. Ft." <?php if ($rowprodsedit['units'] == "Sq. Ft.") {
                                                    echo 'selected';
                                                } ?>>Sq. Ft.
                                                </option>
                                                <option value="Feet" <?php if ($rowprodsedit['units'] == "Feet") {
                                                    echo 'selected';
                                                } ?>>Feet
                                                </option>
                                                <option value="Metre" <?php if ($rowprodsedit['units'] == "Metre") {
                                                    echo 'selected';
                                                } ?>>Metre
                                                </option>
                                                <option value="kW" <?php if ($rowprodsedit['units'] == "kW") {
                                                    echo 'selected';
                                                } ?>>kW
                                                </option>
                                                <option value="HP" <?php if ($rowprodsedit['units'] == "HP") {
                                                    echo 'selected';
                                                } ?>>HP
                                                </option>
                                                <option value="Cubic Feet" <?php if ($rowprodsedit['units'] == "Cubic Feet") {
                                                    echo 'selected';
                                                } ?>>Cubic Feet
                                                </option>
                                                <option value="Cubic Meter" <?php if ($rowprodsedit['units'] == "Cubic Meter") {
                                                    echo 'selected';
                                                } ?>>Cubic Meter
                                                </option>
                                            </select>
                                        </p>


                                        <p>
                                            <label for="actualprice" class="uname" data-icon="u">Actual Price</label>
                                            <input id="actualprice" name="actualprice" required="required" type="text"
                                                   value="<?php echo $rowprodsedit['actualprice']; ?>"
                                                   placeholder="Actual Price"/>
                                        </p>
                                        <p>
                                            <label for="description" class="uname" data-icon="u">Description</label>
                                            <textarea id="editor1" name="description" required="required" type="text"
                                                      placeholder="Description"
                                                      col=50><?php echo $rowprodsedit['description']; ?></textarea>
                                        </p>
                                        <p></p>
                                        <p>
                                            <label for="maintenancetype" class="uname" data-icon="u">Maintainance
                                                Type</label>
                                            <!-- <input id="maintainancetype" name="maintainancetype" required="required" type="text" value="<?php echo $rowprodsedit['actualprice']; ?>" placeholder="Actual Price" /> -->

                                            <select id="maintenancetype" name="maintenancetype" required="required">
                                                <option value="">Select</option>
                                                <option value="1" <?php if ($rowprodsedit['maintenancetype'] == 1) {
                                                    echo 'selected';
                                                } ?>>One Time Maintenance
                                                </option>
                                                <option value="2" <?php if ($rowprodsedit['maintenancetype'] == 2) {
                                                    echo 'selected';
                                                } ?>>Annual Maintenance
                                                </option>
                                            </select>
                                        </p>


                                        <p>
                                            <label for="tags" class="uname" data-icon="u">Tags(Must be separated by a
                                                comma ,)</label>
                                            <input id="tags" name="tags" required="required" type="text"
                                                   value="<?php echo $rowprodsedit['tags']; ?>" placeholder="Tags"/>
                                        </p>

                                        <input type="text" name="pridforedit" value="<?php echo $prid; ?>" hidden>

                                        <br>
                                        <p class="signin button">
                                            <input type="submit" id="adprdbtn"
                                                   name="addprod<?php if ($typeprod == "edit") {
                                                       echo 'edit';
                                                   } ?>" class="btn btn-primary" value="<?php if ($typeprod == "edit") {
                                                echo 'Update';
                                            } else {
                                                echo 'Add';
                                            } ?>"/>
                                        </p>
                                        <!-- <p class="change_link">

                          <a href="dashboard.php" class="to_register"> Back To Dashboard </a>
                        </p> -->
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

            <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet"/>

            <script>
                $(document).ready(function () {
                    $("#adprdbtn").click(function (event) {
                        //event.preventDefault();
                        var category = $("#category").val();
                        //alert(category);
                        var subcategory = $("#subcategory").val();
                        if ((category == null) || (subcategory == null)) {
                            // alert();
                            event.preventDefault();
                            swal({
                                title: "Category or Subcategory Cannot be empty !!!",
                                text: "Please select them.",
                                icon: "error",
                                closeOnClickOutside: false,
                            });
                        }
                    });
                });
            </script>


<?php
    include('footer.php');
?>