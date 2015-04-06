
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Open Orders</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            Marketplace
                        </li>
                        <li class="active">
                            <strong>Open Orders</strong>
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
                        <h5>Open Orders - Item you are buying</h5>
                    </div>
                    <div class="ibox-content">

                    <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Status</th>
                        <th>Seller</th>
                        <th>Product</th>
                        <th>Product Type</th>
                        <th>Condition</th>
                        <th>Price</th>
                        <th>Progress</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                <?php if (!empty($buy_order)): ?>
                    <?php foreach ($buy_order as  $value): ?>
                    <tr>
                    <?php if ($value->offer_status == 1): $progress = "25%"; ?>
                        <td><span class="label label-warning">Send Payment</span></td>
                    <?php elseif($value->offer_status == 2): $progress = "50%"?>
                        <td><span class="label label-primary">Payment Sent</span></td>
                    <?php elseif($value->offer_status == 3): $progress = "75%" ?>
                        <td><span class="label label-warning">Awaiting Shipment</span></td>
                    <?php elseif($value->offer_status == 4): $progress = "100%" ?>
                        <td><span class="label label-primary">Shipment Arrived</span></td>
                    <?php endif ?>
                        <td><?php echo $value->company_name; ?></td>
                        <td><?php echo $value->product_make; ?></td>
                        <td><?php echo $value->product_type; ?></td>
                        <td><?php echo $value->condition; ?></td>
                        <td data-toggle="tooltip" data-placement="left" title="mouseover currency"><?php echo currency_class($value->currency).' '.$value->unit_price; ?></td>
                        <td class="project-completion">
                        <small><?php echo $progress ?> Complete</small>
                        <div class="progress progress-mini">
                        <div style="width: <?php echo $progress ?>;" class="progress-bar"></div>
                        </div>
                        </td>
                        <td>
                        <button type="button" class="btn btn-primary" style="font-size:10px">Deal Info</button>
                    <?php if ($value->offer_status == 1): ?>
                        <button type="button" class="btn btn-success" style="font-size:10px">Make Payment</button>

                       
                    <?php elseif($value->offer_status == 3): ?>
                      <button type="button" class="btn btn-info" style="font-size:10px">Complete Deal</button>

                    <?php elseif($value->offer_status == 4): ?>
                       <button type="button" class="btn btn-info" style="font-size:10px">Leave Feedback</button></td>
                    <?php endif ?>

                       </td>
                    </tr>
                        
                    <?php endforeach ?>
                <?php endif ?>
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
                        <h5>Open Orders - Items you are selling</h5>
                    </div>
                    <div class="ibox-content">

                    <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Status</th>
                        <th>Buyer</th>
                        <th>Product</th>
                        <th>Product Type</th>
                        <th>Condition</th>
                        <th>Price</th>
                        <th>Progress</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($sell_order)): $progress='0%'; ?>
                        <?php foreach ($sell_order as $value): ?>
                    <tr>
                    <?php if ($value->offer_status == 1): $progress = "25%"; ?>

                        <td><span class="label label-warning">Awaiting Payment</span></td>

                    <?php elseif($value->offer_status == 2): $progress = "50%"?>
                        <td><span class="label label-primary">Payment Received</span></td>
                        
                    <?php elseif($value->offer_status == 3): $progress = "75%" ?>
                        <td><span class="label label-warning">Awaiting Completion</span></td>

                    <?php elseif($value->offer_status == 4): $progress = "100%" ?>
                        <td><span class="label label-primary">Shipment Arrived</span></td>

                    <?php endif ?>
                        <td><?php echo $value->company_name; ?></td>
                        <td><?php echo $value->product_make; ?></td>
                        <td><?php echo $value->product_type; ?></td>
                        <td><?php echo $value->condition; ?></td>
                        <td data-toggle="tooltip" data-placement="left" title="mouseover currency"><?php echo currency_class($value->currency).' '.$value->unit_price; ?></td>
                        <td class="project-completion">
                        <small><?php echo $progress ?> Complete</small>
                        <div class="progress progress-mini">
                        <div style="width: <?php echo $progress ?>;" class="progress-bar"></div>
                        </div>
                        </td>
                        <td>
                        <button type="button" class="btn btn-primary" style="font-size:10px">Deal Info</button>
                    <?php if ($value->offer_status == 1): ?>
                        <button type="button" class="btn btn-success" style="font-size:10px">Confirm Payment</button>

                    <?php elseif($value->offer_status == 2): ?>
                         <button type="button" class="btn btn-success" style="font-size:10px">Add Tracking</button>
                       
                    <?php elseif($value->offer_status == 4): ?>
                      <button type="button" class="btn btn-info" style="font-size:10px">Leave Feedback</button>
                    <?php endif ?>
                    </tr>
                            
                        <?php endforeach ?>
                    <?php endif ?>
                    
                    </tbody>
                    </table>

                    </div>
                </div>
            </div>
            </div>
            
            </div>
            
            
                            <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">23 x Refurbished Apple iPhone 4S 16GB</h4>
                                            <small class="font-bold"><strong style="color:green">Selling Offer</strong> from GSMStockMarket.com Limited</small>
                                        </div>
                                        <div class="modal-body">
                                        	<div class="row">
                                                <div class="col-lg-6">
                                                    <dl class="dl-horizontal">
                                                    	<h4 style="text-align:center">Product Details</h4>
                                                        <dt>Make:</dt> <dd>  Apple</dd>
                                                        <dt>Model:</dt> <dd>  iPhone 4S</dd>
                                                        <dt>Memory:</dt> <dd>  16GB</dd>
                                                        <dt>Colour:</dt> <dd>  Black</dd>
                                                        <dt>Product Type:</dt> <dd>  Data Cable</dd>
                                                        <dt>Condition:</dt> <dd>  Refurbished</dd>
                                                        <dt>Spec</dt> <dd>  UK</dd>
                                                    </dl>
                                                    <dl class="dl-horizontal">
                                                    	<h4 style="text-align:center">Price</h4>
                                                        <dt>Buy Price:</dt> <dd>  &pound;96.00</dd>
                                                        <dt>Product Type:</dt> <dd>  Data Cable</dd>
                                                        <dt>Condition:</dt> <dd>  Refurbished</dd>
                                                        <dt>Spec</dt> <dd>  UK</dd>
                                                    </dl>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Make Offer</label>
                                    <div class="col-md-9">
                                        <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-gbp"></i></span>  
                                        <input type="text" class="form-control" />
                                        </div>
                        				<button type="button" class="btn btn-primary" style="font-size:10px">Send Offer</button>
                                        
                                    </div>
                                </div>
                                                </div>
                                                <div class="col-lg-6">
                                                	<p style="text-align:center"><img style="text-align:center" src="public/main/template/gsm/images/marketplace/marketplace_photo.png" /></p>
                                                    <h4>Product Description</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent diam odio, ultrices vitae erat quis, tristique posuere leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi tristique massa et justo laoreet, et finibus lacus scelerisque. Suspendisse id orci vel sapien mollis dictum. Aenean id nisl pulvinar, euismod risus id, pharetra velit. In finibus libero sed elit viverra, hendrerit tincidunt lectus maximus. Nulla facilisi. Nulla tellus justo, lacinia eget mauris nec, imperdiet tincidunt elit. Donec elementum enim id felis commodo, non porta tortor sagittis.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
      <div class="modal inmodal fade" id="feedback" tabindex="-1" role="dialog"  aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <h4 class="modal-title">Leave Feedback</h4>
                      <small class="font-bold"><strong >Feedback</strong> for GSMStockMarket.com Limited</small>
                  </div>
                  <div class="modal-body">
                  <div class="row">
                  <form>
                  	<input type="text" class="form-control" placeholder="Summary of your thoughts and experience for this user" />
                    <div class="form-group" style="margin-top:15px">
                        <label class="col-md-5 control-label" style="margin-top:10px;text-align:right">Communication</label>
                        <div class="col-md-7">
                            <input class="rb-rating">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label" style="margin-top:10px;text-align:right">Shipping</label>
                        <div class="col-md-7">
                            <input class="rb-rating">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-5 control-label" style="margin-top:10px;text-align:right">Quality of Goods</label>
                        <div class="col-md-7">
                            <input class="rb-rating">
                        </div>
                    </div>
                  </form>  
                  </div>
                  </div>
					
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary">Leave Feedback</button>
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
    
    <!-- Feedback Stars -->
    <link rel="stylesheet" href="public/main/template/gsm/css/star-rating.min.css" rel="stylesheet">
    <script type="text/javascript" src="public/main/template/gsm/js/star-rating.min.js"></script>
    <script>
    jQuery(document).ready(function () {
        $('.rb-rating').rating({'showCaption':true, 'stars':'5', 'min':'0', 'max':'5', 'step':'1', 'size':'xs', 'starCaptions': {0:'Very Poor', 1:'Very Poor', 2:'Poor', 3:'Average', 4:'Good', 5:'Excellent'}});
    });
</script>

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