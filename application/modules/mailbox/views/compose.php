      

<div class="wrapper wrapper-content">
        <div class="row">
            <?php
            
                $this->load->module('mailbox');
                $this->mailbox->side_mail();
                $this->load->model('mailbox/mailbox_model', 'mailbox_model');
                $this->load->model('member/member_model', 'member_model');
            ?>
            <?php 

                if(isset($draft)){
            ?> 
            <?php 
                $attributes = array('class' => 'form-horizontal');
                echo form_open('mailbox/composeMail', $attributes); 
            ?>
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">                
                <h2>Compse mail from Draft</h2>
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
                                            'value'     => $this->member_model->get_where_multiple('id', $this->mailbox_model->get_where_multiple('id', $this->uri->segment(3))->sent_member_id)->email,     
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
                                            'value'     => $this->mailbox_model->get_where_multiple('id', $this->uri->segment(3))->subject
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
                                            'value'     => $this->mailbox_model->get_where_multiple('id', $this->uri->segment(3))->body,
                                            'required'      => 'required'
                                          );

                                echo form_textarea($data);
                            
                            ?>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="mail-body text-right tooltip-demo">
                        <input type="hidden" name="mail_type" value="draft"/>
                        <input type="hidden" name="mail_id" value="<?php echo $this->uri->segment(3);?>"/>
                        <input name="submit" type="submit" class="btn btn-sm btn-primary" value="Send"/>
                        <input name="submit" type="submit" class="btn btn-white btn-sm" value="Discard"/>
                        <input name="submit" type="submit" class="btn btn-white btn-sm" value="Draft"/>
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
            </div>
            <?php echo form_close()?>
            <?php } else {?>
            <?php 
                $attributes = array('class' => 'form-horizontal');
                echo form_open('mailbox/composeMail', $attributes); 
            ?>
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">                
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
                        <input name="submit" type="submit" class="btn btn-sm btn-primary" value="Send"/>
                        <input name="submit" type="submit" class="btn btn-white btn-sm" value="Discard"/>
                        <input name="submit" type="submit" class="btn btn-white btn-sm" value="Draft"/>
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
            </div>
            <?php echo form_close()?>
            <?php } ?>
        </div>
        </div>