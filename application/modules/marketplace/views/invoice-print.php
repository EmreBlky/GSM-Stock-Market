

<div class="wrapper wrapper-content p-xl">
<div class="ibox-content p-xl">
        <div class="row">
            <div class="col-sm-6">
                <h5>From:</h5>
                <?php if($sellerinvoice=comapny_info($invoice->seller_id)){?>
                <strong><?php echo $sellerinvoice->company_name;?></strong><br>
                <?php echo $sellerinvoice->address_line_1;?><br>
                <?php echo $sellerinvoice->town_city;?><br>
                <?php echo $sellerinvoice->county;?><br>
                <?php echo $sellerinvoice->post_code;?><br>
                <?php echo $sellerinvoice->country;
                }?>
            </div>

            <div class="col-sm-6 text-right">
                <h4>Transaction ID.</h4>
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
                    <span><strong>Due Date:</strong> March 24, 2014</span>
                </p>
            </div>
        </div>

        <div class="table-responsive m-t">
            <table class="table invoice-table">
                <thead>
                <tr>
                    <th>Item List</th>
                    <th>Quantity</th>
                    <th>Unit Price</th><!--
                    <th>Tax</th>-->
                    <th>Total Price</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                     <td width="60%"><div><strong><?php echo $invoice->product_mpn_isbn.' '.$invoice->product_make.' '.$invoice->product_model.' '.$invoice->product_type.' '.$invoice->product_color;?></strong></div>
                    <small><?php echo $invoice->product_desc;?></small></td>
                <td><?php echo $invoice->product_qty;?></td>
                <td><?php echo $invoice->unit_price;?></td><?php /*
                <td><?php echo $invoice->shipping_price;?></td> */ ?>
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
    </div>

<script>
function myFunction() {
    window.print('marketplace/invoice_print');
}
</script>

<!-- Mainly scripts -->
<script src="public/main/template/core/js/jquery-2.1.1.js"></script>
<script src="public/main/template/core/js/bootstrap.min.js"></script>
<script src="public/main/template/core/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Custom and plugin javascript -->
<script src="public/main/template/core/js/inspinia.js"></script>
