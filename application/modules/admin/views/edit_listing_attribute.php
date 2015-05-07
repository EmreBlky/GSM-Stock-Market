<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/listing_attributes')?>">All Attributes</a>
        </li>
        <li class="active">
            <strong>Edit Attributes</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
</div>


<div class="wrapper wrapper-content">

<div class="row">
<div class="col-lg-8">
<?php msg_alert(); ?> 
    <div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Listing Details</h5>
    </div>
    <div class="ibox-content">
    <br>

    <form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal" />    	

        <div class="form-group"><label class="col-md-3 control-label">Product  MPN/ISBN</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="MPN Number" name="product_mpn" value="<?php if(!empty($listing_attributes->product_mpn_isbn)){ echo $listing_attributes->product_mpn_isbn; }else{ echo set_value('product_mpn_isbn'); } ?>" />
                <?php echo form_error('product_mpn'); ?>
            </div>
          </div>

          <!--  <div class="form-group"><label class="col-md-3 control-label">Product  ISBN</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="ISBN Number" name="product_isbn" value="<?php //if(!empty($listing_attributes->product_isbn)){ echo $listing_attributes->product_isbn; }else{ echo set_value('product_isbn'); } ?>" />
                <?php //echo form_error('product_isbn'); ?>
            </div>
          </div>
 -->
          <div class="form-group"><label class="col-md-3 control-label">Product Make</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="Mention Make" name="product_make" value="<?php if(!empty($listing_attributes->product_make)){ echo $listing_attributes->product_make; }else{ echo set_value('product_make'); } ?>" />
                <?php echo form_error('product_make'); ?>
            </div>
          </div>

          <div class="form-group"><label class="col-md-3 control-label">Product Model</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="Mention Model" name="product_model" value="<?php if(!empty($listing_attributes->product_model)){ echo $listing_attributes->product_model; }else{ echo set_value('product_model'); } ?>"/>
                <?php echo form_error('product_model'); ?>
            </div>
          </div>

          <div class="form-group"><label class="col-md-3 control-label">Product Type</label>
              <div class="col-md-9"> 
              <select  name="product_type" id="product_type" class="form-control check_record">
                     <option selected value="0" >-Select Product Type-</option>
                      <?php if (!empty($product_types)): ?>
                      <?php foreach ($product_types as $row): ?>
                          <optgroup label="<?php echo $row->category_name ?>">
                              <?php if (!empty($row->childs)): ?>
                                  <?php foreach ($row->childs as $child): ?>
                                      <option value="<?php echo $child->category_name ?>" 
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

          <!-- <div class="form-group"><label class="col-md-3 control-label">Product color</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="Product color" name="product_color" value="<?php //if(!empty($listing_attributes->product_color)){ echo $listing_attributes->product_color; }else{ echo set_value('product_color'); } ?>"/>
                <?php //echo form_error('product_color'); ?>
            </div>
          </div> -->

          <div class="form-group"><label class="col-md-3 control-label">Product color</label>
            <div class="col-md-9">
                 <input type="type" class="form-control" placeholder="Eg : Black, White, Blue" name="product_color" value="<?php if(!empty($listing_attributes->product_color)){ print_r(unserialize($listing_attributes->product_color))
                 ; }else{ echo set_value('product_color'); } ?>" />
                <?php echo form_error('product_color'); ?>
                <p>Please add comma seperated multiple colors</p>
            </div>
          </div>

          <div class="form-group"><label class="col-md-3 control-label">Product capacity</label>
            <div class="col-md-9">             
                 <input type="type" class="form-control" placeholder="Eg : 2GB,4GB,8GB" name="product_capacity" value="<?php  if(!empty($listing_attributes->product_capacity)){ print_r(unserialize($listing_attributes->product_capacity))
                 ; }else{echo set_value('product_capacity'); } ?>" />
                <?php echo form_error('product_capacity'); ?>
                <p>Please add comma seperated multiple values</p>
            </div>
          </div>



         <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
            <a href="<?php echo base_url('admin/listing_attributes')?>" class="btn btn-danger">Cancel</a>
                <button class="btn btn-warning" type="submit">Update Attributes</button>
            </div>
        </div>
       </form>
     </div>
  </div>
</div>
</div>
</div>