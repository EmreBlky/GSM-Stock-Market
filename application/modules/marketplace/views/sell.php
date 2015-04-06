<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2>Buying Requests</h2>
<ol class="breadcrumb">
    <li>
        <a href="/">Home</a>
    </li>
    <li>
        Marketplace
    </li>
    <li class="active">
        <strong>Sell</strong>
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
<?php
//print_r($advance_search);
$dataasa=array();
if(!empty($advance_search)):
foreach ($advance_search as $row) {
$dataasa['product_mpn'][]   = $row->product_mpn_isbn;
$dataasa['product_isbn'][]  = $row->product_isbn;
$dataasa['product_make'][]  = $row->product_make ;
$dataasa['product_model'][] = $row->product_model ;
$dataasa['product_type'][]  = $row->product_type;
$dataasa['product_countrys'][] =array('country_id'=>$row->country_id,'product_country'=>$row->product_country);
}
endif;
?>

<div class="ibox-content">
<form action="<?php echo base_url('marketplace/sell'); ?>/<?php echo $offset ?>/" method="get" accept-charset="utf-8">
     <div class="row">
            <div class="col-lg-3" style="padding-right:0">
                <select name="lc" class="form-control" tabindex="1">
                    <option value="" selected="">All Categories</option>
                    <?php if (!empty($listing_categories)): ?>
                    <?php foreach ($listing_categories as $row): ?>
                       <option value="<?php echo $row->category_name ?>" <?php if(!empty($_GET['lc']) && $row->category_name==$_GET['lc']){ echo'selected';}?> ><?php echo $row->category_name ?></option>
                        <?php if (!empty($row->childs)): ?>
                            <?php foreach ($row->childs as $child): ?>
                                <option value="<?php echo $child->category_name ?>" <?php if(!empty($_GET['lc']) && $child->category_name==$_GET['lc']){ echo'selected';}?> >- <?php echo $child->category_name ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <div class="col-lg-7" style="padding-right:0">
                <select name="query" data-placeholder="All Makes & Models" id="models" class="chosen-select form-control" tabindex="1">
                    <option value="">Search here </option>
                    <?php if(!empty($dataasa['product_make'])){
                  foreach (array_unique ($dataasa['product_make']) as $row) { ?>
                  <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                  <?php }} ?>
                  <?php if(!empty($dataasa['product_model'])){
                  foreach (array_unique ($dataasa['product_model']) as $row) { ?>
                  <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                  <?php }} ?>
                </select>
            </div>
            <div class="col-lg-2">
                <input type="submit" class="btn btn-primary" style="width:100%" value="Search"/>
            </div>
        </div>
    </form>
       <div class="row">

            <div class="col-lg-12">

                <div class="text-right">
                    <button class="btn btn-primary0" type="button" data-toggle="collapse" data-target="#AdvanceSearch" aria-expanded="true" aria-controls="collapseExample">Advance Search</button>
                </div>

                <div id="AdvanceSearch"   <?php if(isset($_GET['search'])) echo 'class="collapse in" aria-expanded="true"'; else echo 'class="collapse"'; ?> style=" border: 1px solid #f0f0f0; padding: 10px;">
                <div class="well0 row">
                 <form action="<?php echo base_url('marketplace/sell'); ?>/<?php echo $offset ?>/" method="get" accept-charset="utf-8">

                    <div class="col-lg-4">
                        <div class="form-group">
                         <label for="">Search by Date</label>
                            <input type="text" class="form-control" id="date" name="date" placeholder="format (yyyy-mm-dd)" value="<?php if(!empty($_GET['date'])) echo $_GET['date'] ?>">
                        </div>
                         <div class="form-group">
                          <label for="">Search by MPN</label>
                            <input type="type" class="form-control" id="mpn" list="mpns" name="mpn" placeholder="MPN" value="<?php if(!empty($_GET['mpn'])) echo $_GET['mpn'] ?>">
                             <datalist id="mpns">
                            <?php if(!empty($dataasa['product_mpn'])){
                                 foreach (array_unique ($dataasa['product_mpn']) as $row) { ?>
                               <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                                 <?php }} ?>
                            </datalist>
                        </div>
                        <div class="form-group">
                         <label for="">Search By ISBN</label>
                            <input type="text" class="form-control" name="isbn" id="isbn" list="isbns" placeholder="ISBN" value="<?php if(!empty($_GET['isbn'])) echo $_GET['isbn'] ?>">
                             <datalist id="isbns">
                            <?php if(!empty($dataasa['product_isbn'])){
                                 foreach (array_unique ($dataasa['product_isbn']) as $row) { ?>
                               <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                                 <?php }} ?>
                            </datalist>
                        </div>
                    </div>
                     <div class="col-lg-4">
                     <div class="form-group">
                            <label for="">Search by Rating</label>
                            <input type="text" class="form-control" name="rating" id="rating" placeholder="Rating" value="<?php if(!empty($_GET['rating'])) echo $_GET['rating'] ?>">
                        </div>

                        <div class="form-group">
                             <label for="">Search By Make (Manufacturer)</label>
                            <input type="type" class="form-control" list="manufacturers" name="manufacturer" id="manufacturer" placeholder="Make Name" value="<?php if(!empty($_GET['manufacturer'])) echo $_GET['manufacturer'] ?>">
                             <datalist id="manufacturers">
                            <?php if(!empty($dataasa['product_make'])){
                                 foreach (array_unique ($dataasa['product_make']) as $row) { ?>
                               <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                                 <?php }} ?>
                            </datalist>
                        </div>

                        <div class="form-group">
                            <label for="">Search By Model</label>
                            <input type="type" class="form-control" list="modelss" id="model"  name="model" placeholder="Model number" value="<?php if(!empty($_GET['model'])) echo $_GET['model'] ?>">
                              <datalist id="modelss">
                                <?php if(!empty($dataasa['product_model'])){
                                 foreach (array_unique ($dataasa['product_model']) as $row) { ?>
                               <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                                 <?php }} ?>
                            </datalist>
                        </div>
                        </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                             <label for="">Search By Product Type</label>
                            <input type="text" class="form-control" list="product_types" name="product_type" id="product_type" placeholder="Product Type" value="<?php if(!empty($_GET['product_type'])) echo $_GET['product_type'] ?>">
                            <datalist id="product_types">
                                <?php if(!empty($dataasa['product_type'])){
                                foreach (array_unique ($dataasa['product_type']) as $row) { ?>
                               <option value="<?php echo $row; ?>"><?php echo $row; ?></option>
                                 <?php }} ?>
                            </datalist>
                        </div>
                         <div class="form-group">
                         <label for="">Search By Price Range</label>
                         <div class="row">
                            <div class="col-xs-6">
                            <input type="text" class="form-control" id="price_range_start" name="price_range_start" placeholder="Start Price" value="<?php if(!empty($_GET['price_range_start'])) echo $_GET['price_range_start'] ?>">
                            </div>
                            <div class="col-xs-6">
                            <input type="text" class="form-control" id="price_range_end" name="price_range_end" placeholder="End Price" value="<?php if(!empty($_GET['price_range_end'])) echo $_GET['price_range_end'] ?>">
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                             <label for="">Search By Country</label>
                            <input type="text" class="form-control" list="countrys" name="country" id="country" placeholder="Country Name" value="<?php if(!empty($_GET['country'])) echo $_GET['country'] ?>">
                             <datalist id="countrys">
                                <?php if(!empty($dataasa['product_countrys'])){
                                    $product_countrys =  array_map('unserialize', array_unique(array_map('serialize', $dataasa['product_countrys'])));
                                foreach ($product_countrys as $row) { ?>
                               <option value="<?php echo $row['country_id']; ?>" label="<?php echo $row['product_country']; ?>"><?php echo $row['product_country']; ?></option>
                                 <?php }} ?>
                            </datalist>

                        </div>
                     </div>
                     <div class="row">
                         <div class="col-lg-4 col-lg-offset-4">
                         <button type="submit" class="btn btn-lg btn-primary" name="search" >
                         <i class="fa fa-search"></i> Search Now</button>
                         </div>
                     </div>
                 </form>
                </div>
                </div> <!-- AdvanceSearch -->

            </div>
        </div>
