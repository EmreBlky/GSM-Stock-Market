        <div class="wrapper wrapper-content">
        <div class="row">
            <?php
            
                $this->load->module('mailbox');
                $this->mailbox->side_mail();
            
            ?>
            <?php 
                $attributes = array('class' => 'form-horizontal');
                echo form_open('mailbox/composeMail', $attributes); 
            ?>
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <input name="submit_draft" type="submit" class="btn btn-white btn-sm" value="Draft"/>
                    <input name="submit_discard" type="submit" class="btn btn-danger btn-sm" value="Discard"/>
                </div>
                <h2>Compse mail</h2>
            </div>
                <div class="mail-box">
                <div class="mail-body">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">To:</label>
                        <div class="col-sm-10">                                
                            <?php
                                $data = array(
                                            'name'      => 'email_address',
                                            'class'     => 'form-control',
                                            'value'     => $this->input->post('email_address'),     
                                            'required'  => 'required'
                                          );

                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subject:</label>

                        <div class="col-sm-10">
                            <?php
                                $data = array(
                                            'name'      => 'subject',
                                            'class'     => 'form-control',
                                            'value'     => $this->input->post('subject')
                                          );

                                echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>

                    <div class="mail-text h-200">

                        <div class="summernote">
                           
                            <?php 
                            
                                $data = array(
                                            'name'        => 'body',
                                            'class'       => 'form-control', 
                                            'style'     => 'border:none',
                                            'required'      => 'required'
                                          );

                                echo form_textarea($data);
                            
                            ?>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="mail-body text-right tooltip-demo">
                        <input name="submit_send" type="submit" class="btn btn-sm btn-primary" value="Send"/>
                        <input name="submit_discard" type="submit" class="btn btn-white btn-sm" value="Discard"/>
                        <input name="submit_draft" type="submit" class="btn btn-white btn-sm" value="Draft"/>
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
            </div>
            <?php echo form_close()?>
        </div>
        </div>