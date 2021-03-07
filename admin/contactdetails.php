<?php
    $chkpage = 6;
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
    </style>

    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
    <div class="header">
        <h4 class="page-header">
            <b><u><i> Contact Details </i></u></b>

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
                                    <label for="address" class="uname" data-icon="u">Address</label>
                                    <input id="address" name="address" required="required" type="text"
                                           placeholder="Address" value="<?php echo $rowcontact['address']; ?>"/>
                                </p>

                                <p>
                                    <label for="phone" class="uname" data-icon="u">Phone</label>
                                    <input id="phone" name="phone" required="required" type="text" placeholder="Phone"
                                           value="<?php echo $rowcontact['phone']; ?>"/>
                                </p>
                                <p>
                                    <label for="officetiming" class="uname" data-icon="u">Office Timing</label>
                                    <input id="officetiming" name="officetiming" required="required" type="text"
                                           placeholder="Office Timing"
                                           value="<?php echo $rowcontact['officetiming']; ?>"/>
                                </p>
                                <p>
                                    <label for="email" class="uname" data-icon="u">Email</label>
                                    <input id="email" name="email" required="required" type="text" placeholder="Email"
                                           value="<?php echo $rowcontact['email']; ?>"/>
                                </p>
                                <p>
                                    <label for="website" class="uname" data-icon="u">Website</label>
                                    <input id="website" name="website" required="required" type="text"
                                           placeholder="Website" value="<?php echo $rowcontact['website']; ?>"/>
                                </p>


                                <br>
                                <p class="signin button">
                                    <input type="submit" name="contactdetailsbtn" class="btn btn-primary" value="Add"/>
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