<?php require_once("autoload2.php"); ?>
<?php require_once("config.php"); ?>
<?php

if (isset($_SESSION['loginsession'])) redirect("pages/menu.php");

$error = false;
if (isset($_POST['username'])) {
    $user = new user();

    $returnLogin = $user->login($_POST['username'], $_POST['password']);

    if ($returnLogin) {
        $_SESSION['emailsession'] = $_POST['username'];
        $_SESSION['loginsession'] = $returnLogin;
        redirect("pages/menu.php");
    } else {
        $error = true;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8" />
        <title>Logn In - Stilearn Admin Bootstrap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="stilearning" />

        <!-- google font -->
        <link href="http://fonts.googleapis.com/css?family=Aclonica:regular" rel="stylesheet" type="text/css" />

        <!-- styles -->
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/bootstrap-responsive.css" rel="stylesheet" />
        <link href="css/stilearn.css" rel="stylesheet" />
        <link href="css/stilearn-responsive.css" rel="stylesheet" />
        <link href="css/stilearn-helper.css" rel="stylesheet" />
        <link href="css/stilearn-icon.css" rel="stylesheet" />
        <link href="css/font-awesome.css" rel="stylesheet" />
        <link href="css/animate.css" rel="stylesheet" />
        <link href="css/uniform.default.css" rel="stylesheet" />
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- javascript
        ================================================== -->
        
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/uniform/jquery.uniform.js"></script>
        
        <script src="js/validate/jquery.metadata.js"></script>
        <script src="js/validate/jquery.validate.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                // try your js
                
                // uniform
                $('[data-form=uniform]').uniform();
                
                // validate
                $('#sign-in').validate();
                $('#sign-up').validate();
                $('#form-recover').validate();
            })
        </script>

    </head>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.loginform button').hover(function () {
                    $(this).stop().switchClass('default', 'hover');
                }, function () {
                    $(this).stop().switchClass('hover', 'default');
                });

                <?php if (isset($_GET['action']) && $_GET['action']=="logout") {?>
                jQuery('.logoutmsg').slideDown();
                <?php }?>

                <?php if ($error) {?>
                var u = jQuery(this).find('#username');
                if (u.val() == '') {
                    jQuery('.loginerror').slideDown();
                    u.focus();
                }
                <?php }?>

                $('#username').keypress(function () {
                    jQuery('.loginerror').slideUp();
                });
            });
        </script>

	</head>
    <body>
        <!-- section header -->
        <header class="header" data-spy="affix" data-offset-top="0">
            <!--nav bar helper-->
            <div class="navbar-helper">
                <div class="row-fluid">
                    <!--panel site-name-->
                    <div class="span2">
                        <div class="panel-sitename">
                            <h2><a href="index.html"><span class="color-teal">fo</span>Monitor</a></h2>
                        </div>
                    </div>
                    <!--/panel name-->
                </div>
            </div><!--/nav bar helper-->
        </header>

        <!-- section content -->
        <section class="section">
            <div class="container">
                <div class="signin-form row-fluid">
                    <!--Sign In-->
                    <div class="span5 offset1">
                        <div class="box corner-all">
                            <div class="box-header grd-teal color-white corner-top">
                                <span>Sign in:</span>
                            </div>
                            <div class="box-body bg-white">
                                <form id="sign-in" method="post" />
                                    <div class="control-group">
                                        <label class="control-label">Username</label>
                                        <div class="controls">
                                            <input type="text" class="input-block-level" data-validate="{required: true, messages:{required:'Please enter field username'}}" name="username" id="username" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Password</label>
                                        <div class="controls">
                                            <input type="password" class="input-block-level" data-validate="{required: true, messages:{required:'Please enter field password'}}" name="password" id="password" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="checkbox">
                                            <input type="checkbox" data-form="uniform" name="remember_me" id="remember_me_yes" value="yes" /> Remember me
                                        </label>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-block btn-large btn-primary" value="Login" >Sign into account</button>
                                        <p class="recover-account">Recover your <a href="#modal-recover" class="link" data-toggle="modal">password</a></p>
                                    </div>
                                    <div class="loginerror"><p>Usuário ou senha inválida</p></div>
                                </form>
                            </div>
                        </div>
                    </div><!--/Sign In-->
                    <!--Sign Up-->

    </body>
</html>