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
                <div class="btn-group pull-right">
                    <a href="#" class="btn btn-white btn-sm" style="margin-left: 3px;" title="Previous"><i class="fa fa-arrow-left"></i></a>
                    <a href="#" class="btn btn-white btn-sm"><i class="fa fa-arrow-right" title="Next"></i></a>
                </div>
                <div class="pull-right tooltip-demo">
                    <!-- <a href="mail_compose.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-reply"></i> Reply</a> -->
                    <a href="mailbox/archive/<?php echo $this->uri->segment(4);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-archive"></i> Archive</a>                    
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
                        <span class="font-noraml">To: </span><?php $this->load->model('member/member_model', 'member_model'); echo $this->member_model->get_where($message->sent_member_id)->firstname.' '.$this->member_model->get_where($message->sent_member_id)->lastname.' ('.$this->member_model->get_where($message->sent_member_id)->company_name.')'; ?>
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
                        <button onclick="window.print()" title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Print" class="btn btn-sm btn-white"><i class="fa fa-print"></i> Print</button>
                        <a href="mailbox/trash_move/<?php echo $this->uri->segment(3);?>" title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" class="btn btn-sm btn-white"><i class="fa fa-trash-o"></i> Remove</a>
                </div>
                <div class="clearfix"></div>

                </div>
            </div>
        
        <?php } else { ?>
    
    <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <?php
                
                    $this->load->module('search');
                    $this->search->email('important');
                
                ?>
                
                <?php echo form_open('mailbox/mass_process'); ?>
                <h2>
                    Important (<?php echo $inbox_important_count;?>)
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">                    
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
                            if($inbox_important_count > 0) {
                                
                                $this->load->model('member/member_model', 'member_model');
                                
                                foreach($inbox_important_message as $inbox){
                                    
                                    
                                        
                                        echo '<tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks" name="'.$inbox->id.'">
                                                </td>
                                                <td class="mail-ontact"><a href="mailbox/important/'.$inbox->id.'">'.$this->member_model->get_where($inbox->member_id)->firstname.' '.$this->member_model->get_where($inbox->member_id)->lastname.'</a> 
                                                    <!-- <span class="label label-warning pull-right">Clients</span> </td> -->
                                                </td>
                                                <td class="mail-subject"><a href="mailbox/important/'.$inbox->id.'">'.$inbox->subject.'</a></td>
                                                <td class="">&nbsp;<!-- <i class="fa fa-paperclip"> --></i></td>';
                                                    if($inbox->date < date('d-m-Y')){
                                                       echo '<td class="text-right mail-date">'.$inbox->time.' '.date_format(date_create($inbox->date), 'jS F').'</td>'; 
                                                    }
                                                    else{
                                                        echo '<td class="text-right mail-date">'.$inbox->time.'</td>';
                                                    }
                                                
                                            echo '</tr>';
                                    
                                }
                            
                        } 
                        else {?>
                        
                            <tr class="read">
                                <td class="check-mail"></td>
                                <td class="mail-ontact">&nbsp;</td>
                                <td class="mail-subject">You have no messages in your important mail.</td>
                                <td class=""></td>
                                <td class="text-right mail-date">&nbsp;</td>
                            </tr>
                            
                        <?php }?>

                    </tbody>
                </table>
                    
                </div>
            <?php echo form_close(); ?>
            </div>
        <?php } ?>
</div>
</div>