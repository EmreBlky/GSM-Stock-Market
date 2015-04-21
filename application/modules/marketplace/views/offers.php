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
<?php msg_alert(); 
$member_id=$this->session->userdata('members_id');?>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Offers Sent to Buy (Items I want to buy)</h5>
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
            <?php if(!empty($seller_offer_sent)):
            
            foreach ($seller_offer_sent as $value):
            $offer_count = offer_count($value->id); ?>
            <tr>
                <td class="text-center">
                <?php if($value->member_id==$member_id){?>
                <span class="label label-info">
                Offers Waiting (<?php echo $offer_count; ?>)
                </span>
                <?php } else{
                    echo"<span class='label label-warning'>Offers Sent</sapn>";
                    }?>
                </td>
                <td><?php echo date('d-M-y, H:i', strtotime($value->listing_end_datetime)); ?></td>
                <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="t"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->qty_available; ?></td>
                <td><?php echo $value->spec; ?></td>
                <td class="text-center">
                <a class="btn btn-info" onclick="view_offer(<?php echo $value->id; ?>,1)" data-toggle="modal" data-target="#view_offers"><i class="fa fa-paste"></i> View Offer </a>
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
            <h5>Offers sent to Sell (Items I want to sell)</h5>
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
          <?php if(!empty($buyer_offer_sent)):
            foreach ($buyer_offer_sent as $value):
            $offer_count = offer_count($value->id); ?>
            <tr>
                <td class="text-center">
                
                <?php if($value->member_id==$member_id){?>
                <span class="label label-info">
                Offers Waiting (<?php echo $offer_count; ?>)
                </span>
                <?php } else{
                    echo"<span class='label label-warning'>Offers Sent</sapn>";
                    }?>
                </td>
                <td><?php echo date('d-M-y, H:i', strtotime($value->listing_end_datetime)); ?></td>
                <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="t"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->qty_available; ?></td>
                <td><?php echo $value->spec; ?></td>
                <td class="text-center">
                <a class="btn btn-info" onclick="view_offer(<?php echo $value->id; ?>,1)" data-toggle="modal" data-target="#view_offers"><i class="fa fa-paste"></i> View Offer </a>
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

<hr>
<div class="row">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Offers Received (Items I want to sell)</h5>
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
            <?php if(!empty($seller_offer_recived)):
            
            foreach ($seller_offer_recived as $value): 
                 $offer_count = offer_count($value->id); ?>
            <tr>
                <td class="text-center">
                
                <?php if($value->member_id==$member_id){?>
                <span class="label label-info">
                Offers Waiting (<?php echo $offer_count; ?>)
                </span>
                <?php } else{
                    echo"<span class='label label-warning'>Offers Sent</sapn>";
                    }?>
                </td>
                <td><?php echo date('d-M-y, H:i', strtotime($value->listing_end_datetime)); ?></td>
                <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="t"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->qty_available; ?></td>
                <td><?php echo $value->spec; ?></td>
                <td class="text-center">
                <a onclick="view_offer(<?php echo $value->id; ?>,2)" class="btn btn-info"  data-toggle="modal" data-target="#view_offers"><i class="fa fa-paste"></i> View Offer </a>
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
            <h5>Offers Received (Items I want to buy)</h5>
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
          <?php if(!empty($buyer_offer_recived)):
            foreach ($buyer_offer_recived as $value):
            $offer_count = offer_count($value->id); ?>
            <tr>
                <td class="text-center">
                
                <?php if($value->member_id==$member_id){?>
                <span class="label label-info">
                Offers Waiting (<?php echo $offer_count; ?>)
                </span>
                <?php } else{
                    echo"<span class='label label-warning'>Offers Sent</sapn>";
                    }?>
                </td>
                <td><?php echo date('d-M-y, H:i', strtotime($value->listing_end_datetime)); ?></td>
                <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="t"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->qty_available; ?></td>
                <td><?php echo $value->spec; ?></td>
                <td class="text-center">
                <a onclick="view_offer(<?php echo $value->id; ?>,2)" class="btn btn-info"  data-toggle="modal" data-target="#view_offers"><i class="fa fa-paste"></i> View Offer </a>
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