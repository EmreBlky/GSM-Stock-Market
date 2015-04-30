        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Book a Demonstration</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li class="active">
                        <strong>Demo</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                	<?php echo $this->session->flashdata('message');?>
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Want to understand our platform? Let us show you!</h5>
                        </div>
                        <div class="ibox-content">
                        	<div class="row">
                        	<div class="col-lg-8">
                            <p>If you are looking to try our platform before subscribing we completely understand. We are able to offer a 30-60 minute screen share demo with one of our dedicated account managers on a one-to-one basis to guide you through our platform and answer any questions you might have.</p>
                            <p>In our demo we will show you all aspects of our marketplace and guide you through all the steps to buy and sell on our trading platform. On top of this we can show you through other aspects of our platform if you require, just let us know what you would like to see by sending us a message below.</p>
                            <p>To get started simply fill out the form below and one of our dedicated account managers will be in touch shortly to setup your appointment.</p>
                            </div>
                            
                            <div class="col-lg-3">
                            	<img class="img-responsive" src="public/main/template/gsm/images/demo_mac.png" />
                            </div>
                            </div>
                        
                        </div>
                </div>
                
                <div class="col-lg-12">
                <div class="row">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Book a Demo</h5>
                        </div>
                        <div class="ibox-content">
                        <?php 
                            $attributes = array('class' => 'form-horizontal validation');
                            echo form_open('mailbox/composeDemo', $attributes); 
                        ?>
			<div class="form-group" style="display:none">
                        <label class="col-md-3 control-label">From</label>
                        <div class="col-md-9">
                        	<input class="form-control" name="from" value="<?php echo $member->email; ?>" />
                                <input type="hidden" name="cust_name" value="<?php echo $member->firstname. ' '.$member->lastname; ?>" />
                        </div>
                        </div>                        
			<div class="form-group">
<!--                        <label class="col-md-4 control-label">Demo Language <span style="color:red">*</span><br /><small class="text-navy">Select at least one (1)</small></label>-->
                            <label class="col-md-4 control-label">Demo Language <span style="color:red">*</span></label>
                        <div class="col-md-6">
                            <label class="checkbox-inline i-checks"> <input type="radio" name="lang" value="Engish" required="required" checked="checked"> English </label>
                            <label class="checkbox-inline i-checks"> <input type="radio" name="lang" value="German" required="required"> German </label>
                            <label class="checkbox-inline i-checks"> <input type="radio" name="lang" value="Italian" required="required"> Italian </label>
                        </div>                      
                    	</div>
                        
			<div class="form-group">
                        <label class="col-md-4 control-label">Message</label>
                            <div class="col-md-6">
                                <textarea class="form-control" rows="8" name="message" placeholder="I would like to see a demo of your marketplace/silver membership package..."></textarea>
                            </div>                       
                    	</div>

                            <div class="form-group">
                                <div class="col-md-10">
                                    <input class="btn btn-primary pull-right" name="submit_form" type="submit" id="submit_form" value="Request Appointment"/>
                                </div>
                            </div>
                        <?php echo form_close()?>
                        </div>

                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
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
    
    <!-- Jquery Validate -->
  <script src="public/main/template/core/js/plugins/validate/jquery.validate.min.js"></script>
  
  <script>
      $(document).ready(function () {
          $(".validation").validate({
              rules: {
                  "language": {
                      required: true,
                      minlength: 1
				  }
                  },
		  messages: { 
				  "language": "Please select at least one (1) language"
		  } 
          });
      });
  </script>