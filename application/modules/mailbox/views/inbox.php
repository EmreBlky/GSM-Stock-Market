<?php

//echo '<pre>';
//print_r($email_info);
//exit;

?>

<?php

    $this->load->module('mailbox');
    $this->mailbox->mailboxJquery();
    $this->mailbox->mailboxCss();

?>
<script type="text/javascript">
    
            function contactAdd()
            {
                 //alert('ADD');
                 
                var cust_added          = $('#cust_added').val();                
                var cust_individual     = $('#cust_individual').val();
                var cust_company        = $('#cust_company').val();
                var cust_business1      = $('#cust_business1').val();
                var cust_business2      = $('#cust_business2').val();
                var cust_business3      = $('#cust_business3').val();
                var cust_country        = $('#cust_country').val();
                
                 $.ajax({
                        type: "POST",
                        url: "addressbook/add/"+ cust_added +"/"+ cust_individual +"/"+ cust_company +"/"+ cust_business1 +"/"+ cust_business2 +"/"+ cust_business3 +"/"+ cust_country +"",
                        dataType: "html",
                        success:function(data){
                          $('#contact_added').replaceWith('<button onclick="contactRemove();" id="contact_removed" class="btn btn-danger">Remove Contact</button>');                             
                          toastr.success('This user has been added to your address book.', 'Contact Added');
                        },
                });
            }           
           
            function contactRemove()
            {                
                var cust_added     = $('#cust_added').val();
                
                $.ajax({
                        type: "POST",
                        url: "addressbook/remove/"+ cust_added +"",
                        dataType: "html",
                        success:function(data){
                          $('#contact_removed').replaceWith('<button onclick="contactAdd();" id="contact_added" class="btn btn-success">Add Contact</button>');  
                          toastr.error('This user has been removed from your address book.', 'Contact Removed');
                        },
                });
            }
            
            function faveAdd()
            {
                var cust_added     = $('#cust_added').val();
                
                 $.ajax({
                        type: "POST",
                        url: "favourite/add/"+ cust_added +"",
                        dataType: "html",
                        success:function(data){
                          $('#favourite_added').replaceWith('<button onclick="faveRemove();" id="favourite_removed" type="button" class="btn btn-danger">Remove Favourite</button>');                             
                          toastr.success('This user has been added to your favourites.', 'Favourite Added');
                        },
                });
            }
            
            function faveRemove()
            {
                var cust_added     = $('#cust_added').val();
                
                 $.ajax({
                        type: "POST",
                        url: "favourite/remove/"+ cust_added +"",
                        dataType: "html",
                        success:function(data){
                          $('#favourite_removed').replaceWith('<button onclick="faveAdd();" id="favourite_added" type="button" class="btn btn-primary">Add Favourite</button>');                             
                          toastr.error('This user has been removed from your favourites.', 'Favourite Removed');
                        },
                });
            }
            
            function block()
            {
                var cust_id         = "<?php echo $this->session->userdata('members_id');?>";
                var cust_blocked    = $('#cust_added').val();
                
                 $.ajax({
                        type: "POST",
                        url: "block/customerBlock/"+ cust_id +"/"+ cust_blocked +"",
                        dataType: "html",
                        success:function(data){
                          $('#blocked').replaceWith('<button onclick="unblock();" type="button" class="btn btn-warning btn-sm btn-block" id="unblocked"><i class="fa fa-thumbs-up"></i> Unblock</button>');                             
                         toastr.error('They are unable to communicate or see you in anywhere on this website.', 'User Blocked!');                    
                        },
                });
            }
            
            function unblock()
            {
                var cust_id         = "<?php echo $this->session->userdata('members_id');?>";
                var cust_blocked    = $('#cust_added').val();
                
                 $.ajax({
                        type: "POST",
                        url: "block/customerUnblock/"+ cust_id +"/"+ cust_blocked +"",
                        dataType: "html",
                        success:function(data){
                          $('#unblocked').replaceWith('<button onclick="block();" type="button" class="btn btn-danger btn-sm btn-block" id="blocked"><i class="fa fa-ban"></i> Block</button>');                             
                          toastr.success('You will now be visible to this user and you can communicate with them.', 'User Unblocked');
                        },
                });
            }
            
