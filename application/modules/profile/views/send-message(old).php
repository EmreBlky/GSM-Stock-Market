<div class="modal inmodal fade" id="profile_message" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php
                echo form_open('mailbox/composeMail'); 
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Send Message</h4>
                <small class="font-bold">Send a message to <?php echo $member_info->company_name?></small>
                <input type="hidden" name="email_address" value="<?php echo $member_info->email; ?>"/>
                <input type="hidden" name="subject" value="Profile Message"/>
            </div>
            <div class="modal-body">
                <!-- <p><strong>Form here</strong> generic stuff bla bla</p> -->
                <?php 

                    $data = array(
                                'name'          => 'body',
                                'class'         => 'form-control', 
                                'style'         => 'border:none',
                                'required'      => 'required'
                              );

                    echo form_textarea($data);

                ?>
            </div>

            <div class="modal-footer">                
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="submit" value="Send Message">
            </div>
        </div>
        <?php echo form_close()?>
    </div>
</div>

