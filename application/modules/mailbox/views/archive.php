<?php

    $this->load->module('mailbox');
    $this->mailbox->mailboxJquery();
    $this->mailbox->mailboxCss();

?>
<div class="wrapper wrapper-content">
        <div class="row">
            <?php
            
                
                $this->mailbox->side_mail();
            
            ?>
            
            <?php 
            
                if($message) {
                    
                    $data = array(                
                                    'mail_read'              => 'yes'
                                  );

                    $this->load->model('mailbox/mailbox_model', 'mailbox_model');

                    $this->mailbox_model->_update($message->id, $data);
                   
                    //echo '<pre>';
                    //print_r($message);
                    //echo '</pre>';
            ?>
             
            
             <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <?php
                        if($email_info)
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
                        <?php if($start_email != $mess_id){ ?>
                        <button onclick="window.location.href='mailbox/archive/<?php echo $previous;?>'" class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i> Previous</button>
                        <?php }?>
                        <?php if($end_email != $mess_id){ ?>
                        <button onclick="window.location.href='mailbox/archive/<?php echo $next;?>'" class="btn btn-white btn-sm">Next <i class="fa fa-arrow-right"></i></button>
                        <?php }?>                        
                    </div>
                    <?php }elseif(count($email_info) == 2){
                        $mess_id = $this->uri->segment(3);
                        $start_email = reset($email_info);
                        $end_email = end($email_info); 
                    ?>
                    <div class="btn-group pull-right" style="padding-left: 10px;">
                        <?php if($mess_id != $start_email){?>
                        <button onclick="window.location.href='mailbox/archive/<?php echo $start_email;?>'" class="btn btn-white btn-sm">Next <i class="fa fa-arrow-right"></i></button>
                        <?php }?>
                        <?php if($mess_id != $end_email){?>
                        <button onclick="window.location.href='mailbox/archive/<?php echo $end_email;?>'" class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i> Previous</button>
                        <?php }?>
                    </div>
                    <?php }?>
                    <!-- <a href="mailbox/reply/<?php echo $this->uri->segment(3);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-reply"></i> Reply</a>
                    <a href="mailbox/mark_unread/archive/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i></a> -->
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
                        <span class="font-noraml">From: </span><?php $this->load->model('member/member_model', 'member_model'); $this->load->model('company/company_model', 'company_model'); echo $this->member_model->get_where($message->member_id)->firstname.' '.$this->member_model->get_where($message->member_id)->lastname.' ('.$this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->company_name.')'; ?>
                    </h5>
                </div>
            </div>
                <div class="mail-box">


                <div class="mail-body">
                    <?php echo $message->body?>
                </div>
                    
                <div class="mail-body text-right tooltip-demo">
                        <a class="btn btn-sm btn-white" href="mailbox/reply/<?php echo $this->uri->segment(4);?>"><i class="fa fa-reply"></i> Reply</a>
<!--                        <a class="btn btn-sm btn-white" href="mailbox/forward/<?php echo $this->uri->segment(4);?>"><i class="fa fa-arrow-right"></i> Forward</a>-->
                        <button onclick="window.print()" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Print email"><i class="fa fa-print"></i></button>
                        <a href="mailbox/trash_move/<?php echo $this->uri->segment(4);?>" title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" class="btn btn-sm btn-white"><i class="fa fa-trash-o"></i> Remove</a>
                </div>
                <div class="clearfix"></div>


                </div>
            </div>
            
            <?php } else { ?>
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <?php
                
                    $this->load->module('search');
                    $this->search->email('archive');
                
                ?>
                
                <?php echo form_open('mailbox/mass_process'); ?>
                <h2>
                    Archive (<?php echo $inbox_archive_count;?>)
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <input type="checkbox" id="select_all"/> Select All
                    <!-- <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i> </button> -->
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="trash" title="Move to Trash"><i class="fa fa-trash-o"></i></button>

                </div>
            </div>
                <div class="mail-box">
                    

                    <table class="table table-hover table-mail">
                        <tbody>
                            <?php 
                            if($inbox_archive_count > 0) {
                                
                                
                                
                                $this->load->model('member/member_model', 'member_model');
                                
                                foreach($inbox_archive_message as $inbox){
                                    
                                    if($inbox->mail_read == 'no'){
                                        
                                        echo '  <tr class="unread">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks" name="'.$inbox->id.'">
                                                </td>
                                                <td class="mail-ontact"><a href="mailbox/archive/'.$inbox->id.'">'.$this->member_model->get_where($inbox->member_id)->firstname.' '.$this->member_model->get_where($inbox->member_id)->lastname.'</a></td>
                                                <td class="mail-subject"><a href="mailbox/archive/'.$inbox->id.'">'.$inbox->subject.'</a></td>
                                                <td class="">&nbsp;<!-- <i class="fa fa-paperclip"> --></i></td>';
                                                    if($inbox->date != date('d-m-Y')){
                                                       echo '<td class="text-right mail-date">'.$inbox->time.' '.date_format(date_create($inbox->date), 'jS F').'</td>'; 
                                                    }
                                                    else{
                                                        echo '<td class="text-right mail-date">'.$inbox->time.'</td>';
                                                    }
                                                
                                            echo '</tr>';
                                        
                                    }
                                    else{

                                        echo '  <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks" name="'.$inbox->id.'">
                                                </td>
                                                <td class="mail-ontact">
                                                    <a href="mailbox/archive/'.$inbox->id.'">'.$this->member_model->get_where($inbox->member_id)->firstname.' '.$this->member_model->get_where($inbox->member_id)->lastname.'</a>
                                                    <span class="label label-warning pull-right"><!-- Clients--></span>
                                                </td>
                                                <td class="mail-subject">
                                                    <a href="mailbox/archive/'.$inbox->id.'">'.$inbox->subject.'</a>
                                                </td>                                                
                                                <td class="">&nbsp;<!-- <i class="fa fa-paperclip"> --></i></td>';
                                                    if($inbox->date != date('d-m-Y')){
                                                       echo '<td class="text-right mail-date">'.$inbox->time.' '.date_format(date_create($inbox->date), 'jS F').'</td>'; 
                                                    }
                                                    else{
                                                        echo '<td class="text-right mail-date">'.$inbox->time.'</td>';
                                                    }
                                                
                                            echo '</tr>';
                                        
                                    }
                                }
                            }
                            else{
                                
                                echo '  <tr class="read">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>                                        
                                        <td>&nbsp;</td>
                                        <td class="mail-subject">You have no mail in your archive</td>
                                        <td>&nbsp;</td>
                                        </tr>';

                            }
                            ?>
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
                    <input type="hidden" name="page_from" value="<?php echo $this->uri->segment(2);?>"/>
                    
                </div>
                <?php echo form_close(); ?>
            </div>
        <?php } ?>
        </div>
        </div>