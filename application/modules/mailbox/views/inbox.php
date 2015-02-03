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

                    //echo '<pre>';
                    //print_r($message);
                    //echo '</pre>';
            ?>
            
            
             <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <div class="pull-right tooltip-demo">
                    <a href="mailbox/reply/<?php if($this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->parent_id > 0){echo $this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->parent_id;}else{echo $this->uri->segment(4);}?>/<?php echo $this->uri->segment(4)?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-reply"></i> Reply</a>
                    <a href="mailbox/archive_move/<?php echo $this->uri->segment(4);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-archive"></i> Archive</a>                    
                    <a href="mailbox/mark_unread/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i></a>
                    <a href="mailbox/important_move/<?php echo $this->uri->segment(4);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i></a>
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
                        <a class="btn btn-sm btn-white" href="mailbox/reply/<?php if($this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->parent_id > 0){echo $this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->parent_id;}else{echo $this->uri->segment(4);}?>/<?php echo $this->uri->segment(4);?>"><i class="fa fa-reply"></i> Reply</a>
                        <a class="btn btn-sm btn-white" href="mailbox/forward/<?php echo $this->uri->segment(4);?>"><i class="fa fa-arrow-right"></i> Forward</a>
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
                    $this->search->email('all');
                
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
                    <a href="mailbox/refresh" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</a>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="read" title="Mark as Read"><i class="fa fa-eye"></i> Mark Read</button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="unread" title="Mark as Unread"><i class="fa fa-eye-slash"> Mark Unread</i></button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="important" title="Mark as Important"><i class="fa fa-exclamation"> Mark Important</i></button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="archive" title="Archive"><i class="fa fa-archive"> Archive</i></button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="trash" title="Move to Trash"><i class="fa fa-trash-o"></i></button>
                    <input type="hidden" name="page_from" value="<?php echo $this->uri->segment(3);?>"/>

                </div>
            </div>
                <div class="mail-box">

                <table class="table table-hover table-mail">
                    <tbody>
                        <?php 
                            //if($inbox_count) {
                                
                                $this->load->model('member/member_model', 'member_model');
                                
                                if(isset($inbox_all)){
                                    
                                    
                                    foreach($inbox_all as $inbox){
                                    
                                    if($inbox->mail_read == 'no'){
                                        
                                        echo '<tr class="unread">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks" name="'.$inbox->id.'">
                                                </td>
                                                <td class="mail-ontact"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$this->member_model->get_where($inbox->member_id)->firstname.' '.$this->member_model->get_where($inbox->member_id)->lastname.'</a>
                                                    <!-- <span class="label label-warning pull-right">Clients</span> </td> -->
                                                </td>
                                                <td class="mail-subject"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$inbox->subject.'</a></td>
                                                    <td class="">&nbsp;<!-- <i class="fa fa-paperclip"> --></i></td>';
                                                    if($inbox->date < date('d-m-Y')){
                                                       echo '<td class="text-right mail-date">'.$inbox->time.' '.date_format(date_create($inbox->date), 'jS F').'</td>'; 
                                                    }
                                                    else{
                                                        echo '<td class="text-right mail-date">'.$inbox->time.'</td>';
                                                    }
                                                
                                            echo '</tr>';
                                        
                                    }
                                    else{
                                        
                                        echo '<tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks" name="'.$inbox->id.'">
                                                </td>
                                                <td class="mail-ontact"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$this->member_model->get_where($inbox->member_id)->firstname.' '.$this->member_model->get_where($inbox->member_id)->lastname.'</a> 
                                                    <!-- <span class="label label-warning pull-right">Clients</span> </td> -->
                                                </td>
                                                <td class="mail-subject"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$inbox->subject.'</a></td>
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
                                }
                                elseif(isset($inbox_member)){
                                    
                                    //echo 'INBOX FROM MEMBER';
                                    foreach($inbox_member as $inbox){
                                    
                                    if($inbox->mail_read == 'no'){
                                        
                                        echo '<tr class="unread">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks" name="'.$inbox->id.'">
                                                </td>
                                                <td class="mail-ontact"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$this->member_model->get_where($inbox->member_id)->firstname.' '.$this->member_model->get_where($inbox->member_id)->lastname.'</a>
                                                    <!-- <span class="label label-warning pull-right">Clients</span> </td> -->
                                                </td>
                                                <td class="mail-subject"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$inbox->subject.'</a></td>
                                                    <td class="">&nbsp;<!-- <i class="fa fa-paperclip"> --></i></td>';
                                                    if($inbox->date < date('d-m-Y')){
                                                       echo '<td class="text-right mail-date">'.$inbox->time.' '.date_format(date_create($inbox->date), 'jS F').'</td>'; 
                                                    }
                                                    else{
                                                        echo '<td class="text-right mail-date">'.$inbox->time.'</td>';
                                                    }
                                                
                                            echo '</tr>';
                                        
                                    }
                                    else{
                                        
                                        echo '<tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks" name="'.$inbox->id.'">
                                                </td>
                                                <td class="mail-ontact"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$this->member_model->get_where($inbox->member_id)->firstname.' '.$this->member_model->get_where($inbox->member_id)->lastname.'</a> 
                                                    <!-- <span class="label label-warning pull-right">Clients</span> </td> -->
                                                </td>
                                                <td class="mail-subject"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$inbox->subject.'</a></td>
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
                                    
                                }
                                elseif(isset($inbox_market)){
                                    
                                    //echo 'INBOX FROM MEMBER';
                                    foreach($inbox_market as $inbox){
                                    
                                    if($inbox->mail_read == 'no'){
                                        
                                        echo '<tr class="unread">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks" name="'.$inbox->id.'">
                                                </td>
                                                <td class="mail-ontact"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$this->member_model->get_where($inbox->member_id)->firstname.' '.$this->member_model->get_where($inbox->member_id)->lastname.'</a>
                                                    <!-- <span class="label label-warning pull-right">Clients</span> </td> -->
                                                </td>
                                                <td class="mail-subject"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$inbox->subject.'</a></td>
                                                    <td class="">&nbsp;<!-- <i class="fa fa-paperclip"> --></i></td>';
                                                    if($inbox->date < date('d-m-Y')){
                                                       echo '<td class="text-right mail-date">'.$inbox->time.' '.date_format(date_create($inbox->date), 'jS F').'</td>'; 
                                                    }
                                                    else{
                                                        echo '<td class="text-right mail-date">'.$inbox->time.'</td>';
                                                    }
                                                
                                            echo '</tr>';
                                        
                                    }
                                    else{
                                        
                                        echo '<tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks" name="'.$inbox->id.'">
                                                </td>
                                                <td class="mail-ontact"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$this->member_model->get_where($inbox->member_id)->firstname.' '.$this->member_model->get_where($inbox->member_id)->lastname.'</a> 
                                                    <!-- <span class="label label-warning pull-right">Clients</span> </td> -->
                                                </td>
                                                <td class="mail-subject"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$inbox->subject.'</a></td>
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
                                    
                                }
                                elseif(isset($inbox_support)){
                                    
                                    //echo 'INBOX FROM MEMBER';
                                    foreach($inbox_support as $inbox){
                                    
                                    if($inbox->mail_read == 'no'){
                                        
                                        echo '<tr class="unread">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks" name="'.$inbox->id.'">
                                                </td>
                                                <td class="mail-ontact"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$this->member_model->get_where($inbox->member_id)->firstname.' '.$this->member_model->get_where($inbox->member_id)->lastname.'</a>
                                                    <!-- <span class="label label-warning pull-right">Clients</span> </td> -->
                                                </td>
                                                <td class="mail-subject"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$inbox->subject.'</a></td>
                                                    <td class="">&nbsp;<!-- <i class="fa fa-paperclip"> --></i></td>';
                                                    if($inbox->date < date('d-m-Y')){
                                                       echo '<td class="text-right mail-date">'.$inbox->time.' '.date_format(date_create($inbox->date), 'jS F').'</td>'; 
                                                    }
                                                    else{
                                                        echo '<td class="text-right mail-date">'.$inbox->time.'</td>';
                                                    }
                                                
                                            echo '</tr>';
                                        
                                    }
                                    else{
                                        
                                        echo '<tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks" name="'.$inbox->id.'">
                                                </td>
                                                <td class="mail-ontact"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$this->member_model->get_where($inbox->member_id)->firstname.' '.$this->member_model->get_where($inbox->member_id)->lastname.'</a> 
                                                    <!-- <span class="label label-warning pull-right">Clients</span> </td> -->
                                                </td>
                                                <td class="mail-subject"><a href="mailbox/inbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$inbox->subject.'</a></td>
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
                                    
                                //}
                                
                                
                            
                        } 
                        else {?>
                        
                            <tr class="read">
                                <td class="check-mail"></td>
                                <td class="mail-ontact">&nbsp;</td>
                                <td class="mail-subject">You have no messages in your inbox.</td>
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