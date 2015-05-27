<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>All Offers</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                Marketplace
            </li>
            <li class="active">
                <strong>Offers</strong>
            </li>
        </ol>
    </div>
</div>
<?php $id = $this->session->userdata('members_id');$member = $this->member_model->get_where($id);
if($member->membership > 1 && $member->marketplace == 'active'){ ?>

<?php msg_alert(); 
$member_id=$this->session->userdata('members_id');?>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Buying Request</h5>
        </div>
        <div class="ibox-content">
        <table class="table table-striped table-bordered table-hover selling_offers" >
        <thead>
        <tr>
            <th>Status</th>
            <th>End Date</th>
			<th>Make &amp; Model + Additional</th>
            <th>Product Type</th>
            <th>Condition</th>
            <th>Price</th>
            <th>QTY</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
            <?php if(!empty($seller_offer)):
            
            foreach ($seller_offer as $value):
            $offer_count = offer_count($value->id); ?>
            <tr onclick="document.location = 'view_offer(<?php echo $value->id; ?>,1)';" style="cursor:pointer">
                <td class="text-center">
                <?php if($value->member_id==$member_id){?>
                <span class="label label-info">
                Offers Waiting (<?php echo $offer_count; ?>)
                </span>
                <?php } else{
                    echo"<span class='label label-warning'>Offers Sent</sapn>";
                    }?>
                </td>
                <td><?php echo date('d-M, H:i', strtotime($value->listing_end_datetime)); ?></td>
				<td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?> <?php if ($value->device_capacity > 0) { ?><?php echo $value->device_capacity; ?><?php } ?> <?php if ($value->spec > 0) { ?><?php echo $value->spec; ?><?php } ?> <?php if(!empty($value->product_mpn_isbn)){ echo '('.$value->product_mpn_isbn.')'; } ?></td>
                <td><?php echo $value->product_type; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="&pound; <?php echo get_currency(currency_class($value->currency), 'GBP', $value->unit_price); ?>,&euro; <?php echo get_currency(currency_class($value->currency), 'EUR', $value->unit_price); ?>,$ <?php echo get_currency(currency_class($value->currency), 'USD', $value->unit_price); ?>"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->qty_available; ?></td>
                <td class="text-center">
                <a class="btn btn-info" onclick="view_offer(<?php echo $value->id; ?>,1)" data-toggle="modal" data-target="#buyer_offers"><i class="fa fa-paste"></i> View Offer </a>
                </td>
            </tr>
            <?php endforeach ?>
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
            <h5>Selling Offer</h5>
        </div>
        <div class="ibox-content">
        <table class="table table-striped table-bordered table-hover buying_requests" >
        <thead>
        <tr>
            <th>Status</th>
            <th>End Date</th>
            <th>Make &amp; Model + Additional</th>
            <th>Condition</th>
            <th>Condition</th>
            <th>Price</th>
            <th>QTY</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($buying_request)):
            foreach ($buying_request as $value):
            $offer_count = offer_count($value->id); ?>
            <tr onclick="document.location = 'view_offer(<?php echo $value->id; ?>,1)';" style="cursor:pointer">
                <td class="text-center">
                
                <?php if($value->member_id==$member_id){?>
                <span class="label label-info">
                Offers Waiting (<?php echo $offer_count; ?>)
                </span>
                <?php } else{
                    echo"<span class='label label-warning'>Offers Sent</sapn>";
                    }?>
                </td>
                <td><?php echo date('d-M, H:i', strtotime($value->listing_end_datetime)); ?></td>
				<td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?> <?php if ($value->device_capacity > 0) { ?><?php echo $value->device_capacity; ?><?php } ?> <?php if ($value->spec > 0) { ?><?php echo $value->spec; ?><?php } ?> <?php if(!empty($value->product_mpn_isbn)){ echo '('.$value->product_mpn_isbn.')'; } ?></td>
                <td><?php echo $value->product_type; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="&pound; <?php echo get_currency(currency_class($value->currency), 'GBP', $value->unit_price); ?>,&euro; <?php echo get_currency(currency_class($value->currency), 'EUR', $value->unit_price); ?>,$ <?php echo get_currency(currency_class($value->currency), 'USD', $value->unit_price); ?>"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->qty_available; ?></td>
                <td class="text-center">
                <a onclick="view_offer(<?php echo $value->id; ?>,1)" class="btn btn-info"  data-toggle="modal" data-target="#view_offers"><i class="fa fa-paste"></i> View Offer </a>
                </td>
            </tr>
            <?php endforeach ?>
        <?php endif; ?>   
        </tbody>
        </table>
        </div>
    </div>
    </div>
                    
    <div class="modal inmodal fade" id="buyer_offers" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Buying Request</h4>
                </div>
                <div class="modal-body">
                   
                    <div class="view_offer_content"></div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> 
    <div class="modal inmodal fade" id="view_offers" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Selling Offers</h4>
                </div>
                <div class="modal-body">
                    <div class="view_offer_content"></div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>  
    
    <div class="modal inmodal fade" id="form_counter_section" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-sm">
    <div class="modal-content">
  <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-title">Counter offer</h4>
  </div>
  <div class="modal-body">
   <form action="<?php echo base_url()."marketplace/counter_offer/";?>" method="post" accept-charset="utf-8">
      <div class="row">
      Quantity
        <input type="text" name="qty" value="" placeholder="Quantity" class="form-control offer_qty_insert">
        <input type="hidden" name="offer_id" value="" class="offer_id_insert"><br>
        Per Unit Price
        <input type="text" name="per_unit_price" value="" placeholder="Per unit price" class="form-control offer_unit_price_insert">
    </div>
    <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Send Offer</button>
    </div>  
    </form>
    </div>
  </div>
