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
<div class="row">
<div class="col-lg-12">
<?php msg_alert(); ?>
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5>Listing Details
<?php if (!empty($member_id) && $member_id==$listing_detail->member_id): ?>
<span class="label label-danger pull-right">this is your listing</span>
<?php endif ?></h5>
</div>
<div class="ibox-content">
<div class="wrapper wrapp er-content">
<div class="row">
<div class="col-lg-5">               
    <dl class="dl-horizontal">
        <h4>Product Details</h4>
        <dt>Make:</dt> <dd>  <?php if(!empty($listing_detail->product_make)) { echo $listing_detail->product_make; } ?></dd>
        <dt>Model:</dt> <dd>  <?php if(!empty($listing_detail->product_model)) { echo $listing_detail->product_model; } ?></dd>
        <!-- <dt>Memory:</dt> <dd> <?php //if(!empty($listing_detail->product_make)) { echo $listing_detail->product_make; } ?></dd> -->
        <dt>Colour:</dt> <dd>  <?php if(!empty($listing_detail->product_color)) { echo $listing_detail->product_color; } ?>
          <?php if($listing_detail->allow_color){?>
          <b>( Allow offers for all colors )</b>
          <?php } ?>
        </dd>
        <dt>Product Type:</dt> <dd>  <?php if(!empty($listing_detail->product_type)) { echo $listing_detail->product_type; } ?></dd>
        <dt>Condition:</dt> <dd>  <?php if(!empty($listing_detail->condition)) { echo $listing_detail->condition; } ?></dd> 
        <dt>Spec</dt> <dd>  <?php if(!empty($listing_detail->spec)) { echo $listing_detail->spec; } ?></dd>
        <dt>MPN/ISBN</dt> <dd>  <?php if(!empty($listing_detail->product_mpn_isbn)) { echo $listing_detail->product_mpn_isbn; } ?></dd>
        
       <!--  <dt>Network</dt> <dd>  <?php //if(!empty($listing_detail->product_make)) { echo $listing_detail->product_make; } ?></dd> -->
        <dt>Quantity</dt> <dd> <?php if(!empty($listing_detail->qty_available)) { echo $listing_detail->qty_available; } 
          $min_qty_to_sell=0;
          if($listing_detail->min_qty_order){
            $min_qty_to_sell=$listing_detail->min_qty_order;
          }
        ?></dd>
    </dl>
      <div class="hr-line-dashed"></div>
    <dl class="dl-horizontal">
        <h4>Price</h4>
        <dt>Sale Currency:</dt> <dd> <?php if(!empty($listing_detail->currency)) { echo currency_class($listing_detail->currency); } ?></dd>
        <dt>GBP Price:</dt> <dd>  &pound; <?php echo get_currency(currency_class($listing_detail->currency), 'GBP', $listing_detail->unit_price); ?></dd>
        <dt>EUR Price:</dt> <dd>  &euro; <?php echo get_currency(currency_class($listing_detail->currency), 'EUR', $listing_detail->unit_price); ?></dd>
        <dt>USD Price:</dt> <dd>  $ <?php echo get_currency(currency_class($listing_detail->currency), 'USD', $listing_detail->unit_price); ?></dd>
    </dl>
     <div class="hr-line-dashed"></div> 
    <?php if(!empty($listing_detail->courier) && $listing_detail->listing_type==1){   ?>
    <dl class="dl-horizontal">
        <h4>Shipping</h4>
        <dt>Courier</dt> <dd> <?php if(!empty($listing_detail->courier)) { echo $listing_detail->courier; } ?></dd>
      <?php if(!empty($listing_detail->shipping_term)) { ?>  <dt>Terms:</dt> <dd> <?php echo $listing_detail->shipping_term; ?></dd> <?php } ?>
    </dl>
    <?php } 
     elseif(!empty($listing_detail->sell_shipping_fee) && $listing_detail->listing_type==2){   ?>
      <table class="table table-bordered">
          <thead>
          <tr>
              <th>Shipping Terms</th>
              <th>Couriers</th>
              <th>Batch</th>
              <th>Price</th>
          </tr>
          </thead>
          <tbody id="opt_table">
            <?php
                foreach(json_decode($listing_detail->sell_shipping_fee) as $key => $value){
                   ?>
                  <tr><td><?php if(!empty($value->shipping_term)) echo $value->shipping_term; ?><input type="hidden" name="shipping_terms[]" value="<?php if(!empty($value->shipping_term)) echo $value->shipping_term; ?>"/></td>
                  <td><?php if(!empty($value->coriars)) echo $value->coriars; ?><input type="hidden" name="coriars[]" value="<?php if(!empty($value->coriars)) echo $value->coriars; ?>"/></td>
                  <td><?php if(!empty($value->shipping_types)) echo $value->shipping_types; ?><input type="hidden" name="ship_types[]" value="<?php if(!empty($value->shipping_types)) echo $value->shipping_types; ?>"/></td>
                  <td><?php if(!empty($value->shipping_fees)){echo $value->shipping_fees;}else{ echo"Free";} ?></td>
                  </tr>
            <?php }  ?>
          </tbody>
    </table>
  <?php } ?>
        <div class="hr-line-dashed"></div>
      </div>
