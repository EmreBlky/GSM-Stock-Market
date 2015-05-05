<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2>Order History</h2>
<ol class="breadcrumb">
    <li>
        <a href="/">Home</a>
    </li>
    <li>
        Marketplace
    </li>
    <li class="active">
        <strong>Order History</strong>
    </li>
</ol>
</div><!-- /col-lg-10 -->
<div class="col-lg-2">
</div><!-- /col-lg-2 spacer -->
</div>
<?php $memberidlogin =  $this->session->userdata('members_id');
$id = $this->session->userdata('members_id');$member = $this->member_model->get_where($id);
if($member->membership > 1 && $member->marketplace == 'active'){ ?>

<?php msg_alert(); ?>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>View Buy Transactions</h5>
    </div>
    <div class="ibox-content">

    <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
    <tr>
        <th>Inv No</th>
        <th>Date</th>
        <th>Seller</th>
        <th>Quantity</th>
        <th>Shipping</th>
        <th>Total</th>
        <th>Currency</th>
        <th>View Transaction</th>
    </tr>
    </thead>
    <tbody>
      <?php if(!empty($buy_order)){
        foreach ($buy_order as $value){ ?>
    <tr>
        <td><?php echo $value->invoice_no;?></td>
        <td><?php echo date('d-M-y, H:i', strtotime($value->shipping_recevied_datetime)); ?></td>
        <td><?php 
            $seller_cmp_info='';
            if($memberidlogin == $value->buyer_id){
              $seller_cmp_info=comapny_info($value->seller_id);
            }else{
              $seller_cmp_info=comapny_info($value->buyer_id);
            }
            echo $seller_cmp_info->company_name; ?></td>
        <td><?php echo $value->product_qty;?></td>
        <td style="text-align:right"><?php echo $value->shipping_price;?></td>
       
        <td style="text-align:right"><?php echo $value->total_price;?></td>
        <td>  <?php echo currency_class($value->buyer_currency); ?>   </td>
        <th style="text-align:center"><a class="btn btn-primary" href="marketplace/invoice/<?php echo $value->id?>">View Transaction</a></th>
    </tr>
    <?php } } ?></tbody>
    </table>

    </div>
</div>
</div>

<div class="col-lg-12">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>View Sell Transactions</h5>
    </div>
    <div class="ibox-content">

    <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
    <tr>
        <th>Inv No</th>
        <th>Date</th>
        <th>Buyer</th>
        <th>Quantity</th>
        <th>Shipping</th>
        <th>Total</th>
        <th>Currency</th>
        <th>View Transaction</th>
    </tr>
    </thead>
    <tbody>
      <?php if(!empty($sell_order)){
        foreach ($sell_order as $value){ ?>
    <tr>
        <td><?php echo $value->invoice_no;?></td>
        <td><?php echo date('d-M-y, H:i', strtotime($value->shipping_recevied_datetime)); ?></td>
        <td><?php 
            $seller_cmp_info='';
            if($memberidlogin == $value->buyer_id){
              $seller_cmp_info=comapny_info($value->seller_id);
            }else{
              $seller_cmp_info=comapny_info($value->buyer_id);
            }
            echo $seller_cmp_info->company_name; ?></td>
        <td><?php echo $value->product_qty;?></td>
        <td style="text-align:right"><?php echo $value->shipping_price;?></td>
       
        <td style="text-align:right"><?php echo $value->total_price;?></td>
        <td>  <?php echo currency_class($value->buyer_currency); ?>   </td>
        <th style="text-align:center"><a class="btn btn-primary" href="marketplace/invoice/<?php echo $value->id;?>">View Transaction</a></th>
    </tr>
    <?php } } ?></tbody>
    </table>

    </div>
</div>
</div>
</div>

</div>



<?php } else { ?>
<?php if($member->membership == 1 ){ ?>
            <div class="alert alert-info" style="margin:15px 15px -15px">
        <p><i class="fa fa-info-circle"></i> <strong>This is a Demo</strong> Silver members and above with criteria met will have access to the live marketplace. We provide a transaction history log you can export or view individually and print off for your own records. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
            </div>

<?php } else if($member->membership == 2 && $member->marketplace == 'inactive'){?>
            <div class="alert alert-warning" style="margin:15px 15px -15px">
                <p><i class="fa fa-warning"></i> You still need to supply 2 trade references so we can enable your membership to view profiles and access the marketplace. <a class="alert-link" href="tradereference">Submit trade references</a>.</p>
            </div>

<?php }?>

<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">

<div class="col-lg-12">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>View Sell Transactions (Items Sold)</h5>
    </div>
    <div class="ibox-content">

    <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
    <tr>
        <th>Inv No</th>
        <th>Date</th>
        <th>Seller</th>
        <th>Quantity</th>
        <th>Shipping</th>
        <th>Total</th>
        <th>Currency</th>
        <th>View Transaction</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>GSM-5-1</td>
        <td>26th April 2015</td>
        <td>Buying Company Liimited</td>
        <td>1000</td>
        <td style="text-align:right">0</td>
        <td style="text-align:right">25,000</td>
        <td>GBP</td>
        <th style="text-align:center"><button type="button" class="btn btn-primary" style="font-size:10px">View Transaction</button></th>
    </tr>
    <tr>
        <td>GSM-5-2</td>
        <td>27th April 2015</td>
        <td>Buying Company Liimited</td>
        <td>95</td>
        <td style="text-align:right">50</td>
        <td style="text-align:right">2,340</td>
        <td>GBP</td>
        <th style="text-align:center"><button type="button" class="btn btn-primary" style="font-size:10px">View Transaction</button></th>
    </tr>
    <tr>
        <td>GSM-5-2</td>
        <td>29th April 2015</td>
        <td>Buying Company Liimited</td>
        <td>340</td>
        <td style="text-align:right">0</td>
        <td style="text-align:right">13,250</td>
        <td>GBP</td>
        <th style="text-align:center"><button type="button" class="btn btn-primary" style="font-size:10px">View Transaction</button></th>
    </tr>
    </tbody>
    </table>

    </div>
</div>
</div>

<div class="col-lg-12">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>View Buy Transactions (Items Bought)</h5>
    </div>
    <div class="ibox-content">

    <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
    <tr>
        <th>Inv No</th>
        <th>Date</th>
        <th>Seller</th>
        <th>Quantity</th>
        <th>Shipping</th>
        <th>Total</th>
        <th>Currency</th>
        <th>View Transaction</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>GSM-271-9</td>
        <td>29 April 2015</td>
        <td>Selling Company Liimited</td>
        <td>2300</td>
        <td style="text-align:right">125</td>
        <td style="text-align:right">75,000</td>
        <td>USD</td>
        <th style="text-align:center"><button type="button" class="btn btn-primary" style="font-size:10px">View Transaction</button></th>
    </tr>
    </tbody>
    </table>

    </div>
</div>
</div>
</div>

</div>

<?php } ?>



<!-- Data Tables -->
<link href="public/main/template/core/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

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
});
</script>

<style>
body.DTTT_Print { background: #fff;}
.DTTT_Print #page-wrapper {margin: 0;background:#fff;}
button.DTTT_button, div.DTTT_button, a.DTTT_button {border: 1px solid #e7eaec;background: #fff;color: #676a6c;box-shadow: none;padding: 6px 8px;}
button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {border: 1px solid #d2d2d2;background: #fff;color: #676a6c;box-shadow: none;padding: 6px 8px;}
.dataTables_filter label {margin-right: 5px;}
</style>