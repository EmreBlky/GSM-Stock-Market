

    <!-- Custom and plugin javascript -->
    <script src="public/main/template/core/js/inspinia.js"></script>
    <script src="public/main/template/core/js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="public/main/template/core/js/plugins/iCheck/icheck.min.js"></script>
    <?php /*
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script> */ ?>

<script type="text/javascript">

    $(function() {

            autoRefreshInbox();

        });
        
        
        function autoRefreshInbox()
        {
            
            setTimeout("autoRefreshInbox()",10000);            
            
            $.get("mailbox/new_message_all", function(data) {
                $("#inbox_all_message").html(data);    
            });
            $.get("mailbox/new_message_market", function(data) {
                $("#inbox_market").html(data);    
            });
            $.get("mailbox/new_message_member", function(data) {
                $("#inbox_member").html(data);    
            });
            $.get("mailbox/new_message_support", function(data) {
                $("#inbox_support").html(data);    
            });
         }
	
	    $(document).ready(function() {
       $("#select_all").change(function(){
             if(this.checked){
            $(".i-checks").each(function(){
                this.checked=true;
            })              
        }else{
            $(".i-checks").each(function(){
                this.checked=false;
            })              
        }
    });

    $("i-checks").click(function () {
        if (!$(this).is(":checked")){
            $("#select_all").prop("checked", false);
        }else{
            var flag = 0;
            $(".i-checks").each(function(){
                if(!this.checked)
                flag=1;
            })              
                        if(flag == 0){ $("#select_all").prop("checked", true);}
        }
    });
    
        
   
});

</script>
