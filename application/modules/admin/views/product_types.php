   <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
    <?php msg_alert(); ?>
        <div class="ibox-title">
            <h5>Product Type <a class="btn btn-primary btn-xs" href="<?php echo base_url('admin/product_type_add') ?>" title="">Add New Product Type</a></h5>
        </div>
        <div class="ibox-content">

        <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
        <thead>
        <tr>
            <th>Id</th>
            <th>Category Name</th>
            <th>Parent Category Name</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($product_types)){
                foreach ($product_types as $row) { ?>
            <tr data-toggle="modal" data-target="#myModal5">
                <td><?php if(!empty($row->id)){ echo '#'.$row->id; } ?></td>

                 <td><?php if(!empty($row->category_name)) echo $row->category_name;  ?></td>
                 <td><?php if(!empty($row->parent_category_name)) echo $row->parent_category_name; else echo "---";  ?></td>
                <th>
                <a href="<?php echo base_url().'admin/product_type_edit/'.$row->id;  ?>" class="btn btn-primary" >Edit</a>
                <a href="<?php echo base_url().'admin/product_type_delete/'.$row->id;  ?>" onclick="confirm('Are your sure');"  class="btn btn-danger" >Delete</a>
                </th>
            </tr>

            <?php }
            } else{?>
        <tr><td colspan="4"><center><h3>No Product Type are available.</h3></center></td></tr>
        <?php } ?>
        </tbody>
        </table>
        <?php if(!empty($pagination)) echo $pagination ?>
        </div>
    </div>
</div>
</div>
</div>