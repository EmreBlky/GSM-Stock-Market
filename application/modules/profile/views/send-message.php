<?php 

//echo '<pre>';
//print_r($member_company);
//exit;
?>
<div class="modal inmodal fade" id="profile_message" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">           
            <?php
                 $attributes = array('id' => 'form');
                 echo form_open('mailbox/composeMail', $attributes); 
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" data-dismiss="modal">Send Message</h4>
                <small class="font-bold">Send a message to <?php echo $member_company->company_name?></small>
                <input type="hidden" id="sent_by" name="sent_by" value="<?php echo $this->session->userdata('members_id'); ?>"/>
                <input type="hidden" id="sent_to" name="sent_to" value="<?php echo $this->member_model->get_where_multiple('email', $member_info->email)->id; ?>"/>                
                <input type="hidden" id="email_address" name="email_address" value="<?php echo $member_info->email; ?>"/>
                <input type="hidden" id="subject" name="subject" value="Profile Message"/>
            </div>
            <div class="modal-body">
                <!-- <p><strong>Form here</strong> generic stuff bla bla</p> -->
                <?php 

                    $data = array(
                                'name'          => 'body',
                                'id'            => 'body',
                                'class'         => 'form-control', 
                                'style'         => 'border:none',
                                'required'      => 'required'
                              );

                    echo form_textarea($data);

                ?>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="submit" value="Send Message"/>
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" id="submit_message" class="btn btn-primary">Send Message</button>
<!--                <input type="submit" id="submit_message" class="btn btn-primary" name="submit" value="Send Message">-->
            </div>
        </div>
        <?php echo form_close()?>
    </div>
</div>
<script type="text/javascript">

$(document).ready(function(){   

    $("#submit_message").click(function(){
        
        $("#submit_message").hide(); 
        var mid     = $('#sent_by').val();
        var sid     = $("#sent_to").val();
        var subject = $("#subject").val().replace(/(\r\n|\n|\r)/gm, '%0D%0A');
        var body    = $("#body").val().replace(/(\r\n|\n|\r)/gm, 'BREAK1');
        var body    = body.replace(/\//g, 'SLASH1');
        var body    = body.replace(/\?/g, 'QUEST1');
        var body    = body.replace(/\%/g, 'PERCENT1');
        
         $.ajax({
                type: "POST",
                url: "mailbox/composeAjaxMail/"+ mid +"/"+ sid +"/"+ subject +"/"+ body +"",
                dataType: "html",
                success:function(data){
                  $('#body').val('');  
                  $('#profile_message').modal('hide');                  
                  toastr.success('Your message has been sent.', 'Message Alert');
                  $("#submit_message").show('slow');
                },
            });    
    });
 });

</script>

