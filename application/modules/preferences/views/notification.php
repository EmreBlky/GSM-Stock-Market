  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>Blacklist Check</h2>
          <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li>IMEI Services</li>
          <li class="active"><strong>Blacklist Check</strong></li>
        </ol>
    </div>
  </div>

  <div class="wrapper wrapper-content animated fadeInRight">
        
    <div class="row"><?php 
    echo $this->session->flashdata('confirmation'); 
?>
      <div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-title"><h5>Email Notifications</h5></div>
          
          <div class="ibox-content">
              	<form action="notification/updateProfile" class="form-horizontal" method="post">

            <div class="form-group">
              <div class="col-lg-12">

                    <div class="form-group">
                        <label class="col-md-6 control-label">Profile Report<br /><p class="text-navy">Receive weekly email update of profile views.</p></label>

                        <div class="col-md-6">
                            <?php if($notification->report_views == 'yes') {?>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="report_views" value="yes" checked/> <i></i> Yes </label></div>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="report_views" value="no"/> <i></i> No </label></div>
                            <?php } else {?>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="report_views" value="yes"/> <i></i> Yes </label></div>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="report_views" value="no" checked/> <i></i> No </label></div>
                            <?php }?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 control-label">Mailbox messages from Members<br /><p class="text-navy">Receive an email when you get messaged by a member.</p></label>

                        <div class="col-md-6">
							<?php if($notification->email_members == 'yes') {?>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="email_members" value="yes" checked/> <i></i> Yes </label></div>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="email_members" value="no"/> <i></i> No </label></div>
                            <?php } else {?>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="email_members" value="yes"/> <i></i> Yes </label></div>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="email_members" value="no" checked/> <i></i> No </label></div>
                            <?php }?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 control-label">Mailbox messages from Marketplace<br /><p class="text-navy">Receive an email when you get messages from the marketplace.</p></label>

                        <div class="col-md-6">
							<?php if($notification->email_market == 'yes') {?>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="email_market" value="yes" checked/> <i></i> Yes </label></div>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="email_market" value="no"/> <i></i> No </label></div>
                            <?php } else {?>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="email_market" value="yes"/> <i></i> Yes </label></div>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="email_market" value="no" checked/> <i></i> No </label></div>
                            <?php }?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 control-label">Mailbox messages from Support<br /><p class="text-navy">Receive an email when you get messages from support.</p></label>

                        <div class="col-md-6">
							<?php if($notification->email_support == 'yes') {?>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="email_support" value="yes" checked/> <i></i> Yes </label></div>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="email_support" value="no"/> <i></i> No </label></div>
                            <?php } else {?>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="email_support" value="yes"/> <i></i> Yes </label></div>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="email_support" value="no" checked/> <i></i> No </label></div>
                            <?php }?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 control-label">Show My Own Sell / Buy Offers<br /><p class="text-navy">Choose whether to show your own Buying Requests and Selling Offers in your Profile Page.</p></label>
                        <div class="col-md-6">
							<?php
                            $yesChecked = ""; $noChecked = "checked";
                            if( $option = 'yes') { $yesChecked = "checked"; $noChecked = ""; }
                            ?>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="====" value="yes" <?=$yesChecked?>/> <i></i> Yes </label></div>
                            	<div class="radio-inline i-checks"><label> <input type="radio" name="====" value="no" <?=$noChecked?>/> <i></i> No </label></div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <input type="submit" class="col-md-offset-6 btn btn-primary" value="Save Changes"/>
                    </div>

                  </div>
              
            </div>

          </div><!-- Ibox Content -->
          
        </div>        
      </div><!-- /col -->
    
    </form>  
    </div>  <!-- /row -->
    
          
  </div><!-- /Wrapper -->
  
  
<!-- checkbox css -->
<link href="public/main/template/core/css/plugins/iCheck/custom.css" rel="stylesheet">

<!-- iCheck -->
<script src="public/main/template/core/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>