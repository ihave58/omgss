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
    </style>

    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
    <div class="header">
        <h4 class="page-header">
            <b><u><i> <?php if ($typesubcat != "edit") {
                            echo 'Add';
                        } else {
                            echo 'Edit';
                        } ?> Sub Category </i></u></b>

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
                                    <label for="subcategoryname" class="uname" data-icon="u">Sub Category Name</label>
                                    <input id="subcategoryname" name="subcategoryname" required="required" type="text"
                                           value="<?php echo $rowsubcatsedit['subcatname']; ?>"
                                           placeholder="Sub Category Name"/>
                                </p>
                                <p>
                                    <label for="categoryimg" class="uname" data-icon="u">Sub Category Image</label>
                                    <input id="categoryimg" name="categoryimg" <?php if ($typesubcat != "edit") {
                                        echo 'required="required"';
                                    } ?> type="file"
                                           placeholder="Category Image"/> <?php if ($typesubcat == "edit") { ?><img
                                        src="files/sub/<?php echo $rowsubcatsedit['subcatimage']; ?>"
                                        style="height:100px;width:100px"><?php } ?>
                                </p>


                                <br>
                                <input type="text" value="<?php echo $catgoryid; ?>" name="catid" hidden>
                                <input type="text" value="<?php echo $subcatid; ?>" name="subcatidforedit" hidden>
                                <p class="signin button">
                                    <input type="submit" name="addsubcat<?php if ($typesubcat == "edit") {
                                        echo 'edit';
                                    } ?>" class="btn btn-primary" value="<?php if ($typesubcat != "edit") {
                                        echo 'Add';
                                    } else {
                                        echo 'Update';
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