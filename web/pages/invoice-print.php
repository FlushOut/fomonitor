<?php
require_once("../config.php");


if (!$_GET['id']) die();
$pay = new payment();
$pay->open($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="../img/icon.png">
        <title>Invoice 247 - Stilearn Admin Bootstrap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="stilearning" />

        <!-- google font -->
        <link href="http://fonts.googleapis.com/css?family=Aclonica:regular" rel="stylesheet" type="text/css" />
        
        <!-- styles -->
        <link href="../css/bootstrap.css" rel="stylesheet" />
        <link href="../css/stilearn.css" rel="stylesheet" />
        
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <style>
            @media print{
                p.muted{
                    font-weight: bold;
                }
                small.small{
                    font-weight: normal;
                }
            }
        </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

    <body>
        <!-- section content -->
        <section class="section">
            <div class="container">
                <!-- span content -->
                <div class="span10 offset1">
                    <!-- content -->
                    <div class="content" style="border: 1px solid #d7d7d7;">
                        <!-- content-body -->
                        <div class="content-body">
                            <!-- invoice -->
                            <div id="invoice-container" class="invoice-container">
                                <div class="page-header">
                                    <div class="pull-right">
                                        <img data-src="holder.js/120x120" class="img-circle" />
                                    </div>
                                    <h3>Invoice #<?php echo $pay->sequence; ?></h3>
                                </div>
                                <div class="row-fluid">
                                    <div class="span4">
                                        <p class="muted">From</p>
                                        <p>FlushOut Solutions</p>
                                        <p>contact@flushoutsolutions.com</p>
                                    </div>
                                    <div class="span4">
                                        <p class="muted">To</p>
                                        <p><?php echo $company->name; ?></p>
                                        <p><?php echo $user->name; ?></p>
                                    </div>
                                    <div class="span4">
                                        <p>Invoice No. <?php echo $pay->sequence; ?></p>
                                        <p>Billing Period. <?php echo date('F jS Y', strtotime($pay->date_start)); ?> - <?php echo date('F jS Y', strtotime($pay->date_end)); ?></p>
                                        <p>Payment Date. <?php echo date('F jS Y', strtotime($pay->date_end)); ?></p>
                                    </div>
                                </div>
                                <div class="invoice-table">
                                    <table class="table table-bordered invoice responsive">
                                        <thead>
                                            <tr>
                                                <th>ITEM DESCRIPTIONS</th>
                                                <th>QTY</th>
                                                <th>PRICE</th>
                                                <th>TOTAL PRICE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                               <td>Users Web</td>
                                                <td class="right"><?php echo $pay->u_web; ?></td>
                                                <td class="right">$<?php echo number_format($priceUserWeb,2,",","."); ?></td>
                                                <td class="right">$<?php echo number_format($priceUserWeb*$pay->u_web,2,",","."); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Users Mobile</td>
                                                <td class="right"><?php echo $pay->u_mobile; ?></td>
                                                <td class="right">$<?php echo number_format($priceUserMobile,2,",","."); ?></td>
                                                <td class="right">$<?php echo number_format($priceUserMobile*$pay->u_mobile,2,",","."); ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">Invoice Totals</th>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Invoice Subtotal</td>
                                                <td class="right">$<?php echo number_format(($priceUserMobile*$pay->u_mobile)+($priceUserWeb*$pay->u_web),2,",","."); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Invoice Discount</td>
                                                 <td class="right">($0.00)</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Total Due</td>
                                                <td class="right">USD $<?php echo number_format(($priceUserMobile*$pay->u_mobile)+($priceUserWeb*$pay->u_web),2,",","."); ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!--/invoice-->
                        </div><!--/content-body -->
                    </div><!-- /content -->
                </div><!-- /span content -->

            </div><!-- /container -->
        </section>

        <!-- javascript
        ================================================== -->
        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                // try your js
                
            });
      
        </script>
    </body>
</html>