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
                <b><u><i> Add Home Slider Images </i></u></b>

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
                                            <label for="sliderimage" class="uname" data-icon="u">Slider Image</label>
                                            <input id="sliderimage" name="sliderimage" required="required" type="file"
                                                   placeholder="Slider Image"/>
                                        </p>

                                        <p>
                                            <label for="tagline1" class="uname" data-icon="u">Tag Line 1</label>
                                            <input id="tagline1" name="tagline1" required="required" type="text"
                                                   placeholder="Tag Line 1">
                                        </p>

                                        <p>
                                            <label for="tagline2" class="uname" data-icon="u">Tag Line 2</label>
                                            <input id="tagline2" name="tagline2" required="required" type="text"
                                                   placeholder="Tag Line 2">
                                        </p>


                                        <br>
                                        <p class="signin button">
                                            <input type="submit" name="addhomeslider" class="btn btn-primary"
                                                   value="Add"/>
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