</script>
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
                    
                    $draft_message_count = $this->mailbox_model->count_where('parent_id', $this->uri->segment(4), 'draft', 'yes');
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
                        $mess_id = $this->uri->segment(4);
                        $next = next_email($mess_id, $email_info);
                        $previous = prev_email($mess_id, $email_info);
                        
                        
                    
                    ?>
                    <div class="btn-group pull-right" style="padding-left: 10px;">
                        <?php if($start_email != $mess_id){ ?>
                        <button onclick="window.location.href='<?php echo $base;?>mailbox/inbox/<?php echo $this->uri->segment(3);?>/<?php echo $previous;?>'" class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i> Previous </button>
                        <?php }?>
                        <?php if($end_email != $mess_id){ ?>
                        <button onclick="window.location.href='<?php echo $base;?>mailbox/inbox/<?php echo $this->uri->segment(3);?>/<?php echo $next;?>'" class="btn btn-white btn-sm">Next <i class="fa fa-arrow-right"></i></button>
                        <?php }?>
                    </div>
                    <?php }elseif(count($email_info) == 2){
                       $mess_id = $this->uri->segment(4); 
                       $start_email = reset($email_info);
                       $end_email = end($email_info); 
                    ?>
                    <div class="btn-group pull-right" style="padding-left: 10px;">
                        <?php if($mess_id != $start_email){?>
                        <button onclick="window.location.href='<?php echo $base;?>mailbox/inbox/<?php echo $this->uri->segment(3);?>/<?php echo $start_email;?>'" class="btn btn-white btn-sm"> Next <i class="fa fa-arrow-right"></i></button>
                        <?php }?>
                        <?php if($mess_id != $end_email){?>
                        <button onclick="window.location.href='<?php echo $base;?>mailbox/inbox/<?php echo $this->uri->segment(3);?>/<?php echo $end_email;?>'" class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i> Previous </button>
                        <?php }?>
                    </div>
                    <?php }?>
                    <?php 
                        if($draft_message_count > 0){
                        $draft_message = $this->mailbox_model->get_where_multiple('parent_id', $this->uri->segment(4), 'draft', 'yes');   
                    ?>
                        <a href="mailbox/draft/<?php echo $draft_message->id;?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Continue Draft"><i class="fa fa-reply"></i> Continue Draft</a>
                    <?php }else{?>
                        <?php if($message->sent_from != 'support'){?>    
                            <a href="mailbox/reply/<?php if($this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->parent_id > 0){echo $this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->parent_id;}else{echo $this->uri->segment(4);}?>/<?php echo $this->uri->segment(4)?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-reply"></i> Reply</a>
                        <?php }?>    
                    <?php }?>
                    <a href="mailbox/archive_move/<?php echo $this->uri->segment(4);?>" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Archive"><i class="fa fa-archive"></i> Archive</a>                    
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
                        <span class="font-noraml">From: </span>
                        <?php if($message->member_id != 5) { ?>
                            <a data-toggle="modal" data-target="#profile_user"><?php $this->load->model('member/member_model', 'member_model'); $this->load->model('company/company_model', 'company_model'); echo $this->member_model->get_where($message->member_id)->firstname.' '.$this->member_model->get_where($message->member_id)->lastname.' ('.$this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->company_name.')'; ?></a>                    
                        <?php } else {?> 
                            <?php $this->load->model('member/member_model', 'member_model'); $this->load->model('company/company_model', 'company_model'); echo $this->member_model->get_where($message->member_id)->firstname.' '.$this->member_model->get_where($message->member_id)->lastname.' ('.$this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->company_name.')'; ?>                    
                        <?php }?>    
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
                        <?php if($message->sent_from != 'support'){?> 
                            <a class="btn btn-sm btn-white" href="mailbox/reply/<?php if($this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->parent_id > 0){echo $this->mailbox_model->get_where_multiple('id', $this->uri->segment(4))->parent_id;}else{echo $this->uri->segment(4);}?>/<?php echo $this->uri->segment(4);?>"><i class="fa fa-reply"></i> Reply</a>
                        <?php }?>
                    <?php }?>
