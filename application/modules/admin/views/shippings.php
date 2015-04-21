   <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
    <?php msg_alert(); ?>
        <div class="ibox-title">
            <h5>Shippings Terms <a class="btn btn-primary btn-xs" href="<?php echo base_url('admin/shipping_add') ?>" title="">Add New Shipping term</a></h5>
        </div>
        <div class="ibox-content">

        <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
        <thead>
        <tr>
            <th>Id</th>
            <th>Shipping Name</th>
            <th>Shipping Description</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($shippings)){
                foreach ($shippings as $row) { ?>
            <tr data-toggle="modal" data-target="#myModal5">
                <td><?php if(!empty($row->id)){ echo '#'.$row->id; } ?></td>

                 <td><?php if(!empty($row->shipping_name)) echo $row->shipping_name;  ?></td>
                 <td><?php if(!empty($row->description)) echo $row->description;  ?></td>
                <th>
                <a href="<?php echo base_url().'admin/shipping_edit/'.$row->id;  ?>" class="btn btn-primary" >Edit</a>
                <a href="<?php echo base_url().'admin/shipping_delete/'.$row->id;  ?>" onclick="confirm('Are your sure');"  class="btn btn-danger" >Delete</a>
                </th>
            </tr>

            <?php }
            } else{?>
        <tr><td colspan="4"><center><h3>No shipping terms are available.</h3></center></td></tr>
        <?php } ?>
        </tbody>
        </table>
        </div>
    </div>
</div>
</div>
</div>