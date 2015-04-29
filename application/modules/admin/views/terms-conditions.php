<?php

//echo '<pre>';
//print_r($terms);
//exit;

?>

<div class="clear" style="margin-bottom: 10px;"></div>
    <div class="row"> 
        <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <?php echo $this->session->flashdata('admin-events');?>
                    <div class="ibox-title">
                        <h5><?php echo $terms->title; ?></h5>
                    </div>    
                      
                    <div style="margin-top:10px;">
                       
                        <?php echo form_open_multipart('admin/legalEdit/1'); ?>
<!--                         <div class="form-group">
                             <img src="<?php echo $base; ?>/public/main/template/gsm/images/events/<?php echo $id; ?>.jpg" width="250" height="250" title="" alt=""/>
                            <input type="file" name="userfile" size="20" />
                         </div>-->
                         <div class="form-group">
                            <span>Title:</span>
                            <?php
                            
                            if($terms->title){
                                
                                $data = array(
                                                'name'          => 'title',
                                                'class'         => 'form-control',
                                                'value'         => $terms->title,
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                
                            }
                            else{

                                $data = array(
                                                'name'          => 'title',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Title',
                                                'value'         => $this->input->post('title'),
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                  
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <span>URL Link:</span>
                            <?php
                            
                            if($terms->url_link){
                                
                                $data = array(
                                                'name'          => 'url_link',
                                                'class'         => 'form-control',
                                                'value'         => $terms->url_link,
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                  
                            }else{

                                $data = array(
                                                'name'          => 'url_link',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'URL Link',
                                                'value'         => $this->input->post('url_link'),
                                                'required'      => 'required'
                                              );

                                  echo form_input($data);
                                  
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <span>Content:</span>
                            <?php
                            
                            if($terms->content){
                                
                                $data = array(
                                                'name'          => 'content',
                                                'class'         => 'form-control',
                                                'value'         => $terms->content,
                                                'required'      => 'required'
                                              );

                                  echo form_textarea($data);
                                  
                            }else{

                                $data = array(
                                                'name'          => 'venue',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Event Venue',
                                                'value'         => $this->input->post('content'),
                                                'required'      => 'required'
                                              );

                                  echo form_textarea($data);
                                  
                            }
                            ?>
                        </div>
                       
                        <div class="form-group">
                            <div class="mail-body text-right tooltip-demo">
                                <input type="submit" class="btn btn-sm btn-white" value="Update"/>
                            </div>
                        </div>    
                    <?php echo form_close(); ?>
                            </div>
                        
                </div>
         </div>
    </div>

