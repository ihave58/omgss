<?php
require_once("header.php");
$chkpage = 15;
require_once("sidebar.php");


?>
    <style>
        th {
            text-align: center;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div class="header">
            <h4 class="page-header">
                <b><u><i>Notifications</i></u></b><a href="addnotifications.php" class="btn btn-primary"
                                                     style="float:right">Add Notification</a>
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
                                if ($countnoti > 0) {
                                    ?>
                                    <table class="table table-striped table-bordered table-hover"
                                           id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th scope="col">Sl.</th>
                                            <th scope="col">Notification</th>
                                            <th scope="col">Notification Image</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $countsl = 0;
                                        while ($rownoti = mysqli_fetch_assoc($resnoti)) {
                                            $countsl++;
                                            ?>
                                            <tr class="odd gradeX">
                                                <td scope="row"><?php echo $countsl; ?></td>
                                                <td><?php echo $rownoti['description']; ?></td>
                                                <td><img src="files/noti/<?php echo $rownoti['image']; ?>"
                                                         style="height:20px;width:20px"></td>
                                                <td style="text-align:center"><a
                                                            href="addnotifications.php?notiid=<?php echo $rownoti['id'] ?>&typenoti=edit"><i
                                                                class="fa fa-edit" style="color:green"
                                                                aria-hidden="true"></i></a></td>
                                                <td style="text-align:center"><a
                                                            href="subfunction/deletenoti.php?id=<?php echo $rownoti['id'] ?>"
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