<div class="col-lg-7">
 <?php 
    $img1 = ''; $img2 = ''; $img3 = ''; $img4 = ''; $img5 = '';
if(!empty($listing_detail->image1))
    $img1 = explode('/', $listing_detail->image1); 
if(!empty($listing_detail->image1)) 
    $img2 = explode('/', $listing_detail->image2);
if(!empty($listing_detail->image1))
    $img3 = explode('/', $listing_detail->image3);
if(!empty($listing_detail->image1))
    $img4 = explode('/', $listing_detail->image4);
if(!empty($listing_detail->image1))
    $img5 = explode('/', $listing_detail->image5);
    ?>
<div class="main_image_gallery">
<?php  if(!empty($img1[3])): ?>
<img id="zoom_03" src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img1[3]; ?>" data-zoom-image="<?php echo base_url().'public/upload/listing/'.$img1[3]; ?>" class="gallerymainimg"/>
<?php else: ?>
<img src="<?php echo base_url().'public/main/template/gsm/images/icons/apple-touch-icon-180x180.png'; ?>"/>
<?php endif; ?>
</div>
<div id="gallery_01">
<?php if(!empty($listing_detail->image2)): ?> 
  <a href="#" data-image="<?php echo base_url().'public/upload/listing/thumbnail/'.$img1[3]; ?>" data-zoom-image="<?php echo base_url().'public/upload/listing/'.$img1[3]; ?>">
    <img id="img_01" class="gallerythumbsize" src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img1[3]; ?>" />
  </a>
<?php endif; ?>
 <?php if(!empty($listing_detail->image2)): ?>
  <a href="#" data-image="<?php echo base_url().'public/upload/listing/thumbnail/'.$img2[3]; ?>" data-zoom-image="<?php echo base_url().'public/upload/listing/'.$img2[3]; ?>">
    <img id="img_02" class="gallerythumbsize" src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img2[3]; ?>" />
  </a>
<?php endif; ?>
<?php if (!empty($listing_detail->image3)): ?>
  <a href="#" data-image="<?php echo base_url().'public/upload/listing/thumbnail/'.$img3[3]; ?>" data-zoom-image="<?php echo base_url().'public/upload/listing/'.$img3[3]; ?>">
    <img id="img_03" class="gallerythumbsize" src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img3[3]; ?>" />
  </a>
<?php endif ?>
<?php if (!empty($listing_detail->image4)): ?>
  <a href="#" data-image="<?php echo base_url().'public/upload/listing/thumbnail/'.$img4[3]; ?>" data-zoom-image="<?php echo base_url().'public/upload/listing/'.$img4[3]; ?>">
    <img id="img_04" class="gallerythumbsize" src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img4[3]; ?>" />
  </a>
  <?php endif ?>
<?php if (!empty($listing_detail->image5)): ?>
  <a href="#" data-image="<?php echo base_url().'public/upload/listing/thumbnail/'.$img5[3]; ?>" data-zoom-image="<?php echo base_url().'public/upload/listing/'.$img5[3]; ?>">
    <img id="img_05" class="gallerythumbsize" src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img5[3]; ?>" />
  </a>
