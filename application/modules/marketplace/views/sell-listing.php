<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Create a Selling Offer (WTS)</h2>
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Marketplace</li>
            <li>Sell</li>
            <li class="active"><strong>Create Listing</strong></li>
        </ol>
    </div>
    <div class="col-lg-3">
        <a class="btn btn-success pull-right" style="margin-top:25px;margin-right:10px" href="javascript:void(0);" onclick="javascript:introJs().setOption('showProgress', true).start();">Enable Tutorial</a>
    </div>
</div>

<div class="wrapper wrapper-content">
<?php $id = $this->session->userdata('members_id');$member = $this->member_model->get_where($id);if($member->membership == 1 ){ ?>
            <div class="alert alert-info">
        <p><i class="fa fa-info-circle"></i> <strong>This is a Demo</strong> Silver members and above with criteria met will have access to the live marketplace. Looking to sell something? Create a listing and let people send you offers. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
            </div>
<?php } else if($member->membership == 2 && $member->marketplace == 'inactive'){?>
            <div class="alert alert-warning">
                <p><i class="fa fa-warning"></i> <strong>This is a Demo</strong> You still need to supply 2 trade references so we can enable your membership to view profiles and access the marketplace. <a class="alert-link" href="tradereference">Submit trade references</a>.</p>
            </div>
<?php } else {?>
            <div class="alert alert-info">
                <p><i class="fa fa-warning"></i> Welcome to the <strong>GSM Marketplace v1.0a</strong>. Our marketplace is now live! If you have any issues or trouble using the marketplace please let us know by <a class="alert-link" href="support/submit_ticket">submitting a ticket</a> or if you have any ideas or feedback then <a class="alert-link" href="support/submit_ticket">let us know!</a></p>
            </div>
<?php } ?>
<div class="row">
<?php if($check_securty){?>
<form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal"  enctype="multipart/form-data" onsubmit="return validateFORM();"/>
<div class="col-lg-7">
<?php msg_alert(); ?>
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5>Listing Details</h5>
<a class="btn btn-info btn-xs pull-right" href="javascript:void(0);" onclick="javascript:introJs().setOption('showProgress', true).start();"><i class="fa fa-info"></i> Display Listing Tutorial</a>
</div>
<div class="ibox-content"> <!-- Selling -->
<div style="display:none">
<div class="form-group"><label class="col-md-3 control-label">Schedule Listing</label>
<div class="col-md-9">
 <?php   if(!empty($product_list->status) && $product_list->status==1){ ?>
    <input type="text"  class="form-control" name="schedule_date_time1212" value="<?php if(!empty($product_list->schedule_date_time)) echo $product_list->schedule_date_time; ?>" disabled/>
    <?php }else{ ?>
   <div class="input-group date form_datetime " data-date="<?php if(!empty($product_list->schedule_date_time)) echo $product_list->schedule_date_time; else echo date('Y').'-'.date('m').'-'.date('d') ?>" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
        <input class="form-control"  placeholder="List Now" size="16" type="text" value="<?php if(!empty($product_list->schedule_date_time) && $product_list->scheduled_status){
            echo $product_list->schedule_date_time;}
            elseif(isset($_POST['schedule_date_time']) && !empty($_POST['schedule_date_time'])){  echo set_value('schedule_date_time');}
        else{ /*echo date('d F Y - H:i a'); */ } ?>" readonly >
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span><br>
    <input type="hidden" id="dtp_input1" value="<?php if(!empty($product_list->schedule_date_time)) echo $product_list->schedule_date_time; else echo set_value('schedule_date_time');?>" name="schedule_date_time"/>
    <?php echo form_error('schedule_date_time'); ?>
    </div>
    <small class="text-navy">Listing can be scheduled for future dates, choose a start date and time for your listing.</small>
<?php } ?>
  </div>
    </div>
    <div class="hr-line-dashed"></div>
    </div>
    
    
    
    <section data-step="1" data-intro="Cross check your MPN/ISBN with our database to help you auto fill your listing with ease." data-position='right'>
    <div class="form-group"><label class="col-md-3 control-label">MPN/ISBN <span style="color:red">*</span><br /><small class="text-navy">Search our database</small></label>
      <div class="col-md-6" style="padding-right:0">
          <input type="type" list="mpn" class="form-control check_record check_record_by_mpnisbn" placeholder="Enter a Part Number e.g GH97-15959B"  name="product_mpn" value="<?php if(!empty($product_list->product_mpn_isbn)) echo $product_list->product_mpn_isbn; ?><?php if(!empty($_POST['product_mpn'])) echo $_POST['product_mpn']; ?>"/>
      </div>
      <div class="col-md-3">
      	<button class="btn btn-primary btn-block" type="submit" id="mpn1" style="font-size:10px;padding:9px 12px 8px"><i class="fa fa-search"></i> Check MPN/ISBN</button>
      </div>
      <div class="col-md-9 col-md-offset-3">
      <small class="text-navy">Enter your MPN/ISBN or Manufacturer ID. For example, if you are selling an Apple iPhone 5C related item you can enter the manufactuer ID <strong>A1526</strong> and our system will help you fill out the listing with any data we may have.</small>
      </div>
    </div>
    </section>
    <section data-step="2" data-intro="Once you have your MPN/ISBN you can auto complete these fields automatically or customize your own listing from a range of Makes in our database and if we don't have a model you need you can enter your own." data-position='right'>
     <div class="form-group"><label class="col-md-3 control-label">Make <span style="color:red">*</span></label>
        <div class="col-md-9">
            <select class="chosen-select form-control" id="product_make" name="product_make">
            <option value="" selected disabled>Enter your item make/manufacturer. e.g Samsung</option>
            <?php if(!empty($product_makes)){
            foreach ($product_makes as $row) { ?>
            <option value="<?php echo $row->product_make; ?>" <?php if(!empty($_POST['product_make']) && $row->product_make==$_POST['product_make']){ echo'selected';} elseif(!empty($product_list->product_make) && $row->product_make == $product_list->product_make){ echo'selected';}?>><?php echo $row->product_make; ?></option>
            <?php }} ?>
            </select>
        <?php echo form_error('product_make'); ?>
        </div>
    </div>
   <div class="form-group"><label class="col-md-3 control-label">Model <span style="color:red">*</span></label>