</div>
</div>
</div>
    


<?php } else {?>
<?php if($member->membership == 1 ){ ?>
            <div class="alert alert-info" style="margin:15px 15px -15px">
        <p><i class="fa fa-info-circle"></i> <strong>This is a Demo</strong> Silver members and above with criteria met will have access to the live marketplace. You can search by product category and make/model, if you are looking to narrow your results down further you can view the advanced search options. Any extra details you need can be found by clicking on the <i class="fa fa-question-circle cursor"></i> icons. This section of the marketplace displays all offers companies on GSMStockMarket would like to buy and whom you can sell your stocks too. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
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
            <h5>Buying Requests</h5>
        </div>
        <div class="ibox-content">
        <table class="table table-striped table-bordered table-hover buying_requests" >
        <thead>
        <tr>
            <th>Status</th>
            <th>End Date</th>
            <th>Make &amp; Model</th>
            <th>Condition</th>
            <th>Price</th>
            <th>QTY</th>
            <th>Spec</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"><span class="label label-info">Offers Waiting (1)</span></td>
                <td><span><?php echo date("d-M, H:i", time()+492000); ?></span></td>
                <td>Nokia Lumia 640 XL</td>
                <td>Refurbished</td>
                <td>GBP 112</td>
                <td>95</td>
                <td>US</td>
                <td class="text-center"><button type="button" class="btn btn-info" style="font-size:10px"><i class="fa fa-paste" data-toggle="modal" data-target="#upgrade"></i> View Offer</button></td>
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
            <h5>Selling Offers</h5>
        </div>
        <div class="ibox-content">
        <table class="table table-striped table-bordered table-hover selling_offers" >
        <thead>
        <tr>
            <th>Status</th>
            <th>End Date</th>
            <th>Make &amp; Model</th>
            <th>Condition</th>
            <th>Price</th>
            <th>QTY</th>
            <th>Spec</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody> 
            <tr>
                <td class="text-center"><span class="label label-info">Offers Waiting (9)</span></td>
                <td><span><?php echo date("d-M, H:i", time()+96000); ?></span></td>
                <td>Samsung Galaxy S4 (i9500)</td>
                <td>New</td>
                <td>GBP 125</td>
                <td>350</td>
                <td>UK</td>
                <td class="text-center"><button type="button" class="btn btn-info" style="font-size:10px" data-toggle="modal" data-target="#upgrade""><i class="fa fa-paste"></i> View Offer</button></td>
            </tr>
            <tr>
                <td class="text-center"><span class="label label-info">Offers Waiting (4)</span></td>
                <td><span><?php echo date("d-M, H:i", time()+112000); ?></span></td>
                <td>Samsung Galaxy S3 (i9300)</td>
                <td>Used Grade A</td>
                <td>GBP 45</td>
                <td>50</td>
                <td>EU</td>
                <td class="text-center"><button type="button" class="btn btn-info" style="font-size:10px" data-toggle="modal" data-target="#upgrade"><i class="fa fa-paste"></i> View Offer</button></td>
            </tr>
            <tr>
                <td class="text-center"><span class="label label-info">Offers Waiting (1)</span></td>
                <td><span><?php echo date("d-M, H:i", time()+252000); ?></span></td>
                <td>Apple iPhone 5</td>
                <td>New</td>
                <td>GBP 112</td>
                <td>200</td>
                <td>EU</td>
                <td class="text-center"><button type="button" class="btn btn-info" style="font-size:10px" data-toggle="modal" data-target="#upgrade"><i class="fa fa-paste"></i> View Offer</button></td>
            </tr>
        </tbody>
        </table>
        </div>
    </div>
</div>
</div>    
    
<?php 

} ?> 
    
    
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
        $('.selling_offers').dataTable({
            responsive: true,
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "public/main/template/core/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
            }
        });
        $('.buying_requests').dataTable({
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
/*offer active class*/
#offer_status_accept{
background-color: #18a689;
border-color: #18a689;
color: #fff;
}
/*offer declined class*/
#offer_status_declined{
background-color: #ec4758;
border-color: #ec4758;
color: #fff;
}
.btn{
    font-size: 10px;
}
</style>
<script>
    function get_buyers_offer(listing_id) {
        var list = listing_id;
       $.post('<?php echo base_url() ?>marketplace/get_buyers_offer', {listing_id: list}, function(data) {
           $('#buyers_list').html(data);
       });
    }
    function view_offer(listing_id,status) {
        var setstatus=status;
        var list = listing_id;
       $.post('<?php echo base_url() ?>marketplace/view_offer', {listing_id: list,status:setstatus}, function(data) {
           $('.view_offer_content').html(data);
       });
    }
    function offer_status(listing_id, buyer_id) {
        var list = listing_id;
        var buyer_id = buyer_id;
       $.post('<?php echo base_url() ?>marketplace/offer_status', {listing_id: list, buyer_id: buyer_id}, function(data) {
           $('#offer_status_msg').html(data);
       });
    }
     function counter_offer(offer_id,qty,unit_price) {
        $('.offer_id_insert').val(offer_id);
        $('.offer_qty_insert').val(qty);
        $('.offer_unit_price_insert').val(unit_price);  
    }
</script>

<script src="public/admin/js/jquery.countdown.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $('[data-countdown]').each(function() {
       var $this = $(this), finalDate = $(this).data('countdown');
       $this.countdown(finalDate, function(event) {
         $this.html(event.strftime('%Dd %Hh %Mm %Ss'));
       });
     });
});
</script>