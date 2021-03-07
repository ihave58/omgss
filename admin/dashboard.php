<?php
    require_once("header.php");
    $chkpage = 1;
    require_once("sidebar.php");
?>

    <style>
        div#morris-bar-chart {
            display: none;
        }

        .card-action.bar {
            display: none;
        }

        body {
            margin-top: -10px;
        }
    </style>

    <div id="page-wrapper">

        <div id="page-inner">

            <div class="dashboard-cards">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">


                        <div class="card horizontal cardIcon waves-effect waves-dark">
                            <div class="card-image red">
                                <i class="material-icons dp48">import_export</i>
                            </div>
                            <div class="card-stacked red">
                                <div class="card-content">
                                    <h3>Rs. 100</h3>
                                </div>
                                <div class="card-action">
                                    <strong>REVENUE</strong>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">

                        <div class="card horizontal cardIcon waves-effect waves-dark">
                            <div class="card-image orange">
                                <i class="material-icons dp48">shopping_cart</i>
                            </div>
                            <div class="card-stacked orange">
                                <div class="card-content">
                                    <h3>36,540</h3>
                                </div>
                                <div class="card-action">
                                    <strong>SALES</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">

                        <div class="card horizontal cardIcon waves-effect waves-dark">
                            <div class="card-image blue">
                                <i class="material-icons dp48">equalizer</i>
                            </div>
                            <div class="card-stacked blue">
                                <div class="card-content">
                                    <h3>100</h3>
                                </div>
                                <div class="card-action">
                                    <strong>USERS</strong>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">

                        <div class="card horizontal cardIcon waves-effect waves-dark">
                            <div class="card-image green">
                                <i class="material-icons dp48">supervisor_account</i>
                            </div>
                            <div class="card-stacked green">
                                <div class="card-content">
                                    <h3>100</h3>
                                </div>
                                <div class="card-action">
                                    <strong>VISITS</strong>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /. ROW  -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7">
                    <div class="cirStats">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="card-panel text-center">
                                    <h4>Revenue</h4>
                                    <div class="easypiechart" id="easypiechart-blue" data-percent="82"><span
                                                class="percent">Rs. 100</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="card-panel text-center">
                                    <h4>No. of Visits</h4>
                                    <div class="easypiechart" id="easypiechart-red" data-percent="46"><span
                                                class="percent">100</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="card-panel text-center">
                                    <h4>Customers</h4>
                                    <div class="easypiechart" id="easypiechart-teal" data-percent="84"><span
                                                class="percent">100</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="card-panel text-center">
                                    <h4>Sales</h4>
                                    <div class="easypiechart" id="easypiechart-orange" data-percent="55"><span
                                                class="percent">55%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.row-->
                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="card-image donutpad">
                                    <div id="morris-donut-chart"></div>
                                </div>
                                <div class="card-action">
                                    <b>Donut Chart Example</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/.row-->
            </div>


            <div class="col-md-7">
                <div class="card">
                    <div class="card-image">
                        <div id="morris-bar-chart"></div>
                    </div>
                    <div class="card-action bar">
                        <b> Bar Chart Example</b>
                    </div>
                </div>
            </div>

        </div>


<?php
    require_once("footer.php");
?>