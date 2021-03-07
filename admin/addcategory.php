<?php
    include('header.php');
    include('sidebar.php');
?>
<?php
    if ($typecat != "edit") {
        if ($countcat == 6) {
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                
                          <link href="http://tristanedwards.me/u/SweetAlert/lib/sweet-alert.css" rel="stylesheet" />

                          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


                        <script>
                        $( document ).ready(function() {
                          var span = document.createElement("span");
                            
                         swal({
                            title: "Sorry cannot add more than six Categories !!!",
                            text: "",
                            icon: "info",
                            closeOnClickOutside: false,
                       }).then(function() {
                                window.location = "categories.php";
                            });
                

                        });
                        $(document).on("click", "#btnA", function() {
                            alert(this.id);
                      });
                       
                      </script>
                        ';
        }
    }

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
            <b><u><i><?php if ($typecat != "edit") {
                            echo 'Add';
                        } else {
                            echo 'Edit';
                        } ?> Category </i></u></b>

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
                                    <label for="categoryname" class="uname" data-icon="u">Category Name</label>
                                    <input id="categoryname" name="categoryname" required="required" type="text"
                                           value="<?php echo $rowcatedit['name']; ?>" placeholder="Category Name"/>
                                </p>
                                <input type="text" name="catidedit" value="<?php echo $catid; ?>" hidden>

                                <br>
                                <p class="signin button">
                                    <input type="submit" name="addcat<?php if ($typecat == "edit") {
                                        echo 'edit';
                                    } ?>" class="btn btn-primary" value="<?php if ($typecat == "edit") {
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