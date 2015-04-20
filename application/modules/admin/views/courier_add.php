<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/listing_attributes')?>">All couriers</a>
        </li>
        <li class="active">
            <strong>Add New courier</strong>
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
        <h5>courier Details</h5>
    </div>
    <div class="ibox-content">
    <br>

    <form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal" />

        <div class="form-group"><label class="col-md-3 control-label">Courier Name</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="Courier Name" name="courier_name" value="<?php echo set_value('courier_name');  ?>" />
                <?php echo form_error('courier_name'); ?>
            </div>
          </div>

         <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
            <a class="btn btn-danger" href="<?php echo base_url('admin/couriers')?>">Cancel</a>
                <button class="btn btn-warning" type="submit">Save</button>
            </div>
        </div>
       </form>
     </div>
  </div>
</div>
</div>
</div>
