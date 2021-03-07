<?php
$chkpage = 14;
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
            <b><u><i> Company Details </i></u></b>

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
                                    <label for="companyemailsvad" class="uname" data-icon="u">Company Email</label>
                                    <input id="companyemailsvad" name="companyemailsvad" required="required" type="text"
                                           value="<?php echo $companyEmail; ?>" placeholder="Company Email"/>
                                </p>
                                <input type="text" name="catidedit" value="<?php echo $catid; ?>" hidden>

                                <br>
                                <p class="signin button">
                                    <input type="submit" name="updatecompanydetails" class="btn btn-primary"
                                           value="Update"/>
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