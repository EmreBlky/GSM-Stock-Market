<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Open Orders</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                Marketplace
            </li>
            <li class="active">
                <strong>Open Orders</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<?php
$memberidlogin = $this->session->userdata('members_id');

$id = $this->session->userdata('members_id');
$member = $this->member_model->get_where($id);
if ($member->membership > 1 && $member->marketplace == 'active') {
    ?>

    <?php msg_alert(); ?>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Open Orders - Item you are buying</h5>
                    </div>
                    <div class="ibox-content">

                        <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Seller</th>
                                    <th>Product</th>
                                    <th>Product Type</th>
                                    <th>Condition</th>
                                    <th>Price</th>
                                    <th>Progress</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($buy_order)): ?>
                                    <?php foreach ($buy_order as $value): ?>
                                        <tr>
                                            <?php
                                            if ($value->order_status == 0) {
                                                $progress = "0%";
                                                ?>
                                                <td><span class="label label-primary">Awaiting Payment Info</span></td>
                                                <?php
                                            } elseif ($value->order_status == 1) {
                                                if (empty($value->payment_done)) {
                                                    $progress = "25%";
                                                    ?>
                                                    <td><span class="label label-warning">Awaiting Payment</span></td>
                                                    <?php
                                                } else {
                                                    $progress = "50%";
                                                    ?>
                                                    <td><span class="label label-primary">Awaiting Payment Confirmation</span></td>
                                                    <?php
                                                }
                                            } elseif ($value->order_status == 2) {
                                                $progress = "50%"
                                                ?>
                                                <td><span class="label label-primary">Payment Sent</span></td>
                                                <?php
                                            } elseif ($value->order_status == 3) {
                                                $progress = "75%"
                                                ?>
                                                <td><span class="label label-warning">Awaiting Shipment confirmation</span></td>
                                                <?php
                                            } elseif ($value->order_status == 4) {
                                                $progress = "100%"
                                                ?>
                                                <td><span class="label label-primary">Shipment Arrived</span></td>
                                            <?php } ?>
                                            <td><?php
                                                $seller_cmp_info = '';
                                                if ($memberidlogin == $value->buyer_id) {
                                                    $seller_cmp_info = comapny_info($value->seller_id);
                                                } else {
                                                    $seller_cmp_info = comapny_info($value->buyer_id);
                                                }
                                                echo $seller_cmp_info->company_name;
                                                ?></td>
                                            <td><?php echo $value->product_make; ?></td>
                                            <td><?php echo $value->product_type; ?></td>
                                            <td><?php echo $value->condition; ?></td>
                                            <td data-toggle="tooltip" data-placement="left" title="mouseover currency"><?php echo currency_class($value->currency) . ' ' . $value->unit_price; ?></td>
                                            <td class="project-completion">
                                                <small><?php echo $progress ?> Complete</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: <?php echo $progress ?>;" class="progress-bar"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <a onclick="deal_info(<?php echo $value->listing_id; ?>,<?php echo $value->makeofferid; ?>, 1)" data-toggle="modal" data-target="#deal_infos" class="btn btn-primary" >Deal Info</a>
                                                <?php if ($value->order_status == 1 && empty($value->payment_done)) {
                                                    ?>
                                                    <a onclick="insert_order_id(<?php echo $value->makeofferid; ?>)" data-toggle="modal" data-target="#payment_done" class="btn btn-warning" >Make Payment</a>
                                                    <!-- modal paymment info -->

                                                <?php } elseif ($value->order_status == 3) { ?>
                                                    <a onclick="insert_order_id(<?php echo $value->makeofferid; ?>)" data-toggle="modal" data-target="#shipping_received"  class="btn btn-warning" >Shipment Confirm</a><!-- only status change -->

                                                    <?php
                                                } elseif ($value->order_status == 4 && empty($value->buyer_feedback)) {
                                                    if (empty($value->buyer_feedback)) {
                                                        ?>
                                                        <a onclick="insert_order_id(<?php echo $value->makeofferid; ?>)" data-toggle="modal" data-target="#buyer_feedback" class="btn btn-info">Leave Feedback</a>
                                                        <!-- modal leave feedback buyer-->
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $this->load->module('feedback');
                                        $this->feedback->leave_buy_feedback($value->seller_id, $value->buyer_id, $value->makeofferid);
                                        ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Open Orders - Items you are selling</h5>
                    </div>
                    <div class="ibox-content">

                        <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Buyer</th>
                                    <th>Product</th>
                                    <th>Product Type</th>
                                    <th>Condition</th>
                                    <th>Price</th>
                                    <th>Progress</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($sell_order)): $progress = '0%'; ?>
                                    <?php foreach ($sell_order as $value): ?>
                                        <tr>
                                            <?php
                                            if ($value->order_status == 0) {
                                                $progress = "0%";
                                                ?>
                                                <td><span class="label label-primary">Awaiting Payment Info</span></td>
                                                <?php
                                            } elseif ($value->order_status == 1) {
                                                $progress = "25%";
                                                ?>
                                                <td><span class="label label-<?php if ($value->payment_done) { ?>warning<?php } else { ?>primary<?php } ?>">Awaiting Payment</span></td>
                                                <?php
                                            } elseif ($value->order_status == 2) {
                                                $progress = "50%"
                                                ?>
                                                <td><span class="label label-primary">Payment Received</span></td>
                                                <?php
                                            } elseif ($value->order_status == 3) {
                                                $progress = "75%"
                                                ?>
                                                <td><span class="label label-primary">Awaiting shipping conformation</span></td>
                                                <?php
                                            } elseif ($value->order_status == 4) {
                                                $progress = "100%"
                                                ?>
                                                <td><span class="label label-primary">Shipment Arrived</span></td>
                                            <?php } ?>
                                            <td>

                                                <?php
                                                $seller_cmp_info = '';
                                                if ($memberidlogin == $value->buyer_id) {
                                                    $seller_cmp_info = comapny_info($value->seller_id);
                                                } else {
                                                    $seller_cmp_info = comapny_info($value->buyer_id);
                                                }

                                                echo $seller_cmp_info->company_name;
                                                ?></td>
                                            <td><?php echo $value->product_make; ?></td>
                                            <td><?php echo $value->product_type; ?></td>
                                            <td><?php echo $value->condition; ?></td>
                                            <td data-toggle="tooltip" data-placement="left" title="mouseover currency"><?php echo currency_class($value->currency) . ' ' . $value->unit_price; ?></td>
                                            <td class="project-completion">
                                                <small><?php echo $progress ?> Complete</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: <?php echo $progress ?>;" class="progress-bar"></div>
                                                </div>
                                            </td>
                                            <td>
                                                <a onclick="deal_info(<?php echo $value->listing_id; ?>,<?php echo $value->makeofferid; ?>, 2)" data-toggle="modal" data-target="#deal_infos" class="btn btn-primary" >Deal Info</a>
                                                <?php if (empty($value->order_status)) { ?>
                                                    <a onclick="insert_order_id(<?php echo $value->makeofferid; ?>)" data-toggle="modal" data-target="#insert_payment_info" class="btn btn-warning">Send Payment details</a><!-- modal for send payment detail -->
                                                    <?php
                                                } elseif ($value->order_status == 1) {
                                                    if ($value->payment_done) {
                                                        ?>
                                                        <a onclick="insert_order_id(<?php echo $value->makeofferid; ?>)" data-toggle="modal" data-target="#payment_confirm" class="btn btn-warning" >Payment Confirm</a>
                                                    <?php } /* else{?>
                                                      <a class="btn btn-warning" >Awaiting Payment</a>
                                                      <?php } */ ?>
                                                    <!-- modal for payment confirm -->
                                                <?php } elseif ($value->order_status == 2) { ?>
                                                    <a onclick="insert_order_id(<?php echo $value->makeofferid; ?>)" data-toggle="modal" data-target="#add_tracking_shipping_info" class="btn btn-warning" >Add tracking / Shipping Info</a>
                                                    <!-- modal to add shipping information -->
                                                    <?php
                                                } elseif ($value->order_status == 4 && empty($value->seller_feedback)) {
                                                    if (empty($value->seller_feedback)) {
                                                        ?>
                                                        <a onclick="insert_order_id(<?php echo $value->makeofferid; ?>)" data-toggle="modal" data-target="#seller_feedback" class="btn btn-info">Leave Feedback</a>
                                                        <!-- modal leave feedback seller-->
                                                        <?php
                                                    }
                                                }
                                                ?></td>
                                        </tr>
                                        <?php
                                        $this->load->module('feedback');
                                        $this->feedback->leave_sell_feedback($value->buyer_id, $value->seller_id, $value->makeofferid);
                                        ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal inmodal fade" id="deal_infos" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <div id="deal_info_data"></div>
                    </div>
                </div>
            </div>

            <div class="modal inmodal fade" id="insert_payment_info" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Payment Information</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url() . "marketplace/insert_payment_info/"; ?>" method="post" accept-charset="utf-8">
                                <div class="row">
                                    <textarea name="payment_info" cols="8" rows="5" class="form-control" placeholder="Insert payment information."></textarea>
                                    <input type="hidden" name="order_id" value="" class="order_id_insert">
                                </div>

                                <div class="row">
                                    <input type="text" name="seller_reference" value="" class="form-control" placeholder="Reference">
                                </div>

                                <div class="row">
                                    <input type="file" style="padding-bottom:40px;" name="proforma_file" class="form-control" placeholder="Proforma File">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="send_msg">Send Payment information</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal inmodal fade" id="payment_done" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Payment Status</h4>

                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url() . "marketplace/payment_done/"; ?>" method="post" accept-charset="utf-8">
                                <div class="row">
                                    <?php if ($value->payment_detail) { ?>
                                        <h5>Payment Info - <?php echo $value->payment_detail; ?></h5> <?php } ?>
                                    <input type="checkbox" name="payment_done" value="" required>
                                    <h4>Yes I have done payment.</h4>
                                    <input type="hidden" name="order_id" value="" class="order_id_insert">
                                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary" id="send_msg">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal inmodal fade" id="shipping_received" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Shipping Status</h4>

                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url() . "marketplace/shipping_received/"; ?>" method="post" accept-charset="utf-8">
                                <div class="row">
                                    <?php if ($value->tracking_shipping) { ?>
                                        <h5>Tracking / shipping Info - <?php echo $value->tracking_shipping; ?></h5> <?php } ?>
                                    <input type="checkbox" name="shipping_received" value="" required>
                                    <h4>Yes I have recevied the items.</h4>
                                    <input type="hidden" name="order_id" value="" class="order_id_insert">
                                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary" id="send_msg">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal inmodal fade" id="payment_confirm" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Payment Confirmation & Add Tracking / shipping Information</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url() . "marketplace/payment_confirm/"; ?>" method="post" accept-charset="utf-8">
                                <div class="row">
                                    <input type="checkbox" name="payment_confirm" value="" required>
                                    <h4> Yes Payment received sucessfully.</h4>
                                    <textarea name="shipping_info" cols="8" rows="5" class="form-control" placeholder="Insert Tracking / Shipping information." required></textarea>
                                    <input type="hidden" name="order_id" value="" class="order_id_insert">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Add Tracking / shipping Information</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal inmodal fade" id="add_tracking_shipping_info" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Add Tracking / shipping Information</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url() . "marketplace/add_tracking_shipping_info/"; ?>" method="post" accept-charset="utf-8">
                                <div class="row">
                                    <textarea name="shipping_info" cols="8" rows="5" class="form-control" placeholder="Insert Tracking / Shipping information."></textarea>
                                    <input type="hidden" name="order_id" value="" class="order_id_insert">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="send_msg">Send Payment information</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php } else { ?>
            <?php if ($member->membership == 1) { ?>
                <div class="alert alert-info" style="margin:15px 15px -15px">
                    <p><i class="fa fa-info-circle"></i> <strong>This is a Demo</strong> Silver members and above with criteria met will have access to the live marketplace. This is our order management system, it can assist you in the progress of an order. Send payment details, add tracking information and check up on the status of your order. Labels in yellow are actions waiting on you and labels in green are actions waiting on the company you are trading with. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
                </div>

            <?php } else if ($member->membership == 2 && $member->marketplace == 'inactive') { ?>
                <div class="alert alert-warning" style="margin:15px 15px -15px">
                    <p><i class="fa fa-warning"></i> You still need to supply 2 trade references so we can enable your membership to view profiles and access the marketplace. <a class="alert-link" href="tradereference">Submit trade references</a>.</p>
                </div>

            <?php } ?>
            <div class="wrapper wrapper-content animated fadeInRight">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Open Orders - Item you are buying</h5>
                            </div>
                            <div class="ibox-content">

                                <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Seller</th>
                                            <th>Product</th>
                                            <th>Product Type</th>
                                            <th>Condition</th>
                                            <th>Progress</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><span class="label label-warning">Awaiting Your Payment</span></td>
                                            <td>Sales Company Limited</td>
                                            <td>Apple iPhone 4</td>
                                            <td>LCD</td>
                                            <td>Used Grade A</td>
                                            <td class="project-completion">
                                                <small>25% Complete</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 25%;" class="progress-bar"></div>
                                                </div>
                                            </td>
                                            <td><button type="button" class="btn btn-primary" style="font-size:10px" data-toggle="modal" data-target="#upgrade">Deal Info</button> <button type="button" class="btn btn-warning" style="font-size:10px" data-toggle="modal" data-target="#upgrade">Make Payment</button></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><span class="label label-primary">Payment Sent</span></td>
                                            <td>Sales Company Limited</td>
                                            <td>HTC One X</td>
                                            <td>Handsets</td>
                                            <td>New</td>
                                            <td class="project-completion">
                                                <small>50% Complete</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 50%;" class="progress-bar"></div>
                                                </div>
                                            </td>
                                            <td><button type="button" class="btn btn-primary" style="font-size:10px" data-toggle="modal" data-target="#upgrade">Deal Info</button></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><span class="label label-warning">Shipment Sent</span></td>
                                            <td>Sales Company Limited</td>
                                            <td>Samsung Galaxy S2 (i9100)</td>
                                            <td>LCD</td>
                                            <td>Used Grade B</td>
                                            <td class="project-completion">
                                                <small>75% Complete</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 75%;" class="progress-bar"></div>
                                                </div>
                                            </td>
                                            <td><button type="button" class="btn btn-primary" style="font-size:10px" data-toggle="modal" data-target="#upgrade">Deal Info</button> <button type="button" class="btn btn-warning" style="font-size:10px" data-toggle="modal" data-target="#upgrade">Items Received</button></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Open Orders - Items you are selling</h5>
                            </div>
                            <div class="ibox-content">

                                <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Buyer</th>
                                            <th>Product</th>
                                            <th>Product Type</th>
                                            <th>Condition</th>
                                            <th>Progress</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><span class="label label-primary">Awaiting Payment</span></td>
                                            <td>Buying Company Limited</td>
                                            <td>Nokia Lumia 810</td>
                                            <td>LCD</td>
                                            <td>Used Grade C</td>
                                            <td class="project-completion">
                                                <small>25% Complete</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 25%;" class="progress-bar"></div>
                                                </div>
                                            </td>
                                            <td><button type="button" class="btn btn-primary" style="font-size:10px" data-toggle="modal" data-target="#upgrade">Deal Info</button></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><span class="label label-primary">Deal Complete</span></td>
                                            <td>Buying Company Limited</td>
                                            <td>Nokia Lumia 815</td>
                                            <td>Handsets</td>
                                            <td>Refurbished</td>
                                            <td class="project-completion">
                                                <small>100% Complete</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 100%;" class="progress-bar"></div>
                                                </div>
                                            </td>
                                            <td><button type="button" class="btn btn-primary" style="font-size:10px" data-toggle="modal" data-target="#upgrade">Deal Info</button> <button type="button" class="btn btn-info" style="font-size:10px" data-toggle="modal" data-target="#upgrade">Leave Feedback</button></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
        <script>
            function deal_info(listing_id, order_id, status) {
                var list = listing_id;
                $.post('<?php echo base_url() ?>marketplace/deal_info/' + listing_id + '/' + order_id + '/' + status, function(data) {
                    $('#deal_info_data').html(data);
                });
            }

            function insert_order_id(order_id) {
                $('.order_id_insert').val(order_id);
            }
        </script>


        <!-- Data Tables -->
        <link href="public/main/template/core/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
        <link href="public/main/template/core/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
        <link href="public/main/template/core/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

        <!-- Multi Select -->
        <link href="public/main/template/core/css/plugins/chosen/chosen.css" rel="stylesheet">

        <!-- Feedback Stars -->
        <link rel="stylesheet" href="public/main/template/gsm/css/star-rating.min.css" rel="stylesheet">
        <script type="text/javascript" src="public/main/template/gsm/js/star-rating.min.js"></script>
        <script>
            jQuery(document).ready(function() {
                $('.rb-rating').rating({'showCaption': true, 'stars': '5', 'min': '0', 'max': '5', 'step': '1', 'size': 'xs', 'starCaptions': {0: 'Very Poor', 1: 'Very Poor', 2: 'Poor', 3: 'Average', 4: 'Good', 5: 'Excellent'}});
            });
        </script>

        <!-- Data Tables -->
        <script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.responsive.js"></script>
        <script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.tableTools.min.js"></script>

        <!-- Chosen -->
        <script src="public/main/template/core/js/plugins/chosen/chosen.jquery.js"></script>


        <!-- Page-Level Scripts -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('.dataTables-example').dataTable({
                    responsive: true,
                    "dom": 'T<"clear">lfrtip',
                    "tableTools": {
                        "sSwfPath": "public/main/template/core/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                    }
                });
                /* multi select */
                var config = {
                    '.chosen-select': {search_contains: true},
                    '.chosen-select-deselect': {allow_single_deselect: true},
                    '.chosen-select-no-single': {disable_search_threshold: 10},
                    '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
                    '.chosen-select-width': {width: "95%"}
                }
                for (var selector in config) {
                    $(selector).chosen(config[selector]);
                }

            });
        </script>

        <style>
            body.DTTT_Print { background: #fff;}
            .DTTT_Print #page-wrapper {margin: 0;background:#fff;}
            button.DTTT_button, div.DTTT_button, a.DTTT_button {border: 1px solid #e7eaec;background: #fff;color: #676a6c;box-shadow: none;padding: 6px 8px;}
            button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {border: 1px solid #d2d2d2;background: #fff;color: #676a6c;box-shadow: none;padding: 6px 8px;}
            .dataTables_filter label {margin-right: 5px;}


            /* chosen css override */
            .chosen-container-multi .chosen-choices li.search-field input[type="text"] {font-family:inherit;font-size:14px}
            .chosen-container-multi .chosen-choices {border-radius:5px;border:1px solid #e5e6e7}
            .chosen-container-multi .chosen-choices li.search-choice {color:#FFF;background:#1ab394}
            .btn{
                font-size: 10px;
            }
        </style>
