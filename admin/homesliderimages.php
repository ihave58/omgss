<?php
require_once("header.php");
$chkpage = 11;
require_once("sidebar.php");


?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div class="header">
            <h4 class="page-header">
                <b><u><i>All Home Slider Images</i></u></b> <a href="addhomesliderimages.php" class="btn btn-primary"
                                                               style="float:right">Add Home Slider Images</a>
            </h4>
            <!-- <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Data</li>
        </ol>  -->

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
                                <?php
                                if ($counthomeslider > 0) {
                                    ?>
                                    <table class="table table-striped table-bordered table-hover"
                                           id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th scope="col">Sl.</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Tag Line 1</th>
                                            <th scope="col">Tag Line 2</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $countsl = 0;
                                        while ($rowhomeslider = mysqli_fetch_assoc($reshomeslider)) {
                                            $countsl++;
                                            ?>
                                            <tr class="odd gradeX">
                                                <td scope="row"><?php echo $countsl; ?></td>
                                                <td><img src="files/extras/<?php echo $rowhomeslider['sliderimage']; ?>"
                                                         style="height:100px;width:100px"></td>
                                                <td><?php echo $rowhomeslider['tagline1']; ?></td>
                                                <td><?php echo $rowhomeslider['tagline2']; ?></td>
                                                <td style="text-align:center"><a
                                                            href="subfunction/deletehomeslider.php?id=<?php echo $rowhomeslider['id'] ?>"
                                                            onclick="return confirm('Are you sure you want to delete this item?');"><i
                                                                class="fa fa-window-close" style="color:red"
                                                                aria-hidden="true"></i></a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>


                                        </tbody>
                                    </table>

                                    <?php

                                } else {
                                    echo 'No record Exists !!!';
                                }

                                ?>

                            </div>

                        </div>

                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>

<?php
require_once("footer.php");
?>