<?php endif ?>
</div>
<div class="clearfix"></div>
<div class="col-md-8 col-md-offset-2 text-center">
    <?php if(!empty($listing_detail->listing_end_datetime)) { ?> 
    <span class="countdowncounter" >Listing Ends : <span data-countdown="<?php echo $listing_detail->listing_end_datetime; ?>"></span>
    </span>
    <br /><br />
    <?php } ?>
   
</div>
<div class="clearfix"></div>
<?php if (!empty($member_id) && $member_id!=$listing_detail->member_id): ?> 
<!-- pay asking price -->
<br>
<div class="col-md-8 col-md-offset-2">
<span>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal5" >Pay asking price</button>
</span>&nbsp;&nbsp;
<span><b>or Make an Offer</b></span>
<dl class="dl-horizontal"  disabled>
 <?php if (!empty($min_qty_to_sell)){ ?>
  <span>you will not able enter quantity to below <b><?php echo $min_qty_to_sell ?></b> otherwise would be auto rejected. </span><br>
<?php } ?>
<form method="post" action="<?php echo base_url().'marketplace/make_offer'?>" class="make_offer">
<div class="row">
    <div class="col-md-6">
    <div class="input-group m-b">
    <span class="input-group-addon">QTY</span> 
    <input type="text" name="product_qty" class="form-control" value="<?php echo set_value('product_qty'); ?>" required="" />
    <span class="input-group-addon">@</span>
     <input type="hidden" name="listing_id" class="form-control" value="<?php echo $listing_detail->id; ?>" />
    </div> 
    </div>
   <div class="col-md-6">
    <div class="input-group m-b">
    <span class="input-group-addon">
    <?php if(!empty($listing_detail->currency)) { echo currency_class($listing_detail->currency); } ?>
    </span>  
    
    <input type="text" class="form-control" name="unit_price" value="<?php echo set_value('unit_price'); ?>" required="" />
    </div>
   
    </div>
    <div class="col-md-12">
    <a class="btn btn-warning senddataajax" >Send Offer </a>
    </div>
</div>
</form>
<div style="display:none;" class="offer_message_maindiv">
  <div id="offer_message"></div>
</div>
    <p class="">Offers sent will expire after 24 hours</p>
    </dl>
</div>
     <?php endif; ?>
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
    <?php if (!empty($member_id) && $member_id!=$listing_detail->member_id): ?>
        <a href="<?php echo base_url().'marketplace/listing_watch/'.$listing_detail->member_id.'/'.$listing_detail->id ?>" class="btn btn-warning">Watch</a>
       <!--  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#price_graph">Product Price Data</button> -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profile_user">Seller Profile</button>
    <?php endif; ?>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#profile_message">Ask a question</button>
        <a href="<?php echo base_url().'marketplace/sell' ?>" class="btn btn-white">Back</a>
    </div>
            
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
              <h4 class="modal-title"><strong>Buying Request</strong> by GSMStockMarket.com Limited</h4>
            
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-lg-6">
                      <dl class="dl-horizontal">
                         <dt>Quantity:</dt> <dd> <?php if(!empty($listing_detail->qty_available)) { echo $listing_detail->qty_available; } ?></dd>
                       </dl>  
                       <dl class="dl-horizontal">  
                          <dt>Unit Price:</dt> <dd> <?php if(!empty($listing_detail->unit_price) && !empty($listing_detail->currency)) { echo currency_class($listing_detail->currency).' '.$listing_detail->unit_price; } ?></dd>
                       </dl>  
                       <dl class="dl-horizontal">  
                          <input type="hidden" id="total_price" value="<?php if(!empty($listing_detail->unit_price) && !empty($listing_detail->qty_available)) echo $listing_detail->unit_price * $listing_detail->qty_available; ?>">
                          <dt>Total Offer Price:</dt> <dd> <?php if(!empty($listing_detail->unit_price) && !empty($listing_detail->qty_available)) { echo currency_class($listing_detail->currency).' '.$listing_detail->unit_price * $listing_detail->qty_available; } ?></dd>
                      </dl>
                  </div>
                  <div class="col-lg-6">
                      <p style="text-align:center">
                        <dl class="dl-horizontal">
                          <h4>Shipping</h4>
                           <dt>Courier</dt> <dd> <?php if(!empty($listing_detail->courier)) { 
                            $core =  explode(',', $listing_detail->courier); 
                            ?>
                            <select name="coriar" id="core" class="form-control">
                              <option value="">select courier</option>
                              <?php $demo_amt = 10;  foreach ($core as $key => $value): ?>
                              <option value="<?php echo $demo_amt; ?>">
                              <?php echo  $value; ?>
                              </option>
                                
                              <?php $demo_amt++;  endforeach; ?>
                            </select>
                          <?php  } ?></dd>
                      </dl>
                      <dl class="dl-horizontal">
                      <dt>Gross price:</dt>
                      <dd id="gross_price"> No Gross Price Available yet.</dd>
                      </dl>  
                      </p>
                      <dl class="dl-horizontal" style="margin-top:20px">
                         
                          <p style="text-align:center"><button type="button" class="btn btn-warning" >Send Offer</button></p>
                          <p class="small" style="text-align:center">Offers sent will expire after 24 hours</p>
                      </dl>
                  </div>
                  </div>
                 
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
          <small class="font-bold"><?php if(!empty($company->company_name)) echo $company->company_name ?></small>
      </div>
      <div class="modal-body">
        <!--   <img src="public/main/template/gsm/images/marketplace/profile_summary.jpg" /> -->
