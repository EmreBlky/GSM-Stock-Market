        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Submit a Ticket</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        Support
                    </li>
                    <li class="active">
                        <strong>Submit a Ticket</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                	<?php 
                    $title = $this->session->flashdata('title');
                    	{
                           echo '<div class="alert alert-success">Your request for a demo has been submitted. We will get back to you shortly.</div>';                    
                        }  

                    ?>
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Submit a Ticket</h5>
                        </div>
                        <div class="ibox-content">
                        <?php 
                            $attributes = array('class' => 'form-horizontal');
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
                        <label class="col-md-3 control-label">Prefered Demo Spoken Language</label>
                        <div class="col-md-9">
                              <label class="checkbox-inline i-checks"> <input type="checkbox" value="language" checked> English </label>
                              <label class="checkbox-inline i-checks"> <input type="checkbox" value="language"> German </label>
                              <label class="checkbox-inline i-checks"> <input type="checkbox" value="language"> Italian </label>
                        </div>                      
                    	</div>
                        
			<div class="form-group">
                        <label class="col-md-3 control-label">Message</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="8" name="message"></textarea>
                            </div>                       
                    	</div>

                        <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-3">
                                    <input class="btn btn-primary" name="submit_form" type="submit" id="submit_form" value="Submit Ticket"/>
                                </div>
                            </div>
                        <?php echo form_close()?>
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