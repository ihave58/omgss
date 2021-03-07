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
            <b><u><i> <?php if ($typenoti != "edit") {
                            echo 'Add';
                        } else {
                            echo 'Edit';
                        } ?> Notification </i></u></b>

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
                                    <label for="notificationname" class="uname" data-icon="u">Notification</label>
                                    <textarea id="editor1" name="notificationname" required="required"
                                              placeholder="Notification"><?php echo $rownotiname['description']; ?></textarea>
                                </p>
                                <p>
                                    <label for="notificationimage" class="uname" data-icon="u">Notification
                                        Image</label>
                                    <input id="notificationimage"
                                           name="notificationimage" <?php if ($typenoti != "edit") {
                                        echo 'required="required"';
                                    } ?> type="file" placeholder="Category Image"/> <?php if ($typenoti == "edit") { ?>
                                        <img src="files/noti/<?php echo $rownotiname['image']; ?>"
                                             style="height:100px;width:100px"><?php } ?>
                                </p>


                                <br>

                                <input type="text" value="<?php echo $notiid; ?>" name="notiidforedit" hidden>
                                <p class="signin button">
                                    <input type="submit" name="addnotification<?php if ($typenoti == "edit") {
                                        echo 'edit';
                                    } ?>" class="btn btn-primary" value="<?php if ($typenoti != "edit") {
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