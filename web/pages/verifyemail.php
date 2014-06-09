<?php require_once("autoload2.php");


if (isset($_GET['user'])) {
    $user = $_GET['user'];
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="utf-8" />
        <title>Verify your Email | FOMonitor</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="stilearning" />

        <!-- google font -->
        <link href="http://fonts.googleapis.com/css?family=Aclonica:regular" rel="stylesheet prefetch" type="text/css" />
        
        <!-- styles -->
        <link href="../css/bootstrap.css" rel="stylesheet" />
        <link href="../css/bootstrap-responsive.css" rel="stylesheet" />
        <link href="../css/stilearn.css" rel="stylesheet" />
        <link href="../css/stilearn-responsive.css" rel="stylesheet" />
        <link href="../css/stilearn-helper.css" rel="stylesheet" />
        <link href="../css/stilearn-icon.css" rel="stylesheet" />
        <link href="../css/font-awesome.css" rel="stylesheet" />
        <link href="../css/animate.css" rel="stylesheet" />
        <link href="../css/pricing-table.css" rel="stylesheet" />
        <link href="../css/uniform.default.css" rel="stylesheet" />
        
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

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
                                        <label class="control-label">Email</label>
                                        <div class="controls">
                                            <input type="text" class="input-block-level" data-validate="{required: true, messages:{required:'Please enter field email'}}" name="login_username" id="login_username" autocomplete="on" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Password</label>
                                        <div class="controls">
                                            <input type="password" class="input-block-level" data-validate="{required: true, messages:{required:'Please enter field password'}}" name="login_password" id="login_password" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        
                                        <label class="checkbox">
                                            <input type="checkbox" data-form="uniform" name="remember_me" id="remember_me_yes" value="yes" /> Remember me
                                        </label>
                                        <p class="recover-account">Not have an account yet? <a href="#modal-pricing" class="link" data-toggle="modal">See our plan!</a></p>
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" class="btn btn-block btn-large btn-primary" value="Sign into account" />
                                        <p class="recover-account">Recover your <a href="#modal-recover" class="link" data-toggle="modal">password</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!--/Sign In-->
                </div><!-- /row -->
            </div><!-- /container -->

        <!-- javascript
        ================================================== -->
        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/pricing-table/prefixfree.js"></script>
        <script src="../js/uniform/jquery.uniform.js"></script>
        
        <script src="../js/validate/jquery.metadata.js"></script>
        <script src="../js/validate/jquery.validate.js"></script>

        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            var tz = jstz.determine(); // Determines the time zone of the browser client
            var timezone = tz.name(); //'Asia/Kolhata' for Indian Time.

            document.cookie="timezone="+timezone;

             // try your js
                
                // uniform
                $('[data-form=uniform]').uniform();
                
                // validate
                $('#sign-in').validate();
                $('#sign-up').validate();
                $('#form-recover').validate();
          });
        </script>
    </body>
</html>
