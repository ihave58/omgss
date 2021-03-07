<!--/. NAV TOP  -->
<!--/. NAV TOP  -->
<style>
    .sidebar-collapse > .nav > li > a {
        padding: 0px;

    }
</style>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">


            <li>
                <a href="categories.php" class="<?php if ($chkpage == 2) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> Categories</a>
            </li>
            <li>
                <a href="products.php" class="<?php if ($chkpage == 3) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> Products</a>
            </li>

            <li>
                <a href="reset.php" class="<?php if ($chkpage == 5) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> Reset Password</a>
            </li>
            <li>
                <a href="orders.php" class="<?php if ($chkpage == 13) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> Orders</a>
            </li>
            <li>
                <a href="coupons.php" class="<?php if ($chkpage == 12) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> Coupons</a>
            </li>
            <li>
                <a href="homesliderimages.php" class="<?php if ($chkpage == 11) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> Home Slider Images</a>
            </li>
            <li>
                <a href="privacypolicy.php" class="<?php if ($chkpage == 10) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> Privacy Policy</a>
            </li>
            <li>
                <a href="faq.php" class="<?php if ($chkpage == 9) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> FAQ</a>
            </li>
            <li>
                <a href="aboutus.php" class="<?php if ($chkpage == 8) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> About Us</a>
            </li>
            <li>
                <a href="termsandconditions.php" class="<?php if ($chkpage == 7) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> Terms & Conditions</a>
            </li>
            <li>
                <a href="contactdetails.php" class="<?php if ($chkpage == 6) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> Contact Details</a>
            </li>
            <li>
                <a href="companydetails.php" class="<?php if ($chkpage == 14) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> Company Details</a>
            </li>
            <li>
                <a href="notifications.php" class="<?php if ($chkpage == 15) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> Notifications</a>
            </li>
            <li>
                <a href="devices.php" class="<?php if ($chkpage == 16) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> Devices</a>
            </li>
            <li>
                <a href="complaints.php" class="<?php if ($chkpage == 17) {
                    echo 'active-menu ';
                } ?>waves-effect waves-dark"><i class="fa fa-user"></i> Complaints
                    <superscript id="countcom"
                                 style="color:white;font-size: x-large;     border-radius: 62%;padding: 4px;"><?php if ($getcountcountnot > 0) {
                            echo $getcountcountnot;
                        } ?></superscript>
                </a>
            </li>

        </ul>

    </div>

</nav>