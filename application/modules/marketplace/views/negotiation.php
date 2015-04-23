<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>All Negotiation</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                Marketplace
            </li>
            <li class="active">
                <strong>Negotiation</strong>
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
            <h5>Items you are buying/Selling</h5>
        </div>
        <div class="ibox-content">
        <table class="table table-striped table-bordered table-hover buying_offers" >
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
            <?php if(!empty($sell_buy_negotiation)){
            
            foreach ($sell_buy_negotiation as $value){
             ?>
            <tr>
            <td><span class="btn btn-warning"><?php if($member_id == $value->listingmemberid){
                if($value->offer_type==1){ echo '&nbsp;Sell&nbsp;';}else{ echo '&nbsp;Buy&nbsp;';}
                }
                else{
                    if($value->offer_type==2){ echo '&nbsp;Sell&nbsp;';}else{ echo '&nbsp;Buy&nbsp;';}
                }
                    ?>
                </span>
            </td>
                <td><?php echo date('d-M-y, H:i', strtotime($value->listing_end_datetime)); ?></td>
                <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="t"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->qty_available; ?></td>
                <td><?php echo $value->spec; ?></td>
                <td class="text-center">
                <?php if($value->pay_asking_price){?>
                <a class="btn btn-info" onclick="view_negotiation_payasking(<?php echo $value->offer_id;?>)" data-toggle="modal" data-target="#view_negotiation_payasking"><?php }else{ ?>
                <a class="btn btn-info" onclick="view_negotiation_offer(<?php echo $value->offer_id;?>)" data-toggle="modal" data-target="#view_negotiation_offer"><?php } ?>
                <i class="fa fa-paste"></i> View Offer </a>
                </td>
            </tr>
            <?php }} ?> 
            </tbody>
        </table>
        </div>
    </div>
</div>
</div>

<div class="modal inmodal fade" id="view_negotiation_payasking" tabindex="-1" role="dialog"  aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Pay asking price</h4>
    </div>
    <div class="modal-body">
        <div id="view_negotiation_payasking_html"></div>
    
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div> 

<div class="modal inmodal fade" id="view_negotiation_offer" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Counter Offer</h4>
    </div>
    <div class="modal-body">
        <div id="view_negotiation_offer_html"></div>
    
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
   <form action="<?php echo base_url()."marketplace/counter_offer_negotiation/";?>" method="post" accept-charset="utf-8">
      <div class="row">
        <input type="text" name="qty" value="" placeholder="Quantity" class="form-control">
        <input type="hidden" name="offer_id" value="" class="offer_id_insert"><br>
        <input type="text" name="per_unit_price" value="" placeholder="Per unit price"  class="form-control">
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
        $('.buying_offers').dataTable({
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
function view_negotiation_payasking(parent_id) {
   $.post('<?php echo base_url() ?>marketplace/view_negotiation_payasking', {parent_id: parent_id,}, function(data) {
       $('#view_negotiation_payasking_html').html(data);
   });
}

function view_negotiation_offer(parent_id) {
   $.post('<?php echo base_url() ?>marketplace/view_negotiation_offer', {parent_id: parent_id,}, function(data) {
       $('#view_negotiation_offer_html').html(data);
   });
}
function view_negotiation_offer_sell(parent_id) {

   $.post('<?php echo base_url() ?>marketplace/view_negotiation_offer_sell', {parent_id: parent_id,}, function(data) {
       $('#view_negotiation_offer').html(data);
   });
}
function counter_offer(offer_id) {
    $('.offer_id_insert').val(offer_id);  
}
</script>