<div class="col-md-9">
 <select class="chosen-select form-control custom-input" id="product_model"  name="product_model">
    <option value="" selected disabled>Enter your item model. e.g iPhone 4S or Galaxy S6 Edge</option>
     <?php if(!empty($product_models)){
         foreach ($product_models as $row) { ?>
        <option value="<?php echo $row->product_model; ?>" <?php if(!empty($_POST['product_model']) && $row->product_model==$_POST['product_model']){ echo'selected';}elseif(!empty($product_list->product_model) && $row->product_model == $product_list->product_model){ echo'selected';}?>><?php echo $row->product_model; ?></option>
         <?php }} ?>
    </select>
<?php echo form_error('product_model'); ?>
</div>
</div>
     <div class="form-group"><label class="col-md-3 control-label">Colour <span style="color:red">*</span></label>
      <div class="col-md-9">
 		<select data-placeholder="What is the primary colour of the item?" class="chosen-select form-control" id="product_color" name="product_color">
          <option value="" selected disabled>What is the primary colour of the item?</option>
          <option value="None">No Colour</option>
           <?php 
           if(!empty($product_colors)){
            $k=0;
               foreach ($product_colors as $row) { 
                ?>
              <option value="<?php echo $row; ?>" <?php if(!empty($_POST['product_color']) && $row==$_POST['product_color']){ echo'selected';}?><?php if(!empty($product_list->product_color) && $row == $product_list->product_color){ echo'selected';}?>><?php echo $row; ?></option>
               <?php $k++;}} ?>
          </select>
           <?php echo form_error('product_color'); ?>
      </div>
    </div>
<div class="form-group"><label class="col-md-3 control-label">Product Type <span style="color:red">*</span></label>
<div class="col-md-9">
<select data-placeholder="Select a category for your item" name="product_type" id="product_type" class="form-control check_record">
  <option selected value="0" disabled>Select a category for your item</option>
  <?php if (!empty($product_types)): ?>
  <?php foreach ($product_types as $row): ?>
      <optgroup label="<?php echo $row->category_name ?>">
      <?php if (!empty($row->childs)): ?>
      <?php foreach ($row->childs as $child): ?>
          <option value="<?php echo $child->category_name ?>" <?php if(!empty($_POST['product_type']) && $child->category_name==$_POST['product_type']){ echo'selected';}?>
          <?php if(!empty($product_list->product_type) && $child->category_name==$product_list->product_type){ echo'selected="selected"';}?>>- <?php echo $child->category_name ?></option>
          <?php endforeach ?>
      <?php endif ?>
      </optgroup>
  <?php endforeach ?>
  <?php endif ?>
    </select>
    <?php echo form_error('product_type'); ?>
</div>
</div>
</section>
<span class="Handset <?php if(!empty($_POST['product_type']) && $_POST['product_type']=='Handset'){  echo 'SHOW';}
    elseif(!empty($product_list->product_type) && $product_list->product_type =='Handset'){
          echo 'SHOW';
    }else{ echo'listing_hide';} ?>">
<div class="hr-line-dashed Tablet"></div>
 <div class="form-group"><label class="col-md-3 control-label">Spec</label>
    <div class="col-md-9">
        <select data-placeholder="What market is this item for?" class="form-control" name="spec">
            <option selected value="" disabled>What market is this item for?</option>
            <?php $spec = spec();
            if($spec){
                foreach ($spec as $key => $value){ ?>
                  <option value="<?php echo $value; ?>" <?php if(!empty($_POST['spec']) && $value==$_POST['spec']){ echo'selected';}
                   elseif(!empty($product_list->spec) && $value==$product_list->spec){ echo'selected';}?>><?php echo $value; ?></option>
                  <?php }
            } ?>
        </select>
        <?php echo form_error('spec'); ?>
    </div>
</div>
<div class="form-group Tablet"><label class="col-md-3 control-label">Capacity</label>
<div class="col-md-9">
    <select data-placeholder="What is the hard drive capacity on the item?" class="form-control" name="device_capacity">
        <option selected value="">What is the hard drive capacity on the item?</option>
        <option value="2GB" <?php if(!empty($_POST['device_capacity']) && '2GB'==$_POST['device_capacity']){ echo'selected';} elseif(!empty($product_list->device_capacity) && '2GB'==$product_list->device_capacity){ echo'selected';}?>>2GB</option>
        <option value="4GB" <?php if(!empty($_POST['device_capacity']) && '4GB'==$_POST['device_capacity']){ echo'selected';} elseif(!empty($product_list->device_capacity) && '4GB'==$product_list->device_capacity){ echo'selected';}?>>4GB</option>
        <option value="8GB" <?php if(!empty($_POST['device_capacity']) && '8GB'==$_POST['device_capacity']){ echo'selected';} elseif(!empty($product_list->device_capacity) && '8GB'==$product_list->device_capacity){ echo'selected';}?>>8GB</option>
        <option value="16GB" <?php if(!empty($_POST['device_capacity']) && '16GB'==$_POST['device_capacity']){ echo'selected';} elseif(!empty($product_list->device_capacity) && '16GB'==$product_list->device_capacity){ echo'selected';}?>>16GB</option>
        <option value="32GB" <?php if(!empty($_POST['device_capacity']) && '32GB'==$_POST['device_capacity']){ echo'selected';} elseif(!empty($product_list->device_capacity) && '32GB'==$product_list->device_capacity){ echo'selected';}?>>32GB</option>
        <option value="64GB" <?php if(!empty($_POST['device_capacity']) && '64GB'==$_POST['device_capacity']){ echo'selected';} elseif(!empty($product_list->device_capacity) && '64GB'==$product_list->device_capacity){ echo'selected';}?>>64GB</option>
        <option value="128GB" <?php if(!empty($_POST['device_capacity']) && '128GB'==$_POST['device_capacity']){ echo'selected';} elseif(!empty($product_list->device_capacity) && '128GB'==$product_list->device_capacity){ echo'selected';}?>>128GB</option>
        <option value="256GB" <?php if(!empty($_POST['device_capacity']) && '256GB'==$_POST['device_capacity']){ echo'selected';} elseif(!empty($product_list->device_capacity) && '256GB'==$product_list->device_capacity){ echo'selected';}?>>256GB</option>
        <option value="Unknown">Unknown</option>
    </select>
</div>
</div>