<div class="row" style="background:#FFF;">
<div class="col-md-8 col-md-offset-1">
    <h1><?php if(!empty($company->company_name)) echo $company->company_name ?></h1>
</div>
<div class="col-md-6">
 <table width="100%" border="0" cellpadding="5" cellspacing="5">
        <tr>
            <th width="55%" class="text-right">Status : </th>
            <td class="pull-left">                 <?php //print_r($company) ?>
            <?php //if(!empty($company)) { ?>
                <?php //if ($company->status==0): ?>
                <!-- <span class="label label-danger pull-right">Pending</span> -->
                <?php //endif ?>
                 <?php //if ($company->status==1): ?>
                <!-- <span class="label label-primary pull-right">Active</span> -->
                <?php //endif ?>
                 <?php //if ($company->status==2): ?>
                <!-- <span class="label label-warning pull-right">Save For later</span> -->
                <?php //endif ?>
                 <?php //if ($company->status==3): ?>
                <!-- <span class="label label-danger pull-right">Inactive</span> -->
                <?php //endif ?>
            <?php //} ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <th class="text-right">Subscription: </th>
            <td> <?php if(!empty($memberships->membership)) echo $memberships->membership." Member"; ?></td>
        </tr>
        <tr>
            <th class="text-right">Company Number:</th>
            <td> <?php if(!empty($company->company_number)) echo $company->company_number ?></td>
        </tr>
        <tr>
            <th class="text-right"> VAT/Tax Number:</th>
            <td> <?php if(!empty($company->vat_tax)) echo $company->vat_tax ?></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <th class="text-right">Address:</th>
            <td>
            <?php if(!empty($company->address_line_1)) echo $company->address_line_1 ?><br>
            <?php if(!empty($company->address_line_2)) echo $company->address_line_2 ?><br>
            <?php if(!empty($company->town_city)) echo $company->town_city ?><br>
            <?php if(!empty($company->county)) echo $company->county ?><br>
            <?php if(!empty($company->post_code)) echo $company->post_code ?><br>
            <?php if(!empty($company->country)) echo $company->country ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <th class="text-right">Primary Business:</th>
            <td> <?php if(!empty($company->business_sector_1)) echo $company->business_sector_1 ?></td>
        </tr>
        <tr>
            <th class="text-right">Secondary Business:</th>
            <td > <?php if(!empty($company->business_sector_2)) echo $company->business_sector_2 ?></td>
        </tr>
        <tr>
            <th class="text-right">Tertiary Business:</th>
            <td> <?php if(!empty($company->business_sector_3)) echo $company->business_sector_3 ?></td>
        </tr>
        <tr>
            <th class="text-right" valign="top">Other Activities :</th>
            <td> <?php if(!empty($company->other_business)) echo $company->other_business ?></td>
        </tr>
    </table>
