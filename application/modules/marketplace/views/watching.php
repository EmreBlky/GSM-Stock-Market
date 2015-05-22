<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Watch List</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                Marketplace
            </li>
            <li class="active">
                <strong>Watching</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
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
                <h5>Watching - Buying Requests (WTB)</h5>
            </div>
            <div class="ibox-content">
            <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Listing End</th>
                <th>MPN/ISBN</th>
                <th>Make &amp; Model</th>
                <th>Product Type</th>
                <th>Condition</th>
                <th>Unit Price</th>
                <th>QTY</th>
                <th>Country</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(!empty($buying_request)): ?>
            <?php foreach ($buying_request as $value): ?>
            <tr>
                <td><?php echo date('d-M, H:i', strtotime($value->listing_end_datetime)); ?></td>
                <td><?php if(!empty($value->product_mpn_isbn)){ echo $value->product_mpn_isbn; } ?></td>
                <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?> <?php echo $value->spec; ?></td>
                <td><?php echo $value->product_type; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="mouseover currency"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->total_qty; ?></td>
                <td class="text-center"><img src="public/main/template/gsm/img/flags/<?php echo str_replace(' ', '_', $value->product_country) ?>.png" alt="<?php echo $value->product_country ?>" title="<?php echo $value->product_country ?>" /></td>
                <th>
                
                <a href="<?php echo base_url().'marketplace/listing_unwatch/'.$value->id ?>" class="btn btn-danger" style="font-size:10px">Unwatch</a>
                <a href="<?php echo base_url().'marketplace/listing_detail/'.$value->id ?>" class="btn btn-primary" style="font-size:10px">More Info</a></th>
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
                <h5>Watching - Selling Offers (WTS)</h5>
            </div>
            <div class="ibox-content">
            <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Listing End</th>
                <th>MPN/ISBN</th>
                <th>Make &amp; Model</th>
                <th>Product Type</th>
                <th>Condition</th>
                <th>Unit Price</th>
                <th>QTY</th>
                <th>Country</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
        <?php  if(!empty($seller_offer)): ?>
            <?php foreach ($seller_offer as $value): ?>
            <tr>
                <td><?php echo date('d-M, H:i', strtotime($value->listing_end_datetime)); ?></td>
                <td><?php if(!empty($value->product_mpn_isbn)){ echo $value->product_mpn_isbn; } ?></td>
                <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?> <?php echo $value->spec; ?></td>
                <td><?php echo $value->product_type; ?></td>
                <td><?php echo $value->condition; ?></td>
                <td data-toggle="tooltip" data-placement="left" title="mouseover currency"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                <td><?php echo $value->total_qty; ?></td>
                <td class="text-center"><img src="public/main/template/gsm/img/flags/<?php echo str_replace(' ', '_', $value->product_country) ?>.png" alt="<?php echo $value->product_country ?>" title="<?php echo $value->product_country ?>" /></td>
                <th>
                <a href="<?php echo base_url().'marketplace/listing_unwatch/'.$value->id ?>" class="btn btn-danger" style="font-size:10px">Unwatch</a>
                <a href="<?php echo base_url().'marketplace/listing_detail/'.$value->id ?>" class="btn btn-primary" style="font-size:10px">More Info</a></th>
            </tr>
                
            <?php endforeach ?>
        <?php endif; ?>
            
            </tbody>
            </table>
            </div>
        </div>
    </div>
