<?php
    $chkpage = 7;
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
            <b><u><i> Terms & Conditions </i></u></b>

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
                                    <label for="image" class="uname" data-icon="u">Image</label>
                                    <input id="image" name="image" type="file" placeholder="Image"/> <img
                                            src="files/extras/<?php echo $rowterms['image']; ?>"
                                            style="height:100px;width:100px">
                                </p>

                                <p>
                                    <label for="textterms" class="uname" data-icon="u">Text</label>
                                    <textarea id="editor1" name="textterms" required="required" type="text"
                                              placeholder="Text"><?php echo $rowterms['textterms']; ?></textarea>
                                </p>


                                <br>
                                <p class="signin button">
                                    <input type="submit" name="termsbtn" class="btn btn-primary" value="Add"/>
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