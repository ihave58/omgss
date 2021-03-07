<?php
require_once("header.php");
$chkpage = 2;
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
                <b><u><i>Sub Categories of <?php echo $rowcatname['name']; ?></i></u></b><a
                        href="addsubcategory.php?catgoryid=<?php echo $catid; ?>" class="btn btn-primary"
                        style="float:right">Add Sub Category</a>
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
                                if ($countsubcats > 0) {
                                    ?>
                                    <table class="table table-striped table-bordered table-hover"
                                           id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th scope="col">Sl.</th>
                                            <th scope="col">Sub Category Name</th>
                                            <th scope="col">Sub Category Image</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $countsl = 0;
                                        while ($rowsubcats = mysqli_fetch_assoc($ressubcats)) {
                                            $countsl++;
                                            ?>
                                            <tr class="odd gradeX">
                                                <td scope="row"><?php echo $countsl; ?></td>
                                                <td><?php echo $rowsubcats['subcatname']; ?></td>
                                                <td><img src="files/sub/<?php echo $rowsubcats['subcatimage']; ?>"
                                                         style="height:20px;width:20px"></td>
                                                <td style="text-align:center"><a
                                                            href="addsubcategory.php?subcatid=<?php echo $rowsubcats['id'] ?>&typesubcat=edit&catgoryid=<?php echo $catid; ?>"><i
                                                                class="fa fa-edit" style="color:green"
                                                                aria-hidden="true"></i></a></td>
                                                <td style="text-align:center"><a
                                                            href="subfunction/deletesubcat.php?id=<?php echo $rowsubcats['id'] ?>&catid=<?php echo $rowsubcats['catid'] ?>"
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