<div class="form-group"><label class="col-md-3 control-label">Sim Status</label>
<div class="col-md-9">
    <select data-placeholder="What is the devices sim status?" class="form-control" name="device_sim">
        <option selected dsiabled>What is the phone sim status?</option>
        <option <?php if(!empty($_POST['device_sim']) && 'Sim Free'==$_POST['device_sim']){ echo'selected';} elseif(!empty($product_list->device_sim) && 'Sim Free'==$product_list->device_sim){ echo'selected';}?> value="Sim Free">Sim Free</option>
        <option <?php if(!empty($_POST['device_sim']) && 'Network Unlocked'==$_POST['device_sim']){ echo'selected';} elseif(!empty($product_list->device_sim) && 'Network Unlocked'==$product_list->device_sim){ echo'selected';}?>>Network Unlocked</option>
        <option <?php if(!empty($_POST['device_sim']) && 'Network Locked'==$_POST['device_sim']){ echo'selected';} elseif(!empty($product_list->device_sim) && 'Network Locked'==$product_list->device_sim){ echo'selected';}?> value="Network Locked">Network Locked</option>
        <option <?php if(!empty($_POST['device_sim']) && 'Unknown'==$_POST['device_sim']){ echo'selected';} elseif(!empty($product_list->device_sim) && 'Unknown'==$product_list->device_sim){ echo'selected';}?> value="Unknown">Unknown</option>
    </select>
</div>
</div>

<div class="form-group"><label class="col-md-3 control-label">IMEI Report</label>
<div class="col-md-9">
    <input type="text" disabled="" placeholder="IMEI services coming soon" class="form-control">
    <small class="text-navy">Link your IMEI reports to your handset listings to providing in-depth handset data to potential buyers.</small>
</div>
</div>
</span>
        
<div class="hr-line-dashed"></div>
    <section data-step="3" data-intro="After completing your items basic data let buyers know what condition your listed item is with our in-depth condition options" data-position='right'>
    <div class="form-group"><label class="col-md-3 control-label" data-toggle="modal" data-target="#condition" style="cursor:pointer">Condition <i class="fa fa-question-circle"></i><span style="color:red">*</span></label>
<div class="col-md-9">
    <select data-placeholder="What condition is the item in?" class="form-control" name="condition">
    <option value="" selected disabled>What condition is the item in?</option>
    <?php $condition = condition();
    if($condition){
        foreach ($condition as $key => $value){ ?>
          <option value="<?php echo $value; ?>" <?php if(!empty($_POST['condition']) && $value==$_POST['condition']){ echo'selected';}?><?php if(!empty($product_list->condition) && $value == $product_list->condition){ echo'selected="selected"';}?>><?php echo $value; ?></option>
          <?php }
    } ?>
    </select>
    <?php echo form_error('condition'); ?>
</div>      
      <div class="col-md-9 col-md-offset-3">
      <small class="text-navy">Not sure on which condition option to choose? View our condition descriptions <strong data-toggle="modal" data-target="#condition">here</strong> for a more in-depth description.</small>
      </div>
</div>
</section>
<div class="hr-line-dashed"></div>
<section data-step="4" data-intro="Choose which currency you wish to sell in. All payments will be taken in the listing currency to allow you access to a worldwide audience. All listings will have approximation exchange rates of other currencies in Euro, GBP and USD free of charge!" data-position='right'>
 <div class="form-group"><label class="col-md-3 control-label">Currency <span style="color:red">*</span></label>
   <div class="col-md-9">
       <select class="form-control" name="currency">
           <?php $default_currency='';
          $default_currency = default_currency(); ?>
           <?php $currency = currency();
           if($currency){
               $i=1;
              $default_curr='';
           foreach ($currency as $key => $value){ ?>
           <?php  echo $unit = explode(' ', $value); ?>
           <?php if($default_currency->currency=='EURO'){
               $default_curr = 'EUR';
           }else{
            $default_curr = $default_currency->currency;
           } ?>
             <option <?php if(!empty($_POST['currency']) && $i==$_POST['currency']){ echo'selected';}elseif(!empty($product_list->currency) && $i==$product_list->currency){ echo'selected';}elseif($default_curr==$unit[1]){ echo "selected"; } ?> value="<?php echo $i;?>"><?php echo $value; ?></option>
             <?php $i++;}
           } ?>
       </select>
       <p class="small text-navy">Select the currency you wish this listing to be sold in.</p>
       <?php echo form_error('currency'); ?>
   </div>
</div>
</section>
<section data-step="5" data-intro="Set your unit price and the minimum price at which you would like to sell if you would like to allow offers on your listing." data-position='right'>
<div class="form-group"><label class="col-md-3 control-label">Unit Price <span style="color:red">*</span></label>
    <div class="col-md-9">
        <input type="type" class="form-control two-digits" name="unit_price" value="<?php if(!empty($product_list->unit_price)) echo $product_list->unit_price; else echo set_value('unit_price');?>"/>
       <p class="small text-navy">Your price per individual item.</p>
        <?php echo form_error('unit_price'); ?>
    </div>
</div>
<div class="form-group"><label class="col-md-3 control-label">Minimum Price</label>
    <div class="col-md-9">
        <div class="input-group">
        <span class="input-group-addon">
        <input type="checkbox" name="minimum_checkbox" id="minimum_checkbox" <?php if(isset($_POST['minimum_checkbox']) ){ echo'checked';} elseif(!empty($product_list->min_price)){ echo'checked';}?>/> </span>
        <input type="text" class="form-control two-digits" placeholder="What is your minimum price?" name="min_price" value="<?php if(!empty($product_list->min_price)){ echo $product_list->min_price; }
        elseif(isset($_POST['min_price'])){  echo $_POST['min_price'];}?>"
        <?php if(isset($_POST['minimum_checkbox']) ){ echo'';} elseif(empty($product_list->min_price) ){ echo'disabled';}?>></div>
        <p class="small text-navy">Tick to allow offers on unit price. Any offers below this will be auto rejected, leave blank to allow offers of any price if ticked.</p>
        <?php echo form_error('min_price'); ?>
    </div>
