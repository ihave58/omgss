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
                <b><u><i> Add Faq </i></u></b>

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
                                            <label for="question" class="uname" data-icon="u">Question</label>
                                            <textarea id="editor1" name="question" required="required" type="text"
                                                      placeholder="Question"></textarea>
                                        </p>

                                        <p>
                                            <label for="answer" class="uname" data-icon="u">Answer</label>
                                            <textarea id="editor2" name="answer" required="required" type="text"
                                                      placeholder="Answer"></textarea>
                                        </p>


                                        <br>
                                        <p class="signin button">
                                            <input type="submit" name="addfaq" class="btn btn-primary" value="Add"/>
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