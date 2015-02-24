<?php

//echo '<pre>';
//print_r($viewed);
//echo '</pre>';
//exit;

?>
<script type="text/javascript">

    function sendMessage(mid, sid)
    {
        //alert(mid);
        //alert(sid);
        //var mid     = $('#sent_by').val();
        //var sid     = $("#sent_to").val();
        var subject = $("#subject_"+sid+"").val();
        var body    = $("#body_"+sid+"").val().replace(/(\r\n|\n|\r)/gm, '%0D%0A');
        
         $.ajax({
                type: "POST",
                url: "mailbox/composeAjaxMail/"+ mid +"/"+ sid +"/"+ subject +"/"+body +"",
                dataType: "html",
                cache: true,
                success:function(data){
                    $("#body_"+sid+"").val('');
                  $('#profile_message_'+sid+'').modal('hide');
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
            
            <?php 
            if($viewed_count > 0){
                foreach ($viewed as $view) {
                    if($view->viewer_id != $this->session->userdata('members_id')){
                
            ?>
            
            <div class="col-lg-4"><!-- Profile Widget Start -->
                <div class="contact-box">
                    <a href="<?php echo $base;?>member/profile/<?php echo $view->viewer_id?>">
                    <div class="col-sm-4">
                        <div class="text-center">
<!--                            <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/img/daniel_big.jpg">-->
                            <?php if(file_exists("public/main/template/gsm/images/members/".$view->viewer_id.".jpg")){?>
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/members/<?php echo $view->viewer_id; ?>.jpg" height="128" width="128"/>
                            <?php } else {?>
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/members/no_profile.jpg" height="128" width="128"/>
                            <?php }?>
                        </div>
                        <div class="text-center" style="margin-top:10px">
                            <?php if($this->member_model->get_where_multiple('id', $view->viewer_id)->online_status == 'online'){?>
                                <span class="label label-primary">Online</span>
                            <?php } else {?>
                                <span class="label label-secondary">Offline</span>
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
                            <img alt="image" src="public/main/template/gsm/img/flags/United_Kingdom.png" title="United Kingdom">
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
                                <button class="btn btn-message" type="button" data-toggle="modal" data-target="#profile_message_<?php echo $view->viewer_id;?>" value="<?php echo $view->viewer_id;?>"><i class="fa fa-envelope"></i>&nbsp;Message</button>
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
                            <button onclick="sendMessage(<?php echo $this->session->userdata('members_id');?>, <?php echo $view->viewer_id;?>);" type="button" id="submit_message" class="btn btn-primary">Send Message</button>
            <!--                <input type="submit" id="submit_message" class="btn btn-primary" name="submit" value="Send Message">-->
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>

            
            <?php         }
                        //unset($view->viewer_id);
                        }
                        echo $pagination;
                      }
                     
            ?>
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
                            
                               
            