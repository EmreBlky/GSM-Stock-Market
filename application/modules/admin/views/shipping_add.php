<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/listing_attributes')?>">All shipping terms</a>
        </li>
        <li class="active">
            <strong>Add New shipping terms</strong>
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
        <h5>Shipping terms</h5>
    </div>
    <div class="ibox-content">
    <br>

    <form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal" />

        <div class="form-group"><label class="col-md-3 control-label">Shipping Name</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="Shipping Name" name="shipping_name" value="<?php echo set_value('shipping_name');  ?>" />
                <?php echo form_error('shipping_name'); ?>
            </div>
          </div>

          <div class="form-group"><label class="col-md-3 control-label">Shipping Description</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="Shipping Description" name="description" value="<?php echo set_value('description');  ?>" />
                <?php echo form_error('description'); ?>
            </div>
          </div>

            <div class="form-group">

            <label class="col-md-3 control-label">Couriers</label>

            <div class="col-md-9">
                <?php if (!empty($couriers)): ?>
                <?php foreach ($couriers as $row): ?>

                <div class="row0">
                <label class="col-md-4 text-left"> <?php echo $row->courier_name ?></label>
                    <div class="col-md-8 pull-left">
                        <input type="checkbox" class="form-control" placeholder="Couriers" name="couriers[]" value="<?php echo $row->id ?>" <?php if(!empty($_POST['couriers']) && in_array($row->id, $_POST['couriers'])) echo 'checked'; ?> />
                    </div>
                </div>
                <?php endforeach ?>
                <?php endif ?>
                <?php echo form_error('couriers[]'); ?>
            </div>
            </div>

         <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
            <a class="btn btn-danger" href="<?php echo base_url('admin/shippings')?>">Cancel</a>
                <button class="btn btn-warning" type="submit">Save</button>
            </div>
        </div>
       </form>
     </div>
  </div>
</div>
</div>
</div>
