<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2>Selling Offers</h2>
    <ol class="breadcrumb">
        <li>
            <a href="/">Home</a>
        </li>
        <li>
            Marketplace
        </li>
        <li class="active">
            <strong>Buy</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Search</h5>
    </div>
    
    <div class="ibox-content">
        <div class="row">
        	<div class="col-lg-3" style="padding-right:0">
            	<select class="form-control" tabindex="1">
                	<option value="" selected="">All Categories</option>
                    <option>Accessories</option>
                    <option>- Batteries</option>
                    <option>- Cases</option>
                    <option>- Data Cables</option>
                    <option>- Phone Kits</option>
                    <option>Mobile Phones</option>
                    <option>Spare Parts</option>
                </select>
            </div>
        	<div class="col-lg-7" style="padding-right:0">
                <select data-placeholder="All Makes & Models" id="models" class="chosen-select form-control" multiple tabindex="1"></select>
            </div>
        	<div class="col-lg-2">
            	<input type="button" class="btn btn-primary" style="width:100%" value="Search"/>
            </div>
           
        </div>
    </div>
    </div>
</div>
</div>


<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Live Marketplace - Selling Offers</h5>
    </div>
    <div class="ibox-content">

    <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
    <tr>
        <th>Listing End</th>
        <th>Rating</th>
        <th>MPN/ISBN</th>
        <th>Make</th>
        <th>Model</th>
        <th>Product Type</th>
        <th>Condition</th>
        <th>Price</th>
        <th>QTY</th>
        <th>Spec</th>
        <th>Country</th>
        <th>Options</th>
    </tr>
    </thead>
    <?php if($listing_buy){
        foreach ($listing_buy as $value) {?>
        <tr data-toggle="modal" data-target="#myModal5">
        <td><?php echo $value->listing_end_datetime; ?></td>
        <td><span class="fa fa-star" style="color:#FC3"></span> <span style="color:green">94</span></td>
        <td> <?php if(!empty($value->product_mpn)){ echo "MPN: ".$value->product_mpn; } ?>
                    <br>
                <?php if(!empty($value->product_isbn)){ echo "ISBN: ".$value->product_isbn; } ?></td>
        <td><?php echo $value->product_make; ?></td>
        <td><?php echo $value->product_model; ?></td>
        <td><?php echo $value->product_type; ?></td>
        <td><?php echo $value->condition; ?></td>
        <td data-toggle="tooltip" data-placement="left" title="mouseover currency"><?php echo $value->unit_price; ?></td>
        <td><?php echo $value->total_qty; ?></td>
        <td><?php echo $value->spec; ?></td>
        <td><img src="public/main/template/gsm/img/flags/United_Kingdom.png" alt="United Kingdom" /></td>
        <th>
        <a href="<?php echo base_url().'marketplace/listing_detail/'.$value->id ?>"><button type="button" class="btn btn-primary" style="font-size:10px">More Info</button></a></th>
    </tr>
       <?php }}else{
        ?>
        <th colspan="12">No Such Listing Found </th><?php
        }?>    
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