</div>
<div class="col-md-6">
    <table  width="100%" border="0" cellpadding="5" cellspacing="5">
        <tr>
            <th class="text-right"></th>
            <th align="center0">
                  <img width="200" src="public/main/template/gsm/images/members/no_profile.jpg" />
            </th>
        </tr>
         <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <th width="35%" class="text-right">Title:</th>
            <td width="50%">  <?php if(!empty($member->firstname)) echo $member->firstname ?></td>
        </tr>
        <tr>
            <th class="text-right">Firstname: </th>
            <td> <?php if(!empty($member->firstname)) echo $member->firstname ?></td>
        </tr>
        <tr>
            <th class="text-right">Surname:  </th>
            <td> <?php if(!empty($member->lastname)) echo $member->lastname ?></td>
        </tr>
        <tr>
            <th class="text-right">Role: </th>
            <td> <?php if(!empty($member->role)) echo $member->role ?></td>
        </tr>
        <tr>
            <th class="text-right">Phone Number: </th>
            <td> <?php if(!empty($member->phone_number)) echo $member->phone_number ?></td>
        </tr>
        <tr>
            <th class="text-right">Mobile Number: </th>
            <td> <?php if(!empty($member->mobile_number)) echo $member->mobile_number ?></td>
        </tr>
        <tr>
            <th class="text-right">Facebook: </th>
            <td> <?php if(!empty($member->facebook)) echo $member->facebook ?></td>
        </tr>
        <tr>
            <th class="text-right">Twitter: </th>
            <td> <?php if(!empty($member->twitter)) echo $member->twitter ?></td>
        </tr>
        <tr>
            <th class="text-right">Google Plus: </th>
            <td> <?php if(!empty($member->gplus)) echo $member->gplus ?></td>
        </tr>
        <tr>
            <th class="text-right">LinkedIn: </th>
            <td> <?php if(!empty($member->linkedin)) echo $member->linkedin ?></td>
        </tr>
        <tr>
            <th class="text-right">Skype: </th>
            <td> <?php if(!empty($member->skype)) echo $member->skype ?></td>
        </tr>
    </table>
</div>
</div>
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
  <div class="modal inmodal fade" id="profile_message" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h4 class="modal-title">Ask Question</h4>
                  <small class="font-bold">Welcome to GSMStockMarket.com. Ask your question.</small>
              </div>
              <form id="question_form">
                  <div class="modal-body">
                  <div id="msg"></div>
                      <input type="hidden" name="listing_id" class="listing" value="<?php if(!empty($listing_detail->id)) echo $listing_detail->id; ?>"/>
                      <input type="hidden" name="seller_id" value="<?php if(!empty($listing_detail->member_id)) echo $listing_detail->member_id; ?>"/>
                      <textarea rows="10" cols="10" class="form-control" name="ask_question" placeholder="Enter your question." required></textarea>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="send_msg">Send Message</button>
                  </div>
              </form>
              <div class="question_list"></div>
          </div>
      </div>
  </div>
