<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-8">
<h2>Transaction</h2>
<ol class="breadcrumb">
<li>
    <a href="index.html">Home</a>
</li>
<li>
    Marketplace
</li>
<li>
    <a href="marketplace/history">Order History</a>
</li>
<li class="active">
    <strong>Transaction</strong>
</li>
</ol>
</div>
<div class="col-lg-4">
<div class="title-action">
<a target="_blank" class="btn btn-primary" onClick="history.go(-1);return true;"><i class="fa fa-arrow-left"></i> Go Back </a>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="wrapper wrapper-content animated fadeInRight">
<div class="ibox-content p-xl">
    <div class="row">
        <div class="col-sm-6">
            <h5>From:</h5>
            <address>
            <?php if($sellerinvoice=comapny_info($invoice->seller_id)){?>
                <strong><?php echo $sellerinvoice->company_name;?></strong><br>
                <?php echo $sellerinvoice->address_line_1;?><br>
                <?php echo $sellerinvoice->town_city;?><br>
                <?php echo $sellerinvoice->county;?><br>
                <?php echo $sellerinvoice->post_code;?><br>
                <?php echo $sellerinvoice->country;
                }?>
            </address>
        </div>

        <div class="col-sm-6 text-right">
            <h4>Transaction No.</h4>
            <h4 class="text-navy"><?php echo $invoice->invoice_no;?></h4>
            <span>To:</span>
            <address>
                 <?php if($buyerinvoice=comapny_info($invoice->buyer_id)){?>
                <strong><?php echo $buyerinvoice->company_name;?></strong><br>
                <?php echo $buyerinvoice->address_line_1;?><br>
                <?php echo $buyerinvoice->town_city;?><br>
                <?php echo $buyerinvoice->county;?><br>
                <?php echo $buyerinvoice->post_code;?><br>
                <?php echo $buyerinvoice->country;
                }?>
            </address>
            <p>
                <span><strong>Transaction Date:</strong> <?php echo date('d-M-y, H:i', strtotime($invoice->shipping_recevied_datetime)); ?></span><br/>
               
            </p>
        </div>
    </div>

    <div class="table-responsive m-t">
        <table class="table invoice-table">
            <thead>
            <tr>
                <th>Item List</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Shipping</th>
                <th>Total Price</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td width="60%"><div><strong><?php echo $invoice->product_mpn_isbn.' '.$invoice->product_make.' '.$invoice->product_model.' '.$invoice->product_type.' '.$invoice->product_color;?></strong></div>
                    <small><?php echo $invoice->product_desc;?></small></td>
                <td><?php echo $invoice->product_qty;?></td>
                <td><?php echo $invoice->unit_price;?></td>
                <td><?php echo $invoice->shipping_price;?></td>
                <td><?php echo $invoice->total_price;?></td>
            </tr>
            </tbody>
        </table>
    </div><!-- /table-responsive -->

    <table class="table invoice-total">
        <tbody>
        <tr>
            <td><strong>Sub Total :</strong></td>
            <td><?php echo currency_class($invoice->buyer_currency).' '.($invoice->total_price - $invoice->shipping_price);?></td>
        </tr>
        <!-- <tr>
            <td><strong>TAX/VAT :</strong></td>
            <td>&pound;190.00</td>
        </tr> -->
        <tr>
            <td><strong>Shipping :</strong></td>
            <td><?php echo currency_class($invoice->buyer_currency).' '.$invoice->shipping_price;?></td>
        </tr>
        <tr>
            <td><strong>TOTAL :</strong></td>
            <td><?php echo currency_class($invoice->buyer_currency).' '.$invoice->total_price;?></td>
        </tr>
        </tbody>
    </table>
    <p class="small">This is just a transaction receipt and not a tax/vat invoice</p>
    <div class="text-right">
    	<span  onclick="myFunction()" class="btn btn-primary"><i class="fa fa-print"></i> Print Transaction </span>
    </div>
</div>
</div>
</div>

<script>
function myFunction() {
    window.print();
}
</script>
<!-- Mainly scripts -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
