            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Change Password</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="active">
                            <strong>Change Password</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit Password</h5>
                        </div>
                        <div class="ibox-content">
                            
                            <?php 
                                $attributes = array('class' => 'form-horizontal');
                                echo form_open('preferences/passwordUpdate', $attributes); 
                            ?>    
                        	<div class="form-group"><label class="col-md-3 control-label">Current Password</label>
                                    <div class="col-md-9">
                                        <input type="password" placeholder="Current Password" id="password" class="form-control" name="old_password" id="old_password">
                                    </div>
                                </div>  
                                
                                <div class="hr-line-dashed"></div>
                                
                        		<div class="form-group"><label class="col-md-3 control-label">New Password</label>
                                    <div class="col-md-9">
                                        <input type="password" id="new_password" name="new_password" type="text" class="form-control required">
                                    </div>
                                </div>  
                        		<div class="form-group"><label class="col-md-3 control-label">Repeat New Password</label>
                                    <div class="col-md-9">
                                        <input type="password" id="confirm" name="confirm" type="text" class="form-control required">
                                    </div>
                                </div> 
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-3">
                                        <button class="btn btn-white" type="submit">Cancel</button>
                                        <button class="btn btn-primary" name="submit_form" type="submit" id="submit_form">Update Password</button>
                                    </div>
                                </div> 
                            <?php echo form_close()?>
                        </div>
                    </div>


                </div>
            </div>

        </div>

    <!-- Jquery Validate -->
    <script src="public/main/template/core/js/plugins/validate/jquery.validate.min.js"></script>
	<script>
	// just for the demos, avoids form submit
	jQuery.validator.setDefaults({
	  debug: true,
	  success: "valid"
	});
	$( "#form" ).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#new_password"
                            }
                        }
                    });
	</script>
        
    <!-- Toastr script -->
    <script src="public/main/template/core/js/plugins/toastr/toastr.min.js"></script><!-- ALERTS -->
    
    <script type="text/javascript">
        $(function () {
                toastr.options = {
                    closeButton: false,
                    debug:false,
                    progressBar: false,
                    positionClass: 'toast-bottom-right',
                    onclick: null,
					showDuration: 400,
					hideDuration: 1000,
					timeOut: 7000,
					extendedTimeOut: 1000,
					showEasing: 'swing',
					hideEasing: 'linear',
					showMethod: 'fadeIn',
					hideMethod: 'fadeOut',
				};  
    <?php if($this->session->flashdata('title')){?>    
        <?php if($this->session->flashdata('title') != 'Password Success'){ ?>
            toastr.error('<?php echo $this->session->flashdata('message');?>', '<?php echo $this->session->flashdata('title');?>');
        <?php } else{ ?>
            toastr.success('<?php echo $this->session->flashdata('message');?>', '<?php echo $this->session->flashdata('title');?>');
        <?php }?>
    <?php }?>    
     });
     </script>