<?php
header("Cache-Control: no-cache, must-revalidate");
$chkpage = 5;
session_start();
include('header.php');
include('sidebar.php');

include('db.php');
include('includes/btnposts.php');
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
        /* input[type="password"]
         {
           width:70%;
         }*/
        label {
            font-weight: bold;
            color: black;
        }
    </style>

    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div class="header">
            <h4 class="page-header">
                <b><u><i> Reset Password </i></u></b>

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
                                            <label for="opass" class="uname" data-icon="u">Old Password</label>
                                            <input id="opass" name="opass" required="required" type="password"
                                                   placeholder="Old Password"/>
                                        </p>
                                        <p>
                                            <label for="npass" class="uname" data-icon="u">New Password</label>
                                            <input id="npass" name="npass" required="required" type="password"
                                                   placeholder="New Password"/>
                                        </p>
                                        <p>
                                            <label for="cpass" class="uname" data-icon="e">Confirm Password</label>
                                            <input id="cpass" name="cpass" required="required" type="password"
                                                   placeholder="Confirm Password"/>
                                        </p>

                                        <p class="signin button">
                                            <input type="submit" name="btnreset" class="btn btn-primary" value="Reset"/>
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