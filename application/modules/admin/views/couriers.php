   <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
    <?php msg_alert(); ?>
        <div class="ibox-title">
            <h5>Couriers <a class="btn btn-primary btn-xs" href="<?php echo base_url('admin/courier_add') ?>" title="">Add New courier</a></h5>
        </div>
        <div class="ibox-content">

        <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
        <thead>
        <tr>
            <th>Id</th>
            <th>Courier Name</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($couriers)){
                foreach ($couriers as $row) { ?>
            <tr data-toggle="modal" data-target="#myModal5">
                <td><?php if(!empty($row->id)){ echo '#'.$row->id; } ?></td>

                 <td><?php if(!empty($row->courier_name)) echo $row->courier_name;  ?></td>

                <th>
                <a href="<?php echo base_url().'admin/courier_edit/'.$row->id;  ?>" class="btn btn-primary" >Edit</a>
                <a href="<?php echo base_url().'admin/courier_delete/'.$row->id;  ?>" onclick="confirm('Are your sure');"  class="btn btn-danger" >Delete</a>
                </th>
            </tr>

            <?php }
            } else{?>
        <tr><td colspan="3"><center><h3>No Couriers are available.</h3></center></td></tr>
        <?php } ?>
        </tbody>
        </table>
        </div>
    </div>
</div>
</div>
</div>