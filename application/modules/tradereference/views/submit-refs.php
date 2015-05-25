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
  </div>

  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
              		<h4>Why do we need trade references?</h4> 
                    <p>Before we allow companies on our trading platform we ask all users to supply two (2) trade references.</p>
                    <p>We require you to supply the details of companies you have dealt with in the last 3 months, just to verify that they have done business with you and that you are a real company and trustworthy.</p>
                    <p>We do this for all companies to keep our platform as safe as possible for the end user.</p>
                </div><!-- Ibox Content -->
            </div>
        </div>
    </div>
<?php
    $attributes = array('class' => 'form-horizontal');
    echo form_open('tradereference/updateRef', $attributes);
?> 
 
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
                  
          <div class="ibox-content">
          <?php if($trader == 'trade_1') { ?>
              <h2>Trade Reference One</h2>
              <div class="form-group">
                    	<label class="col-md-3 control-label">Company Name <span style="color:red">*</span></label>
                        <div class="col-md-9">
							<?php
                            
                                if($trade_ref->trade_1_company != ''){
                                    
                                    $data = array(
                                                'name'          => 'trade_1_company',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Company Name',
                                                'value'         => $trade_ref->trade_1_company,
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                else{
                                    
                                    $data = array(
                                                'name'          => 'trade_1_company',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Company Name',
                                                'value'         => $this->input->post('trade_1_company'),
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Contact Name <span style="color:red">*</span></label>
                        <div class="col-md-9">
							<?php
                            
                                if($trade_ref->trade_1_name != ''){
                                    
                                    $data = array(
                                                'name'          => 'trade_1_name',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Contact Name',
                                                'value'         => $trade_ref->trade_1_name,
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                else{
                                    
                                    $data = array(
                                                'name'          => 'trade_1_name',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Contact Name',
                                                'value'         => $this->input->post('trade_1_name'),
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Email <span style="color:red">*</span></label>
                        <div class="col-md-9">
							 <?php if($trade_ref->trade_1_email != ''){ ?>
                                <input type="email" class="form-control" name="trade_1_email" placeholder="Email" value="<?php echo $trade_ref->trade_1_email;?>" required="required">
                            <?php } else { ?>
                                <input type="email" class="form-control" name="trade_1_email" placeholder="Email" value="<?php echo $this->input->post('trade_1_email');?>" required="required">
                            <?php } ?>
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Phone <span style="color:red">*</span></label>
                        <div class="col-md-9">
                        <?php
                    
                            if($trade_ref->trade_1_phone != ''){
                                
                                $data = array(
                                            'name'          => 'trade_1_phone',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Phone',
                                            'value'         => $trade_ref->trade_1_phone,
                                            'required'      => 'required'
                                          );
                    
                                echo form_input($data);
                                
                            }
                            else{
                                
                                $data = array(
                                            'name'          => 'trade_1_phone',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Phone',
                                            'value'         => $this->input->post('trade_1_phone'),
                                            'required'      => 'required'
                                          );
                    
                                echo form_input($data);
                                
                            }
                            
                        ?>
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Country <span style="color:red">*</span></label>
                        <div class="col-md-9">
                            <select name="trade_1_country" class="form-control" required="required">
                              <?php if($trade_ref->trade_1_country != '') {?>
                                  <option value="<?php echo $trade_ref->trade_1_country; ?>"><?php echo $this->country_model->get_where($trade_ref->trade_1_country)->country; ?></option>
                                  <?php } else {?>
                                  <option value="">Please select country</option>
                                  <?php } ?>
                              <?php foreach ($country_one as $country_one) {?>        
                                  <option value="<?php echo $country_one->id; ?>"><?php echo $country_one->country; ?></option>
                              <?php }?> 
                          </select>
                        </div>
                    </div> 
                    <input type="hidden" name="trader" value="trade_1"/>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input class="btn btn-primary" type="submit" value="Submit"/>
                        </div>
                    </div>
          <?php } elseif($trader == 'trade_2') {?>
              <h2>Trade Reference Two</h2> 
              <div class="form-group">
                    	<label class="col-md-3 control-label">Company Name <span style="color:red">*</span></label>
                        <div class="col-md-9">
							<?php
                            
                                if($trade_ref->trade_2_company != ''){
                                    
                                    $data = array(
                                                'name'          => 'trade_2_company',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Company Name',
                                                'value'         => $trade_ref->trade_2_company,
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                else{
                                    
                                    $data = array(
                                                'name'          => 'trade_2_company',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Company Name',
                                                'value'         => $this->input->post('trade_2_company'),
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Contact Name <span style="color:red">*</span></label>
                        <div class="col-md-9">
							<?php
                            
                                if($trade_ref->trade_2_name != ''){
                                    
                                    $data = array(
                                                'name'          => 'trade_2_name',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Contact Name',
                                                'value'         => $trade_ref->trade_2_name,
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                else{
                                    
                                    $data = array(
                                                'name'          => 'trade_2_name',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Contact Name',
                                                'value'         => $this->input->post('trade_2_name'),
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Email <span style="color:red">*</span></label>
                        <div class="col-md-9">
							 <?php if($trade_ref->trade_2_email != ''){ ?>
                                <input type="email" class="form-control" name="trade_2_email" placeholder="Email" value="<?php echo $trade_ref->trade_2_email;?>" required="required">
                            <?php } else { ?>
                                <input type="email" class="form-control" name="trade_2_email" placeholder="Email" value="<?php echo $this->input->post('trade_2_email');?>" required="required">
                            <?php } ?>
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Phone <span style="color:red">*</span></label>
                        <div class="col-md-9">
                        <?php
                    
                            if($trade_ref->trade_2_phone != ''){
                                
                                $data = array(
                                            'name'          => 'trade_2_phone',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Phone',
                                            'value'         => $trade_ref->trade_2_phone,
                                            'required'      => 'required'
                                          );
                    
                                echo form_input($data);
                                
                            }
                            else{
                                
                                $data = array(
                                            'name'          => 'trade_2_phone',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Phone',
                                            'value'         => $this->input->post('trade_2_phone'),
                                            'required'      => 'required'
                                          );
                    
                                echo form_input($data);
                                
                            }
                            
                        ?>
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Country <span style="color:red">*</span></label>
                        <div class="col-md-9">
                            <select name="trade_2_country" class="form-control" required="required">
                              <?php if($trade_ref->trade_2_country != '') {?>
                                  <option value="<?php echo $trade_ref->trade_2_country; ?>"><?php echo $this->country_model->get_where($trade_ref->trade_2_country)->country; ?></option>
                                  <?php } else {?>
                                  <option value="">Please select country</option>
                                  <?php } ?>
                              <?php foreach ($country_two as $country_two) {?>        
                                  <option value="<?php echo $country_two->id; ?>"><?php echo $country_two->country; ?></option>
                              <?php }?> 
                          </select>
                        </div>
                    </div>
                    <input type="hidden" name="trader" value="trade_2"/>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input class="btn btn-primary" type="submit" value="Submit"/>
                        </div>
                    </div>
              
          <?php } else { ?>    
          <h2>Trade Reference One</h2>    
          <?php if($trade_ref->trade_1_confirm != 'yes'){?>    
          
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Company Name <span style="color:red">*</span></label>
                        <div class="col-md-9">
							<?php
                            
                                if($trade_ref->trade_1_company != ''){
                                    
                                    $data = array(
                                                'name'          => 'trade_1_company',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Company Name',
                                                'value'         => $trade_ref->trade_1_company,
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                else{
                                    
                                    $data = array(
                                                'name'          => 'trade_1_company',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Company Name',
                                                'value'         => $this->input->post('trade_1_company'),
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Contact Name <span style="color:red">*</span></label>
                        <div class="col-md-9">
							<?php
                            
                                if($trade_ref->trade_1_name != ''){
                                    
                                    $data = array(
                                                'name'          => 'trade_1_name',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Contact Name',
                                                'value'         => $trade_ref->trade_1_name,
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                else{
                                    
                                    $data = array(
                                                'name'          => 'trade_1_name',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Contact Name',
                                                'value'         => $this->input->post('trade_1_name'),
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Email <span style="color:red">*</span></label>
                        <div class="col-md-9">
							 <?php if($trade_ref->trade_1_email != ''){ ?>
                                <input type="email" class="form-control" name="trade_1_email" placeholder="Email" value="<?php echo $trade_ref->trade_1_email;?>" required="required">
                            <?php } else { ?>
                                <input type="email" class="form-control" name="trade_1_email" placeholder="Email" value="<?php echo $this->input->post('trade_1_email');?>" required="required">
                            <?php } ?>
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Phone <span style="color:red">*</span></label>
                        <div class="col-md-9">
                        <?php
                    
                            if($trade_ref->trade_1_phone != ''){
                                
                                $data = array(
                                            'name'          => 'trade_1_phone',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Phone',
                                            'value'         => $trade_ref->trade_1_phone,
                                            'required'      => 'required'
                                          );
                    
                                echo form_input($data);
                                
                            }
                            else{
                                
                                $data = array(
                                            'name'          => 'trade_1_phone',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Phone',
                                            'value'         => $this->input->post('trade_1_phone'),
                                            'required'      => 'required'
                                          );
                    
                                echo form_input($data);
                                
                            }
                            
                        ?>
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Country <span style="color:red">*</span></label>
                        <div class="col-md-9">
                            <select name="trade_1_country" class="form-control" required="required">
                              <?php if($trade_ref->trade_1_country != '') {?>
                                  <option value="<?php echo $trade_ref->trade_1_country; ?>"><?php echo $this->country_model->get_where($trade_ref->trade_1_country)->country; ?></option>
                                  <?php } else {?>
                                  <option value="">Please select country</option>
                                  <?php } ?>
                              <?php foreach ($country_one as $country_one) {?>        
                                  <option value="<?php echo $country_one->id; ?>"><?php echo $country_one->country; ?></option>
                              <?php }?> 
                          </select>
                        </div>
                    </div>
                      

		<div class="hr-line-dashed"></div>
            <?php } else { ?>
            <strong>CONFIRMED</strong>
            <br/>
            <br/>
            <?php }?>
            <h2>Trade Reference Two</h2>
            <?php if($trade_ref->trade_2_confirm != 'yes'){?>      
          
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Company Name <span style="color:red">*</span></label>
                        <div class="col-md-9">
							<?php
                            
                                if($trade_ref->trade_2_company != ''){
                                    
                                    $data = array(
                                                'name'          => 'trade_2_company',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Company Name',
                                                'value'         => $trade_ref->trade_2_company,
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                else{
                                    
                                    $data = array(
                                                'name'          => 'trade_2_company',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Company Name',
                                                'value'         => $this->input->post('trade_2_company'),
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Contact Name <span style="color:red">*</span></label>
                        <div class="col-md-9">
							<?php
                            
                                if($trade_ref->trade_2_name != ''){
                                    
                                    $data = array(
                                                'name'          => 'trade_2_name',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Contact Name',
                                                'value'         => $trade_ref->trade_2_name,
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                else{
                                    
                                    $data = array(
                                                'name'          => 'trade_2_name',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Contact Name',
                                                'value'         => $this->input->post('trade_2_name'),
                                                'required'      => 'required'
                                              );
                        
                                    echo form_input($data);
                                    
                                }
                                
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Email <span style="color:red">*</span></label>
                        <div class="col-md-9">
							 <?php if($trade_ref->trade_2_email != ''){ ?>
                                <input type="email" class="form-control" name="trade_2_email" placeholder="Email" value="<?php echo $trade_ref->trade_2_email;?>" required="required">
                            <?php } else { ?>
                                <input type="email" class="form-control" name="trade_2_email" placeholder="Email" value="<?php echo $this->input->post('trade_2_email');?>" required="required">
                            <?php } ?>
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Phone <span style="color:red">*</span></label>
                        <div class="col-md-9">
                        <?php
                    
                            if($trade_ref->trade_2_phone != ''){
                                
                                $data = array(
                                            'name'          => 'trade_2_phone',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Phone',
                                            'value'         => $trade_ref->trade_2_phone,
                                            'required'      => 'required'
                                          );
                    
                                echo form_input($data);
                                
                            }
                            else{
                                
                                $data = array(
                                            'name'          => 'trade_2_phone',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'Phone',
                                            'value'         => $this->input->post('trade_2_phone'),
                                            'required'      => 'required'
                                          );
                    
                                echo form_input($data);
                                
                            }
                            
                        ?>
                        </div>
                    </div>                    
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Country <span style="color:red">*</span></label>
                        <div class="col-md-9">
                          <select name="trade_2_country" class="form-control" required="required">
                              <?php if($trade_ref->trade_2_country != '') {?>
                                  <option value="<?php echo $trade_ref->trade_2_country; ?>"><?php echo $this->country_model->get_where($trade_ref->trade_2_country)->country; ?></option>
                                  <?php } else {?>
                                  <option value="">Please select country</option>
                                  <?php } ?>
                              <?php foreach ($country_two as $country_two) {?>        
                                  <option value="<?php echo $country_two->id; ?>"><?php echo $country_two->country; ?></option>
                              <?php }?> 
                          </select>
                        </div>
                    </div>
                    <?php } else { ?>
                    <strong>CONFIRMED</strong>
                    <?php }?>
                    <div class="hr-line-dashed"></div>            
                    <?php if($trade_ref->trade_1_confirm != 'yes' || $trade_ref->trade_2_confirm != 'yes') {?>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
      						<input class="btn btn-primary" type="submit" value="Submit"/>
                        </div>
                    </div>
                    <?php }?>            
          <?php }?>                  
          </div><!-- Ibox Content -->
          </div>        
      </div><!-- /col -->      
    <?php echo form_close(); ?>
    </div> 
</div>

