<?php

//echo '<pre>';
//print_r($member);
//exit;

?>

<div class="modal inmodal fade" id="creditdata" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Request a Credit Check</h4>
                <small class="font-bold">You will need to get permission from this user to access their credit data</small>
            </div>
            <input type="hidden" name="requestee" id="requestee" value="<?php echo $member->id; ?>" />
            <input type="hidden" name="credit_report" id="credit_report" value="<?php echo $this->company_model->get_where($this->member_model->get_where($member->id)->company_id)->credit_report; ?>" />
            <input type="hidden" name="requester" id="requester" value="<?php echo $this->session->userdata('members_id'); ?>" />
            <div class="modal-body">
                <p class="text-navy"><strong>Notice:</strong> Please be aware although credit reports are free you will still need permission from the users company first.
                    <br />
                    The user can accept or decline at their own discretion, It is ideal to message them first before requesting a credit check so they know your intentions.</p>
                <br />
                <?php if(file_exists("public/main/template/gsm/creditdata/".$this->company_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id)->credit_report.".pdf")){?>
                <div class="radio i-checks">
                    <label>
                        <input type="radio" name="credit_type" class="credit_type" value="single"> <i></i> Request their company credit report and <strong>deny</strong> them access to yours.
                    </label>
                </div>
                <div class="radio i-checks">
                    <label>
                        <input type="radio" name="credit_type" class="credit_type" value="both" checked=""> <i></i> Request their company credit report and <strong>allow</strong> them access to yours. (Recommended)
                    </label>
                </div>
                <?php } else {?>
                <div class="radio i-checks">
                    <label>
                        <input type="radio" name="credit_type" class="credit_type" value="single" checked=""> <i></i> Request their company credit report.
                    </label>
                </div>
                <?php }?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit_credit">Submit</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function(){   

    $("#submit_credit").click(function(){
        
        //$("#submit_credit").hide(); 
        var mid             = $('#requestee').val();
        var sid             = $("#requester").val();
        var credit_report   = $("#credit_report").val();
        var credit_type     = $('input[name=credit_type]:checked').val();
        
         $.ajax({
                type: "POST",
                url: "creditdata/processRequest/"+ mid +"/"+ sid +"/"+ credit_type +"/"+ credit_report +"",
                dataType: "html",
                success:function(data){
                  
                  //$('#body').val('');  
                  $('#creditdata').modal('hide');                  
                  toastr.success('Your request has been sent.', 'Message Alert');
                  //$("#submit_message").show('slow');
                },
            });    
    });
 });

</script>