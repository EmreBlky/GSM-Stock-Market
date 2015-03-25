<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li>
            <a href="/">Home</a>
        </li>
        <li class="active">
            <strong>Create listing</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
</div>

<div class="wrapper wrapper-content">
<form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal"  enctype="multipart/form-data"/>  
<div class="row">
<div class="col-lg-7">
<?php msg_alert(); ?>
    <div class="ibox float-e-margins">
<div class="ibox-title">

<h5>Listing Details</h5>

</div>
<div class="ibox-content">


    <div class="form-group"><label class="col-md-3 control-label">Listing Category</label>
        <div class="col-md-9">
            <select class="form-control" name="listing_categories">
                <option selected value="0" >-Select-</option>
                <?php if (!empty($listing_categories)): ?>
                <?php foreach ($listing_categories as $row): ?>
                   <option value="<?php echo $row->category_name ?>"<?php if(!empty($_POST['listing_categories']) && $row->category_name==$_POST['listing_categories']){ echo'selected';}?> 
                   <?php if(!empty($product_list->listing_categories) && $row->category_name==$product_list->listing_categories){ echo'selected="selected"';}?>>
                   <?php echo $row->category_name ?></option>
                    <?php if (!empty($row->childs)): ?>
                        <?php foreach ($row->childs as $child): ?>
                            <option value="<?php echo $child->category_name ?>" <?php if(!empty($_POST['listing_categories']) && $child->category_name==$_POST['listing_categories']){ echo'selected';}?> 
                            <?php if(!empty($product_list->listing_categories) && $child->category_name==$product_list->listing_categories){ echo'selected="selected"';}?>>- <?php echo $child->category_name ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                <?php endforeach ?>
                <?php endif ?>
            </select>
            <?php echo form_error('listing_categories'); ?>
        </div>
    </div>


     <div class="form-group"><label class="col-md-3 control-label">Schedule Listing</label>
     <div class="col-md-9">
          <div class="input-group date form_datetime " data-date="<?php echo date('Y').'-'.date('m').'-'.date('d')?>" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
            <input class="form-control" size="16" type="text" value="<?php if(!empty($product_list->schedule_date_time)) echo $product_list->schedule_date_time; else echo set_value('schedule_date_time'); ?>" readonly >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span><br>
        </div>
        <?php echo form_error('schedule_date_time'); ?>
        </div>
        <input type="hidden" id="dtp_input1" value="<?php echo set_value('schedule_date_time');?>" name="schedule_date_time"/><br/>
    </div>

    <div class="form-group"><label class="col-md-3 control-label">Listing Type</label>
        <div class="col-md-9">
            <select class="form-control" name="listing_type">
                <option selected value="" >Buying or Selling?</option>
                <option value="1" <?php if(!empty($_POST) && 1==$_POST['listing_type']){ echo'selected';}?><?php if(!empty($product_list->listing_type) && 1==$product_list->listing_type){ echo'selected';}?>>Buying Request</option>
                <option <?php if(!empty($_POST) && 2==$_POST['listing_type']){ echo'selected';}?><?php if(!empty($product_list->listing_type) && 2==$product_list->listing_type){ echo'selected';}?> value="2">Selling Offer</option>
            </select>
            <?php echo form_error('listing_type'); ?>
            
        </div>
    </div>
    
    <div class="hr-line-dashed"></div>

    <div class="form-group"><label class="col-md-3 control-label">MPN</label>
        <div class="col-md-9">
            <input type="type" id="mpn1" list="mpn" class="form-control check_record" placeholder="Auto fill the rest of the data if MPN is found in the database"  name="product_mpn" value="<?php if(!empty($product_list->product_mpn)) echo $product_list->product_mpn; else echo set_value('product_mpn');?>"/>
            <datalist id="mpn">
            <?php if(!empty($listing_attributes)){
                 foreach ($listing_attributes as $row) { ?>
                   <?php if (!empty($row->product_mpn)): ?>
                <option value="<?php echo $row->product_mpn; ?>"><?php echo $row->product_mpn; ?></option>
                  <?php endif ?>
                 <?php }} ?>
            </datalist>
             <?php echo form_error('product_mpn'); ?>
        </div>
    </div>


     <div class="form-group"><label class="col-md-3 control-label">ISBN</label>
        <div class="col-md-9">
            <input type="type" id="isbn1" list="isbn" class="form-control check_record" placeholder="Auto fill the rest of the data if ISBN is found in the database"  name="product_isbn" value="<?php echo set_value('product_isbn');?>"/>
            <datalist id="isbn">
            <?php if(!empty($listing_attributes)){
                 foreach ($listing_attributes as $row) { ?>
                 <?php if (!empty($row->product_isbn)): ?>
                <option value="<?php echo $row->product_isbn; ?>"><?php echo $row->product_isbn; ?></option>
                 <?php endif ?>
                 <?php }} ?>
            </datalist>
             <?php echo form_error('product_isbn'); ?>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Make</label>
        <div class="col-md-9">
        <select class="form-control check_record" name="product_make" id="product_make">
            <option  selected value="">Select Make</option>
            <?php if(!empty($product_makes)){ 
                 foreach ($product_makes as $row) { ?>
                <option value="<?php echo $row->product_make; ?>" <?php if(!empty($_POST) && $row->product_make==$_POST['product_make']){ echo'selected';}?>><?php echo $row->product_make; ?></option>
                 <?php }} ?>
        </select>
        <?php echo form_error('product_make'); ?>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Model</label>
        <div class="col-md-9">
            <input type="type" class="form-control check_record" placeholder="When make is selected list models associated with make" name="product_model" value="<?php if(!empty($product_list->schedule_date_time)) echo $product_list->product_model; else echo set_value('product_model');?>"/>
            <?php echo form_error('product_model'); ?>
        </div>
    </div>
    


    <div class="form-group"><label class="col-md-3 control-label">Product Type</label>
        <div class="col-md-9">
        <select class="form-control check_record" name="product_type" id="product_type">
            <option  selected  value="">Select Make</option>
            <?php if(!empty($product_types)){ 
                 foreach ($product_types as $row) { ?>
                <option value="<?php echo $row->product_type; ?>" <?php if(!empty($_POST) && $row->product_type==$_POST['product_type']){ echo'selected';}?><?php if(!empty($product_list->product_type) && $row->product_type==$product_list->product_type){ echo'selected';}?>><?php echo $row->product_type; ?></option>
                 <?php }} ?>
        </select>
        <?php echo form_error('product_type'); ?>
        </div>
    </div>

    <div class="form-group"><label class="col-md-3 control-label">Colour</label>
        <div class="col-md-9">
            <select class="form-control check_record" name="product_color" id="product_color">
            <option selected value="">Select Color</option>
            <?php if(!empty($product_colors)){ 
                 foreach ($product_colors as $row) { ?>
                <option value="<?php echo $row->product_color; ?>" <?php if(!empty($_POST) && $row->product_color==$_POST['product_color']){ echo'selected';}?>
                <?php if(!empty($product_list->product_color) && $row->product_color==$product_list->product_color){ echo'selected';}?>><?php echo $row->product_color; ?></option>
                 <?php }} ?>
        </select>           
            <?php echo form_error('product_color'); ?>
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
                <option selected value="">Default (account preference defalut)</option>
                <?php $currency = currency(); 
                if($currency){
                    $i=1;
                foreach ($currency as $key => $value){ ?>
                  <option <?php if(!empty($_POST) && $i==$_POST['currency']){ echo'selected';}?><?php if(!empty($product_list->currency) && $i==$product_list->currency){ echo'selected';}?> value="<?php echo $i;?>"><?php echo $value; ?></option>
                  <?php $i++;} 
                } ?>
            </select>
            <p class="small">Select the currency you wish this listing to be sold in.</p>
            <?php echo form_error('currency'); ?>
        </div>
    </div>
    

    <div class="form-group"><label class="col-md-3 control-label">Unit Price</label>
        <div class="col-md-9">
            <input type="type" class="form-control" name="unit_price" value="<?php if(!empty($product_list->unit_price)) echo $product_list->unit_price; else echo set_value('unit_price');?>"/>
            <?php echo form_error('unit_price'); ?>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Minimum Price</label>
        <div class="col-md-9">
            <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" name="minimum_checkbox" id="minimum_checkbox" <?php if(!empty($_POST['minimum_checkbox']) ){ echo'checked';}?><?php if(!empty($product_list->min_price)){ echo'checked';}?>/> </span> <input type="text" class="form-control" placeholder="only make typable when clicked" name="min_price" value="<?php if(!empty($product_list->min_price)) echo $product_list->min_price; else echo set_value('min_price');?>" <?php if(empty($product_list->min_price) ){ echo'disabled';}?>></div>
            <p class="small">tick to enable. Any offers below this will be auto rejected, leave blank to allow any offers if ticked.</p>
            <?php echo form_error('min_price'); ?>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Allow Offers</label>
        <div class="col-md-9">
            <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" name="allowoffer_checkbox" id="allowoffer_checkbox" <?php if(!empty($_POST['allowoffer_checkbox']) ){ echo'checked';}?><?php if(!empty($product_list->allow_offer) ){ echo'checked';}?>/> </span>
            <select class="form-control" name="allow_offer" <?php if(empty($product_list->allow_offer)){ echo'disabled';}else{ echo "enable"; } ?> >
                <option selected value="">default</option>
                <?php for($i=4; $i<=10; $i++){
                    ?><option <?php if(isset($_POST['allow_offer']) && $i==$_POST['allow_offer']){ echo'selected';}?><?php if(!empty($product_list->allow_offer) && $i == $product_list->allow_offer){ echo'selected="selected"'; }?>><?php echo $i;?></option>
                    <?php }?>
            </select>
            </div>
            <?php echo form_error('allow_offer'); ?>
            <p class="small">Allow people to make offers and how many per 24 hour period. (default is 3)</p>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Quantity Available</label>
        <div class="col-md-9">
            <input type="type" class="form-control" name="total_qty" value="<?php if(!empty($product_list->total_qty)) echo $product_list->total_qty; else  echo set_value('total_qty');?>"/>
            <?php echo form_error('total_qty'); ?>
        </div>
    </div>
    
    <div class="form-group"><label class="col-md-3 control-label">Min Order Quantity</label>
        <div class="col-md-9">
            <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" name="orderqunatity_checkbox" id="orderqunatity_checkbox" <?php if(!empty($_POST['orderqunatity_checkbox']) ){ echo'checked';}?> <?php if(!empty($product_list->min_qty_order)){ echo'checked';}?>/> </span> <input type="text" class="form-control" placeholder="only make typable when clicked" name="min_qty_order" value="<?php if(!empty($product_list->min_qty_order)) echo $product_list->min_qty_order; else echo set_value('min_qty_order');?>" <?php if(empty($_POST['orderqunatity_checkbox']) ){ echo'disabled';}?><?php if(empty($product_list->min_qty_order) ){ echo'disabled';} else{ echo 'enable';} ?>></div>
            <p class="small">Allow minimum order quantity else full quantity sale available only</p>
            <?php echo form_error('min_qty_order'); ?>
        </div>
    </div>
    
    <div class="hr-line-dashed"></div>
    
    
    <div class="form-group"><label class="col-md-3 control-label">Shipping Terms <button class="btn btn-success btn-circle" type="button" style="width:20px;height:20px;border-radius:10px;font-size:10px;padding:0;margin-bottom:0" data-toggle="modal" data-target="#shipping" title="Click for more information"><i class="fa fa-question"></i></button></label>
    <div class="col-md-9">
			<label class="checkbox-inline i-checks" title="EXW (Ex Works)"><input type="checkbox" value="TNT" name="courier"]/> EXW</label>
			<label class="checkbox-inline i-checks" title="FOB (Freight on Board)"><input type="checkbox" value="TNT" name="courier"]/> FOB</label>
			<label class="checkbox-inline i-checks" title="CIP (Carriage and Insurance Paid to)"><input type="checkbox" value="TNT" name="courier"]/> CIP</label>
			<label class="checkbox-inline i-checks" title="CPT (Carriage Paid to)"><input type="checkbox" value="TNT" name="courier"]/> CPT</label>
    </div>
	</div>
    
    
    <div class="form-group"><label class="col-md-3 control-label">Shipping Charges</label>
    <div class="col-md-9">
            <div class="input-group m-b"><span class="input-group-addon"> <input type="checkbox" name="minimum_checkbox" id="minimum_checkbox"/> </span> <input type="text" class="form-control" placeholder="only make typable when clicked" name="min_price" value="" disabled></div>
            <p class="small">Allow additional shipping charges. Leave unticked for all quotes to include free shipping</p>
    </div>
	</div>
    
    
    
    
    
    <div class="hr-line-dashed"></div>  
    
    
    <div class="form-group"><label class="col-md-3 control-label">Shipping Terms <button class="btn btn-success btn-circle" type="button" style="width:20px;height:20px;border-radius:10px;font-size:10px;padding:0;margin-bottom:0" data-toggle="modal" data-target="#shipping" title="Click for more information"><i class="fa fa-question"></i></button></label>
    <div class="col-md-9">

        <select class="form-control" name="shipping_term" onchange="shippings_to_couriers(this.value);">
            <option value="">Select Terms</option>
            <?php if($shippings){
                foreach ($shippings as $row){  ?>
                  <option value="<?php echo $row->id; ?>@@<?php echo $row->shipping_name; ?>" <?php if(!empty($_POST) && $row->id.'@@'.$row->shipping_name==$_POST['shipping_term']){ echo'selected="selected"';} ?><?php if(!empty($product_list->shipping_term) && $row->shipping_name == $product_list->shipping_term){ echo'selected="selected"'; } ?>><?php echo $row->shipping_name; ?> <?php echo $row->description; ?></option>
                  <?php }
            } ?>
        </select>
        <?php echo form_error('shipping_term'); ?>
    </div>
	</div>
    
    <div class="form-group"><label class="col-md-3 control-label">Courier</label>

        <div class="col-md-9">
        <div id="couriers_data"></div>
            <?php
            // $courier = courier();
            // if($courier){
            // $i=1;
            // foreach ($courier as $key => $value){ ?>
           <!--  <label class="checkbox-inline i-checks"><input type="checkbox" value="option<?php //echo $i; ?>" id="inlineCheckbox<?php //echo $i; ?>" name="courier[]" <?php //if(!empty($_POST['courier']) && in_array('option'.$i, $_POST['courier'])){ echo'checked';}?>/> <?php //echo $value;?> </label> -->
            <?php  //$i++;}} ?>
            <?php if(!empty($product_list->courier)){ echo  $product_list->courier; } ?>
            <?php if (!empty($couriers)): ?>
            <?php foreach ($couriers as $rowc): ?>
            <span id="courier<?php echo $rowc->id ?>" style="<?php if(!empty($product_list->courier)) echo'display:block'; else echo 'display:none'; ?>">
            <label class="checkbox-inline i-checks"><input type="checkbox" value="option<?php echo $i; ?>" id="inlineCheckbox<?php echo $i; ?>" name="courier[]" <?php if(!empty($_POST['courier']) && in_array('option'.$i, $_POST['courier'])){ echo'checked';}?>
                /> <?php echo $rowc->courier_name;?> </label>
            </span>
            <?php endforeach ?>
            <?php endif ?>
        <?php echo form_error('courier[]'); ?>
        </div>
    </div>
    
    
    <div class="form-group"><label class="col-md-3 control-label">Shipping Fee</label>
    <div class="col-md-3">
    	<select class="form-control">
        	<option>Free shipping</option>
        	<option>Price per unit</option>
            <option>Flat fee</option>
        </select>
    </div>
    <div class="col-md-3">
    	<input type="text" class="form-control" />
    </div>
    <div class="col-md-3">
    	<button class="btn btn-primary"><i class="fa fa-plus"></i> Add Shipping Option</button>
    </div>
	</div>
    
    <div class="form-group"><label class="col-md-3 control-label">Shipping and Handling Fee</label>
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
              <tbody>
              <tr>
                  <td>Exworks</td>
                  <td>TNT</td>
                  <td>Unit Price</td>
                  <td>12.00</td>
                  <td style="text-align:center"><button class="btn btn-danger btn-circle" type="button" style="width:20px;height:20px;border-radius:10px;font-size:10px;padding:0;margin-bottom:0"><i class="fa fa-times"></i></button></td>
              </tr>
              <tr>
                  <td>Exworks</td>
                  <td>UPS</td>
                  <td>Unit Price</td>
                  <td>11.00</td>
                  <td style="text-align:center"><button class="btn btn-danger btn-circle" type="button" style="width:20px;height:20px;border-radius:10px;font-size:10px;padding:0;margin-bottom:0"><i class="fa fa-times"></i></button></td>
              </tr>
              <tr>
                  <td>Exworks</td>
                  <td>TNT, UPS, Other</td>
                  <td>Flat Fee</td>
                  <td>97.00</td>
                  <td style="text-align:center"><button class="btn btn-danger btn-circle" type="button" style="width:20px;height:20px;border-radius:10px;font-size:10px;padding:0;margin-bottom:0"><i class="fa fa-times"></i></button></td>
              </tr>
              </tbody>
          </table>
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
                  <option value="<?php echo $value; ?>" <?php if(!empty($_POST) && $value==$_POST['duration']){ echo'selected';}?><?php if(isset($product_list->duration) && $value==$product_list->duration){ echo'selected';}?>><?php echo $value; ?> day</option>
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
            <a class="btn btn-danger" href="">Cancel</a>
        <?php if(empty($product_list->id)): ?>
            <button class="btn btn-warning" type="submit" name="status" value="2">Save for later</button>
        <?php endif ?>
            <button class="btn btn-primary" type="submit" name="status" value="1">List Now</button>
        </div>
    </div>
                

  </div>
 </div>
