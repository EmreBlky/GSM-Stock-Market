<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>My Listings</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                Marketplace
            </li>
            <li class="active">
                <strong>My Listings</strong>
            </li>
        </ol>
    </div>
</div>
<?php $id = $this->session->userdata('members_id');$member = $this->member_model->get_where($id);
if($member->membership > 1 && $member->marketplace == 'active'){ ?>
<?php msg_alert(); ?>
<div class="wrapper wrapper-content animated fadeInRight">

<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
    <h5>Buying Requests</h5>
</div>
<div class="ibox-content">
<table class="table table-striped table-bordered table-hover selling_offers" >
<thead>
<tr>
    <th>Status</th>
    <th>Start Date</th>
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
<?php if(!empty($sell_offer)): 
$session_member_id = $this->session->userdata('members_id'); ?>
    <?php foreach ($sell_offer as $value):
    $offer_count = offer_count($value->id); ?>
    <tr>
        <td class="text-center">
        <?php  
            $current_datetime = strtotime(date('d-m-Y H:i:s')); 
            $end_datetime = strtotime(date('d-m-Y H:i:s', strtotime($value->listing_end_datetime))); 
            $start_datetime = strtotime(date('d-m-Y H:i:s', strtotime($value->schedule_date_time))); 
           
            if($current_datetime > $end_datetime){
                ?> <span class="label label-danger">Ended</span><?php
            } elseif($current_datetime >= $start_datetime){?>
                <span class="label label-primary">Active</span>
       <?php }else{ if($value->scheduled_status){ ?>
                <span class="label label-success">Scheduled</span>
            <?php }}?>
        </td>
        <td><?php echo date('d-M-y, H:i', strtotime($value->schedule_date_time)); ?></td>
        <td><?php echo date('d-M-y, H:i', strtotime($value->listing_end_datetime)); ?></td>
        <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
        <td><?php echo $value->condition; ?></td>
        <td data-toggle="tooltip" data-placement="left" title="&pound; <?php echo get_currency(currency_class($value->currency), 'GBP', $value->unit_price); ?>,&euro; <?php echo get_currency(currency_class($value->currency), 'EUR', $value->unit_price); ?>,$ <?php echo get_currency(currency_class($value->currency), 'USD', $value->unit_price); ?>"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
        <td><?php echo $value->qty_available; ?></td>
        <td><?php echo $value->spec; ?></td>
        <th class="text-center">
         <a href="<?php echo base_url().'marketplace/buy_listing/'.$value->id; ?>" class="btn btn-warning" ><i class="fa fa-paste"></i> Edit</a>
        <?php 
         if($end_datetime > $current_datetime){ ?>
        <a href="<?php echo base_url().'marketplace/listing_detail/'.$value->id; ?>" class="btn btn-success" ><i class="fa fa-eye"></i>  View</a>
        <a href="<?php echo base_url().'marketplace/listing_delete/'.$value->id; ?>" class="btn btn-danger" onclick="return confirm('Are your sure you want to end this listing ?');" ><i class="fa fa-times"></i> End Listing</a>
       <?php }else{?>
       <a class="btn btn-success">
       <i class="fa fa-times"></i> Relist</a>
       <a href="<?php echo base_url().'marketplace/end_listing_status/'.$value->id; ?>" class="btn btn-danger" onclick="return confirm('Are your sure you want to end this listing ?');" ><i class="fa fa-times"></i> End</a>
        <?php } ?>

        </th>
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
    <h5>Selling Request</h5>
</div>
<div class="ibox-content">
<table class="table table-striped table-bordered table-hover buying_requests" >
<thead>
<tr>
    <th>Status</th>
    <th>Start Date</th>
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
 <?php if(!empty($buying_request)): ?>
    <?php foreach ($buying_request as $value):
     ?>
    <tr>
        <td class="text-center">
          <?php  
            $current_datetime = strtotime(date('d-m-Y H:i:s')); 
            $end_datetime = strtotime(date('d-m-Y H:i:s', strtotime($value->listing_end_datetime))); 
            $start_datetime = strtotime(date('d-m-Y H:i:s', strtotime($value->schedule_date_time))); 
           
            if($current_datetime > $end_datetime){
                ?> <span class="label label-danger">Ended</span><?php
            } elseif($current_datetime >= $start_datetime){?>
                <span class="label label-primary">Active</span>
       <?php }else{ if($value->scheduled_status){ ?>
                <span class="label label-success">Scheduled</span>
            <?php }}?>
        </td>
        <td><?php echo date('d-M-y, H:i', strtotime($value->schedule_date_time)); ?></td>
        <td><?php echo date('d-M-y, H:i', strtotime($value->listing_end_datetime)); ?></td>
        <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
        <td><?php echo $value->condition; ?></td>
        <td data-toggle="tooltip" data-placement="left" title="&pound; <?php echo get_currency(currency_class($value->currency), 'GBP', $value->unit_price); ?>,&euro; <?php echo get_currency(currency_class($value->currency), 'EUR', $value->unit_price); ?>,$ <?php echo get_currency(currency_class($value->currency), 'USD', $value->unit_price); ?>"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
        <td><?php echo $value->qty_available; ?></td>
        <td><?php echo $value->spec; ?></td>
        <th class="text-center">
        <a href="<?php echo base_url().'marketplace/sell_listing/'.$value->id; ?>" class="btn btn-warning" ><i class="fa fa-paste"></i> Edit</a>
        <?php 
         if($end_datetime > $current_datetime){ ?>
        <a href="<?php echo base_url().'marketplace/listing_detail/'.$value->id; ?>" class="btn btn-success" ><i class="fa fa-eye"></i>  View</a>
        <a href="<?php echo base_url().'marketplace/listing_delete/'.$value->id; ?>" class="btn btn-danger" onclick="return confirm('Are your sure you want to end this listing ?');" ><i class="fa fa-times"></i> End Listing</a>
       <?php }else{?>
       <a class="btn btn-success">
       <i class="fa fa-times"></i> Relist</a>
       <a href="<?php echo base_url().'marketplace/end_listing_status/'.$value->id; ?>" class="btn btn-danger" onclick="return confirm('Are your sure you want to end this listing ?');" ><i class="fa fa-times"></i> End</a>
        <?php } ?>
      
        </th>
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
    <h5>Saved Requests</h5>
</div>
<div class="ibox-content">
<table class="table table-striped table-bordered table-hover selling_offers" >
<thead>
<tr>
    <th>Listing Type</th>
    <th>MPN/ISBN</th>
    <th>Make &amp; Model</th>
    <th>Condition</th>
    <th>Color</th>
    <th>Price</th>
    <th>QTY</th>
    <th>Spec</th>
    <th>Options</th>
</tr>
</thead>
<tbody>
<?php if(!empty($saved_listing)): 
$session_member_id = $this->session->userdata('members_id'); ?>
    <?php foreach ($saved_listing as $value_save): ?>
     
    <tr>
        <td class="text-center">
         <?php if ($value_save->listing_type == 1): ?>
         <span class="label label-success">
            Buying Request
          </span>  
        <?php else: ?>  
        <span class="label label-info">
           Selling Offers
        </span>   
        <?php endif ?> 
        </td>
        <td><?php echo $value_save->product_mpn_isbn; ?></td>
        <td><?php echo $value_save->product_make; ?> <?php echo $value_save->product_model; ?></td>
        <td><?php echo $value_save->condition; ?></td>
        <td><?php echo $value_save->product_color; ?></td>
        <td data-toggle="tooltip" data-placement="left" title="&pound; <?php echo get_currency(currency_class($value_save->currency), 'GBP', $value_save->unit_price); ?>,&euro; <?php echo get_currency(currency_class($value_save->currency), 'EUR', $value_save->unit_price); ?>,$ <?php echo get_currency(currency_class($value_save->currency), 'USD', $value_save->unit_price); ?>"><?php echo currency_class($value_save->currency); ?> <?php echo $value_save->unit_price; ?></td>
        <td><?php echo $value_save->qty_available; ?></td>
        <td><?php echo $value_save->spec; ?></td>       
        <th class="text-center">
        <?php 
        $date1 = strtotime(date('d-m-Y H:i:s', strtotime($value_save->listing_end_datetime))); 
        $date2 = strtotime(date('d-m-Y H:i:s')); 
         if($date1 > $date2){ ?>       
        
      <?php if ($value_save->listing_type == 1){ ?>    
      <a href="<?php echo base_url().'marketplace/buy_listing/'.$value_save->id.'/saved_listing'; ?>" class="btn btn-warning" ><i class="fa fa-paste"></i> Edit</a>
      <?php }else{ ?>
      <a href="<?php echo base_url().'marketplace/sell_listing/'.$value_save->id.'/saved_listing'; ?>" class="btn btn-warning" ><i class="fa fa-paste"></i> Edit</a>
      <?php } ?>
       <?php }else{?>
       <a class="btn btn-outline btn-danger"><i class="fa fa-times"></i> Expired </a>
        <?php } ?>
       <a href="<?php echo base_url().'marketplace/listing_delete/'.$value_save->id; ?>" class="btn btn-danger" onclick="return confirm('Are your sure');" ><i class="fa fa-times"></i> Delete</a>
        </th>
    </tr>
        
    <?php endforeach ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>       
</div>

<?php } else { ?>
<?php if($member->membership == 1 ){ ?>
            <div class="alert alert-info" style="margin:15px 15px -15px">
        <p><i class="fa fa-info-circle"></i> <strong>This is a Demo</strong> Silver members and above with criteria met will have access to the live marketplace. You can view your listings and edit them in real time on the marketplace. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
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
        <table class="table table-striped table-bordered table-hover selling_offers" >
        <thead>
        <tr>
            <th>Status</th>
            <th>Start Date</th>
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
                <td class="text-center"><span class="label label-primary">Active</span></td>
                <td><span><?php echo date("d-M, H:i", time()-202800); ?></span></td>
                <td><span><?php echo date("d-M, H:i", time()+402000); ?></span></td>
                <td>Google Nexus</td>
                <td>New</td>
                <td>GBP 25</td>
                <td>10</td>
                <td>US</td>
                <th class="text-center">
                <button class="btn btn-warning" type="button" style="font-size:10px"><i class="fa fa-paste"></i> Edit</button>
                <button class="btn btn-primary" type="button" style="font-size:10px"><i class="fa fa-eye"></i> View</button>
                <button class="btn btn-danger" type="button" style="font-size:10px"><i class="fa fa-times"></i> End Listing</button>
                </th>
            </tr>
            <tr>
                <td class="text-center"><span class="label label-danger">Ended</span></td>
                <td><span><?php echo date("d-M, H:i", time()-864000); ?></span></td>
                <td><span><?php echo date("d-M, H:i", time()-259200); ?></span></td>
                <td>LG G4</td>
                <td>Used Grade A</td>
                <td>USD 98</td>
                <td>500</td>
                <td>US</td>
                <th class="text-center">
                <button class="btn btn-warning" type="button" style="font-size:10px"><i class="fa fa-paste"></i> Edit</button>
                <button class="btn btn-success" type="button" style="font-size:10px"><i class="fa fa-arrow-up"></i> Relist</button>
                <button class="btn btn-danger" type="button" style="font-size:10px"><i class="fa fa-times"></i> Remove</button>
                </th>
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
        <table class="table table-striped table-bordered table-hover buying_requests" >
        <thead>
        <tr>
            <th>Status</th>
            <th>Start Date</th>
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
                <td class="text-center"><span class="label label-primary">Active</span></td>
                <td><span><?php echo date("d-M, H:i", time()+220200); ?></span></td>
                <td><span><?php echo date("d-M, H:i", time()+825000); ?></span></td>
                <td>Acer Liquid E3</td>
                <td>New</td>
                <td>GBP 50</td>
                <td>1211</td>
                <td>US</td>
                <th class="text-center">
                <button class="btn btn-warning" type="button" style="font-size:10px"><i class="fa fa-paste"></i> Edit</button>
                <button class="btn btn-primary" type="button" style="font-size:10px"><i class="fa fa-eye"></i> View</button>
                <button class="btn btn-danger" type="button" style="font-size:10px"><i class="fa fa-times"></i> End Listing</button>
                </th>
            </tr>
            <tr>
                <td class="text-center"><span class="label label-success">Scheduled</span></td>
                <td><span><?php echo date("d-M, H:i", time()+492000); ?></span></td>
                <td><span><?php echo date("d-M, H:i", time()+1701600); ?></span></td>
                <td>Sony Xperia Z</td>
                <td>New</td>
                <td>EUR 100</td>
                <td>5000</td>
                <td>EU</td>
                <th class="text-center">
                <button class="btn btn-warning" type="button" style="font-size:10px"><i class="fa fa-paste"></i> Edit</button>
                <button class="btn btn-primary" type="button" style="font-size:10px"><i class="fa fa-eye"></i> View</button>
                <button class="btn btn-danger" type="button" style="font-size:10px"><i class="fa fa-times"></i> Remove</button>
                </th>
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
            <h5>Saved Listings</h5>
        </div>
        <div class="ibox-content">
        <table class="table table-striped table-bordered table-hover selling_offers" >
        <thead>
        <tr>
            <th>Listing Type</th>
            <th>MPN/ISBN</th>
            <th>Make &amp; Model</th>
            <th>Condition</th>
            <th>Colour</th>
            <th>Price</th>
            <th>QTY</th>
            <th>Spec</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"><span class="label label-warning">Selling Offer</span></td>
                <td>GH97-101929</td>
                <td>Google Nexus</td>
                <td>New</td>
                <td>Red</td>
                <td>GBP 25</td>
                <td>10</td>
                <td>US</td>
                <th class="text-center">
                <button class="btn btn-warning" type="button" style="font-size:10px"><i class="fa fa-paste"></i> Edit</button>
                <button class="btn btn-success" type="button" style="font-size:10px"><i class="fa fa-arrow-up"></i> List Now</button>
                <button class="btn btn-danger" type="button" style="font-size:10px"><i class="fa fa-times"></i> Remove</button>
                </th>
            </tr>
            <tr>
                <td class="text-center"><span class="label label-primary">Buying Request</span></td>
                <td>GH97-101929</td>
                <td>LG G4</td>
                <td>Used Grade A</td>
                <td>Blue</td>
                <td>USD 98</td>
                <td>500</td>
                <td>US</td>
                <th class="text-center">
                <button class="btn btn-warning" type="button" style="font-size:10px"><i class="fa fa-paste"></i> Edit</button>
                <button class="btn btn-success" type="button" style="font-size:10px"><i class="fa fa-arrow-up"></i> List Now</button>
                <button class="btn btn-danger" type="button" style="font-size:10px"><i class="fa fa-times"></i> Remove</button>
                </th>
            </tr>
        </tbody>
        </table>
        </div>
    </div>
</div>
</div>     
</div>


<?php }?>
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
</style>
<script>
 function get_buyers_offer(listing_id) {
    var list = listing_id;
       $.post('<?php echo base_url() ?>marketplace/get_buyers_offer', {listing_id: list}, function(data) {
           $('#buyers_list').html(data);
       });
    }
    function view_offer(listing_id) {
        var list = listing_id;
       $.post('<?php echo base_url() ?>marketplace/view_offer', {listing_id: list}, function(data) {
           $('#view_offer').html(data);
       });
    }
    function offer_status(listing_id, buyer_id) {
        var list = listing_id;
        var buyer_id = buyer_id;
       $.post('<?php echo base_url() ?>marketplace/offer_status', {listing_id: list, buyer_id: buyer_id}, function(data) {
           $('#offer_status_msg').html(data);
       });
    }
</script>