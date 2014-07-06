<?php
$payment = new payment();
$payment->byCompany($company->id);
//setlocale(LC_MONETARY, 'en_US');
//$totalPrice = money_format('%i', (($payment->u_mobile * $priceUserMobile) + ($payment->u_web * $priceUserWeb)));
$totalPrice = number_format((($payment->u_mobile * $priceUserMobile) + ($payment->u_web * $priceUserWeb)),2,",",".");

?>

<!-- content-header -->
                        <div class="content-header">
                            <ul class="content-header-action pull-right">
                                <li>
                                    <a href="/pages/mobile.php">
                                        <div class="badge-circle grd-green color-white"><i class="typicn-mobile"></i></div>
                                        <div class="action-text color-green"><?php echo $payment->u_mobile; ?> <span class="helper-font-small color-silver-dark">Users Mobile</span></div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="/pages/users.php">
                                        <div class="badge-circle grd-teal color-white"><i class="typicn-user"></i></div>
                                        <div class="action-text color-teal"><?php echo $payment->u_web; ?> <span class="helper-font-small color-silver-dark">Users Web</span></div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="/pages/invoice-detail.php?id=<?php echo $payment->id; ?>">
                                        <div class="badge-circle grd-orange color-white"></i>$</div>
                                        <div class="action-text color-orange"><?php echo $totalPrice; ?> <span class="helper-font-small color-silver-dark">Invoice</span></div>
                                    </a>
                                </li>

                            </ul>
                            <h2><i class="icofont-bookmark"></i> Monitor</h2>
                        </div><!-- /content-header -->