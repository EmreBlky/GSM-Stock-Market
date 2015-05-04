   <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
    <?php msg_alert(); ?>
        <div class="ibox-title">
            <h5>Color Attributes <a class="btn btn-primary btn-xs" href="<?php echo base_url('admin/add_color_attribute') ?>" title="">Add New Color</a></h5>
        </div>
        <div class="ibox-content">

        <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
        <thead>
        <tr>
            <th>Color Id</th>
            <th>Color Name</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($color_attributes)){
                foreach ($color_attributes as $row) { ?>
            <tr data-toggle="modal" data-target="#myModal5">
                <td><?php if(!empty($row->id)){ echo '#'.$row->id; } ?></td>
               
                 <td><?php if(!empty($row->color_name)){ echo $row->color_name; } ?></td>

                <th>
                <a href="<?php echo base_url().'admin/edit_color_attribute/'.$row->id;  ?>" class="btn btn-primary" >Edit</a>
                <a href="<?php echo base_url().'admin/delete_color_attribute/'.$row->id;  ?>" onclick="return confirm('Are your sure');"  class="btn btn-danger" >Delete</a>
                </th>
            </tr>
            <?php }
            } else{?>
        <tr><td colspan="7"><center><h3>No Colors are available.</h3></center></td></tr>
        <?php } ?>
        </tbody>
        </table>
        </div>
    </div>
</div>
</div>
</div>