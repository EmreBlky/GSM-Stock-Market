<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
    <h2></h2>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/listing_attributes')?>">All listing categories</a>
        </li>
        <li class="active">
            <strong>Add New listing category</strong>
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
        <h5>listing category</h5>
    </div>
    <div class="ibox-content">
    <br>

    <form method="post" action="<?php echo current_url()?>"  class="validation form-horizontal" />

          <div class="form-group"><label class="col-md-3 control-label">Parent Category</label>
            <div class="col-md-9">
            <select name="parent_id"  class="form-control">
                 <option value="0">-No Parent Category required-</option>
                <?php if (!empty($listing_parent_categories)): ?>
                <?php foreach ($listing_parent_categories as $row): ?>
                <option value="<?php echo $row->id ?>" <?php if(!empty($_POST['parent_id']) && $_POST['parent_id']==$row->id) echo 'selected="selected"'; ?>><?php echo $row->category_name ?></option>
                <?php endforeach ?>
                <?php endif ?>
            </select>
                <?php echo form_error('parent_id'); ?>
            </div>
          </div>

        <div class="form-group"><label class="col-md-3 control-label">Category Name</label>
            <div class="col-md-9">
                <input type="type" class="form-control" placeholder="Category Name" name="category_name" value="<?php  echo set_value('category_name');  ?>" />
                <?php echo form_error('category_name'); ?>
            </div>
          </div>

         <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
            <a class="btn btn-danger" href="<?php echo base_url('admin/listing_categories')?>">Cancel</a>
                <button class="btn btn-warning" type="submit">Save</button>
            </div>
        </div>
       </form>
     </div>
  </div>
</div>
</div>
</div>
