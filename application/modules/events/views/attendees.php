<?php
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
    <div class="col-lg-10">
        <h2><?php echo $event->name; ?> Atendees</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/">Home</a>
            </li>
            <li class="active">
                <strong>Events</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<div class="wrapper wrapper-content  animated fadeInRight">

    <div class="row">
    
        <?php 
            if($attendees_count > 0){
            foreach ($attendees as $attendee){
                
        ?>        
            <div class="col-lg-6"><!-- Profile Widget Start -->
                <div class="contact-box">
                    <a href="member/profile/">
                    <div class="col-sm-5">
                        <div class="text-center">
                            <?php if(file_exists("public/main/template/gsm/images/members/".$attendee->member_id.".png")){?>
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/members/<?php echo $attendee->member_id; ?>.png"/>
                            <?php } else {?>
                                <img alt="image" class="img-circle m-t-xs img-responsive fullhw" src="public/main/template/gsm/images/members/no_profile.jpg"/>
                            <?php }?>
                        </div>
                    </div>
                    </a>
                    <div class="col-sm-7 profile-minh">
                    	<div class="col-sm-12 nopadding">
                    	<div class="col-sm-11 nopadding">
                        <h3 style="margin-bottom:0"><strong><?php echo $this->company_model->get_where($this->member_model->get_where($attendee->member_id)->company_id)->company_name; ?></strong></h3>
                        <strong><?php echo $this->member_model->get_where($attendee->member_id)->firstname;?> <?php echo $this->member_model->get_where($attendee->member_id)->lastname;?></strong><br />
                        <?php echo $this->member_model->get_where($attendee->member_id)->role;?>
                        </div>                
                        <?php $country =  $this->country_model->get_where($this->company_model->get_where($this->member_model->get_where($attendee->member_id)->company_id)->country)->country; ?>
                        <div class="col-sm-1" style="padding:5px 0">
                            <img alt="image" src="public/main/template/gsm/img/flags/<?php echo country($country); ?>.png" title="<?php echo $country?>">
                        </div>
                        </div>
                        
                    	<div class="col-sm-12 nopadding">
                        
                        <h4 style="margin:15px 0 0 0"><strong>Business Sectors</strong></h4>
                        <ul style="list-style:none;padding:0">                            
                            <li><?php echo $this->company_model->get_where($this->member_model->get_where($attendee->member_id)->company_id)->business_sector_1?></li>
                            <li><?php echo $this->company_model->get_where($this->member_model->get_where($attendee->member_id)->company_id)->business_sector_2?></li>
                            <li><?php echo $this->company_model->get_where($this->member_model->get_where($attendee->member_id)->company_id)->business_sector_3?></li>
                        </ul>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 gsm-contact">                      
                            
                            <div>
                            <button class="btn btn-message" type="button" data-toggle="modal" data-target="#profile_message_<?php echo $attendee->member_id; ?>" value=""><i class="fa fa-envelope"></i>&nbsp;Message</button>
                            <button  onclick="location.href='member/profile/<?php echo $attendee->member_id; ?>'" class="btn btn-profile" type="button"><i class="fa fa-user"></i>&nbsp;View Profile</button>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div><!-- Profile Widget End -->
            
            <div class="modal inmodal fade" id="profile_message_<?php echo $attendee->member_id;?>" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        
                        <?php
                             $attributes = array('id' => 'form');
                             echo form_open('mailbox/composeMail', $attributes); 
                        ?>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" data-dismiss="modal">Send Message</h4>
                            <small class="font-bold">Send a message to <?php echo $this->company_model->get_where($this->member_model->get_where($attendee->member_id)->company_id)->company_name; ?></small>
                            <input type="hidden" id="sent_by" name="sent_by" value="<?php echo $this->session->userdata('members_id'); ?>"/>
                            <input type="hidden" id="sent_to" name="sent_to" value="<?php echo $attendee->member_id; ?>"/>                
                            <input type="hidden" id="email_address" name="email_address" value="<?php echo $this->member_model->get_where($attendee->member_id)->email;?>"/>
                            <input type="hidden" id="subject_<?php echo $attendee->member_id; ?>" name="subject_<?php echo $attendee->member_id; ?>" value="Profile Message"/>
                        </div>
                        <div class="modal-body">
                            <!-- <p><strong>Form here</strong> generic stuff bla bla</p> -->
                            <?php 

                                $data = array(
                                            'name'          => 'body_'.$attendee->member_id,
                                            'id'            => 'body_'.$attendee->member_id,
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
                            <button onclick="sendMessage(<?php echo $this->session->userdata('members_id');?>, <?php echo $attendee->member_id;?>);" type="button" id="submit_message_<?php echo $attendee->member_id;?>" class="btn btn-primary">Send Message</button>
            <!--                <input type="submit" id="submit_message" class="btn btn-primary" name="submit" value="Send Message">-->
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        
        <?php
            }   
            } 
            else {
        ?>
            <div class="col-lg-12"><!-- Profile Widget Start -->
                <div class="contact-box">
                    There are no attendees at present.
                </div>
            </div>
        <?php    
            }
        ?>        
        
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
                                
            $(".dial").knob();                    
        });
    </script>