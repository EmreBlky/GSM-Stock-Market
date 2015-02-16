<?php

//echo '<pre>';
//print_r($inbox_draft_message);
//exit;

?>
<script type="text/javascript">
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

                //echo '<pre>';
                //print_r($message);
                //echo '</pre>';
        ?>
        
        <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                    <?php
                        if(count($email_info) > 2){
                        $start_email = reset($email_info);
                        $end_email = end($email_info);
                        
                        function next_email($current, $a) {

                        global $end_email;
                            while (true) {

                                if($current == $end_email){
                                                return $a[0];
                                        }elseif ($current == $a[1]) {

                                    return $a[2];

                                }

                                array_push($a, array_shift($a));
                            }
                        }

                        function prev_email($current, $a) {

                        global $start_email;

                            while (true) {

                                if($current == $start_email){
                                                return $a[0];
                                        }elseif ($current == $a[1]) {
                                    return $a[0];

                                }
                                array_push($a, array_shift($a));
                            }
                        }
                        $mess_id = $this->uri->segment(3);
                        $next = next_email($mess_id, $email_info);
                        $previous = prev_email($mess_id, $email_info);
                        
                        
                    
                    ?>
                    <div class="btn-group pull-right" style="padding-left: 10px;">
                        <?php if($end_email != $mess_id){ ?>
                        <button onclick="window.location.href='mailbox/draft/<?php echo $next;?>'" class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i> Previous</button>
                        <?php }?>
                        <?php if($start_email != $mess_id){ ?>
                        <button onclick="window.location.href='mailbox/draft/<?php echo $previous;?>'" class="btn btn-white btn-sm">Next <i class="fa fa-arrow-right"></i></button>
                        <?php }?>
                    </div>
                    <?php }elseif(count($email_info) == 2){
                        $mess_id = $this->uri->segment(3);
                        $start_email = reset($email_info);
                        $end_email = end($email_info); 
                    ?>
                    <div class="btn-group pull-right" style="padding-left: 10px;">
                        <?php if($mess_id != $start_email){?>
                        <button onclick="window.location.href='mailbox/draft/<?php echo $start_email;?>'" class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i> Previous</button>
                        <?php }?>
                        <?php if($mess_id != $end_email){?>
                        <button onclick="window.location.href='mailbox/draft/<?php echo $end_email;?>'" class="btn btn-white btn-sm">Next <i class="fa fa-arrow-right"></i></button>
                        <?php }?>
                    </div>
                    <?php }?>
                <div class="pull-right tooltip-demo">
                    <!-- <a href="mail_compose.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-reply"></i> Reply</a> -->
                    <a href="mailbox/compose/<?php echo $this->uri->segment(3);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-edit"></i> Continue Edit</a>
                    <a href="mailbox/archive/<?php echo $this->uri->segment(4);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-archive"></i> Archive</a>                    
                    <a href="mailbox/important_move/<?php echo $this->uri->segment(3);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i> Mark Important</a>
                    <button onclick="window.print()" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Print email"><i class="fa fa-print"></i></button>
                    <a href="mailbox/trash_move/<?php echo $this->uri->segment(3);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </a>
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
                        <span class="font-noraml">To: </span><?php $this->load->model('member/member_model', 'member_model'); $this->load->model('company/company_model', 'company_model'); echo $this->member_model->get_where($message->sent_member_id)->firstname.' '.$this->member_model->get_where($message->sent_member_id)->lastname.' ('.$this->company_model->get_where($this->member_model->get_where($message->sent_member_id)->company_id)->company_name.')'; ?>
                    </h5>
                </div>
            </div>
                <div class="mail-box">

                <div class="mail-body">
                    <?php echo $message->body?>
                </div>
                
                <div class="mail-body text-right tooltip-demo">
                        <!-- <a class="btn btn-sm btn-white" href="mail_compose.html"><i class="fa fa-reply"></i> Reply</a>
                        <a class="btn btn-sm btn-white" href="mail_compose.html"><i class="fa fa-arrow-right"></i> Forward</a> -->
                        <button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Print" class="btn btn-sm btn-white"><i class="fa fa-print"></i> Print</button>
                        <a href="mailbox/trash_move/<?php echo $this->uri->segment(3);?>" title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" class="btn btn-sm btn-white"><i class="fa fa-trash-o"></i> Remove</a>
                </div>
                <div class="clearfix"></div>

                </div>
            </div>
            
            <?php 
                if($inbox_draft_count_reply > 0){
            ?>
                <div class="col-lg-9 animated fadeInRight"> 
            <?php
                    
                    foreach($inbox_draft_message_reply as $idmr){
                        $last = $this->uri->segment(3);
                        if($idmr->id != $last){
            ?>
                    <div class="mail-box-header" style="border-bottom: 1px solid #e6e6e6">
                        <div class="pull-right tooltip-demo">
                            <p><?php echo $idmr->time;?> &amp; <?php echo $idmr->date;?></p>
                        </div>
                        <h2><?php echo $idmr->subject;?></h2>
                        <p><?php echo $this->member_model->get_where($idmr->member_id)->firstname.' '.$this->member_model->get_where($idmr->member_id)->lastname?></p>
                    </div>
                    <div class="mail-box" style="padding:10px;">
                        <?php echo $idmr->body;?>
                    </div>
            <?php
                        }  
                        //echo $idmr->id.'<br/>';
                
                    }
                    $parent_mail = $this->mailbox_model->get_where($idmr->parent_id);
            ?>
                    <div class="mail-box-header" style="border-bottom: 1px solid #e6e6e6">
                            <div class="pull-right tooltip-demo">
                                <p><?php echo $parent_mail->time;?> &amp; <?php echo $parent_mail->date;?></p>
                            </div>
                            <h2><?php echo $parent_mail->subject;?></h2>
                            <p><?php echo $this->member_model->get_where($parent_mail->member_id)->firstname.' '.$this->member_model->get_where($parent_mail->member_id)->lastname?></p>
                        </div>
                        <div class="mail-box" style="padding:10px;">
                            <?php echo $parent_mail->body;?>
                        </div>
            <?php
            ?>
                    <div>
            <?php            
                    //echo $idmr->parent_id.'<br/>';
                }
            ?>
        
        <?php } else { ?>
    
    <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <?php
                
                    $this->load->module('search');
                    $this->search->email('draft');
                
                ?>
                
                <?php echo form_open('mailbox/mass_process'); ?>
                <h2>
                    Draft (<?php echo $inbox_draft_count;?>)
                </h2>
                <div class="mail-tools tooltip-demo m-t-md"> 
                    <input type="checkbox" id="select_all"/> Selecct All
                    <!-- <a href="mailbox/refresh" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</a>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i> </button> -->
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="trash" title="Move to Trash"><i class="fa fa-trash-o"></i></button>

                </div>
            </div>
                <div class="mail-box">

                <table class="table table-hover table-mail">
                    <tbody>
                        <?php 
                            if($inbox_draft_count > 0) {
                                
                                $this->load->model('member/member_model', 'member_model');
                                                                
                                foreach($inbox_draft_message as $inbox){                                    
                                    
                                        
                                        echo '<tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks" name="'.$inbox->id.'">
                                                </td>
                                                <td class="mail-ontact"><a href="mailbox/draft/'.$inbox->id.'">'.$this->member_model->get_where($inbox->sent_member_id)->firstname.' '.$this->member_model->get_where($inbox->sent_member_id )->lastname.'</a> 
                                                    <!-- <span class="label label-warning pull-right">Clients</span> </td> -->
                                                </td>
                                                <td class="mail-subject"><a href="mailbox/draft/'.$inbox->id.'">'.$inbox->subject.'</a></td>
                                                <td class="">&nbsp;<!-- <i class="fa fa-paperclip"> --></i></td>';
                                                    if($inbox->date < date('d-m-Y')){
                                                       echo '<td class="text-right mail-date">'.$inbox->time.' '.date_format(date_create($inbox->date), 'jS F').'</td>'; 
                                                    }
                                                    else{
                                                        echo '<td class="text-right mail-date">'.$inbox->time.'</td>
                                                                <input type="hidden" name="parent_id" value="'.$inbox->parent_id.'"/>';
                                                    }
                                                
                                            echo '</tr>';
                                   
                                }
                            
                        } 
                        else {?>
                        
                            <tr class="read">
                                <td class="check-mail"></td>
                                <td class="mail-ontact">&nbsp;</td>
                                <td class="mail-subject">You have no messages in your draft mail.</td>
                                <td class=""></td>
                                <td class="text-right mail-date">&nbsp;</td>
                            </tr>
                            
                        <?php }?>
                        <?php if(isset($pagination)){?>
                            <tr>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class="text-right mail-date">
                                    <?php echo $pagination; ?>
                                </td>
                                
                            </tr>
                        <?php } ?>    

                    </tbody>
                </table>
                    <input type="hidden" name="parent_id" value=""/> 
                    <input type="hidden" name="page_from" value="<?php echo $this->uri->segment(2);?>"/>
                </div>
        <?php echo form_close(); ?>
            </div>
        <?php } ?>
</div>
    </div>