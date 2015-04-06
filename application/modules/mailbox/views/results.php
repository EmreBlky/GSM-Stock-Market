<?php

//echo '<pre>';
//print_r($results);
//echo '</pre>';
//exit;

?>
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
            
            <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <?php
                
                    $this->load->module('search');
                    $this->search->email($results['category']);
                
                ?>
                
                <?php echo form_open('mailbox/mass_process'); ?>
                <h2>
                    <?php 
                    
                        if($results['category'] != 'all'){
                            echo ucfirst($results['category']).' Mail Search Results for "<strong>'.$results['query'].'</strong>"';
                        }
                        else{
                            echo 'Inbox Mail Search Results "<strong>'.$results['query'].'</strong>"';
                        }
                    
                     ?> 
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <input type="checkbox" id="select_all"/> Select All
<!--                <a href="mailbox/refresh" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</a>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="read" title="Mark as Read"><i class="fa fa-eye"></i> Mark Read</button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="bottom" name="button" value="unread" title="Mark as Unread"><i class="fa fa-eye-slash"> Mark Unread</i></button>-->
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
                                
                                if($results['search_emails'] != 'NO RESULTS WERE FOUND!'){
                                    
                                    //if($results['category'] == 'all' || $results['category'] == 'member' || $results['category'] == 'market' || $results['category'] == 'support'){                                    
                                    if($results['category'] != 'sent' && $results['category'] != 'draft'){
                                    
                                        foreach($results['search_emails'] as $inbox){

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
                                    else{
                                        foreach($results['search_emails'] as $inbox){
                                            
                                            echo '<tr class="read">
                                                    <td class="check-mail">
                                                        <input type="checkbox" class="i-checks" name="'.$inbox->id.'">
                                                    </td>
                                                    <td class="mail-ontact"><a href="mailbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$this->member_model->get_where($inbox->sent_member_id)->firstname.' '.$this->member_model->get_where($inbox->sent_member_id)->lastname.'</a> 
                                                        <!-- <span class="label label-warning pull-right">Clients</span> </td> -->
                                                    </td>
                                                    <td class="mail-subject"><a href="mailbox/'.$this->uri->segment(3).'/'.$inbox->id.'">'.$inbox->subject.'</a></td>
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
                                else {?>

                                    <tr class="read">
                                        <td class="check-mail"></td>
                                        <td class="mail-ontact">&nbsp;</td>
                                        <td class="mail-subject"><?php echo $results['search_emails'];?></td>
                                        <td class=""></td>
                                        <td class="text-right mail-date">&nbsp;</td>
                                    </tr>

                                <?php }?>

                    </tbody>
                </table>
                    <input type="hidden" name="page_from" value="<?php echo $this->uri->segment(3);?>"/>
                </div>
                <?php echo form_close(); ?>
            </div>
            
        </div>
        </div>

