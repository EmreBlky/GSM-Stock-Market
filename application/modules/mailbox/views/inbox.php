<script type="text/javascript">
    $(function() {

            autoRefreshInbox();

        });
        
        
        function autoRefreshInbox()
        {
            
            setTimeout("autoRefreshInbox()",10000);            
            
            $.get("mailbox/new_message_all", function(data) {
                $("#inbox_all_message").html(data);    
            });
            $.get("mailbox/new_message_market", function(data) {
                $("#inbox_market").html(data);    
            });
            $.get("mailbox/new_message_member", function(data) {
                $("#inbox_member").html(data);    
            });
            $.get("mailbox/new_message_support", function(data) {
                $("#inbox_support").html(data);    
            });
         }
    $(document).ready(function() {
        
    $('#select_all').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.i-checks').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.i-checks').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });
    
        
   
});        
</script>

<div class="wrapper wrapper-content">
        <div class="row">
            <?php
            
                $this->load->module('mailbox');
                $this->mailbox->side_mail();
            
            ?>
            
            <?php 
            
                if($message) {
                    
                    $data = array(                
                                    'mail_read'              => 'yes'
                                  );

                    $this->load->model('mailbox/mailbox_model', 'mailbox_model');

                    $this->mailbox_model->_update($message->id, $data);
                    
                    $draft_message_count = $this->mailbox_model->count_where('parent_id', $this->uri->segment(4), 'draft', 'yes');

//                   echo '<pre>';
//                   print_r($test);
//                   exit;
                    //echo '</pre>';
            ?>
            
            
             <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <!--                    <div class="btn-group pull-right" style="padding-left: 10px;">
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>

                    </div>-->
                    <?php 
                        if($draft_message_count > 0){
                        $draft_message = $this->mailbox_model->get_where_multiple('parent_id', $this->uri->segment(4), 'draft', 'yes');   
                    ?>
                        <a href="mailbox/draft/<?php echo $draft_message->id;?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Continue Draft"><i class="fa fa-reply"></i> Continue Draft</a>
                    <?php }else{?>
                        <a href="mailbox/reply/<?php if($this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->parent_id > 0){echo $this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->parent_id;}else{echo $this->uri->segment(4);}?>/<?php echo $this->uri->segment(4)?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-reply"></i> Reply</a>
                    <?php }?>
                    <a href="mailbox/archive_move/<?php echo $this->uri->segment(4);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-archive"></i> Archive</a>                    
                    <a href="mailbox/mark_unread/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as Unread"><i class="fa fa-eye"></i> Mark Unread</a>
                    <a href="mailbox/important_move/<?php echo $this->uri->segment(4);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i> Mark Important</a>
                    <button onclick="window.print()" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Print email"><i class="fa fa-print"></i></button>
                    <a href="mailbox/trash_move/<?php echo $this->uri->segment(4);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </a>
                </div>
                <h2>
                    View Message
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">


                    <h3>
                        <span class="font-noraml">Subject: </span><?php echo $message->subject;?>
                    </h3>
                    <h5>
                        <span class="pull-right font-noraml"><?php echo $message->time;?> <?php echo $message->date;?></span>
                        <span class="font-noraml">From: </span><?php $this->load->model('member/member_model', 'member_model'); $this->load->model('company/company_model', 'company_model'); echo $this->member_model->get_where($message->member_id)->firstname.' '.$this->member_model->get_where($message->member_id)->lastname.' ('.$this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->company_name.')'; ?>
                    </h5>
                </div>
            </div>
                <div class="mail-box">


                <div class="mail-body">
                    <?php echo $message->body?>
                </div>
                    
                <div class="mail-body text-right tooltip-demo">
                    <?php 
                        if($draft_message_count > 0){
                        $draft_message = $this->mailbox_model->get_where_multiple('parent_id', $this->uri->segment(4), 'draft', 'yes');   
                    ?>
                        <a href="mailbox/draft/<?php echo $draft_message->id;?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Continue Draft"><i class="fa fa-reply"></i> Continue Draft</a>
                    <?php }else{?>
                        <a class="btn btn-sm btn-white" href="mailbox/reply/<?php if($this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->parent_id > 0){echo $this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->parent_id;}else{echo $this->uri->segment(4);}?>/<?php echo $this->uri->segment(4);?>"><i class="fa fa-reply"></i> Reply</a>
                    <?php }?>
<!--                        <a class="btn btn-sm btn-white" href="mailbox/forward/<?php echo $this->uri->segment(4);?>"><i class="fa fa-arrow-right"></i> Forward</a>-->
                        <button onclick="window.print()" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Print email"><i class="fa fa-print"></i></button>
                        <a href="mailbox/trash_move/<?php echo $this->uri->segment(4);?>" title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" class="btn btn-sm btn-white"><i class="fa fa-trash-o"></i> Remove</a>
                </div>
                <div class="clearfix"></div>
                    
                </div>
            </div>
            
            <div class="col-lg-9 animated fadeInRight">
                        
                            
                    <?php
                    $message_id = $this->uri->segment(4);
                    if($i_reply_count > 0){

                        foreach($i_inbox_reply as $reply){
                            if($reply->id < $message_id){
                    ?>

                            <div class="mail-box-header" style="border-bottom: 1px solid #e6e6e6">
                                <div class="pull-right tooltip-demo">
                                    <p><?php echo $reply->time;?> &amp; <?php echo $reply->date;?></p>
                                </div>
                                <h2><?php echo $reply->subject;?></h2>
                                <p>
                                    From: 
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
                            
                        
                    </div>
            
            <?php } else { ?>
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <?php
                
                    $this->load->module('search');
                    $this->search->email($this->uri->segment(3));
                
                ?>
                
                <?php echo form_open('mailbox/mass_process'); ?>
                <h2>
                    <?php if(isset($inbox_i_count)){?>
                        <?php echo $header; ?> (<?php echo $inbox_i_ncount;?>)
                    <?php } elseif(isset($inbox_s_count)){?>
                        <?php echo $header; ?> (<?php echo $inbox_s_ncount;?>)
                    <?php } elseif(isset($inbox_mem_count)){?>
                        <?php echo $header; ?> (<?php echo $inbox_mem_ncount;?>)
                    <?php } elseif(isset($inbox_mark_count)){?>
                        <?php echo $header; ?> (<?php echo $inbox_mark_ncount;?>)
                    <?php }?>
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <input type="checkbox" id="select_all"/> Selecct All
                    <a href="mailbox/refresh" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</a>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="read" title="Mark as Read"><i class="fa fa-eye"></i> Mark Read</button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="unread" title="Mark as Unread"><i class="fa fa-eye-slash"> Mark Unread</i></button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="important" title="Mark as Important"><i class="fa fa-exclamation"> Mark Important</i></button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="archive" title="Archive"><i class="fa fa-archive"> Archive</i></button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="trash" title="Move to Trash"><i class="fa fa-trash-o"></i></button>
                    <input type="hidden" name="page_from" value="<?php echo $this->uri->segment(3);?>"/>

                </div>
            </div>
                <?php
                
                    $this->load->module('mailbox');
                    $this->mailbox->ajaxRefresh();
                
                ?>
                
                <?php echo form_close(); ?>
                
            </div>
            <?php } ?>
        </div>
           
        </div>