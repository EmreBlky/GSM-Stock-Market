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
                    
                        if($title == 'GSM Support.'){
                           echo '<div class="alert alert-success">'.$this->session->flashdata('message').'</div>';                    
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
                            echo form_open('mailbox/composeSupport', $attributes); 
                        ?>
			<div class="form-group" style="display:none">
                        <label class="col-md-3 control-label">From</label>
                        <div class="col-md-9">
                        	<input class="form-control" name="from" value="<?php echo $member->email; ?>" />
                                <input type="hidden" name="cust_name" value="<?php echo $member->firstname. ' '.$member->lastname; ?>" />
                        </div>
                        </div>                        
			<div class="form-group">
                        <label class="col-md-3 control-label">Subject</label>
                        <div class="col-md-9">
                            <select class="form-control" name="subject">
                                <option value="General">General Enquiry</option>
                            	<option value="Billing">Billing &amp; Accounts</option>
                            	<option value="Complaint">Abuse &amp; Complaints</option>
                            	<option value="Market Issue">Marketplace Issue</option>                                
                            	<option value="Feedback">Website Feedback</option>
                            	<option value="Other">Other</option>
                            </select>
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
        