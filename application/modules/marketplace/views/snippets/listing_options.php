<a href="<?php echo base_url().'marketplace/'.$listing_type.'/'.$value->id; ?>" class="btn btn-warning" style="font-size:10px"><i class="fa fa-paste"></i> Edit</a>

<?php
if( $end_datetime > $current_datetime ){ // active listing ?>

    <a href="<?php echo base_url().'marketplace/listing_detail/'.$value->id; ?>" class="btn btn-success" style="font-size:10px"><i class="fa fa-eye"></i> View</a>

    <a href="<?php echo base_url().'marketplace/end_listing_status/'.$value->id; ?>" class="btn btn-danger" onclick="return confirm('Are your sure you want to end this listing ?');" style="font-size:10px"><i class="fa fa-times"></i> End Listing</a>

<?php }else{ // inactive listing ?>

    <a data-action="<?php echo base_url().'marketplace/re_list/'.$value->id; ?>" data-toggle="modal" data-target="#re_list_modal" class="btn btn-success re-list-btn" style="font-size:10px;"><i class="fa fa-arrow-up"></i> Re-list</a>

    <a href="<?php echo base_url().'marketplace/listing_delete/'.$value->id; ?>" class="btn btn-danger" onclick="return confirm('Are your sure you want to delete this listing?');" style="font-size:10px"><i class="fa fa-times"></i> Remove</a>

<?php } ?>