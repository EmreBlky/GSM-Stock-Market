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
        <td><?php echo $value->company_name;?></td>
        <td><?php echo $value->product_qty;?></td>
        <td style="text-align:right"><?php echo $value->shipping_price;?></td>
       
        <td style="text-align:right"><?php echo $value->total_price;?></td>
        <td>  <?php echo currency_class($value->buyer_currency); ?>   </td>
        <th style="text-align:center"><a href="marketplace/invoice/"<?php echo $value->id?>><button type="button" class="btn btn-primary" style="font-size:10px">View Transaction</button></a></th>
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
        <td><?php echo $value->company_name;?></td>
        <td><?php echo $value->product_qty;?></td>
        <td style="text-align:right"><?php echo $value->shipping_price;?></td>
       
        <td style="text-align:right"><?php echo $value->total_price;?></td>
        <td>  <?php echo currency_class($value->buyer_currency); ?>   </td>
        <th style="text-align:center"><a class="btn btn-primary" href="marketplace/invoice/<?php echo $value->invoice_no;?>">View Transaction</a></th>
    </tr>
    <?php } } ?></tbody>
    </table>

    </div>
</div>
</div>
</div>

</div>

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