<?php } else {?>
<?php if($member->membership == 1 ){ ?>
            <div class="alert alert-info" style="margin:15px 15px -15px">
        <p><i class="fa fa-info-circle"></i> <strong>This is a Demo</strong> Silver members and above with criteria met will have access to the live marketplace. This section of the marketplace show all the items you are watching. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
            </div>

<?php } else if($member->membership == 2 && $member->marketplace == 'inactive'){?>
            <div class="alert alert-warning" style="margin:15px 15px -15px">
                <p><i class="fa fa-warning"></i> You still need to supply 2 trade references so we can enable your membership to view profiles and access the marketplace. <a class="alert-link" href="tradereference">Submit trade references</a>.</p>
            </div>

<?php }?>
<div class="wrapper wrapper-content animated fadeInRight"><div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Watching - Buying Requests</h5>
            </div>
            <div class="ibox-content">
            <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Listing End</th>
                <th>Make &amp; Model</th>
                <th>Product Type</th>
                <th>Condition</th>
                <th>Price</th>
                <th>QTY</th>
                <th>Spec</th>
                <th>Country</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><span><?php echo date("d-M, H:i", time()+123456); ?></span></td>
                <td>Apple iPhone 6</td>
                <td>Handset</td>
                <td>Refurbished</td>
                <td>GBP 502</td>
                <td>200</td>
                <td>UK</td>
                <td><img src="public/main/template/gsm/img/flags/United_Kingdom.png" /></td>
                <th><button type="button" class="btn btn-danger" style="font-size:10px" data-toggle="modal" data-target="#upgrade">Unwatch</button>
                <button type="button" class="btn btn-primary" style="font-size:10px" data-toggle="modal" data-target="#upgrade">More Info</button></th>
            </tr>
            <tr>
                <td><span><?php echo date("d-M, H:i", time()+867543); ?></span></td>
                <td>HTC One X</td>
                <td>Handset</td>
                <td>Used Grade C</td>
                <td>USD 98</td>
                <td>742</td>
                <td>EU</td>
                <td><img src="public/main/template/gsm/img/flags/United_Arab_Emirates.png" /></td>
                <th><button type="button" class="btn btn-danger" style="font-size:10px" data-toggle="modal" data-target="#upgrade">Unwatch</button>
                <button type="button" class="btn btn-primary" style="font-size:10px" data-toggle="modal" data-target="#upgrade">More Info</button></th>
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
                <h5>Watching - Selling Offers</h5>
            </div>
            <div class="ibox-content">
            <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Listing End</th>
                <th>Make &amp; Model</th>
                <th>Product Type</th>
                <th>Condition</th>
                <th>Unit Price</th>
                <th>QTY</th>
                <th>Spec</th>
                <th>Country</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><span><?php echo date("d-M, H:i", time()+254983); ?></span></td>
                <td>Samsung Galaxy S2 (i9100)</td>
                <td>Handset</td>
                <td>Used Grade A</td>
                <td>GBP 40</td>
                <td>1000</td>
                <td>EU</td>
                <td><img src="public/main/template/gsm/img/flags/Sweden.png" /></td>
                <th><button type="button" class="btn btn-danger" style="font-size:10px" data-toggle="modal" data-target="#upgrade">Unwatch</button>
                <button type="button" class="btn btn-primary" style="font-size:10px" data-toggle="modal" data-target="#upgrade">More Info</button></th>
            </tr>
            <tr>
                <td><span><?php echo date("d-M, H:i", time()+374654); ?></span></td>
                <td>Apple iPhone 5</td>
                <td>Handset</td>
                <td>New</td>
                <td>GBP 112</td>
                <td>200</td>
                <td>EU</td>
                <td><img src="public/main/template/gsm/img/flags/Germany.png" /></td>
                <th><button type="button" class="btn btn-danger" style="font-size:10px" data-toggle="modal" data-target="#upgrade">Unwatch</button>
                <button type="button" class="btn btn-primary" style="font-size:10px" data-toggle="modal" data-target="#upgrade">More Info</button></th>
            </tr>
            </tbody>
            </table>
            </div>
        </div>
    </div>


<?php }?>

    </div>
    </div>   
    
    
<!-- Data Tables -->
<link href="public/main/template/core/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="public/main/template/core/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
<!-- Multi Select -->
<link href="public/main/template/core/css/plugins/chosen/chosen.css" rel="stylesheet">
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
    /* multi select */
	var config = {
        '.chosen-select'           : {search_contains:true},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }			
});
</script>
<style>
body.DTTT_Print { background: #fff;}
.DTTT_Print #page-wrapper {margin: 0;background:#fff;}
button.DTTT_button, div.DTTT_button, a.DTTT_button {border: 1px solid #e7eaec;background: #fff;color: #676a6c;box-shadow: none;padding: 6px 8px;}
button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {border: 1px solid #d2d2d2;background: #fff;color: #676a6c;box-shadow: none;padding: 6px 8px;}
.dataTables_filter label {margin-right: 5px;}
/* chosen css override */
.chosen-container-multi .chosen-choices li.search-field input[type="text"] {font-family:inherit;font-size:14px}
.chosen-container-multi .chosen-choices {border-radius:5px;border:1px solid #e5e6e7}
.chosen-container-multi .chosen-choices li.search-choice {color:#FFF;background:#1ab394}
</style>

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