</div>
</section>
<section data-step="6" data-intro="Manage your stock availability here by entering how many units you have available to sell. You can also specify a minimum order quantity to sell in batches." data-position='right'>
<div class="form-group"><label class="col-md-3 control-label">QTY Available <span style="color:red">*</span></label>
  <div class="col-md-9">
      <input type="type" class="form-control no-digits" name="total_qty" value="<?php if(!empty($product_list->total_qty)) echo $product_list->total_qty; else  echo set_value('total_qty');?>"/>
    <p class="small text-navy">How many of this item do you have available to sell?</p>
      <?php echo form_error('total_qty'); ?>
  </div>
</div>
<div class="form-group"><label class="col-md-3 control-label">Min Order Quantity</label>
<div class="col-md-9">
    <div class="input-group"><span class="input-group-addon"> <input type="checkbox" name="orderqunatity_checkbox" id="orderqunatity_checkbox"
    <?php if(isset($_POST['orderqunatity_checkbox']) ){ echo'checked';} elseif(!empty($product_list->min_qty_order)){ echo'checked';}?>/> </span>
    <input type="text" class="form-control no-digits" placeholder="Minimum Order Quantity" name="min_qty_order" value="<?php if(!empty($product_list->min_qty_order)){ echo $product_list->min_qty_order;} 
    elseif(isset($_POST['min_qty_order'])){  echo $_POST['min_qty_order'];} ?>"

    <?php if(isset($_POST['orderqunatity_checkbox']) ){ echo'';} elseif(empty($product_list->min_qty_order) ){ echo'disabled';}?>
    ></div>
    <p class="small text-navy">Allow minimum order quantity else users can only buy the full quantity sale available only.</p>
    <?php echo form_error('min_qty_order'); ?>
</div>
</div>
</section>
  <div class="hr-line-dashed"></div>
    <section data-step="7" data-intro="Display in-depth shipping options by creating custom options with our shipping terms and couriers on top of listing item shipping free, priced per unit or just a flat fee to widen your selling audience" data-position='right'>
    <div class="form-group"><label class="col-md-3 control-label" data-toggle="modal" data-target="#shipping" style="cursor:pointer">Shipping Terms <i class="fa fa-question-circle"></i></label>
<div class="col-md-9">
    <select class="form-control" name="shipping_term" onchange="shippings_to_couriers(this.value);">
        <option value="">Select Terms</option>
        <?php if($shippings){
            foreach ($shippings as $row){  ?>
              <option value="<?php echo $row->id; ?>@@<?php echo $row->shipping_name; ?>" <?php //if(!empty($_POST) && $row->id.'@@'.$row->shipping_name==$_POST['shipping_term']){ echo'selected="selected"';} ?><?php if(!empty($product_list->shipping_term) && $row->shipping_name == $product_list->shipping_term){ echo'selected="selected"'; } ?>><?php echo $row->shipping_name; ?> <?php echo $row->description; ?></option>
              <?php }
        } ?>
    </select>
    <?php echo form_error('shipping_term'); ?>
     <div id="shipping_termMsg"></div>
    </div>
    </div>
    <div class="form-group"><label class="col-md-3 control-label">Courier</label>
  <div class="col-md-9">
     <div id="couriers_data"> <?php $product = array(); if(!empty($product_list->courier)){ $product = explode(',', $product_list->courier); }
    if (!empty($couriers)) {
         foreach ($couriers as $key => $value): ?>
             <label class="checkbox-inline i-checks iCheck-helper"><input type="checkbox" value="<?php echo $value->courier_name; ?>" name="courier[]" <?php if(!empty($product) && in_array($value->courier_name, $product)){ echo'checked';}?>/> <?php echo $value->courier_name;?> </label>
        <?php endforeach;   } ?>
      </div>
      <br>
      <div id="courierMsg"></div>
  </div>
    </div>
    <div class="form-group shipping-fee" <?php if(!empty($product_list->sell_shipping_fee)) echo 'style="display:block;"'; else echo 'style="display:none;"'; ?>>
        <label class="col-md-3 control-label">Shipping Fee</label>
        <div class="col-md-3">
            <select class="form-control shipping-type" name="shipping_type">
                <option value="Free_Shipping" selected>Free shipping</option>
                <option value="Flat_fee">Flat fee</option>
                <option value="Price_per_unit">Price per unit</option>
            </select>
        </div>
        <div class="col-md-3 ">
            <input type="text" class="form-control shipping-opt" name="shipping_fee" disabled/>
        </div>
        <div class="col-md-3">
            <a class="btn btn-primary btn-block shipping-opt" id="add_shipping" style="font-size:10px;padding:9px 12px"><i class="fa fa-plus"></i> Add Shipping Option</a>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-9 col-md-offset-3">
            <div id="shipping_feesMsg"></div>
        </div>
    </div>
    <div class="form-group"><label class="col-md-3 control-label">Shipping Options <span style="color:red">*</span><br /><small class="text-navy">Add at least one (1) option</small></label>
    <div class="col-md-9">
    <table class="table table-bordered">
      <thead>
      <tr>
          <th>Shipping Terms</th>
          <th>Couriers</th>
          <th>Batch</th>
          <th>Price</th>
          <th></th>
      </tr>
      </thead>
      <tbody id="opt_table">
      <?php
      if(!empty($product_list->sell_shipping_fee)){
            $productlistjsondecode=json_decode($product_list->sell_shipping_fee);
        if($productlistjsondecode){
        foreach($productlistjsondecode as $key => $value){
         ?>
          <tr><td><?php echo $value->shipping_term; ?><input type="hidden" name="shipping_terms[]" value="<?php if(!empty($value->shipping_term)) echo $value->shipping_term; ?>"/></td>
          <td><?php echo $value->coriars; ?><input type="hidden" name="coriars[]" value="<?php if(!empty($value->coriars)) echo $value->coriars; ?>"/></td>
          <td><?php echo $value->shipping_types; ?><input type="hidden" name="ship_types[]" value="<?php if(!empty($value->shipping_types)) echo $value->shipping_types; ?>"/></td>
          <td><?php echo $value->shipping_fees; ?><input type="hidden" name="shipping_fees[]" value="<?php if(!empty($value->shipping_fees)) echo $value->shipping_fees; ?>"/></td>
          <td style="text-align:center"><a class="wrapper btn btn-danger btn-circle" style="width:20px;height:20px;border-radius:10px;font-size:10px;padding:0;margin-bottom:0"><i class="fa fa-times"></i></a></td>
          </tr>
    <?php   }}
        }
      ?>
      </tbody>
    </table>
    <p style="color:red"><strong>Notice:</strong> Make sure you add at least one shipping option to the table so buyers can send you offers. If you have no shipping options in this table you will be unable to sell this item even though it may be listed!</p>
    </div>
    </div>
    </section>
    
    <section data-step="8" data-intro="Describe your item to potential buyers and select a listing duration and once you have added some optional images of your item on the right hand side you are ready to go!" data-position='right'>
    <div class="hr-line-dashed"></div>
     <div class="form-group"><label class="col-md-3 control-label">Product Description <span style="color:red">*</span><br /><small class="text-navy">Add any useful information buyers would like to know. This will be displayed at the bottom of the listing.</small></label>
        <div class="col-md-9">
            <textarea type="type" class="form-control" rows="5" id="product_desc" name="product_desc"><?php if(!empty($product_list->product_desc)) echo $product_list->product_desc; else echo set_value('product_desc');?></textarea>
            <?php echo form_error('product_desc'); ?>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group"><label class="col-md-3 control-label">List Duration <span style="color:red">*</span></label>
        <div class="col-md-9">
            <?php if(!empty($product_list->duration)){
                    ?><input disabled  class="form-control" value="<?php echo $product_list->duration;?> day"><?php 
                }else{ ?>
                <select class="form-control" name="duration">
                <?php $duration = list_duration();
                if($duration){
                      foreach ($duration as $key => $value){ ?>
              <option value="<?php echo $value; ?>" <?php if(!empty($_POST['duration']) && $value==$_POST['duration']){ echo'selected';}
            elseif(isset($product_list->duration) && $value==$product_list->duration){ echo'selected';}
            elseif($value == 7){ if(empty($_POST['duration'])){ echo'selected';}} ?>><?php echo $value; ?> day</option>
              <?php }
                } ?>
                </select>
                <?php echo form_error('duration'); ?>
                <?php } ?>
        </div>
    </div>
   </section>
   
    <section data-step="9" data-intro="In a rush? Save your listing for later. If you're all set then click list now and your item will be on our worldwide marketplace in a matter of seconds!" data-position='right'>
    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
        
        <?php if($member->marketplace == 'active'){ ?>
        <?php if ($this->uri->segment(4)!='' && $this->uri->segment(4)=='saved_listing'): ?>
                <a class="btn btn-danger" href="<?php echo base_url().'marketplace/saved_listing'; ?>">Cancel</a>
        <?php else: ?>
                 <a class="btn btn-danger" href="<?php echo base_url().'marketplace/listing/'; ?>">Cancel</a>
        <?php endif ?>
        <?php if($this->uri->segment(3)==''): ?><!--
            <button class="btn btn-warning" type="submit" name="status" value="2">Save for later</button>-->
        <?php endif; ?>
           	<button class="btn btn-primary" type="submit" name="status" value="1">Create and List Now</button>
        <?php } else {?>              <!--
            <button class="btn btn-warning" data-toggle="modal" data-target="#upgrade">Save for later</button>-->
           	<a class="btn btn-primary" data-toggle="modal" data-target="#upgrade">Create and List Now</a>
        <?php } ?>
        </div>
    </div>
    </section>
 </div>
