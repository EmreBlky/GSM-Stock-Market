<?php if($member_company->admin_member_id == $this->session->userdata('members_id')){?>
<script type="text/javascript">

    function postFeed()
    {
        //var content = $('#feed_content').val().replace(/(\r\n|\n|\r)/gm, '%0D%0A');
        var content    = $('#feed_content').val().replace(/(\r\n|\n|\r)/gm, 'BREAK1');
        var content    = content.replace(/\//g, 'SLASH1');
        var content    = content.replace(/\?/g, 'QUEST1');
        var content    = content.replace(/\%/g, 'PERCENT1');
        
        if(content == 'Message' || content == ''){
            toastr.error('Please complete the field.', 'Missing Information');
            return FALSE;
        }else{
            $.ajax({
                    type: "POST",
                    url: "feed/add/"+ content +"",
                    dataType: "html",
                    success:function(data){
                      $('#feed_content').val('');  
                      //$('#contact_removed').replaceWith('<button onclick="contactAdd();" type="button" class="btn btn-success btn-sm btn-block" id="contact_added"><i class="fa fa-book"></i> Add Contact</button>');  
                      toastr.success('Your feed has been sent for approval.', 'Feed Success');
                    },
            });
        }
    }

</script>

    <div class="chat-form"><!-- Profile Owner Only -->

        <div class="form-group">
                <textarea class="form-control" placeholder="Message" id="feed_content" required="required" style="white-space: pre-wrap"></textarea>
            </div>
        
            <div class="text-right">
                <button onclick="postFeed();" type="submit" class="btn btn-sm btn-primary m-t-n-xs" id="feed_post"><strong>Post to Feed</strong></button>
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
<?php }?>
