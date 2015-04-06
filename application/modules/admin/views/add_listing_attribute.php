<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/listing_attributes')?>">All Attributes</a>
        </li>
        <li class="active">
            <strong>Add Attributes</strong>
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
                <input type="type" class="form-control" placeholder="MPN/ISBN Number" name="product_mpn" value="<?php echo set_value('product_mpn');  ?>"/>
                <?php echo form_error('product_mpn'); ?>
            </div>
          </div>

        <!--   <div class="form-group"><label class="col-md-3 control-label">Product  ISBN</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="ISBN Number" name="product_isbn" value="<?php //echo set_value('product_isbn');  ?>" />
                <?php //echo form_error('product_isbn'); ?>
            </div>
          </div>
 -->
          <div class="form-group"><label class="col-md-3 control-label">Product Make</label>
            <div class="col-md-9">
                <select  name="product_make"  placeholder="Mention Make" class="form-control">
                   <option value="" >Select Product Makers</option>
                    <?php if (!empty($makers)): ?>
                    <?php foreach ($makers as $row): ?>
                       <option value="<?php echo $row->product_make ?>" <?php if(!empty($_POST['product_make']) && $row->product_make==$_POST['product_make']){ echo'selected';}?>> <?php echo $row->product_make ?></option>
                    <?php endforeach ?>
                    <?php endif ?>
                </select>
                <?php echo form_error('product_make'); ?>
            </div>
          </div>

          <div class="form-group"><label class="col-md-3 control-label">Product Model</label>
            <div class="col-md-9">
                <select name="product_model"  placeholder="Mention Model" class="form-control">
                   <option value="" >Select Product models</option>
                    <?php if (!empty($models)): ?>
                    <?php foreach ($models as $row): ?>
                       <option value="<?php echo $row->product_model ?>" <?php if(!empty($_POST['product_model']) && $row->product_model == $_POST['product_model']){ echo'selected';}?>> <?php echo $row->product_model ?></option>
                    <?php endforeach ?>
                    <?php endif ?>
                </select>
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
                                <option value="<?php echo $child->category_name ?>" <?php if(!empty($_POST['product_type']) && $child->category_name==$_POST['product_type']){ echo'selected';}?>>- <?php echo $child->category_name ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </optgroup>
                <?php endforeach ?>
                <?php endif ?>
                </select>
                <?php echo form_error('product_type'); ?>
            </div>
          </div>

          <div class="form-group"><label class="col-md-3 control-label">Product color</label>
            <div class="col-md-9">
                <select name="product_color"  placeholder="Mention color" class="form-control">
                   <option value="" >Select Product colors</option>
                    <?php if (!empty($colors)): ?>
                    <?php foreach ($colors as $row): ?>
                       <option value="<?php echo $row->product_color ?>" <?php if(!empty($_POST['product_color']) && $row->product_color == $_POST['product_color']){ echo'selected';}?>><?php echo $row->product_color ?></option>
                    <?php endforeach ?>
                    <?php endif ?>
                </select>
                <?php echo form_error('product_color'); ?>
            </div>
          </div>



         <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
                <a href="<?php echo base_url('admin/listing_attributes')?>">Cancel</a>
                <button class="btn btn-warning" type="submit">Save Attributes</button>
            </div>
        </div>
       </form>
     </div>
  </div>
</div>
</div>
</div>