<!--                        <a class="btn btn-sm btn-white" href="mailbox/forward/<?php echo $this->uri->segment(4);?>"><i class="fa fa-arrow-right"></i> Forward</a>-->
                        <button onclick="window.print()" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Print email"><i class="fa fa-print"></i></button>
                        <a href="mailbox/trash_move/<?php echo $this->uri->segment(4);?>" title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" class="btn btn-sm btn-white"><i class="fa fa-trash-o"></i> Remove</a>
                </div>
                <div class="clearfix"></div>
                        <div class="modal inmodal fade" id="profile_user" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">View Profile</h4>
                        <small class="font-bold"><?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->company_name;?></small>
                        </div>
                        <div class="modal-body">
                        <div class="row" style="background:#FFF;">
                        <div class="col-md-8 col-md-offset-1">
                        <h1><?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->company_name;?></h1>
                        </div>
                        <div class="col-md-6">
                        <table width="100%" border="0" cellpadding="5" cellspacing="5">
                        <tr>
                        <th width="55%" class="text-right">
                            Status : 
                            <?php 
                            
                                if($this->member_model->get_where($message->member_id)->online_status == 'online'){
                            ?> 
                                <span class="label label-primary">Online</span>
                            <?php 
                                } else {
                            ?>
                                <span class="label label-danger">Offline</span>
                            <?php } ?>
                        </th>
                        <td class="pull-left">
                        </td>
                        </tr>
                        <tr>
                        <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                        <th class="text-right">Subscription: </th>
                        <td>&nbsp;<?php echo $this->membership_model->get_where($this->member_model->get_where($message->member_id)->membership)->membership." Member"; ?></td>
                        </tr>
                        <tr>
                        <th class="text-right">Company Number:</th>
                        <td>&nbsp;<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->company_number;?></td>
                        </tr>
                        <tr>
                        <th class="text-right"> VAT/Tax Number:</th>
                        <td>&nbsp;<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->vat_tax ?></td>
                        </tr>
                        <tr>
                        <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                        <th align="top" class="text-right">Address:</th>
                        <td>
                        &nbsp;<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->address_line_1 ?><br>
                        &nbsp;<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->address_line_2 ?><br>
                        &nbsp;<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->town_city ?><br>
                        &nbsp;<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->county ?><br>
                        &nbsp;<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->post_code ?><br>
                        &nbsp;<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->country ?>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                        <th class="text-right">Primary Business:</th>
                        <td>&nbsp;<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->business_sector_1 ?></td>
                        </tr>
                        <tr>
                        <th class="text-right">Secondary Business:</th>
                        <td>&nbsp;<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->business_sector_2 ?></td>
                        </tr>
                        <tr>
                        <th class="text-right">Tertiary Business:</th>
                        <td>&nbsp;<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->business_sector_3 ?></td>
                        </tr>
                        <tr>
                        <th class="text-right" valign="top">Other Activities :</th>
                        <td>&nbsp;<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->other_business ?></td>
                        </tr>
                        </table>
                        </div>
                        <div class="col-md-6">
                        <table  width="100%" border="0" cellpadding="5" cellspacing="5">
                        <tr>
                        <th class="text-right"></th>
                        <th align="center">

                        <?php if (file_exists("public/main/template/gsm/images/members/".$this->member_model->get_where($message->member_id)->id.".png")) { ?>
                        <img src="public/main/template/gsm/images/members/<?php echo $this->member_model->get_where($message->member_id)->id; ?>.png" width="200">
                        <?php } else { ?>
                        <img src="public/main/template/gsm/images/members/no_profile.jpg"  <?php echo $this->member_model->get_where($message->member_id)->id; ?> width="200"/>
                        <?php } ?>
                        </th>
                        </tr>
                        <tr>
                        <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                        <th width="35%" class="text-right">Title:</th>
                        <td width="50%">&nbsp;<?php echo $this->member_model->get_where($message->member_id)->title ?></td>
                        </tr>
                        <tr>
                        <th class="text-right">Firstname: </th>
                        <td>&nbsp;<?php echo $this->member_model->get_where($message->member_id)->firstname ?></td>
                        </tr>
                        <tr>
                        <th class="text-right">Surname:  </th>
                        <td>&nbsp;<?php echo $this->member_model->get_where($message->member_id)->lastname ?></td>
                        </tr>
                        <tr>
                        <th class="text-right">Role: </th>
                        <td>&nbsp;<?php echo $this->member_model->get_where($message->member_id)->role ?></td>
                        </tr>
                        <tr>
                        <th class="text-right">Phone Number: </th>
                        <td>&nbsp;<?php echo $this->member_model->get_where($message->member_id)->phone_number ?></td>
                        </tr>
                        <tr>
                        <th class="text-right">Mobile Number: </th>
                        <td>&nbsp;<?php echo $this->member_model->get_where($message->member_id)->mobile_number ?></td>
                        </tr>
                        <tr>
                        <th class="text-right">Facebook: </th>
                        <td>&nbsp;<?php echo $this->member_model->get_where($message->member_id)->facebook ?></td>
                        </tr>
                        <tr>
                        <th class="text-right">Twitter: </th>
                        <td>&nbsp;<?php echo $this->member_model->get_where($message->member_id)->twitter ?></td>
                        </tr>
                        <tr>
                        <th class="text-right">Google Plus: </th>
                        <td>&nbsp;<?php echo $this->member_model->get_where($message->member_id)->gplus ?></td>
                        </tr>
                        <tr>
                        <th class="text-right">LinkedIn: </th>
                        <td>&nbsp;<?php echo $this->member_model->get_where($message->member_id)->linkedin ?></td>
                        </tr>
                        <tr>
                        <th class="text-right">Skype: </th>
                        <td>&nbsp;<?php echo $this->member_model->get_where($message->member_id)->skype ?></td>
                        </tr>
                        </table>
                        </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="cust_added" name="cust_added" value="<?php echo $message->member_id;?>"/>
                            <input type="hidden" id="cust_individual" name="cust_individual" value="<?php echo $this->member_model->get_where($message->member_id)->firstname.' '.$this->member_model->get_where($message->member_id)->lastname;?>"/>
                            <input type="hidden" id="cust_company" name="cust_company" value="<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->company_name;?>"/>
                            <input type="hidden" id="cust_business1" name="cust_business1" value="<?php if($this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->business_sector_1 != ''){echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->business_sector_1;} else{ if($this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->other_business != ''){echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->other_business;}else{ echo 'NULL';}}?>"/>
                            <input type="hidden" id="cust_business2" name="cust_business2" value="<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->business_sector_2; ?>"/>
                            <input type="hidden" id="cust_business3" name="cust_business3" value="<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->business_sector_3; ?>"/>
                            <input type="hidden" id="cust_country" name="cust_country" value="<?php echo $this->company_model->get_where($this->member_model->get_where($message->member_id)->company_id)->country?>"/>
                            <?php
                            $fcount = $this->favourite_model->_custom_query_count("SELECT COUNT(*) AS count FROM favourite WHERE member_id = '".$this->session->userdata('members_id')."' AND favourite_id = '".$message->member_id."'");
                            if($fcount[0]->count > 0){
                            ?>   
                                <button onclick="faveRemove();" id="favourite_removed" type="button" class="btn btn-danger">Remove Favourite</button>                                
                            <?php } else { ?>
                                <button onclick="faveAdd();" id="favourite_added" type="button" class="btn btn-primary">Add Favourite</button>
                            <?php                            
                            }
                            ?>
                            <?php
                            $ccount = $this->addressbook_model->_custom_query_count("SELECT COUNT(*) AS count FROM addressbook WHERE member_id = '".$this->session->userdata('members_id')."' AND address_member_id = '".$message->member_id."'");
                            if($ccount[0]->count > 0){
                            ?>
                                <button onclick="contactRemove();" id="contact_removed" class="btn btn-danger">Remove Contact</button>                                
                            <?php } else { ?>
                                <button onclick="contactAdd();" id="contact_added" class="btn btn-success">Add Contact</button>
                            <?php
                            }
                            ?>
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                        </div>
                        </div>
                </div>
                <?php
                    $message_id = $this->uri->segment(4);
                    if($i_reply_count > 0){

                        foreach($i_inbox_reply as $reply){
                            if($reply->id < $message_id){
                    ?>

                            <div class="mail-box-header" style="border-bottom: 1px solid #e6e6e6;">
                                <div class="pull-right tooltip-demo">
                                    <p><?php echo $reply->time;?> at <?php echo $reply->date;?></p>
                                </div>
                                <h2><?php echo $reply->subject;?></h2>
                                <p>
                                    From: 
                                    <a data-toggle="modal" data-target="#profile_user"><?php echo $this->member_model->get_where($reply->member_id)->firstname.' '.$this->member_model->get_where($reply->member_id)->lastname;?> (<?php echo $this->company_model->get_where($this->member_model->get_where($reply->member_id)->company_id)->company_name;?>)</a>
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
                                    <p><?php echo $original_email->time;?> at <?php echo $reply->date;?></p>
                                </div>
                                <h2><?php echo $original_email->subject;?></h2>
                                <p>From: <a data-toggle="modal" data-target="#profile_user"><?php echo $this->member_model->get_where($original_email->member_id)->firstname.' '.$this->member_model->get_where($original_email->member_id)->lastname?> (<?php echo $this->company_model->get_where($this->member_model->get_where($original_email->member_id)->company_id)->company_name;?>)</a></p>
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
                    <input type="checkbox" id="select_all" class="icheckbox_square-green i-checks" /> Select All
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
<script src="public/main/template/core/js/plugins/jsKnob/jquery.knob.js"></script>
        
<!-- Toastr script -->
<script src="public/main/template/core/js/plugins/toastr/toastr.min.js"></script><!-- ALERTS -->

<script type="text/javascript">
    $(function () {
            toastr.options = {
                closeButton: false,
                debug:false,
                progressBar: false,
                positionClass: 'toast-bottom-right',
                onclick: null,
                                    showDuration: 400,
                                    hideDuration: 1000,
                                    timeOut: 7000,
                                    extendedTimeOut: 1000,
                                    showEasing: 'swing',
                                    hideEasing: 'linear',
                                    showMethod: 'fadeIn',
                                    hideMethod: 'fadeOut',
                            };

        $('#conversation').click(function (){
            toastr.warning('Both users need to add each other as a contact before they can use GSM Messenger!', 'Chat Unavailable');
        });
            $(".dial").knob();
    })
</script>
