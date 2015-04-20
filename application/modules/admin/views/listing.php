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
            <th>List Id</th>
            <th>Added by</th>
            <th>MPN/ISBN</th>
            <th>Make</th>
            <th>Model</th>
            <th>Product Type</th>
            <th>Color</th>
            <th>Status</th>
            <!-- <th>Options</th> -->
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($listing)){
                foreach ($listing as $row) { ?>
            <tr>
                <td><?php if(!empty($row->id)){ echo '#'.$row->id; } ?></td>
                <td><?php if($row->member_id==1){ echo 'Admin'; }else{ echo'User';} ?></td>
                <td>

                <?php if(!empty($row->product_mpn)){ echo "MPN: ".$row->product_mpn; } ?>
                    <br>
                <?php if(!empty($row->product_isbn)){ echo "ISBN: ".$row->product_isbn; } ?>

                </td>
                <td><?php if(!empty($row->product_make)){ echo $row->product_make; } ?></td>
                <td><?php if(!empty($row->product_model)){ echo $row->product_model; } ?></td>
                <td><?php if(!empty($row->product_type)){ echo $row->product_type; } ?></td>
                <td><?php if(!empty($row->product_color)){ echo $row->product_color; } ?></td>
                <td><div class="btn-group">
                    <button 
                    <?php if ($row->status == 0) echo 'class="btn btn-primary"';  ?>
                    <?php if ($row->status == 1) echo 'class="btn btn-green"';  ?>
                    <?php if ($row->status == 3) echo 'class="btn btn-danger"';  ?>
                  
                        type="button" style="margin-right:0px">
                        <?php if ($row->status == 0) echo 'Pending';  ?>
                        <?php if ($row->status == 1) echo 'Approve';  ?>
                        <?php if ($row->status == 3) echo 'Decline';  ?>
                    </button>
                    <button data-toggle="dropdown"
                    <?php if ($row->status == 0) echo 'class="btn btn-primary dropdown-toggle"'; ?>
                    <?php if ($row->status == 1) echo 'class="btn btn-green dropdown-toggle"'; ?>
                     <?php if ($row->status == 3) echo 'class="btn btn-danger dropdown-toggle"'; ?>
                    
                      
                     type="button"><i class="fa fa-angle-down"></i></button>
                    <ul role="menu" class="dropdown-menu"
                     <?php if ($row->status == 0) echo 'style="min-width:80px"'; ?>
                     <?php if ($row->status == 1) echo 'style="min-width:80px"'; ?>
                      <?php if ($row->status == 3) echo 'style="min-width:80px"'; ?>
                     >
                        <li>
                            <a href="<?php echo base_url() . 'admin/listing_status/' . $row->id .'/1'; ?>">Approve </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . 'admin/listing_status/' . $row->id . '/3'; ?>">Decline </a>
                        </li>
                      
                      </ul>
                  </div>
              </td>

               <!--  <th>
                <a href="<?php //echo base_url().'admin/edit_listing_attribute/'.$row->id;  ?>" class="btn btn-primary" >Edit</a> 
                <a href="<?php //echo base_url().'admin/delete_listing_attribute/'.$row->id;  ?>" onclick="confirm('Are your sure');"  class="btn btn-danger" >Delete</a>
                </th>-->
            </tr>

            <?php }
            } else{?>
        <tr><td colspan="9"><center><h3>No Pending Listing are available.</h3></center></td></tr>
        <?php } ?>
        </tbody>
        </table>
        </div>
    </div>
</div>
</div>
</div>