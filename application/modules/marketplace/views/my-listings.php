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
            <h5>Selling Request</h5>
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
            <th>Last updated</th>
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
                <td><?php echo date('d-M-y, H:i', strtotime($value->listing_end_datetime)); ?></td>
                <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="&pound; <?php echo get_currency(currency_class($value->currency), 'GBP', $value->unit_price); ?>,&euro; <?php echo get_currency(currency_class($value->currency), 'EUR', $value->unit_price); ?>,$ <?php echo get_currency(currency_class($value->currency), 'USD', $value->unit_price); ?>"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->qty_available; ?></td>
                <td><?php echo $value->spec; ?></td>
                <td><?php echo date('d-M-y, H:i', strtotime($value->updated)); ?></td>
                <th class="text-center">
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
    
    <div class="modal inmodal fade" id="counteroffermodal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Your Offers</h4>
                </div>
                <div class="modal-body">
                    <div id="counter_offer_body"></div>
                
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
            <th>Last updated</th>
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
                <td><?php echo date('d-M-y, H:i', strtotime($value->listing_end_datetime)); ?></td>
                <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="&pound; <?php echo get_currency(currency_class($value->currency), 'GBP', $value->unit_price); ?>,&euro; <?php echo get_currency(currency_class($value->currency), 'EUR', $value->unit_price); ?>,$ <?php echo get_currency(currency_class($value->currency), 'USD', $value->unit_price); ?>"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->qty_available; ?></td>
                <td><?php echo $value->spec; ?></td>
                <td><?php echo date('d-M-y, H:i', strtotime($value->updated)); ?></td>
                <th class="text-center">
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
                <td>06-May-15, 09:35</td>
                <td>13-May-15, 09:35</td>
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
                <td>11-May-15, 12:30</td>
                <td>21-May-15, 12:30</td>
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
                <td>10-May-15, 11:42</td>
                <td>24-May-15, 11:42</td>
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
                <td>23-Apr-15, 12:01</td>
                <td>30-Apr-15, 12:01</td>
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