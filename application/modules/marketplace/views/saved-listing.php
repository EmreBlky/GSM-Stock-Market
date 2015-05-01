    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>My Listings</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    Marketplace
                </li>
                <li class="active">
                    <strong>My Listings</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <div class="title-action">
            </div>
        </div>
    </div>
<?php $id = $this->session->userdata('members_id');$member = $this->member_model->get_where($id);?>
<?php if($member->membership == 1 ){ ?>
            <div class="alert alert-info" style="margin:15px 15px -15px">
        <p><i class="fa fa-info-circle"></i> <strong>This is a Demo</strong> Silver members and above with criteria met will have access to the live marketplace. Your scheduled and saved listings will saved here. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
            </div>

<?php } else if($member->membership == 2 && $member->marketplace == 'inactive'){?>
            <div class="alert alert-warning" style="margin:15px 15px -15px">
                <p><i class="fa fa-warning"></i> You still need to supply 2 trade references so we can enable your membership to view profiles and access the marketplace. <a class="alert-link" href="tradereference">Submit trade references</a>.</p>
            </div>

<?php }?>

    <?php msg_alert(); ?>
    
    <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Saved listing - Buy</h5>
                </div>
                <div class="ibox-content">

                <table class="table table-striped table-bordered table-hover selling_offers" >
                <thead>
                <tr>
                    <th>End Date</th>
                    <th>MPN/ISBN</th>
                    <th>Make &amp; Model</th>
                    <th>Condition</th>
                    <th>Price</th>
                    <th>QTY</th>
                    <th>Spec</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(!empty($listing_save_later_buy)):  ?>
                    <?php foreach ($listing_save_later_buy as $value): ?>
                    <tr>
                        <td><?php echo date('h:i d-m', strtotime($value->listing_end_datetime)); ?></td>
                        <td><?php echo $value->product_mpn_isbn; ?></td>
                        <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
                        <td><?php echo $value->condition; ?></td>
                        <td data-toggle="tooltip" data-placement="left" title="t"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                        <td><?php echo $value->qty_available; ?></td>
                        <td><?php echo $value->spec; ?></td>
                        <th style="text-align:center">
                        <?php if (!empty($value->listing_type) && $value->listing_type == 1): ?>
                        <a href="<?php echo base_url().'marketplace/buy_listing/'.$value->id.'/saved_listing'; ?>" class="btn btn-warning" style="font-size:10px"><i class="fa fa-paste"></i> List Now</a>
                    <?php elseif(!empty($value->listing_type) && $value->listing_type == 2): ?>
                         <a href="<?php echo base_url().'marketplace/sell_listing/'.$value->id.'/saved_listing'; ?>" class="btn btn-warning" style="font-size:10px"><i class="fa fa-paste"></i> List Now</a>   
                    <?php endif ?>
                  
                        <a class="btn btn-danger" href="<?php echo base_url().'marketplace/listing_delete/'.$value->id; ?>" style="font-size:10px" onclick=" if(confirm('Are you sure want to delete list')){ return true; }else{ return false; }"><i class="fa fa-times"></i> <span class="bold">Delete</span></a>
                        </th>
                    </tr>
               
                    <?php endforeach ?>
                <?php endif; ?>
                </tbody>
                </table>

                </div>
            </div>
        </div>
        </div>
    <div class="row">
            <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Saved listing - Sell</h5>
            </div>
            <div class="ibox-content">

            <table class="table table-striped table-bordered table-hover selling_offers" >
            <thead>
            <tr>
                <th>End Date</th>
                <th>MPN/ISBN</th>
                <th>Make &amp; Model</th>
                <th>Condition</th>
                <th>Price</th>
                <th>QTY</th>
                <th>Spec</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <?php  if(!empty($listing_save_later_sell)):  ?>
                <?php foreach ($listing_save_later_sell as $value): ?>
                <tr>
                    <td><?php echo date('h:i d-m', strtotime($value->listing_end_datetime)); ?></td>
                    <td><?php echo $value->product_mpn_isbn; ?></td>
                    <td><?php echo $value->product_make; ?> <?php echo $value->product_model; ?></td>
                    <td><?php echo $value->condition; ?></td>
                    <td data-toggle="tooltip" data-placement="left" title="t"><?php echo currency_class($value->currency); ?> <?php echo $value->unit_price; ?></td>
                    <td><?php echo $value->qty_available; ?></td>
                    <td><?php echo $value->spec; ?></td>
                    <th style="text-align:center">
                    <?php if (!empty($value->listing_type) && $value->listing_type == 1): ?>
                    <a href="<?php echo base_url().'marketplace/buy_listing/'.$value->id.'/saved_listing'; ?>" class="btn btn-warning" style="font-size:10px"><i class="fa fa-paste"></i> List Now</a>
                <?php elseif(!empty($value->listing_type) && $value->listing_type == 2): ?>
                     <a href="<?php echo base_url().'marketplace/sell_listing/'.$value->id.'/saved_listing'; ?>" class="btn btn-warning" style="font-size:10px"><i class="fa fa-paste"></i> List Now</a>   
                <?php endif ?>
              
                    <a class="btn btn-danger" href="<?php echo base_url().'marketplace/listing_delete/'.$value->id; ?>" style="font-size:10px" onclick=" if(confirm('Are you sure want to delete list')){ return true; }else{ return false; }"><i class="fa fa-times"></i> <span class="bold">Delete</span></a>
                    </th>
                </tr>
           
                <?php endforeach ?>
            <?php endif; ?>
            </tbody>
            </table>

            </div>
        </div>
        </div>
        </div>   
        
    <!-- Data Tables -->
    <link href="public/main/template/core/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="public/main/template/core/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="public/main/template/core/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

    <!-- Data Tables -->
    <script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script type="text/javascript" src="public/main/template/core/js/plugins/dataTables/dataTables.tableTools.min.js"></script>

    <!-- Chosen -->
    <script src="public/main/template/core/js/plugins/chosen/chosen.jquery.js"></script>
    
    
    <!-- Page-Level Scripts -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.selling_offers').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "public/main/template/core/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });
            $('.buying_requests').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "public/main/template/core/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                }
            });
        });
    </script>
    
