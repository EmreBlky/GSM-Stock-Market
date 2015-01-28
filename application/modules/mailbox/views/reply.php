        <div class="wrapper wrapper-content">
        <div class="row">
            <?php
            
                $this->load->module('mailbox');
                $this->mailbox->side_mail();
                $this->load->model('member/member_model', 'member_model');
            
            ?>
            <?php 
                $attributes = array('class' => 'form-horizontal');
                echo form_open('mailbox/composeMail', $attributes); 
            ?>
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <a href="mailbox/draft/<?php echo $this->uri->segment(3);?>" class="btn btn-white btn-sm">Draft</a>
                    <a href="mailbox/inbox/<?php echo $this->uri->segment(3);?>" class="btn btn-danger btn-sm">Discard</a>
                </div>
                <h2>Compse mail</h2>
            </div>
                <div class="mail-box">
                <div class="mail-body">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">To:</label>
                        <div class="col-sm-10">                                
                            <?php
                            $email = $this->input->post('email_address');
                            if($email == ''){
                                
                                $data = array(
                                            'name'      => 'email_address',
                                            'class'     => 'form-control',
                                            'value'     => $this->member_model->get_where_multiple('id', $this->mailbox_model->get_where_multiple('id', $this->uri->segment(3))->member_id)->email,     
                                            'required'  => 'required'
                                          );

                                echo form_input($data);
                                
                            }
                            else{
                                $data = array(
                                            'name'      => 'email_address',
                                            'class'     => 'form-control',
                                            'value'     => $email,     
                                            'required'  => 'required'
                                          );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subject:</label>

                        <div class="col-sm-10">
                            <?php
                            $subject = $this->input->post('subject');
                            if($subject == ''){
                                
                                $data = array(
                                            'name'      => 'subject',
                                            'class'     => 'form-control',
                                            'value'     => 'Re: '.$this->mailbox_model->get_where_multiple('id', $this->uri->segment(3))->subject,     
                                            'required'  => 'required'
                                          );

                                echo form_input($data);
                                
                            }
                            else{
                                $data = array(
                                            'name'      => 'subject',
                                            'class'     => 'form-control',
                                            'value'     => $this->input->post('subject')
                                          );

                                echo form_input($data);
                            }
                            ?>
                        </div>
                    </div>
                </div>

                    <div class="mail-text h-200">

                        <div class="summernote">
                           
                            <?php
                            $body = $this->input->post('body');
                            if($body == ''){
                                
                                $data = array(
                                            'name'          => 'body',
                                            'class'         => 'form-control', 
                                            'value'         => nl2br($this->mailbox_model->get_where_multiple('id', $this->uri->segment(3))->body),
                                            'style'         => 'border:none',
                                            'required'      => 'required'
                                          );

                                echo form_textarea($data);
                                
                            }
                            else{
                            
                                $data = array(
                                            'name'        => 'body',
                                            'class'       => 'form-control', 
                                            'style'     => 'border:none',
                                            'required'      => 'required'
                                          );

                                echo form_textarea($data);
                            }
                            
                            ?>

                        </div>
                        
                            <?php 
                            
                                $data = array(
                                            'parent_id'        => $this->uri->segment(3)
                                          );

                                echo form_hidden($data);
                            
                            ?>
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
        </div>
        </div>