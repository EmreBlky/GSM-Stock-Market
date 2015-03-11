<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li>
            <a href="/">Home</a>
        </li>
        <li class="active">
            <strong>Listing Details</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
</div>

<div class="wrapper wrapper-content">
<form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal"  enctype="multipart/form-data"/>  
<div class="row">
<div class="col-lg-12">
<?php msg_alert(); ?>
    <div class="ibox float-e-margins">
<div class="ibox-title">

<h5>Listing Details</h5>

</div>
<div class="ibox-content">
<div class="wrapper wrapp er-content">
   
     <div class="row">
                <div class="col-lg-6">               
                    <dl class="dl-horizontal">
                        <h4>Product Details</h4>
                        <dt>Make:</dt> <dd>  <?php if(!empty($listing_detail->product_make)) { echo $listing_detail->product_make; } ?></dd>
                        <dt>Model:</dt> <dd>  <?php if(!empty($listing_detail->product_model)) { echo $listing_detail->product_model; } ?></dd>
                        <!-- <dt>Memory:</dt> <dd> <?php //if(!empty($listing_detail->product_make)) { echo $listing_detail->product_make; } ?></dd> -->
                        <dt>Colour:</dt> <dd>  <?php if(!empty($listing_detail->product_color)) { echo $listing_detail->product_color; } ?></dd>
                        <dt>Product Type:</dt> <dd>  <?php if(!empty($listing_detail->product_type)) { echo $listing_detail->product_type; } ?></dd>
                        <dt>Condition:</dt> <dd>  <?php if(!empty($listing_detail->condition)) { echo $listing_detail->condition; } ?></dd> 
                        <dt>Spec</dt> <dd>  <?php if(!empty($listing_detail->spec)) { echo $listing_detail->spec; } ?></dd>
                        <dt>MPN</dt> <dd>  <?php if(!empty($listing_detail->product_mpn)) { echo $listing_detail->product_mpn; } ?></dd>
                        <dt>ISBN</dt> <dd>  <?php if(!empty($listing_detail->product_isbn)) { echo $listing_detail->product_isbn; } ?></dd>
                       <!--  <dt>Network</dt> <dd>  <?php //if(!empty($listing_detail->product_make)) { echo $listing_detail->product_make; } ?></dd> -->
                        <dt>Quantity</dt> <dd> <?php if(!empty($listing_detail->qty_available)) { echo $listing_detail->qty_available; } ?></dd>
                    </dl>
                      <div class="hr-line-dashed"></div>
                    <dl class="dl-horizontal">
                        <h4>Price</h4>
                        <dt>Sale Currency:</dt> <dd> <?php if(!empty($listing_detail->currency)) { echo $listing_detail->currency; } ?></dd>
                        <dt>GBP Price:</dt> <dd><strong>  &pound;96.00</strong></dd>
                        <dt>EUR Price:</dt> <dd>  &euro;130.55</dd>
                        <dt>USD Price:</dt> <dd>  $147.59</dd>
                    </dl>
                     <div class="hr-line-dashed"></div> 
                    <dl class="dl-horizontal">
                        <h4>Shipping</h4>
                        <dt>Courier</dt> <dd> <?php if(!empty($listing_detail->courier)) { echo $listing_detail->courier; } ?></dd>
                        <dt>Terms:</dt> <dd> <?php if(!empty($listing_detail->shipping_term)) { echo $listing_detail->shipping_term; } ?></dd>
                    </dl>
                  <div class="hr-line-dashed"></div>
                </div>
                <div class="col-lg-6">
                    <p style="text-align:center">
                       <?php if(!empty($listing_detail->image1)) {?>
                        <img style="height: 300px;" src="<?php echo base_url().$listing_detail->image1; ?>" /><br /><br />
                        <?php } ?>
                        <?php if(!empty($listing_detail->listing_end_datetime)) { ?> 
                        <span style="color:red">Listing Ends: <?php echo $listing_detail->listing_end_datetime; ?></span><br /><br />
                        <?php } ?>
                        <button type="button" class="btn btn-danger" style="font-size:10px">Pay asking price</button>
                    </p>
                        
                    <dl class="dl-horizontal" style="margin-top:20px">
                        <h4>or Make an Offer</h4>
                        <dt><div class="input-group m-b"><span class="input-group-addon">QTY</span>  
                            <input type="text" class="form-control" /><span class="input-group-addon">@</span></dt> 
                            <dd><div class="input-group m-b"><span class="input-group-addon"><?php if(!empty($listing_detail->currency)) { echo $listing_detail->currency; } ?></span>  
                            <input type="text" class="form-control" /></dd>
                        <p style="text-align:center"><button type="button" class="btn btn-warning" style="font-size:10px">Send Offer</button></p>
                        <p class="small" style="text-align:center">Offers sent will expire after 24 hours</p>
                        
                </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <h4>Product Description</h4>
                    <p><?php if(!empty($listing_detail->product_desc)) { echo $listing_detail->product_desc; } ?></p>
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
       
</div>
</form>
</div>


    <style>
.error{
  color:rgba(255, 0, 0, 0.7);
  padding-left: 5px;
}
.error:before{
    content: "*";
    padding: 3px;
}
</style>