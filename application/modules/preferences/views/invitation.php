  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <h2>Company Invitations</h2>
          <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Preferences</li>
            <li>Invitations</li>          
        </ol>
    </div>
  </div>

  <div class="wrapper wrapper-content animated fadeInRight">
<?php
    $attributes = array('class' => 'form-horizontal');
    echo form_open('preferences/sendInvites', $attributes);
?>  
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
                  
          <div class="ibox-content">
              <div class="form-group">
                    	<label class="col-md-3 control-label">Email Addresses <span style="color:red">*</span></label>
                        <div class="col-md-9">
			<?php                            
                                    
                            $data = array(
                                        'name'          => 'email_address',
                                        'class'         => 'form-control',
                                        'placeholder'   => 'Email Addresses',
                                        'value'         => $this->input->post('email_address'),
                                        'required'      => 'required'
                                      );

                            echo form_input($data);
                            
                            ?>
                            <span style="font-size: 10px;">Separate with a comma (,)</span>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                    	<label class="col-md-3 control-label">Email Message</label>
                        <div class="col-md-9">
                            <?php
                            
                                 $data = array(
                                                'name'          => 'email_message',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Email Message',
                                                'value'         => $this->input->post('email_message')
                                              );
                        
                                    echo form_textarea($data);
                                 
                            ?>
                        </div>
                    </div>                                       
                    
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input class="btn btn-primary" type="submit" value="Submit"/>
                        </div>
                    </div>
            
          </div><!-- Ibox Content -->
          </div>        
      </div><!-- /col -->      
    <?php echo form_close(); ?>
    </div> 
</div>