</div><!-- /ibox-content -->
</div>
</div>
</div>


<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
    <h5>Live Marketplace - Buying Requests</h5>
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
<?php if($listing_sell){
     foreach ($listing_sell as $value) {?>
    <tr data-toggle="modal" data-target="#myModal5">
    <td><p><span data-countdown="<?php echo $value->listing_end_datetime; ?>"></span></p></td>
    <td><span class="fa fa-star" style="color:#FC3"></span> <span style="color:green">94</span></td>
    <td> <?php if(!empty($value->product_mpn)){ echo "MPN: ".$value->product_mpn; } ?>
                    <br>
                <?php if(!empty($value->product_isbn)){ echo "ISBN: ".$value->product_isbn; } ?></td>
    <td><?php echo $value->product_make; ?></td>
    <td><?php echo $value->product_model; ?></td>
    <td><?php echo $value->product_type; ?></td>
    <td><?php echo $value->condition; ?></td>

    <td data-toggle="tooltip" data-placement="left" title="&pound; <?php echo get_currency(currency_class($value->currency), 'GBP', $value->unit_price); ?>, &euro; <?php echo get_currency(currency_class($value->currency), 'EUR', $value->unit_price); ?>,   $ <?php echo get_currency(currency_class($value->currency), 'USD', $value->unit_price); ?>"><?php echo  currency_class($value->currency) ?><?php echo $value->unit_price; ?></td>
    <td><?php echo $value->total_qty; ?></td>
    <td><?php echo $value->spec; ?></td>
    <td>
   <span style="display:none"><?php echo $value->country ?></span>
        <img src="public/main/template/gsm/img/flags/<?php echo str_replace(' ', '_', $value->product_country) ?>.png" alt="<?php echo $value->product_country ?>" title="<?php echo $value->product_country ?>" />
    </td>
    <th>
    <button type="button" class="btn btn-success" style="font-size:10px">Sell Stock</button>
    <button type="button" class="btn btn-warning" style="font-size:10px">Watch</button>
    <a href="<?php echo base_url().'marketplace/listing_detail/'.$value->id ?>"><button type="button" class="btn btn-primary" style="font-size:10px">More Info</button></a></th>
    </tr>
    <?php }}else{
        ?>
        <th colspan="12"><center>No Such Listing Found</center>  </th><?php
        }?>
