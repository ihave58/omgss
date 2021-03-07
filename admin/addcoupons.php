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

        .form-control {
            display: block;
            width: 79% !important;
        }
    </style>

    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
    <div class="header">
        <h4 class="page-header">
            <b><u><i><?php if ($typecoup != "edit") {
                            echo 'Add';
                        } else {
                            echo 'Edit';
                        } ?> Coupons </i></u></b>

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
                                    <!--  <label for="couponname" class="uname" data-icon="u">Coupon Name</label> -->
                                    <input id="couponname" name="couponname" required="required" type="text"
                                           class="form-control" value="<?php echo $rowcoupview['couponname']; ?>"
                                           placeholder="Coupon Name"/>
                                </p>

                                <p>
                                    <!--  <label for="couponcode" class="uname" data-icon="u">Coupon Code</label> -->
                                    <input id="couponcode" name="couponcode" required="required" type="text"
                                           class="form-control" value="<?php echo $rowcoupview['couponcode']; ?>"
                                           placeholder="Coupon Code"/>
                                </p>

                                <p>
                                    <label for="coupontype" class="uname" data-icon="u">Coupon Type</label>
                                    <select id="coupontype" name="coupontype" required="required" class="form-control">
                                        <option value="1" <?php if ($rowcoupview['coupontype'] == 1) {
                                            echo 'selected';
                                        } ?>>By Percent
                                        </option>
                                        <option value="2" <?php if ($rowcoupview['coupontype'] == 2) {
                                            echo 'selected';
                                        } ?>>Flat
                                        </option>
                                    </select>
                                </p>

                                <p>
                                    <!-- label for="couponamount" class="uname" data-icon="u">Coupon Amount</label> -->
                                    <input id="couponamount" name="couponamount" required="required" type="text"
                                           class="form-control" value="<?php echo $rowcoupview['couponamount']; ?>"
                                           placeholder="Coupon Amount"/>
                                </p>

                                <p>
                                    <!-- <label for="usageperuser" class="uname" data-icon="u">Usage Per User</label> -->
                                    <input id="usageperuser" name="usageperuser" required="required" type="text"
                                           class="form-control" value="<?php echo $rowcoupview['usageperuser']; ?>"
                                           placeholder="Usage Per User"/>
                                </p>

                                <input type="text" name="coupidedit" value="<?php echo $coup; ?>" hidden>

                                <br>
                                <p class="signin button">
                                    <input type="submit" name="addcop<?php if ($typecoup == "edit") {
                                        echo 'edit';
                                    } ?>" class="btn btn-primary" value="<?php if ($typecoup == "edit") {
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






<?php
    include('footer.php');
?>