</div>
</div>
    <div class="col-lg-5">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Listing Pictures</h5>
                <br>
                <h4 class="danger">Item images Min size is 400 X 400 and Max size is 1200 X 1200.</h4>
            </div>
            <div class="ibox-content">
            <div class="row">
                <div class="col-md-12" style="text-align:center">
                <label  class="col-md-4" >Image 1</label>
                <div  class="col-md-8">
                <?php if (!empty($product_list->image1) && file_exists($product_list->image1)):
                $img1 = explode('/', $product_list->image1)?>
                    <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img1[3]; ?>" class="thumbnail uplodedimage"/>
                <?php endif ?>
                 <input type="file" name="image1" class="btn default btn-file">
                </div>
                 <?php echo form_error('image1'); ?>
                 <label  class="col-md-4" >Image 2</label>
                <div  class="col-md-8">
                <?php if (!empty($product_list->image2) && file_exists($product_list->image2)):
                $img2 = explode('/', $product_list->image2)?>
                    <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img2[3]; ?>" class="thumbnail uplodedimage"/>
                <?php endif ?>
                 <input type="file" name="image2" class="btn default btn-file">
                 </div>
                 <?php echo form_error('image2'); ?>
                 <label  class="col-md-4" >Image 3</label>
                <div  class="col-md-8">
                <?php if (!empty($product_list->image3)&& file_exists($product_list->image3)):
                $img3 = explode('/', $product_list->image3)?>
                    <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img3[3]; ?>" class="thumbnail uplodedimage"/>
                <?php endif ?>
                 <input type="file" name="image3" class="btn default btn-file">
                 </div>
                 <?php echo form_error('image3'); ?>
                 <label  class="col-md-4" >Image 4</label>
                <div  class="col-md-8">
                <?php if (!empty($product_list->image4)&& file_exists($product_list->image4)):
                $img4 = explode('/', $product_list->image4)?>
                    <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img4[3]; ?>" class="thumbnail uplodedimage"/>
                <?php endif ?>
                 <input type="file" name="image4" class="btn default btn-file">
                 </div>
                 <?php echo form_error('image4'); ?>
                  <label  class="col-md-4" >Image 5</label>
                <div  class="col-md-8">
                 <?php if (!empty($product_list->image5)&& file_exists($product_list->image5)):
                $img5 = explode('/', $product_list->image5)?>
                    <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img5[3]; ?>" class="thumbnail uplodedimage"/>
                <?php endif ?>
                 <input type="file" name="image5" class="btn default btn-file">
                 </div>
                 <?php echo form_error('image5'); ?>
                </div>
                <p class="small" style="text-align:center">You may have up to five (5) product images per listing.<br />Accepted types: <strong>.JPG, .JPEG, .PNG, .GIF</strong></p>
            </div>
            </div>
        </div>
    </div>