</table>
</div>
</div>
</div>
</div>
</div>            
            
    <div class="modal inmodal fade" id="myMo dal5" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><strong>Selling Offer</strong> by GSMStockMarket.com Limited</h4>
                    <small class="font-bold">Transaction ID: 0123456789-01</small>
                </div>
                <div class="modal-body">
                	<div class="row">
                        <div class="col-lg-6">
                            <dl class="dl-horizontal">
                            	<h4>Product Details</h4>
                                <dt>Make:</dt> <dd>  Apple</dd>
                                <dt>Model:</dt> <dd>  iPhone 4S</dd>
                                <dt>Memory:</dt> <dd>  16GB</dd>
                                <dt>Colour:</dt> <dd>  Black</dd>
                                <dt>Product Type:</dt> <dd>  Data Cable</dd>
                                <dt>Condition:</dt> <dd>  Refurbished</dd>
                                <dt>Spec</dt> <dd>  UK</dd>
                                <dt>MPN/ISBN</dt> <dd>  GH98-23907342</dd>
                                <dt>Network</dt> <dd>  Network Locked</dd>
                                <dt>Quantity</dt> <dd>  29</dd>
                            </dl>
                            <dl class="dl-horizontal">
                            	<h4>Price</h4>
                                <dt>Buying Currency:</dt> <dd> GBP &pound;</dd>
                                <dt>GBP Price:</dt> <dd><strong>  &pound;96.00</strong></dd>
                                <dt>EUR Price:</dt> <dd>  &euro;130.55</dd>
                                <dt>USD Price:</dt> <dd>  $147.59</dd>
                            </dl>
                        </div>
                        <div class="col-lg-6">
                        	<p style="text-align:center">
                            	<img style="text-align:center" src="public/main/template/gsm/images/marketplace/marketplace_photo.png" /><br /><br />
                                <span style="color:red">Listing Ends: 4d 23h 22m 13s</span><br /><br />
                                <button type="button" class="btn btn-danger" style="font-size:10px">Pay asking price</button>
                            </p>
                                
                            <dl class="dl-horizontal" style="margin-top:20px">
                            	<h4>or Make an Offer</h4>
                                <dt><div class="input-group m-b"><span class="input-group-addon">QTY</span>  
                                    <input type="text" class="form-control" /><span class="input-group-addon">@</span></dt> 
                                    <dd><div class="input-group m-b"><span class="input-group-addon">GBP <i class="fa fa-gbp"></i></span>  
                                    <input type="text" class="form-control" /></dd>
                                <p style="text-align:center"><button type="button" class="btn btn-warning" style="font-size:10px">Send Offer</button></p>
                                <p class="small" style="text-align:center">Offers sent will expire after 24 hours</p>
                                
                        </div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-12">
                            <h4>Product Description</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent diam odio, ultrices vitae erat quis, tristique posuere leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tristique massa et justo laoreet, et finibus lacus scelerisque. Suspendisse id orci vel sapien mollis dictum. Aenean id nisl pulvinar, euismod risus id, pharetra velit. In finibus libero sed elit viverra, hendrerit tincidunt lectus maximus. Nulla facilisi. Nulla tellus justo, lacinia eget mauris nec, imperdiet tincidunt elit. Donec elementum enim id felis commodo, non porta tortor sagittis.</p>
                            </div>
                      
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning">Watch</button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#price_graph">Product Price Data</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profile_user">Seller Profile</button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#profile_message">Ask a question</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal inmodal fade" id="profile_message" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Send Message</h4>
                    <small class="font-bold">Send a message to GSMStockMarket.com</small>
                </div>
                <div class="modal-body">
                    <p><strong>Form here</strong> generic stuff bla bla</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send Message</button>
                </div>
            </div>
        </div>
    </div>  
    
    <div class="modal inmodal fade" id="profile_user" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"View Profile</h4>
                    <small class="font-bold">Project Melon Limited</small>
                </div>
                <div class="modal-body">
                    <img src="public/main/template/gsm/images/marketplace/profile_summary.jpg" />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>  
    
    <div class="modal inmodal fade" id="price_graph" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">iPhone 4S Buy &amp; Sell Data</h4>
                	<span>Buying Price</span> / <span style="color:#8fd9ca">Selling Price</span>
                </div>
                <div class="modal-body">
                    <img src="public/main/template/gsm/images/marketplace/product_data.jpg" />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
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
            <?php  if(!empty($listing_sell)): ?>
            $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "public/main/template/core/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });
            <?php endif; ?>
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