<style>
body.DTTT_Print { background: #fff;}
.DTTT_Print #page-wrapper {margin: 0;background:#fff;}
button.DTTT_button, div.DTTT_button, a.DTTT_button {border: 1px solid #e7eaec;background: #fff;color: #676a6c;box-shadow: none;padding: 6px 8px;}
button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {border: 1px solid #d2d2d2;background: #fff;color: #676a6c;box-shadow: none;padding: 6px 8px;}
.dataTables_filter label {margin-right: 5px;}

/*offer active class*/
#offer_status_accept{
background-color: #18a689;
border-color: #18a689;
color: #fff;
}

/*offer declined class*/
#offer_status_declined{
background-color: #ec4758;
border-color: #ec4758;
color: #fff;
}
</style>
<script>
    function get_buyers_offer(listing_id=0) {
        var list = listing_id;
       $.post('<?php echo base_url() ?>marketplace/get_buyers_offer', {listing_id: list}, function(data) {
           $('#buyers_list').html(data);
       });
    }

    function view_offer(listing_id=0) {
        var list = listing_id;
       $.post('<?php echo base_url() ?>marketplace/view_offer', {listing_id: list}, function(data) {
           $('#view_offer').html(data);
       });
    }

    function offer_status(listing_id=0, buyer_id=0) {
        var list = listing_id;
        var buyer_id = buyer_id;
       $.post('<?php echo base_url() ?>marketplace/offer_status', {listing_id: list, buyer_id: buyer_id}, function(data) {
           $('#offer_status_msg').html(data);
       });
    }
</script>