
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
    
//   $(document).ready(function(){
//        $("#submit_message").click(function(e){
//            e.preventDefault();
//            $("#form").submit();  // jQuey's submit function applied on form.
//            //alert('WORKING!');
//            
//        });
//    });


    $(function(){
        $("#submit_message").click(function(){

            $("#form").submit(function(){
                
                dataString = $("#form").serialize();

                $.ajax({
                type: "GET",
                url: "mailbox/composeMail",
                data: dataString,

                success: function(data){
                alert('Successful!);
                }

                });
                return false;  //stop the actual form post !important!

            });
        }
    });


</script>

