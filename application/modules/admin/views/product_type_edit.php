<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/product_types')?>">All Product Type</a>
        </li>
        <li class="active">
            <strong>Edit Product Type</strong>
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
        <h5>Product Type</h5>
    </div>
    <div class="ibox-content">
    <br>

    <form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal" />

          <div class="form-group"><label class="col-md-3 control-label">Parent Category</label>
            <div class="col-md-9">
            <select name="parent_id"  class="form-control">
                <option value="0">-No Parent Category required-</option>
                <?php if (!empty($product_parent_categories)): ?>
                <?php foreach ($product_parent_categories as $row): ?>
                <?php echo $product_types->id .'=='. $row->id; ?>
                <option value="<?php echo $row->id ?>" <?php if(!empty($product_types->parent_id) && $product_types->parent_id == $row->id) echo 'selected="selected"'; ?>><?php echo $row->category_name ?></option>
                <?php endforeach ?>
                <?php endif ?>
            </select>
                <?php echo form_error('parent_id'); ?>
            </div>
          </div>

        <div class="form-group"><label class="col-md-3 control-label">Category Name</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="Category Name" name="category_name" value="<?php if(!empty($product_types->category_name)){ echo $product_types->category_name; }else{ echo set_value('category_name'); } ?>" />
                <?php echo form_error('category_name'); ?>
            </div>
          </div>

         <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
            <a class="btn btn-danger" href="<?php echo base_url('admin/product_types')?>">Cancel</a>
                <button class="btn btn-warning" type="submit">Update</button>
            </div>
        </div>
       </form>
     </div>
  </div>
</div>
</div>
</div>