<script>
$(document).ready(function(){
    $('#send_msg').on('click', function(){
      var question_form =  $('#question_form').serialize();
      $.post('<?php echo base_url() ?>marketplace/listing_question', question_form,function(data){
        $('#msg').html(data);
       });
    });
   
    $.get('<?php echo base_url()."marketplace/get_listing_question/".$listing_detail->id; ?>', function(data){
        $('.question_list').html(data);
       })
});
</script>
<script src="public/admin/js/jquery.countdown.min.js"></script>
<script src="public/main/template/core/js/plugins/validate/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
$(".validation").validate({});
});
jQuery(document).ready(function($) {
$('[data-countdown]').each(function() {
   var $this = $(this), finalDate = $(this).data('countdown');
   $this.countdown(finalDate, function(event) {
     $this.html(event.strftime('%Dd %Hh %Mm %Ss'));
   });
 });
<?php if(!empty($listing_detail->unit_price) && !empty($listing_detail->qty_available)) { ?>
$('#core').on('change', function(){
  $('#gross_price').html('<?php echo currency_class($listing_detail->currency).' '; ?>'+(parseInt($(this).val()) + parseInt($('#total_price').val())));
 
});
<?php } ?>
});
$("#zoom_03").elevateZoom({gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true,zoomWindowPosition: 10,zoomWindowHeight: 400, zoomWindowWidth:400, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif',}); 
//pass the images to Fancybox
$("#zoom_03").bind("click", function(e) {  
  var ez =   $('#zoom_03').data('elevateZoom'); 
  $.fancybox(ez.getGalleryList());
  
  return false;
});
</script>
<script>
$(document).ready(function() {
  $( ".senddataajax" ).click(function() {
    var classname='bg-warning';
    var offermessage='';
     var product_qty=$('input[name="product_qty"]').val();
     var minimum_qty_purchase=<?php echo $min_qty_to_sell;?>;
     if(minimum_qty_purchase !='' || minimum_qty_purchase !='null'){
      if(product_qty < minimum_qty_purchase || product_qty=="null" || product_qty=="" ){
          if(minimum_qty_purchase){
            //offermessage = 'Mention atleast '+minimum_qty_purchase+' Quantity.';
            alert('Mention atleast '+minimum_qty_purchase+' Quantity.');
          }else{
            //offermessage ='Mention Quantity.';
            alert('Mention Quantity.');
          }
         return false;
        }
       }
     var unit_price=$('input[name="unit_price"]').val();
     if(!unit_price){
      //offermessage ='Mention per unit price.';
      alert('Mention per unit price.');
      return false;
     }
    $.post('<?php echo base_url("marketplace/make_offer")?>', $( ".make_offer" ).serialize(), function(data) {
      if(data.STATUS=='1'){
        alert('Offer added sucessfully.');
      }
      else if(data.STATUS=='2'){
        alert('Offer limit exceed.');
      }
      else if(data.STATUS=='4'){
        alert('Offer is not accepted.');
      }
      else if(data.STATUS=='5'){
        if(data.chance_left > 0){
           alert('Chance left to give offer '+data.chance_left);
        }
        else{
         alert('Your all chances get over now try it after 24 hours.');
        }
      }
      else if(data.STATUS=='6'){
        alert('Try it after some hours.');
      }
      else if(data.STATUS=='7'){
        alert('Offer is Already accepted.');
      }
      else{
        alert('Offer is rejected.');
      }
    });
    /*alert(classname);
    alert(offermessage);*/
    
   // $('.offer_message_maindiv').CSS('display: block;');
    //$('#offer_message').addClass(classname);
   });
  });
</script>
<style>
.question_list{
    padding: 0 3%;
}
/*set a border on the images to prevent shifting*/
#gallery_01 img{border:2px solid #ccc;padding: 5px;}
#gallery_01{ text-align: center; }
/*Change the colour*/
.active img{border:2px solid #333 !important;}
.gallerythumbsize{
  max-height: 75px;
  max-width: 75px;
}
.main_image_gallery{
  text-align: left;
  margin-bottom: 20px;
  /*padding: 0px;*/
}
.main_image_gallery .zoomWrapper img{  display: block;
  padding: 10px;
  border: 2px solid #E5E5E5;
  border-radius: 5px;}
table tr th{
  vertical-align: top;}
table tr td{
padding-left:20px;}
.error{
color:rgba(255, 0, 0, 0.7);
padding-left: 5px;
}
.error:before{
content: "*";
padding: 3px;
}
.gallerymainimg{
  max-height: 400px;
  max-width: 400px;
}
.main_image_gallery .zoomWrapper{margin-bottom: 20px;margin: 0 auto;}
.countdowncounter{
  background: #EFEFEF;
  padding: 3px 18px;
  position: relative;
  top: 10px;
  font-size: 18px;
  border: 1px solid #ccc;
  color: #F70324;
}
</style>