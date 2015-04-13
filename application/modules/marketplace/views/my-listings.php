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
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Counter Offers</h5>
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
        <?php if(!empty($counter_offer)): ?>
            <?php foreach ($counter_offer as $value):
            $offer_count = offer_count($value->id); ?>
            <tr>
                <td class="text-center">
                <span class="label label-info">Offers Waiting (<?php echo $offer_count; ?>)</span>
                </td>
                <td><?php echo date('h:i d-m', strtotime($value->listing_end_datetime)); ?></td>
                <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="t"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->qty_available; ?></td>
                <td><?php echo $value->spec; ?></td>
                <th class="text-center">
                <a onclick="view_offer(<?php echo $value->id; ?>)" class="btn btn-info"  data-toggle="modal" data-target="#view_offers"><i class="fa fa-paste"></i> View Offer </a>
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
            <h5>Selling Offers</h5>
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
         <?php if(!empty($buying_request)): ?>
            <?php foreach ($buying_request as $value):
            if(!empty($value->id)){
             $offer_count = offer_count($value->id);   
            }
             ?>
            <tr>
                <td class="text-center">
               
                 <?php if (!empty($value->offer_status) && $value->offer_status == 1): ?>
                <span class="label label-success">Active</span>
                <?php else: ?>
                 <span class="label label-info">Offers Waiting (<?php echo $offer_count; ?>)</span>
                <?php endif ?> 
                </td>
                <td><?php echo date('h:i d-m', strtotime($value->listing_end_datetime)); ?></td>
                <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="t"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->qty_available; ?></td>
                <td><?php echo $value->spec; ?></td>
                <th class="text-center">
                <button class="btn btn-info" type="button"  data-toggle="modal" data-target="#buyer_offers" onclick="get_buyers_offer(<?php echo $value->id; ?>)"><i class="fa fa-paste"></i> Offers </button>
                <a href="<?php echo base_url().'marketplace/sell_listing/'.$value->id; ?>" class="btn btn-warning" ><i class="fa fa-paste"></i> Edit</a>
                <button class="btn btn-danger" type="button" ><i class="fa fa-times"></i> <span class="bold">Delete</span></button>
                </th>
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
                    <h4 class="modal-title">Buyers Offers</h4>
                </div>
                <div class="modal-body">
                    <div id="offer_status_msg"></div>
                    <div id="buyers_list"></div>
                
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
                    <h4 class="modal-title">Your Offers</h4>
                </div>
                <div class="modal-body">
                    <div id="view_offer"></div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>  
    
    </div> 
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
                <span class="label label-info">
                 <?php if (!empty($value->member_id) && $value->member_id == $session_member_id): ?>
                    Offers Waiting (<?php echo $offer_count; ?>)
                <?php else: ?>
                    Offer Waiting
                <?php endif ?> </span>
                </td>
                <td><?php echo date('h:i d-m', strtotime($value->listing_end_datetime)); ?></td>
                <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="t"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->qty_available; ?></td>
                <td><?php echo $value->spec; ?></td>
                <th class="text-center">
            <?php if (!empty($value->member_id) && $value->member_id == $session_member_id): ?>
                <button class="btn btn-info" type="button"  data-toggle="modal" data-target="#buyer_offers" onclick="get_buyers_offer(<?php echo $value->id; ?>)"><i class="fa fa-paste"></i> Offers </button>
            <?php endif ?>
                <a href="<?php echo base_url().'marketplace/buy_listing/'.$value->id; ?>" class="btn btn-warning" ><i class="fa fa-paste"></i> Edit</a>
                <button class="btn btn-danger" type="button" ><i class="fa fa-times"></i> <span class="bold">Delete</span></button>
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