</div>
<div class="col-lg-5">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Listing Pictures</h5>
        </div>
        <div class="ibox-content">
        <div class="row">
            <div class="col-md-12" style="text-align:center">
           
            <label  class="col-md-4" >Image 1</label>
            <div  class="col-md-8">
            <?php if (!empty($product_list->image1) && file_exists($product_list->image1)): 
            $img1 = explode('/', $product_list->image1)?>
                <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img1[3]; ?>" class="thumbnail"/>
            <?php endif ?>
             <input type="file" name="image1" class="btn default btn-file">
            </div>
             <?php echo form_error('image1'); ?>
             <label  class="col-md-4" >Image 2</label>
            <div  class="col-md-8">
            <?php if (!empty($product_list->image2) && file_exists($product_list->image2)): 
            $img2 = explode('/', $product_list->image2)?>
                <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img2[3]; ?>" class="thumbnail"/>
            <?php endif ?>
             <input type="file" name="image2" class="btn default btn-file">
             </div>
             <?php echo form_error('image2'); ?>
             <label  class="col-md-4" >Image 3</label>
            <div  class="col-md-8">
            <?php if (!empty($product_list->image3)&& file_exists($product_list->image3)): 
            $img3 = explode('/', $product_list->image3)?>
                <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img3[3]; ?>" class="thumbnail"/>
            <?php endif ?>
             <input type="file" name="image3" class="btn default btn-file">
             </div>
             <?php echo form_error('image3'); ?>
             <label  class="col-md-4" >Image 4</label>
            <div  class="col-md-8">
            <?php if (!empty($product_list->image4)&& file_exists($product_list->image4)): 
            $img4 = explode('/', $product_list->image4)?>
                <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img4[3]; ?>" class="thumbnail"/>
            <?php endif ?>
             <input type="file" name="image4" class="btn default btn-file">
             </div>
             <?php echo form_error('image4'); ?>

              <label  class="col-md-4" >Image 5</label>
            <div  class="col-md-8">
             <?php if (!empty($product_list->image5)&& file_exists($product_list->image5)): 
            $img5 = explode('/', $product_list->image5)?>
                <img src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img5[3]; ?>" class="thumbnail"/>
            <?php endif ?>
             <input type="file" name="image5" class="btn default btn-file">
             </div>
             <?php echo form_error('image5'); ?>

            </div>
            <p class="small" style="text-align:center">You may have up to five (5) product images per listing.</p>
        </div>
        </div>
