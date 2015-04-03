<?php
//echo '<pre>';
//print_r($blocked);
//exit;
$bm = '';
if($blocked){
    foreach($blocked as $block){

        $bm .= $block->member_id.', ';

    }

    $bm = rtrim($bm, ', ');
    $bm = explode(', ', $bm);
}

function country($name)
{
    $name = str_replace(" ", "_", $name);
    
    return $name;
}

?>
<script type="text/javascript">

    function sendMessage(mid, sid)
    {
        //alert(mid);
        //alert(sid);
        //var mid     = $('#sent_by').val();
        //var sid     = $("#sent_to").val();
        $("#submit_message_"+sid+"").hide();
        var subject = $("#subject_"+sid+"").val();
        var body    = $("#body_"+sid+"").val().replace(/(\r\n|\n|\r)/gm, 'BREAK1');
        var body    = body.replace(/\//g, 'SLASH1');
        var body    = body.replace(/\?/g, 'QUEST1');
        var body    = body.replace(/\%/g, 'PERCENT1');
        
         $.ajax({
                type: "POST",
                url: "mailbox/composeAjaxMail/"+ mid +"/"+ sid +"/"+ subject +"/"+body +"",
                dataType: "html",
                cache: true,
                success:function(data){
                    $("#body_"+sid+"").val('');
                  $('#profile_message_'+sid+'').modal('hide');
                  toastr.success('Your message has been sent.', 'Message Alert');
                  $("#submit_message_"+sid+"").show('slow');
                },
            });
            
    }


</script>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Who's Viewed</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            Profile
                        </li>
                        <li class="active">
                            <strong>Who's Viewed</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
        			
            
            <!-- Daniel Added Start -->
            <?php if($member->membership < 2 && $viewed_count < 1) {?> 
            <div class="alert alert-info" style="margin:0 15px 15px">
                <p><i class="fa fa-info-circle"></i> This page displays all the users who have viewed your profile. They will be listed as most recent first and you will be able to message them directly or view their profiles from this page if you are Silver member or above. <a class="alert-link" href="preferences/subscription">Upgrade Now</a>.</p>
            </div>
                    
            <div class="col-lg-4"><!-- Profile Widget Start -->
                <div class="contact-box example">
                    <a href="<?php echo $base;?>member/profile/5">
                    <div class="col-sm-4">
                        <div class="text-center">
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/examples/1.jpg" height="128" width="128"/>
                        </div>
                        <div class="text-center" style="margin-top:10px">
                                <span class="label label-primary">Online</span>
                            
                        </div>
                    </div>
                    </a>
                    <div class="col-sm-8 profile-minh">
                    	<div class="col-sm-12 nopadding">
                    	<div class="col-sm-11 nopadding">
                            <h3 style="margin-bottom:0"><strong>Daniel Gregory</strong></h3>
                        	Account Manager
                        </div>
                        <div class="col-sm-1" style="padding:5px 0">
                            <img alt="image" src="public/main/template/gsm/img/flags/United_Kingdom.png" title="United Kingdom">
                        </div>
                        </div>
                        
                    	<div class="col-sm-12 nopadding">
                        
                        <h4 style="margin:15px 0 0 0"><strong>GSMStockMarket.com</strong></h4>
                        <ul style="list-style:none;padding:0">
                            <li>Primary Business</li>
                            <li>Secondary Business</li>
                            <li>Tiertary Business</li>
                        </ul>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 gsm-contact">
                            <div>
                                <button class="btn btn-message" type="button" data-toggle="modal" data-target="#profile_message_5" value="5"><i class="fa fa-envelope"></i>&nbsp;Message</button>
                            <button onclick="location.href='<?php echo $base;?>member/profile/5'" class="btn btn-profile" type="button" data-toggle="modal" ><i class="fa fa-user"></i>&nbsp;View Profile</button>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- Profile Widget End -->
                    
            <div class="col-lg-4"><!-- Profile Widget Start -->
                <div class="contact-box example">
                    <a href="<?php echo $base;?>member/profile/5">
                    <div class="col-sm-4">
                        <div class="text-center">
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/examples/2.jpg" height="128" width="128"/>
                        </div>
                        <div class="text-center" style="margin-top:10px">
                                <span class="label label-primary">Online</span>
                            
                        </div>
                    </div>
                    </a>
                    <div class="col-sm-8 profile-minh">
                    	<div class="col-sm-12 nopadding">
                    	<div class="col-sm-11 nopadding">
                            <h3 style="margin-bottom:0"><strong>Tim Meloni</strong></h3>
                        	Account Manager
                        </div>
                        <div class="col-sm-1" style="padding:5px 0">
                            <img alt="image" src="public/main/template/gsm/img/flags/United_Kingdom.png" title="United Kingdom">
                        </div>
                        </div>
                        
                    	<div class="col-sm-12 nopadding">
                        
                        <h4 style="margin:15px 0 0 0"><strong>GSMStockMarket.com</strong></h4>
                        <ul style="list-style:none;padding:0">
                            <li>Primary Business</li>
                            <li>Secondary Business</li>
                            <li>Tiertary Business</li>
                        </ul>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 gsm-contact">
                            <div>
                                <button class="btn btn-message" type="button" data-toggle="modal" data-target="#profile_message_5" value="5"><i class="fa fa-envelope"></i>&nbsp;Message</button>
                            <button onclick="location.href='<?php echo $base;?>member/profile/5'" class="btn btn-profile" type="button" data-toggle="modal" ><i class="fa fa-user"></i>&nbsp;View Profile</button>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- Profile Widget End -->
                    
            <div class="col-lg-4"><!-- Profile Widget Start -->
                <div class="contact-box example">
                    <a href="<?php echo $base;?>member/profile/5">
                    <div class="col-sm-4">
                        <div class="text-center">
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/examples/3.jpg" height="128" width="128"/>
                        </div>
                        <div class="text-center" style="margin-top:10px">
                                <span class="label label-danger">Offline</span>
                            
                        </div>
                    </div>
                    </a>
                    <div class="col-sm-8 profile-minh">
                    	<div class="col-sm-12 nopadding">
                    	<div class="col-sm-11 nopadding">
                            <h3 style="margin-bottom:0"><strong>Adam Pycroft</strong></h3>
                        	Account Manager
                        </div>
                        <div class="col-sm-1" style="padding:5px 0">
                            <img alt="image" src="public/main/template/gsm/img/flags/United_Kingdom.png" title="United Kingdom">
                        </div>
                        </div>
                        
                    	<div class="col-sm-12 nopadding">
                        
                        <h4 style="margin:15px 0 0 0"><strong>GSMStockMarket.com</strong></h4>
                        <ul style="list-style:none;padding:0">
                            <li>Primary Business</li>
                            <li>Secondary Business</li>
                            <li>Tiertary Business</li>
                        </ul>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 gsm-contact">
                            <div>
                                <button class="btn btn-message" type="button" data-toggle="modal" data-target="#profile_message_5" value="5"><i class="fa fa-envelope"></i>&nbsp;Message</button>
                            <button onclick="location.href='<?php echo $base;?>member/profile/5'" class="btn btn-profile" type="button" data-toggle="modal" ><i class="fa fa-user"></i>&nbsp;View Profile</button>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- Profile Widget End -->
                    
            <div class="col-lg-4"><!-- Profile Widget Start -->
                <div class="contact-box example">
                    <a href="<?php echo $base;?>member/profile/5">
                    <div class="col-sm-4">
                        <div class="text-center">
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/examples/4.jpg" height="128" width="128"/>
                        </div>
                        <div class="text-center" style="margin-top:10px">
                                <span class="label label-primary">Online</span>
                            
                        </div>
                    </div>
                    </a>
                    <div class="col-sm-8 profile-minh">
                    	<div class="col-sm-12 nopadding">
                    	<div class="col-sm-11 nopadding">
                            <h3 style="margin-bottom:0"><strong>Andrea M-Saunders</strong></h3>
                        	Account Manager
                        </div>
                        <div class="col-sm-1" style="padding:5px 0">
                            <img alt="image" src="public/main/template/gsm/img/flags/Germany.png" title="Germany">
                        </div>
                        </div>
                        
                    	<div class="col-sm-12 nopadding">
                        
                        <h4 style="margin:15px 0 0 0"><strong>GSMStockMarket.com</strong></h4>
                        <ul style="list-style:none;padding:0">
                            <li>Primary Business</li>
                            <li>Secondary Business</li>
                            <li>Tiertary Business</li>
                        </ul>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 gsm-contact">
                            <div>
                                <button class="btn btn-message" type="button" data-toggle="modal" data-target="#profile_message_5" value="5"><i class="fa fa-envelope"></i>&nbsp;Message</button>
                            <button onclick="location.href='<?php echo $base;?>member/profile/5'" class="btn btn-profile" type="button" data-toggle="modal" ><i class="fa fa-user"></i>&nbsp;View Profile</button>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- Profile Widget End -->
                    
            <div class="col-lg-4"><!-- Profile Widget Start -->
                <div class="contact-box example">
                    <a href="<?php echo $base;?>member/profile/5">
                    <div class="col-sm-4">
                        <div class="text-center">
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/examples/5.jpg" height="128" width="128"/>
                        </div>
                        <div class="text-center" style="margin-top:10px">
                                <span class="label label-danger">Offline</span>
                            
                        </div>
                    </div>
                    </a>
                    <div class="col-sm-8 profile-minh">
                    	<div class="col-sm-12 nopadding">
                    	<div class="col-sm-11 nopadding">
                            <h3 style="margin-bottom:0"><strong>Andrea Rossi</strong></h3>
                        	Account Manager
                        </div>
                        <div class="col-sm-1" style="padding:5px 0">
                            <img alt="image" src="public/main/template/gsm/img/flags/Italy.png" title="Italy">
                        </div>
                        </div>
                        
                    	<div class="col-sm-12 nopadding">
                        
                        <h4 style="margin:15px 0 0 0"><strong>GSMStockMarket.com</strong></h4>
                        <ul style="list-style:none;padding:0">
                            <li>Primary Business</li>
                            <li>Secondary Business</li>
                            <li>Tiertary Business</li>
                        </ul>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 gsm-contact">
                            <div>
                                <button class="btn btn-message" type="button" data-toggle="modal" data-target="#profile_message_5" value="5"><i class="fa fa-envelope"></i>&nbsp;Message</button>
                            <button onclick="location.href='<?php echo $base;?>member/profile/5'" class="btn btn-profile" type="button" data-toggle="modal" ><i class="fa fa-user"></i>&nbsp;View Profile</button>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- Profile Widget End -->
                    
            <div class="col-lg-4"><!-- Profile Widget Start -->
                <div class="contact-box example">
                    <a href="<?php echo $base;?>member/profile/5">
                    <div class="col-sm-4">
                        <div class="text-center">
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/examples/6.jpg" height="128" width="128"/>
                        </div>
                        <div class="text-center" style="margin-top:10px">
                                <span class="label label-danger">Offline</span>
                            
                        </div>
                    </div>
                    </a>
                    <div class="col-sm-8 profile-minh">
                    	<div class="col-sm-12 nopadding">
                    	<div class="col-sm-11 nopadding">
                            <h3 style="margin-bottom:0"><strong>Dipo George</strong></h3>
                        	Web Developer
                        </div>
                        <div class="col-sm-1" style="padding:5px 0">
                            <img alt="image" src="public/main/template/gsm/img/flags/United_Kingdom.png" title="United Kingdom">
                        </div>
                        </div>
                        
                    	<div class="col-sm-12 nopadding">
                        
                        <h4 style="margin:15px 0 0 0"><strong>GSMStockMarket.com</strong></h4>
                        <ul style="list-style:none;padding:0">
                            <li>Primary Business</li>
                            <li>Secondary Business</li>
                            <li>Tiertary Business</li>
                        </ul>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 gsm-contact">
                            <div>
                                <button class="btn btn-message" type="button" data-toggle="modal" data-target="#profile_message_5" value="5"><i class="fa fa-envelope"></i>&nbsp;Message</button>
                            <button onclick="location.href='<?php echo $base;?>member/profile/5'" class="btn btn-profile" type="button" data-toggle="modal" ><i class="fa fa-user"></i>&nbsp;View Profile</button>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- Profile Widget End -->
            
            <div class="modal inmodal fade" id="profile_message_5" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    	<form id="form">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" data-dismiss="modal">Send Message</h4>
                            <small class="font-bold">Send a message to GSMStockMarket.com Limited</small>
                            <input type="hidden" id="sent_by" name="sent_by" value="5"/>
                            <input type="hidden" id="sent_to" name="sent_to" value="5"/>                
                            <input type="hidden" id="email_address" name="email_address" value="5"/>
                            <input type="hidden" id="subject_5" name="subject_5" value="Profile Message"/>
                        </div>
                        <div class="modal-body">
                        	<textarea name="body_5" id="body_5" class="form-control" style="border:none" rows="10" required placeholder="Here you can send any user who has viewed you a message, this feature is available to members silver and above. Bronze members will only be allowed to reply to messages sent to the in their mailbox."></textarea>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="submit" value="Send Message"/>
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Send Message</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
                  
                    
                    <?php } elseif ($member->membership > 0 || $viewed_count > 0) {?>
            <!-- Daniel Added End -->
        
        
        
        
            <?php if($blocked){ ?>
                <?php
            
            $count = 0;
            if($viewed_count > 0){
                foreach ($viewed as $view) {
                    
                    if($view->viewer_id != $this->session->userdata('members_id') && $view->viewer_id != $bm[$count]){
                    
            ?>
            
            <div class="col-lg-4"><!-- Profile Widget Start -->
                <div class="contact-box">
                    <a href="<?php echo $base;?>member/profile/<?php echo $view->viewer_id?>">
                    <div class="col-sm-4">
                        <div class="text-center">
<!--                            <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/img/daniel_big.jpg">-->
                            <?php if(file_exists("public/main/template/gsm/images/members/".$view->viewer_id.".png")){?>
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/members/<?php echo $view->viewer_id; ?>.png" height="128" width="128"/>
                            <?php } else {?>
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/members/no_profile.jpg" height="128" width="128"/>
                            <?php }?>
                        </div>
                        <div class="text-center" style="margin-top:10px">
                            <?php if($this->member_model->get_where_multiple('id', $view->viewer_id)->online_status == 'online'){?>
                                <span class="label label-primary">Online</span>
                            <?php } else {?>
                                <span class="label label-danger">Offline</span>
                            <?php }?>
                            
                        </div>
                    </div>
                    </a>
                    <div class="col-sm-8 profile-minh">
                    	<div class="col-sm-12 nopadding">
                    	<div class="col-sm-11 nopadding">
                            <h3 style="margin-bottom:0"><strong><?php echo $this->member_model->get_where_multiple('id', $view->viewer_id)->firstname.' '.$this->member_model->get_where_multiple('id', $view->viewer_id)->lastname;?></strong></h3>
                        	<?php echo $this->member_model->get_where_multiple('id', $view->viewer_id)->role; ?>
                        </div>
                        <div class="col-sm-1" style="padding:5px 0">
                            <img alt="image" src="public/main/template/gsm/img/flags/<?php echo country($this->country_model->get_where($this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->country)->country);?>.png" title="<?php echo $this->country_model->get_where($this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->country)->country?>">
                        </div>
                        </div>
                        
                    	<div class="col-sm-12 nopadding">
                        
                        <h4 style="margin:15px 0 0 0"><strong><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->company_name; ?></strong></h4>
                        <ul style="list-style:none;padding:0">
                            <li><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->business_sector_1; ?></li>
                            <li><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->business_sector_2; ?></li>
                            <li><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->business_sector_3; ?></li>
                        </ul>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 gsm-contact">
                            <div>
                                <?php if($this->session->userdata('membership') != 1) {?>
                                <button class="btn btn-message" type="button" data-toggle="modal" data-target="#profile_message_<?php echo $view->viewer_id;?>" value="<?php echo $view->viewer_id;?>"><i class="fa fa-envelope"></i>&nbsp;Message</button>
                                <?php } ?>
                            <button onclick="location.href='<?php echo $base;?>member/profile/<?php echo $view->viewer_id?>'" class="btn btn-profile" type="button" data-toggle="modal" ><i class="fa fa-user"></i>&nbsp;View Profile</button>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- Profile Widget End -->
            
            <div class="modal inmodal fade" id="profile_message_<?php echo $view->viewer_id;?>" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <?php
                            //$test = $view->viewer_id;
                            //exit;
                            $this->load->model('member/member_model', 'member_model');
                            $this->load->model('company/company_model', 'company_model');
                            $membs = $this->member_model->get_where($view->viewer_id);
                            $member_company = $this->company_model->get_where($view->viewer_id);
                        ?>
                        <?php
                             $attributes = array('id' => 'form');
                             echo form_open('mailbox/composeMail', $attributes); 
                        ?>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" data-dismiss="modal">Send Message</h4>
                            <small class="font-bold">Send a message to <?php echo $member_company->company_name?></small>
                            <input type="hidden" id="sent_by" name="sent_by" value="<?php echo $this->session->userdata('members_id'); ?>"/>
                            <input type="hidden" id="sent_to" name="sent_to" value="<?php echo $membs->id; ?>"/>                
                            <input type="hidden" id="email_address" name="email_address" value="<?php echo $membs->email; ?>"/>
                            <input type="hidden" id="subject_<?php echo $membs->id; ?>" name="subject_<?php echo $membs->id; ?>" value="Profile Message"/>
                        </div>
                        <div class="modal-body">
                            <!-- <p><strong>Form here</strong> generic stuff bla bla</p> -->
                            <?php 

                                $data = array(
                                            'name'          => 'body_'.$view->viewer_id,
                                            'id'            => 'body_'.$view->viewer_id,
                                            'class'         => 'form-control',
                                            'autofocus'     =>	'autofocus',
                                            'style'         => 'border:none',
                                            'required'      => 'required'
                                          );

                                echo form_textarea($data);

                            ?>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="submit" value="Send Message"/>
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button onclick="sendMessage(<?php echo $this->session->userdata('members_id');?>, <?php echo $view->viewer_id;?>);" type="button" id="submit_message_<?php echo $view->viewer_id;?>" class="btn btn-primary">Send Message</button>
            <!--                <input type="submit" id="submit_message" class="btn btn-primary" name="submit" value="Send Message">-->
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>

            
            <?php         }
                        //unset($view->viewer_id);
                        }
                        $count++;
                        echo $pagination;
                      }
                     
            ?>
            <?php }elseif($viewed_count > 0) { ?>
            
                <?php
            
            $count = 0;
            if($viewed_count > 0){
                foreach ($viewed as $view) {
                    
                    if($view->viewer_id != $this->session->userdata('members_id') || $view->viewer_id != 5){
                    
            ?>
            
            <div class="col-lg-4"><!-- Profile Widget Start -->
                <div class="contact-box">
                    <a href="<?php echo $base;?>member/profile/<?php echo $view->viewer_id?>">
                    <div class="col-sm-4">
                        <div class="text-center">
<!--                            <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/img/daniel_big.jpg">-->
                            <?php if(file_exists("public/main/template/gsm/images/members/".$view->viewer_id.".png")){?>
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/members/<?php echo $view->viewer_id; ?>.png" height="128" width="128"/>
                            <?php } else {?>
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/members/no_profile.jpg" height="128" width="128"/>
                            <?php }?>
                        </div>
                        <div class="text-center" style="margin-top:10px">
                            <?php if($this->member_model->get_where_multiple('id', $view->viewer_id)->online_status == 'online'){?>
                                <span class="label label-primary">Online</span>
                            <?php } else {?>
                                <span class="label label-danger">Offline</span>
                            <?php }?>
                            
                        </div>
                    </div>
                    </a>
                    <div class="col-sm-8 profile-minh">
                    	<div class="col-sm-12 nopadding">
                    	<div class="col-sm-11 nopadding">
                            <h3 style="margin-bottom:0"><strong><?php echo $this->member_model->get_where_multiple('id', $view->viewer_id)->firstname.' '.$this->member_model->get_where_multiple('id', $view->viewer_id)->lastname;?></strong></h3>
                        	<?php echo $this->member_model->get_where_multiple('id', $view->viewer_id)->role; ?>
                        </div>
                        <div class="col-sm-1" style="padding:5px 0">
                            <img alt="image" src="public/main/template/gsm/img/flags/<?php echo country($this->country_model->get_where($this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->country)->country);?>.png" title="<?php echo $this->country_model->get_where($this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->country)->country?>">
                        </div>
                        </div>
                        
                    	<div class="col-sm-12 nopadding">
                        
                        <h4 style="margin:15px 0 0 0"><strong><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->company_name; ?></strong></h4>
                        <ul style="list-style:none;padding:0">
                            <li><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->business_sector_1; ?></li>
                            <li><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->business_sector_2; ?></li>
                            <li><?php echo $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $view->viewer_id)->company_id)->business_sector_3; ?></li>
                        </ul>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 gsm-contact">
                            <div>
                                <?php if($this->session->userdata('membership') != 1) {?>
                                <button class="btn btn-message" type="button" data-toggle="modal" data-target="#profile_message_<?php echo $view->viewer_id;?>" value="<?php echo $view->viewer_id;?>"><i class="fa fa-envelope"></i>&nbsp;Message</button>
                                <?php } ?>
                            <button onclick="location.href='<?php echo $base;?>member/profile/<?php echo $view->viewer_id?>'" class="btn btn-profile" type="button" data-toggle="modal" ><i class="fa fa-user"></i>&nbsp;View Profile</button>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- Profile Widget End -->
            
            <div class="modal inmodal fade" id="profile_message_<?php echo $view->viewer_id;?>" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <?php
                            //$test = $view->viewer_id;
                            //exit;
                            $this->load->model('member/member_model', 'member_model');
                            $this->load->model('company/company_model', 'company_model');
                            $membs = $this->member_model->get_where($view->viewer_id);
                            $member_company = $this->company_model->get_where($view->viewer_id);
                        ?>
                        <?php
                             $attributes = array('id' => 'form');
                             echo form_open('mailbox/composeMail', $attributes); 
                        ?>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" data-dismiss="modal">Send Message</h4>
                            <small class="font-bold">Send a message to <?php echo $member_company->company_name?></small>
                            <input type="hidden" id="sent_by" name="sent_by" value="<?php echo $this->session->userdata('members_id'); ?>"/>
                            <input type="hidden" id="sent_to" name="sent_to" value="<?php echo $membs->id; ?>"/>                
                            <input type="hidden" id="email_address" name="email_address" value="<?php echo $membs->email; ?>"/>
                            <input type="hidden" id="subject_<?php echo $membs->id; ?>" name="subject_<?php echo $membs->id; ?>" value="Profile Message"/>
                        </div>
                        <div class="modal-body">
                            <!-- <p><strong>Form here</strong> generic stuff bla bla</p> -->
                            <?php 

                                $data = array(
                                            'name'          => 'body_'.$view->viewer_id,
                                            'id'            => 'body_'.$view->viewer_id,
                                            'class'         => 'form-control',
                                            'autofocus'     =>	'autofocus',
                                            'style'         => 'border:none',
                                            'required'      => 'required'
                                          );

                                echo form_textarea($data);

                            ?>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="submit" value="Send Message"/>
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button onclick="sendMessage(<?php echo $this->session->userdata('members_id');?>, <?php echo $view->viewer_id;?>);" type="button" id="submit_message_<?php echo $view->viewer_id;?>" class="btn btn-primary">Send Message</button>
            <!--                <input type="submit" id="submit_message" class="btn btn-primary" name="submit" value="Send Message">-->
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>

            
            <?php         }
                        //unset($view->viewer_id);
                        }
                        $count++;
                        echo $pagination;
                      }
                     
            ?>
            <?php }?>
            
            <!-- Daniel Added Start -->
            <?php } ?> 
            <!-- Daniel Added End -->
            
            
       	</div><!-- Row End -->
<!--        <div class="row" style="margin:0 0 25px 0">
        <div class="btn-group pull-right">
        	<button type="button" class="btn btn-white"><i class="fa fa-chevron-left"></i></button>
            <button class="btn btn-white">1</button>
            <button class="btn btn-white  active">2</button>
            <button class="btn btn-white">3</button>
            <button class="btn btn-white">4</button>
            <button type="button" class="btn btn-white"><i class="fa fa-chevron-right"></i> </button>
        </div>
        </div>-->
                        
        
           
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
                                
            $(".dial").knob();                    
        });
    </script>
           
                               
            