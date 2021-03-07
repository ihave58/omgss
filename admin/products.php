<?php
    require_once("header.php");
    $chkpage = 3;
    require_once("sidebar.php");


?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
        <div class="header">
            <h4 class="page-header">
                <b><u><i>All Products</i></u></b><a href="addproduct.php" class="btn btn-primary" style="float:right">Add
                    Product</a>
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
                                    if ($countprod > 0) {
                                        ?>
                                        <table class="table table-striped table-bordered table-hover"
                                               id="dataTables-example">
                                            <thead>
                                            <tr>
                                                <th scope="col">Sl.</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Sub Category</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Sale Price</th>
                                                <th scope="col">Actual Price</th>
                                                <th scope="col">Units</th>
                                                <th scope="col">Maintainance Type</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                $countsl = 0;
                                                while ($rowprod = mysqli_fetch_assoc($resprod)) {
                                                    $categoryid = $rowprod['categoryid'];
                                                    $sqlcatname = "SELECT * FROM `005_omgss_categories` WHERE `id`='$categoryid'";
                                                    $rescatname = mysqli_query($conn, $sqlcatname);
                                                    $rowcatname = mysqli_fetch_assoc($rescatname);

                                                    $subcategoryid = $rowprod['subcategoryid'];

                                                    $sqlsubcatname = "SELECT * FROM `005_omgss_subcategories` WHERE `id`='$subcategoryid'";
                                                    $ressubcatname = mysqli_query($conn, $sqlsubcatname);
                                                    $rowsubcatname = mysqli_fetch_assoc($ressubcatname);

                                                    $countsl++;
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td scope="row"><?php echo $countsl; ?></td>
                                                        <td><?php echo $rowprod['name']; ?></td>
                                                        <td><?php echo $rowcatname['name']; ?></td>
                                                        <td><?php echo $rowsubcatname['subcatname']; ?></td>
                                                        <td><img src="files/prod/<?php echo $rowprod['image']; ?>"
                                                                 style="height:100px;width:100px"></td>
                                                        <td><?php echo $rowprod['saleprice']; ?></td>
                                                        <td><?php echo $rowprod['actualprice']; ?></td>
                                                        <td><?php echo $rowprod['units']; ?></td>
                                                        <td><?php if ($rowprod['maintenancetype'] == 1) {
                                                                echo "One Time Maintenance";
                                                            } else if ($rowprod['maintenancetype'] == 2) {
                                                                echo 'Annual Maintenance';
                                                            } ?></td>
                                                        <td style="text-align:center"><a
                                                                    href="addproduct.php?prid=<?php echo $rowprod['id'] ?>&typeprod=edit"><i
                                                                        class="fa fa-edit" style="color:green"
                                                                        aria-hidden="true"></i></a></td>
                                                        <td style="text-align:center"><a
                                                                    href="subfunction/delprod.php?id=<?php echo $rowprod['id'] ?>"
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