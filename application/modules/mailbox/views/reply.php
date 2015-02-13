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
                <h2>Reply Mail</h2>
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
                                            'value'     => $this->member_model->get_where_multiple('id', $this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->member_id)->email,     
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
                                            'value'     => 'Re: '.$this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->subject,     
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
//                            $body = $this->input->post('body');
//                            if($body == ''){
//                                
//                                $data = array(
//                                            'name'          => 'body',
//                                            'class'         => 'form-control', 
//                                            'value'         => strip_tags($this->mailbox_model->get_where_multiple('id', $this->uri->segment(3))->body),
//                                            'style'         => 'border:none',
//                                            'required'      => 'required'
//                                          );
//
//                                echo form_textarea($data);
//                                
//                            }
//                            else{
                            
                                $data = array(
                                            'name'        => 'body',
                                            'class'       => 'form-control',
											'autofocus'  =>	'autofocus',
                                            'style'     => 'border:none',
                                            'required'      => 'required'
                                          );

                                echo form_textarea($data);
                            //}
                            
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
<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                
            </div>
            <div class="col-lg-9 animated fadeInRight">            
            <?php
                $message_id = $this->uri->segment(4);
                if($reply_count > 0){

                    foreach($inbox_reply as $reply){
                        if($reply->id <= $message_id){
                ?>

                        <div class="mail-box-header" style="border-bottom: 1px solid #e6e6e6">
                            <div class="pull-right tooltip-demo">
                                <p><?php echo $reply->time;?> &amp; <?php echo $reply->date;?></p>
                            </div>
                            <h2><?php echo $reply->subject;?></h2>
                            <p>From:                                 
                                <?php echo $this->member_model->get_where($reply->member_id)->firstname.' '.$this->member_model->get_where($reply->member_id)->lastname?>
                            </p>
                        </div>
                        <div class="mail-box" style="padding:10px;">
                            <?php echo $reply->body;?>
                        </div>

                <?php
                        }
                    }
                ?>
                    <div class="mail-box-header" style="border-bottom: 1px solid #e6e6e6">
                    <p><strong>Original Email</strong></p>
                        <div class="pull-right tooltip-demo">
                            <p><?php echo $original_email->time;?> &amp; <?php echo $reply->date;?></p>
                        </div>
                        <h2><?php echo $original_email->subject;?></h2>
                        <p>From: <?php echo $this->member_model->get_where($original_email->member_id)->firstname.' '.$this->member_model->get_where($original_email->member_id)->lastname?></p>
                    </div>
                    <div class="mail-box" style="padding:10px;">
                        <?php echo $original_email->body;?>
                    </div>
                <?php
                }

            ?>
            <?php 
//                $this->load->model('member/member_model', 'member_model');
//                $this->load->model('mailbox/mailbox_model', 'mailbox_model');
//                $reply_id = $this->uri->segment(3);
//                $original_id = $this->uri->segment(4);
//                if($reply_id > 0){ 
                    
            ?>
                    
<!--                    <div class="mail-box-header" style="border-bottom: 1px solid #e6e6e6">
                        <div class="pull-right tooltip-demo">
                            <p><?php echo $inbox_original->time;?> &amp; <?php echo $inbox_original->date;?></p>
                        </div>
                        <h2><?php echo $inbox_original->subject;?></h2>
                        <p><?php echo $this->member_model->get_where($inbox_original->member_id)->firstname.' '.$this->member_model->get_where($inbox_original->member_id)->lastname?></p>
                    </div>
                    <div class="mail-box" style="padding:10px;">
                        <?php echo $inbox_original->body;?>
                    </div>-->
                
                    
            <?php 
            
                //} 
            ?>
             
            </div>
        </div>
</div>
       