</form>
<?php } else{?>
    <p class="bg-danger validation_message">Invalid listing ID or you have not permission to access this listing.</p>
<?php } ?>
</div>
</div>
<!-- Chosen -->
<script src="public/main/template/core/js/plugins/chosen/chosen.jquery.js"></script>
<script>
    jQuery(document).ready(function($) {
            /* multi select */
    var config = {
        '.chosen-select'           : {search_contains:true},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"},
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    });
</script>
    <!-- checkbox css -->
    <link href="public/main/template/core/css/plugins/iCheck/custom.css" rel="stylesheet">
    <!-- iCheck -->
    <script src="public/main/template/core/js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
    </script>
    <script>
   function validateFORM () {
        var shipping_term = $('select[name="shipping_term"]').val();
        if(shipping_term==''){
            $('body').find('#shipping_termMsg').html('<span class="error">The Shipping terms field is required.</span>');
            $('select[name="shipping_term"]').focus();
             return false;
        }else{
            $('body').find('#shipping_termMsg').html('');
            var courierLength =$('[name="courier[]"]:checked').length;
            if(courierLength==0){
                $('body').find('#courierMsg').html('<span class="error">Please select atleast one courier.</span>');
                $('select[name="shipping_term"]').focus();
                return false;
            }else{
                $('body').find('#courierMsg').html('');
                 var shipping_feesLength =$('[name="shipping_fees[]"]').length;
                 console.log('shipping_feesLength '+shipping_feesLength);
                if(shipping_feesLength==0) {
                    $('body').find('#shipping_feesMsg').html('<span class="error">Please select atleast one shipping and handling fee.</span>');
                    $('select[name="shipping_type"]').focus();
                    return false;
                }            }
        }
    }
    function shippings_to_couriers (ship_id) {
        $.get('<?php echo base_url() ?>marketplace/shippings_to_couriers_data/'+ship_id, function(data) {
            $('#couriers_data').html(data);
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    }
jQuery(document).ready(function($) {
    $('body').find('#couriers_data').on('ifClicked ifUnchecked','input[type="checkbox"]',function(event){
        $('.shipping-fee').show();
     });
var shipping_type = '';
$('.shipping-type').on('change',function(){
    if($(this).val() == 'Free_Shipping'){
    $('.shipping-opt').prop('disabled',true);
    $('.shipping-opt').val('');
    shipping_type = $(this).val();
    }else{
    $('.shipping-opt').prop('disabled',false);
     shipping_type = $(this).val();
    }
    });
    var add_shipping1=0;
    $("#add_shipping").on("click", function() {
        shipping_type = $('.shipping-type').val();
    if(shipping_type !='' || shipping_type != 'Free_Shipping'){
        var coriar = [];
        $('body').find('#couriers_data input:checked').each(function(index, val){
        var sThisVal = (this.checked ? $(this).val() : "");
        coriar.push(sThisVal);
        });
        var trm  =  $('select[name="shipping_term"]').val().split('@@');
        var shipping_term = trm[1];
        var core = coriar;
        var ship_type = shipping_type;
        if(core=='' || core==null){
             alert('At least one courier must be selected to add the shipping option');
            return false;
         }
        if(!shipping_type){
             alert('At least one shipping term must be selected to add the shipping option');
            return false;
         }
        shipping_fee ='0';
        if($('input[name="shipping_fee"]').val()){
            shipping_fee = $('input[name="shipping_fee"]').val();
         }
        $('#opt_table').append('<tr><td>'+shipping_term+'<input type="hidden" name="shipping_terms[]" value="'+shipping_term+'"/></td><td>'+core+'<input type="hidden" name="coriars[]" value="'+core+'"/></td><td>'+ship_type+'<input type="hidden" name="ship_types[]" value="'+ship_type+'"/></td><td>'+shipping_fee+'<input type="hidden" name="shipping_fees[]" value="'+shipping_fee+'"/></td><td style="text-align:center"><a class="wrapper btn btn-danger btn-circle" style="width:20px;height:20px;border-radius:10px;font-size:10px;padding:0;margin-bottom:0"><i class="fa fa-times"></i></a></td></tr>');
        }
        else{
            alert('Enter Shipping Fee');
            return false;
        }
    });
});
$('body').find('#opt_table').on("click", ".wrapper",function() {
       // alert($(this).html());
        $(this).closest("tr").remove();
});
</script>
 
 
 
 
    <table class="table table-bordered">
      <thead>
      </thead>
      <tbody id="opt_table">
 
 
<!-- Jquery Validate -->
<script>
$.validator.setDefaults({ ignore: ":hidden:not(select)" })
$(".validation").validate({
  rules: {
    product_mpn: "required",
    product_desc: "required",
    product_make: "required",
    product_model: "required",
    product_color: "required",
    product_type: "required",
    unit_price: { required: true,number: true },
    total_qty: { required: true,number: true },
    condition: "required",
    termsandcondition: "required",
  },
  messages: {
    product_desc: "Make sure you have entered a thorough description of the item you have for sale.",
    product_mpn: {
      required: "We required some sort of product identifying number.",
	},
    product_make: {
      required: "Select your products make from the list below",
	},
    product_model: {
      required: "Buyers will need to know what model this product is for.",
	},
    product_color: {
      required: "Make sure buyers know what colour the product is.",
	},
    product_type: {
      required: "We require a category to put your product listing under.",
	},
   unit_price: {
      required: "You need to specify a unit price!",
	},
    total_qty: {
      required: "How many do you have for sale?",
	},
    condition: {
      required: "Buyers will need to know what condition the item is.",
    }
  }
});

// apply the two-digits behaviour to elements with 'two-digits' as their class
$( function() {
    $('.two-digits').keyup(function(){
        if($(this).val().indexOf('.')!=-1){         
            if($(this).val().split(".")[1].length > 2){                
                if( isNaN( parseFloat( this.value ) ) ) return;
                this.value = parseFloat(this.value).toFixed(2);
            }  
         }            
         return this; //for chaining
    });
    $('.no-digits').keyup(function(){
        if($(this).val().indexOf('.')!=-1){         
            if($(this).val().split(".")[1].length > 0){                
                if( isNaN( parseFloat( this.value ) ) ) return;
                this.value = parseFloat(this.value).toFixed(0);
            }  
         }            
         return this; //for chaining
    });
});

$(document).ready(function(){
    $('#TextBoxId').keypress(function(e){
      if(e.keyCode==13)
      $('#linkadd').click();
    });
	var select, chosen;

    // cache the select element as we'll be using it a few times
    select = $(".custom-input");

    // init the chosen plugin
    select.chosen();
    
    // get the chosen object
    chosen = select.data('chosen');

    // Bind the keyup event to the search box input
    chosen.dropdown.find('input').on('keyup', function(e)
    {
        // if we hit Enter and the results list is empty (no matches) add the option
        if (e.which == 13 && chosen.dropdown.find('li.no-results').length > 0)
        {
            var option = $("<option>").val(this.value).text(this.value);
           
            // add the new option
            select.prepend(option);
            // automatically select it
            select.find(option).prop('selected', true);
            // trigger the update
            select.trigger("chosen:updated");
        }
    });
	
});
</script>

<script>
$(document).ready(function () {
  $('.listing_hide').hide();
  $(document).on('change', '#product_type', function(event) {
    $('.Handset').hide();
    $('.'+$(this).val()).show();
  })
});          
$(document).ready(function(){
	 var test123 =function(mpn1,make){
     $.post('<?php echo base_url("marketplace/getAttributesInfo") ?>/MAKE/',{'make':make,'mpnisbn':mpn1}, function(data) {
        productmakehtml='<option>Choose Model</option>';
       $.each(data.product_make, function(index, val) {
            productmakehtml +='<option value="'+val+'"';
            if(data.numrows>=1)
            productmakehtml +=' Selected';
            productmakehtml +=' >'+val+'</option>';
       });
       $('select[name="product_model"]').html(productmakehtml);
       $('select[name="product_model"]').trigger("chosen:updated");
    });
  }

 var modelselect =function(mpn1,make){
     $.post('<?php echo base_url("marketplace/getAttributesInfo") ?>/MAKE/',{'make':make,'mpnisbn':mpn1}, function(data) {
        productmakehtml='<option>Choose Model</option>';
       $.each(data.product_make, function(index, val) {
            productmakehtml +='<option value="'+val+'"';
            if(data.num_rows==1)
            productmakehtml +=' Selected';
            productmakehtml +=' >'+val+'</option>';
       });
       $('select[name="product_model"]').html(productmakehtml);
       $('select[name="product_model"]').trigger("chosen:updated");
    });
}

$(document).on('click', '#mpn1', function(event) {
    event.preventDefault();
    var  mpnisbn1 = $('.check_record_by_mpnisbn').val();
     if(mpnisbn1 == "null" || mpnisbn1 == ""){
        alert('Please put MPN/ISBN to check');
        return false;
    }
    
    $.post('<?php echo base_url("marketplace/getAttributesInfo") ?>/MPNISBN/',{'mpnisbn':mpnisbn1}, function(data) {
      if(data.Status == false){
          /*       alert('No such MPN/ISBN found in our Database.');*/
           return false;
         }
        productmakehtml='<option value="">Choose Make</option>';
        var mk1product_make=0;
       
       $.each(data.product_make, function(index, val) {
            productmakehtml +='<option value="'+val+'"';
            if(data.condition == '1'){
            productmakehtml +=' selected="selected"';
                mk1product_make=val;
            }
            productmakehtml +=' >'+val+'</option>';

       });
        $("#product_type option:selected").prop("selected", false);
        $('.Handset').hide();
         if(data.Status==true){
         if(data.product_types == 'Handset'){
            $('.Handset').show();
         }
         else{
            $('.Handset').hide();
         }
          $('#product_type option[value='+data.product_types+']').prop("selected", true);
        }

       if(data.Status=true){
       $('select[name="product_make"]').html(productmakehtml);
       $('select[name="product_make"]').trigger("chosen:updated");
        var product_make= mk1product_make;
           test123(mpnisbn1,product_make);
       }
       //colors select
        var product_colorshtml='<option value="">Choose Color</option>';
        $.each(data.product_colors, function(index, val) {
          product_colorshtml +='<option value="'+val+'"';
          if(data.condition == '1' && data.product_colors.length==1){
            product_colorshtml +=' selected="selected"';
            }
          product_colorshtml +=' >'+val+'</option>';

        });

      $('body').find('#product_color').html('');
        $('select[name="product_color"]').html(product_colorshtml);
       $('select[name="product_color"]').trigger("chosen:updated");
    });
});
$(document).on('change', '#product_make', function(event) {
    event.preventDefault();
        var mpn1 =$('#mpn1').val();
        var product_make= $(this).val();
        modelselect(mpn1,product_make);     
    });
    $(document).on('change', '#product_model', function(event) {
    event.preventDefault();
        var product_model= $(this).val();
         $.post('<?php echo base_url("marketplace/getAttributesInfo") ?>/MODAL/',{'product_model':product_model}, function(data) {
        product_colorshtml='<option>Choose Colour</option>';
       $.each(data.product_color, function(index, val) {
            product_colorshtml +='<option value="'+val+'"';
            if(data.num_rows==1 && data.product_color.length==1)
            product_colorshtml +=' Selected';
            product_colorshtml +=' >'+val+'</option>';
       });
       $('select[name="product_color"]').html(product_colorshtml);
       $('select[name="product_color"]').trigger("chosen:updated");
      });
    });
 });

$(document).ready(function() {
    $('#minimum_checkbox').change(function(event) {
        if ($(this).is(':checked')) {
            $('input[name="min_price"]').prop('disabled', false);
        }
        else{
           $('input[name="min_price"]').val('');
           $('input[name="min_price"]').prop('disabled', true);
        }
    });
    $('#allowoffer_checkbox').change(function(event) {
        if ($(this).is(':checked')) {
            $('select[name="allow_offer"]').prop('disabled', false);
        }
        else{
           $('select[name="allow_offer"]').prop('disabled', true);
        }
    });
    $('#orderqunatity_checkbox').change(function(event) {
        if ($(this).is(':checked')) {
            $('input[name="min_qty_order"]').prop('disabled', false);
        }
        else{
            $('input[name="min_qty_order"]').val('');
           $('input[name="min_qty_order"]').prop('disabled', true);
        }
    });
    $('#listing_type').on('change', function(){
        if($(this).val() == 1){
        $('.sell-offer').hide();
        $('.buying').show();
        }else if($(this).val() == 2){
        $('.sell-offer').show();
        $('.buying').hide();
        }else{
        $('.sell-offer').show();
        $('.buying').show();
        }
    });
    });
 </script>
<script type="text/javascript" src="public/admin/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="public/admin/js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        startDate: today
    });
    </script>
    <style>
.error{
  color:rgba(255, 0, 0, 0.7);
  color: rgba(255, 0, 0, 0.81);
  padding: 7px 0px 0px 0px;
}
.error:before{
    content: "*";
    padding: 3px;
}
.validation_message{
      padding: 10px;
  margin: 2px;
}
.uplodedimage{
    max-width: 250px;
    max-height: 250px;
}
</style>
<div class="modal inmodal fade" id="shipping" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Shipping Terms</h4>
                <small class="font-bold">Incoterms rules or International Commercial Terms</small>
            </div>
            <div class="modal-body">
              <strong>EXW – Ex Works (named place)</strong><br />
              <p>The seller makes the goods available at his/her premises. This term places the maximum obligation on the buyer and minimum obligations on the seller. The Ex Works term is often used when making an initial quotation for the sale of goods without any costs included. EXW means that a buyer incurs the risks for bringing the goods to their final destination. The seller does not load the goods on collecting vehicles and does not clear them for export. If the seller does load the goods, he does so at buyer's risk and cost. If parties wish seller to be responsible for the loading of the goods on departure and to bear the risk and all costs of such loading, this must be made clear by adding explicit wording to this effect in the contract of sale.</p>
              <p>The buyer arranges the pickup of the freight from the supplier's designated ship site, owns the in-transit freight, and is responsible for clearing the goods through Customs. The buyer is also responsible for completing all the export documentation.</p>
              <p>These documentary requirements may cause two principal issues. Firstly, the stipulation for the buyer to complete the export declaration can be an issue in certain jurisdictions (not least the European Union) where the customs regulations require the declarant to be either an individual or corporation resident within the jurisdiction. Secondly, most jurisdictions require companies to provide proof of export for tax purposes. In an Ex-Works shipment the buyer is under no obligation to provide such proof, or indeed to even export the goods. It is therefore of utmost importance that these matters are discussed with the buyer before the contract is agreed. It may well be that another Incoterm, such as FCA seller's premises, may be more suitable.</p>
              <strong>FOB – Free on Board (named port of shipment)</strong><br />
              <p>The seller must advance government tax in the country of origin as of commitment to load the goods on board a vessel designated by the buyer. Cost and risk are divided when the goods are sea transport in containers (see Incoterms 2010, ICC publication 715). The seller must instruct the buyer the details of the vessel and the port where the goods are to be loaded, and there is no reference to, or provision for, the use of a carrier or forwarder. This term has been greatly misused over the last three decades ever since Incoterms 1980 explained that FCA should be used for container shipments.</p>
              <p>It means the seller pays for transportation of goods to the port of shipment, loading cost. The buyer pays cost of marine freight transportation, insurance, unloading and transportation cost from the arrival port to destination. The passing of risk occurs when the goods are in buyer account. The buyer arranges for the vessel and the shipper has to load the goods and the named vessel at the named port of shipment with the dates stipulated in the contract of sale as informed by the buyer.</p>
              <strong>CPT – Carriage Paid To (named place of destination)</strong><br />
              <p>CPT replaces the venerable C&F (cost and freight) and CFR terms for all shipping modes outside of non-containerised seafreight.</p>
              <p>The seller pays for the carriage of the goods up to the named place of destination. Risk transfers to buyer upon handing goods over to the first carrier at the place of shipment in the country of Export. The Shipper is responsible for origin costs including export clearance and freight costs for carriage to named place (usually a destination port or airport). The shipper is not responsible for delivery to the final destination (generally the buyer's facilities), or for buying insurance. If the buyer does require the seller to obtain insurance, the Incoterm CIP should be considered.</p>
              <strong>CIP – Carriage and Insurance Paid to (named place of destination)</strong><br />
              <p>This term is broadly similar to the above CPT term, with the exception that the seller is required to obtain insurance for the goods while in transit. CIP requires the seller to insure the goods for 110% of their value under at least the minimum cover of the Institute Cargo Clauses of the Institute of London Underwriters (which would be Institute Cargo Clauses (C)), or any similar set of clauses. The policy should be in the same currency as the contract.</p>
              <p>CIP can be used for all modes of transport, whereas the equivalent term CIF can only be used for non-containerised seafreight.</p>
              <strong>Data Source</strong><br />
              <p>Taken from <a href="http://en.wikipedia.org/wiki/Incoterms" target="_blank">Incoterms Wikipedia page</a></p>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal fade" id="condition" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Item Conditions</h4>
                <small class="font-bold">Condition and Gradings</small>
            </div>
            <div class="modal-body">
              <strong>New</strong><br />
              <p>An unused brand new product.</p>
              <strong>Refurbished (OEM)</strong><br />
              <p>to “as new” condition from the manufacturer of the item.</p>
              <strong>Refurbished (Seller)</strong><br />
              <p>to “as new” condition from the seller of the item.</p>
              <strong>Grade A</strong><br />
              <p>Excellent condition, may have very light signs of use.</p>
              <strong>Grade B</strong><br />
              <p>Good Condition, will have marks/scratches from medium use.</p>
              <strong>Grade C</strong><br />
              <p>Fair Condition, will have marks/scratches from heavier use.</p>
              <strong>Grade F (BER)</strong><br />
              <p>Faulty. Beyond Economical Repair.</p>
              <strong>Used</strong><br />
              <p>Mixed used conditions and grades, may be untested. See item description for more information.</p>
              <p style="color:red">It is very important that you follow these grading guidelines closely. All resolution processes with strictly follow these definitions.</p>
              
              
            </div>
        </div>
    </div>
</div>
<style>
.chosen-container-single .chosen-single {border-color:#e5e6e7;color:#555}
</style>

<!-- Database Models -->
<datalist id="mpn">
<?php if(!empty($listing_attributes)){
     foreach ($listing_attributes as $row) { ?>
       <?php if (!empty($row->product_mpn_isbn)): ?>
    <option value="<?php echo $row->product_mpn_isbn; ?>"><?php echo $row->product_mpn_isbn; ?></option>
      <?php endif ?>
     <?php }} ?>
</datalist>


<link href="public/main/template/gsm/css/plugins/intro/introjs.min.css" rel="stylesheet">
<script type="text/javascript" src="public/main/template/gsm/js/plugins/intro/intro.min.js" charset="UTF-8"></script>