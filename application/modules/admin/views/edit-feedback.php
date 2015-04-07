<?php

//echo '<pre>';
//print_r($feedback);
//exit;

$this->load->model('member/member_model', 'member_model');
$this->load->model('company/company_model', 'company_model');
?>
<div class="clear" style="margin-bottom: 10px;"></div>
    <div class="row">

        
    <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                
                <h2>
                    View Feed
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">                    
                    <h5>
                        <span class="pull-right font-noraml"><?php echo $feedback->time.' '.$feedback->date;?></span>
                        <span class="font-noraml">From: </span><?php echo $this->member_model->get_where($feedback->member_id)->firstname.' '.$this->member_model->get_where($feedback->member_id)->lastname.' ('.$this->company_model->get_where($this->member_model->get_where($feedback->member_id)->company_id)->company_name.')'; ?>
                    </h5>
                </div>
            </div>
            <?php 
                $attributes = array('class' => 'form-horizontal');
                echo form_open('admin/feedbackUpdate/'.$feedback->id, $attributes); 
            ?>
                <div class="mail-box">
                    
<!--                    <textarea class="form-control" style="white-space: pre-wrap"><?php echo $feedback->content;?></textarea> -->
                    <?php 
                            
                                $data = array(
                                            'name'      => 'content',
                                            'class'     => 'form-control', 
                                            'style'     => 'border:none',
                                            'value'     => strip_tags ($feedback->comments),
                                            'required'  => 'required'
                                          );

                                echo form_textarea($data);
                            
                            ?>
                
                <div class="mail-body text-right tooltip-demo">
                    <input name="submit" type="submit" class="btn btn-sm btn-primary" value="Update"/>
<!--                    <a class="btn btn-sm btn-white" href="<?php echo $feedback->id;?>"><i class="fa fa-check text-navy"></i> Update</a>-->
                </div>
                <div class="clearfix"></div>
                
                </div>
        <?php echo form_close()?>
            </div>
        

        
    </div>

</div>

