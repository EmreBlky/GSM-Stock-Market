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

        <div class="form-group"><label class="col-md-3 control-label">Product  MPN</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="MPN Number" name="product_mpn" value="<?php echo set_value('product_mpn');  ?>"/>
                <?php echo form_error('product_mpn'); ?>
            </div>
          </div>

          <div class="form-group"><label class="col-md-3 control-label">Product  ISBN</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="ISBN Number" name="product_isbn" value="<?php echo set_value('product_isbn');  ?>" />
                <?php echo form_error('product_isbn'); ?>
            </div>
          </div>

          <div class="form-group"><label class="col-md-3 control-label">Product Make</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="Mention Make" name="product_make" />
                <?php echo form_error('product_make'); ?>
            </div>
          </div>

          <div class="form-group"><label class="col-md-3 control-label">Product Model</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="Mention Model" name="product_model"/>
                <?php echo form_error('product_model'); ?>
            </div>
          </div>

          <div class="form-group"><label class="col-md-3 control-label">Product Type</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="Product Type" name="product_type"/>
                <?php echo form_error('product_type'); ?>
            </div>
          </div>

          <div class="form-group"><label class="col-md-3 control-label">Product color</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="Product color" name="product_color"/>
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
