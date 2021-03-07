<?php
    header("Cache-Control: no-cache, must-revalidate");
    session_start();
    include('../include/db.php');
    include('../include/functions.php');
    include('../include/keys.php');
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>
<html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>
<html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>
<html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="UTF-8"/>
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
    <title>Omgss Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login and Registration Form with HTML5 and CSS3"/>
    <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class"/>
    <meta name="author" content="Codrops"/>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/demo.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/animate-custom.css"/>
</head>
<body>
<div class="container">
    <!-- Codrops top bar -->


    <section>
        <div id="container_demo">
            <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>
            <div id="wrapper" style="margin-top:170px">
                <div id="login" class="animate form">
                    <form method="post">
                        <h1>Log in</h1>
                        <p>
                            <label for="username" class="uname" data-icon="u"> Username </label>
                            <input id="username" name="username" required="required" type="text"
                                   placeholder="Username"/>
                        </p>
                        <p>
                            <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                            <input id="password" name="password" required="required" type="password"
                                   placeholder="Password"/>
                        </p>
                        <p class="keeplogin">
                            <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" checked/>
                            <label for="loginkeeping">Keep me logged in</label>
                        </p>
                        <p class="login button">
                            <input type="submit" name="btnsublogin" value="Login"/>
                        </p>
                        <!-- <p class="change_link">
                            Not a member yet ?
                            <a href="#toregister" class="to_register">Join us</a>
                        </p> -->
                    </form>
                </div>

                <!--                         <div id="register" class="animate form" >
                                            <form   method="post">
                                                <h1> Registration </h1>
                                                 <p>
                                                    <label for="employeecandidatename" class="uname" data-icon="u">Employee / Candidate Name</label>
                                                    <input id="employeecandidatename" name="employeecandidatename" required="required" type="text" placeholder="(S3 bucket will be created by the same name)" />
                                                </p>
                                                <p>
                                                    <label for="age" class="uname" data-icon="u">Age</label>
                                                    <input id="age" name="age" required="required" type="text" placeholder="Age" />
                                                </p>
                                                <p>
                                                    <label for="sex" class="uname" data-icon="e" >Sex</label>
                                                    <input id="sex" name="sex" required="required" type="text" placeholder="Sex"/>
                                                </p>
                                                <p>
                                                    <label for="height" class="uname" data-icon="p">Height</label>
                                                    <input id="height" name="height" required="required" type="text" placeholder="Height"/>
                                                </p>
                                                <p>
                                                    <label for="address1" class="uname" data-icon="p">Address 1</label>
                                                    <input id="address1" name="address1" required="required" type="text" placeholder="Address 1"/>
                                                </p>
                                                <p>
                                                    <label for="address2" class="uname" data-icon="p">Address 2</label>
                                                    <input id="address2" name="address2" required="required" type="text" placeholder="Address 2"/>
                                                </p>
                                                <p>
                                                    <label for="address3" class="uname" data-icon="p">Address 3</label>
                                                    <input id="address3" name="address3" required="required" type="text" placeholder="Address 3" autocomplete="off" />
                                                </p>
                                                <p>
                                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                                </p>
                                                <p class="signin button">
                                                    <input type="submit" name="btnregister" value="Sign up"/>
                                                </p>
                                                <p class="change_link">
                                                    Already a member ?
                                                    <a href="#tologin" class="to_register"> Go and log in </a>
                                                </p>
                                            </form>
                                        </div>
                 -->
            </div>
        </div>
    </section>
</div>
</body>
</html>