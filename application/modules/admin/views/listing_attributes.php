   <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
    <?php msg_alert(); ?>
        <div class="ibox-title">
            <h5>Listing Attributes</h5>
        </div>
        <div class="ibox-content">
        
        <table id="marketplace" class="table table-striped table-bordered table-hover dataTables-example" >
        <thead>
        <tr>
            <th>Attribute Id</th>
            <th>Added by</th>            
            <th>MPN/ISBN</th>
            <th>Make</th>
            <th>Model</th>
            <th>Product Type</th>
            <th>Color</th>           
            <th>Options</th>
        </tr>
        </thead>
        <tbody>    
        <?php if(!empty($listing_attributes)){ 
                foreach ($listing_attributes as $row) { ?>
            <tr data-toggle="modal" data-target="#myModal5">
                <td><?php if(!empty($row->id)){ echo '#'.$row->id; } ?></td>
                <td><?php if($row->user_type==1){ echo 'Admin'; }else{ echo'User';} ?></td>
                <td><?php if(!empty($row->product_mpn_isbn)){ echo $row->product_mpn_isbn; } ?></td>
                <td><?php if(!empty($row->product_make)){ echo $row->product_make; } ?></td>
                <td><?php if(!empty($row->product_model)){ echo $row->product_model; } ?></td>
                <td><?php if(!empty($row->product_type)){ echo $row->product_type; } ?></td>
                 <td><?php if(!empty($row->product_color)){ echo $row->product_color; } ?></td>
              
                <th>
                <a href="<?php echo base_url().'admin/edit_listing_attribute/'.$row->id;  ?>" class="btn btn-primary" >Edit</a>
                <a href="<?php echo base_url().'admin/delete_listing_attribute/'.$row->id;  ?>" onclick="confirm('Are your sure');"  class="btn btn-danger" >Delete</a>
                </th>
            </tr>
                    
            <?php }
            } else{?>
        <tr><td colspan="7"><center><h3>No Listing Attributes are available.</h3></center></td></tr>
        <?php } ?>
        </tbody>
        </table>
        </div>
    </div>
</div>
</div>
</div>