</div></div>        
</div>
</form>
</div>
            
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
   $(document).ready(function(){
     $("#mpn1").change(function(){
     var product_mpn_isbn = $(this).val(); 
     if(product_mpn_isbn){
        $('.check_record').attr("disabled", "disabled");
        jQuery.post('<?php echo base_url()?>marketplace/get_attributes_info/MPN',{product_mpn_isbn:product_mpn_isbn},
        function(data){
         var prod_make= <?php echo json_encode($product_makes); ?>;
         var producttypes= <?php echo json_encode($product_types); ?>;
         var productcolors= <?php echo json_encode($product_colors); ?>;
        if(data.STATUS=='true'){
          if(prod_make){
          var productmakehtml='<option  selected value="">Product Make</option>';
            $.each(prod_make, function(index, val) {
                productmakehtml +='<option value="'+val.product_make+'"';
                if(val.product_make==data.product_make)
                productmakehtml +=' Selected';
                productmakehtml +=' >'+val.product_make+'</option>';
             });
             $('#product_make').html(productmakehtml);
            }
            
            if(producttypes){
            var producttypehtml='<option  selected value="">Product Type</option>';
            $.each(producttypes, function(index, val) {
                producttypehtml +='<option';
                if(val.product_type==data.product_type)
                producttypehtml +=' Selected';
                producttypehtml +=' >'+val.product_type+'</option>';
             });
             $('#product_type').html(producttypehtml);
            }

             if(productcolors){
            var productcolorhtml='<option  selected value="">Product Color</option>';
            $.each(productcolors, function(index, val) {
                productcolorhtml +='<option value="'+val.product_color+'"';
                if(val.product_color==data.product_color)
                productcolorhtml +=' Selected';
                productcolorhtml +=' >'+val.product_color+'</option>';
             });
             $('#product_color').html(productcolorhtml);
            }

            $('input[name="product_model"]').val(data.product_model);
           
           } 
            /* else{

            if(prod_make){
            var productmakehtml='<option "selected">Product Make</option>';
            $.each(prod_make, function(index, val) {
                productmakehtml +='<option value="'+val.product_make+'">'+val.product_make+'</option>';
             });
             $('#product_make').html(productmakehtml);
            }
            
            if(producttypes){
            var producttypehtml='<option "selected">Product Type</option>';
            $.each(producttypes, function(index, val) {
                producttypehtml +='<option value="'+val.product_type+'">'+val.product_type+'</option>';
             });
             $('#product_type').html(producttypehtml);
            }

            if(productcolors){
            var productcolorhtml='<option "selected">Product Color</option>';
            $.each(productcolors, function(index, val) {
                productcolorhtml +='<option value="'+val.product_color+'">'+val.product_color+'</option>';
             });
             $('#product_color').html(productcolorhtml);
            }

            $('input[name="product_model"]').val(data.product_model);
           } */
          });
           $('.check_record').removeAttr("disabled");   
         }
        });

     $("#isbn1").change(function(){
     var product_mpn_isbn = $(this).val();
     if(product_mpn_isbn){
        $('.check_record').attr("disabled", "disabled");
        jQuery.post('<?php echo base_url()?>marketplace/get_attributes_info/ISBN',{product_mpn_isbn:product_mpn_isbn},
        function(data){
         var prod_make= <?php echo json_encode($product_makes); ?>;
         var producttypes= <?php echo json_encode($product_types); ?>;
         var productcolors= <?php echo json_encode($product_colors); ?>;
        if(data.STATUS=='true'){
          if(prod_make){
          var productmakehtml='<option  selected value="">Product Make</option>';
            $.each(prod_make, function(index, val) {
                productmakehtml +='<option value="'+val.product_make+'"';
                if(val.product_make==data.product_make)
                productmakehtml +=' Selected';
                productmakehtml +=' >'+val.product_make+'</option>';
             });
             $('#product_make').html(productmakehtml);
            }

            if(producttypes){
            var producttypehtml='<option  selected value="">Product Type</option>';
            $.each(producttypes, function(index, val) {
                producttypehtml +='<option';
                if(val.product_type==data.product_type)
                producttypehtml +=' Selected';
                producttypehtml +=' >'+val.product_type+'</option>';
             });
             $('#product_type').html(producttypehtml);
            }

             if(productcolors){
            var productcolorhtml='<option  selected value="">Product Color</option>';
            $.each(productcolors, function(index, val) {
                productcolorhtml +='<option value="'+val.product_color+'"';
                if(val.product_color==data.product_color)
                productcolorhtml +=' Selected';
                productcolorhtml +=' >'+val.product_color+'</option>';
             });
             $('#product_color').html(productcolorhtml);
            }

            $('input[name="product_model"]').val(data.product_model);

           }

          });
           $('.check_record').removeAttr("disabled");
         }
        });


     });

    $(document).ready(function() {
        $('#minimum_checkbox').change(function(event) {
            if ($(this).is(':checked')) {
                $('input[name="min_price"]').prop('disabled', false);
            }
            else{
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
               $('input[name="min_qty_order"]').prop('disabled', true); 
            }
        });
    });
 </script>
<script type="text/javascript" src="public/admin/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>

<script type="text/javascript" src="public/admin/js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
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