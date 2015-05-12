<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li>
            <a href="/">Home</a>
        </li>
        <li class="active">
            <strong>Buying Request</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">
</div>
</div>
<?php $id = $this->session->userdata('members_id');$member = $this->member_model->get_where($id);
if($member->membership > 1 && $member->marketplace == 'active'){ ?>
<div class="wrapper wrapper-content">
<div class="row">
<?php if($check_securty){?>
<form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal"  enctype="multipart/form-data"/>
<div class="col-lg-7">
<?php msg_alert(); ?>
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5>Listing Details</h5>
</div>
<div class="ibox-content"> <!-- Selling -->
 <div class="form-group"><label class="col-md-3 control-label">Schedule Listing</label>
            <div class="col-md-9">
   <?php  if(!empty($product_list->scheduled_status) &&  $product_list->scheduled_status==1 && $product_list->status==1){ ?>
    <input type="text"  class="form-control" name="schedule_date_time1212" value="<?php if(!empty($product_list->schedule_date_time)) echo $product_list->schedule_date_time; ?>" disabled/>
    <?php }else{ ?>
    <div class="input-group date form_datetime " data-date="<?php if(!empty($product_list->schedule_date_time)) echo $product_list->schedule_date_time; else echo date('Y-m-d') ?>" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
        <input class="form-control" size="16" type="text" placeholder="List Now" value="<?php if(!empty($product_list->schedule_date_time)){
            echo $product_list->schedule_date_time;}
            elseif(isset($_POST['schedule_date_time']) && !empty($_POST['schedule_date_time'])){  echo set_value('schedule_date_time');}
        else{ /*echo date('d F Y - H:i a'); */ } ?>" readonly >
        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span><br>
    </div>
    <?php echo form_error('schedule_date_time'); ?>
     Listing can be scheduled for future dates, by selecting future date.
    <input type="hidden" id="dtp_input1" value="<?php if(!empty($product_list->schedule_date_time)) echo $product_list->schedule_date_time; else echo set_value('schedule_date_time');?>" name="schedule_date_time"/><br/>
    <?php } ?>
    </div>
    </div>
<div class="hr-line-dashed"></div>
<div class="form-group"><label class="col-md-3 control-label">MPN/ISBN</label>
<div class="col-md-7">
    <input type="text" id="mpn1" list="mpn" class="form-control check_record" placeholder="e.g A1586 or SM-G925"  name="product_mpn" value="<?php if(!empty($_POST['product_mpn'])) echo $_POST['product_mpn']; elseif(!empty($product_list->product_mpn_isbn)) echo $product_list->product_mpn_isbn; ?>"/>
    <datalist id="mpn">
    <?php if(!empty($listing_attributes)){
         foreach ($listing_attributes as $row) { ?>
           <?php if (!empty($row->product_mpn_isbn)): ?>
            <option value="<?php echo $row->product_mpn_isbn; ?>"  <?php if(!empty($_POST['product_mpn']) && $row->product_mpn_isbn == $_POST['product_mpn']){ echo'selected';}?>><?php echo $row->product_mpn_isbn; ?></option>
          <?php endif ?>
         <?php } } ?>
    </datalist>
     <?php echo form_error('product_mpn'); ?>
</div>
<div class="col-md-2">
<span class="btn btn-primary">Check</span>
</div>
</div>
<div class="form-group"><label class="col-md-3 control-label">Make</label>
<div class="col-md-9">
  <select data-placeholder="Make" class="chosen-select form-control" id="product_make" name="product_make">
    <option value="" disabled selected>e.g Apple or Samsung</option>
   <?php if(!empty($product_makes)){
     foreach ($product_makes as $row) { ?>
    <option value="<?php echo $row->product_make; ?>"
     <?php if(!empty($_POST['product_make']) && $row->product_make==$_POST['product_make']){ echo'selected';}
        elseif(!empty($product_list->product_make) && $row->product_make == $product_list->product_make){ echo'selected';}?>><?php echo $row->product_make; ?></option>
     <?php }} ?>
</select>
<?php echo form_error('product_make'); ?>
</div>
</div>
<div class="form-group"><label class="col-md-3 control-label">Model</label>
<div class="col-md-9">
 <select data-placeholder="- Model -" class="chosen-select form-control" id="product_model"   name="product_model">
    <option value="" disabled selected>e.g: iPhone 4S or Galaxy S6 Edge</option>
     <?php if(!empty($product_models)){
         foreach ($product_models as $row) { ?>
        <option value="<?php echo $row->product_model; ?>" <?php if(!empty($_POST['product_model']) && $row->product_model==$_POST['product_model']){ echo'selected';}?><?php if(!empty($product_list->product_model) && $row->product_model == $product_list->product_model){ echo'selected';}?>><?php echo $row->product_model; ?></option>
         <?php }} ?>
    </select>
<?php echo form_error('product_model'); ?>
</div>
</div>
<div class="form-group"><label class="col-md-3 control-label">Colour</label>
<div class="col-md-9">
 <select data-placeholder="Model" class="chosen-select form-control" id="product_color" name="product_color">
    <option value=""> Choose Color </option>
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
<div class="form-group"><label class="col-md-3 control-label">Product Type</label>
<div class="col-md-9">
<select  name="product_type" id="product_type" class="form-control check_record">
    <option selected value="" >-Select Product Type-</option>
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
<span class="Handset <?php if(!empty($_POST['product_type']) && $_POST['product_type']=='Handset'){  echo 'SHOW';}
    elseif(!empty($product_list->product_type) && $product_list->product_type =='Handset'){
          echo 'SHOW';
    }else{ echo'listing_hide';} ?>">
<div class="hr-line-dashed Tablet"></div>
 <div class="form-group"><label class="col-md-3 control-label">Spec</label>
    <div class="col-md-9">
        <select class="form-control" name="spec">
            <option selected value="">Spec</option>
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
    <select class="form-control" name="device_capacity">
        <option selected value="">- Device capacity -</option>
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
    <select class="form-control" name="device_sim">
        <option selected >- Device sim status -</option>
        <option <?php if(!empty($_POST['device_sim']) && 'Sim Free'==$_POST['device_sim']){ echo'selected';} elseif(!empty($product_list->device_sim) && 'Sim Free'==$product_list->device_sim){ echo'selected';}?> value="Sim Free">Sim Free</option>
        <option <?php if(!empty($_POST['device_sim']) && 'Network Unlocked'==$_POST['device_sim']){ echo'selected';} elseif(!empty($product_list->device_sim) && 'Network Unlocked'==$product_list->device_sim){ echo'selected';}?>>Network Unlocked</option>
        <option <?php if(!empty($_POST['device_sim']) && 'Network Locked'==$_POST['device_sim']){ echo'selected';} elseif(!empty($product_list->device_sim) && 'Network Locked'==$product_list->device_sim){ echo'selected';}?> value="Network Locked">Network Locked</option>
        <option <?php if(!empty($_POST['device_sim']) && 'Unknown'==$_POST['device_sim']){ echo'selected';} elseif(!empty($product_list->device_sim) && 'Unknown'==$product_list->device_sim){ echo'selected';}?> value="Unknown">Unknown</option>
    </select>
</div>
</div>
</span>

<div class="hr-line-dashed"></div>
<div class="form-group"><label class="col-md-3 control-label">Condition</label>
    <div class="col-md-9">
        <select class="form-control" name="condition">
        <option value="">Condition</option>
        <?php $condition = condition();
        if($condition){
            foreach ($condition as $key => $value){ ?>
              <option value="<?php echo $value; ?>" <?php if(!empty($_POST['condition']) && $value==$_POST['condition']){ echo'selected';}?><?php if(!empty($product_list->condition) && $value == $product_list->condition){ echo'selected="selected"';}?>><?php echo $value; ?></option>
              <?php }
        } ?>
        </select>
        <?php echo form_error('condition'); ?>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group"><label class="col-md-3 control-label">Currency </label>
       <div class="col-md-9">
           <select class="form-control" name="currency">
               <?php $default_currency='';
              $default_currency = default_currency();
              $currency = currency();
               if($currency){
                   $i=1;
                  $default_curr='';
               foreach ($currency as $key => $value){ ?>
               <?php  $unit = explode(' ', $value);
                if($default_currency->currency=='EURO'){
                   $default_curr = 'EUR';
               }else{
                $default_curr = $default_currency->currency;
               } ?>
                 <option <?php if(!empty($_POST) && $i==$_POST['currency']){ echo'selected';}elseif(!empty($product_list->currency) && $i==$product_list->currency){ echo'selected';}elseif($default_curr==$unit[1]){ echo "selected"; } ?> value="<?php echo $i;?>"><?php echo $value; ?></option>
                 <?php $i++;}
               } ?>
           </select>
           <p class="small text-navy">Select the currency you wish this listing to be sold in.</p>
           <?php echo form_error('currency'); ?>
       </div>
   </div>
<div class="form-group"><label class="col-md-3 control-label">Unit Price</label>
    <div class="col-md-9">
        <input type="type" class="form-control" name="unit_price" value="<?php if(!empty($product_list->unit_price)) echo $product_list->unit_price; else echo set_value('unit_price');?>"/>
        <?php echo form_error('unit_price'); ?>
    </div>
</div>
 <div class="form-group"><label class="col-md-3 control-label">Max Unit Price</label>
    <div class="col-md-9">
        <div class="input-group m-b"><span class="input-group-addon">
        <input type="checkbox" name="maximum_checkbox" id="maximum_checkbox" <?php if(isset($_POST['maximum_checkbox']) ){ echo'checked';} elseif(!empty($product_list->max_price)){ echo'checked';}?>/> </span>
        <input type="text" class="form-control" placeholder="Maximum Unit Price" name="max_price" value="<?php if(!empty($product_list->max_price)) echo $product_list->max_price; else echo set_value('max_price');?>" <?php if(isset($_POST['maximum_checkbox']) ){ echo'';} elseif(empty($product_list->max_price) ){ echo'disabled';}?>>
        </div>
        <p class="small text-navy">tick to enable. Any offers below this will be auto rejected, leave blank to allow any offers if ticked.</p>
        <?php echo form_error('max_price'); ?>
    </div>
</div>
<div class="form-group"><label class="col-md-3 control-label">Quantity requested</label>
    <div class="col-md-9">
        <input type="type" class="form-control" name="total_qty" value="<?php if(!empty($product_list->total_qty)) echo $product_list->total_qty; else  echo set_value('total_qty');?>"/>
        <?php echo form_error('total_qty'); ?>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group"><label class="col-md-3 control-label">Shipping Terms <button class="btn btn-success btn-circle" type="button" style="width:20px;height:20px;border-radius:10px;font-size:10px;padding:0;margin-bottom:0" data-toggle="modal" data-target="#shipping" title="Click for more information"><i class="fa fa-question"></i></button></label>
 <?php $product = array();
 if(!empty($product_list->courier)){ $product = explode(',', $product_list->courier);  } ?>
<div class="col-md-9">
<?php if($shippings){
    foreach ($shippings as $row){  ?>
        <label class="checkbox-inline i-checks iCheck-helper" title="<?php echo $row->shipping_name; ?>">
        <input type="checkbox" value="<?php echo $row->shipping_name; ?>" name="courier[]" <?php
        if(isset($_POST['courier']) && in_array($row->shipping_name,$_POST['courier'])){
            echo "checked"; }
        elseif(!empty($product_list->courier) && in_array($row->shipping_name,$product)){
            echo "checked";}?>/>
             <?php echo $row->shipping_name; ?></label>
      <?php }
} ?>
 <?php echo form_error('courier'); ?>
</div>
</div>
<div class="form-group"><label class="col-md-3 control-label">Shipping Charges</label>
<div class="col-md-9">
   <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" name="shipping_checkbox" id="shipping_checkbox" <?php if(isset($_POST['shipping_checkbox']) ){ echo'checked';} elseif(!empty($product_list->shipping_charges)) echo 'checked'; ?>/> </span>
     <input type="text" class="form-control" placeholder="" name="shipping_charges" value="<?php if(!empty($product_list->shipping_charges)) echo $product_list->shipping_charges; else  echo set_value('shipping_charges');?>" <?php if(isset($_POST['shipping_charges']) ){ echo'';} elseif(empty($product_list->shipping_charges) ){ echo'disabled';}?>></div>
   <p class="small text-navy">Allow additional shipping charges. Leave unticked for all quotes to include free shipping</p>
</div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group"><label class="col-md-3 control-label">Product Description</label>
    <div class="col-md-9">
        <textarea type="type" class="form-control" rows="5" id="product_desc" name="product_desc"><?php if(!empty($product_list->product_desc)) echo $product_list->product_desc; else echo set_value('product_desc');?></textarea>
        <?php echo form_error('product_desc'); ?>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group"><label class="col-md-3 control-label">List Duration</label>
    <div class="col-md-9">
        <select class="form-control" name="duration">
        <?php $duration = list_duration();
        if($duration){
            foreach ($duration as $key => $value){ ?>
              <option value="<?php echo $value; ?>" <?php if(!empty($_POST['duration']) && $value==$_POST['duration']){ echo'selected';}
            elseif(isset($product_list->duration) && $value==$product_list->duration){ echo'selected';}
            elseif($value == 7){ echo'selected';}?>><?php echo $value; ?> day</option>
              <?php }
        } ?>
        </select>
        <?php echo form_error('duration'); ?>
    </div>
</div>
<?php if (empty($product_list->id)): ?>
<div class="form-group"><label class="col-md-3 control-label">Terms &amp; Conditions</label>
    <div class="col-md-9">
    <input type="checkbox" class="checkbox-inline i-checks" name="termsandcondition" <?php if(!empty($_POST['termsandcondition']) ){ echo'checked';}?>/> I agree to the GSMStockMarket.com Limited Terms and Conditions
     <?php echo form_error('termsandcondition'); ?>
    </div>
</div>
<?php endif ?>
<div class="form-group">
    <div class="col-md-9 col-md-offset-3">
        <?php if ($this->uri->segment(4)!='' && $this->uri->segment(4)=='saved_listing'): ?>
            <a class="btn btn-danger" href="<?php echo base_url().'marketplace/saved_listing'; ?>">Cancel</a>
        <?php else: ?>
         <a class="btn btn-danger" href="<?php echo base_url().'marketplace/listing/'; ?>">Cancel</a>
        <?php endif ?>
         <?php if($this->uri->segment(3)==''): ?>
            <button class="btn btn-warning" type="submit" name="status" value="2">Save for later</button>
        <?php endif; ?>
        <button class="btn btn-primary" type="submit" name="status" value="1" onclick="return validateFORM();">List Now</button>
    </div>
</div>
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
    <?php if (!empty($product_list->image3) && file_exists($product_list->image3)):
    $img3 = explode('/', $product_list->image3)?>
        <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img3[3]; ?>" class="thumbnail uplodedimage"/>
    <?php endif ?>
     <input type="file" name="image3" class="btn default btn-file">
     </div>
     <?php echo form_error('image3'); ?>
     <label  class="col-md-4" >Image 4</label>
    <div  class="col-md-8">
    <?php if (!empty($product_list->image4) && file_exists($product_list->image4)):
    $img4 = explode('/', $product_list->image4)?>
        <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img4[3]; ?>" class="thumbnail uplodedimage"/>
    <?php endif ?>
     <input type="file" name="image4" class="btn default btn-file">
     </div>
     <?php echo form_error('image4'); ?>
       <label  class="col-md-4" >Image 5</label>
    <div  class="col-md-8">
     <?php if (!empty($product_list->image5) && file_exists($product_list->image5)):
    $img5 = explode('/', $product_list->image5)?>
        <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img5[3]; ?>" class="thumbnail uplodedimage"/>
    <?php endif ?>
     <input type="file" name="image5" class="btn default btn-file">
     </div>
     <?php echo form_error('image5'); ?>
    </div>
    <p class="small" style="text-align:center">You may have up to five (5) product images per listing.</p>
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
<?php } else { ?>
<?php if($member->membership == 1 ){ ?>
            <div class="alert alert-info" style="margin:15px 15px -15px">
        <p><i class="fa fa-info-circle"></i> <strong>This is a Demo</strong> Silver members and above with criteria met will have access to the live marketplace. Looking to buy something? Create a listing and let people send you offers. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
            </div>
<?php } else if($member->membership == 2 && $member->marketplace == 'inactive'){?>
            <div class="alert alert-warning" style="margin:15px 15px -15px">
                <p><i class="fa fa-warning"></i> You still need to supply 2 trade references so we can enable your membership to view profiles and access the marketplace. <a class="alert-link" href="tradereference">Submit trade references</a>.</p>
            </div>
<?php }?>
<div class="wrapper wrapper-content">
<div class="row">
<?php if($check_securty){?>
<form method="post"  class="validation form-horizontal"  enctype="multipart/form-data"/>
<div class="col-lg-7">
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5>Listing Details</h5>
</div>
<div class="ibox-content"> <!-- Selling -->
            <div class="form-group"><label class="col-md-3 control-label">Schedule Listing</label>
         <div class="col-md-9">
            <div class="input-group date form_datetime " data-date="<?php if(!empty($product_list->schedule_date_time)) echo $product_list->schedule_date_time; else echo date('Y-m-d') ?>" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                <input class="form-control" size="16" type="text" value="<?php if(!empty($product_list->schedule_date_time)){
                    echo $product_list->schedule_date_time;}
                    elseif(isset($_POST['schedule_date_time']) && !empty($_POST['schedule_date_time'])){  echo set_value('schedule_date_time');}
                else{ echo date('d F Y - H:i a');} ?>" readonly >
                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span><br>
            </div>
            <?php echo form_error('schedule_date_time'); ?>
             Listing can be scheduled for future dates, by selecting future date.
            </div>
            <input type="hidden" id="dtp_input1" value="<?php if(!empty($product_list->schedule_date_time)) echo $product_list->schedule_date_time; else echo set_value('schedule_date_time');?>" name="schedule_date_time"/><br/>
    </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-md-3 control-label">MPN/ISBN</label>
        <div class="col-md-9">
            <input type="text" id="mpn1" list="mpn" class="form-control check_record" placeholder="MPN/ISBN"  name="product_mpn" value="<?php if(!empty($product_list->product_mpn_isbn)) echo $product_list->product_mpn_isbn; ?><?php if(!empty($_POST['product_mpn'])) echo $_POST['product_mpn']; ?>"/>
            <datalist id="mpn">
            <?php if(!empty($listing_attributes)){
                 foreach ($listing_attributes as $row) { ?>
                   <?php if (!empty($row->product_mpn_isbn)): ?>
                    <option value="<?php echo $row->product_mpn_isbn; ?>"  <?php if(!empty($_POST['product_mpn']) && $row->product_mpn_isbn == $_POST['product_mpn']){ echo'selected';}?>><?php echo $row->product_mpn_isbn; ?></option>
                  <?php endif ?>
                 <?php } } ?>
            </datalist>
             <?php echo form_error('product_mpn'); ?>
        </div>
    </div>
    <div class="form-group"><label class="col-md-3 control-label">Make</label>
        <div class="col-md-9">
         <input type="text" list="make" id="product_make" class="form-control check_record" placeholder="Make"  name="product_make" value="<?php if(!empty($product_list->product_make)) echo $product_list->product_make; else echo set_value('product_make');?>"/>
           <datalist id="make">
            <?php if(!empty($product_makes)){
                 foreach ($product_makes as $row) { ?>
                <option value="<?php echo $row->product_make; ?>" <?php if(!empty($_POST) && $row->product_make==$_POST['product_make']){ echo'selected';}?><?php if(!empty($product_list->product_make) && $row->product_make == $product_list->product_make){ echo'selected';}?>><?php echo $row->product_make; ?></option>
                 <?php }} ?>
            </datalist>
        <?php echo form_error('product_make'); ?>
        </div>
    </div>
    <div class="form-group"><label class="col-md-3 control-label">Model</label>
        <div class="col-md-9">
         <input type="text" list="model" id="product_model" class="form-control check_record" placeholder="e.g iPhone 4S or Galaxy S6 Edge"  name="product_model" value="<?php if(!empty($product_list->product_model)) echo $product_list->product_model; else echo set_value('product_model');?>"/>
           <datalist id="model">
            <?php if(!empty($product_models)){
                 foreach ($product_models as $row) { ?>
                <option value="<?php echo $row->product_model; ?>" <?php if(!empty($_POST) && $row->product_model==$_POST['product_model']){ echo'selected';}?><?php if(!empty($product_list->product_model) && $row->product_model == $product_list->product_model){ echo'selected';}?>><?php echo $row->product_model; ?></option>
                 <?php }} ?>
            </datalist>
        <?php echo form_error('product_model'); ?>
        </div>
    </div>
    <div class="form-group"><label class="col-md-3 control-label">Colour</label>
        <div class="col-md-9">
         <input type="text" list="color" id="product_color" class="form-control check_record" placeholder="Colour"  name="product_color" value="<?php if(!empty($product_list->product_color)) echo $product_list->product_color; else echo set_value('product_color');?>"/>
           <datalist id="color">
            <?php if(!empty($product_colors)){
                 foreach ($product_colors as $row) { ?>
                <option value="<?php echo $row->product_color; ?>" <?php if(!empty($_POST) && $row->product_color==$_POST['product_color']){ echo'selected';}?><?php if(!empty($product_list->product_color) && $row->product_color == $product_list->product_color){ echo'selected';}?>><?php echo $row->product_color; ?></option>
                 <?php }} ?>
            </datalist>
        <?php echo form_error('product_color'); ?>
        <input type="checkbox" name="color_allow" value="" <?php if(isset($_POST['color_allow']) ){ echo'checked';} elseif(!empty($product_list->allow_color)){ echo'checked';}?>> Allow offers for all colors.
        </div>
    </div>
     <div class="form-group"><label class="col-md-3 control-label">Product Type</label>
        <div class="col-md-9">
        <select  name="product_type" id="product_type" class="form-control check_record">
            <option selected value="" >-Select Product Type-</option>
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
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-md-3 control-label">Condition</label>
            <div class="col-md-9">
                <select class="form-control" name="condition">
                <option value="">Condition</option>
                <?php $condition = condition();
                if($condition){
                    foreach ($condition as $key => $value){ ?>
                      <option value="<?php echo $value; ?>" <?php if(!empty($_POST) && $value==$_POST['condition']){ echo'selected';}?><?php if(!empty($product_list->condition) && $value == $product_list->condition){ echo'selected="selected"';}?>><?php echo $value; ?></option>
                      <?php }
                } ?>
                </select>
                <?php echo form_error('condition'); ?>
            </div>
        </div>
         <div class="form-group"><label class="col-md-3 control-label">Spec</label>
            <div class="col-md-9">
                <select class="form-control" name="spec">
                    <option selected value="">Spec</option>
                    <?php $spec = spec();
                    if($spec){
                        foreach ($spec as $key => $value){ ?>
                          <option value="<?php echo $value; ?>" <?php if(!empty($_POST) && $value==$_POST['spec']){ echo'selected';}?><?php if(!empty($product_list->spec) && $value==$product_list->spec){ echo'selected';}?>><?php echo $value; ?></option>
                          <?php }
                    } ?>
                </select>
                <?php echo form_error('spec'); ?>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-md-3 control-label">Currency</label>
            <div class="col-md-9">
                <select class="form-control" name="currency">
                    <?php $currency = currency();
                    if($currency){
                        $i=1;
                    foreach ($currency as $key => $value){ ?>
                      <option <?php if(!empty($_POST) && $i==$_POST['currency']){ echo'selected';}?><?php if(!empty($product_list->currency) && $i==$product_list->currency){ echo'selected';}?> value="<?php echo $i;?>"><?php echo $value; ?></option>
                      <?php $i++;}
                    } ?>
                </select>
                <p class="small text-navy">Select the currency you wish this listing to be sold in.</p>
                <?php echo form_error('currency'); ?>
            </div>
        </div>
        <div class="form-group"><label class="col-md-3 control-label">Unit Price</label>
            <div class="col-md-9">
                <input type="type" class="form-control" name="unit_price" value="<?php if(!empty($product_list->unit_price)) echo $product_list->unit_price; else echo set_value('unit_price');?>"/>
                <?php echo form_error('unit_price'); ?>
            </div>
        </div>
         <div class="form-group"><label class="col-md-3 control-label">Max Unit Price</label>
            <div class="col-md-9">
                <div class="input-group m-b"><span class="input-group-addon">
                <input type="checkbox" name="maximum_checkbox" id="maximum_checkbox" <?php if(isset($_POST['maximum_checkbox']) ){ echo'checked';} elseif(!empty($product_list->max_price)){ echo'checked';}?>/> </span>
                <input type="text" class="form-control" placeholder="Maxiumum Unit Price" name="max_price" value="<?php if(!empty($product_list->max_price)) echo $product_list->max_price; else echo set_value('max_price');?>" <?php if(isset($_POST['maximum_checkbox']) ){ echo'';} elseif(empty($product_list->max_price) ){ echo'disabled';}?>>
                </div>
                <p class="small text-navy">tick to enable. Any offers below this will be auto rejected, leave blank to allow any offers if ticked.</p>
                <?php echo form_error('max_price'); ?>
            </div>
        </div>
        <div class="form-group"><label class="col-md-3 control-label">Quantity requested</label>
            <div class="col-md-9">
                <input type="type" class="form-control" name="total_qty" value="<?php if(!empty($product_list->total_qty)) echo $product_list->total_qty; else  echo set_value('total_qty');?>"/>
                <?php echo form_error('total_qty'); ?>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-md-3 control-label">Shipping Terms <button class="btn btn-success btn-circle" type="button" style="width:20px;height:20px;border-radius:10px;font-size:10px;padding:0;margin-bottom:0" data-toggle="modal" data-target="#shipping" title="Click for more information"><i class="fa fa-question"></i></button></label>
         <?php $product = array();
         if(!empty($product_list->courier)){ $product = explode(',', $product_list->courier);  } ?>
        <div class="col-md-9">
        <?php if($shippings){
            foreach ($shippings as $row){  ?>
                <label class="checkbox-inline i-checks iCheck-helper" title="<?php echo $row->shipping_name; ?>">
                <input type="checkbox" value="<?php echo $row->shipping_name; ?>" name="courier[]" <?php
                if(isset($_POST['courier']) && in_array($row->shipping_name,$_POST['courier'])){
                    echo "checked"; }
                elseif(!empty($product_list->courier) && in_array($row->shipping_name,$product)){
                    echo "checked";}?>/>
                     <?php echo $row->shipping_name; ?></label>
              <?php }
        } ?>
        </div>
        </div>
        <div class="form-group"><label class="col-md-3 control-label">Shipping Charges</label>
        <div class="col-md-9">
           <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" name="shipping_checkbox" id="shipping_checkbox" <?php if(isset($_POST['shipping_checkbox']) ){ echo'checked';} elseif(!empty($product_list->shipping_charges)) echo 'checked'; ?>/> </span>
             <input type="text" class="form-control" placeholder="" name="shipping_charges" value="<?php if(!empty($product_list->shipping_charges)) echo $product_list->shipping_charges; else  echo set_value('shipping_charges');?>" <?php if(isset($_POST['shipping_charges']) ){ echo'';} elseif(empty($product_list->shipping_charges) ){ echo'disabled';}?>></div>
           <p class="small text-navy">Allow additional shipping charges. Leave unticked for all quotes to include free shipping</p>
        </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-md-3 control-label">Product Description</label>
            <div class="col-md-9">
                <textarea type="type" class="form-control" rows="5" id="product_desc" name="product_desc"><?php if(!empty($product_list->product_desc)) echo $product_list->product_desc; else echo set_value('product_desc');?></textarea>
                <?php echo form_error('product_desc'); ?>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-md-3 control-label">List Duration</label>
            <div class="col-md-9">
                <select class="form-control" name="duration">
                <?php $duration = list_duration();
                if($duration){
                    foreach ($duration as $key => $value){ ?>
                      <option value="<?php echo $value; ?>" <?php if(!empty($_POST) && $value==$_POST['duration']){ echo'selected';}
                    elseif(isset($product_list->duration) && $value==$product_list->duration){ echo'selected';}
                    elseif($value == 7){ echo'selected';}?>><?php echo $value; ?> day</option>
                      <?php }
                } ?>
                </select>
                <?php echo form_error('duration'); ?>
            </div>
        </div>
        <div class="form-group"><label class="col-md-3 control-label">Terms &amp; Conditions</label>
            <div class="col-md-9">
            <input type="checkbox" class="checkbox-inline i-checks" name="termsandcondition"/> I agree to the GSMStockMarket.com Limited Terms and Conditions
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
                    <button class="btn btn-warning" type="submit" name="status">Save for later</button>
                <button class="btn btn-primary" type="submit" name="status">List Now</button>
            </div>
        </div>
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
                 <input type="file" name="image1" class="btn default btn-file">
                </div>
                 <label  class="col-md-4" >Image 2</label>
                <div  class="col-md-8">
                 <input type="file" name="image2" class="btn default btn-file">
                 </div>
                 <label  class="col-md-4" >Image 3</label>
                <div  class="col-md-8">
                 <input type="file" name="image3" class="btn default btn-file">
                 </div>
                 <label  class="col-md-4" >Image 4</label>
                <div  class="col-md-8">
                 <input type="file" name="image4" class="btn default btn-file">
                 </div>
                   <label  class="col-md-4" >Image 5</label>
                <div  class="col-md-8">
                 <input type="file" name="image5" class="btn default btn-file">
                 </div>
                </div>
                <p class="small" style="text-align:center">You may have up to five (5) product images per listing.</p>
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
<?php } ?>
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
        '.chosen-select-width'     : {width:"95%"}
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
</script>
   <script>/**
 * Character counter and limiter plugin for textfield and textarea form elements
 * @author Sk8erPeter
 */ (function ($) {
    $.fn.characterCounter = function (params) {
        // merge default and user parameters
        params = $.extend({
            // define maximum characters
            maximumCharacters: 1000,
            // create typed character counter DOM element on the fly
            characterCounterNeeded: true,
            // create remaining character counter DOM element on the fly
            charactersRemainingNeeded: true,
            // chop text to the maximum characters
            chopText: false,
            // place character counter before input or textarea element
            positionBefore: false,
            // class for limit excess
            limitExceededClass: "character-counter-limit-exceeded",
            // suffix text for typed characters
            charactersTypedSuffix: " characters typed",
            // suffix text for remaining characters
            charactersRemainingSuffixText: " characters left",
            // whether to use the short format (e.g. 123/1000)
            shortFormat: false,
            // separator for the short format
            shortFormatSeparator: "/"
        }, params);
        // traverse all nodes
        this.each(function () {
            var $this = $(this),
                $pluginElementsWrapper,
                $characterCounterSpan,
                $charactersRemainingSpan;
            // return if the given element is not a textfield or textarea
            if (!$this.is("input[type=text]") && !$this.is("textarea")) {
                return this;
            }
            // create main parent div
            if (params.characterCounterNeeded || params.charactersRemainingNeeded) {
                // create the character counter element wrapper
                $pluginElementsWrapper = $('<div>', {
                    'class': 'character-counter-main-wrapper'
                });
                if (params.positionBefore) {
                    $pluginElementsWrapper.insertBefore($this);
                } else {
                    $pluginElementsWrapper.insertAfter($this);
                }
            }
            if (params.characterCounterNeeded) {
                $characterCounterSpan = $('<span>', {
                    'class': 'counter character-counter',
                        'text': 0
                });
                if (params.shortFormat) {
                    $characterCounterSpan.appendTo($pluginElementsWrapper);
                    var $shortFormatSeparatorSpan = $('<span>', {
                        'html': params.shortFormatSeparator
                    }).appendTo($pluginElementsWrapper);
                } else {
                    // create the character counter element wrapper
                    var $characterCounterWrapper = $('<div>', {
                        'class': 'character-counter-wrapper',
                            'html': params.charactersTypedSuffix
                    });
                    $characterCounterWrapper.prepend($characterCounterSpan);
                    $characterCounterWrapper.appendTo($pluginElementsWrapper);
                }
            }
            if (params.charactersRemainingNeeded) {
                $charactersRemainingSpan = $('<span>', {
                    'class': 'counter characters-remaining',
                        'text': params.maximumCharacters
                });
                if (params.shortFormat) {
                    $charactersRemainingSpan.appendTo($pluginElementsWrapper);
                } else {
                    // create the character counter element wrapper
                    var $charactersRemainingWrapper = $('<div>', {
                        'class': 'characters-remaining-wrapper',
                            'html': params.charactersRemainingSuffixText
                    });
                    $charactersRemainingWrapper.prepend($charactersRemainingSpan);
                    $charactersRemainingWrapper.appendTo($pluginElementsWrapper);
                }
            }
            $this.keyup(function () {
                var typedText = $this.val();
                var textLength = typedText.length;
                var charactersRemaining = params.maximumCharacters - textLength;
                // chop the text to the desired length
                if (charactersRemaining < 0 && params.chopText) {
                    $this.val(typedText.substr(0, params.maximumCharacters));
                    charactersRemaining = 0;
                    textLength = params.maximumCharacters;
                }
                if (params.characterCounterNeeded) {
                    $characterCounterSpan.text(textLength);
                }
                if (params.charactersRemainingNeeded) {
                    $charactersRemainingSpan.text(charactersRemaining);
                    if (charactersRemaining <= 0) {
                        if (!$charactersRemainingSpan.hasClass(params.limitExceededClass)) {
                            $charactersRemainingSpan.addClass(params.limitExceededClass);
                        }
                    } else {
                        $charactersRemainingSpan.removeClass(params.limitExceededClass);
                    }
                }
            });
        });
        // allow jQuery chaining
        return this;
    };
})(jQuery);
$(document).ready(function () {
    $('#product_desc').characterCounter({
        maximumCharacters: 500,
        characterCounterNeeded: false,
        chopText: true
    });
});
</script>
<!-- Jquery Validate -->
<script src="public/main/template/core/js/plugins/validate/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
$(".validation").validate({
 rules: {
     password: {
         required: true,
         minlength: 3
     },
     url: {
         required: true,
         url: true
     },
     number: {
         required: true,
         number: true
     },
     min: {
         required: true,
         minlength: 6
     },
     max: {
         required: true,
         maxlength: 4
     }
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

$(document).on('change', '#mpn1', function(event) {
    event.preventDefault();
    var  mpnisbn1 = $(this).val();
    $.post('<?php echo base_url("marketplace/getAttributesInfo") ?>/MPNISBN/',{'mpnisbn':mpnisbn1}, function(data) {

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
$('#shipping_checkbox').change(function(event) {
    if ($(this).is(':checked')) {
        $('input[name="shipping_charges"]').prop('disabled', false);
    }
    else{
        $('input[name="shipping_charges"]').val('');
       $('input[name="shipping_charges"]').prop('disabled', true);
    }
});
$('#allowoffer_checkbox').change(function(event) {
    if ($(this).is(':checked')) {
        $('select[name="allow_offer"]').prop('disabled', false);
    }
    else{
        $('select[name="allow_offer"]').val('');
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
 $('#minimum_checkbox').change(function(event) {
    if ($(this).is(':checked')) {
        $('input[name="min_price"]').prop('disabled', false);
    }
    else{
        $('input[name="min_price"]').val('');
       $('input[name="min_price"]').prop('disabled', true);
    }
});
  $('#maximum_checkbox').change(function(event) {
    if ($(this).is(':checked')) {
        $('input[name="max_price"]').prop('disabled', false);
    }
    else{
       $('input[name="max_price"]').val('');
       $('input[name="max_price"]').prop('disabled',true);
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
    </dl>
</div>
</div><!-- /row -->
</div>
<style>
.chosen-container-single .chosen-single {border-color:#e5e6e7;color:#555}
</style>