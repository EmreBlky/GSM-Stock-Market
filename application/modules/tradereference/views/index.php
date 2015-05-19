<?php
//    echo '<pre>';
//    print_r($member);
//    print_r($trade_ref);
//    exit;
?>
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>Overview</h2>
          <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li>Preferences</li>
          <li>Trade References</li>
          <li class="active"><strong>Overview</strong></li>
        </ol>
    </div>
  </div><?php     
    echo $this->session->flashdata('trade-confirmation'); 
    echo $this->session->flashdata('confirm-resend');
?>
  
 <?php $id = $this->session->userdata('members_id');$member = $this->member_model->get_where($id);
if($member->membership == 1 ){ ?>
            <div class="alert alert-info" style="margin:15px 15px -15px">
                <p><i class="fa fa-info-circle"></i> If you are looking to upgrade to silver membership we will also require two (2) trade references. You can submit them before upgrading so when your membership is accepted you can view the rest of our website straight away.</p>
            </div>

<?php } else if($member->membership == 2 && $member->marketplace == 'inactive'){?>
            <div class="alert alert-warning" style="margin:15px 15px -15px">
                <p><i class="fa fa-warning"></i> Remember to supply 2 trade references so we can enable your membership to view profiles and access the marketplace.</p>
            </div>

<?php }?>

  <div class="wrapper wrapper-content animated fadeInRight">
        
    <div class="row">
      <div class="col-lg-6">
        <div class="ibox">
          <div class="ibox-title"><h5>Trade References</h5></div>
          
          <div class="ibox-content" style="min-height:170px">
          	<p>To gain access to the GSM Stock Market marketplace you will need to submit <strong>two (2)</strong> trade references for us to confirm your business</p>
            <p>When adding these trade references you will be able to track whether they have confirmed you or not.</p>
            <p>Once the companies have confirmed your trade references we will confirm also and you will then have complete access to our marketplace.</p>
          	 
          
                        
          </div><!-- Ibox Content -->
          
        </div>        
      </div><!-- /col -->
      
      <div class="col-lg-6">
        <div class="ibox">
          <div class="ibox-title">
              <?php if($member->marketplace == 'active') { ?>
                <span class="label label-primary pull-right">Marketplace Active</span>
              <?php } else {?>
                <span class="label label-danger pull-right">Marketplace Inactive</span>
              <?php }?>
          
          <h5>Reference Status</h5></div>
          
          <div class="ibox-content" style="min-height:170px">
          <div class="row">
          
          	<div class="col-md-12">            
              <label class="col-md-9 control-label" style="text-align:right">Silver Subscription</label>
              <div class="col-md-3">
                  <?php if($member->membership < 2) { ?>
                    <i class="fa fa-times" style="color:red"></i>
                  <?php } else { ?>
                    <i class="fa fa-check" style="color:green"></i>
                  <?php } ?>
                  
              </div>
            </div>
            
            <div class="col-md-12">            
              <label class="col-md-9 control-label" style="text-align:right">Add 2 Trade References</label>
              <div class="col-md-3">
                  <?php if($trade_ref->trade_1_company != '') {?>
                        <i class="fa fa-check" style="color:green"></i>
                  <?php } else { ?>
                        <i class="fa fa-times" style="color:red"></i>
                  <?php }?>
                  
              </div>
            </div>
            
            <div class="col-md-12">             
              <label class="col-md-9 control-label" style="text-align:right">2 Trade references confirmed by companies</label>
              <div class="col-md-3">
                  <?php if($trade_ref->trade_1_confirm == 'yes') {?>
                        <i class="fa fa-check" style="color:green"></i>
                  <?php } else { ?>
                        <i class="fa fa-times" style="color:red"></i>
                  <?php }?>
                  
                  <?php if($trade_ref->trade_2_confirm == 'yes') {?>
                        <i class="fa fa-check" style="color:green"></i>
                  <?php } else { ?>
                        <i class="fa fa-times" style="color:red"></i>
                  <?php }?>
                  
              </div>
            </div>
            
            <div class="col-md-12">             
              <label class="col-md-9 control-label" style="text-align:right">Trade references confirmed by GSM Stock Market</label>
              <div class="col-md-3">
                   <?php if($member->marketplace == 'active') { ?>
                        <i class="fa fa-check" style="color:green"></i>
                   <?php } else {?>
                        <i class="fa fa-times" style="color:red"></i>
                   <?php }?>
                  
              </div>
             </div>
             
            </div> 
          	</div><!-- Ibox Content -->
          
        </div>        
      </div><!-- /col -->
      
      <div class="col-lg-12">
        <div class="ibox">
          <?php if($trade_ref->trade_1_company != '') {?>  
          <div class="ibox-title"><h5>Trade Reference Overview</h5></div>
          
          <div class="ibox-content">
              	 <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $trade_ref->trade_1_company ;?></td>
                                <td><?php echo $trade_ref->trade_1_email ;?></td>
                                <td><?php echo $trade_ref->trade_1_phone ;?></td>
                                <td><?php echo $this->country_model->get_where($trade_ref->trade_1_country)->country ;?></td>
                                <?php if($trade_ref->trade_1_confirm == 'yes' && $trade_ref->trade_1_admin_approve == 'declined') {?>
                                    <td style="text-align:center"><span class="label label-danger">Declined</span></td>
                                <?php } elseif($trade_ref->trade_1_confirm == 'yes' && $trade_ref->trade_1_admin_approve != 'declined') {?>
                                    <td style="text-align:center"><span class="label label-primary">Confirmed</span></td>
                                <?php } else {?>
                                    <td style="text-align:center"><span class="label label-warning">Awaiting Confirmation</span></td>
                                <?php } ?>                                
                                <td style="text-align:center">
                                    <?php if($trade_ref->trade_1_confirm == 'no' || $trade_ref->trade_1_admin_approve == 'declined') {?>                                    
                                    <a href="tradereference/submit_refs/trade_1" class="btn btn-warning" style="font-size:10px">Edit</a>
                                    <a href="tradereference/resend/<?php echo $trade_ref->member_id ;?>/<?php echo $trade_ref->trade_1_name ;?>/<?php echo $trade_ref->trade_1_email ;?>/<?php echo $trade_ref->trade_1_code ;?>" class="btn btn-success" style="font-size:10px">Resend Email</a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $trade_ref->trade_2_company ;?></td>
                                <td><?php echo $trade_ref->trade_2_email ;?></td>
                                <td><?php echo $trade_ref->trade_2_phone ;?></td>
                                <td><?php echo $this->country_model->get_where($trade_ref->trade_2_country)->country  ;?></td>
                                <?php if($trade_ref->trade_2_confirm == 'yes' && $trade_ref->trade_2_admin_approve == 'declined') {?>
                                    <td style="text-align:center"><span class="label label-danger">Declined</span></td>
                                <?php } elseif($trade_ref->trade_2_confirm == 'yes' && $trade_ref->trade_2_admin_approve != 'declined') {?>
                                    <td style="text-align:center"><span class="label label-primary">Confirmed</span></td>
                                <?php } else {?>
                                    <td style="text-align:center"><span class="label label-warning">Awaiting Confirmation</span></td>
                                <?php } ?>   
                                <td style="text-align:center">
                                    <?php if($trade_ref->trade_2_confirm == 'no' || $trade_ref->trade_2_admin_approve == 'declined') {?>
                                    <a href="tradereference/submit_refs/trade_2" class="btn btn-warning" style="font-size:10px">Edit</a> 
                                    <a href="tradereference/resend/<?php echo $trade_ref->member_id; ?>/<?php echo $trade_ref->trade_2_name ;?>/<?php echo $trade_ref->trade_2_email ;?>/<?php echo $trade_ref->trade_2_code ;?>" class="btn btn-success" style="font-size:10px">Resend Email</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>    
          
                        
          </div><!-- Ibox Content -->
          <?php } else {?> 
          <div class="ibox-content" style="text-align:center">
                    <a href="tradereference/submit_refs" class="btn btn-primary" style="font-size:2em;text-align:center">Submit References Now</a>          
          		</div><!-- Ibox Content -->
          <?php } ?> 
        </div>        
      </div><!-- /col -->
    </div>  <!-- /row -->
    
          
  </div><!-- /Wrapper -->
  
